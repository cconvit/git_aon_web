<?php
session_start();

require_once("../php/db/config.php");
require_once ('../php/db/database.php');
require_once ('../php/entity/convenio_aseguradora.php');

$convenio_aseguradora=new convenio_aseguradora();
$convenios_aseguradoras=$convenio_aseguradora->find_by_flota($_SESSION["id_flota"]);

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
    <title>Aon - Agregar convenios</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link href="css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css">
    <link href="css/normalize.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div id="load" class="dialog"></div>
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
            <li style="border: none;"><a href="cotizaciones.php">Cotizaciones</a></li>
          </ul>
        </div>
        <div id="main">
          <div id="main-detail">
            <div id="nav-operations">
              <span class="title">Agregar convenios</span>
              <input type="button" class="add-button" value="Agregar convenio" onclick="UTIL.loadList('load/loadAgreementsList.php', $('#load'));">
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
                            <div class="options top-max">
                              <form method="post" action="../php/operation/administration.php?operation_type=12&target=../../flota/convenios.php" onsubmit="return formOperation()">
                                <input type="submit" type="submit" class="icon-operation icon-delete" value="">
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
          <div id="footer">
            <div id="nav-step">
              <ul>
                <li><input id="next" type="button" class="icon-step icon-exit" onclick="WIZARD.exit('flotas.php');"></li>
                <li>Crear flota</li>
                <li><span class="arrow"></span></li>                      
                <li><a class='current-step' href="cargar-convenios.php">Agregar convenios</a></li>
                <li><input id="next" type="button" class="icon-step icon-end" role="create"></li>
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
