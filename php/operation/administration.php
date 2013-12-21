<?php

session_start();
require_once("../db/config.php");
require_once ('../db/database.php');

if (isset($_REQUEST["operation_type"])) {
    $operation_type = $_REQUEST["operation_type"];

    switch ($operation_type) {

        case 1:
            newClient($_REQUEST["nombre"], $_REQUEST["rs"]);
            break;

        case 2:
            updateClient($_REQUEST["id"], $_REQUEST["nombre"], $_REQUEST["rs"]);
            break;

        case 3:
            deleteClient($_REQUEST["id"]);
            break;

        case 4:
            newAseguradora($_REQUEST["nombre"], $_REQUEST["rs"]);
            break;

        case 5:
            updateAseguradora($_REQUEST["id"], $_REQUEST["nombre"], $_REQUEST["rs"]);
            break;

        case 6:
            deleteAseguradora($_REQUEST["id"]);
            break;

        case 7:
            newCobertura($_REQUEST["nombre"], $_REQUEST["descripcion"]);
            break;

        case 8:
            updateCobertura($_REQUEST["id"], $_REQUEST["nombre"], $_REQUEST["descripcion"]);
            break;

        case 9:
            deleteCobertura($_REQUEST["id"]);
            break;

        case 10:
            newConvenio($_REQUEST["nombre"], $_REQUEST["descripcion"], $_REQUEST["seguro"], $_REQUEST["poliza"]);
            break;

        case 11:
            updateConvenio($_REQUEST["id"], $_REQUEST["nombre"], $_REQUEST["seguro"], $_REQUEST["poliza"]);
            break;

        case 12:
            deleteConvenio($_REQUEST["id"]);
            break;

        case 13:
            newCondicion();
            break;

        case 16:
            newFlota($_REQUEST["nombre"], $_REQUEST["descripcion"], $_REQUEST["inma"]);
            break;

        case 18:
            deleteFlota($_REQUEST["id"]);
            break;

        case 19:
            newFlotaConvenios($_REQUEST["data"]);
            break;

        case 20:
            newCotizacion($_REQUEST["nombre"], $_REQUEST["descripcion"], $_REQUEST["cliente"], $_REQUEST["flota"], $_FILES["file"]["tmp_name"]);
            break;

        case 21:
            deleteCotizacion($_REQUEST["id"]);
            break;

        case 22:
            proccessCotizacion();
            break;
    }
}

    switch ($operation_type) {

    require_once ('../entity/cliente.php');
    $cliente = new cliente();
    $cliente->id = $id;
    $cliente->estatus = "1";
    $cliente->nombre = $nombre;
    $cliente->razon_social = $razon_social;

    $_SESSION["msg"] = "show";

    if (!$cliente->update_by_id()) {
        $_SESSION["msg_desc"] = "Ocurrio un error al modificar al cliente. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
    } else {
        $_SESSION["msg_desc"] = "La modificación del cliente se realizó exitosamente";
        $_SESSION["msg_type"] = "succesfull";
    }
    header('Location: ' . $_GET["target"]);
}

