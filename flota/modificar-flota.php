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
    <div id="container">
      <div id="header">
        <a href="index.php"><img id="logo" src="img/logo.png"></a>
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
            <li style="border: none;"><a href="cotizaciones.php">Cotizaciones</a></li>
          </ul>
        </div>
        <div id="main">
          <div id="main-detail">
            <div id="nav-operations">
              <span class="title">Modficar flota</span>
            </div>
            <div id="scroll" style="height: 455px;">
              <div style="margin-top: 30px">
                <form method="post" action="../php/operation/administration.php?operation_type=16&target=../../flota/cargar-convenios.php" onsubmit="return isValidateSubmit($(this))">
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
                        <td>INMA (%)</td>
                      </tr>
                      <tr>
                        <td><input type="text" class="common-input is-required" name="inma" value="20"></td></td>
                      </tr>
                      <tr>
                        <td><div class="required hide">Uno o más campos son inválidos.</div></td>
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
                <li><input type="button" class="img-common icon-step icon-exit" value="Salir" onclick="Wizard.exit('flotas.php');"></li>
                <li><a class='current-step' href="modificar-flota.php">Modificar flota</a></li>
                <li><span class="img-common arrow"></span></li>                      
                <li><a>Modificar convenios asociados</a></li>
                <li><input id="next" type="button" class="img-common icon-step icon-next" value="Siguiente" role="create"></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="../plugins/jquery-1.10.2.min.js"></script>
    <script src="../plugins/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>