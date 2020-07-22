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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('perfil', 'Perfil\PerfilController');

Route::resource('region', 'Region\RegionController');
Route::get('region-report', 'Region\RegionController@report')->name('region.report');

Route::resource('distrito', 'Distrito\DistritoController');

Route::resource('barrio', 'Barrio\BarrioController');

Route::resource('nivel', 'NivelAtencion\NivelAtencionController');

Route::resource('tipo', 'Tipo\TipoController');

Route::resource('red', 'Red\RedController');

Route::resource('establecimiento', 'Establecimiento\EstablecimientoController');
Route::get('report', 'Establecimiento\EstablecimientoController@report')->name('establecimiento.report');
