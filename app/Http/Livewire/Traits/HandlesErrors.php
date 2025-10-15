<?php

namespace App\Http\Livewire\Traits;

use Illuminate\Support\Facades\Log;

trait HandlesErrors
{
    /**
     * Muestra un modal de error usando SweetAlert2
     *
     * @param string $title
     * @param string $message
     * @param string $type
     * @return void
     */
    protected function showErrorModal($title, $message, $type = 'error')
    {
        $this->dispatchBrowserEvent('show-error-modal', [
            'title' => $title,
            'message' => $message,
            'type' => $type
        ]);
    }

    /**
     * Muestra un modal de éxito usando SweetAlert2
     *
     * @param string $title
     * @param string $message
     * @return void
     */
    protected function showSuccessModal($title, $message = '')
    {
        $this->dispatchBrowserEvent('show-success-modal', [
            'title' => $title,
            'message' => $message
        ]);
    }

    /**
     * Maneja excepciones y muestra mensajes amigables al usuario
     *
     * @param \Exception $e
     * @param string $context
     * @return void
     */
    protected function handleException(\Exception $e, $context = '')
    {
        $message = $this->getUserFriendlyMessage($e);
        $this->showErrorModal('Error', $message, 'error');
        
        // Log para desarrollo
        Log::error("Error en {$context}: " . $e->getMessage(), [
            'exception' => $e,
            'user_id' => auth()->id(),
            'context' => $context
        ]);
    }

    /**
     * Convierte mensajes técnicos de excepciones en mensajes amigables para el usuario
     *
     * @param \Exception $e
     * @return string
     */
    private function getUserFriendlyMessage(\Exception $e)
    {
        if ($e instanceof \Illuminate\Database\QueryException) {
            if (str_contains($e->getMessage(), 'telefonos.telefono')) {
                return 'Error al guardar el teléfono. Por favor, verifica que el número sea válido.';
            }
            if (str_contains($e->getMessage(), 'Duplicate entry')) {
                return 'Ya existe un registro con estos datos. Por favor, verifica la información.';
            }
            if (str_contains($e->getMessage(), 'foreign key constraint')) {
                return 'No se puede realizar esta acción porque hay datos relacionados.';
            }
            return 'Error en la base de datos. Por favor, inténtalo de nuevo.';
        }
        
        if ($e instanceof \Illuminate\Validation\ValidationException) {
            return 'Por favor, corrige los errores en el formulario.';
        }
        
        return 'Ha ocurrido un error inesperado. Por favor, inténtalo de nuevo.';
    }

    /**
     * Limpia y valida números de teléfono
     *
     * @param array $telefonos
     * @return array
     */
    protected function limpiarTelefonos($telefonos)
    {
        $limpios = [];
        foreach ($telefonos as $telefono) {
            if (isset($telefono['telefono']) && !empty(trim($telefono['telefono']))) {
                $numero = preg_replace('/\D+/', '', $telefono['telefono']);
                if (!empty($numero) && strlen($numero) >= 7 && strlen($numero) <= 15) {
                    $limpios[] = $numero;
                }
            }
        }
        return $limpios;
    }
}

