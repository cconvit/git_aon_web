<?php
session_start();
require_once ("../php/db/config.php");
require_once ('../php/db/database.php');
require_once ('../php/entity/cotizacion_carro.php');
require_once ('../php/operation/validar_carro_cotizacion.php');

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

$validar = new validar_carro_cotizacion();
$cotizacion_carro = new cotizacion_carro();
$cotizacion_carro->id_cotizacion = $_SESSION["id_cotizacion"];
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
    <div id="vehicle"></div>
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
                <li style="padding-bottom: 0px;"><a id="errors-tab" class="img-common tab" href="#tabs-1" style="padding-bottom: 0px;">Errores</a></li>
                <li style="padding-bottom: 0px;"><a id="valids-tab" class="img-common tab"  href="#tabs-2">Validos</a></li>
                <li style="padding-bottom: 0px;"><a id="all-tab" class="img-common tab" href="#tabs-3">Totales</a></li>
              </ul>
              <div id="tabs-1" class="tabs-info">
                <div class="scrollable-list" style="width: 100%; overflow-y: auto;">
                  <table id="list-error" class="list-fleet" style="width: 100%">
                    <thead id="errors">
                    <th class="no-padding" style="width: 32px; background-color: #FFFFFF; padding-left: "></th>
                    <th class="no-padding" style="width: 32px; background-color: #FFFFFF;"></th>
                    <th>rif/ci</th>
                    <th>Asegurado</th>
                    <th>placa</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Versión</th>
                    <th>Año</th>
                    <th>inma</th>
                    <th>Uso</th>
                    <th>Ocupantes</th>
                    <th>Cobertura</th>
                    <th>Edad</th>
                    <th>Sexo</th>
                    <th>Edo. Civil</th>                                   
                    </thead>
                    <tbody>
                      <?php
                      $cotizacion_carros = $cotizacion_carro->find_by_id_cotizacion_error();
                      if (sizeof($cotizacion_carros) > 0) {
                        foreach ($cotizacion_carros as $value) {
                          ?>
                          <tr>
                            <td class="no-padding no-border"><a class="img-common icon-edit icon-actions suggestion" data='<?php echo $value->id; ?>'></a></td>
                            <td class="no-padding no-border"><a class="img-common icon-remove icon-actions" data='<?php echo $value->id; ?>'></a></td>
                            <td><?php echo $value->identificacion; ?></td>
                            <td><?php echo $value->asegurado; ?></td>
                            <td><?php echo $value->placa; ?></td>
                            <td><?php echo $value->car_marca; ?></td>
                            <td><?php echo $value->car_modelo; ?></td>
                            <td><?php echo $value->car_version; ?></td>
                            <td><?php echo $value->car_ano; ?></td>
                            <td><?php echo $value->valor_INMA; ?></td>
                            <td><?php echo $validar->getTipoCarro($value->tipo_carro); ?></td>
                            <td><?php echo $value->car_ocupantes; ?></td>
                            <td><?php echo $validar->getCobertura($value->tipo_cobertura); ?></td>
                            <td><?php echo $value->edad; ?></td>
                            <td><?php echo $validar->getSexo($value->sexo); ?></td>
                            <td><?php echo $validar->getEstadoCivil($value->estado_civil); ?></td>
                          </tr>
                          <?php
                        }
                      }
                      ?>                    
                    </tbody>                    
                  </table>
                </div>
              </div>
              <div id="tabs-2" class="tabs-info">
                <div class="scrollable-list" style="width: 100%; overflow-y: auto;">
                  <table id="list-fleet" class="list-fleet"  style="width: 100%">
                    <thead id="errors">
                    <th class="no-padding" style="width: 32px; background-color: #FFFFFF; padding-left: "></th>
                    <th class="no-padding" style="width: 32px; background-color: #FFFFFF;"></th>
                    <th>rif/ci</th>
                    <th>Asegurado</th>
                    <th>placa</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Versión</th>
                    <th>Año</th>
                    <th>inma</th>
                    <th>Uso</th>
                    <th>Ocupantes</th>
                    <th>Cobertura</th>
                    <th>Edad</th>
                    <th>Sexo</th>
                    <th>Edo. Civil</th>                                   
                    </thead>
                    <tbody>
                      <?php
                      $cotizacion_carros = $cotizacion_carro->find_by_id_cotizacion_success();
                      if (sizeof($cotizacion_carros) > 0) {
                        foreach ($cotizacion_carros as $value) {
                          ?>
                          <tr>
                            <td class="no-padding no-border"><a class="img-common icon-edit icon-actions suggestion" data='<?php echo $value->id; ?>'></a></td>
                            <td class="no-padding no-border"><a class="img-common icon-remove icon-actions" data='<?php echo $value->id; ?>'></a></td>
                            <td><?php echo $value->identificacion; ?></td>
                            <td><?php echo $value->asegurado; ?></td>
                            <td><?php echo $value->placa; ?></td>
                            <td><?php echo $value->car_marca; ?></td>
                            <td><?php echo $value->car_modelo; ?></td>
                            <td><?php echo $value->car_version; ?></td>
                            <td><?php echo $value->car_ano; ?></td>
                            <td><?php echo $value->valor_INMA; ?></td>
                            <td><?php echo $validar->getTipoCarro($value->tipo_carro); ?></td>
                            <td><?php echo $value->car_ocupantes; ?></td>
                            <td><?php echo $validar->getCobertura($value->tipo_cobertura); ?></td>
                            <td><?php echo $value->edad; ?></td>
                            <td><?php echo $validar->getSexo($value->sexo); ?></td>
                            <td><?php echo $validar->getEstadoCivil($value->estado_civil); ?></td>
                          </tr>
                          <?php
                        }
                      }
                      ?>                   
                    </tbody>                    
                  </table>
                </div>
              </div>
              <div id="tabs-3" class="tabs-info">
                <div class="scrollable-list" style="width: 100%; overflow-y: auto;">
                  <table id="list-fleet" class="list-fleet" style="width: 100%">
                    <thead id="errors">
                    <th class="no-padding" style="width: 32px; background-color: #FFFFFF; padding-left: "></th>
                    <th class="no-padding" style="width: 32px; background-color: #FFFFFF;"></th>
                    <th>rif/ci</th>
                    <th>Asegurado</th>
                    <th>placa</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Versión</th>
                    <th>Año</th>
                    <th>inma</th>
                    <th>Uso</th>
                    <th>Ocupantes</th>
                    <th>Cobertura</th>
                    <th>Edad</th>
                    <th>Sexo</th>
                    <th>Edo. Civil</th>                                   
                    </thead>
                    <tbody>
                      <?php
                      $cotizacion_carros = $cotizacion_carro->find_by_id_cotizacion();
                      if (sizeof($cotizacion_carros) > 0) {
                        foreach ($cotizacion_carros as $value) {
                          $result = (($value->is_car_marca != 1) || ($value->is_car_modelo != 1) || ($value->is_car_ocupantes != 1) || ($value->is_edad != 1) || ($value->is_estado_civil != 1) || ($value->is_sexo != 1) || ($value->is_tipo_carros != 1) || ($value->is_tipo_cobertura != 1));
                          ?>
                          <tr class="<?php echo $result ? "text-error" : "" ?>">
                            <td class="no-padding no-border"><a class="img-common icon-edit icon-actions suggestion" data='<?php echo $value->id; ?>'></a></td>
                            <td class="no-padding no-border"><a class="img-common icon-remove icon-actions" data='<?php echo $value->id; ?>'></a></td>
                            <td><?php echo $value->identificacion; ?></td>
                            <td><?php echo $value->asegurado; ?></td>
                            <td><?php echo $value->placa; ?></td>
                            <td><?php echo $value->car_marca; ?></td>
                            <td><?php echo $value->car_modelo; ?></td>
                            <td><?php echo $value->car_version; ?></td>
                            <td><?php echo $value->car_ano; ?></td>
                            <td><?php echo $value->valor_INMA; ?></td>
                            <td><?php echo $validar->getTipoCarro($value->tipo_carro); ?></td>
                            <td><?php echo $value->car_ocupantes; ?></td>
                            <td><?php echo $validar->getCobertura($value->tipo_cobertura); ?></td>
                            <td><?php echo $value->edad; ?></td>
                            <td><?php echo $validar->getSexo($value->sexo); ?></td>
                            <td><?php echo $validar->getEstadoCivil($value->estado_civil); ?></td>
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
      </div>
      <div id="footer">
        <div id="nav-step">
          <ul>
            <li><input type="button" class="img-common icon-step icon-exit" onclick="Wizard.exit('cotizaciones.php')"></li>
            <li><a>Crear cotización</a></li>
            <li><span class="img-common arrow"></span></li>                      
            <li><a class='current-step' href="cargar-datos.php">Validar flota</a></li>
            <li><input type="button" class="img-common icon-step icon-end"></li>            
          </ul>
        </div>
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
