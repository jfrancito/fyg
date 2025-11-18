<?php

namespace App\Http\Controllers;

use App\Modelos\Grupoopcion;
use App\Modelos\Opcion;
use App\Modelos\Rol;
use App\Modelos\RolOpcion;
use App\Modelos\Institucion;
use App\Modelos\Director;
use App\Modelos\Certificado;
use App\Modelos\DetalleCertificado;
use App\Modelos\Registro;
use App\Modelos\Archivo;




use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session;
use View;
use Stdclass;
use SplFileInfo;
use App\Traits\GeneralesTraits;

class UserController extends Controller {

    use GeneralesTraits;


	public function actionCambioClaveGuardar($institucion_id,Request $request) {

		if ($_POST) {

            try{

	            DB::beginTransaction();
				$institucion_id  =   $this->funciones->decodificarmaestra($institucion_id);
				$lblcontrasena 	 = 	 $request['lblcontrasena'];
	            User::where('institucion_id','=',$institucion_id)
	                        ->update(
	                            [
	                                'password'=>Crypt::encrypt($lblcontrasena),
	                                'ind_cambioclave'=>'0',
	                                'fecha_mod'=>$this->fechaactual,
	                                'usuario_mod'=>'1CIX00000001'
	                            ]
	                        );
				$mensaje    =   'Se Realizo el cambio de contraseña correctamente';
            	DB::commit();
            }catch(\Exception $ex){
                DB::rollback(); 
                return Redirect::to('olvidaste-contrasenia')->with('errorbd', $ex.' Ocurrio un error inesperado');
            }
 			return Redirect::to('/login')->with('bienhecho', $mensaje);

		} 
	}



	public function actionCambioClave($institucion_id) {

		$institucion_cr = 	 $institucion_id;
		$institucion_id  =   $this->funciones->decodificarmaestra($institucion_id);
		//ya se realizo el cambio de clave
		$institucion  					= 	Institucion::where('id','=',$institucion_id)->first();
	    $user 							=	User::where('institucion_id','=',$institucion->id)->where('ind_cambioclave','=','1')->first();
		$mensaje    					=   'Ya fue realizado el cambio de clave';
	    if(count($user)<=0){
 			return Redirect::to('/login')->with('errorurl', $mensaje);
	    }

		return View::make('usuario.cambioclave',
						 [
						 	'institucion_cr' => $institucion_cr,
						 	'user' => $user,
						 ]);
	}



	public function actionOlvidasteContrasenia(Request $request) {

		if ($_POST) {

            try{

	            DB::beginTransaction();

				$lblemail 		= 	$request['lblemail'];

				$director 		= 	Director::where('correo','=',$lblemail)
									->where('activo', '=', 1)
									->first();
	            if(count($director)<=0){
	                return Redirect::back()->with('errorbd', 'Correo Electronico '.$director.' no se encuentra registrado');
	            }

				$institucion  					= 	Institucion::where('id','=',$director->institucion_id)->first();
				$registro  						= 	Registro::where('institucion_id','=',$director->institucion_id)->where('activo','=','1')->first();
	            if(count($registro)<=0){
	                return Redirect::back()->with('errorbd', 'Institucion Educativa '.$institucion->nombre.' aun no se a registrado');
	            }
	            $userv 							=	User::where('institucion_id','=',$director->institucion_id)->where('ind_cambioclave','=','1')->first();
	            if(count($userv)>0){
	                return Redirect::back()->with('errorbd', 'Institucion Educativa '.$institucion->nombre.' tiene una solicitud pendiente');
	            }

	            //1 : SOLICITA CAMBIO DE CLAVE
	            //0 O NULL : CUANDO NO TIENE NINGUNA SOLICITUD DE CAMBIO

	            $user 							=	User::where('institucion_id','=',$director->institucion_id)->first();
	            $user->ind_cambioclave 			= 	1;
				$user->usuario_mod			= 	'1CIX00000001';
				$user->fecha_mod 	   		=  	$this->fechaactual;
	            $user->save();

	            //dd($user);

           		$this->envio_correo_cambio_clave($director,$this->url_real);
				$mensaje    =   'Solicitud de Cambio de contraseña se realizo correctamente';
            	DB::commit();
            }catch(\Exception $ex){
                DB::rollback(); 
                return Redirect::to('olvidaste-contrasenia')->with('errorbd', $ex.' Ocurrio un error inesperado');
            }
 			return Redirect::to('/login')->with('bienhecho', $mensaje);

		} else {



			return view('usuario.olvidastecontrasenia');
		}
	}





