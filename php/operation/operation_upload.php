<?php

session_start();

require_once("../db/config.php");
require_once ('../db/database.php');

$path = $_FILES["file"]["tmp_name"];
$operation = $_REQUEST["operation_upload"];
$id_convenio_as = $_SESSION["id_convenio_as"];

if (isset($path) && isset($operation)) {
    if (isset($id_convenio_as)) {
        try {
            $mimes = array(
                'text/csv',
                'text/plain',
                'application/csv',
                'text/comma-separated-values',
                'application/excel',
                'application/vnd.ms-excel',
                'application/vnd.msexcel',
                'text/anytext',
                'application/octet-stream',
                'application/txt',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            );
           
            if (in_array($_FILES['file']['type'], $mimes)) {
                import_file($path, $operation, $id_convenio_as);
            } else {
                set_msg("Ocurrió un error en el proceso de carga de datos. Verifique el formato del archivo excel. Si el error persiste comuniquese con el administrador del sistema.", "error");
            }
        } catch (Exception $e) {
            set_msg("Ocurrió un error en el proceso de carga de datos. Verifique el formato del archivo excel. Si el error persiste comuniquese con el administrador del sistema.", "error");
        }
    } else
        set_msg("No existe ningún convenio al cual asociar el archivo.", "error");
}else {

    set_msg("No se pudo procesar ningún archivo", "error");
}

header('Location: ' . $_GET["target"]);

function import_file($path, $operation, $id_convenio_as) {
//Verificamos si tenemos las variables necesarioas para realizar la importacion


    require_once '../Classes/PHPExcel.php';
    require_once '../Classes/PHPExcel/IOFactory.php';
    $objPHPExcel = PHPExcel_IOFactory::load($path);
    foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {


        $highestRow = $worksheet->getHighestRow(); // e.g. 10
        $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $nrColumns = ord($highestColumn) - 64;

        switch ($operation) {

            case 1:
                //Cobertura amplia
                tasa_casco($worksheet, $nrColumns, $highestRow, $highestColumnIndex, "1", $id_convenio_as);

                break;
            case 2:
                //Perdida total
                tasa_casco($worksheet, $nrColumns, $highestRow, $highestColumnIndex, "2", $id_convenio_as);
                break;
            case 3:
                //Perdida total
                clasificacion($worksheet, $nrColumns, $highestRow, $highestColumnIndex, $id_convenio_as);
                break;
            case 4:
                //Segmentacion
                segmentacion($worksheet, $nrColumns, $highestRow, $highestColumnIndex, $id_convenio_as);
                break;
            case 5:
                //Segmentacion
                grua($worksheet, $nrColumns, $highestRow, $highestColumnIndex, $id_convenio_as);
                break;
            case 6:
                //Perdida total
                clasificacion_ma($worksheet, $nrColumns, $highestRow, $highestColumnIndex, $id_convenio_as);
                break;
        }
    }
}

//Metodo para procesar el archivo de la carga de tasa de casco
function tasa_casco($worksheet, $nrColumns, $highestRow, $highestColumnIndex, $tipo_seguro, $id_convenio_as) {

    $reg_valido = true;

    //Verificamos que el archivo tenga las columnas determinadas para esta importacion
    if (($nrColumns == 4) && ($highestRow > 1)) {

        //Iteramos sobre las filas
        for ($row = 2; $row <= $highestRow; ++$row) {
            //Iteramos sobre las columnas
            for ($col = 0; $col < $highestColumnIndex; ++$col) {
                //Obtenemos la informacion de la celda
                $cell = $worksheet->getCellByColumnAndRow($col, $row);
                $val = $cell->getValue();
                $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);

                //Asignamos el valor de la celda en un array
                switch ($col) {
                    case 0:
                        $reg_valido = isValidType("s", $dataType);
                        $data[$row]["clasificacion"] = $val;
                        break;
                    case 1:
                        $reg_valido = isValidType("n", $dataType);
                        $data[$row]["tipo_carro"] = $val;
                        break;
                    case 2:
                        $reg_valido = isValidType("n", $dataType);
                        $data[$row]["ano"] = $val;
                        break;
                    case 3:
                        $reg_valido = isValidType("n", $dataType);
                        $data[$row]["tasa"] = $val;
                        break;
                }//End switch
                //Verificamos si todos los datos estaban correctos

                if (!$reg_valido) {
                    $col = $highestColumnIndex;
                    $row = $highestRow;
                }
            }//End for COL
        }//End for ROW
        //Si todos los registros estan correctos entonces procedemos a guardar en la base de datos
        if ($reg_valido)
            create_tasa_casco($data, $id_convenio_as, $tipo_seguro);
        else
            set_msg("Error al importar el archivo. El archivo tiene datos errados para la importación.", "error");
    }//End IF
    else{
        set_msg("Error al importar el archivo. El archivo tiene datos errados para la importación.", "error");
    }
}

