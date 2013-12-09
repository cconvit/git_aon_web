<?php
session_start();
require_once("../php/db/config.php");
require_once ('../php/db/database.php');
require_once ('../php/entity/convenio_aseguradora.php');
require_once ('../php/entity/aseguradora.php');

$convenio_aseguradora = new convenio_aseguradora();
$convenios_aseguradoras = $convenio_aseguradora->find_all();
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

$aseguradora = new aseguradora();
$aseguradoras = $aseguradora->find_all();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Aon - Agregar convenios</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link href="css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css">
    <link href="css/normalize.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div id="new" class="dialog">
      <
      
      
      
    </div>
    <div id="container">
      <div id="header">
        <img id="logo" src="img/logo.png">
        <div id="top-nav"></div>
      </div>
      <div id="content">
        <div class="message <?php echo $msg . " " . $msg_type; ?>"><?php echo $msg_desc; ?></div>
        <div id="left-nav">
          <ul>
            <li><a href="clientes.php">Clientes</a></li>
            <li><a href="seguros.php">Seguros</a></li>
            <li><a href="coberturas.php">Coberturas</a></li>
            <li class="current"><a href="convenios.php">Convenios</a></li>
            <li><a href="flotas.php">Flotas</a></li>
            <li style="border: none;"><a href="Cotizaciones">Cotizaciones</a></li>
          </ul>
        </div>
        <div id="main">
          <div id="main-detail">
            <div id="nav-operations">
              <span class="title">Agregar convenios</span>
              <input type="button" class="add-button" value="Agregar convenio" onclick="$('#new').dialog('open');">
            </div>
            <div id="scroll">
              <table class="tbl-details" cellspacing="0" borderspacing="0">
                <tbody>
                  <tr>
                    <td>
                      <div class="item">
                        <p class="item-title">Mercantil Seguros</p>
                        <p clas="item-sub-title">MERCANTIL 01-32-34-8819 01-07-2013/2014</p>
                        <p class="separator"></p>
                        <div class="info-down">
                          <div class="options">
                            <form onsubmit="return formOperation()" action="../php/operation/administration.php?operation_type=12&amp;target=../../flota/convenios.php" method="post">
                              <input type="submit" value="" class="icon-operation icon-delete">
                              <input type="hidden" value="1" name="id">
                            </form>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>                 
                </tbody>
              </table>
            </div>
          </div>
          <div id="footer">
            <div id="nav-step">
              <ul>
                <li><input id="next" type="button" class="icon-step icon-exit" role="create"></li>
                <li><a class='current-step' href="crear-flota.php">Crear flota</a></li>
                <li><span class="arrow"></span></li>                      
                <li>Agregar convenios</li>
                <li><input id="next" type="button" class="icon-step icon-next" role="create"></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="../plugins/jquery-1.10.2.min.js"></script>
    <script src="../plugins/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="js/snippet.js"></script>
  </body>
</html>
<?php
$_SESSION['msg'] = "hide";
$_SESSION['msg_desc'] = "";
$msg_type = "succesfull";
?>
