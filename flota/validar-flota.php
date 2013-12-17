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

?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Aon - Validar flota</title>
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
            <li><a href="convenios.php">Convenios</a></li>
            <li><a href="flotas.php">Flotas</a></li>
            <li class="current" style="border: none;"><a href="cotizaciones.php">Cotizaciones</a></li>
          </ul>
        </div>
        <div id="main">
          <div id="main-detail">
            <div id="nav-operations" style="display: none">
              <span class="title">Validar flota</span>
            </div>
            <div id="tabs">
              <ul>
                <li style="padding-bottom: 0px;"><a id="errors" class="img-common tab" href="#tabs-1" style="padding-bottom: 0px;">Errores</a></li>
                <li style="padding-bottom: 0px;"><a id="valids" class="img-common tab"  href="#tabs-2">Validos</a></li>
                <li style="padding-bottom: 0px;"><a id="all" class="img-common tab" href="#tabs-3">Totales</a></li>
              </ul>
              <div id="tabs-1" class="tabs-info">
                <div class="scrollable-list" style="width: 100%; overflow-y: auto;">
                  <table id="list-fleet" style="width: 100%">
                    <thead id="errors">
                    <th class="no-padding" style="width: 32px; background-color: #FFFFFF; padding-left: "></th>
                    <th class="no-padding" style="width: 32px; background-color: #FFFFFF;"></th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Versión</th>
                    <th>Año</th>
                    <th>Uso</th>
                    <th>Ocupantes</th>
                    <th>Cobertura</th>
                    <th>Edad</th>
                    <th>Sexo</th>
                    <th>Edo. Civil</th>                                   
                    </thead>
                    <tbody>
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>                     
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>                      
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>                     
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>                      
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>                      
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>                      
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>                      
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>                      
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>                      
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>                      
                    </tbody>                    
                  </table>
                </div>
              </div>
              <div id="tabs-2" class="tabs-info">
                <div class="scrollable-list" style="width: 100%; overflow-y: auto;">
                  <table id="list-fleet" style="width: 100%">
                    <thead id="valids">
                    <th class="no-padding" style="width: 32px; background-color: #FFFFFF; padding-left: "></th>
                    <th class="no-padding" style="width: 32px; background-color: #FFFFFF;"></th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Versión</th>
                    <th>Año</th>
                    <th>Uso</th>
                    <th>Ocupantes</th>
                    <th>Cobertura</th>
                    <th>Edad</th>
                    <th>Sexo</th>
                    <th>Edo. Civil</th>                                   
                    </thead>
                    <tbody>
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>                     
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>                      
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>                     
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>                      
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>                      
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>                      
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>                      
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>                      
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>                      
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>                      
                    </tbody>                    
                  </table>
                </div>
              </div>
              <div id="tabs-3" class="tabs-info">
                <div class="scrollable-list" style="width: 100%; overflow-y: auto;">
                  <table id="list-fleet" style="width: 100%">
                    <thead id="alls">
                    <th class="no-padding" style="width: 32px; background-color: #FFFFFF; padding-left: "></th>
                    <th class="no-padding" style="width: 32px; background-color: #FFFFFF;"></th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Versión</th>
                    <th>Año</th>
                    <th>Uso</th>
                    <th>Ocupantes</th>
                    <th>Cobertura</th>
                    <th>Edad</th>
                    <th>Sexo</th>
                    <th>Edo. Civil</th>                                   
                    </thead>
                    <tbody>
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>                     
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>                      
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>                     
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>                      
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>                      
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>                      
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>                      
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>                      
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>                      
                      <tr>
                        <td class="no-padding no-border"><a class="img-common icon-edit icon-actions"></a></td>
                        <td class="no-padding no-border"><a class="img-common icon-remove icon-actions"></a></td>
                        <td>TOYOTA</td>
                        <td>COROLLA</td>
                        <td>1.8 XGE</td>
                        <td>2010</td>
                        <td>PARTICULAR</td>
                        <td>5</td>
                        <td>AMPLIA</td>
                        <td>29</td>
                        <td>M</td>
                        <td>SOLTERO</td>
                      </tr>                      
                    </tbody>                    
                  </table>
                </div>                
              </div>
            </div>
          </div>
        </div>
        <div id="footer">
          <div id="nav-step">
            <ul>
              <li><input type="button" class="img-common icon-step icon-exit" onclick="WIZARD.exit('flotas.php');"></li>
              <li><a class='current-step' href="cotizar.php">Cotizar</a></li>
              <li><span class="img-common arrow"></span></li>                      
              <li>Validar flota</li>
              <li><span class="img-common arrow"></span></li>  
              <li>Descargar cotización</li>
              <li><input id="next" type="button" class="img-common icon-step icon-next" role="create"></li>               
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../plugins/jquery-1.10.2.min.js"></script>
  <script src="../plugins/jquery-ui-1.10.3.custom.min.js"></script>
  <script src="js/snippet.js"></script>
  <script type="text/javascript">
                $(function(e) {
                  $(window).resize(function() {
                    AON.setScrollListHeight();
                 });
                });
                AON.setScrollListHeight();
  </script>
</body>
</html>
<?php
$_SESSION['msg'] = "hide";
$_SESSION['msg_desc'] = "";
$msg_type = "succesfull";
?>
