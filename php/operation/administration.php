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
            updateConvenio($_REQUEST["nombre"], $_REQUEST["seguro"], $_REQUEST["poliza"], $_REQUEST["descripcion"]);
            break;

        case 12:
            deleteConvenio($_REQUEST["id"]);
            break;

        case 13:
            newUpdateCondicion($operation_type);
            break;

        case 14:
            newUpdateCondicion($operation_type);
            break;

        case 15:
            deleteCondicion();
            break;

        case 16:
            newFlota($_REQUEST["nombre"], $_REQUEST["descripcion"], $_REQUEST["inma"], $_REQUEST["fecha-inicio"], $_REQUEST["fecha-fin"]);
            break;

        case 17:
            updateFlota($_REQUEST["nombre"], $_REQUEST["descripcion"], $_REQUEST["inma"], $_REQUEST["fecha-inicio"], $_REQUEST["fecha-fin"]);
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

        case 23:
            deleteConvenioFlota($_REQUEST["id"]);
            break;
        case 24:
            updateCarro($_REQUEST["id"], $_REQUEST["marca"], $_REQUEST["modelo"], $_REQUEST["version"], $_REQUEST["ano"], $_REQUEST["inma"], $_REQUEST["cobertura"], $_REQUEST["uso"], $_REQUEST["ocupantes"], $_REQUEST["edad"], $_REQUEST["sexo"], $_REQUEST["civil"], $_REQUEST["inma-porcentaje"]);
            break;
        case 25:
            deleteCarro($_REQUEST["id"]);
    }
}

function updateClient($id, $nombre, $razon_social) {

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
        $_SESSION["msg_desc"] = "La modificación del cliente se realizó exitosamente.";
        $_SESSION["msg_type"] = "succesfull";
    }
    header('Location: ' . $_GET["target"]);
}

