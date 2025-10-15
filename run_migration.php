<?php

// Script simple para ejecutar la migración de telefonos
require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

// Configuración de la base de datos (ajusta según tu configuración)
$capsule = new Capsule;

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', '3306'),
    'database' => env('DB_DATABASE', 'forge'),
    'username' => env('DB_USERNAME', 'forge'),
    'password' => env('DB_PASSWORD', ''),
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
    'strict' => true,
    'engine' => null,
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

try {
    // Ejecutar la migración
    Capsule::schema()->table('telefonos', function ($table) {
        $table->string('telefono', 20)->nullable()->change();
    });
    
    echo "✅ Migración ejecutada correctamente. Columna 'telefono' cambiada a VARCHAR(20) NULL\n";
    
} catch (Exception $e) {
    echo "❌ Error ejecutando migración: " . $e->getMessage() . "\n";
}

