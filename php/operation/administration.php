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
      newConvenio($_REQUEST["nombre"], $_REQUEST["seguro"],$_REQUEST["poliza"]);
      break;
  
    case 11:
      updateConvenio($_REQUEST["id"], $_REQUEST["nombre"],$_REQUEST["seguro"],$_REQUEST["poliza"]);
      break;

    case 12:
      deleteConvenio($_REQUEST["id"]);
      break;
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
    $_SESSION["msg_desc"] = "La modificación del cliente se realizó exitosamente";
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
    $_SESSION["msg_desc"] = "La creación del cliente se realizó exitosamente";
     $_SESSION["msg_type"]  = "succesfull";
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


  $_SESSION["msg"] = "show";

  if (!$aseguradora->create()) {
    $_SESSION["msg_desc"] = "Ocurrio un error al tratar de crear un seguro. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
    $_SESSION["msg_type"] = "error";
  } else {
    $_SESSION["msg_desc"] = "La creación del seguro se realizó exitosamente";
     $_SESSION["msg_type"]  = "succesfull";
  }
  header('Location: ' . $_GET["target"]);
}

function deleteAseguradora($id) {

 require_once ('../entity/aseguradora.php');
  $aseguradora = new aseguradora();
  $aseguradora->id = $id;

  $_SESSION["msg"] = "show";

  if (!$aseguradora->delete()) {
    $_SESSION["msg_desc"] = "Ocurrio un error al tratar de crear un seguro. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
    $_SESSION["msg_type"] = "error";
  } else {
    $_SESSION["msg_desc"] = "La creación del seguro se realizó exitosamente";
     $_SESSION["msg_type"]  = "succesfull";
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
    $_SESSION["msg_desc"] = "La creación de la cobertura se realizó exitosamente";
     $_SESSION["msg_type"]  = "succesfull";
  }
  header('Location: ' . $_GET["target"]);
}

function updateCobertura($id, $nombre, $descripcion) {

  require_once ('../entity/cobertura_aseguradora.php');
  $cobertura_aseguradora = new cobertura_aseguradora();
  $cobertura_aseguradora->id=$id;
  $cobertura_aseguradora->desc_cobertura = $nombre;


  $_SESSION["msg"] = "show";

  if (!$cobertura_aseguradora->update_by_id()) {
    $_SESSION["msg_desc"] = "Ocurrio un error al tratar de actualizar una cobertura. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
    $_SESSION["msg_type"] = "error";
  } else {
    $_SESSION["msg_desc"] = "La actualización de la cobertura se realizó exitosamente";
     $_SESSION["msg_type"]  = "succesfull";
  }
  header('Location: ' . $_GET["target"]);
}

function deleteCobertura($id) {

  require_once ('../entity/cobertura_aseguradora.php');
  $cobertura_aseguradora = new cobertura_aseguradora();
  $cobertura_aseguradora->id=$id;


  $_SESSION["msg"] = "show";

  if (!$cobertura_aseguradora->delete()) {
    $_SESSION["msg_desc"] = "Ocurrio un error al tratar de eliminar una cobertura. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
    $_SESSION["msg_type"] = "error";
  } else {
    $_SESSION["msg_desc"] = "La eliminación de la cobertura se realizó exitosamente";
     $_SESSION["msg_type"]  = "succesfull";
  }
  header('Location: ' . $_GET["target"]);
}

function newConvenio($nombre, $seguro,$poliza) {

  require_once ('../entity/convenio_aseguradora.php');
  $convenio_aseguradora = new convenio_aseguradora();
  $convenio_aseguradora->descripcion = $nombre;
  $convenio_aseguradora->id_aseguradora = $seguro;

  $_SESSION["msg"] = "show";

  if (!$convenio_aseguradora->create()) {
    $_SESSION["msg_desc"] = "Ocurrio un error al tratar de crear un convenio. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
    $_SESSION["msg_type"] = "error";
  } else {
    $_SESSION["msg_desc"] = "La creación del convenio se realizó exitosamente";
     $_SESSION["msg_type"]  = "succesfull";
  }
  header('Location: ' . $_GET["target"]);
}

function updateConvenio($id,$nombre, $seguro,$poliza) {

  require_once ('../entity/convenio_aseguradora.php');
  $convenio_aseguradora = new convenio_aseguradora();
  $convenio_aseguradora->id=$id;
  $convenio_aseguradora->descripcion = $nombre;
  $convenio_aseguradora->id_aseguradora = $seguro;

  $_SESSION["msg"] = "show";

  if (!$convenio_aseguradora->update_by_id()) {
    $_SESSION["msg_desc"] = "Ocurrio un error al tratar de actualizar el convenio. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
    $_SESSION["msg_type"] = "error";
  } else {
    $_SESSION["msg_desc"] = "La actualización del convenio se realizó exitosamente";
     $_SESSION["msg_type"]  = "succesfull";
  }
  header('Location: ' . $_GET["target"]);
}

function deleteConvenio($id) {

  require_once ('../entity/convenio_aseguradora.php');
  $convenio_aseguradora = new convenio_aseguradora();
  $convenio_aseguradora->id=$id;

  $_SESSION["msg"] = "show";

  if (!$convenio_aseguradora->delete()) {
    $_SESSION["msg_desc"] = "Ocurrio un error al tratar de eliminar el convenio. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.";
    $_SESSION["msg_type"] = "error";
  } else {
    $_SESSION["msg_desc"] = "La eliminación del convenio se realizó exitosamente";
     $_SESSION["msg_type"]  = "succesfull";
  }
  header('Location: ' . $_GET["target"]);
}
?>