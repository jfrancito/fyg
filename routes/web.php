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

/********************** USUARIOS *************************/
// header('Access-Control-Allow-Origin:  *');
// header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
// header('Access-Control-Allow-Headers: *');

Route::group(['middleware' => ['guestaw']], function () {

	Route::any('/', 'UserController@actionLogin');
	Route::any('/login', 'UserController@actionLogin');
	Route::any('/acceso', 'UserController@actionAcceso');

});



Route::get('/cerrarsession', 'UserController@actionCerrarSesion');
Route::get('/traer-compras-sunat', 'SunatController@actionComprasSunat');
Route::get('/traer-archivo-sunat', 'SunatController@actionArchivoSunat');



Route::group(['middleware' => ['authaw']], function () {

	Route::get('/bienvenido', 'UserController@actionBienvenido');
	//GESTION DE USUARIOS
	Route::any('/gestion-de-usuarios/{idopcion}', 'UserController@actionListarUsuarios');
	Route::any('/agregar-usuario/{idopcion}', 'UserController@actionAgregarUsuario');
	Route::any('/modificar-usuario/{idopcion}/{idusuario}', 'UserController@actionModificarUsuario');
	Route::any('/ajax-activar-perfiles', 'UserController@actionAjaxActivarPerfiles');
	Route::any('/gestion-de-director-ie/{idopcion}', 'UserController@actionListarIE');

	//GESTION DE SOLICITUD
	Route::any('/gestion-solicitud/{idopcion}', 'UserController@actionListarSolicitud');
	Route::any('/descargar-archivo-resolucion/{idregistro}', 'UserController@actionDescargarArchivosResulucion');
	Route::any('/enviar-correo-solicitud/{idopcion}/{idregistro}', 'UserController@actionEnviarSolicitudCorreo');

	//GESTION DE ROLES
	Route::any('/gestion-de-roles/{idopcion}', 'UserController@actionListarRoles');
	Route::any('/agregar-rol/{idopcion}', 'UserController@actionAgregarRol');
	Route::any('/modificar-rol/{idopcion}/{idrol}', 'UserController@actionModificarRol');
	//GESTION DE PERMISOS
	Route::any('/gestion-de-permisos/{idopcion}', 'UserController@actionListarPermisos');
	Route::any('/ajax-listado-de-opciones', 'UserController@actionAjaxListarOpciones');
	Route::any('/ajax-activar-permisos', 'UserController@actionAjaxActivarPermisos');
	///////////////////////////////////////////////////////////////////////////////////////////////////////////
 	// SECCION DE GRUPO OPCIONES
	///////////////////////////////////////////////////////////////////////////////////////////////////////////
	Route::any('/gestion-grupo-opciones/{idopcion}', 'GestionMenuController@actionListarGrupoOpciones');
	Route::any('/agregar-grupo-opcion/{idopcion}', 'GestionMenuController@actionAgregarGrupoOpcion');
	Route::any('/modificar-grupo-opcion/{idopcion}/{idregistro}', 'GestionMenuController@actionModificarGrupoOpcion');
	///////////////////////////////////////////////////////////////////////////////////////////////////////////
 	// SECCION DE OPCIONES
	///////////////////////////////////////////////////////////////////////////////////////////////////////////
	Route::any('/gestion-opciones/{idopcion}', 'GestionMenuController@actionListarOpciones');
	Route::any('/agregar-opcion/{idopcion}', 'GestionMenuController@actionAgregarOpcion');
	Route::any('/modificar-opcion/{idopcion}/{idregistro}', 'GestionMenuController@actionModificarOpcion');


	Route::any('/gestion-de-documentos-sunat/{idopcion}', 'GestionDocumentoController@actionListarGestionDocumento');
	Route::any('/ajax-buscar-documento-fe', 'GestionDocumentoController@actionAjaxListarGestionDocumento');
	Route::any('/comprobante-masivo-pdf/{empresa_id}/{periodo}/{idopcion}', 'GestionDocumentoController@actionComprobanteMasivoPdf');





});

Route::get('/pruebaemail/{emailfrom}/{nombreusuario}', 'PruebasController@actionPruebaEmail');
