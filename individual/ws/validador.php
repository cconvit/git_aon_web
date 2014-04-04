<?php

session_start();
require_once("../../php/db/config.php");
require_once ('../../php/db/database.php');
require_once ('../../php/entity/cotizacion.php');
require_once ('../../php/operation/find_aseguradora.php');
require_once ('../../php/operation/solicitud.php');
require_once ('../../php/operation/calcular_primas.php');
require_once ('../../php/entity/flota.php');
require_once ('../../php/entity/clasificacion.php');
require_once ('../../php/entity/re_tipo_cobertura_aseguradora.php');
require_once ('../../php/entity/parametros.php');

$flota = unserialize($_SESSION['flota']);

if (isset($_POST["nombre"]) && isset($_POST["cedula"]) && isset($_POST["telefono"]) && isset($_POST["correo"]) &&
        isset($_POST["edad"]) && isset($_POST["sexo"]) && isset($_POST["civil"]) && isset($_POST["tipo"]) &&
        isset($_POST["marca"]) && isset($_POST["modelo"]) && isset($_POST["ano"]) && isset($_POST["ocupantes"]) &&
        isset($_POST["cobertura"]) && isset($_POST["version"]) && isset($flota) && isset($_POST["inma-porcentaje"])) {

    //FALTA valor, usado 

    $cotizacion = new cotizacion();
    $parametros = new parametros();
    $array_parametros = $parametros->find_all();
    $flota->porcentaje_INMA = $_POST["inma-porcentaje"] / 100;

    $cotizacion->nombre = $_POST["nombre"];
    $cotizacion->cedula = $_POST["cedula"];
    $cotizacion->telefono = $_POST["telefono"];
    $cotizacion->email = $_POST["correo"];

    $cotizacion->edad = $_POST["edad"];
    $cotizacion->sexo = $_POST["sexo"];
    $cotizacion->estado_civil = $_POST["civil"];
    $cotizacion->tipo_carro = $_POST["uso"];
    $cotizacion->car_marca = $_POST["marca"];
    $cotizacion->car_modelo = $_POST["modelo"];
    $cotizacion->car_ocupantes = $_POST["ocupantes"];
    $cotizacion->tipo_cobertura = $_POST["cobertura"];
    $cotizacion->id_flota = $flota->id;
    $cotizacion->cr_time = 'NOW()';
    $cotizacion->ut_time = 'NOW()';
    $cotizacion->tipo = $_POST["tipo"];

    if ($_POST["tipo"] == "nuevo") {
        $cotizacion->valor_INMA = $_POST["factura"]; //Ver de donde sacamos este valor
        $cotizacion->car_version = "";
        $cotizacion->car_ano = $array_parametros[1]->valor;
        ;
    } else {
        $cotizacion->valor_INMA = $_POST["valor"]; //Ver de donde sacamos este valor
        $cotizacion->car_version = $_POST["version"];
        $cotizacion->car_ano = $_POST["ano"];
    }
    //Calculamos la suma asegurada
    $suma_asegurada = $cotizacion->valor_INMA + $cotizacion->valor_INMA * $flota->porcentaje_INMA;
    //Busqueda de la clasificacion
    $find_aseguradora = new find_aseguradora();
    $clasificacion = new clasificacion();
    $clasificacion->marca = $cotizacion->car_marca;
    $clasificacion->modelo = $cotizacion->car_modelo;
    $clasificacion->ano = $cotizacion->car_ano;
    $clasificacion->tipo_carro = $cotizacion->tipo_carro;

    $res_clasificacion = $find_aseguradora->get_clasificacion($cotizacion->tipo_cobertura, $cotizacion->id_flota, $clasificacion, $suma_asegurada);
    //var_dump($res_clasificacion);
    //Obtenemos las coberturas asociadas a cada registro de la clasificacion
    $find_aseguradora->get_coberturas($cotizacion->tipo_cobertura, $res_clasificacion);
    //var_dump($res_clasificacion);


    $solicitud = new solicitud();
    $solicitud->cotizacion = $cotizacion;
    $solicitud->res_clasificacion = $res_clasificacion;
    $solicitud->flota = $flota;
    $solicitud->parametros = $array_parametros;

    $_SESSION['solicitud'] = serialize($solicitud);
    $_SESSION['flota'] = serialize($flota);

    if (sizeof($solicitud->res_clasificacion) > 0)
        header("Location: ../aseguradoras.php");
    else
        header("Location: ../contactanos.php");

 
} else
    echo "Error en las variables";
?>