    public function actionEnviarSolicitudCorreo($idopcion,$idregistro)
    {

        $registro_id = $this->funciones->decodificarmaestra($idregistro);

        try{
            DB::beginTransaction();
            $registro                =   Registro::where('id','=',$registro_id)->first();
            //Institucion
            Institucion::where('id','=',$registro->institucion_id)
                        ->update(
                            [
                                'tipo_institucion'=>$registro->tipoo_instituccion,
                                'fecha_mod'=>$this->fechaactual,
                                'usuario_mod'=>Session::get('usuario')->id
                            ]
                        );

            //Director
            Director::where('institucion_id','=',$registro->institucion_id)
                        ->update(
                            [
                                'dni'=>$registro->dni_director,
                                'nombres'=>$registro->nombres_director,
                                'telefono'=>$registro->telefono_director,
                                'correo'=>$registro->correo_director,
                                'fecha_mod'=>$this->fechaactual,
                                'usuario_mod'=>Session::get('usuario')->id
                            ]
                        );


            User::where('institucion_id','=',$registro->institucion_id)
                        ->update(
                            [
                                'password'=>$registro->password,
                                'fecha_mod'=>$this->fechaactual,
                                'usuario_mod'=>Session::get('usuario')->id
                            ]
                        );


	        $listasolicitudes           =   Registro::where('id','=',$registro_id)
	                                        ->get();


            $this->envio_correo_sin_editar($listasolicitudes,$this->url_real);




            DB::commit();

            return Redirect::to('/gestion-solicitud/' . $idopcion)->with('bienhecho', 'Solicitud ' . $registro->nombre . ' enviada con exito');
        }catch(\Exception $ex){
            DB::rollback(); 
            return Redirect::back()->with('errorurl', 'Ocurrio un Error '.$ex);

        }
        
    }



    public function actionActivarRegistro($token)
	{
		$idusuario  =   $this->funciones->decodificarmaestra($token);
		$usuario    =   User::where('institucion_id','=',$idusuario)->first();
		$mensaje    =   'Cuenta Activada Satisfactoriamente';
		if(count($usuario)>0){
			$usuario->ind_confirmacion = 1;
			$usuario->save();
			$mensaje    =   'Cuenta Activada Satisfactoriamente';
		}else{
			$mensaje    =   'Link de activacion no encontrada';
		}
		return View::make('usuario.activar',
						 [
						 	'usuario' => $usuario,
						 	'mensaje' => $mensaje,
						 ]);
	}


    public function actionDescargarArchivosResulucion($idregistro)
    {

        $registro_id = $this->funciones->decodificarmaestra($idregistro);

        try{
            // DB::beginTransaction();

                        //dd($registro_id );

            $archivo                =   Archivo::where('referencia_id','=',$registro_id)->where('tipo_archivo','=','resolucion')->first();
            $storagePath            = 	storage_path('app\\'.$this->pathFilesRes.$archivo->nombre_archivo);


            if(is_file($storagePath))
            {       
                    // return Response::download($rutaArchivo);
                    return response()->download($storagePath);
            }
            
            // DB::commit();
        }catch(\Exception $ex){
            // DB::rollback(); 
            $sw =   1;
            $mensaje  = $this->ge_getMensajeError($ex);
            dd('archivo no encontrado');

        }
        
    }


	public function actionListarSolicitud($idopcion) {
		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion, 'Ver');
		if ($validarurl != 'true') {return $validarurl;}
		/******************************************************/
	    View::share('titulo','Lista de solicitud');
		$listasolicitud = 	Registro::join('instituciones','instituciones.id','=','registros.institucion_id')
							->join('directores','directores.institucion_id','=','instituciones.id')
							->select('registros.*','registros.id as idreal','instituciones.tipo_institucion as tireal','directores.*')
							->where('accion','=','EDITAR')
							->where('ind_email','=','0')
							->orderBy('registros.fecha_crea', 'asc')
							->get();

