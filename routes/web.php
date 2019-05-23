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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['role:Administrador']], function () {

    Route::get('/cantones', 'Cantones@index')->name('cantones');
    
    /*parroquias*/
    Route::get('/parroquias/{idCanton}', 'Parroquias@index')->name('parroquias');
    Route::get('/parroquias-lista', 'Parroquias@lista')->name('parroquiasLista');

    // comunidades
    Route::get('/comunidades/{idParroquia}', 'Comunidades@index')->name('comunidades');
    Route::get('/comunidades-agregar/{idParroquia}', 'Comunidades@agregar')->name('agregarComunidad');
    Route::post('/comunidades-guardar', 'Comunidades@guardar')->name('guardarComunidad');
    Route::get('/comunidades-editar/{idComunidad}', 'Comunidades@editar')->name('editarComunidad');
    Route::post('/comunidades-actualizar', 'Comunidades@actualizar')->name('actualizarComunidad');
    Route::get('/comunidades-eliminar/{idComunidad}', 'Comunidades@eliminar')->name('eliminarComunidad');
    Route::get('/comunidades-en-parroquia/{idParroquia}', 'Comunidades@comunidadListaEnParroquia')->name('comunidadListaEnParroquia');
    
    Route::get('/comunidades-lista', 'Comunidades@comunidadesLista')->name('comunidadesLista');
    
    /*asociaciones*/
    Route::get('/asociaciones','Asociaciones@index')->name('asociaciones');
    Route::get('/asociaciones-nueva','Asociaciones@nuevo')->name('nuevaAsociacion');
    Route::post('/asociaciones-guardar','Asociaciones@guardar')->name('guardarAsociacion');
    Route::get('/asociaciones-editar/{id}','Asociaciones@editar')->name('editarAsociacion');
    Route::post('/asociaciones-actualizar','Asociaciones@actualizar')->name('actualizarAsociacion');
    Route::get('/asociaciones-eliminar/{id}','Asociaciones@eliminar')->name('eliminarAsociacion');
    
    
    /*autoridades*/
    Route::get('/autoridades','Autoridades@index')->name('autoridades');
    Route::get('/autoridades-asociacion/{idAso}','Autoridades@indexAso')->name('autoridadesAsociacion');
    Route::post('/autoridades-guardar','Autoridades@guardar')->name('guardarAutoridad');
    Route::get('/autoridades-nuevo','Autoridades@nuevo')->name('nuevaAutoridad');
    Route::post('/autoridades-agregar-asociacion','Autoridades@agregar')->name('agregarAutoridad');
    Route::get('/autoridades-eliminar/{idPer}','Autoridades@eliminar')->name('eliminarAutoridad');
    Route::get('/autoridades-finalizar/{idPer}','Autoridades@finalizar')->name('finalizarAutoridad');
    Route::get('/autoridades-editar/{id}','Autoridades@editar')->name('editarAutoridad');
    Route::post('/autoridades-actualizar','Autoridades@actualizar')->name('actualizarAutoridad');
    Route::get('/autoridades-eliminar-info/{idUser}','Autoridades@eliminarInfo')->name('eliminarAutoridadInfo');

    
});



Route::group(['middleware' => ['role:Asociacion']], function () {
    //propiedades
    Route::get('/propiedades/{idComunidad}','Propiedades@index')->name('propiedades');
});