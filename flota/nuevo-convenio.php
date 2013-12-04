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
              <span class="title">Crear convenio</span>
            </div>
            <div id="scroll" style="margin-top: 30px">
              <div id="create-agreement">
                <form method="post" action="operation.php?operation_type=1&step=1">  
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
                      <td><textarea name="descripcion" class="common-input is-required" style="height: 100px"></textarea></td>
                    </tr>
                    <tr>
                      <td>Seguro</td>
                    </tr>                  
                    <tr>
                      <td>
                        <select name="seguro" class="common-input is-required" style="width: 370px">
                          <option>Mercantil</option>
                          <option>Caracas</option>
                        </select>
                      </td>
                    </tr>                                
                    <tr>
                      <td>Número de póliza</td>
                    </tr>                 
                    <tr>
                      <td><input type="text" name="poliza" class="common-input is-required"></td>
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
              <li style="margin-left: 0px"><input type="button" class="icon-step icon-back-disabled" value=""></li>
              <li><a href="importar-datos.php">Crear convenio</a></li>
              <li><span class="arrow"></span></li>                      
              <li><a href="importar-datos.php">Importar datos</a></li>
              <li><span class="arrow"></span></li>               
              <li>Condiciones y coberturas</li>
              <li class="button-back"><input type="button" class="icon-step icon-next" value="" onclick="WIZARD.create($('#create-agreement').find('form'));"></li>                
            </ul>
          </div>
        </div>
      </div>
    </div>
    <script src="../plugins/jquery-1.10.2.min.js"></script>
    <script src="../plugins/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="js/snippet.js"></script>
    <scrip type="text/javascript">
      $(document).ready(WIZARD.init("1"));
    </scrip>
</body>
</html>