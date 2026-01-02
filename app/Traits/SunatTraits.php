<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
use App\Modelos\FeToken;
use App\Modelos\DocumentoSunat;


use View;
use Session;
use Hashids;
Use Nexmo;
use Keygen;
use File;


trait SunatTraits
{

    private function con_lista_cabecera_comprobante_sunat($empresa_id,$periodo) {


		$listadatos 	= DB::table('DOCUMENTO_SUNAT')
						    ->where('RUC_EMPRESA', $empresa_id)
						    ->where('PERIODO', $periodo)
						    ->get();



        return  $listadatos;
    }


    private function sut_combo_empresa() {
            

		$empresas 					= 	DB::table('FE_TOKEN')
									    ->select('COD_EMPR', 'TXT_EMPR')
									    ->groupBy('COD_EMPR', 'TXT_EMPR')
							            ->pluck('TXT_EMPR','COD_EMPR')
							            ->toArray();

        $combo                  	=   array('' => 'Seleccione empresa') + $empresas;

        return  $combo;                             
    }

   private function sut_combo_periodo() {
            
		$periodos 					= DB::table('DOCUMENTO_SUNAT')
									    ->select('PERIODO')
									    ->groupBy('PERIODO')
									    ->orderBy('PERIODO', 'desc')
							            ->pluck('PERIODO','PERIODO')
							            ->toArray();


        $combo                  	=   array('' => 'Seleccione periodo') + $periodos;

        return  $combo;                             
    }


    private function sut_traer_data_sunat()
    {

		$empresas 					= 	DB::table('FE_TOKEN')
									    ->select('COD_EMPR', 'TXT_EMPR')
									    ->groupBy('COD_EMPR', 'TXT_EMPR')
									    ->get();

		foreach ($empresas as $indexe=>$item) {

			$periodo_actual = \Carbon\Carbon::now()->format('Ym');
			//$periodo_actual = '202312';

			// Convertir a Carbon y calcular periodo anterior
			$fechaActual = \Carbon\Carbon::createFromFormat('Ym', $periodo_actual);
			$fechaAnterior = $fechaActual->copy()->subMonth();
			$periodos = [
			    $fechaAnterior->format('Ym'), // 202510
			    $fechaActual->format('Ym')    // 202511
			];



			// Recorrer con foreach
			foreach ($periodos as $periodo) {
				$fetoken 					=	FeToken::where('COD_EMPR','=',$item->COD_EMPR)->where('TIPO','=','SIRE')->first();
				$valores 					= 	[1,2,4];
				foreach ($valores as $index=>$valor) {
					$array_nuevo_producto 		=	array();
					$urlxml 					= 	'https://api-sire.sunat.gob.pe/v1/contribuyente/migeigv/libros/rce/propuesta/web/propuesta/'.$periodo.'/busqueda?codTipoOpe=1&page='.$valor.'&perPage=100';
					$respuetaxml 				=	$this->sut_buscar_archivo_sunat_compra($urlxml,$fetoken);


					if(isset($respuetaxml['registros'])){

						foreach ($respuetaxml['registros'] as $valorsire) {


								$documento 							=	DocumentoSunat::where('RUC_EMPRESA_PROVEEDOR','=',$valorsire['numDocIdentidadProveedor'])
																		->where('SERIE','=',$valorsire['numSerieCDP'])->where('NUMERO','=',$valorsire['numCDP'])
																		->where('COD_TIPODOCUMENTO','=',$valorsire['codTipoCDP'])
																		->where('RUC_EMPRESA','=',$item->COD_EMPR)
																		->first();
								if(count($documento)<=0){


									$fecha = $valorsire['fecEmision'];
									$anioMes = date('Ym', strtotime($fecha));


									$cabecera     						= 	new DocumentoSunat;
									$cabecera->ID      				 	= 	$valorsire['id'];
									$cabecera->RUC_EMPRESA     			= 	$item->COD_EMPR;	
									$cabecera->TXT_EMPRESA     			= 	$item->TXT_EMPR;

									$cabecera->RUC_EMPRESA_PROVEEDOR     = 	$valorsire['numDocIdentidadProveedor'];	
									$cabecera->TXT_EMPRESA_PROVEEDOR     = 	$valorsire['nomRazonSocialProveedor'];	
									$cabecera->COD_TIPODOCUMENTO      	 = 	$valorsire['codTipoCDP'];
									$cabecera->TXT_TIPODOCUMENTO      	 = 	$valorsire['desTipoCDP'];
									$cabecera->SERIE      				 = 	$valorsire['numSerieCDP'];	
									$cabecera->NUMERO       			 = 	$valorsire['numCDP'];
									$cabecera->PERIODO      		 	 = 	$anioMes;

									$cabecera->FECHA_EMISION      		 = 	$valorsire['fecEmision'];
									$cabecera->FECHA_VENCIMIENTO      	 = 	$valorsire['fecVencPag'];
									$cabecera->MONEDA      			     = 	$valorsire['codMoneda'];	
									$cabecera->ESTADO       			 = 	$valorsire['desEstadoComprobante'];	
									$cabecera->TOTAL       			 	 = 	$valorsire['montos']['mtoTotalCp'];	
									$cabecera->IND_PDF      			 = 	0;
									$cabecera->IND_XML      			 = 	0;
									$cabecera->IND_CDR      			 = 	0;
									$cabecera->IND_TOTAL      			 = 	0;
									$cabecera->CONTADOR      			 = 	0;
									$cabecera->save();
								}
						}

					}


				}	
			}

		}


    }

