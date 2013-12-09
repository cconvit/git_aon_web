<?php
session_start();

require_once("../db/config.php");
require_once ('../db/database.php');

$path = $_FILES["file"]["tmp_name"];
$operation = $_REQUEST["operation_upload"];
$id_convenio_as = $_SESSION["id_convenio_as"];

if (isset($path) && isset($operation)) {
    if(isset($id_convenio_as))
        import_file($path, $operation,$id_convenio_as);
    else
        set_msg("No existe ningún convenio al cual asociar el archivo","error");
}else{
    
    set_msg("No se pudo procesar ningún archivo","error");
}

header('Location: ' . $_GET["target"]);

function import_file($path, $operation,$id_convenio_as) {
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
            set_msg("Error al importar el archivo. El archivo tiene datos errados para la importacion","error");
    }//End IF
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
        if ($reg_valido)
            create_clasificacion($data, $id_convenio_as);
        else
            set_msg("Error al importar el archivo. El archivo tiene datos errados para la importacion","error");
    }//End IF
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
            set_msg("Error al importar el archivo. El archivo tiene datos errados para la importacion","error");
    }//End IF
}

//Metodo para procesar el archivo de la carga de tasa de casco
function grua($worksheet, $nrColumns, $highestRow, $highestColumnIndex, $id_convenio_as) {

    $reg_valido = true;

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
                        $data[$row]["ano"] = $val;
                        break;
                    case 2:
                        $reg_valido = isValidType("n", $dataType);
                        $data[$row]["valor"] = $val;
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
            create_grua($data, $id_convenio_as);
        else
            set_msg("Error al importar el archivo. El archivo tiene datos errados para la importacion","error");
    }//End IF
}

################################################################################
#############CARGA DE REGISTROS A LA BASE DE DATOS##############################
################################################################################
//Crear los registros de la tasa de casco de un tipo de seguro
function create_tasa_casco($data, $id_convenio_as, $tipo_seguro) {

    //Importamos la clase para crear el objecto
    require_once '../entity/tasa_casco.php';

    foreach ($data as $tasa) {

        $tasa_casco = new tasa_casco();
        $tasa_casco->id_convenio_as = $id_convenio_as;
        $tasa_casco->id_tipo_co = $tipo_seguro;
        $tasa_casco->clasificacion = $tasa["clasificacion"];
        $tasa_casco->tipo_carro = $tasa["tipo_carro"];
        $tasa_casco->ano = $tasa["ano"];
        $tasa_casco->tasa = $tasa["tasa"];
        
        if($tasa_casco->create()){
            set_msg("La carga del archivo fue exitosa","succesfull");
            if($tipo_seguro == 1)$_SESSION["up_amplia"]="check"; else $_SESSION["up_total"]="check";
        }
        else
            set_msg("Error al importar el archivo. El archivo tiene datos errados para la importacion","error");
    }
}

//Crear los registros de la tasa de casco de un tipo de seguro
function create_clasificacion($data, $id_convenio_as) {

    //Importamos la clase para crear el objecto
    require_once '../entity/clasificacion.php';

    foreach ($data as $cla) {

        $clasificacion = new clasificacion();
        $clasificacion->id_convenio_as = $id_convenio_as;
        $clasificacion->marca = $cla["marca"];
        $clasificacion->modelo = $cla["modelo"];
        $clasificacion->clasificacion = $cla["clasificacion"];
        $clasificacion->tipo_carro = $cla["tipo_carro"];
        
        if($clasificacion->create()){
            set_msg("La carga del archivo fue exitosa","succesfull");
            $_SESSION["up_clasificacion"]="check";
        }     
        else
            set_msg("Error al importar el archivo. El archivo tiene datos errados para la importacion","error");
    }
}

//Crear los registros de la tasa de casco de un tipo de seguro
function create_segmentacion($data, $id_convenio_as) {

    //Importamos la clase para crear el objecto
    require_once '../entity/segmentacion.php';

    foreach ($data as $seg) {

        $segmentacion = new segmentacion();
        $segmentacion->id_convenio_as = $id_convenio_as;
        $segmentacion->id_estado_civil =  $seg["id_estado_civil"];
        $segmentacion->id_sexo = $seg["id_sexo"];
        $segmentacion->edad = $seg["edad"];
        $segmentacion->tasa = $seg["tasa"];
        
        if($segmentacion->create()){
            set_msg("La carga del archivo fue exitosa","succesfull");
            $_SESSION["up_segmentacion"]="check";
        }
        else
            set_msg("Error al importar el archivo. El archivo tiene datos errados para la importacion","error");
    }
}

//Crear los registros de la tasa de casco de un tipo de seguro
function create_grua($data, $id_convenio_as) {

    //Importamos la clase para crear el objecto
    require_once '../entity/grua.php';

    foreach ($data as $gr) {

        $grua = new grua();
        $grua->id_convenio_as = $id_convenio_as;
        $grua->id_tipo_carro =  $gr["id_tipo_carro"];
        $grua->ano = $gr["ano"];
        $grua->valor = $gr["valor"];
        
        if($grua->create()){
            set_msg("La carga del archivo fue exitosa","succesfull");
            $_SESSION["up_grua"]="check";
        }
        else
            set_msg("Error al importar el archivo. El archivo tiene datos errados para la importacion","error");
    }
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
    else
        return false;
}

function set_msg($msg_desc,$msg_type){
    
    $_SESSION["msg"] = "show";

    $_SESSION["msg_desc"] = $msg_desc;
    $_SESSION["msg_type"] = $msg_type;
  
}
################################################################################
############################# FIN UTILITARIOS###################################
################################################################################

?>
