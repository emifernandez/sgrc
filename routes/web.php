<?php

use App\RegistroConsulta;
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
    Route::resource('admision', 'Admision\AdmisionController');
    Route::resource('barrio', 'Barrio\BarrioController');
    Route::resource('cargo', 'Cargo\CargoController');
    Route::resource('contrarreferencia', 'Derivacion\ContrareferenciaController');
    Route::resource('distrito', 'Distrito\DistritoController');
    Route::resource('enfermedad', 'Enfermedad\EnfermedadController');
    Route::resource('especialidad', 'EspecialidadMedica\EspecialidadMedicaController');
    Route::resource('establecimiento', 'Establecimiento\EstablecimientoController');
    Route::resource('funcionario', 'Funcionario\FuncionarioController');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'HomeController@index');
    Route::resource('horario', 'HorarioAtencion\HorarioAtencionController');
    Route::resource('motivo', 'Motivo\MotivoController');
    Route::resource('nacionalidad', 'Nacionalidad\NacionalidadController');
    Route::resource('nivel', 'NivelAtencion\NivelAtencionController');
    Route::resource('nivel-educativo', 'NivelEducativo\NivelEducativoController');
    Route::resource('paciente', 'Paciente\PacienteController');
    Route::resource('perfil', 'Perfil\PerfilController');
    Route::resource('permiso', 'Permiso\PermisoController');
    Route::resource('profesion', 'Profesion\ProfesionController');
    Route::resource('red', 'Red\RedController');
    Route::resource('referencia', 'Derivacion\ReferenciaController');
    Route::resource('region', 'Region\RegionController');
    Route::resource('registro-consulta', 'RegistroConsulta\RegistroConsultaController');
    Route::get('registro-consulta-pendientes', 'RegistroConsulta\RegistroConsultaController@pendientes')->name('consultas.pendientes');
    Route::resource('seguro', 'Seguro\SeguroController');
    Route::resource('servicio', 'ServicioMedico\ServicioMedicoController');
    Route::resource('tipo', 'Tipo\TipoController');
    Route::resource('usuario', 'Usuario\UsuarioController');
    Route::resource('usuario-establecimiento', 'Usuario\UsuarioEstablecimientoController');
    Route::resource('permiso-detalle', 'Permiso\PermisoDetalleController');

    Route::post('report', 'Establecimiento\EstablecimientoController@report')->name('establecimiento.report');
    Route::post('report-funcionario', 'Funcionario\FuncionarioController@report')->name('profesional.report');
    Route::post('report-capacidad-atencion', 'Reporte\ReporteController@reportCapacidadAtencion')->name('capacidad.report');
    Route::post('report-cantidad-atencion', 'Reporte\ReporteController@reportCantidadAtencion')->name('cantidad.report');
    Route::post('report-derivaciones', 'Reporte\ReporteController@reportDerivacion')->name('derivacion.report');
    Route::get('region-report', 'Region\RegionController@report')->name('region.report');

    Route::get('report-establecimiento', 'Reporte\ReporteController@establecimiento')->name('report.establecimiento.index');
    Route::get('report-profesional', 'Reporte\ReporteController@profesional')->name('report.profesional.index');
    Route::get('report-capacidad', 'Reporte\ReporteController@capacidadAtencion')->name('report.capacidad.index');
    Route::get('report-cantidad', 'Reporte\ReporteController@cantidadAtencion')->name('report.cantidad.index');
    Route::get('report-derivacion', 'Reporte\ReporteController@derivacion')->name('report.derivacion.index');
    Route::get('/block', function () {
        return view('layouts.block');
    })->name('block');
});
Route::get('admision/getProfesional/{establecimiento}/{especialidad}/{dia}', 'Admision\AdmisionController@getProfesional');
Route::get('admision/{funcionario}/getProfesional/{establecimiento}/{especialidad}/{dia}', 'Admision\AdmisionController@getProfesional');
Route::get('referencia/getProfesional/{establecimiento}/{especialidad}/{derivante}/{dia}', 'Derivacion\ReferenciaController@getProfesional');
Route::get('referencia/{funcionario}/getProfesional/{establecimiento}/{especialidad}/{dia}', 'Admision\AdmisionController@getProfesional');
Route::get('report-horario', 'Reporte\ReporteController@horario')->name('report.horario');
Route::post('report-funcionario', 'Funcionario\FuncionarioController@report')->name('profesional.report');
