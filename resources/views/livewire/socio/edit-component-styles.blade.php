<style>
/* Design System Variables */
:root {
    /* Colors */
    --primary-blue: #2563eb;
    --primary-blue-dark: #1d4ed8;
    --primary-blue-light: #3b82f6;
    --success-green: #22c55e;
    --success-green-dark: #16a34a;
    --warning-orange: #f59e0b;
    --warning-orange-dark: #d97706;
    --danger-red: #ef4444;
    --danger-red-dark: #dc2626;
    --gray-50: #f9fafb;
    --gray-100: #f3f4f6;
    --gray-200: #e5e7eb;
    --gray-300: #d1d5db;
    --gray-400: #9ca3af;
    --gray-500: #6b7280;
    --gray-600: #4b5563;
    --gray-700: #374151;
    --gray-800: #1f2937;
    --gray-900: #111827;
    
    /* Spacing */
    --space-1: 0.25rem;
    --space-2: 0.5rem;
    --space-3: 0.75rem;
    --space-4: 1rem;
    --space-5: 1.25rem;
    --space-6: 1.5rem;
    --space-8: 2rem;
    --space-10: 2.5rem;
    --space-12: 3rem;
    
    /* Typography */
    --font-size-xs: 0.75rem;
    --font-size-sm: 0.875rem;
    --font-size-base: 1rem;
    --font-size-lg: 1.125rem;
    --font-size-xl: 1.25rem;
    --font-size-2xl: 1.5rem;
    --font-size-3xl: 1.875rem;
    --font-size-4xl: 2.25rem;
    
    /* Border Radius */
    --border-radius-sm: 0.375rem;
    --border-radius: 0.5rem;
    --border-radius-lg: 0.75rem;
    --border-radius-xl: 1rem;
    
    /* Shadows */
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    
    /* Transitions */
    --transition-fast: 150ms ease-in-out;
    --transition-normal: 200ms ease-in-out;
    --transition-slow: 300ms ease-in-out;
}

/* Main Container */
.modern-edit-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: var(--space-6);
    background: var(--gray-50);
    min-height: 100vh;
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: var(--space-6);
    width: 100%;
    box-sizing: border-box;
    overflow-x: hidden;
}

/* Asegurar que el grid funcione correctamente */
.modern-edit-container > * {
    min-width: 0;
    overflow-x: hidden;
}

/* Asegurar que el contenido principal tenga margen derecho */
.form-section {
    margin-right: var(--space-4);
    width: 100%;
    max-width: 100%;
    overflow-x: hidden;
}

.sidebar-section {
    margin-left: var(--space-4);
    width: 100%;
    max-width: 100%;
}

/* Asegurar que las cards no se desborden */
.form-section-card,
.status-card,
.photo-upload-card,
.sidebar-card {
    width: 100%;
    max-width: 100%;
    box-sizing: border-box;
    overflow-x: hidden;
}

/* Header Section */
.header-section {
    grid-column: 1 / -1;
    background: white;
    border-radius: var(--border-radius-xl);
    padding: var(--space-8);
    margin-bottom: var(--space-6);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--gray-200);
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: var(--space-6);
    gap: var(--space-4);
}

.title-section {
    flex: 1;
}

.page-title {
    font-size: var(--font-size-4xl);
    font-weight: 700;
    color: var(--gray-900);
    margin: 0 0 var(--space-2) 0;
    display: flex;
    align-items: center;
    gap: var(--space-3);
}

.page-title i {
    color: var(--primary-blue);
    font-size: var(--font-size-3xl);
}

.page-subtitle {
    color: var(--gray-600);
    margin: 0;
    font-size: var(--font-size-lg);
}

.header-actions {
    display: flex;
    gap: var(--space-3);
}

.btn-back {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    background: var(--gray-100);
    color: var(--gray-700);
    text-decoration: none;
    padding: var(--space-3) var(--space-6);
    border-radius: var(--border-radius-lg);
    font-weight: 600;
    font-size: var(--font-size-base);
    transition: all var(--transition-normal);
    border: 1px solid var(--gray-200);
}

.btn-back:hover {
    background: var(--gray-200);
    color: var(--gray-900);
    text-decoration: none;
    transform: translateY(-1px);
}

/* Breadcrumb */
.breadcrumb-section {
    padding-top: var(--space-4);
    border-top: 1px solid var(--gray-200);
}

