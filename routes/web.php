<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', 'Auth\LoginController@showLoginForm');
// Route::get('/', function () {
//     return view('auth.login');

//     LoginController@showLoginForm
// });

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::resource('barrio', 'Barrio\BarrioController');
    Route::resource('cargo', 'Cargo\CargoController');
    Route::resource('distrito', 'Distrito\DistritoController');
    Route::resource('especialidad', 'EspecialidadMedica\EspecialidadMedicaController');
    Route::resource('establecimiento', 'Establecimiento\EstablecimientoController');
    Route::resource('funcionario', 'Funcionario\FuncionarioController');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'HomeController@index');
    Route::resource('motivo', 'Motivo\MotivoController');
    Route::resource('nacionalidad', 'Nacionalidad\NacionalidadController');
    Route::resource('nivel', 'NivelAtencion\NivelAtencionController');
    Route::resource('nivel-educativo', 'NivelEducativo\NivelEducativoController');
    Route::resource('perfil', 'Perfil\PerfilController');
    Route::resource('permiso', 'Permiso\PermisoController');
    Route::resource('profesion', 'Profesion\ProfesionController');
    Route::resource('red', 'Red\RedController');
    Route::resource('region', 'Region\RegionController');
    Route::resource('seguro', 'Seguro\SeguroController');
    Route::resource('servicio', 'ServicioMedico\ServicioMedicoController');
    Route::resource('tipo', 'Tipo\TipoController');
    Route::resource('usuario', 'Usuario\UsuarioController');
    Route::resource('usuario-establecimiento', 'Usuario\UsuarioEstablecimientoController');
    Route::resource('permiso-detalle', 'Permiso\PermisoDetalleController');

    Route::get('report', 'Establecimiento\EstablecimientoController@report')->name('establecimiento.report');
    Route::get('region-report', 'Region\RegionController@report')->name('region.report');
});
