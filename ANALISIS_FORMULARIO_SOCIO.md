# ANÁLISIS COMPLETO - FORMULARIO CREAR SOCIO

## 📋 VARIABLES Y CAMPOS IDENTIFICADOS

### Variables del Componente Livewire:
- `$club_id` - ID del club (automático)
- `$situacion_persona` - 0=Socio, 1=Transeúnte, 2=Socio/Transeúnte
- `$situacion_barco` - 0=Atraque, 1=Varada
- `$numero_socio` - Número de socio
- `$nombre_socio` - Nombre del socio (OBLIGATORIO)
- `$dni` - DNI
- `$direccion` - Dirección
- `$email` - Email
- `$pantalan_t_atraque` - Pantalán y atraque
- `$nombre_barco` - Nombre del barco
- `$matricula` - Matrícula
- `$eslora` - Eslora
- `$manga` - Manga
- `$calado` - Calado
- `$puntal` - Puntal
- `$seguro_barco` - Seguro del barco
- `$poliza` - Póliza
- `$vencimiento` - Fecha de vencimiento
- `$itb` - ITB
- `$ruta_foto` - Foto del barco
- `$ruta_foto2` - Foto del socio
- `$pin_socio` - PIN del socio
- `$alta_baja` - Estado alta/baja
- `$atraque_fijo` - Atraque fijo
- `$fecha_entrada` - Fecha de entrada
- `$fecha_entrada_transeunte` - Fecha entrada transeúnte

### Arrays Dinámicos:
- `$telefonos[]` - Array de teléfonos
- `$numeros_llave[]` - Array de números de llave
- `$tripulantes[]` - Array de tripulantes (solo si es transeúnte)

## 🎯 FUNCIONALIDADES IDENTIFICADAS

### Botones de Acción:
- `wire:click="cambiarSituacionBarco(0/1)"` - Cambiar situación del barco
- `wire:click="cambiarSituacionPersona(0/1/2)"` - Cambiar situación de persona
- `wire:click="addTelefono"` - Añadir teléfono
- `wire:click="deleteTelefono(index)"` - Eliminar teléfono
- `wire:click="addNumeroLlave"` - Añadir número de llave
- `wire:click="deleteNumeroLlave(index)"` - Eliminar número de llave
- `wire:click="addTripulante"` - Añadir tripulante
- `wire:click="deleteTripulante(index)"` - Eliminar tripulante
- `wire:click.prevent="submit"` - Guardar socio

### Validaciones:
- `@error('nombre_socio')` - Error nombre obligatorio
- `@error('situacion_persona')` - Error situación persona obligatoria
- `@error('situacion_barco')` - Error situación barco obligatoria
- `@error('ruta_foto')` - Error foto barco
- `@error('ruta_foto2')` - Error foto socio

### Condicionales:
- `@if ($situacion_persona == 1 || $situacion_persona == 2)` - Mostrar sección tripulantes
- `@if ($ruta_foto)` - Mostrar preview foto barco
- `@if ($ruta_foto2)` - Mostrar preview foto socio
- `@mobile/@elsemobile` - Versiones móvil y desktop

## 🎨 PROBLEMAS DE DISEÑO ACTUAL

### Responsive:
- Tablas con colspan que no se adaptan bien
- Botones muy grandes en móvil
- Texto vertical "Socio/Transeúnte" mal posicionado
- Espaciado inconsistente
- Colores duros (#3b996d, #dc3545)

### UX:
- Formulario muy largo
- No hay agrupación lógica de campos
- Falta feedback visual
- Navegación confusa
- No hay indicadores de progreso

## 🎯 OBJETIVOS DEL NUEVO DISEÑO

### Estilo App Moderno:
- Cards con sombras suaves
- Colores más suaves y profesionales
- Espaciado consistente
- Tipografía moderna
- Iconos descriptivos
- Animaciones sutiles

### Responsive:
- Mobile-first approach
- Grid system flexible
- Botones táctiles apropiados
- Formulario en pasos/secciones
- Navegación intuitiva

### Funcionalidades a Mantener:
- TODAS las variables existentes
- TODOS los wire:click
- TODAS las validaciones
- TODOS los condicionales
- Arrays dinámicos (teléfonos, llaves, tripulantes)
- Upload de imágenes
- Preview de imágenes