.breadcrumb {
    display: flex !important;
    align-items: center;
    gap: var(--space-1);
    margin: 0 !important;
    padding: 0 !important;
    list-style: none !important;
    flex-wrap: nowrap !important;
    background: transparent !important;
    border-radius: 0 !important;
    font-size: var(--font-size-sm);
    white-space: nowrap;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    max-width: 100%;
    box-sizing: border-box;
}

.breadcrumb-item {
    color: var(--gray-500);
    text-decoration: none;
    font-size: var(--font-size-sm);
    display: flex;
    align-items: center;
    gap: var(--space-1);
    padding: var(--space-1);
    border-radius: 4px;
    transition: all var(--transition-normal);
    white-space: nowrap;
    flex-shrink: 0;
}

.breadcrumb-item:hover {
    color: var(--primary-blue);
    background: rgba(37, 99, 235, 0.1);
    text-decoration: none;
}

.breadcrumb-item.active {
    color: var(--gray-700);
    font-weight: 500;
}

.breadcrumb-separator {
    color: var(--gray-400);
    font-size: var(--font-size-sm);
    white-space: nowrap;
    flex-shrink: 0;
}

/* Form Section */
.form-section {
    display: flex;
    flex-direction: column;
    gap: var(--space-6);
}

.form-container {
    display: flex;
    flex-direction: column;
    gap: var(--space-6);
}

/* Photos Section */
.photos-section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--space-6);
}

.photo-upload-card {
    background: white;
    border-radius: var(--border-radius-xl);
    padding: var(--space-6);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--gray-200);
}

.photo-header {
    margin-bottom: var(--space-4);
}

.photo-title {
    font-size: var(--font-size-xl);
    font-weight: 600;
    color: var(--gray-900);
    margin: 0;
    display: flex;
    align-items: center;
    gap: var(--space-2);
}

.photo-title i {
    color: var(--primary-blue);
}

.photo-content {
    display: flex;
    flex-direction: column;
    gap: var(--space-4);
}

.photo-preview {
    text-align: center;
}

.photo-image {
    max-width: 100%;
    max-height: 200px;
    border-radius: var(--border-radius-lg);
    border: 2px solid var(--gray-200);
    cursor: pointer;
    transition: all var(--transition-normal);
}

.photo-image:hover {
    border-color: var(--primary-blue);
    transform: scale(1.02);
}

.photo-upload {
    position: relative;
}

.photo-input {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
}

.photo-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: var(--space-2);
    padding: var(--space-6);
    border: 2px dashed var(--gray-300);
    border-radius: var(--border-radius-lg);
    background: var(--gray-50);
    cursor: pointer;
    transition: all var(--transition-normal);
    text-align: center;
}

.photo-label:hover {
    border-color: var(--primary-blue);
    background: rgba(37, 99, 235, 0.05);
}

.photo-label i {
    font-size: var(--font-size-2xl);
    color: var(--gray-400);
}

.photo-label span {
    font-weight: 500;
    color: var(--gray-600);
}

/* Status Section */
.status-section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--space-6);
}

.status-card {
    background: white;
    border-radius: var(--border-radius-xl);
    padding: var(--space-6);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--gray-200);
}

.section-title {
    font-size: var(--font-size-xl);
    font-weight: 600;
    color: var(--gray-900);
    margin: 0 0 var(--space-4) 0;
    display: flex;
    align-items: center;
    gap: var(--space-2);
}

.section-title i {
    color: var(--primary-blue);
}

.status-buttons {
    display: flex;
    gap: var(--space-2);
    margin-bottom: var(--space-4);
}

.status-btn {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: var(--space-2);
    padding: var(--space-4);
    border: 2px solid var(--gray-200);
    border-radius: var(--border-radius-lg);
    background: white;
    cursor: pointer;
    transition: all var(--transition-normal);
    font-weight: 500;
}

.status-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

/* Colores para Situación del Barco */
.status-barco-atraque {
    border-color: #22c55e !important;
    color: #22c55e !important;
}
.status-barco-atraque.active {
    background: #22c55e !important;
    color: white !important;
    border-color: #22c55e !important;
}
.status-barco-atraque:hover:not(.active) {
    border-color: #16a34a !important;
    color: #16a34a !important;
    background: rgba(34, 197, 94, 0.05) !important;
}

