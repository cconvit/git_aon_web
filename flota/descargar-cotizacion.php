<?php
session_start();
require_once("../php/db/config.php");
require_once ('../php/db/database.php');
require_once ('../php/entity/descarga_cotizacion.php');

$descarga_cotizacion = new descarga_cotizacion();
$descarga_cotizacion->id_cotizacion=$_REQUEST["id"];
$aux = $descarga_cotizacion->find_by_id();
$msg = "hide";
$msg_desc = "";
$msg_type = "succesfull";

if (isset($_SESSION['msg'])) {
  if ($_SESSION['msg'] == "show") {
    $msg = "show";
    $msg_desc = $_SESSION['msg_desc'];
    $msg_type = $_SESSION['msg_type'];
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Aon - Clientes</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link href="../plugins/css/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css">
    <link href="../plugins/css/normalize.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div id="modify" class="dialog"></div>
    <div id="container">
      <div id="header">
        <a href="index.php"><img id="logo" src="img/logo.png"></a>
        <div id="top-nav"></div>
      </div>
      <div id="content">
        <div class="message hide"></div>
        <div id="left-nav">
          <ul>
            <li><a href="clientes.php">Clientes</a></li>
            <li><a href="seguros.php">Seguros</a></li>
            <li><a href="coberturas.php">Coberturas</a></li>
            <li><a href="convenios.php">Convenios</a></li>
            <li><a href="flotas.php">Flotas</a></li>
            <li class="current" style="border: none;"><a href="cotizaciones.php">Cotizaciones</a></li>
          </ul>
        </div>
        <div id="main">
          <div id="main-detail">
            <div id="nav-operations">
              <span class="title">Descargas</span>
            </div>
            <div id="scroll">
              <table class="tbl-details" cellspacing="0" borderspacing="0">
                <tbody>
                  <?php
                        foreach ($aux as $value) {
                          ?>
                  <tr>
                    <td>
                      <div class="item">
                        <p class="item-title"><?php echo $value->seguro;?></p>
                        <p clas="item-sub-title"><?php echo $value->nombre;?></p>
                        <p class="separator"></p>
                        <div class="info-down">
                          <div class="options">
                            <a class="img-common icon-operation icon-download"  href="<?php echo $value->link;?>">f</a>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                    <?php
                        }
                      
                      ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="footer"></div>    <script src="../plugins/js/jquery-1.10.2.min.js"></script>  
    <script src="../plugins/js/jquery-ui-1.10.4.custom.min.js"></script>
    <script src="js/main.js"></script>
  </body>
  <?php
  $_SESSION['msg'] = "hide";
  $_SESSION['msg_desc'] = "";
  $msg_type = "succesfull";
  ?>
