<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
use App\Modelos\FeToken;

use View;
use Session;
use Hashids;
use App\Traits\SunatTraits;


class GestionDocumentoController extends Controller
{
    use SunatTraits;


    public function actionComprobanteMasivoPdf($empresa_id,$periodo,$idopcion)
    {
        set_time_limit(0);
        $funcion                =   $this;

		$ruta 					= 	"//10.1.50.2/fyg/".$empresa_id."/".$periodo;

	    // Verificar si la carpeta existe
	    if (!file_exists($ruta) || !is_dir($ruta)) {
	        return response()->json(['error' => 'La carpeta no existe'], 404);
	    }
	    
	    // Obtener todos los archivos de la carpeta
	    $archivos = glob($ruta . "/*");
	    
	    if (empty($archivos)) {
	        return response()->json(['error' => 'La carpeta está vacía'], 404);
	    }
	    
	    // Crear nombre del ZIP
	    $nombreZip = "carpeta_{$empresa_id}_{$periodo}.zip";
	    $rutaZip = storage_path("app/temp/{$nombreZip}");
	    
	    // Crear directorio temporal si no existe
	    if (!file_exists(dirname($rutaZip))) {
	        mkdir(dirname($rutaZip), 0755, true);
	    }
	    
	    // Crear archivo ZIP
	    $zip = new \ZipArchive();
	    if ($zip->open($rutaZip, \ZipArchive::CREATE) === TRUE) {
	        foreach ($archivos as $archivo) {
	            if (is_file($archivo)) {
	                $nombreArchivo = basename($archivo);
	                $zip->addFile($archivo, $nombreArchivo);
	            }
	        }
	        $zip->close();
	        
	        // Descargar el ZIP
	        return response()->download($rutaZip)->deleteFileAfterSend(true);
	    } else {
	        return response()->json(['error' => 'No se pudo crear el archivo ZIP'], 500);
	    }


    }


    public function actionAjaxListarGestionDocumento(Request $request) {

        $empresa_id   	=   $request['empresa_id'];
        $periodo      	=   $request['periodo'];
        $idopcion      	=   $request['idopcion'];

        $listadatos     =   $this->con_lista_cabecera_comprobante_sunat($empresa_id,$periodo);
        $funcion        =   $this;

        return View::make('comprobante/ajax/alistadocumentosunat',
                         [
                            'idopcion'              =>  $idopcion,
                            'listadatos'            =>  $listadatos,
                            'ajax'                  =>  true,
                            'funcion'               =>  $funcion
                         ]);
    }



    public function actionListarGestionDocumento($idopcion)
    {
        /******************* validar url **********************/
        $validarurl = $this->funciones->getUrl($idopcion,'Ver');
        if($validarurl <> 'true'){return $validarurl;}
        /******************************************************/
        View::share('titulo','Gestion Documento Sunat');
        $cod_empresa    =   Session::get('usuario')->usuarioosiris_id;

        $empresa_id   	=   '';
        $combo_empresa  =   $this->sut_combo_empresa();

        $periodo   		=   '';
        $combo_periodo  =   $this->sut_combo_periodo();

        $funcion        =   $this;
        $listadatos     =   array();

        return View::make('comprobante/listadocumentossunat',
                         [
                            'listadatos'        =>  $listadatos,
                            'funcion'           =>  $funcion,
                            'idopcion'          =>  $idopcion,
                            'empresa_id'      	=>  $empresa_id,
                            'combo_empresa'   	=>  $combo_empresa,
                            'periodo'         	=>  $periodo,
                            'combo_periodo'     =>  $combo_periodo

                         ]);
    }



}