	private function sunatarchivos() {


		$empresas 					= 	DB::table('FE_TOKEN')
									    ->select('COD_EMPR', 'TXT_EMPR')
									    ->groupBy('COD_EMPR', 'TXT_EMPR')
									    ->get();

		foreach ($empresas as $indexe=>$item2) {

			$documentos 	=   DocumentoSunat::where('RUC_EMPRESA','=',$item2->COD_EMPR)
								->where('IND_TOTAL','=',0)
								->orderby('IND_TOTAL','asc')
								->orderby('PERIODO','asc')
								->take(300)
						    	->get();

			$fetoken 		=	FeToken::where('COD_EMPR','=',$item2->COD_EMPR)->where('TIPO','=','COMPROBANTE_PAGO')->first();

			foreach($documentos as $index=>$item){

				$indpdf 		= 	$item->IND_PDF;
				$indxml 		= 	$item->IND_XML;

				$ruc 			= trim($item->RUC_EMPRESA_PROVEEDOR);
				$serie 			= trim($item->SERIE);
				$correlativo 	= trim($item->NUMERO);
				$td 			= trim($item->COD_TIPODOCUMENTO);
				if($td == '07'){
					$td = 'F7';
				}

				$urlxml 					= 	'https://api-cpe.sunat.gob.pe/v1/contribuyente/consultacpe/comprobantes/'.$ruc.'-'.$td.'-'.$serie.'-'.$correlativo.'-2/01';
				$respuetapdf 				=	$this->buscar_archivo_sunat_nuevo($urlxml,$fetoken);

				if($respuetapdf['cod_error'] == '0'){

			        $fileName 			= 	$respuetapdf['nombre_archivo'];
			        $base64File 		= 	$respuetapdf['valor_archivo'];
					$rutafile 			= 	"//10.1.50.2/fyg/".$item2->COD_EMPR."/".$item->PERIODO."/";
					//dd($rutafile);
                    $valor           	=   $this->versicarpetanoexiste_che($rutafile);
					$destino 			= 	"//10.1.50.2/fyg/".$item2->COD_EMPR."/".$item->PERIODO."/";

					// Asegúrate que la carpeta destino exista, si no, la creas
					if (!file_exists($destino)) {
					    mkdir($destino, 0777, true); // true para crear directorios recursivamente
					}
					// Decodificamos el contenido base64
					$fileData = base64_decode($base64File);
					// Guardamos el archivo
					$filePath = $destino . $fileName;
					file_put_contents($filePath, $fileData);
					//print_r("pdf");

					//dd($filePath);

					DB::table('DOCUMENTO_SUNAT')
					    ->where('RUC_EMPRESA_PROVEEDOR', $item->RUC_EMPRESA_PROVEEDOR)
					    ->where('SERIE', $item->SERIE)
					    ->where('NUMERO', $item->NUMERO)
					    ->where('COD_TIPODOCUMENTO', $item->COD_TIPODOCUMENTO)
					    ->update([
					        'RUTA_PDF' => $filePath,
					        'NOMBRE_PDF' => $fileName,
					        'IND_PDF' => 1,
					        'CONTADOR' => DB::raw('CONTADOR + 1'),
					        'IND_TOTAL' => 1
					    ]);
				//dd($respuetapdf);
					    //print_r("guardado");


				}else{
					DB::table('DOCUMENTO_SUNAT')
					    ->where('RUC_EMPRESA_PROVEEDOR', $item->RUC_EMPRESA_PROVEEDOR)
					    ->where('SERIE', $item->SERIE)
					    ->where('NUMERO', $item->NUMERO)
					    ->where('COD_TIPODOCUMENTO', $item->COD_TIPODOCUMENTO)
					    ->update([
					        'CONTADOR' => DB::raw('CONTADOR + 1')
					    ]);
					    print_r("x");
				}
			}
		}



	}
	private function versicarpetanoexiste_che($ruta) {
		$valor = false;
		if (!file_exists($ruta)) {
		    mkdir($ruta, 0777, true);
		    $valor=true;
		}
		return $valor;
	}




    private function buscar_archivo_sunat_nuevo($urlxml, $fetoken)
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $urlxml,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 15, // máximo 15 segundos para la respuesta
            CURLOPT_CONNECTTIMEOUT => 10, // máximo 10 segundos para conectar
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json, text/plain, */*',
                'Accept-Encoding: gzip, deflate, br, zstd',
                'Accept-Language: es-ES,es;q=0.9',
                'Origin: https://e-factura.sunat.gob.pe',
                'Referer: https://e-factura.sunat.gob.pe/',
                'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) '
                    . 'AppleWebKit/537.36 (KHTML, like Gecko) '
                    . 'Chrome/141.0.0.0 Safari/537.36',
                'Authorization: Bearer '.$fetoken->TOKEN
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $response_array = json_decode($response, true);

        if (!isset($response_array['nomArchivo'])) {
            $array_nombre_archivo = [
                'cod_error' => 1,
                'nombre_archivo' => '',
                'mensaje' => 'Hubo un problema de sunat buscar nuevamente'
            ];
        } else {
            $fileName = $response_array['nomArchivo'];
            $base64File = $response_array['valArchivo'];
            $array_nombre_archivo = [
                'cod_error' => 0,
                'nombre_archivo' => $response_array['nomArchivo'],
                'valor_archivo' => $response_array['valArchivo'],
                'mensaje' => 'encontrado con exito'
            ];
        }

        return $array_nombre_archivo;

    }

    private function sut_buscar_archivo_sunat_compra($urlxml, $fetoken)
    {

        $array_nombre_archivo = array();
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $urlxml,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $fetoken->TOKEN
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $response_array = json_decode($response, true);


        return $response_array;

    }


}