function newClient($nombre, $razon_social) {

    require_once ('../entity/cliente.php');
    $cliente = new cliente();
    $cliente->estatus = "1";
    $cliente->nombre = $nombre;
    $cliente->razon_social = $razon_social;


    $_SESSION["msg"] = "show";

    if (!$cliente->create()) {
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de crear al cliente. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
    } else {
        $_SESSION["msg_desc"] = "La creación del cliente se realizó exitosamente.";
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
        $_SESSION["msg_desc"] = "El cliente fue eliminado exitosamente.";
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
        $_SESSION["msg_desc"] = "La modificación del seguro se realizó exitosamente.";
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


    $_SESSION["msg"] = "show";

    if (!$aseguradora->create()) {
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de crear un seguro. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
    } else {
        $_SESSION["msg_desc"] = "La creación del seguro se realizó exitosamente.";
        $_SESSION["msg_type"] = "succesfull";
    }
    header('Location: ' . $_GET["target"]);
}

function deleteAseguradora($id) {

    require_once ('../entity/aseguradora.php');
    $aseguradora = new aseguradora();
    $aseguradora->id = $id;

    $_SESSION["msg"] = "show";

    if (!$aseguradora->delete()) {
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de eliminar un seguro. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
    } else {
        $_SESSION["msg_desc"] = "La eliminación del seguro se realizó exitosamente.";
        $_SESSION["msg_type"] = "succesfull";
    }
    header('Location: ' . $_GET["target"]);
}

function newCobertura($nombre, $descripcion) {

    require_once ('../entity/cobertura_aseguradora.php');
    $cobertura_aseguradora = new cobertura_aseguradora();
    $cobertura_aseguradora->desc_cobertura = $nombre;


    $_SESSION["msg"] = "show";

    if (!$cobertura_aseguradora->create()) {
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de crear una cobertura. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
    } else {
        $_SESSION["msg_desc"] = "La creación de la cobertura se realizó exitosamente.";
        $_SESSION["msg_type"] = "succesfull";
    }
    header('Location: ' . $_GET["target"]);
}

function updateCobertura($id, $nombre, $descripcion) {

    require_once ('../entity/cobertura_aseguradora.php');
    $cobertura_aseguradora = new cobertura_aseguradora();
    $cobertura_aseguradora->id = $id;
    $cobertura_aseguradora->desc_cobertura = $nombre;


    $_SESSION["msg"] = "show";

    if (!$cobertura_aseguradora->update_by_id()) {
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de actualizar una cobertura. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
    } else {
        $_SESSION["msg_desc"] = "La actualización de la cobertura se realizó exitosamente.";
        $_SESSION["msg_type"] = "succesfull";
    }
    header('Location: ' . $_GET["target"]);
}

function deleteCobertura($id) {

    require_once ('../entity/cobertura_aseguradora.php');
    $cobertura_aseguradora = new cobertura_aseguradora();
    $cobertura_aseguradora->id = $id;


    $_SESSION["msg"] = "show";

    if (!$cobertura_aseguradora->delete()) {
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de eliminar una cobertura. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
    } else {
        $_SESSION["msg_desc"] = "La eliminación de la cobertura se realizó exitosamente.";
        $_SESSION["msg_type"] = "succesfull";
    }
    header('Location: ' . $_GET["target"]);
}

function newConvenio($nombre, $descripcion, $seguro, $poliza) {

    require_once ('../entity/convenio_aseguradora.php');
    $convenio_aseguradora = new convenio_aseguradora();
    $convenio_aseguradora->nombre = $nombre;
    $convenio_aseguradora->descripcion = $descripcion;
    $convenio_aseguradora->id_aseguradora = $seguro;
    $convenio_aseguradora->num_poliza = $poliza;

    $_SESSION["msg"] = "show";

    if (!$convenio_aseguradora->create()) {
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de crear un convenio. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
        header('Location: ' . $_GET["target_fail"]);
    } else {
        $_SESSION["msg_desc"] = "La creación del convenio se realizó exitosamente.";
        $_SESSION["msg_type"] = "succesfull";
        $_SESSION["id_convenio_as"] = $convenio_aseguradora->id;
        header('Location: ' . $_GET["target"]);
    }
}

function updateConvenio($nombre, $seguro, $poliza, $descripcion) {

    require_once ('../entity/convenio_aseguradora.php');
    $convenio_aseguradora = new convenio_aseguradora();
    $convenio_aseguradora->id = $_SESSION["id_convenio_as"];
    $convenio_aseguradora->nombre = $nombre;
    $convenio_aseguradora->id_aseguradora = $seguro;
    $convenio_aseguradora->num_poliza = $poliza;
    $convenio_aseguradora->descripcion = $descripcion;

    $_SESSION["msg"] = "show";

    if (!$convenio_aseguradora->update_by_id()) {
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de actualizar el convenio. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
        header('Location: ' . $_GET["target_fail"]);
    } else {
        $_SESSION["msg_desc"] = "La actualización del convenio se realizó exitosamente.";
        $_SESSION["msg_type"] = "succesfull";
        header('Location: ' . $_GET["target"]);
    }
}

function deleteConvenio($id) {

    require_once ('../entity/convenio_aseguradora.php');
    $convenio_aseguradora = new convenio_aseguradora();
    $convenio_aseguradora->id = $id;

    $_SESSION["msg"] = "show";

    if (!$convenio_aseguradora->delete()) {
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de eliminar el convenio. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
    } else {
        $_SESSION["msg_desc"] = "La eliminación del convenio se realizó exitosamente.";
        $_SESSION["msg_type"] = "succesfull";
    }
    header('Location: ' . $_GET["target"]);
}

function deleteCondicion() {

    require_once ('../entity/re_tipo_cobertura_aseguradora.php');
    $condicion = new re_tipo_cobertura_aseguradora();


    $condicion->id_cob_as = $_REQUEST["id"];
    $condicion->id_convenio_as = $_SESSION["id_convenio_as"];

    $_SESSION["msg"] = "show";

    if (!$condicion->delete()) {
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de eliminar la condición. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
    } else {
        $_SESSION["msg_desc"] = "La eliminación de la condición se realizó exitosamente.";
        $_SESSION["msg_type"] = "succesfull";
    }
    header('Location: ' . $_GET["target"]);
}

function newUpdateCondicion($operation_type) {

    require_once ('../entity/re_tipo_cobertura_aseguradora.php');
    $condicion = new re_tipo_cobertura_aseguradora();

    if (isset($_REQUEST["cobertura"]) && isset($_REQUEST["calculo"]) && isset($_REQUEST["tasa"]) && isset($_SESSION["id_convenio_as"])) {

        $condicion->id_cob_as = $_REQUEST["cobertura"];
        $condicion->tipo_calculo = $_REQUEST["calculo"];
        $condicion->tasa = $_REQUEST["tasa"];
        $condicion->incluida = $_REQUEST["incluida"] == "true" ? "1" : "0";
        $condicion->id_convenio_as = $_SESSION["id_convenio_as"];

        if ($operation_type == 14)
            $condicion->delete();

        if ($_REQUEST["cobertura_amplia"] == "true")
            createCondicion($condicion, "1");

        if ($_REQUEST["perdida_total"] == "true")
            createCondicion($condicion, "2");

        if ($_REQUEST["rcv"] == "true")
            createCondicion($condicion, "3");

        if (($_REQUEST["cobertura_amplia"] == "true") || ($_REQUEST["perdida_total"] == "true") || ($_REQUEST["rcv"] == "true")) {
            $_SESSION["msg_desc"] = "La " . ($operation_type == 14 ? "modificación" : "creación") . " de la cobertura se realizó exitosamente.";
            $_SESSION["msg_type"] = "succesfull";
        } else {

            $_SESSION["msg_desc"] = "Ocurrio un error al tratar de " . ($operation_type == 14 ? "modificar" : "crear") . " la cobertura al convenio. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
            $_SESSION["msg_type"] = "error";
        }
    } else {

        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de crear la cobertura al convenio debido a que no selecionó ninguna condición. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
    }


    $_SESSION["msg"] = "show";

    header('Location: ' . $_GET["target"]);
}

function createCondicion($condicion, $tipo_cob) {

    for ($x = 1; $x < 4; $x++) {

        $condicion->id_tipo_cob = $tipo_cob;
        //$condicion->valor = $valor == "" ? "0" : $valor;
        $condicion->id_tipo_carro = $x;

        switch ($x) {

            case 1:
                $condicion->valor = $_REQUEST["valor_particular"];
                $condicion->limite = $_REQUEST["limite_particular"];
                break;

            case 2:
                $condicion->valor = $_REQUEST["valor_rustico"];
                $condicion->limite = $_REQUEST["limite_rustico"];
                break;

            case 3:
                $condicion->valor = $_REQUEST["valor_pickup"];
                $condicion->limite = $_REQUEST["limite_pickup"];
                break;

            default:
                $condicion->valor = 0;
                break;
        }
        $condicion->create();
    }
}

function newFlota($nombre, $descripcion, $inma, $validez_inicio, $validez_fin) {

    require_once ('../entity/flota.php');
    require_once ('../entity/re_plantilla_flota.php');
    require_once ('../entity/inma_flota.php');
    $flota = new flota();

    $flota->empresa = $nombre;
    $flota->descripcion = $descripcion;
    $flota->porcentaje_INMA = "0";
    //  $inma / 100;
    $dt_inicio = DateTime::createFromFormat("d/m/Y", $validez_inicio);
    $dt_fin = DateTime::createFromFormat("d/m/Y", $validez_fin);

    $flota->validez_inicio = $dt_inicio->format("Y-m-d");
    $flota->validez_fin = $dt_fin->format("Y-m-d");


    $_SESSION["msg"] = "show";

    if (!$flota->create()) {
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de crear la flota. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
    } else {

        $re_plantilla_flota = new re_plantilla_flota();
        $re_plantilla_flota->id_flota = $flota->id;
        $re_plantilla_flota->id_plantilla = "1";
        $re_plantilla_flota->id_tipo_seguro = "1";
        $re_plantilla_flota->create();
        $re_plantilla_flota->id_plantilla = "2";
        $re_plantilla_flota->id_tipo_seguro = "2";
        $re_plantilla_flota->create();
        $re_plantilla_flota->id_plantilla = "3";
        $re_plantilla_flota->id_tipo_seguro = "3";
        $re_plantilla_flota->create();

        foreach ($inma as $value) {

            $inma_flota = new inma_flota();
            $inma_flota->id_flota = $flota->id;
            $inma_flota->inma = $value;
            $inma_flota->create();
        }

        $_SESSION["msg_desc"] = "La creación de la flota se realizó exitosamente.";
        $_SESSION["msg_type"] = "succesfull";
        $_SESSION["id_flota"] = $flota->id;
    }
    header('Location: ' . $_GET["target"]);
}

function updateFlota($nombre, $descripcion, $inma, $validez_inicio, $validez_fin) {

    require_once ('../entity/flota.php');
    require_once ('../entity/inma_flota.php');
    $flota = new flota();
    $flota->empresa = $nombre;
    $flota->descripcion = $descripcion;
    $flota->porcentaje_INMA = "0";
    $flota->id = $_SESSION['id_flota'];

    $dt_inicio = DateTime::createFromFormat("d/m/Y", $validez_inicio);
    $dt_fin = DateTime::createFromFormat("d/m/Y", $validez_fin);

    $flota->validez_inicio = $dt_inicio->format("Y-m-d");
    $flota->validez_fin = $dt_fin->format("Y-m-d");

    $_SESSION["msg"] = "show";

    if (!$flota->update_by_id()) {
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de actualizar la flota. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
        header('Location: ' . $_GET["target_fail"]);
    } else {
        $inma_flota = new inma_flota();
        $inma_flota->id_flota = $flota->id;
        $inma_flota->delete_by_flota();

        foreach ($inma as $value) {

            $inma_flota = new inma_flota();
            $inma_flota->id_flota = $flota->id;
            $inma_flota->inma = $value;
            $inma_flota->create();
        }

        $_SESSION["msg_desc"] = "La actualización de la flota se realizó exitosamente.";
        $_SESSION["msg_type"] = "succesfull";
        header('Location: ' . $_GET["target"]);
    }
}

function deleteFlota($id) {

    require_once ('../entity/flota.php');
    $flota = new flota();
    $flota->id = $id;

    $_SESSION["msg"] = "show";

    if (!$flota->delete()) {
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de eliminar la flota. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
    } else {
        $_SESSION["msg_desc"] = "La eliminación de la flota se realizó exitosamente.";
        $_SESSION["msg_type"] = "succesfull";
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

    $_SESSION["msg"] = "show";

    if (!$resultado) {
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de asociar un convenio a la flota. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
        header('Location: ' . $_GET["target_fail"]);
    } else {
        $_SESSION["msg_desc"] = "La asosiación de los convenios a la flota se realizó exitosamente.";
        $_SESSION["msg_type"] = "succesfull";
        header('Location: ' . $_GET["target"]);
    }
}

function newCotizacion($nombre, $descripcion, $cliente, $flota, $tmp_name) {


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

        //TODO Agregar los campos nuevos para las fechas de prorateo
        //$cotizacion->validez_inicio="01/08/2014";
        //$cotizacion->validez_fin="31/12/2014";
        $resultado = $cotizacion->create();

        $validar_carros = new validar_carro_cotizacion();
        $result = $validar_carros->processFile($tmp_name, $cotizacion->id);
        $_SESSION["id_cotizacion"] = $cotizacion->id;
        if ($result) {
            //echo $result;
            header('Location: ' . $_GET["target"]);
        } else {
            $cotizacion->delete();
            header('Location: ' . $_GET["target_fail"]);
        }
    } else {
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
        $_SESSION["msg_desc"] = "La eliminación de la cotización se realizó exitosamente.";
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
    $re_flota_co_as_aux = $re_flota_co_as->find_by_id();
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
            $suma_asegurada = $value->valor_INMA + ($value->valor_INMA * ($value->porcentaje_inma / 100));
            $res_clasificacion = $find_aseguradora->get_clasificacion($value->tipo_cobertura, $cotizacion_aux[0]->id_flota, $clasificacion, $suma_asegurada);

            //Obtenemos las coberturas asociadas a cada registro de la clasificacion
            $find_aseguradora->get_coberturas($value->tipo_cobertura, $res_clasificacion);


            $solicitud = new solicitud();
            $solicitud->cotizacion = $value;
            //$solicitud->cotizacion = $cotizacion_aux[0];
            $solicitud->res_clasificacion = $res_clasificacion;
            $solicitud->flota = $flota;
            $solicitud->parametros = $array_parametros;

            $aseguradoras = Array();
            foreach ($re_flota_co_as_aux as $aseguradora)
                array_push($aseguradoras, $aseguradora->id_aseguradora);
            
            $solicitud->calcular_primas($aseguradoras, $value->porcentaje_inma / 100);
            array_push($solicitudes_procesadas, $solicitud);
        }

        $generador = new generarExcelCotizacion();
        $generador->createFilesCotizacion($solicitudes_procesadas, $aseguradoras);
    }


    header('Location: ' . $_GET["target"]);
}