.status-barco-varada {
    border-color: #ef4444 !important;
    color: #ef4444 !important;
}
.status-barco-varada.active {
    background: #ef4444 !important;
    color: white !important;
    border-color: #ef4444 !important;
}
.status-barco-varada:hover:not(.active) {
    border-color: #dc2626 !important;
    color: #dc2626 !important;
    background: rgba(239, 68, 68, 0.05) !important;
}

/* Colores para Tipo de Persona */
.status-persona-socio {
    border-color: #22c55e !important;
    color: #22c55e !important;
}
.status-persona-socio.active {
    background: #22c55e !important;
    color: white !important;
    border-color: #22c55e !important;
}
.status-persona-socio:hover:not(.active) {
    border-color: #16a34a !important;
    color: #16a34a !important;
    background: rgba(34, 197, 94, 0.05) !important;
}

.status-persona-transeunte {
    border-color: #ef4444 !important;
    color: #ef4444 !important;
}
.status-persona-transeunte.active {
    background: #ef4444 !important;
    color: white !important;
    border-color: #ef4444 !important;
}
.status-persona-transeunte:hover:not(.active) {
    border-color: #dc2626 !important;
    color: #dc2626 !important;
    background: rgba(239, 68, 68, 0.05) !important;
}

.status-persona-mixto {
    border-color: #f59e0b !important;
    color: #f59e0b !important;
}
.status-persona-mixto.active {
    background: #f59e0b !important;
    color: white !important;
    border-color: #f59e0b !important;
}
.status-persona-mixto:hover:not(.active) {
    border-color: #d97706 !important;
    color: #d97706 !important;
    background: rgba(245, 158, 11, 0.05) !important;
}

.status-btn i {
    font-size: var(--font-size-lg);
}

.date-input-group {
    display: flex;
    flex-direction: column;
    gap: var(--space-2);
}

/* Form Section Cards */
.form-section-card {
    background: white;
    border-radius: var(--border-radius-xl);
    padding: var(--space-6);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--gray-200);
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--space-4);
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: var(--space-4);
}

.input-group {
    display: flex;
    flex-direction: column;
    gap: var(--space-2);
}

.input-group.full-width {
    grid-column: 1 / -1;
}

.input-label {
    font-weight: 500;
    color: var(--gray-700);
    font-size: var(--font-size-sm);
}

.modern-input {
    padding: var(--space-3) var(--space-4);
    border: 2px solid var(--gray-200);
    border-radius: var(--border-radius-lg);
    font-size: var(--font-size-base);
    transition: all var(--transition-normal);
    background: white;
}

.modern-input:focus {
    outline: none;
    border-color: var(--primary-blue);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.modern-input:hover {
    border-color: var(--gray-300);
}

.error-message {
    color: var(--danger-red);
    font-size: var(--font-size-sm);
    font-weight: 500;
}

/* Dynamic Lists */
.dynamic-list {
    display: flex;
    flex-direction: column;
    gap: var(--space-3);
}

.dynamic-item {
    display: flex;
    align-items: flex-end;
    gap: var(--space-3);
    padding: var(--space-4);
    background: var(--gray-50);
    border-radius: var(--border-radius-lg);
    border: 1px solid var(--gray-200);
}

.item-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: var(--space-2);
}

.btn-add {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    padding: var(--space-2) var(--space-4);
    background: var(--primary-blue);
    color: white;
    border: none;
    border-radius: var(--border-radius);
    font-size: var(--font-size-sm);
    font-weight: 500;
    cursor: pointer;
    transition: all var(--transition-normal);
}

.btn-add:hover {
    background: var(--primary-blue-dark);
    transform: translateY(-1px);
}

.btn-remove {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    background: var(--danger-red);
    color: white;
    border: none;
    border-radius: var(--border-radius);
    cursor: pointer;
    transition: all var(--transition-normal);
}

.btn-remove:hover {
    background: var(--danger-red-dark);
    transform: scale(1.1);
}

/* Notes Section */
.notes-list {
    display: flex;
    flex-direction: column;
    gap: var(--space-4);
    margin-bottom: var(--space-4);
}

.note-item {
    padding: var(--space-4);
    background: var(--gray-50);
    border-radius: var(--border-radius-lg);
    border: 1px solid var(--gray-200);
}

.note-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--space-2);
}

.note-date {
    font-weight: 600;
    color: var(--gray-700);
    font-size: var(--font-size-sm);
}