function updateClient($id, $nombre, $razon_social) {

    require_once ('../entity/cliente.php');
    $cliente = new cliente();
    $cliente->estatus = "1";
    $cliente->nombre = $nombre;
    $cliente->razon_social = $razon_social;

function newClient($nombre, $razon_social) {

    $_SESSION["msg"] = "show";

    if (!$cliente->create()) {
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de crear al cliente. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
    } else {
        $_SESSION["msg_desc"] = "La creación del cliente se realizó exitosamente";
        $_SESSION["msg_type"] = "succesfull";
    }
    header('Location: ' . $_GET["target"]);
}

function deleteClient($id) {

    require_once ('../entity/cliente.php');
    $cliente = new cliente();
    $cliente->id = $id;

    $_SESSION["msg"] = "show";

    if (!$cliente->delete()) {
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de eliminar al cliente. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
    } else {
        $_SESSION["msg_desc"] = "El cliente fue eliminado exitosamente";
        $_SESSION["msg_type"] = "succesfull";
    }
    header('Location: ' . $_GET["target"]);
}

function updateAseguradora($id, $nombre, $razon_social) {

    require_once ('../entity/aseguradora.php');
    $aseguradora = new aseguradora();
    $aseguradora->id = $id;
    $aseguradora->estatus = "1";
    $aseguradora->nombre = $nombre;
    $aseguradora->razon_social = $razon_social;


    $_SESSION["msg"] = "show";

    if (!$aseguradora->update_by_id()) {
        $_SESSION["msg_desc"] = "Ocurrio un error al modificar el seguro. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
    } else {
        $_SESSION["msg_desc"] = "La modificación del seguro se realizó exitosamente";
        $_SESSION["msg_type"] = "succesfull";
    }
    header('Location: ' . $_GET["target"]);
}

function newAseguradora($nombre, $razon_social) {

    require_once ('../entity/aseguradora.php');
    $aseguradora = new aseguradora();
    $aseguradora->estatus = "1";
    $aseguradora->nombre = $nombre;
    $aseguradora->razon_social = $razon_social;
<<<<<<< HEAD

    if (!$aseguradora->create()) 
        set_msg("Ocurrio un error al tratar de crear un seguro. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.","error");
     else 
        set_msg("La creación del seguro se realizó exitosamente","succesfull");
    
=======


    $_SESSION["msg"] = "show";

    if (!$aseguradora->create()) {
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de crear un seguro. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
    } else {
        $_SESSION["msg_desc"] = "La creación del seguro se realizó exitosamente";
        $_SESSION["msg_type"] = "succesfull";
    }
>>>>>>> 42414b46a3c6949473b62f481e7dd012d4d677de
    header('Location: ' . $_GET["target"]);
}

function deleteAseguradora($id) {

    require_once ('../entity/aseguradora.php');
    $aseguradora = new aseguradora();
    $aseguradora->id = $id;
<<<<<<< HEAD

    if (!$aseguradora->delete()) 
        set_msg("Ocurrio un error al tratar de crear un seguro. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.","error");
     else
        set_msg("La creación del seguro se realizó exitosamente","succesfull");
    
=======

    $_SESSION["msg"] = "show";

    if (!$aseguradora->delete()) {
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de crear un seguro. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
    } else {
        $_SESSION["msg_desc"] = "La creación del seguro se realizó exitosamente";
        $_SESSION["msg_type"] = "succesfull";
    }
>>>>>>> 42414b46a3c6949473b62f481e7dd012d4d677de
    header('Location: ' . $_GET["target"]);
}

function newCobertura($nombre, $descripcion) {

    require_once ('../entity/cobertura_aseguradora.php');
    $cobertura_aseguradora = new cobertura_aseguradora();
    $cobertura_aseguradora->desc_cobertura = $nombre;


    $_SESSION["msg"] = "show";

    if (!$cobertura_aseguradora->create()) {
<<<<<<< HEAD
        set_msg("Ocurrio un error al tratar de crear una cobertura. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.","error");
    } else {
        set_msg("La creación de la cobertura se realizó exitosamente","succesfull");
=======
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de crear una cobertura. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
    } else {
        $_SESSION["msg_desc"] = "La creación de la cobertura se realizó exitosamente";
        $_SESSION["msg_type"] = "succesfull";
>>>>>>> 42414b46a3c6949473b62f481e7dd012d4d677de
    }
    header('Location: ' . $_GET["target"]);
}

function updateCobertura($id, $nombre, $descripcion) {

    require_once ('../entity/cobertura_aseguradora.php');
    $cobertura_aseguradora = new cobertura_aseguradora();
    $cobertura_aseguradora->id = $id;
    $cobertura_aseguradora->desc_cobertura = $nombre;
<<<<<<< HEAD

    if (!$cobertura_aseguradora->update_by_id()) 
        set_msg("Ocurrio un error al tratar de actualizar una cobertura. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.","error");
    else 
       set_msg("La actualización de la cobertura se realizó exitosamente","succesfull");
    
=======


    $_SESSION["msg"] = "show";

    if (!$cobertura_aseguradora->update_by_id()) {
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de actualizar una cobertura. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
    } else {
        $_SESSION["msg_desc"] = "La actualización de la cobertura se realizó exitosamente";
        $_SESSION["msg_type"] = "succesfull";
    }
>>>>>>> 42414b46a3c6949473b62f481e7dd012d4d677de
    header('Location: ' . $_GET["target"]);
}

function deleteCobertura($id) {

    require_once ('../entity/cobertura_aseguradora.php');
    $cobertura_aseguradora = new cobertura_aseguradora();
    $cobertura_aseguradora->id = $id;
<<<<<<< HEAD

    if (!$cobertura_aseguradora->delete())
        set_msg("Ocurrio un error al tratar de eliminar una cobertura. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.", "error");
    else 
        set_msg("La eliminación de la cobertura se realizó exitosamente","succesfull");
    
=======


    $_SESSION["msg"] = "show";

    if (!$cobertura_aseguradora->delete()) {
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de eliminar una cobertura. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
    } else {
        $_SESSION["msg_desc"] = "La eliminación de la cobertura se realizó exitosamente";
        $_SESSION["msg_type"] = "succesfull";
    }
>>>>>>> 42414b46a3c6949473b62f481e7dd012d4d677de
    header('Location: ' . $_GET["target"]);
}

function newConvenio($nombre, $descripcion, $seguro, $poliza) {

    require_once ('../entity/convenio_aseguradora.php');
    $convenio_aseguradora = new convenio_aseguradora();
    $convenio_aseguradora->nombre = $nombre;
    $convenio_aseguradora->descripcion = $descripcion;
    $convenio_aseguradora->id_aseguradora = $seguro;
    $convenio_aseguradora->num_poliza = $poliza;

<<<<<<< HEAD
    if (!$convenio_aseguradora->create()) {
        set_msg("Ocurrio un error al tratar de crear un convenio. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.","error");
        header('Location: ' . $_GET["target_fail"]);
    } else {
        set_msg("La creación del convenio se realizó exitosamente","succesfull");
=======
    $_SESSION["msg"] = "show";

    if (!$convenio_aseguradora->create()) {
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de crear un convenio. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
        header('Location: ' . $_GET["target_fail"]);
    } else {
        $_SESSION["msg_desc"] = "La creación del convenio se realizó exitosamente";
        $_SESSION["msg_type"] = "succesfull";
>>>>>>> 42414b46a3c6949473b62f481e7dd012d4d677de
        $_SESSION["id_convenio_as"] = $convenio_aseguradora->id;
        $_SESSION["up_amplia"] = "uncheck";
        $_SESSION["up_total"] = "uncheck";
        $_SESSION["up_segmentacion"] = "uncheck";
        $_SESSION["up_grua"] = "uncheck";
        $_SESSION["up_clasificacion"] = "uncheck";
        header('Location: ' . $_GET["target"]);
    }
}

function updateConvenio($id, $nombre, $seguro, $poliza) {

    require_once ('../entity/convenio_aseguradora.php');
    $convenio_aseguradora = new convenio_aseguradora();
    $convenio_aseguradora->id = $id;
    $convenio_aseguradora->descripcion = $nombre;
    $convenio_aseguradora->id_aseguradora = $seguro;

<<<<<<< HEAD
    if (!$convenio_aseguradora->update_by_id())
        set_msg("Ocurrio un error al tratar de actualizar el convenio. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.","error");
    else 
        set_msg("La actualización del convenio se realizó exitosamente","succesfull");
    
=======
    $_SESSION["msg"] = "show";

    if (!$convenio_aseguradora->update_by_id()) {
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de actualizar el convenio. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
    } else {
        $_SESSION["msg_desc"] = "La actualización del convenio se realizó exitosamente";
        $_SESSION["msg_type"] = "succesfull";
    }
>>>>>>> 42414b46a3c6949473b62f481e7dd012d4d677de
    header('Location: ' . $_GET["target"]);
}

function deleteConvenio($id) {

    require_once ('../entity/convenio_aseguradora.php');
    $convenio_aseguradora = new convenio_aseguradora();
    $convenio_aseguradora->id = $id;

    $_SESSION["msg"] = "show";

<<<<<<< HEAD
    if (!$convenio_aseguradora->delete())
        set_msg("Ocurrio un error al tratar de eliminar el convenio. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.","error");
     else 
        set_msg("La eliminación del convenio se realizó exitosamente","succesfull");
    
=======
    if (!$convenio_aseguradora->delete()) {
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de eliminar el convenio. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
    } else {
        $_SESSION["msg_desc"] = "La eliminación del convenio se realizó exitosamente";
        $_SESSION["msg_type"] = "succesfull";
    }
>>>>>>> 42414b46a3c6949473b62f481e7dd012d4d677de
    header('Location: ' . $_GET["target"]);
}

function newCondicion() {

    require_once ('../entity/re_tipo_cobertura_aseguradora.php');
    $condicion = new re_tipo_cobertura_aseguradora();
<<<<<<< HEAD

    if (isset($_REQUEST["cobertura"]) && isset($_REQUEST["calculo"]) && isset($_REQUEST["limite"]) && isset($_REQUEST["tasa"]) && isset($_SESSION["id_convenio_as"])) {

        $condicion->id_cob_as = $_REQUEST["cobertura"];
        $condicion->tipo_calculo = $_REQUEST["calculo"];
        $condicion->limite = $_REQUEST["limite"];
        $condicion->tasa = $_REQUEST["tasa"];
        $condicion->incluida = $_REQUEST["incluida"] == "true" ? "1" : "0";
        $condicion->id_convenio_as = $_SESSION["id_convenio_as"];
=======

    if (isset($_REQUEST["cobertura"]) && isset($_REQUEST["calculo"]) && isset($_REQUEST["limite"]) && isset($_REQUEST["tasa"]) && isset($_SESSION["id_convenio_as"])) {

        $condicion->id_cob_as = $_REQUEST["cobertura"];
        $condicion->tipo_calculo = $_REQUEST["calculo"];
        $condicion->limite = $_REQUEST["limite"];
        $condicion->tasa = $_REQUEST["tasa"];
        $condicion->incluida = $_REQUEST["incluida"] == "true" ? "1" : "0";
        $condicion->id_convenio_as = $_SESSION["id_convenio_as"];

        if ($_REQUEST["cobertura_amplia"] == "true")
            createCondicion($condicion, "1");
>>>>>>> 42414b46a3c6949473b62f481e7dd012d4d677de

        if ($_REQUEST["cobertura_amplia"] == "true")
            createCondicion($condicion, "1");

<<<<<<< HEAD

        if ($_REQUEST["perdida_total"] == "true")
            createCondicion($condicion, "2");

        if ($_REQUEST["rcv"] == "true")
            createCondicion($condicion, "3");

        set_msg("La creación de la cobertura se realizó exitosamente","succesfull");
    }else 
        set_msg("Ocurrio un error al tratar de crear la cobertura al convenio. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.","error");


=======
        if ($_REQUEST["perdida_total"] == "true")
            createCondicion($condicion, "2");

        if ($_REQUEST["rcv"] == "true")
            createCondicion($condicion, "3");

        $_SESSION["msg_desc"] = "La creación de la cobertura se realizó exitosamente";
        $_SESSION["msg_type"] = "succesfull";
    }else {

        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de crear la cobertura al convenio. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
    }


    $_SESSION["msg"] = "show";

>>>>>>> 42414b46a3c6949473b62f481e7dd012d4d677de
    header('Location: ' . $_GET["target"]);
}

function createCondicion($condicion, $tipo_cob, $valor) {

    for ($x = 1; $x < 4; $x++) {

        $condicion->id_tipo_cob = $tipo_cob;
        $condicion->valor = $valor == "" ? "0" : $valor;
        $condicion->id_tipo_carro = $x;

        switch ($x) {

            case 1:
                $condicion->valor = $_REQUEST["particular"];
                break;

            case 2:
                $condicion->valor = $_REQUEST["rustico"];
                break;

            case 3:
                $condicion->valor = $_REQUEST["pickup"];
                break;

            default:
                $condicion->valor = 0;
                break;
        }
        $condicion->create();
    }
}

function newFlota($nombre, $descripcion, $inma) {

    require_once ('../entity/flota.php');
    $flota = new flota();
    $flota->empresa = $nombre;
    $flota->descripcion = $descripcion;
    $flota->porcentaje_INMA = $inma / 100;
<<<<<<< HEAD

    if (!$flota->create()) {
        set_msg("Ocurrio un error al tratar de crear la flota. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.","error");
    } else {
        set_msg("La creación de la flota se realizó exitosamente","succesfull");
=======


    $_SESSION["msg"] = "show";

    if (!$flota->create()) {
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de crear la flota. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
    } else {
        $_SESSION["msg_desc"] = "La creación de la flota se realizó exitosamente";
        $_SESSION["msg_type"] = "succesfull";
>>>>>>> 42414b46a3c6949473b62f481e7dd012d4d677de
        $_SESSION["id_flota"] = $flota->id;
    }
    header('Location: ' . $_GET["target"]);
}

function deleteFlota($id) {

    require_once ('../entity/flota.php');
    $flota = new flota();
    $flota->id = $id;
<<<<<<< HEAD

    if (!$flota->delete()) {
        set_msg("Ocurrio un error al tratar de eliminar la flota. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.","error");
    } else {
        set_msg("La eliminación de la flota se realizó exitosamente","succesfull");
=======

    $_SESSION["msg"] = "show";

    if (!$flota->delete()) {
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de eliminar la flota. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
    } else {
        $_SESSION["msg_desc"] = "La eliminación de la flota se realizó exitosamente";
        $_SESSION["msg_type"] = "succesfull";
>>>>>>> 42414b46a3c6949473b62f481e7dd012d4d677de
    }
    header('Location: ' . $_GET["target"]);
}

function newFlotaConvenios($data) {

    $data = explode(",", $data);
    $resultado = true;
    require_once ('../entity/re_flota_co_as.php');
    $re_flota_co_as = new re_flota_co_as();
    $re_flota_co_as->id_flota = $_SESSION["id_flota"];

    foreach ($data as $id) {

        $re_flota_co_as->id_convenio_as = $id;
        $resultado = $re_flota_co_as->create();
        if (!$resultado)
            break;
    }

<<<<<<< HEAD
    if (!$resultado) {
        set_msg("Ocurrio un error al tratar de asociar un convenio a la flota. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.","error");
        header('Location: ' . $_GET["target_fail"]);
    } else {
        set_msg("La asosiación de los convenios a la flota se realizó exitosamente","succesfull");
=======
    $_SESSION["msg"] = "show";

    if (!$resultado) {
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de asociar un convenio a la flota. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
        header('Location: ' . $_GET["target_fail"]);
    } else {
        $_SESSION["msg_desc"] = "La asosiación de los convenios a la flota se realizó exitosamente";
        $_SESSION["msg_type"] = "succesfull";
>>>>>>> 42414b46a3c6949473b62f481e7dd012d4d677de
        header('Location: ' . $_GET["target"]);
    }
}

function newCotizacion($nombre, $descripcion, $cliente, $flota, $tmp_name) {

<<<<<<< HEAD
    var_dump($_FILES);
    require_once '../Classes/PHPExcel.php';
    require_once '../Classes/PHPExcel/IOFactory.php';
    require_once ('../entity/cotizacion.php');

    $resultado = false;

    if (isset($nombre) && isset($descripcion) && isset($cliente) && isset($flota)) {

        $cotizacion = new cotizacion();
        $cotizacion->nombre = $nombre;
        $cotizacion->descripcion = $descripcion;
        $cotizacion->id_cliente = $cliente;
        $cotizacion->id_flota = $flota;
        $cotizacion->ut_time = "NOW()";
        $cotizacion->cr_time = "NOW()";
        $resultado = $cotizacion->create();

        $objPHPExcel = PHPExcel_IOFactory::load($path);
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {


            $highestRow = $worksheet->getHighestRow(); // e.g. 10
            $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
            $nrColumns = ord($highestColumn) - 64;

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
                    set_msg("Error al importar el archivo. El archivo tiene datos errados para la importacion", "error");
            }//End IF
        }

        if (!$resultado) {
            set_msg("Ocurrio un error al tratar de crear una nueva cotización. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.","error");
            header('Location: ' . $_GET["target_fail"]);
        } else {
            set_msg("La creación de la cotización se realizó exitosamente","succesfull");
            header('Location: ' . $_GET["target"]);
        }
    }
}

    function deleteCotizacion($id) {

        require_once ('../entity/cotizacion.php');
        $cotizacion = new cotizacion();
        $cotizacion->id = $id;
=======

    require_once '../Classes/PHPExcel.php';
    require_once '../Classes/PHPExcel/IOFactory.php';
    require_once ('../entity/cotizacion.php');
    require_once ('validar_carro_cotizacion.php');




    if (isset($nombre) && isset($descripcion) && isset($cliente) && isset($flota)) {

        $cotizacion = new cotizacion();
        $cotizacion->nombre = $nombre;
        $cotizacion->descripcion = $descripcion;
        $cotizacion->id_cliente = $cliente;
        $cotizacion->id_flota = $flota;
        $cotizacion->ut_time = "NOW()";
        $cotizacion->cr_time = "NOW()";
        $resultado = $cotizacion->create();

        $validar_carros = new validar_carro_cotizacion();
        $result = $validar_carros->processFile($tmp_name, $cotizacion->id);
        $_SESSION["id_cotizacion"] = $cotizacion->id;

        if ($result)
            header('Location: ' . $_GET["target"]);
        else
            header('Location: ' . $_GET["target_fail"]);
    }else {
        $_SESSION["msg"] = "show";
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de crear una nueva cotización. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
        header('Location: ' . $_GET["target_fail"]);
    }
}

function deleteCotizacion($id) {

    require_once ('../entity/cotizacion.php');
    $cotizacion = new cotizacion();
    $cotizacion->id = $id;


    $_SESSION["msg"] = "show";

    if (!$cotizacion->delete()) {
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de eliminar la cotización. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
    } else {
        $_SESSION["msg_desc"] = "La eliminación de la cotización se realizó exitosamente";
        $_SESSION["msg_type"] = "succesfull";
    }
    header('Location: ' . $_GET["target"]);
}

function proccessCotizacion() {

    require_once ('../entity/clasificacion.php');
    require_once ('find_aseguradora.php');
    require_once ('generarExcelCotizacion.php');
    require_once ('../entity/cotizacion_carro.php');
    require_once ('../entity/cotizacion.php');
    require_once ('../entity/segmentacion.php');
    require_once ('../entity/grua.php');
    require_once ('../entity/flota.php');
    require_once ('../entity/re_tipo_cobertura_aseguradora.php');
    require_once ('../entity/parametros.php');
    require_once ('solicitud.php');
    require_once ('./calcular_primas.php');
    require_once ('../entity/re_flota_co_as.php');

    $parametros = new parametros();
    $array_parametros = $parametros->find_all();

    $cotizacion = new cotizacion();
    $cotizacion->id = $_SESSION["id_cotizacion"];
    $cotizacion_aux = $cotizacion->find_by_id();
    //var_dump($cotizacion_aux);
    $flota_aux = new flota();
    $flota_aux->id = $cotizacion_aux[0]->id_flota;
    $flota = $flota_aux->find_by_id_flota();
    $flota = $flota[0];
    $carro = new cotizacion_carro();
    $carro->id_cotizacion = $_SESSION["id_cotizacion"];
    $carros = $carro->find_by_id_cotizacion_success();

    $re_flota_co_as = new re_flota_co_as();
    $re_flota_co_as->id_flota = $flota->id;
    $re_flota_co_as_aux = $re_flota_co_as->find_all();
    $solicitudes_procesadas = Array();


    if (sizeof($carros) > 0) {
        foreach ($carros as $value) {

            $find_aseguradora = new find_aseguradora();
            $clasificacion = new clasificacion();
            $clasificacion->marca = $value->car_marca;
            $clasificacion->modelo = $value->car_modelo;
            $clasificacion->ano = $value->car_ano;
            $clasificacion->tipo_carro = $value->tipo_carro;

            //Calculamos la suma asegurada
            $suma_asegurada = $value->valor_INMA + $value->valor_INMA * $flota->porcentaje_INMA;
            $res_clasificacion = $find_aseguradora->get_clasificacion($value->tipo_cobertura, $cotizacion_aux[0]->id_flota, $clasificacion, $suma_asegurada);

            //Obtenemos las coberturas asociadas a cada registro de la clasificacion
            $find_aseguradora->get_coberturas($value->tipo_cobertura, $res_clasificacion);


            $solicitud = new solicitud();
            $solicitud->cotizacion = $value;
            $solicitud->res_clasificacion = $res_clasificacion;
            $solicitud->flota = $flota;
            $solicitud->parametros = $array_parametros;

            $aseguradoras = Array();
            foreach ($re_flota_co_as_aux as $aseguradora)
                array_push($aseguradoras, $aseguradora->id_aseguradora);

            $solicitud->calcular_primas($aseguradoras, 1);
            array_push($solicitudes_procesadas, $solicitud);
        }
        
        $generador=new generarExcelCotizacion();
        $generador->createFilesCotizacion($solicitudes_procesadas, $aseguradoras);
    }

>>>>>>> 42414b46a3c6949473b62f481e7dd012d4d677de

        if (!$cotizacion->delete()) 
            set_msg("Ocurrio un error al tratar de eliminar la cotización. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.","error"); 
         else 
            set_msg("La eliminación de la cotización se realizó exitosamente","succesfull");

        header('Location: ' . $_GET["target"]);
    }
    
function set_msg($msg_desc, $msg_type) {


<<<<<<< HEAD
  $_SESSION["msg_desc"] = $msg_desc;
  $_SESSION["msg_type"] = $msg_type;
=======
    //////////////
>>>>>>> 42414b46a3c6949473b62f481e7dd012d4d677de
}
?>
