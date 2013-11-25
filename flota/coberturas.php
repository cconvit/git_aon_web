<?php
session_start();
require_once("../php/db/config.php");
require_once ('../php/db/database.php');
require_once ('../php/entity/cobertura_aseguradora.php');
$co_as = new cobertura_aseguradora();
$coberturas = $co_as->find_all();
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
      <form method="post" action="operation.php?operation_type=7" onsubmit="return isValidateSubmit($(this))">
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
          </tbody>
          <tfoot>
            <tr>
              <td>
                <div class="buttons-panel">
                  <input type="submit" class="common-button" value="Guardar">
                  <input type="button" id="close-dialog" class="common-button" value="Salir" >
                </div>
              </td>
            </tr>
          </tfoot>
        </table>
      </form>
    </div>
    <div id="container">
      <div id="header">
        <img id="logo" src="img/logo.png">
        <div id="top-nav"></div>
      </div>
      <div id="content">
        <div class="message hide">Ocurrio un error mientras se cargaba la cobertura. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.</div>
        <div id="left-nav">
          <ul>
            <li><a href="clientes.php">Clientes</a></li>
            <li><a href="seguros.php">Seguros</a></li>
            <li class="current"><a href="coberturas.php">Coberturas</a></li>
            <li><a href="convenios.php">Convenios</a></li>
            <li><a href="flotas.php">Flotas</a></li>
            <li style="border: none;"><a href="Cotizaciones">Cotizaciones</a></li>
          </ul>
        </div>
        <div id="main">
          <div id="main-detail">
            <div id="nav-operations">
              <span class="title">Coberturas</span>
              <input type="button" class="add-button" value="Nueva cobertura" onclick="$('#new').dialog('open');">
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
                            <p class="item-info">Fecha de creación: <span><?php echo $value->cr_time; ?></span></p>
                            <p class="item-info">Última modificación: <span><?php echo $value->ut_time; ?></span></p>
                            <div class="options">
                              <form method="post" action="operation.php?operation_type=9" onsubmit="return formOperation()">
                                <input type="button" data="<?php echo $value->id; ?>" class="icon-operation icon-modified" onclick="UTIL.loadDialog('load/loadCoverage.php', this, $('#modify'));return false;">
                                <input type="submit" class="icon-operation icon-delete" value="">
                                <input type="hidden" name="id" value="<?php echo $value->id; ?>"
                                </div>
                              </form>
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
    <script src="js/snippet.js"></script>
    <script src="js/function.js"></script>
  </body>