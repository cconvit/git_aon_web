<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Aon - Convenios</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link href="css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css">
    <link href="css/normalize.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div id="new" class="dialog">
      <form method="post" action="operation.php?operation_type=10" onsubmit="return isValidateSubmit($(this))">
        <table align="center" width="370">
          <tbody>
            <tr>
              <td>Nombre</td>
            </tr>
            <tr>
              <td><input type="text" class="common-input is-required" name="nombre"></td></td>
            </tr>
            <tr>
              <td>Seguro</td>
            </tr>
            <tr>
              <td>
                <select class="common-input" name="seguro" style="width: 370px">
                  <option value="1">Mercantil</option>
                  <option value="2">Caracas</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>Poliza (opcional)</td>
            </tr>
            <tr>
              <td><input type="text" class="common-input is-required" name="poliza"></td></td>
            </tr>
            <tr>
              <td><div class="error hide">Uno o más campos son inválidos.</div></td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td>
                <div class="buttons-panel">
                  <input type="submit" class="common-button" value="Guardar">
                  <input type="button" id="close-dialog" class="common-button" onclick="$('#new').dialog('close');" value="Salir" >
                </div>
              </td>
            </tr>
          </tfoot>
        </table>
      </form>
    </div>
    <div id="modify" class="dialog"></div>
    <div id="container">
      <div id="header">
        <img id="logo" src="img/logo.png">
        <div id="top-nav"></div>
      </div>
      <div id="content">
        <div class="message hide">Ocurrio un error mientras se cargaba el cliente. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.</div>
        <div id="left-nav">
          <ul>
            <li class="current"><a href="clientes.php">Clientes</a></li>
            <li><a href="seguros.php">Seguros</a></li>
            <li><a href="coberturas.php">Coberturas</a></li>
            <li><a href="convenios.php">Convenios</a></li>
            <li><a href="flotas.php">Flotas</a></li>
            <li style="border: none;"><a href="Cotizaciones">Cotizaciones</a></li>
          </ul>
        </div>
        <div id="main">
          <div id="main-detail">
            <div id="nav-operations">
              <span class="title">Convenios</span>
              <input type="button" class="add-button" onclick="$('#new').dialog('open');" value="Nuevo convenio">
            </div>
            <div id="scroll">
              <table class="tbl-details" cellspacing="0" borderspacing="0">
                <tbody>

                  <tr>
                    <td>
                      <div class="item">
                        <p class="item-title">Acuerdo empresa 2013</p>
                        <p clas="item-sub-title">Mercantil</p>
                        <p clas="item-sub-title">1029383-122</p>
                        <p class="separator"></p>
                        <p class="item-info">Fecha de creación: <span><?php echo $value->cr_time; ?></span></p>
                        <p class="item-info">Última modificación: <span><?php echo $value->ut_time; ?></span></p>
                        <div class="options top-max">
                          <form method="post" action="operation.php?operation_type=12" onsubmit="return formOperation()">
                            <input type="button" id="modify-client" id-item="<?php echo $value->id; ?>" class="icon-operation icon-modified" onclick="UTIL.loadDialog('load/loadAgreement.php', this, $('#modify'));
                                return false;">
                            <input type="submit" type="submit" value="" class="icon-operation icon-delete">
                            <input type="hidden" name="id" value="<?php echo $value->id; ?>">
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