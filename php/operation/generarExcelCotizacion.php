<?php

class generarExcelCotizacion {

    public function generarExcelCotizacion() {
        
    }

    public function createFilesCotizacion($solicitudes, $aseguradoras) {

        require_once '../Classes/PHPExcel.php';
        require_once '../Classes/PHPExcel/IOFactory.php';
        require_once '../entity/convenio_aseguradora.php';
        require_once '../entity/cotizacion.php';
        require_once '../entity/descarga_cotizacion.php';
        require_once '../entity/segmentacion.php';

        $convenio_aseguradora = new convenio_aseguradora();
        $cotizacion_aux = new cotizacion();
//"R", "S", "T", "U", "V",
        $array = array("W", "X", "Y", "Z", "AA", "AB", "AC", "AD", "AE", "AF", "AG", "AH", "AI", "AJ", "AK", "AL", "AM", "AN", "AO", "AP", "AQ", "AR", "AS", "AT", "AU", "AV", "AW", "AX", "AY", "AZ");
        $GLOBALS["array_cob_id"] = Array(Array());
        
        foreach ($aseguradoras as $aseguradora) {

            $objPHPExcel = new PHPExcel();
            $objPHPExcel->getProperties()->setCreator("Maarten Balliauw");
            $objPHPExcel->getProperties()->setLastModifiedBy("Maarten Balliauw");
            $objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
            $objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
            $objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");

// Add some data

            $objPHPExcel->setActiveSheetIndex(0);
            $this->setHeader($objPHPExcel);
            $cotizacion_aseguradora = $this->setHeaderCoberturas($objPHPExcel, $solicitudes, $aseguradora, $array);

            if ($cotizacion_aseguradora != null) {

                $cotizacion_aux->id = $solicitudes[0]->cotizacion->id_cotizacion;
                $cotizacion = $cotizacion_aux->find_by_id();

                $convenio_aseguradora->id = $cotizacion_aseguradora->convenio;

                $convenio = $convenio_aseguradora->find_by_id_convenio();

                $datos_header = $this->saveCarros($objPHPExcel, $solicitudes, $aseguradora, $array, $cotizacion[0], $convenio_aseguradora->id);
                //var_dump($cotizacion_aseguradora);

                $this->setHeaderEmpresa($objPHPExcel, $datos_header, $convenio, $cotizacion);
                $objPHPExcel->getActiveSheet()->getStyle('A11:AZ11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                // Rename sheet

                $objPHPExcel->getActiveSheet()->setTitle('Cotizacion');

                // Save Excel 2007 file
                $nombre = $cotizacion[0]->nombre . "_" . $cotizacion[0]->id . "_" . $convenio[0]->nombre;
                $nombre = str_replace(" ", "_", $nombre);
                $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                $objWriter->save("/Applications/XAMPP/xamppfiles/htdocs/Aon/git_aon_web/flota/files/" . $nombre . ".xlsx");
                //$objWriter->save("/Applications/XAMPP/xamppfiles/htdocs/git_aon_web/flota/files/" . $nombre . ".xlsx");
                $descarga_cotizacion = new descarga_cotizacion();
                $descarga_cotizacion->id_cotizacion = $cotizacion[0]->id;
                $descarga_cotizacion->nombre = $cotizacion[0]->nombre;
                $descarga_cotizacion->seguro = $convenio[0]->nombre;
                $descarga_cotizacion->link = "http://localhost/Aon/git_aon_web/flota/files/" . $nombre . ".xlsx";
                //$descarga_cotizacion->link = "http://localhost/git_aon_web/flota/files/" . $nombre . ".xlsx";
                $descarga_cotizacion->create();
            }
        }
    }

    function setHeaderEmpresa($objPHPExcel, $datos_header, $convenio_aseguradora, $cotizacion) {


        $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Nombre del cliente');
        $objPHPExcel->getActiveSheet()->SetCellValue('B2', $cotizacion[0]->nombre_cliente);
        $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Nombre del convenio');
        $objPHPExcel->getActiveSheet()->SetCellValue('B3', $convenio_aseguradora[0]->descripcion);
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Nombre de la flota');
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', $cotizacion[0]->empresa_flota);
        $objPHPExcel->getActiveSheet()->SetCellValue('A5', 'Póliza');
        $objPHPExcel->getActiveSheet()->SetCellValue('B5', $convenio_aseguradora[0]->num_poliza);
        $objPHPExcel->getActiveSheet()->SetCellValue('A6', 'Total vehiculos');
        $objPHPExcel->getActiveSheet()->SetCellValue('B6', $datos_header["total_vehiculos"]);
        $objPHPExcel->getActiveSheet()->SetCellValue('A7', 'Total cotizacion');
        $objPHPExcel->getActiveSheet()->SetCellValue('B7', $datos_header["total_cotizacion"]);
        //$objPHPExcel->getActiveSheet()->SetCellValue('B7', $datos_header["total_cotizacion"]);
        //$objPHPExcel->getActiveSheet()->SetCellValue('C7', 'Total cotizacion prorrateo');
        //$objPHPExcel->getActiveSheet()->SetCellValue('D7', $datos_header["total_cotizacion_prorrateo"]);
        $objPHPExcel->getActiveSheet()->SetCellValue('A8', 'Fecha de la cotización');
        $objPHPExcel->getActiveSheet()->SetCellValue('B8', date("d-m-y") . " al " . $datos_header["validez_fin"]);
        //$objPHPExcel->getActiveSheet()->SetCellValue('C8', 'Fechas de validez de la cotización');
        //$objPHPExcel->getActiveSheet()->SetCellValue('D8', date("d-m-y")." al ".$datos_header["validez_fin"]);
        $objPHPExcel->getActiveSheet()->getStyle('A2:A8')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C7:C8')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
    }

    function setHeader($objPHPExcel) {


        $objPHPExcel->getActiveSheet()->SetCellValue('A11', 'RIF/CI');
        $objPHPExcel->getActiveSheet()->SetCellValue('B11', 'Asegurado');
        $objPHPExcel->getActiveSheet()->SetCellValue('C11', 'Cobertura');
        $objPHPExcel->getActiveSheet()->SetCellValue('D11', 'Marca');
        $objPHPExcel->getActiveSheet()->SetCellValue('E11', 'Modelo');
        $objPHPExcel->getActiveSheet()->SetCellValue('F11', 'Version');
        $objPHPExcel->getActiveSheet()->SetCellValue('G11', 'Placas');
        $objPHPExcel->getActiveSheet()->SetCellValue('H11', 'Ocupantes');
        $objPHPExcel->getActiveSheet()->SetCellValue('I11', 'Uso');
        $objPHPExcel->getActiveSheet()->SetCellValue('J11', 'Prima U.T');
        $objPHPExcel->getActiveSheet()->SetCellValue('K11', 'U.T');
        $objPHPExcel->getActiveSheet()->SetCellValue('L11', 'Clasifi Aseg');
        $objPHPExcel->getActiveSheet()->SetCellValue('M11', 'Año');
        $objPHPExcel->getActiveSheet()->SetCellValue('N11', 'Edad');
        $objPHPExcel->getActiveSheet()->SetCellValue('O11', 'Sexo');
        $objPHPExcel->getActiveSheet()->SetCellValue('P11', 'Edo. Civil');
        $objPHPExcel->getActiveSheet()->SetCellValue('Q11', 'INMA');
        $objPHPExcel->getActiveSheet()->SetCellValue('R11', '% INMA');
        $objPHPExcel->getActiveSheet()->SetCellValue('S11', "Suma Asegurada");
        $objPHPExcel->getActiveSheet()->SetCellValue('T11', 'Tasa bruta');
        $objPHPExcel->getActiveSheet()->SetCellValue('U11', '% Segmentación');
        $objPHPExcel->getActiveSheet()->SetCellValue('V11', 'Tasa neta');
        
        $objPHPExcel->getActiveSheet()->getStyle('A11:V11')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
    }

    function setHeaderCoberturas($objPHPExcel, $solicitudes, $aseguradora, $array) {

        $cotizacion_aseguradora_aux = null;
        $tasa_casco = false;
        $coberturas = null;
        for ($y = 0; $y < sizeof($solicitudes); $y++) {

            foreach ($solicitudes[$y]->re_aseguradora_cotizacion as $cotizacion_aseguradora) {


                if ($cotizacion_aseguradora->id_aseguradora == $aseguradora) {

                    if ($solicitudes[$y]->cotizacion->tipo_cobertura == 1 || $solicitudes[$y]->cotizacion->tipo_cobertura == 2) {
                        $coberturas = $cotizacion_aseguradora->coberturas;
                        $cotizacion_aseguradora_aux=$cotizacion_aseguradora;
                        $y = sizeof($solicitudes);
                        break;
                    } else {
                        $coberturas = $cotizacion_aseguradora->coberturas;
                        $cotizacion_aseguradora_aux=$cotizacion_aseguradora;
                    }
                }
            }
        }
        for ($x = 0; $x < sizeof($coberturas); $x++) {

            $GLOBALS["array_cob_id"][0][$x] = $coberturas[$x]->id_cob_as;
            $GLOBALS["array_cob_id"][1][$x] = $array[$x];
            $objPHPExcel->getActiveSheet()->SetCellValue($array[$x] . '11', html_entity_decode($coberturas[$x]->descripcion));
            $objPHPExcel->getActiveSheet()->getColumnDimension($array[$x])->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getStyle($array[$x] . '11')->getFont()->setBold(true);
        }

        $GLOBALS["index_total"] = sizeof($coberturas);
        $objPHPExcel->getActiveSheet()->SetCellValue($array[sizeof($coberturas)] . '11', "TOTAL");
        //$objPHPExcel->getActiveSheet()->SetCellValue($array[sizeof($coberturas)+1] . '11', "TOTAL PRORATEO");
        $objPHPExcel->getActiveSheet()->getColumnDimension($array[sizeof($coberturas)])->setAutoSize(true);
        //$objPHPExcel->getActiveSheet()->getColumnDimension($array[sizeof($coberturas)+1])->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getStyle($array[sizeof($coberturas)] . '11')->getFont()->setBold(true);
        //$objPHPExcel->getActiveSheet()->getStyle($array[sizeof($coberturas)+1] . '11')->getFont()->setBold(true);
        $y = sizeof($solicitudes);


        return $cotizacion_aseguradora_aux;
    }

    function saveCarros($objPHPExcel, $solicitudes, $aseguradora, $array, $coti, $convenio_id) {

        require_once '../../individual/tool/function_tool.php';
        require_once './validar_carro_cotizacion.php';

        $validar_carro_cotizacion = new validar_carro_cotizacion();
        $row = 12;
        $suma_cotizacion = 0;
        $datos_header = Array();
        $dias = 0;

        for ($y = 0; $y < sizeof($solicitudes); $y++) {



            $contador = false;
            for ($z = 0; $z < sizeof($solicitudes[$y]->re_aseguradora_cotizacion); $z++) {

                $cotizacion_aseguradora = $solicitudes[$y]->re_aseguradora_cotizacion[$z];

                //  foreach ($solicitudes[$y]->re_aseguradora_cotizacion as $cotizacion_aseguradora) {

                if ($cotizacion_aseguradora->id_aseguradora == $aseguradora) {
                    $contador = true;
                    $coberturas = $cotizacion_aseguradora->coberturas;
                    $suma_primas_coberturas = 0;

                    $objPHPExcel->getActiveSheet()->SetCellValue('R' . ($row + $y), $coberturas[0]->tasa);
                    $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
                    
                    $tasa_bruta=0;

                    for ($x = 0; $x < sizeof($coberturas); $x++) {

                        if($coberturas[$x]->id_cob_as == 1 || $coberturas[$x]->id_cob_as == 2){
                            
                            $tasa_bruta=$coberturas[$x]->tasa;
                            
                        }
                        $prima=0;
                        if ($coberturas[$x]->prima != 0) {
                            $prima = formatMoney($coberturas[$x]->prima, true);
                            $prinma_aux = str_replace(".", "", $prima);
                            $prinma_aux = str_replace(",", ".", $prinma_aux);

                            $suma_primas_coberturas = $suma_primas_coberturas + $prinma_aux;
                        }

                        if ($coberturas[$x]->incluida == 1)
                            $prima = "INCLUIDA";

                        for ($w = 0; $w < sizeof($GLOBALS["array_cob_id"][0]); $w++) {

                            if ($GLOBALS["array_cob_id"][0][$w] == $coberturas[$x]->id_cob_as) {
                                $objPHPExcel->getActiveSheet()->SetCellValue($GLOBALS["array_cob_id"][1][$w] . ($row + $y), html_entity_decode($prima));
                                $objPHPExcel->getActiveSheet()->getColumnDimension($GLOBALS["array_cob_id"][1][$w])->setAutoSize(true);
                                break;
                            }
                        }
                        if ($coberturas[$x]->id_cob_as == 5)
                            $objPHPExcel->getActiveSheet()->SetCellValue('J' . ($row + $y), html_entity_decode($coberturas[$x]->valor));
                    }

                    $suma_cotizacion = $suma_cotizacion + $suma_primas_coberturas;
                    //Prorrateo
                    $fecha_fin = $solicitudes[$y]->flota->validez_fin;
                    $dias = (strtotime(date('Y-m-d')) - strtotime($fecha_fin)) / 86400;
                    $dias = abs($dias);
                    $dias = floor($dias);
                    $total_fechas = ($suma_primas_coberturas / 365) * $dias;
                    $datos_header["validez_fin"] = $fecha_fin;

                    //$objPHPExcel->getActiveSheet()->SetCellValue($array[$GLOBALS["index_total"]] . ($row + $y), formatMoney($suma_primas_coberturas, true));
                    $objPHPExcel->getActiveSheet()->SetCellValue($array[$GLOBALS["index_total"]] . ($row + $y), formatMoney($total_fechas, true));

                    $objPHPExcel->getActiveSheet()->getColumnDimension($array[sizeof($coberturas)])->setAutoSize(true);

                    $objPHPExcel->getActiveSheet()->SetCellValue('A' . ($row + $y), $solicitudes[$y]->cotizacion->identificacion);
                    $objPHPExcel->getActiveSheet()->SetCellValue('B' . ($row + $y), $solicitudes[$y]->cotizacion->asegurado);
                    $objPHPExcel->getActiveSheet()->SetCellValue('C' . ($row + $y), $validar_carro_cotizacion->getCobertura($solicitudes[$y]->cotizacion->tipo_cobertura)); //Cambiar por descripcion
                    $objPHPExcel->getActiveSheet()->SetCellValue('D' . ($row + $y), $solicitudes[$y]->cotizacion->car_marca);
                    $objPHPExcel->getActiveSheet()->SetCellValue('E' . ($row + $y), $solicitudes[$y]->cotizacion->car_modelo);
                    $objPHPExcel->getActiveSheet()->SetCellValue('F' . ($row + $y), $solicitudes[$y]->cotizacion->car_version);
                    $objPHPExcel->getActiveSheet()->SetCellValue('G' . ($row + $y), $solicitudes[$y]->cotizacion->placa);
                    $objPHPExcel->getActiveSheet()->SetCellValue('H' . ($row + $y), $solicitudes[$y]->cotizacion->car_ocupantes);
                    $objPHPExcel->getActiveSheet()->SetCellValue('I' . ($row + $y), $validar_carro_cotizacion->getTipoCarro($solicitudes[$y]->cotizacion->tipo_carro));
                    $objPHPExcel->getActiveSheet()->SetCellValue('K' . ($row + $y), $solicitudes[$y]->parametros[0]->valor);
                    $objPHPExcel->getActiveSheet()->SetCellValue('L' . ($row + $y), $cotizacion_aseguradora->clasificacion);
                    $objPHPExcel->getActiveSheet()->SetCellValue('M' . ($row + $y), $solicitudes[$y]->cotizacion->car_ano);
                    $objPHPExcel->getActiveSheet()->SetCellValue('N' . ($row + $y), $solicitudes[$y]->cotizacion->edad);
                    $objPHPExcel->getActiveSheet()->SetCellValue('O' . ($row + $y), $validar_carro_cotizacion->getSexo($solicitudes[$y]->cotizacion->sexo));
                    $objPHPExcel->getActiveSheet()->SetCellValue('P' . ($row + $y), $validar_carro_cotizacion->getEstadoCivil($solicitudes[$y]->cotizacion->estado_civil));
                   
                    $objPHPExcel->getActiveSheet()->SetCellValue('Q' . ($row + $y), formatMoney($solicitudes[$y]->cotizacion->valor_INMA, true));
                    $inma = $solicitudes[$y]->cotizacion->valor_INMA;
                    $por_inma = $solicitudes[$y]->cotizacion->porcentaje_inma;
                    $suma_asegurada = $inma + ($inma * $por_inma / 100);
                    $objPHPExcel->getActiveSheet()->SetCellValue('S' . ($row + $y), formatMoney($suma_asegurada, true));
                    $objPHPExcel->getActiveSheet()->SetCellValue('R' . ($row + $y), $por_inma);
                    $objPHPExcel->getActiveSheet()->SetCellValue('T' . ($row + $y), $tasa_bruta);

                    //Segmentacion

                    $estado_civil = $solicitudes[$y]->cotizacion->estado_civil;
                    $sexo = $solicitudes[$y]->cotizacion->sexo;
                    $edad = $solicitudes[$y]->cotizacion->edad;
                    $segmentacion = $this->getSegmentacion($convenio_id, $estado_civil, $sexo, $edad);
                    $objPHPExcel->getActiveSheet()->SetCellValue('U' . ($row + $y), $segmentacion);
                    $tasa_neta=$tasa_bruta+($tasa_bruta*($segmentacion/100));
                    $objPHPExcel->getActiveSheet()->SetCellValue('V' . ($row + $y), $tasa_neta);

                    $objPHPExcel->getActiveSheet()->getStyle('A' . ($row + $y) . ':AZ' . ($row + $y))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                    for ($i = 0; $i <= 14; $i++) {
                        $objPHPExcel->getActiveSheet()->getColumnDimension(chr(65 + $i))->setAutoSize(true);
                    }

                    break;
                }
            }

            if (!$contador) {

                $objPHPExcel->getActiveSheet()->SetCellValue('A' . ($row + $y), $solicitudes[$y]->cotizacion->identificacion);
                $objPHPExcel->getActiveSheet()->SetCellValue('B' . ($row + $y), $solicitudes[$y]->cotizacion->asegurado);
                $objPHPExcel->getActiveSheet()->SetCellValue('C' . ($row + $y), $validar_carro_cotizacion->getCobertura($solicitudes[$y]->cotizacion->tipo_cobertura)); //Cambiar por descripcion
                $objPHPExcel->getActiveSheet()->SetCellValue('D' . ($row + $y), $solicitudes[$y]->cotizacion->car_marca);
                $objPHPExcel->getActiveSheet()->SetCellValue('E' . ($row + $y), $solicitudes[$y]->cotizacion->car_modelo);
                $objPHPExcel->getActiveSheet()->SetCellValue('F' . ($row + $y), $solicitudes[$y]->cotizacion->car_version);
                $objPHPExcel->getActiveSheet()->SetCellValue('G' . ($row + $y), $solicitudes[$y]->cotizacion->placa);
                $objPHPExcel->getActiveSheet()->SetCellValue('H' . ($row + $y), $solicitudes[$y]->cotizacion->car_ocupantes);
                $objPHPExcel->getActiveSheet()->SetCellValue('I' . ($row + $y), $validar_carro_cotizacion->getTipoCarro($solicitudes[$y]->cotizacion->tipo_carro));
                $objPHPExcel->getActiveSheet()->SetCellValue('K' . ($row + $y), $solicitudes[$y]->parametros[0]->valor);
                $objPHPExcel->getActiveSheet()->SetCellValue('M' . ($row + $y), $solicitudes[$y]->cotizacion->car_ano);
                $objPHPExcel->getActiveSheet()->SetCellValue('N' . ($row + $y), $solicitudes[$y]->cotizacion->edad);
                $objPHPExcel->getActiveSheet()->SetCellValue('O' . ($row + $y), $validar_carro_cotizacion->getSexo($solicitudes[$y]->cotizacion->sexo));
                $objPHPExcel->getActiveSheet()->SetCellValue('P' . ($row + $y), $validar_carro_cotizacion->getEstadoCivil($solicitudes[$y]->cotizacion->estado_civil));
                   
                $objPHPExcel->getActiveSheet()->SetCellValue('Q' . ($row + $y), formatMoney($solicitudes[$y]->cotizacion->valor_INMA, true));
                $inma = $solicitudes[$y]->cotizacion->valor_INMA;
                $por_inma = $solicitudes[$y]->cotizacion->porcentaje_inma;
                $suma_asegurada = $inma + ($inma * $por_inma / 100);
                $objPHPExcel->getActiveSheet()->SetCellValue('S' . ($row + $y), formatMoney($suma_asegurada, true));
                $objPHPExcel->getActiveSheet()->SetCellValue('R' . ($row + $y), $por_inma);
                $objPHPExcel->getActiveSheet()->SetCellValue('T' . ($row + $y),"0");
                $objPHPExcel->getActiveSheet()->SetCellValue('V' . ($row + $y), "0");
                $objPHPExcel->getActiveSheet()->SetCellValue('U' . ($row + $y), "0");

                $objPHPExcel->getActiveSheet()->getStyle('A' . ($row + $y) . ':AZ' . ($row + $y))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->SetCellValue('L' . ($row + $y), "No se pudo clasificar");
            }
        }
        $datos_header["total_vehiculos"] = sizeof($solicitudes);
        $datos_header["total_cotizacion"] = formatMoney(($suma_cotizacion / 365) * $dias, true);
        //$datos_header["total_cotizacion"] = formatMoney($suma_cotizacion, true);
        //$datos_header["total_cotizacion_prorrateo"] = formatMoney(($suma_cotizacion/365)*$dias, true);


        return $datos_header;
    }

    function getSegmentacion($id_convenio, $estado_civil, $sexo, $edad) {


        $segmentacion = new segmentacion();
        $segmentacion->id_convenio_as = $id_convenio;
        $segmentacion->id_estado_civil = $estado_civil;
        $segmentacion->id_sexo = $sexo;
        $segmentacion->edad = $edad;

        $array_segmentacion = $segmentacion->find_tasa();

        foreach ($array_segmentacion as $item) {
            return $item->tasa;
        }
        return "0";
    }

}

?>