//Metodo para procesar el archivo de la carga de tasa de casco
function clasificacion($worksheet, $nrColumns, $highestRow, $highestColumnIndex, $id_convenio_as) {

    $reg_valido = true;
    //Verificamos que el archivo tenga las columnas determinadas para esta importacion
    if (($nrColumns == 4) && ($highestRow > 1)) {

        //Iteramos sobre las filas
        for ($row = 2; $row <= $highestRow; ++$row) {
            //Iteramos sobre las columnas
            for ($col = 0; $col < $highestColumnIndex; ++$col) {
                //Obtenemos la informacion de la celda
                $cell = $worksheet->getCellByColumnAndRow($col, $row);
                $val = $cell->getValue();
                $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);

                //Asignamos el valor de la celda en un array
                switch ($col) {
                    case 0:
                        $reg_valido = isValidType("s", $dataType);
                        $data[$row]["marca"] = $val;
                        break;
                    case 1:

                        $data[$row]["modelo"] = $val;
                        break;
                    case 2:

                        $data[$row]["clasificacion"] = $val;
                        break;
                    case 3:
                        $reg_valido = isValidType("n", $dataType);
                        $data[$row]["tipo_carro"] = $val;
                        break;
                }//End switch
                //Verificamos si todos los datos estaban correctos

                if (!$reg_valido) {
                    $col = $highestColumnIndex;
                    $row = $highestRow;
                }
            }//End for COL
        }//End for ROW
        //Si todos los registros estan correctos entonces procedemos a guardar en la base de datos
        if ($reg_valido){
            create_clasificacion($data, $id_convenio_as);
        }
        else{
            set_msg("Error al importar el archivo. El archivo tiene datos errados para la importación.", "error");
        }
    }//End IF
    else{
        
        set_msg("Error al importar el archivo. El archivo tiene datos errados para la importación.", "error");
    }
}
//Metodo para procesar el archivo de la carga de tasa de casco
function clasificacion_ma($worksheet, $nrColumns, $highestRow, $highestColumnIndex, $id_convenio_as) {

    $reg_valido = true;
    //Verificamos que el archivo tenga las columnas determinadas para esta importacion
    if (($nrColumns > 4) && ($highestRow > 1)) {

        //Iteramos sobre las filas
        for ($row = 2; $row <= $highestRow; ++$row) {
            //Iteramos sobre las columnas
            for ($col = 0; $col < 5; ++$col) {
                //Obtenemos la informacion de la celda
                $cell = $worksheet->getCellByColumnAndRow($col, $row);
                $val = $cell->getValue();
                $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);

                //Asignamos el valor de la celda en un array
                switch ($col) {
                    case 0:
                        $reg_valido = isValidType("s", $dataType);
                        $data[$row]["marca"] = $val;
                        break;
                    case 1:

                        $data[$row]["modelo"] = $val;
                        break;
                    case 2:

                        $data[$row]["clasificacion"] = $val;
                        break;
                    case 3:
                        $reg_valido = isValidType("n", $dataType);
                        $data[$row]["tipo_carro"] = $val;
                        break;
                }//End switch
                //Verificamos si todos los datos estaban correctos

                if (!$reg_valido) {
                    $col = $highestColumnIndex;
                    $row = $highestRow;
                }
            }//End for COL
        }//End for ROW
        //Si todos los registros estan correctos entonces procedemos a guardar en la base de datos
        if ($reg_valido){
            create_clasificacion($data, $id_convenio_as);
        }
        else{
            set_msg("Error al importar el archivo. El archivo tiene datos errados para la importación.", "error");
        }
    }//End IF
    else{
        
        set_msg("Error al importar el archivo. El archivo tiene datos errados para la importación.", "error");
    }
}