.note-user {
    font-size: var(--font-size-xs);
    color: var(--gray-500);
    background: var(--gray-200);
    padding: var(--space-1) var(--space-2);
    border-radius: var(--border-radius);
}

.note-content {
    color: var(--gray-700);
    margin-bottom: var(--space-3);
    line-height: 1.5;
}

.note-actions {
    display: flex;
    gap: var(--space-2);
}

.btn-edit-note {
    display: flex;
    align-items: center;
    gap: var(--space-1);
    padding: var(--space-2) var(--space-3);
    background: var(--gray-600);
    color: white;
    border: none;
    border-radius: var(--border-radius);
    font-size: var(--font-size-xs);
    cursor: pointer;
    transition: all var(--transition-normal);
}

.btn-edit-note:hover {
    background: var(--gray-700);
}

.btn-add-note {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--space-2);
    width: 100%;
    padding: var(--space-3) var(--space-4);
    background: var(--primary-blue);
    color: white;
    border: none;
    border-radius: var(--border-radius-lg);
    font-weight: 600;
    cursor: pointer;
    transition: all var(--transition-normal);
}

.btn-add-note:hover {
    background: var(--primary-blue-dark);
    transform: translateY(-1px);
}

/* Tables */
.table-container {
    overflow-x: auto;
    border-radius: var(--border-radius-lg);
    border: 1px solid var(--gray-200);
}

.modern-table {
    width: 100%;
    border-collapse: collapse;
    font-size: var(--font-size-sm);
}

.modern-table th {
    background: var(--gray-50);
    padding: var(--space-3) var(--space-4);
    text-align: left;
    font-weight: 600;
    color: var(--gray-700);
    border-bottom: 1px solid var(--gray-200);
}

.modern-table td {
    padding: var(--space-3) var(--space-4);
    border-bottom: 1px solid var(--gray-200);
}

.modern-table tr:last-child td {
    border-bottom: none;
}

/* Subsections */
.subsection {
    margin-bottom: var(--space-6);
}

.subsection-title {
    font-size: var(--font-size-lg);
    font-weight: 600;
    color: var(--gray-800);
    margin: 0;
}

/* Sidebar */
.sidebar-section {
    display: flex;
    flex-direction: column;
    gap: var(--space-4);
}

.sidebar-card {
    background: white;
    border-radius: var(--border-radius-xl);
    padding: var(--space-6);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--gray-200);
}

.sidebar-title {
    font-size: var(--font-size-lg);
    font-weight: 600;
    color: var(--gray-900);
    margin: 0 0 var(--space-4) 0;
    display: flex;
    align-items: center;
    gap: var(--space-2);
}

.sidebar-title i {
    color: var(--primary-blue);
}

.action-buttons {
    display: flex;
    flex-direction: column;
    gap: var(--space-3);
}

.action-btn {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    padding: var(--space-3) var(--space-4);
    border: none;
    border-radius: var(--border-radius-lg);
    font-weight: 600;
    cursor: pointer;
    transition: all var(--transition-normal);
    text-decoration: none;
    width: 100%;
    justify-content: flex-start;
}

.action-btn.btn-success {
    background: var(--success-green);
    color: white;
}

.action-btn.btn-success:hover {
    background: var(--success-green-dark);
    transform: translateY(-1px);
}

.action-btn.btn-warning {
    background: var(--warning-orange);
    color: white;
}

.action-btn.btn-warning:hover {
    background: var(--warning-orange-dark);
    transform: translateY(-1px);
}

.action-btn.btn-danger {
    background: var(--danger-red);
    color: white;
}

.action-btn.btn-danger:hover {
    background: var(--danger-red-dark);
    transform: translateY(-1px);
}

/* Fixed Save Button */
.fixed-save-button {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: transparent;
    border-top: none;
    padding: var(--space-2);
    z-index: 1000;
    box-shadow: none;
}

.btn-save-fixed {
    width: 100%;
    max-width: none;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--space-2);
    background: var(--success-green);
    color: white;
    border: none;
    padding: var(--space-3) var(--space-4);
    border-radius: var(--border-radius-lg);
    font-size: var(--font-size-base);
    font-weight: 600;
    cursor: pointer;
    transition: all var(--transition-normal);
    box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
    outline: none;
}

.btn-save-fixed:hover {
    background: var(--success-green-dark);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(34, 197, 94, 0.4);
}

