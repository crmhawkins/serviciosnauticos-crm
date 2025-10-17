# 🎨 DESIGN SYSTEM - CRM NÁUTICO

## 🎨 PALETA DE COLORES

### Colores Primarios:
```css
--primary-blue: #2563eb;        /* Azul principal */
--primary-blue-light: #3b82f6;  /* Azul claro */
--primary-blue-dark: #1d4ed8;   /* Azul oscuro */
```

### Colores Secundarios:
```css
--secondary-teal: #0d9488;      /* Verde azulado */
--secondary-teal-light: #14b8a6; /* Verde azulado claro */
--secondary-teal-dark: #0f766e;  /* Verde azulado oscuro */
```

### Colores de Estado:
```css
--success-green: #10b981;       /* Verde éxito */
--warning-orange: #f59e0b;      /* Naranja advertencia */
--error-red: #ef4444;           /* Rojo error */
--info-blue: #06b6d4;           /* Azul información */
```

### Colores Neutros:
```css
--gray-50: #f9fafb;            /* Fondo muy claro */
--gray-100: #f3f4f6;           /* Fondo claro */
--gray-200: #e5e7eb;           /* Borde claro */
--gray-300: #d1d5db;           /* Borde medio */
--gray-400: #9ca3af;           /* Texto secundario */
--gray-500: #6b7280;           /* Texto medio */
--gray-600: #4b5563;           /* Texto principal */
--gray-700: #374151;           /* Texto oscuro */
--gray-800: #1f2937;           /* Texto muy oscuro */
--gray-900: #111827;           /* Texto negro */
```

## 📐 ESPACIADO Y TIPOGRAFÍA

### Espaciado:
```css
--space-1: 0.25rem;   /* 4px */
--space-2: 0.5rem;    /* 8px */
--space-3: 0.75rem;   /* 12px */
--space-4: 1rem;      /* 16px */
--space-5: 1.25rem;   /* 20px */
--space-6: 1.5rem;    /* 24px */
--space-8: 2rem;      /* 32px */
--space-10: 2.5rem;   /* 40px */
--space-12: 3rem;     /* 48px */
--space-16: 4rem;     /* 64px */
```

### Tipografía:
```css
--font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
--font-size-xs: 0.75rem;    /* 12px */
--font-size-sm: 0.875rem;   /* 14px */
--font-size-base: 1rem;     /* 16px */
--font-size-lg: 1.125rem;   /* 18px */
--font-size-xl: 1.25rem;    /* 20px */
--font-size-2xl: 1.5rem;    /* 24px */
--font-size-3xl: 1.875rem;  /* 30px */
```

## 🎯 COMPONENTES BASE

### Cards:
```css
.card-modern {
  background: white;
  border-radius: 12px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  border: 1px solid var(--gray-200);
  padding: var(--space-6);
  margin-bottom: var(--space-6);
}
```

### Botones:
```css
.btn-primary {
  background: var(--primary-blue);
  color: white;
  border: none;
  border-radius: 8px;
  padding: var(--space-3) var(--space-6);
  font-weight: 500;
  transition: all 0.2s;
}

.btn-primary:hover {
  background: var(--primary-blue-dark);
  transform: translateY(-1px);
}
```

### Inputs:
```css
.input-modern {
  width: 100%;
  padding: var(--space-3) var(--space-4);
  border: 2px solid var(--gray-200);
  border-radius: 8px;
  font-size: var(--font-size-base);
  transition: border-color 0.2s;
}

.input-modern:focus {
  outline: none;
  border-color: var(--primary-blue);
  box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}
```

### Estados de Selección:
```css
.status-atraque {
  background: var(--success-green);
  color: white;
}

.status-varada {
  background: var(--warning-orange);
  color: white;
}

.status-socio {
  background: var(--primary-blue);
  color: white;
}

.status-transeunte {
  background: var(--secondary-teal);
  color: white;
}
```

## 📱 RESPONSIVE BREAKPOINTS

```css
--mobile: 640px;
--tablet: 768px;
--desktop: 1024px;
--wide: 1280px;
```

## 🎨 ICONOS Y ELEMENTOS VISUALES

### Iconos por Sección:
- 🚤 Barco: `fas fa-ship`
- 👤 Socio: `fas fa-user`
- 🏠 Atraque: `fas fa-anchor`
- 📱 Teléfono: `fas fa-phone`
- 🔑 Llave: `fas fa-key`
- 📧 Email: `fas fa-envelope`
- 📅 Fecha: `fas fa-calendar`
- 📄 Documento: `fas fa-file-alt`
- 🖼️ Imagen: `fas fa-image`
- ➕ Añadir: `fas fa-plus`
- ❌ Eliminar: `fas fa-times`

## 🎯 ESTRUCTURA DE LAYOUT

### Mobile First:
1. Header con título y breadcrumb
2. Secciones en cards apiladas
3. Botones de estado grandes y táctiles
4. Formulario en una columna
5. Sidebar colapsable

### Desktop:
1. Header completo
2. Layout de 2 columnas (formulario + sidebar)
3. Secciones organizadas en grid
4. Botones más compactos
5. Sidebar fijo

## 🎨 ANIMACIONES

```css
--transition-fast: 0.15s ease;
--transition-normal: 0.2s ease;
--transition-slow: 0.3s ease;

.fade-in {
  animation: fadeIn var(--transition-normal);
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}
```