//Metodo para procesar el archivo de la carga de tasa de casco
function segmentacion($worksheet, $nrColumns, $highestRow, $highestColumnIndex, $id_convenio_as) {

    $reg_valido = true;

    //Verificamos que el archivo tenga las columnas determinadas para esta importacion
    if (($nrColumns == 4) && ($highestRow > 1)) {

        //Iteramos sobre las filas
        for ($row = 2; $row <= $highestRow; ++$row) {
            //Iteramos sobre las columnas
            for ($col = 0; $col < $highestColumnIndex; ++$col) {
                //Obtenemos la informacion de la celda
                $cell = $worksheet->getCellByColumnAndRow($col, $row);
                $val = $cell->getValue();
                $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);

                //Asignamos el valor de la celda en un array
                switch ($col) {
                    case 0:
                        $reg_valido = isValidType("n", $dataType);
                        $data[$row]["id_estado_civil"] = $val;
                        break;
                    case 1:
                        $reg_valido = isValidType("n", $dataType);
                        $data[$row]["id_sexo"] = $val;
                        break;
                    case 2:
                        $reg_valido = isValidType("n", $dataType);
                        $data[$row]["edad"] = $val;
                        break;
                    case 3:
                        $reg_valido = isValidType("n", $dataType);
                        $data[$row]["tasa"] = $val;
                        break;
                }//End switch
                //Verificamos si todos los datos estaban correctos

                if (!$reg_valido) {
                    $col = $highestColumnIndex;
                    $row = $highestRow;
                }
            }//End for COL
        }//End for ROW
        //Si todos los registros estan correctos entonces procedemos a guardar en la base de datos
        if ($reg_valido)
            create_segmentacion($data, $id_convenio_as);
        else
            set_msg("Error al importar el archivo. El archivo tiene datos errados para la importación.", "error");
    }//End IF
    else {
        set_msg("Error al importar el archivo. El archivo tiene datos errados para la importación.", "error");
    }
}

//Metodo para procesar el archivo de la carga de tasa de casco
function grua($worksheet, $nrColumns, $highestRow, $highestColumnIndex, $id_convenio_as) {

    //Verificamos que el archivo tenga las columnas determinadas para esta importacion
    if (($nrColumns == 3) && ($highestRow > 1)) {

        //Iteramos sobre las filas
        for ($row = 2; $row <= $highestRow; ++$row) {
            //Iteramos sobre las columnas
            for ($col = 0; $col < $highestColumnIndex; ++$col) {
                //Obtenemos la informacion de la celda
                $cell = $worksheet->getCellByColumnAndRow($col, $row);
                $val = $cell->getValue();
                $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);

                //Asignamos el valor de la celda en un array
                switch ($col) {
                    case 0:
                        $reg_valido = isValidType("n", $dataType);
                        $data[$row]["id_tipo_carro"] = $val;
                        break;
                    case 1:
                        
                        $reg_valido = isValidType("n", $dataType);
                        if(!$reg_valido)$reg_valido = isValidType("f", $dataType);
                        $data[$row]["ano"] = $val;
                        break;
                    case 2:
                        
                        $reg_valido = isValidType("n", $dataType);
                        $data[$row]["valor"] = $val;
                        break;
                }//End switch
                //Verificamos si todos los datos estaban correctos

                if (!$reg_valido) {
                    echo "cual";
                    $col = $highestColumnIndex;
                    $row = $highestRow;
                }
            }//End for COL
        }//End for ROW
        //Si todos los registros estan correctos entonces procedemos a guardar en la base de datos
        if ($reg_valido)
            create_grua($data, $id_convenio_as);
        else
            set_msg("Error al importar el archivo. El archivo tiene datos errados para la importación.", "error");
    }//End IF
    else{
        set_msg("Error al importar el archivo. El archivo tiene datos errados para la importación.", "error");
    }
}

################################################################################
#############CARGA DE REGISTROS A LA BASE DE DATOS##############################
################################################################################
//Crear los registros de la tasa de casco de un tipo de seguro

function create_tasa_casco($data, $id_convenio_as, $tipo_seguro) {

    //Importamos la clase para crear el objecto
    require_once '../entity/tasa_casco.php';
    require_once '../entity/convenio_aseguradora.php';
    
        $carga_exitosa=true;
        $tasa_casco2 = new tasa_casco();
        $tasa_casco2->id_convenio_as = $id_convenio_as;
        $tasa_casco2->id_tipo_co = $tipo_seguro;
        $tasa_casco2->delete_by_convenio_tipo_seguro();
        
    foreach ($data as $tasa) {

        $tasa_casco = new tasa_casco();
        $tasa_casco->id_convenio_as = $id_convenio_as;
        $tasa_casco->id_tipo_co = $tipo_seguro;
        $tasa_casco->clasificacion = $tasa["clasificacion"];
        $tasa_casco->tipo_carro = $tasa["tipo_carro"];
        $tasa_casco->ano = $tasa["ano"];
        $tasa_casco->tasa = $tasa["tasa"];
                    
        if (!$tasa_casco->create()) 
           $carga_exitosa=false;
        
           
    }
    
    if($carga_exitosa){
        $convenio_aseguradora=new convenio_aseguradora();
        $convenio_aseguradora->id=$id_convenio_as;
        $aux=$convenio_aseguradora->find_by_id_convenio();
        
        set_msg("La carga del archivo fue exitosa", "succesfull");
            if ($tipo_seguro == 1)
               $aux[0]->up_amplia=1;
            else
                $aux[0]->up_total=1;
        $aux[0]->update_flags_by_id();
    }else   
             set_msg("Error al importar el archivo. El archivo tiene datos errados para la importación.", "error");
}

