<?php

use App\Http\Controllers\CajaController;
use App\Http\Controllers\SocioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\BudgetReferenceAutopincrementsController;
use App\Http\Controllers\BudgetStatuController;
use App\Http\Controllers\ClientsEmailController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ProjectPriorityController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\ArticulosController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\IvaController;
use App\Http\Controllers\ProductosCategoriesController;
use App\Http\Controllers\DepartamentosUserController;
use App\Http\Controllers\TipoGastoController;
use App\Http\Controllers\CategoriaEventoController;
use App\Http\Controllers\TipoEventoController;


use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ServicioCategoriaController;
use App\Http\Controllers\ServicioPackController;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ResumenDiaController;
use App\Http\Controllers\ResumenSemanaController;
use App\Http\Controllers\ResumenMensualController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\MapKitController;
use App\Http\Livewire\Facturas\EditComponent;
use App\Http\Livewire\Facturas\IndexComponent as FacturasIndexComponent;
use App\Http\Livewire\Productos\IndexComponent;
use App\Http\Controllers\AgendaController;

use App\Http\Middleware\IsAdmin;
use FontLib\Table\Type\name;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::name('inicio')->get('/', function () {
    return view('auth.login');
});


//Route::get('/clients', [App\Http\Controllers\ClientController::class, 'index'])->name('clients.index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');




Route::group(['middleware' => 'is.admin','prefix' => 'admin'], function () {

    /* --------------------------------------- */

    // RECORDATORIO: IMPORTAR CONTROLADORES NUEVOS
    // Alumnos


    Route::get('socios', [SocioController::class, 'index'])->name('socios.index');
    Route::get('socios-todos', [SocioController::class, 'indexadmin'])->name('socios.indexadmin');
    Route::get('socios-create', [SocioController::class, 'create'])->name('socios.create');
    Route::get('socios-alta/{id}', [SocioController::class, 'alta'])->name('socios.alta');
    Route::get('socios-edit/{id}', [SocioController::class, 'edit'])->name('socios.edit');
    Route::get('socios/{id}/registros', [SocioController::class, 'registros'])->name('socios.registros');
    Route::put('socios-update/{id}', [SocioController::class, 'update'])->name('socios.update');

    // Galería fotos: destacar/eliminar (sin duplicar prefijo 'admin')
    Route::post('socios/{id}/foto-barco/{fotoId}/destacar', [SocioController::class, 'destacarBarcoFoto'])->name('socios.foto_barco.destacar');
    Route::delete('socios/{id}/foto-barco/{fotoId}', [SocioController::class, 'eliminarBarcoFoto'])->name('socios.foto_barco.eliminar');
    Route::post('socios/{id}/foto-socio/{fotoId}/destacar', [SocioController::class, 'destacarSocioFoto'])->name('socios.foto_socio.destacar');
    Route::delete('socios/{id}/foto-socio/{fotoId}', [SocioController::class, 'eliminarSocioFoto'])->name('socios.foto_socio.eliminar');

    Route::get('club', [ClubController::class, 'index'])->name('club.index');
    Route::get('club-create', [ClubController::class, 'create'])->name('club.create');
    Route::get('club-edit/{id}', [ClubController::class, 'edit'])->name('club.edit');

    // Registrar usuarios
    Route::get('usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('usuarios-create', [UsuarioController::class, 'create'])->name('usuarios.create');
    Route::get('usuarios-edit/{id}', [UsuarioController::class, 'edit'])->name('usuarios.edit');

    // Facturas
    Route::get('facturas', [FacturaController::class, 'index'])->name('facturas.index');
    Route::get('facturas-create', [FacturaController::class, 'create'])->name('facturas.create');
    Route::get('facturas-edit/{id}', [FacturaController::class, 'edit'])->name('facturas.edit');
    Route::get('factura/pdf/{id}', [FacturaController::class, 'pdf'])->name('facturas.pdf');
    Route::get('certificado/{id}', [FacturaController::class, 'certificado'])->name('certificado.pdf');

    // Settings
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::get('agenda', [AgendaController::class, 'index'])->name('agenda.index');

    // Settings
    Route::get('clients', [ClientsController::class, 'index'])->name('clients.index');
    Route::get('clients/create', [ClientsController::class, 'create'])->name('clients.create');
    Route::get('clients/edit/{id}', [ClientsController::class, 'edit'])->name('clients.edit');

    // Exportaciones
    Route::get('socios-export/excel', [App\Http\Controllers\ExportController::class, 'sociosExcel'])->name('socios.export.excel');
    Route::get('socios-export/pdf', [App\Http\Controllers\ExportController::class, 'sociosPdf'])->name('socios.export.pdf');
    Route::get('club-export/excel', [App\Http\Controllers\ExportController::class, 'clubesExcel'])->name('club.export.excel');
    Route::get('club-export/pdf', [App\Http\Controllers\ExportController::class, 'clubesPdf'])->name('club.export.pdf');
    Route::get('usuarios-export/excel', [App\Http\Controllers\ExportController::class, 'usuariosExcel'])->name('usuarios.export.excel');
    Route::get('usuarios-export/pdf', [App\Http\Controllers\ExportController::class, 'usuariosPdf'])->name('usuarios.export.pdf');


});
