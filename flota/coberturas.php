<?php
session_start();
require_once("../php/db/config.php");
require_once ('../php/db/database.php');
require_once ('../php/entity/cobertura_aseguradora.php');
$co_as = new cobertura_aseguradora();
$coberturas = $co_as->find_all();
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
    <title>Aon - Coberturas</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link href="css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css">
    <link href="css/normalize.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div id="new" class="dialog">
      <form method="post" action="../php/operation/administration.php?operation_type=7&target=../../flota/coberturas.php" onsubmit="return isValidateSubmit($(this))">
        <table align="center" width="360">
          <tbody>
            <tr>
              <td>Nombre</td>
            </tr>
            <tr>
              <td><input type="text" class="common-input is-required" name="nombre"></td></td>
            </tr>
            <tr>
              <td>Descripción</td>
            </tr>
            <tr>
              <td><input type="text" class="common-input is-required" name="descripcion"></td></td>
            </tr>
            <tr>
              <td><div class="required hide">Uno o más campos son inválidos.</div></td>
            </tr>              
          </tbody>
          <tfoot>
            <tr>
              <td>
                <div class="buttons-panel">
                  <input type="submit" class="img-common common-button" value="Guardar">
                  <input type="button" class="img-common common-button" value="Salir" onclick="$('#new').dialog('close');">
                </div>
              </td>
            </tr>
          </tfoot>
        </table>
      </form>
    </div>
    <div id="container">
      <div id="header">
        <a href="index.php"><img id="logo" src="img/logo.png"></a>
        <div id="top-nav"></div>
      </div>
      <div id="content">
        <div class="message <?php echo $msg . " " . $msg_type; ?>"><?php echo $msg_desc; ?></div>
        <div id="left-nav">
          <ul>
            <li><a href="clientes.php">Clientes</a></li>
            <li><a href="seguros.php">Seguros</a></li>
            <li class="current"><a href="coberturas.php">Coberturas</a></li>
            <li><a href="convenios.php">Convenios</a></li>
            <li><a href="flotas.php">Flotas</a></li>
            <li style="border: none;"><a href="cotizaciones.php">Cotizaciones</a></li>
          </ul>
        </div>
        <div id="main">
          <div id="main-detail">
            <div id="nav-operations">
              <span class="title">Coberturas</span>
              <input type="button" class="img-common add-button" value="Nueva cobertura" onclick="$('#new').dialog('open');">
            </div>
            <div id="scroll">
              <table class="tbl-details" cellspacing="0" borderspacing="0">
                <tbody>
                  <?php
                  if (sizeof($coberturas) > 0) {
                    foreach ($coberturas as $value) {
                      ?>
                      <tr>
                        <td>
                          <div class="item">
                            <p class="item-title"><?php echo $value->desc_cobertura; ?></p>
                            <p clas="item-sub-title"><?php echo ""; ?></p>
                            <p class="separator"></p>
                            <div class="info-down">
                              <p class="item-info">Fecha de creación: <span><?php echo $value->cr_time; ?></span></p>
                              <p class="item-info">Última modificación: <span><?php echo $value->ut_time; ?></span></p>
                              <div class="options">
                                <form method="post" action="../php/operation/administration.php?operation_type=9&target=../../flota/coberturas.php" onsubmit="return formOperation()">
                                  <input type="button" data="<?php echo $value->id; ?>" class="img-common icon-operation icon-modified" onclick="UTIL.loadDialog('load/loadCoverage.php', this, $('#modify'))">
                                  <input type="submit" class="img-common icon-operation icon-delete" value="">
                                  <input type="hidden" name="id" value="<?php echo $value->id; ?>">
                                </form>
                              </div>
                            </div>
                        </td>
                      </tr>
                      <?php
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="footer"></div>
    <div id="modify" class="dialog"></div>
    <script src="../plugins/jquery-1.10.2.min.js"></script>
    <script src="../plugins/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
<?php
$_SESSION['msg'] = "hide";
$_SESSION['msg_desc'] = "";
$msg_type = "succesfull";
?>
