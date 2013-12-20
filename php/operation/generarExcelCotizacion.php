<?php

class generarExcelCotizacion {

    public function generarExcelCotizacion() {
        
    }

    public function createFilesCotizacion($solicitudes, $aseguradoras) {


        require_once '../Classes/PHPExcel.php';
        require_once '../Classes/PHPExcel/IOFactory.php';

        $array = array("T", "U", "V", "W", "X", "Y", "Z", "AA", "AB", "AC", "AD", "AE", "AF", "AG", "AH", "AI", "AJ", "AK", "AL", "AM", "AN", "AO", "AP", "AQ", "AR", "AS", "AT", "AU", "AV", "AW", "AX", "AY", "AZ");

        foreach ($aseguradoras as $aseguradora) {

            $objPHPExcel = new PHPExcel();
            $objPHPExcel->getProperties()->setCreator("Maarten Balliauw");
            $objPHPExcel->getProperties()->setLastModifiedBy("Maarten Balliauw");
            $objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
            $objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
            $objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");

// Add some data
            echo date('H:i:s') . " Add some data\n";
            $objPHPExcel->setActiveSheetIndex(0);
            $this->setHeader($objPHPExcel);
            $this->setHeaderCoberturas($objPHPExcel, $solicitudes, $aseguradora, $array);
            $this->saveCarros($objPHPExcel, $solicitudes, $aseguradora, $array);
           

// Rename sheet
            echo date('H:i:s') . " Rename sheet\n";
            $objPHPExcel->getActiveSheet()->setTitle('Simple');


// Save Excel 2007 file
            echo date('H:i:s') . " Write to Excel2007 format\n";
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            $objWriter->save("/tmp/pepe" . $aseguradora . ".xlsx");
        }
    }

    function setHeader($objPHPExcel) {

        $objPHPExcel->getActiveSheet()->SetCellValue('A7', 'Poliza');
        $objPHPExcel->getActiveSheet()->SetCellValue('B7', 'Certificado');
        $objPHPExcel->getActiveSheet()->SetCellValue('C7', 'Dependencia');
        $objPHPExcel->getActiveSheet()->SetCellValue('D7', 'Tomador');
        $objPHPExcel->getActiveSheet()->SetCellValue('E7', 'RIF/CI');
        $objPHPExcel->getActiveSheet()->SetCellValue('F7', 'Asegurado');
        $objPHPExcel->getActiveSheet()->SetCellValue('G7', 'RIF/CI');
        $objPHPExcel->getActiveSheet()->SetCellValue('H7', 'Cobertura');
        $objPHPExcel->getActiveSheet()->SetCellValue('I7', 'Marca');
        $objPHPExcel->getActiveSheet()->SetCellValue('J7', 'Modelo');
        $objPHPExcel->getActiveSheet()->SetCellValue('K7', 'Version');
        $objPHPExcel->getActiveSheet()->SetCellValue('L7', 'Placas');
        $objPHPExcel->getActiveSheet()->SetCellValue('M7', 'Ocupantes');
        $objPHPExcel->getActiveSheet()->SetCellValue('N7', 'Uso');
        $objPHPExcel->getActiveSheet()->SetCellValue('O7', 'Prima U.T');
        $objPHPExcel->getActiveSheet()->SetCellValue('P7', 'U.T');
        $objPHPExcel->getActiveSheet()->SetCellValue('Q7', 'Clasifi Aseg');
        $objPHPExcel->getActiveSheet()->SetCellValue('R7', 'Año');
        $objPHPExcel->getActiveSheet()->SetCellValue('S7', 'INMA');
        $objPHPExcel->getActiveSheet()->getStyle('A7:S7')->getFont()->setBold(true);
    }

    function setHeaderCoberturas($objPHPExcel, $solicitudes, $aseguradora, $array) {

        for($y=0;$y<sizeof($solicitudes);$y++){
            
        foreach ($solicitudes[$y]->re_aseguradora_cotizacion as $cotizacion_aseguradora) {


            if ($cotizacion_aseguradora->id_aseguradora == $aseguradora) {

                $coberturas = $cotizacion_aseguradora->coberturas;
                $end = "S";
                for ($x = 0; $x < sizeof($coberturas); $x++) {
                    $objPHPExcel->getActiveSheet()->SetCellValue($array[$x] . '7', html_entity_decode($coberturas[$x]->descripcion));
                    $objPHPExcel->getActiveSheet()->getColumnDimension($array[$x])->setAutoSize(true);
                    $objPHPExcel->getActiveSheet()->getStyle($array[$x] . '7')->getFont()->setBold(true);
                }
                $y=sizeof($solicitudes);
                break;
            }
        }
        }
    }
    
    function saveCarros($objPHPExcel, $solicitudes, $aseguradora, $array) {

        require_once '../../individual/tool/function_tool.php';
        $row=8;
        for($y=0;$y<sizeof($solicitudes);$y++){
            
        foreach ($solicitudes[$y]->re_aseguradora_cotizacion as $cotizacion_aseguradora) {

            if ($cotizacion_aseguradora->id_aseguradora == $aseguradora) {

                $coberturas = $cotizacion_aseguradora->coberturas;
               
                for ($x = 0; $x < sizeof($coberturas); $x++) {
          
                   
                    if ($coberturas[$x]->prima != 0) {
                        $prima = formatMoney($coberturas[$x]->prima, true);
                       
                    }
                    
                    if ($coberturas[$x]->incluida == 1)
                        $prima = "INCLUIDA";
                    
                    $objPHPExcel->getActiveSheet()->SetCellValue($array[$x] .($row+$y), html_entity_decode($prima));
                    $objPHPExcel->getActiveSheet()->getColumnDimension($array[$x])->setAutoSize(true);
                }
                break;
            }
        }
        }
    }

}

?>