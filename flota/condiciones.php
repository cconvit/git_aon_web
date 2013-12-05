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
    <div id="new" class="dialog">
      <form method="post" action="oeration.php" onsubmit="return isValidateSubmit($(this))">
        <table align="center" width="360">
          <tbody>
            <tr>
              <td>Cobertura</td>
            </tr>
            <tr>
              <td><select name="cobertura" class="common-input common-select"  style="width: 370px;"></select></td>
            </tr>
            <tr>
              <td>Tipo de Cálculo</td>
            </tr>
            <tr>
              <td><select name="calculo" class="common-input common-select" style="width: 370px;"></select></td>
            </tr>
            <tr>
              <td>Particular</td>
            </tr>
            <tr>
              <td><input type="text" name="particular" class="common-input is-required"></td>
            </tr>
            <tr>
              <td>Rustico</td>
            </tr>
            <tr>
              <td><input type="text" name="rustico" class="common-input is-required"></td>
            </tr>
            <tr>
              <td>Pickup/Van</td>
            </tr>
            <tr>
              <td><input type="text" name="pickup" class="common-input is-required"></td>
            </tr>
            <tr>
              <td><div class="required hide">Uno o más campos son inválidos.</div></td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td>
                <div class="buttons-panel">
                  <input type="submit" class="common-button" value="Guardar">
                  <input type="button" class="common-button" value="Salir" onclick="$('#new').dialog('close');">
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
        <div class="message hide"></div>
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
              <span class="title">Coberturas y Condiciones</span>
              <input type="button" class="add-button" value="Añadir cobertura" onclick="$('#new').dialog('open');">
            </div>
            <div id="scroll" style="margin-top: 30px">
              <table class="tbl-details" cellspacing="0" borderspacing="0">
                <tbody>
                  <tr>
                    <td>
                      <div class='item'>
                        <p><span class="check icon-check"></span><span class="item-title">Eventos catastróficos</span></p>
                        <p class="separator"></p>
                        <div class="info-down">
                          <div class="options">
                            <form method="post" action="operation.php" action="">
                              <p>
                                <input id="input-file" type="button" class="icon-operation icon-modified" data="1" onclick="UTIL.loadDialog('load/loadConditon.php', this, $('#modify')); return false;">
                                <input id="input-file" type="button" class="icon-operation icon-delete" data="1">
                              </p>
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
        </div>
        <div id="footer">
          <div id="nav-step">
            <ul>
              <li style="margin-left: 0px"><input type="button" class="icon-step icon-back-disabled" value=""></li>
              <li>Crear convenio</li>
              <li><span class="arrow"></span></li>                      
              <li><a href="importar-datos.php">Importar datos</a></li>
              <li><span class="arrow"></span></li>               
              <li><a class="current-step" href="condiciones.php">Condiciones y coberturas</a></li>
              <li class="button-back"><input type="button" class="icon-step icon-next" value="" onclick="WIZARD.create($('#create-agreement').find('form'));"></li>                
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div id="modify" class="dialog"></div>
    <script src="../plugins/jquery-1.10.2.min.js"></script>
    <script src="../plugins/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="js/snippet.js"></script>
  </body>
</html>
