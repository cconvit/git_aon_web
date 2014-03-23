<?php
session_start();

require_once("../php/db/config.php");
require_once ('../php/db/database.php');
require_once ('../php/entity/convenio_aseguradora.php');

$convenio_aseguradora = new convenio_aseguradora();
$convenios_aseguradoras = $convenio_aseguradora->find_by_flota($_SESSION["id_flota"]);

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
			<title>Aon - Asociar convenios</title>
			<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
			<link href="../plugins/css/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css">
			<link href="../plugins/css/normalize.css" rel="stylesheet" type="text/css">
			<link href="css/style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div id="load" class="dialog"></div>
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
            <li class="current"><a href="flotas.php">Flotas</a></li>
            <li style="border: none;"><a href="cotizaciones.php">Cotizaciones</a></li>
          </ul>
        </div>
        <div id="main">
          <div id="main-detail">
            <div id="nav-operations">
              <span class="title">Asociar convenios</span>
              <input type="button" class="img-common add-button" value="Asociar convenio" onclick="Utils.loadList('load/loadAgreementsList.php', $('#load'));">
            </div>
            <div id="scroll">
              <table class="tbl-details" cellspacing="0" borderspacing="0">
                <tbody>
                  <?php
                  if (sizeof($convenios_aseguradoras) > 0) {
                    foreach ($convenios_aseguradoras as $value) {
                      ?>                
                      <tr>
                        <td>
                          <div class="item">
                            <p class="item-title"><?php echo $value->as_nombre; ?></p>
                            <p clas="item-sub-title"><?php echo $value->descripcion; ?></p>
                            <p clas="item-sub-title"><?php echo "1002102"; ?></p>
                            <p class="separator"></p>
                            <p class="item-info">Fecha de creación: <span><?php echo $value->cr_time; ?></span></p>
                            <p class="item-info">Última modificación: <span><?php echo $value->ut_time; ?></span></p>
                            <div class="info-down top-min">
                              <div class="options">
                                <form method="post" action="../php/operation/administration.php?operation_type=23&target=../../flota/cargar-convenios.php" onsubmit="return formOperation()">
                                  <input type="submit" type="submit" class="img-common icon-operation icon-delete" value="">
                                  <input type="hidden" name="id" value="<?php echo $value->id; ?>">
                                </form>
                              </div>
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
          <div id="footer">
            <div id="nav-step">
              <ul>
                <li><input id="next" type="button" class="img-common icon-step icon-exit" value="Salir" onclick="Wizard.exit('convenios.php');"></li>
                <li><?php echo $_SESSION['cargar_convenios'] == 1 ? "Crear" : "Modificar"; ?> flota</li>
                <li><span class="img-common arrow"></span></li>                      
                <li><a class="current-step" href="cargar-convenios.php">Asociar convenios</a></li>
                <li><input id="next" type="button" class="img-common icon-step icon-end" value="Finalizar"onclick="Wizard.exit('flotas.php');"></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>    <script src="../plugins/js/jquery-1.10.2.min.js"></script>  
    <script src="../plugins/js/jquery-ui-1.10.4.custom.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
<?php
$_SESSION['msg'] = "hide";
$_SESSION['msg_desc'] = "";
$msg_type = "succesfull";
?>