.btn-save-fixed:active {
    transform: translateY(0);
    box-shadow: 0 2px 8px rgba(34, 197, 94, 0.3);
    background: #0c8f64;
}

.btn-save-fixed:focus {
    outline: none;
    box-shadow: 0 2px 8px rgba(34, 197, 94, 0.3);
    background: #0c8f64;
}

.btn-save-fixed:focus:not(:active) {
    transform: none;
    box-shadow: 0 2px 8px rgba(34, 197, 94, 0.3);
    background: #0c8f64;
}

/* Modal Styles */
.modal-content {
    border-radius: var(--border-radius-xl);
    border: none;
    box-shadow: var(--shadow-xl);
}

.modal-header {
    border-bottom: 1px solid var(--gray-200);
    padding: var(--space-6);
}

.modal-title {
    font-weight: 600;
    color: var(--gray-900);
}

.modal-body {
    padding: var(--space-6);
}

.modal-footer {
    border-top: 1px solid var(--gray-200);
    padding: var(--space-6);
}

/* Record Items */
.record-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--space-3) var(--space-4);
    background: var(--gray-50);
    border-radius: var(--border-radius);
    margin-bottom: var(--space-2);
}

.record-status {
    font-size: var(--font-size-sm);
    font-weight: 500;
    padding: var(--space-1) var(--space-2);
    border-radius: var(--border-radius);
}

.status-atraque {
    background: rgba(34, 197, 94, 0.1);
    color: var(--success-green-dark);
}

.status-varada {
    background: rgba(239, 68, 68, 0.1);
    color: var(--danger-red-dark);
}

/* Responsive Design */
@media (max-width: 1400px) {
    .modern-edit-container {
        max-width: 100%;
        padding: var(--space-4);
    }
}

@media (max-width: 1200px) {
    .modern-edit-container {
        grid-template-columns: 1fr;
        gap: var(--space-4);
        padding: var(--space-4);
        max-width: 100%;
    }
    
    .sidebar-section {
        order: -1;
    }
    
    /* Resetear márgenes en pantallas medianas */
    .form-section {
        margin-right: 0;
    }
    
    .sidebar-section {
        margin-left: 0;
    }
}

