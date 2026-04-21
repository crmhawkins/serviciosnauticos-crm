# Despliegue en Coolify

Guía paso a paso para desplegar este CRM en Coolify usando el `Dockerfile` incluido.

## 1. Requisitos en Coolify

Crea dos recursos en el mismo *Project* de Coolify:

| Recurso | Tipo | Notas |
|--------|------|-------|
| **crm-db** | Database → MySQL 8 o MariaDB 10.6 | Volumen persistente |
| **crm-app** | Application → Dockerfile | Build context: raíz del repo, Dockerfile: `./Dockerfile` |

Conecta la aplicación a la base de datos usando el nombre del servicio MySQL como `DB_HOST` (Coolify lo expone en la red interna).

## 2. Variables de entorno

En la pestaña *Environment Variables* de `crm-app`, copia esto (ajusta dominio, credenciales, SMTP):

```env
APP_NAME="Servicios Nauticos CRM"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tu-dominio.com
APP_KEY=                       # déjalo vacío y Coolify lo puede inyectar, o genera uno — ver paso 3
LOG_LEVEL=warning

DB_CONNECTION=mysql
DB_HOST=crm-db                 # nombre del servicio MySQL en Coolify
DB_PORT=3306
DB_DATABASE=crm_jsserviciosnauticos
DB_USERNAME=crm
DB_PASSWORD=<pwd-fuerte>

SESSION_DRIVER=file
CACHE_DRIVER=file
QUEUE_CONNECTION=sync

SANCTUM_STATEFUL_DOMAINS=tu-dominio.com

# SMTP (cambia a tu proveedor real — SendGrid, Mailgun, SES, etc.)
MAIL_MAILER=smtp
MAIL_HOST=smtp.tu-proveedor.com
MAIL_PORT=587
MAIL_USERNAME=<usuario>
MAIL_PASSWORD=<pwd>
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="no-reply@tu-dominio.com"
MAIL_FROM_NAME="${APP_NAME}"

# En el PRIMER deploy, pon esto en false si vas a importar el dump SQL a mano
# antes de que Laravel haga migrate. Luego ponlo en true (o elimínalo).
RUN_MIGRATIONS=false
```

## 3. Generar APP_KEY

Genera una clave una sola vez y pégala como variable `APP_KEY` en Coolify (si no, el entrypoint generará una transitoria en cada restart y se perderán las sesiones cifradas):

```bash
# desde cualquier máquina con PHP o openssl:
echo "base64:$(openssl rand -base64 32)"
```

## 4. Volúmenes persistentes (IMPORTANTE)

En la pestaña *Storages* de `crm-app`, añade estos volúmenes persistentes:

| Source (host / named volume) | Mount path en contenedor | Para qué |
|---|---|---|
| `crm_storage` | `/var/www/html/storage` | Logs, sessions (driver file), archivos subidos por usuarios |
| `crm_public_uploads` *(opcional)* | `/var/www/html/public/contratos` | Contratos PDF generados |

Sin el primer volumen **las sesiones se borran en cada redeploy** y los usuarios quedan deslogueados.

## 5. Puerto y dominio

- Puerto expuesto por la imagen: **8080**
- Coolify pondrá Traefik delante y generará cert Let's Encrypt automáticamente al asignar dominio.

## 6. Importar la base de datos existente

Tienes un dump en `C:\Users\Dani-Mefle\Desktop\Webs y CRM\Jsserviciosnauticos\crm_jsserviciosnauticos.sql`.

**Antes de importar — limpia contraseñas de prueba del dump:**

El usuario `admin@admin.com` tiene un hash conocido. Reemplázalo por uno tuyo. Genera un hash nuevo:

```bash
# con el CRM ya corriendo en cualquier entorno:
php artisan tinker
>>> Hash::make('TuPasswordSeguro123!');
# copia el string '$2y$10$...' resultante
```

Luego edita el dump:
```bash
sed -i "s|\$2y\$10\$WKVX3yMNBZy7fFRVVcvbMuz.H3TLet0SGzi40/di27wHfyc3IvOMy|<TU-NUEVO-HASH>|" crm_jsserviciosnauticos.sql
```

**Importar a Coolify:**

Opción A — vía terminal de Coolify en el contenedor MySQL:
```bash
# desde la UI de Coolify, abre terminal del servicio crm-db:
mysql -u crm -p crm_jsserviciosnauticos < /tmp/crm_jsserviciosnauticos.sql
# (primero sube el .sql al contenedor con 'Files' o scp)
```

Opción B — desde tu máquina contra el puerto expuesto temporalmente:
```bash
mysql -h <host-coolify> -P 3306 -u crm -p crm_jsserviciosnauticos \
  < crm_jsserviciosnauticos.sql
```

**Después del import**, cambia `RUN_MIGRATIONS=true` y redeploy. El entrypoint detectará que solo faltan las migraciones nuevas (`create_jobs_table` de abril 2026) y las ejecutará.

> ⚠️ **No uses `migrate:fresh`**. El dump tiene 3 tablas pivote (`servicio_presupuesto`, `pack_presupuesto`, `evento_presupuesto`) cuyos archivos PHP se borraron del repo pero cuyas tablas siguen existiendo. Un fresh las destruiría.

## 7. Primer arranque

1. Coolify hace `docker build` → tarda ~5–10 min la primera vez (composer install + npm build + php extensions).
2. El entrypoint corre:
   - Espera hasta 60s a que MySQL responda.
   - `storage:link`
   - `migrate --force` (si `RUN_MIGRATIONS=true`)
   - `config:cache`, `route:cache`, `view:cache`.
3. Supervisor arranca php-fpm y nginx.

Accede a `https://tu-dominio.com` y entra con el usuario admin cuyo hash cambiaste.

## 8. Troubleshooting

| Síntoma | Causa probable | Fix |
|---|---|---|
| `500 The stream or file "/var/www/html/storage/logs/laravel.log" could not be opened` | Permisos en volumen persistente | `docker exec -it <app> chown -R www-data:www-data storage` |
| `SQLSTATE[HY000] [2002]` | `DB_HOST` incorrecto o DB no levantó | Verifica nombre servicio MySQL y espera a que esté *running* |
| `CSRF token mismatch` tras redeploy | `APP_KEY` cambió (transitoria) | Fija `APP_KEY` explícito en env |
| `419 Page Expired` repetido | Sesiones en `file` sin volumen persistente | Añade volumen a `/var/www/html/storage` |
| Certificado de facturas falla | `ipoint.pfx` bloqueado por nginx (correcto) pero ruta relativa falla | El código usa CWD; verifica que php-fpm arranca con `cwd=/var/www/html/public` (ya lo hace por defecto) |

## 9. Después del primer deploy

- [ ] Cambia `admin@admin.com` → tu email real (vía UI o tinker)
- [ ] Revisa si los ~30 usuarios importados tienen emails activos (si no, desactívalos con `inactive=1`)
- [ ] Configura backups automáticos de MySQL en Coolify
- [ ] Quita los archivos `.xsig` viejos de `public/` si ya no son necesarios (eran de pruebas 2017/2023)