//Crear los registros de la tasa de casco de un tipo de seguro
function create_clasificacion($data, $id_convenio_as) {

    //Importamos la clase para crear el objecto
    require_once '../entity/clasificacion.php';
    require_once '../entity/convenio_aseguradora.php';
    $carga_exitosa=true;
    $clasificacion = new clasificacion();
    $clasificacion->id_convenio_as = $id_convenio_as;
    $clasificacion->delete_by_convenio();
    
    foreach ($data as $cla) {

        $clasificacion = new clasificacion();
        $clasificacion->id_convenio_as = $id_convenio_as;
        $clasificacion->marca = $cla["marca"];
        $clasificacion->modelo = $cla["modelo"];
        $clasificacion->clasificacion = $cla["clasificacion"];
        $clasificacion->tipo_carro = $cla["tipo_carro"];

        if (!$clasificacion->create()) {
            $carga_exitosa=false;
    }
    }
    if($carga_exitosa){
        $convenio_aseguradora=new convenio_aseguradora();
        $convenio_aseguradora->id=$id_convenio_as;
        $aux=$convenio_aseguradora->find_by_id_convenio();
        
        set_msg("La carga del archivo fue exitosa", "succesfull");
        
        $aux[0]->up_clasificacion=1;
        $aux[0]->update_flags_by_id();
    }else   
             set_msg("Error al importar el archivo. El archivo tiene datos errados para la importación.", "error");
}

//Crear los registros de la tasa de casco de un tipo de seguro
function create_segmentacion($data, $id_convenio_as) {

    //Importamos la clase para crear el objecto
    require_once '../entity/segmentacion.php';
    require_once '../entity/convenio_aseguradora.php';
    $carga_exitosa=true;
    $segmentacion = new segmentacion();
    $segmentacion->id_convenio_as = $id_convenio_as;
    $segmentacion->delete_by_convenio();
    
    foreach ($data as $seg) {

        $segmentacion = new segmentacion();
        $segmentacion->id_convenio_as = $id_convenio_as;
        $segmentacion->id_estado_civil = $seg["id_estado_civil"];
        $segmentacion->id_sexo = $seg["id_sexo"];
        $segmentacion->edad = $seg["edad"];
        $segmentacion->tasa = $seg["tasa"];

        if (!$segmentacion->create()) {
            $carga_exitosa=false;
    }
    }
    if($carga_exitosa){
        $convenio_aseguradora=new convenio_aseguradora();
        $convenio_aseguradora->id=$id_convenio_as;
        $aux=$convenio_aseguradora->find_by_id_convenio();
        
        set_msg("La carga del archivo fue exitosa", "succesfull");
        
        $aux[0]->up_segmentacion=1;
        $aux[0]->update_flags_by_id();
    }else   
             set_msg("Error al importar el archivo. El archivo tiene datos errados para la importación.", "error");
}

//Crear los registros de la tasa de casco de un tipo de seguro
function create_grua($data, $id_convenio_as) {

    //Importamos la clase para crear el objecto
    require_once '../entity/grua.php';
    require_once '../entity/convenio_aseguradora.php';
    $carga_exitosa=true;
    $grua = new grua();
    $grua->id_convenio_as = $id_convenio_as;
    $grua->delete_by_convenio();
    
    foreach ($data as $gr) {

        $grua = new grua();
        $grua->id_convenio_as = $id_convenio_as;
        $grua->id_tipo_carro = $gr["id_tipo_carro"];
        $grua->ano = $gr["ano"];
        $grua->valor = $gr["valor"];

        if (!$grua->create()) {
            $carga_exitosa=false;
    }
    }
    if($carga_exitosa){
        $convenio_aseguradora=new convenio_aseguradora();
        $convenio_aseguradora->id=$id_convenio_as;
        $aux=$convenio_aseguradora->find_by_id_convenio();
        
        set_msg("La carga del archivo fue exitosa", "succesfull");
           
        $aux[0]->up_grua=1;
        $aux[0]->update_flags_by_id();
    }else   
             set_msg("Error al importar el archivo. El archivo tiene datos errados para la importación.", "error");
}

################################################################################
#############FIN CARGA DE REGISTROS A LA BASE DE DATOS##########################
################################################################################
################################################################################
#############################UTILITARIOS########################################
################################################################################

function isValidType($req_dataType, $dataType) {

    if ($dataType == $req_dataType)
        return true;
    else{
        return false;
        }
}

function set_msg($msg_desc, $msg_type) {

    $_SESSION["msg"] = "show";

    $_SESSION["msg_desc"] = $msg_desc;
    $_SESSION["msg_type"] = $msg_type;
}

################################################################################
############################# FIN UTILITARIOS###################################
################################################################################
?>
