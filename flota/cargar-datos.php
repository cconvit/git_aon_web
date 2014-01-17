<?php
session_start();
require_once("../php/db/config.php");
require_once ('../php/db/database.php');

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

if (isset($_REQUEST['id'])) {

  $_SESSION["id_convenio_as"] = $_REQUEST['id'];
  $_SESSION["up_amplia"] = "uncheck";
  $_SESSION["up_total"] = "check";
  $_SESSION["up_segmentacion"] = "uncheck";
  $_SESSION["up_grua"] = "uncheck";
  $_SESSION["up_clasificacion"] = "uncheck";
}
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
              <span class="title">Importar datos</span>
            </div>
            <div id="scroll">
              <table id="upload-data" class="tbl-details">
                <tr>
                  <td>
                    <div class='item'>
                      <p><span class="img-common <?php echo $_SESSION["up_amplia"]; ?> icon-check"></span><span class="item-title">Tasas de Cobertura Ámplia</span></p>
                      <p class="separator"></p>
                      <div class="info-down">
                        <div class="options">
                          <form method="post" action="../php/operation/operation_upload.php?operation_upload=1&target=../../flota/cargar-datos.php" enctype="multipart/form-data">
                            <p>
                              <input id="input-file" type="button" class="img-common icon-operation icon-upload">
                              <input type="button" class="img-common icon-operation icon-view">
                              <input type="file" name="file" class="hide">
                            </p>
                          </form>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class='item'>
                      <p><span class="img-common <?php echo $_SESSION["up_total"]; ?> icon-check"></span><span class="item-title">Tasas de Pérdida Total</span></p>
                      <p class="separator"></p>
                      <div class="info-down">
                        <div class="options">
                          <form method="post" action="../php/operation/operation_upload.php?operation_upload=2&target=../../flota/cargar-datos.php" enctype="multipart/form-data">
                            <p>
                              <input id="input-file" type="button" class="img-common icon-operation icon-upload">
                              <input type="button" class="img-common icon-operation icon-view">
                              <input type="file" name="file" class="hide" value="null">
                            </p>
                          </form>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class='item'>
                      <p><span class="img-common <?php echo $_SESSION["up_clasificacion"]; ?> icon-check"></span><span class="item-title">Clasificación</span></p>
                      <p class="separator"></p>
                      <div class="info-down">
                        <div class="options">
                          <form method="post" action="../php/operation/operation_upload.php?operation_upload=3&target=../../flota/cargar-datos.php" enctype="multipart/form-data">
                            <p>
                              <input id="input-file" type="button" class="img-common icon-operation icon-upload">
                              <input type="button" class="img-common icon-operation icon-view">
                              <input type="file" name="file" class="hide" value="null">
                            </p>
                          </form>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class='item'>
                      <p><span class="img-common uncheck icon-check"></span><span class="item-title">Clasificación por Monto asegurado</span></p>
                      <p class="separator"></p>
                      <div class="info-down">
                        <div class="options">
                          <form method="post" action="../php/operation/operation_upload.php?operation_upload=3&target=../../flota/cargar-datos.php" enctype="multipart/form-data">
                            <p>
                              <input id="input-file" type="button" class="img-common icon-operation icon-upload">
                              <input type="button" class="img-common icon-operation icon-view">
                              <input type="file" name="file" class="hide" value="null">
                            </p>
                          </form>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>   
                <tr>
                  <td>
                    <div class='item'>
                      <p><span class="img-common <?php echo $_SESSION["up_segmentacion"]; ?> icon-check"></span><span class="item-title">Segmentación</span></p>
                      <p class="separator"></p>
                      <div class="info-down">
                        <div class="options">
                          <form method="post" action="../php/operation/operation_upload.php?operation_upload=4&target=../../flota/cargar-datos.php" enctype="multipart/form-data">
                            <p>
                              <input id="input-file" type="button" class="img-common icon-operation icon-upload">
                              <input type="button" class="img-common icon-operation icon-view">
                              <input type="file" name="file" class="hide" value="null">
                            </p>
                          </form>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>                  
                <tr>
                  <td>
                    <div class='item'>
                      <p><span class="img-common <?php echo $_SESSION["up_grua"]; ?> icon-check"></span><span class="item-title">AISTENCIA VÍAL</span></p>
                      <p class="separator"></p>
                      <div class="info-down">
                        <div class="options">
                          <form method="post" action="../php/operation/operation_upload.php?operation_upload=5&target=../../flota/cargar-datos.php" enctype="multipart/form-data">
                            <p>
                              <input id="input-file" type="button" class="img-common icon-operation icon-upload">
                              <input type="button" class="img-common icon-operation icon-view">
                              <input type="file" name="file" class="hide">
                            </p>
                          </form>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>                  
              </table>
            </div>
          </div>
        </div>
        <div id="footer">
          <div id="nav-step">
            <ul>
              <li><input type="button" class="img-common icon-step icon-exit" onclick="Wizard.exit('convenios.php')"></li>
              <li><a>Crear convenio</a></li>
              <li><span class="img-common arrow"></span></li>                      
              <li><a class='current-step' href="cargar-datos.php">Importar datos</a></li>
              <li><span class="img-common arrow"></span></li>               
              <li><a href="cargar-condiciones.php">Condiciones de negocio</a></li>
              <li><input id="next" type="button" class="img-common icon-step icon-next" onclick="location.href = 'cargar-condiciones.php'"></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div id="load" class="modal">
      <div class="modal"><p>Estamos procesando el archivo. Esta operación puede tardar unos minutos. Por favor, espere</p></div>
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