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
      newSeguro($_REQUEST["nombre"], $_REQUEST["rs"]);
      break;

    case 5:
      updateSeguro($_REQUEST["id"], $_REQUEST["nombre"], $_REQUEST["rs"]);
      break;

    case 6:
      deleteSeguro($_REQUEST["id"]);
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
     $_SESSION["msg_type"]  = "succesfully";
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
    $_SESSION["msg_type"] = "succesfully";
  }
  header('Location: ' . $_GET["target"]);
}

?>