<?php

class generarExcelCotizacion {

  public function generarExcelCotizacion() {
    
  }

  public function createFilesCotizacion($solicitudes, $aseguradoras) {


    require_once '../Classes/PHPExcel.php';
    require_once '../Classes/PHPExcel/IOFactory.php';
    require_once '../entity/convenio_aseguradora.php';
    require_once '../entity/cotizacion.php';

    $convenio_aseguradora = new convenio_aseguradora();
    $cotizacion_aux = new cotizacion();

    $array = array("O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "AA", "AB", "AC", "AD", "AE", "AF", "AG", "AH", "AI", "AJ", "AK", "AL", "AM", "AN", "AO", "AP", "AQ", "AR", "AS", "AT", "AU", "AV", "AW", "AX", "AY", "AZ");

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
        $datos_header = $this->saveCarros($objPHPExcel, $solicitudes, $aseguradora, $array);
        //var_dump($cotizacion_aseguradora);

        $convenio_aseguradora->id = $cotizacion_aseguradora->convenio;

        $cotizacion_aux->id = $solicitudes[0]->cotizacion->id_cotizacion;
        $cotizacion = $cotizacion_aux->find_by_id();

        $convenio = $convenio_aseguradora->find_by_id_convenio();

        $this->setHeaderEmpresa($objPHPExcel, $datos_header, $convenio, $cotizacion);
        $objPHPExcel->getActiveSheet()->getStyle('A11:AZ11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        // Rename sheet

        $objPHPExcel->getActiveSheet()->setTitle('Simple');


        // Save Excel 2007 file

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save("/tmp/Cotizacion_" . $convenio_aseguradora->id . "_".$convenio[0]->nombre.".xlsx");
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
    $objPHPExcel->getActiveSheet()->SetCellValue('A8', 'Fecha de la cotizacion');
    $objPHPExcel->getActiveSheet()->SetCellValue('B8', date("d-m-y"));
    $objPHPExcel->getActiveSheet()->getStyle('A2:A8')->getFont()->setBold(true);
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
    $objPHPExcel->getActiveSheet()->SetCellValue('N11', 'INMA');
    $objPHPExcel->getActiveSheet()->getStyle('A11:N11')->getFont()->setBold(true);
  }

  function setHeaderCoberturas($objPHPExcel, $solicitudes, $aseguradora, $array) {

    $cotizacion_aseguradora_aux = null;

    for ($y = 0; $y < sizeof($solicitudes); $y++) {

      foreach ($solicitudes[$y]->re_aseguradora_cotizacion as $cotizacion_aseguradora) {


        if ($cotizacion_aseguradora->id_aseguradora == $aseguradora) {

          $coberturas = $cotizacion_aseguradora->coberturas;
          $end = "S";


          for ($x = 0; $x < sizeof($coberturas); $x++) {
            $objPHPExcel->getActiveSheet()->SetCellValue($array[$x] . '11', html_entity_decode($coberturas[$x]->descripcion));
            $objPHPExcel->getActiveSheet()->getColumnDimension($array[$x])->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getStyle($array[$x] . '11')->getFont()->setBold(true);
          }

          $objPHPExcel->getActiveSheet()->SetCellValue($array[$x] . '11', "TOTAL");
          $objPHPExcel->getActiveSheet()->getColumnDimension($array[sizeof($coberturas)])->setAutoSize(true);
          $objPHPExcel->getActiveSheet()->getStyle($array[sizeof($coberturas)] . '11')->getFont()->setBold(true);
          $y = sizeof($solicitudes);
          $cotizacion_aseguradora_aux = $cotizacion_aseguradora;

          break;
        }
      }
    }

    return $cotizacion_aseguradora_aux;
  }

  function saveCarros($objPHPExcel, $solicitudes, $aseguradora, $array) {

    require_once '../../individual/tool/function_tool.php';
    require_once './validar_carro_cotizacion.php';

    $validar_carro_cotizacion = new validar_carro_cotizacion();
    $row = 12;
    $suma_cotizacion = 0;
    $datos_header = Array();

    for ($y = 0; $y < sizeof($solicitudes); $y++) {

      foreach ($solicitudes[$y]->re_aseguradora_cotizacion as $cotizacion_aseguradora) {

        if ($cotizacion_aseguradora->id_aseguradora == $aseguradora) {

          $coberturas = $cotizacion_aseguradora->coberturas;
          $suma_primas_coberturas = 0;
          for ($x = 0; $x < sizeof($coberturas); $x++) {


            if ($coberturas[$x]->prima != 0) {
              $prima = formatMoney($coberturas[$x]->prima, true);
              $suma_primas_coberturas = $suma_primas_coberturas + $prima;
            }

            if ($coberturas[$x]->incluida == 1)
              $prima = "INCLUIDA";

            $objPHPExcel->getActiveSheet()->SetCellValue($array[$x] . ($row + $y), html_entity_decode($prima));
            $objPHPExcel->getActiveSheet()->getColumnDimension($array[$x])->setAutoSize(true);

            if ($coberturas[$x]->id_cob_as == 5)
              $objPHPExcel->getActiveSheet()->SetCellValue('J' . ($row + $y), html_entity_decode($coberturas[$x]->valor));
          }

          $suma_cotizacion = $suma_cotizacion + $suma_primas_coberturas;

          $objPHPExcel->getActiveSheet()->SetCellValue($array[sizeof($coberturas)] . ($row + $y), formatMoney($suma_primas_coberturas, true));
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
          $objPHPExcel->getActiveSheet()->SetCellValue('N' . ($row + $y), formatMoney($solicitudes[$y]->cotizacion->valor_INMA, true));
          $objPHPExcel->getActiveSheet()->getStyle('A' . ($row + $y) . ':AZ' . ($row + $y))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

          for ($i = 0; $i <= 13; $i++) {
            $objPHPExcel->getActiveSheet()->getColumnDimension(chr(65 + $i))->setAutoSize(true);
          }

          break;
        }
      }
    }
    $datos_header["total_vehiculos"] = sizeof($solicitudes);
    $datos_header["total_cotizacion"] = formatMoney($suma_cotizacion, true);

    return $datos_header;
  }

}

?>