@media (max-width: 768px) {
    .modern-edit-container {
        padding: var(--space-2);
        grid-template-columns: 1fr;
        gap: var(--space-3);
        width: 100%;
        max-width: 100%;
        overflow-x: hidden;
    }
    
    /* Resetear márgenes en móvil */
    .form-section {
        margin-right: 0;
    }
    
    .sidebar-section {
        margin-left: 0;
    }
    
    .header-section {
        padding: var(--space-4);
        margin-bottom: var(--space-4);
    }
    
    .header-content {
        flex-direction: column;
        align-items: stretch;
        gap: var(--space-3);
    }
    
    .photos-section {
        grid-template-columns: 1fr;
        gap: var(--space-4);
    }
    
    .status-section {
        grid-template-columns: 1fr;
        gap: var(--space-4);
    }
    
    .form-grid {
        grid-template-columns: 1fr;
        gap: var(--space-3);
    }
    
    .dynamic-item {
        flex-direction: column;
        align-items: stretch;
        gap: var(--space-2);
    }
    
    .btn-remove {
        align-self: flex-end;
    }
    
    .sidebar-section {
        order: -1;
        gap: var(--space-3);
    }
    
    .sidebar-card {
        padding: var(--space-4);
    }
    
    .action-buttons {
        gap: var(--space-2);
    }
    
    .action-btn {
        padding: var(--space-2) var(--space-3);
        font-size: var(--font-size-sm);
    }
    
    /* Breadcrumb más compacto en móvil */
    .breadcrumb {
        gap: 4px;
        font-size: 12px;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    .breadcrumb-item {
        padding: 2px 4px;
        font-size: 12px;
        flex-shrink: 0;
    }
    
    .breadcrumb-item i {
        font-size: 10px;
    }
    
    .breadcrumb-separator {
        font-size: 12px;
        flex-shrink: 0;
    }
    
    /* Asegurar que no se desborde */
    .form-section-card,
    .status-card,
    .photo-upload-card {
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
    }
    
    .table-container {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
}

@media (max-width: 480px) {
    .modern-edit-container {
        padding: var(--space-1);
    }
    
    .page-title {
        font-size: var(--font-size-2xl);
    }
    
    .status-buttons {
        flex-direction: column;
        gap: var(--space-2);
    }
    
    .action-buttons {
        gap: var(--space-2);
    }
    
    .action-btn {
        padding: var(--space-2) var(--space-3);
        font-size: var(--font-size-sm);
    }
    
    .header-section {
        padding: var(--space-3);
    }
    
    .form-section-card,
    .status-card,
    .photo-upload-card,
    .sidebar-card {
        padding: var(--space-3);
    }
}

body {
    padding-bottom: 80px; /* Adjust for fixed button height */
    overflow-x: hidden;
}

/* Asegurar que todos los elementos respeten el ancho */
* {
    box-sizing: border-box;
}

/* Prevenir desbordamiento horizontal */
.modern-edit-container * {
    max-width: 100%;
}

/* Ajustes específicos para elementos que pueden desbordarse */
.modern-input,
.photo-label,
.btn-add,
.btn-remove,
.action-btn {
    max-width: 100%;
    word-wrap: break-word;
}

/* Asegurar que las tablas no desborden */
.modern-table {
    table-layout: fixed;
    width: 100%;
}

.modern-table td,
.modern-table th {
    word-wrap: break-word;
    overflow-wrap: break-word;
}

/* Forzar espacio y posición del botón fijo en móvil para no solaparse con el bottom nav */
@media (max-width: 768px) {
    .modern-edit-container { padding-bottom: 90px !important; }
    .fixed-save-button { bottom: 64px !important; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Initialize any necessary components
    initializeModals();
    initializeDatePickers();
});

function initializeModals() {
    // Modal event listeners
    window.addEventListener('closeModal', event => {
        $('#modal-create').modal('hide');
        $('#modal-edit').modal('hide');
    });
}

function initializeDatePickers() {
    // Initialize date pickers if needed
    $('.modern-input[type="date"]').on('change', function() {
        // Handle date changes if needed
    });
}

// SweetAlert2 confirmations
$("#alertaAceptar").on("click", () => {
    Swal.fire({
        title: '¿Estás seguro? Comprueba que todo está en orden.',
        icon: 'warning',
        text: 'Si estás seguro, pulsa el botón de "Confirmar" para imprimir el socio.',
        showConfirmButton: true,
        showCancelButton: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.livewire.emit('imprecionSocio');
        }
    });
});

$("#alertaCancelar").on("click", () => {
    Swal.fire({
        title: '¿Estás seguro?',
        icon: 'error',
        text: 'Si estás seguro, pulsa el botón de "Confirmar" para imprimir contrato.',
        showConfirmButton: true,
        showCancelButton: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.livewire.emit('confirmedImprimir');
        }
    });
});

$("#alertaEliminar").on("click", () => {
    Swal.fire({
        title: '¿Estás seguro? No se podrá revertir la acción.',
        icon: 'error',
        text: 'Si estás seguro, pulsa el botón de "Confirmar" para eliminar el socio.',
        showConfirmButton: true,
        showCancelButton: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.livewire.emit('destroy');
        }
    });
});

$("#alertaGuardar").on("click", () => {
    Swal.fire({
        title: '¿Estás seguro? Comprueba que todo está en orden.',
        icon: 'warning',
        text: 'Si estás seguro, pulsa el botón de "Confirmar" para guardar el socio.',
        showConfirmButton: true,
        showCancelButton: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.livewire.emit('updateEvento');
        }
    });
});

$("#alertaImpresion").on("click", () => {
    Swal.fire({
        title: '¿Estás seguro? Comprueba que todo está en orden.',
        icon: 'warning',
        text: 'Si estás seguro, pulsa el botón de "Confirmar" para imprimir el socio.',
        showConfirmButton: true,
        showCancelButton: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.livewire.emit('imprecionSocio');
        }
    });
});

// Forzar apertura del modal de registros (se pierde tras renders de Livewire)
function bindOpenRegistros(){
    $(document).off('click', '#btnRegistros');
    $(document).on('click', '#btnRegistros', function(){
        $('#modal-registros').modal('show');
    });
}
bindOpenRegistros();

// Livewire hooks
document.addEventListener('livewire:load', function() {
    window.livewire.hook('message.processed', (message, component) => {
        // Reinitialize components after Livewire updates
        initializeDatePickers();
        bindOpenRegistros();
    });
});
</script>
