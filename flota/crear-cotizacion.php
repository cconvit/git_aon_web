<?php
session_start();
require_once("../php/db/config.php");
require_once ('../php/db/database.php');
require_once ('../php/entity/flota.php');
require_once ('../php/entity/cliente.php');

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

$flota = new flota();
$flotas = $flota->find_all();

$cliente = new cliente();
$clientes = $cliente->find_all();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Aon - Crear flota</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link href="css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css">
    <link href="css/normalize.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
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
            <li><a href="coberturas.php">Coberturas</a></li>
            <li><a href="convenios.php">Convenios</a></li>
            <li><a href="flotas.php">Flotas</a></li>
            <li class="current" style="border: none;"><a href="cotizaciones.php">Cotizaciones</a></li>
          </ul>
        </div>
        <div id="main">
          <div id="main-detail">
            <div id="nav-operations">
              <span class="title">Crear cotización</span>
            </div>
            <div id="scroll" style="height: 455px;">
              <div style="margin-top: 30px">
                <form method="post" action="../php/operation/administration.php?operation_type=20&target=../../flota/validar-flota.php&target_fail=../../flota/crear-cotizacion.php" enctype="multipart/form-data">
                  <table>
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
                        <td><textarea class="common-input is-required" name="descripcion" style="height: 66px;"></textarea></td>
                      </tr>
                      <tr>
                        <td>Cliente</td>
                      </tr>
                      <tr>
                        <td>
                          <select class="common-input common-select" name="cliente">
                            <?php
                            if (sizeof($clientes) > 0) {
                              foreach ($clientes as $value) {
                                ?>
                                <option value="<?php echo $value->id; ?>"><?php echo $value->nombre; ?></option>
                                <?php
                              }
                            }
                            ?>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td>Flota</td>
                      </tr>
                      <tr>
                        <td>
                          <select type="text" class="common-input common-select" name="flota">
                            <?php
                            if (sizeof($flotas) > 0) {
                              foreach ($flotas as $value) {
                                ?>
                                <option value="<?php echo $value->id; ?>"><?php echo $value->empresa; ?></option>
                                <?php
                              }
                            }
                            ?>
                          </select>
                        </td>
                      </tr>                       
                      <tr>
                        <td>
                          <div class="pull-left">
                            <div class="button-red upload">explorar archivos</div>
                            <input type="text" id="name" class="common-input is-required" style="margin-top: 5px" value="no ha seleccionado un archivo..." readonly="true">
                            <input type="file" id="fleet" name="file" class="hide">
                          </div>
                          <div class="img-common icon-excel pull-rigth upload"></div>
                          <div class="required hide">Uno o más campos son inválidos.</div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </form>
              </div>
            </div>
          </div>
          <div id="footer">
            <div id="nav-step">
              <ul>
                <li><input type="button" class="img-common icon-step icon-exit" onclick="Wizard.exit('cotizaciones.php');"></li>
                <li><a class='current-step' href="cotizar.php">Crear cotización</a></li>
                <li><span class="img-common arrow"></span></li>                      
                <li><a>Validar flota</a></li>
                <li><input id="next" type="button" class="img-common icon-step icon-next" role="quotation"></li>               
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="../plugins/jquery-1.10.2.min.js"></script>
    <script src="../plugins/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="js/main.js"></script>
    <script type="text/javascript">
      document.getElementById("fleet").value = "";
      document.getElementById("name").value = "no ha seleccionado un archivo...";
    </script>
  </body>
</html>
<?php
$_SESSION['msg'] = "hide";
$_SESSION['msg_desc'] = "";
$msg_type = "succesfull";
?>
