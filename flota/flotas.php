<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Aon - Flotas</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link href="css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css">
    <link href="css/normalize.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div id="modify" class="dialog"></div>
    <div id="container">
      <div id="header">
        <img id="logo" src="img/logo.png">
        <div id="top-nav"></div>
      </div>
      <div id="content">
        <div class="message"></div>
        <div id="left-nav">
          <ul>
            <li><a href="clientes.php">Clientes</a></li>
            <li><a href="seguros.php">Seguros</a></li>
            <li><a href="coberturas.php">Coberturas</a></li>
            <li><a href="convenios.php">Convenios</a></li>
            <li class="current"><a href="flotas.php">Flotas</a></li>
            <li style="border: none;"><a href="Cotizaciones">Cotizaciones</a></li>
          </ul>
        </div>
        <div id="main">
          <div id="main-detail">
            <div id="nav-operations">
              <span class="title">Flotas</span>
              <input type="button" class="add-button" onclick="location.href = 'crear-flota.php'" value="Nueva flota">
            </div>
            <div id="scroll">
              <table class="tbl-details" cellspacing="0" borderspacing="0">
                <tbody>
                  <tr>
                    <td>
                      <div class="item">
                        <p class="item-title">movistar</p>
                        <p clas="item-sub-title">movistar empresa</p>
                        <p class="separator"></p>
                        <p class="item-info">Fecha de creación: <span></span></p>
                        <p class="item-info">Última modificación: <span></span></p>
                        <div class="options top-max">
                          <form method="post" action="../php/operation/administration.php?operation_type=12&target=../../flota/convenios.php" onsubmit="return formOperation()">
                            <input type="button" data="" class="icon-operation icon-modified" onclick="UTIL.loadDialog('load/loadAgreement.php', this, $('#modify')); return false;">
                            <input type="submit" type="submit" class="icon-operation icon-delete" value="">
                            <input type="hidden" name="id" value="">
                          </form>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="footer"></div>
    <script src="../plugins/jquery-1.10.2.min.js"></script>
    <script src="../plugins/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="js/snippet.js"></script>
  </body>
  <?php
  $_SESSION['msg'] = "hide";
  $_SESSION['msg_desc'] = "";
  $msg_type = "succesfull";
  ?>