function deleteConvenioFlota($id) {

    require_once ('../entity/re_flota_co_as.php');
    $re_flota_co_as = new re_flota_co_as();
    $re_flota_co_as->id_flota = $_SESSION['id_flota'];
    $re_flota_co_as->id_convenio_as = $id;


    $_SESSION["msg"] = "show";

    if (!$re_flota_co_as->delete_by_flota_convenio()) {
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de eliminar el convenio. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
    } else {
        $_SESSION["msg_desc"] = "La eliminación del convenio se realizó exitosamente.";
        $_SESSION["msg_type"] = "succesfull";
    }
    header('Location: ' . $_GET["target"]);
}

function updateCarro($id, $marca, $modelo, $version, $ano, $inma, $cobertura, $uso, $ocupantes, $edad, $sexo, $civil, $porcentaje_inma) {

    require_once ('../entity/cotizacion_carro.php');
    require_once ('../operation/validar_carro_cotizacion.php');

    $carro = new cotizacion_carro();
    $carro->id = $id;
    $carro->car_marca = $marca;
    $carro->car_modelo = $modelo;
    $carro->car_version = $version;
    $carro->car_ano = $ano;
    $carro->valor_INMA = $inma;
    $carro->tipo_cobertura = $cobertura;
    $carro->tipo_carro = $uso;
    $carro->car_ocupantes = $ocupantes;
    $carro->edad = $edad;
    $carro->sexo = $sexo;
    $carro->estado_civil = $civil;
    $carro->porcentaje_inma = $porcentaje_inma;


    $validar = new validar_carro_cotizacion();

    $_SESSION["msg"] = "show";

    if (!$validar->validarRegistro($carro)) {
        $_SESSION["msg_desc"] = "Error al actualizar los datos del carro. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
    } else {
        $_SESSION["msg_desc"] = "La actualización de los datos del carro fue exitosa..";
        $_SESSION["msg_type"] = "succesfull";
    }
    header('Location: ' . $_GET["target"]);
}

function deleteCarro($id) {

    require_once ('../entity/cotizacion_carro.php');
    $carro = new cotizacion_carro();
    $carro->id = $id;


    $_SESSION["msg"] = "show";

    if (!$carro->delete()) {
        $_SESSION["msg_desc"] = "Ocurrio un error al tratar de eliminar el carro. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
        $_SESSION["msg_type"] = "error";
    } else {
        $_SESSION["msg_desc"] = "La eliminación del carro en la cotización se realizó exitosamente.";
        $_SESSION["msg_type"] = "succesfull";
    }
    header('Location: ' . $_GET["target"]);
}

function set_msg($msg_desc, $msg_type) {


    $_SESSION["msg_desc"] = $msg_desc;
    $_SESSION["msg_type"] = $msg_type;
    //////////////
}

function isValidType($req_dataType, $dataType) {

    if ($dataType == $req_dataType)
        return true;
    else
        return false;
}

?>
