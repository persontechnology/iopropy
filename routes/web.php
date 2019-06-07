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
    // comunidades en asociaciones
    Route::get('/propiedades-asociacion/{idComu}','Asociaciones@propiedades')->name('propiedadesEnAsociaciones');
    
    
    
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

    //propiedades
    Route::get('/propiedades-fed','PropiedadesFed@index')->name('propiedadesFed');
    Route::get('/propiedades-fed-nuevo','PropiedadesFed@nuevo')->name('nuevaPropiedadFed');
    Route::post('/propiedades-fed-guardar','PropiedadesFed@guardar')->name('guardarPropiedadFed');
    Route::get('/propiedades-fed-editar/{idPro}','PropiedadesFed@editar')->name('editarPropiedadFed');
    Route::post('/propiedades-fed-actualizar','PropiedadesFed@actualizar')->name('actualizarPropiedadFed');
    Route::get('/propiedades-fed-informacion/{id}','PropiedadesFed@informacion')->name('informacionPropiedadFed');
    Route::get('/propiedades-fed-pdf/{id}','PropiedadesFed@verPdf')->name('verPdfPropiedadFed');
    Route::get('/propiedades-fed-imprimir/{id}','PropiedadesFed@imprimir')->name('imprimirPropiedadFed');

    // ventas
    Route::get('/ventas','Ventas@index')->name('ventas');
    Route::get('/ventas-nuevo','Ventas@nuevo')->name('nuevoVenta');
    Route::get('/ventas-info/{idVenta}','Ventas@informacion')->name('infoVenta');
    Route::post('/ventas-guardar','Ventas@guardar')->name('guardarVenta');
    Route::get('/ventas-aprobar/{idVenta}','Ventas@aprobar')->name('aprobarVenta');
    Route::get('/ventas-anular/{idVenta}','Ventas@anular')->name('anularVenta');
    
    
    
});



Route::group(['middleware' => ['role:Asociacion|Administrador']], function () {
    
    

    // asociaciones
    Route::get('/mi-asociaciones','Propiedades@asociaciones')->name('miAsociaciones');
    
    // comunidades
    Route::get('/mi-comunidades/{idAso}','Propiedades@comunidades')->name('miComunidades');

    //propiedades
    Route::get('/propiedades/{idComunidad}','Propiedades@index')->name('propiedades');
    Route::get('/propiedades-nuevo/{idComunidad}','Propiedades@nuevo')->name('nuevaPropiedad');
    Route::post('/propiedades-guardar','Propiedades@guardar')->name('guardarPropiedad');
    Route::get('/propiedades-editar/{idPro}','Propiedades@editar')->name('editarPropiedad');
    Route::post('/propiedades-actualizar','Propiedades@actualizar')->name('actualizarPropiedad');
    Route::get('/propiedades-informacion/{id}','Propiedades@informacion')->name('informacionPropiedad');
    Route::get('/propiedades-pdf/{id}','Propiedades@verPdf')->name('verPdfPropiedad');
    Route::get('/propiedades-imprimir/{id}','Propiedades@imprimir')->name('imprimirPropiedad');
    
    
    
    

    
});

Route::get('/usuarios','Usuarios@index')->name('usuarios');
Route::get('/usuarios-nuevo','Usuarios@nuevo')->name('nuevoUsuario');
Route::post('/usuarios-guardar','Usuarios@guardar')->name('guardarUsuario');
Route::get('/usuarios-editar/{idUser}','Usuarios@editar')->name('editarUsuario');
Route::post('/usuarios-actualizar','Usuarios@actualizar')->name('actualizarUsuario');
Route::get('/usuarios-eliminar/{idUser}','Usuarios@eliminar')->name('eliminarUsuario');