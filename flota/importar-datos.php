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
              <span class="title">Importar datos</span>
            </div>
            <div id="scroll" style="margin-top: 30px">
              <div id="data-import">
                <table class="tbl-details">
                  <tr>
                    <td>
                      <div class='item'>
                        <p><span class="check icon-check"></span><span class="item-title">Cobertura amplia</span></p>
                        <p class="separator"></p>
                        <div class="info-down">
                          <div class="options">
                            <form method="post" action="operation.php?operation_upload=1" enctype="multipart/form-data">
                              <p>
                                <input id="input-file" type="button" class="icon-operation icon-upload">
                                <input type="file" name="coverage" class="hide">
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
                        <p><span class="uncheck icon-check"></span><span class="item-title">Perdida total</span></p>
                        <p class="separator"></p>
                        <div class="info-down">
                          <div class="options">
                            <form method="post" action="operation.php?operation_upload=2" enctype="multipart/form-data">
                              <p>
                                <input id="input-file" type="button" class="icon-operation icon-upload">
                                <input type="file" name="loss" class="hide" value="null">
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
                        <p><span class="check icon-check"></span><span class="item-title">Clasificación</span></p>
                        <p class="separator"></p>
                        <div class="info-down">
                          <div class="options">
                            <form method="post" action="operation.php?operation_upload=3" enctype="multipart/form-data">
                              <p>
                                <input id="input-file" type="button" class="icon-operation icon-upload">
                                <input type="file" name="clasification" class="hide" value="null">
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
                        <p><span class="uncheck icon-check"></span><span class="item-title">Segmentacion</span></p>
                        <p class="separator"></p>
                        <div class="info-down">
                          <div class="options">
                            <form method="post" action="operation.php?operation_upload=4" enctype="multipart/form-data">
                              <p>
                                <input id="input-file" type="button" class="icon-operation icon-upload">
                                <input type="file" name="groups" class="hide" value="null">
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
                        <p><span class="check icon-check"></span><span class="item-title">Grua</span></p>
                        <p class="separator"></p>
                        <div class="info-down">
                          <div class="options">
                            <form method="post" action="operation.php?operation_upload=5" enctype="multipart/form-data">
                              <p>
                                <input id="input-file" type="button" class="icon-operation icon-upload">
                                <input type="file" name="assistance" class="hide" value="null">
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
        </div>
        <div id="footer">
          <div id="nav-step">
            <ul>
              <li style="margin-left: 0px"><input type="button" class="icon-step icon-back-disabled" value=""></li>
              <li>Crear convenio</li>
              <li><span class="arrow"></span></li>                      
              <li><a class="current-step" href="importar-datos.php">Importar datos</a></li>
              <li><span class="arrow"></span></li>               
              <li>Condiciones y coberturas</li>
              <li class="button-back"><input type="button" class="icon-step icon-next" value="" onclick="WIZARD.create($('#create-agreement').find('form'));"></li>                
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
    <script src="js/snippet.js"></script>
  </body>
</html>
