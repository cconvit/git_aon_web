<?php
session_start();
require_once("../php/db/config.php");
require_once ('../php/db/database.php');
require_once ('../php/entity/convenio_aseguradora.php');
require_once ('../php/entity/aseguradora.php');

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
    <title>Aon - Nuevo convenio</title>
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
            <li class="current"><a href="convenios.php">Convenios</a></li>
            <li><a href="flotas.php">Flotas</a></li>
            <li style="border: none;"><a href="cotizaciones.php">Cotizaciones</a></li>
          </ul>
        </div>
        <div id="main">
          <div id="main-detail">
            <div id="nav-operations">
              <span class="title">Crear convenio</span>
            </div>
            <div id="scroll" style="height: 455px;">
              <div style="margin-top: 30px">
                <div id="create-agreement">
                  <form method="post" action="../php/operation/administration.php?operation_type=10&target=../../flota/cargar-datos.php&target_fail=../../flota/convenios.php">  
                    <table>
                      <tr>
                        <td>Nombre</td>
                      </tr>
                      <tr>
                        <td><input type="text" name="nombre" class="common-input is-required"></td>
                      </tr>                  
                      <tr>
                        <td>Descripción</td>
                      </tr>                 
                      <tr>
                        <td><textarea name="descripcion" class="common-input is-required" style="height: 66px"></textarea></td>
                      </tr>
                      <tr>
                        <td>Seguro</td>
                      </tr>                  
                      <tr>
                        <td>
                          <select class="common-input common-select" name="seguro">
                            <?php
                            if (sizeof($aseguradoras) > 0) {
                              foreach ($aseguradoras as $value) {
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
                        <td>Número de póliza (opcional)</td>
                      </tr>                 
                      <tr>
                        <td><input type="text" name="poliza" class="common-input"></td>
                      </tr>
                      <tr>
                        <td><div class="required hide">Uno o más campos son inválidos.</div></td>
                      </tr>
                    </table>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div id="footer">
            <div id="nav-step">
              <ul>
                <li><input type="button" class="img-common icon-step icon-exit" onclick="Wizard.exit('cotizaciones.php');"></li>
                <li><a class='current-step' href="crear-convenio.php">Crear convenio</a></li>
                <li><span class="img-common arrow"></span></li>                      
                <li><a>Importar datos</a></li>
                <li><span class="img-common arrow"></span></li>               
                <li><a>Condiciones de negocio</a></li>
                <li><input id="next" type="button" class="img-common icon-step icon-next" role="create"></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
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
