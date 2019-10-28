<?php

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
    return view('auth.login');
});

//Rutas del login
Auth::routes(['reset'=>false,'register'=>false]);
Route::get('/home', 'HomeController@index')->name('home');

//Rutas para los controlladores
Route::resource('paciente','PacienteController')->middleware('auth');
Route::resource('cita','CitaController')->middleware('auth');
Route::resource('recep','RecepcionistaController')->middleware('auth');
Route::resource('medico','MedicoController')->middleware('auth');
Route::resource('historiaclinica','HistoriaClinicaController')->middleware('auth');
Route::resource('empleado','EmpleadoController')->middleware('auth');

//Ruta para ver HC recibiendo paciente
Route::get('hc/{id}','PacienteController@buscarhc')->middleware('auth');

//Ruta para ver PDF de HC
Route::get('hclinica/pdf/{id}','HistoriaClinicaController@imprimirhc')->middleware('auth');

//Ruta para crear HC recibiendo cita médica
Route::get('newhistoriaclinica/{id}','HistoriaClinicaController@recibircita')->middleware('auth');

//Ruta para consultar DNI
Route::get('/consultardni', 'PruebaController@buscarDni')->name('consultar.reniec');