		return View::make('usuario/listasolicitud',
			[
				'listasolicitud' => $listasolicitud,
				'idopcion' => $idopcion,
			]);
	}


	public function actionAjaxBuscarDirector(Request $request) {

		$codigolocal 				=   $request['codigolocal'];
		$institucion 				= 	DB::table('instituciones')
    									->where('codigo','=',$codigolocal)
										->first();

		$director   = array();
		$direccion  = '';	
		$mensaje    = 'Institucion encontrado';
		$idactivo   = 1;
		$combo_tipo_institucion = array(''=>'Seleccione Tipo Institucion','UNIDOCENTE'=>'UNIDOCENTE','POLIDOCENTE'=>'POLIDOCENTE','MULTIGRADO'=>'MULTIGRADO');
		$sel_tipo_institucion = '';

		if(count($institucion)>0){
			$director 					=	Director::where('institucion_id','=',$institucion->id)
											->first();
			$mensaje    = 'Institucion encontrado';
			$idactivo   = 1;
			$sel_tipo_institucion = $institucion->tipo_institucion;

		}else{
			$idactivo   = 0;
			$mensaje = 'Institucion no encontrado';
		}

		return View::make('usuario/form/formdirector',
			[
				'institucion' => $institucion,
				'director' 	  => $director,
				'combo_tipo_institucion' => $combo_tipo_institucion,
				'sel_tipo_institucion' 	  => $sel_tipo_institucion,
				'idactivo' => $idactivo,
				'mensaje' => $mensaje,
				'direccion' => $direccion,
			]);
	}



	public function actionAjaxBuscarProveedor(Request $request) {

		$codigolocal 				=   $request['codigolocal'];
		$institucion 				= 	DB::table('instituciones')
    									->where('codigo','=',$codigolocal)
										->first();

		$director   = array();
		$direccion  = '';	
		$mensaje    = 'Institucion encontrado';
		$idactivo   = 1;
		$combo_tipo_institucion = array(''=>'Seleccione Tipo Institucion','UNIDOCENTE'=>'UNIDOCENTE','POLIDOCENTE'=>'POLIDOCENTE','MULTIGRADO'=>'MULTIGRADO');
		$sel_tipo_institucion = '';

		if(count($institucion)>0){
			$director 					=	Director::where('institucion_id','=',$institucion->id)
											->first();
			$mensaje    = 'Institucion encontrado';
			$idactivo   = 1;
			$sel_tipo_institucion = $institucion->tipo_institucion;

		}else{
			$idactivo   = 0;
			$mensaje = 'Proveedor no encontrado';
		}

		//dd($director);

		return View::make('usuario/form/formproveedor',
			[
				'institucion' => $institucion,
				'director' 	  => $director,

				'combo_tipo_institucion' => $combo_tipo_institucion,
				'sel_tipo_institucion' 	  => $sel_tipo_institucion,


				'idactivo' => $idactivo,
				'mensaje' => $mensaje,
				'direccion' => $direccion,
			]);
	}


    public function actionRegistrate(Request $request)
	{


		if($_POST)
		{

            try{    
               

            DB::beginTransaction();

			$accion 	 		 			= 	$request['accion'];
			$institucion 	 		 		= 	$request['institucion'];
			$nivel 	 		 				= 	$request['nivel'];
			$direccion 	 					= 	$request['direccion'];
			$tipo_institucion 	 		 	= 	$request['tipo_institucion'];
			$lblcontrasena 					= 	$request['lblcontrasena'];
			$lblcontrasenaconfirmar 	 	= 	$request['lblcontrasenaconfirmar'];
			$institucion_id 	 			= 	$request['institucion_id'];
			$dni 	 		 				= 	$request['dni'];
			$nombre 						= 	$request['nombre'];
			$lblcelular 					= 	$request['lblcelular'];
			$lblemail 						= 	$request['lblemail'];
			$lblconfirmaremail 				= 	$request['lblconfirmaremail'];
			$institucion  					= 	Institucion::where('id','=',$institucion_id)->first();
			if($accion == 0){
				$registro  						= 	Registro::where('institucion_id','=',$institucion_id)->where('activo','=','1')->where('accion','=','REGISTRO')->first();
	            if(count($registro)>0){
	                return Redirect::back()->with('errorurl', 'Institucion Educativa '.$institucion->nombre.' ya tiene un registro valido (realize un cambio de contraseña o cambio de director)');
	            }
        	}else{
				$registro  						= 	Registro::where('institucion_id','=',$institucion_id)->where('activo','=','1')->where('accion','=','EDITAR')->where('ind_email','=',0)->first();
	            if(count($registro)>0){
	                return Redirect::back()->with('errorurl', 'Institucion Educativa '.$institucion->nombre.' aun no confirma su registro anterior');
	            }
        	}
            //desctivamos el registro
	        Registro::where('institucion_id','=',$institucion_id)->where('activo','=','1')
            ->update(
                [
                    'activo'=>'0',
                    'fecha_mod'=>$this->fechaactual,
                    'usuario_mod'=>'1CIX00000001'
                ]
            );
			$txt_accion 					=	'REGISTRO';
			$ind_registro 					=	0;
			$ind_editar 					=	-1;
			$mensaje 						=	'Institucion '.$institucion->nombre.' registrado con exito (Se le a enviado un email para que pueda confirmar su acceso al sitema)';
            $ind_email       				=   1;

			if($accion == 1){			
				$txt_accion 					=	'EDITAR';
				$ind_registro 					=	-1;
				$ind_editar 					=	0;
				$mensaje 						=	'Institucion '.$institucion->nombre.' registrado con exito (Como realizo un cambio de director en el registro el administrador le estara enviando un correo con la respuesta de solicitud)';
            	$ind_email       				=   0;
			}

			$id 				 			=   $this->funciones->getCreateIdMaestra('registros');
            $codigo                         =   $this->funciones->generar_codigo('registros',8);

			$cabecera            	 		=	new Registro;
			$cabecera->id 	     	 		=   $id;
			$cabecera->codigo 				=   $codigo;
			$cabecera->institucion_id 		=   $institucion_id;
			$cabecera->codigo_local  		=	$institucion->codigo;
			$cabecera->accion  				=	$txt_accion;
			$cabecera->nombre 	 			= 	$institucion->nombre;
			$cabecera->tipoo_instituccion 	= 	$tipo_institucion;
			$cabecera->password				= 	Crypt::encrypt($lblcontrasena);
			$cabecera->dni_director			= 	$dni;
			$cabecera->nombres_director		= 	$nombre;
			$cabecera->telefono_director	= 	$lblcelular;
			$cabecera->correo_director		= 	$lblemail;
			$cabecera->ind_email			= 	$ind_email;
			$cabecera->usuario_crea			= 	'1CIX00000001';
			$cabecera->fecha_crea 	   		=  	$this->fechaactual;
			$cabecera->save();
            $files                      	=   $request['resolucion'];



			if($accion == 1){	

	            if(!is_null($files)){
	                foreach($files as $file){
            			//dd($file->getRealPath());
	                    $codigo                     =   $codigo;
	                    $rutafile                   =   storage_path('app/').$this->pathFilesRes;
	                    $nombre                     =   $codigo.'-'.$file->getClientOriginalName();
	                    $rutadondeguardar           =   $this->pathFilesRes.$codigo.'/';
	                    $urlmedio                   =   'app/'.$rutadondeguardar.$nombre;
	                    $nombreoriginal             =   $file->getClientOriginalName();
	                    $info                       =   new SplFileInfo($nombreoriginal);
	                    $extension                  =   $info->getExtension();
	                    copy($file->getRealPath(),$rutafile.$nombre);
	                    $idarchivo                  =   $this->funciones->getCreateIdMaestra('archivos');

	                    $dcontrol                   =   new Archivo;
	                    $dcontrol->id               =   $idarchivo;
	                    $dcontrol->size             =   filesize($file);
	                    $dcontrol->extension        =   $extension;
	                    $dcontrol->lote             =   $codigo;
	                    $dcontrol->referencia_id    =   $id;
	                    $dcontrol->nombre_archivo   =   $nombre;
	                    $dcontrol->url_archivo      =   $urlmedio;
	                    $dcontrol->area_id          =   '';
	                    $dcontrol->area_nombre      =   '';
	                    $dcontrol->periodo_id       =   '';
	                    $dcontrol->periodo_nombre   =   '';
	                    $dcontrol->codigo_doc       =   '';
	                    $dcontrol->nombre_doc       =   '';
	                    $dcontrol->usuario_nombre   =   'admin';
	                    $dcontrol->tipo_archivo     =   'resolucion';
	                    $dcontrol->fecha_crea       =   $this->fechaactual;
	                    $dcontrol->usuario_crea     =   '1CIX00000001';
	                    $dcontrol->save();
	                }
	            }


	            User::where('institucion_id','=',$institucion_id)
	                        ->update(
	                            [
	                                'ind_confirmacion'=>0,
	                                'fecha_mod'=>$this->fechaactual,
	                                'usuario_mod'=>'1CIX00000001'
	                            ]
	                        );


			}else{

		        Institucion::where('id','=',$institucion_id)
                ->update(
                    [
                        'tipo_institucion'=>$tipo_institucion,
                        'fecha_mod'=>$this->fechaactual,
                        'usuario_mod'=>'1CIX00000001'
                    ]
                );
	            User::where('institucion_id','=',$institucion_id)
	                        ->update(
	                            [
	                                'password'=>Crypt::encrypt($lblcontrasena),
	                                'fecha_mod'=>$this->fechaactual,
	                                'usuario_mod'=>'1CIX00000001'
	                            ]
	                        );

            	$this->envio_correo_registro($cabecera,$this->url_real);
			}

			Session::forget('usuario');
			Session::forget('listamenu');
			Session::forget('listaopciones');
            DB::commit();

            }catch(\Exception $ex){
                DB::rollback(); 
                return Redirect::to('registrate')->with('errorbd', $ex.' Ocurrio un error inesperado');
            }

 			return Redirect::to('/login')->with('bienhecho', $mensaje);



		}else{

			$mensaje    = '';
			$idactivo   = 1;

			$combo_tipo_institucion = array(''=>'Seleccione Tipo Institucion','UNIDOCENTE'=>'UNIDOCENTE','POLIDOCENTE'=>'POLIDOCENTE','MULTIGRADO'=>'MULTIGRADO');
			$sel_tipo_institucion = '';
			return View::make('usuario.registrate',
							 [
							 	'sel_tipo_institucion'   => $sel_tipo_institucion,
							 	'combo_tipo_institucion' => $combo_tipo_institucion,
							 	'mensaje' => $mensaje,
							 	'idactivo' => $idactivo,
							 	'idactivo' => $idactivo,

							 ]);
		}	

	}


    public function actionAcceso()
	{

		$accesos  	= 	Permisouserempresa::where('activo','=',1)
						->where('user_id','=',Session::get('usuario')->id)->get();


		return View::make('acceso',
						 [
						 	'accesos' => $accesos,
						 ]);
	}
	
	public function actionLogin(Request $request) {

		if ($_POST) {
			/**** Validaciones laravel ****/
			$this->validate($request, [
				'name' => 'required',
				'password' => 'required',

			], [
				'name.required' => 'El campo Usuario es obligatorio',
				'password.required' => 'El campo Clave es obligatorio',
			]);

			/**********************************************************/

			$usuario = strtoupper($request['name']);
			$clave = strtoupper($request['password']);
			$local_id = $request['local_id'];

			$tusuario = User::whereRaw('UPPER(name)=?', [$usuario])
				->where('activo', '=', 1)
				->first();

			if (count($tusuario) > 0) {

				if($tusuario->ind_confirmacion == 0 && $tusuario->rol_id == '1CIX00000002'){
					return Redirect::back()->withInput()->with('errorbd', 'Revise su correo electronico y confirme su registro');
				}
				$clavedesifrada = strtoupper(Crypt::decrypt($tusuario->password));

				if ($clavedesifrada == $clave) {

					$listamenu = Grupoopcion::join('opciones', 'opciones.grupoopcion_id', '=', 'grupoopciones.id')
						->join('rolopciones', 'rolopciones.opcion_id', '=', 'opciones.id')
						->where('grupoopciones.activo', '=', 1)
						->where('rolopciones.rol_id', '=', $tusuario->rol_id)
						->where('rolopciones.ver', '=', 1)
						->groupBy('grupoopciones.id')
						->groupBy('grupoopciones.nombre')
						->groupBy('grupoopciones.icono')
						->groupBy('grupoopciones.orden')
						->select('grupoopciones.id', 'grupoopciones.nombre', 'grupoopciones.icono', 'grupoopciones.orden')
						->orderBy('grupoopciones.orden', 'asc')
						->get();

					$listaopciones = RolOpcion::where('rol_id', '=', $tusuario->rol_id)
						->where('ver', '=', 1)
						->orderBy('orden', 'asc')
						->pluck('opcion_id')
						->toArray();

					$rol 			= 	Rol::where('id','=',$tusuario->rol_id)
										->first();


					Session::put('usuario', $tusuario);
					Session::put('listamenu', $listamenu);
					Session::put('listaopciones', $listaopciones);
					Session::put('rol', $rol);

					return Redirect::to('bienvenido');

				} else {
					return Redirect::back()->withInput()->with('errorbd', 'Usuario o clave incorrecto');
				}
			} else {
				return Redirect::back()->withInput()->with('errorbd', 'Usuario o clave incorrecto');
			}

		} else {
			return view('usuario.login');
		}
	}

	public function actionCerrarSesion() {
		Session::forget('usuario');
		Session::forget('listamenu');
		Session::forget('listaopciones');
		Session::forget('rol');
		return Redirect::to('/login');	

	}

	public function actionBienvenido() {
		View::share('titulo','Bienvenido Sistema Administrativo');
		

		$anio 				=	$this->anio;


		$fecha = date('Y-m-d');
		return View::make('bienvenido',
			[
				'anio' => $anio
				
			]);
	}

	public function actionObtenerTipoCambio()
	{

		$fecha   = date_format(date_create(date('Y-m-d')), 'Y-m-d');
        // URL del servicio web de SUNAT para obtener el tipo de cambio
        $url = 'https://www.sunat.gob.pe/a/txt/tipoCambio.txt';
        // Realizar la solicitud HTTP para obtener el contenido del archivo de tipo de cambio
        $response = file_get_contents($url);
        // Verificar si la solicitud fue exitosa
        if ($response !== false) {
            // Dividir el contenido en líneas
            $datos = explode('|',$response);
            // dd('sss');
            $tipocambio           =   new TipoCambio();
            $tipocambio->compra   =   (float)$datos[1];
            $tipocambio->venta    =   (float)$datos[2];
            $tipocambio->fecha    =   $fecha;
            $tipocambio->save();

        }
        else{
            $registro               =   new Ilog();
            $registro->descripcion  =   'NO SE REGISTRO TIPO DE CAMBIO PARA LA FECHA '.date('Y-m-d');
            $registro->save();
        }
		return Redirect::to('bienvenido');
	}

	public function actionListarUsuarios($idopcion) {
		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion, 'Ver');

		if ($validarurl != 'true') {return $validarurl;}
		/******************************************************/

	    View::share('titulo','Lista de usuarios');
		
		$listausuarios = 	User::select('users.*')
							->where('users.id', '<>', $this->prefijomaestro . '00000001')->orderBy('users.id', 'asc')->get();

		return View::make('usuario/listausuarios',
			[
				'listausuarios' => $listausuarios,
				'idopcion' => $idopcion,
			]);
	}
	public function actionListarIE($idopcion) {
		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion, 'Ver');

		if ($validarurl != 'true') {return $validarurl;}
		/******************************************************/

	    View::share('titulo','Lista de usuarios');
		
		$listausuarios = 	Institucion::join('directores','directores.institucion_id','=','instituciones.id')
							->select('instituciones.*','directores.nombres','directores.dni','directores.telefono','directores.correo')
							->where('instituciones.id', '<>', '1CIX00000001')->orderBy('instituciones.nombre', 'asc')->get();

		return View::make('instituciones/listaie',
			[
				'listausuarios' => $listausuarios,
				'idopcion' => $idopcion,
			]);
	}




	public function actionAgregarUsuario($idopcion, Request $request) {
		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion, 'Anadir');
		if ($validarurl != 'true') {return $validarurl;}
		/******************************************************/
		View::share('titulo','Agregar Usuario');
		if ($_POST) {

			/**** Validaciones laravel ****/
			$this->validate($request, [
	            'name' => 'unique:users',
			], [
            	'name.unique' => 'Usuario ya registrado',
        	]);
			/******************************/



			$idusers = $this->funciones->getCreateIdMaestra('users');

			$cabecera = new User;
			$cabecera->id = $idusers;
			$cabecera->nombre = $request['nombre'];
			$cabecera->name = $request['name'];
			$cabecera->password = Crypt::encrypt($request['password']);
			$cabecera->rol_id = $request['rol_id'];
			$cabecera->fecha_crea = $this->fechaactual;
			$cabecera->usuario_crea = Session::get('usuario')->id;
			$cabecera->save();


			return Redirect::to('/gestion-de-usuarios/' . $idopcion)->with('bienhecho', 'Usuario ' . $request['nombre'] . ' registrado con exito');

		} else {

			$rol = DB::table('Rols')->where('id', '<>', $this->prefijomaestro . '00000001')->pluck('nombre', 'id')->toArray();
			$comborol = array('' => "Seleccione Rol") + $rol;

			return View::make('usuario/agregarusuario',
				[
					'comborol' => $comborol,
					'idopcion' => $idopcion,
				]);
		}
	}

	public function actionModificarUsuario($idopcion, $idusuario, Request $request) {

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion, 'Modificar');
		if ($validarurl != 'true') {return $validarurl;}
		/******************************************************/
		$idusuario = $this->funciones->decodificarmaestra($idusuario);
	    View::share('titulo','Modificar Usuario');
		if ($_POST) {

			$cabecera = User::find($idusuario);
			$cabecera->nombre = $request['nombre'];
			$cabecera->name = $request['name'];
			$cabecera->fecha_mod = $this->fechaactual;
			$cabecera->usuario_mod = Session::get('usuario')->id;
			$cabecera->password = Crypt::encrypt($request['password']);
			$cabecera->activo = $request['activo'];
			$cabecera->rol_id = $request['rol_id'];
			$cabecera->save();

			return Redirect::to('/gestion-de-usuarios/' . $idopcion)->with('bienhecho', 'Usuario ' . $request['nombre'] . ' modificado con exito');

		} else {

			$usuario = User::where('id', $idusuario)->first();
			$rol = DB::table('Rols')->where('id', '<>', $this->prefijomaestro . '00000001')->pluck('nombre', 'id')->toArray();


			$comborol = array($usuario->rol_id => $usuario->rol->nombre) + $rol;
			$funcion = $this;

			return View::make('usuario/modificarusuario',
				[
					'usuario' => $usuario,
					'comborol' => $comborol,
					'idopcion' => $idopcion,
					'funcion' => $funcion,
				]);
		}
	}

	public function actionListarRoles($idopcion) {

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion, 'Ver');
		if ($validarurl != 'true') {return $validarurl;}
		/******************************************************/
	    View::share('titulo','Lista de Roles');
		$listaroles = Rol::where('id', '<>', $this->prefijomaestro . '00000001')->orderBy('id', 'asc')->get();

		return View::make('usuario/listaroles',
			[
				'listaroles' => $listaroles,
				'idopcion' => $idopcion,
			]);

	}

	public function actionAgregarRol($idopcion, Request $request) {
		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion, 'Anadir');
		if ($validarurl != 'true') {return $validarurl;}
		/******************************************************/
	    View::share('titulo','Agregar Rol');
		if ($_POST) {

			/**** Validaciones laravel ****/

			$this->validate($request, [
				'nombre' => 'unico:dbo,rols',
			], [
				'nombre.unico' => 'Rol ya registrado',
			]);

			/******************************/
			$idrol = $this->funciones->getCreateIdMaestra('rols');

			$cabecera = new Rol;
			$cabecera->id = $idrol;
			$cabecera->fecha_crea = $this->fechaactual;
			$cabecera->usuario_crea = Session::get('usuario')->id;
			$cabecera->nombre = $request['nombre'];
			$cabecera->save();

			$listaopcion = Opcion::orderBy('id', 'asc')->get();
			$count = 1;
			foreach ($listaopcion as $item) {

				$idrolopciones = $this->funciones->getCreateIdMaestra('rolopciones');

				$detalle = new RolOpcion;
				$detalle->id = $idrolopciones;
				$detalle->opcion_id = $item->id;
				$detalle->fecha_crea = $this->fechaactual;
				$detalle->rol_id = $idrol;
				$detalle->orden = $count;
				$detalle->ver = 0;
				$detalle->anadir = 0;
				$detalle->modificar = 0;
				$detalle->eliminar = 0;
				$detalle->todas = 0;
				$detalle->fecha_crea = $this->fechaactual;
				$detalle->usuario_crea = Session::get('usuario')->id;
				$detalle->save();
				$count = $count + 1;
			}

			return Redirect::to('/gestion-de-roles/' . $idopcion)->with('bienhecho', 'Rol ' . $request['nombre'] . ' registrado con exito');
		} else {

			return View::make('usuario/agregarrol',
				[
					'idopcion' => $idopcion,
				]);

		}
	}

	public function actionModificarRol($idopcion, $idrol, Request $request) {

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion, 'Modificar');
		if ($validarurl != 'true') {return $validarurl;}
		/******************************************************/
		$idrol = $this->funciones->decodificarmaestra($idrol);
	    View::share('titulo','Modificar Rol');
		if ($_POST) {

			/**** Validaciones laravel ****/
			$this->validate($request, [
				'nombre' => 'unico_menos:dbo,rols,id,' . $idrol,
			], [
				'nombre.unico_menos' => 'Rol ya registrado',
			]);
			/******************************/

			$cabecera = Rol::find($idrol);
			$cabecera->nombre = $request['nombre'];
			$cabecera->fecha_mod = $this->fechaactual;
			$cabecera->usuario_mod = Session::get('usuario')->id;
			$cabecera->activo = $request['activo'];
			$cabecera->save();

			return Redirect::to('/gestion-de-roles/' . $idopcion)->with('bienhecho', 'Rol ' . $request['nombre'] . ' modificado con éxito');

		} else {
			$rol = Rol::where('id', $idrol)->first();

			return View::make('usuario/modificarrol',
				[
					'rol' => $rol,
					'idopcion' => $idopcion,
				]);
		}
	}

	public function actionListarPermisos($idopcion) {

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion, 'Ver');
		if ($validarurl != 'true') {return $validarurl;}
		/******************************************************/
	     View::share('titulo','Lista Permisos');
		$listaroles = Rol::where('id', '<>', $this->prefijomaestro . '00000001')->orderBy('id', 'asc')->get();

		return View::make('usuario/listapermisos',
			[
				'listaroles' => $listaroles,
				'idopcion' => $idopcion,
			]);
	}

	public function actionAjaxListarOpciones(Request $request) {
		$idrol = $request['idrol'];
		$idrol = $this->funciones->decodificarmaestra($idrol);

		$listaopciones = RolOpcion::where('rol_id', '=', $idrol)->get();

		return View::make('usuario/ajax/listaopciones',
			[
				'listaopciones' => $listaopciones,
			]);
	}

	public function actionAjaxActivarPermisos(Request $request) {

		$idrolopcion = $request['idrolopcion'];
		$idrolopcion = $this->funciones->decodificarmaestra($idrolopcion);

		$cabecera = RolOpcion::find($idrolopcion);
		$cabecera->ver = $request['ver'];
		$cabecera->anadir = $request['anadir'];
		$cabecera->fecha_mod = $this->fechaactual;
		$cabecera->usuario_mod = Session::get('usuario')->id;
		$cabecera->modificar = $request['modificar'];
		$cabecera->todas = $request['todas'];
		$cabecera->save();

		echo ("gmail");

	}

}
