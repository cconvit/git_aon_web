<?php
session_start();
require_once("../../php/db/config.php");
require_once ('../../php/db/database.php');
require_once ('../../php/entity/cotizacion_carro.php');
require_once ('../../php/operation/validar_carro_cotizacion.php');

if (isset($_REQUEST["id"])) {
  $cotizacion_carro = new cotizacion_carro();
  $cotizacion_carro->id = $_REQUEST["id"];
  $cotizacion_carro_aux = $cotizacion_carro->find_by_id_cotizacion_carro();
  $carro = $cotizacion_carro_aux[0];
  $convertidor = new validar_carro_cotizacion();

  //  Initiate curl
  $ch = curl_init();
  // Disable SSL verification
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  // Will return the response, if false it print the response
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  // Set the url
  curl_setopt($ch, CURLOPT_URL, "http://localhost/AON/git_aon_web/inma/json.php?ot=1");
  // Execute
  $result = curl_exec($ch);
  // Will dump a beauty json :3
  $marcas = json_decode($result, true);
  ?>
  <form action="operation.php" method="post">
    <div style="width: 870px; overflow-x: auto;">
      <table id="vehicle-suggestion">
        <thead>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Versión</th>
        <th>Año</th>
        <th>Inma</th>
        <th>Cobertura</th>
        <th>Uso</th>
        <th>Ocupantes</th>
        <th>Edad</th>
        <th>Sexo</th>
        <th class="no-border">Edo. Civil</th>
        </thead>
        <tbody>
          <tr>
            <td>
              <ul id="marca" class="vehicle-suggestion-list" role="marca" data="<?php echo $carro->is_car_marca == "1" ? "selected" : "unselected" ?>">
                <?php 
                $id_car="";
                if ($carro->is_car_marca != 1) { ?>
                  <li><span class="icon-mini icon-clear img-common icon-error"></span><?php echo $carro->car_marca; ?></li>
                  <?php
                }
                foreach ($marcas as $marca) {
                    if($carro->car_marca == $marca['marca'])$id_marca=$carro->car_marca;
                  ?>
                  <li data="<?php echo $carro->id;?>" <?php echo $carro->car_marca == $marca['marca'] ? "role='selected' tab-index='1'" : "" ?>><span class="icon-mini icon-clear<?php echo $carro->car_marca == $marca['marca'] ? " img-common icon-selected" : "" ?>"></span><?php echo $marca['marca']; ?></li>
                <?php } ?>
                <li><input name="marca" type="hidden" value="<?php echo $id_marca;?>"></li>
              </ul>
            </td>
            <td>
              <ul id="modelo" class="vehicle-suggestion-list" role="modelo" data="<?php echo (($carro->is_car_modelo == "1") || ($carro->is_car_marca == 1)) ? "selected" : "unselected" ?>">
                <?php if ($carro->is_car_marca == 1) { ?>
                  <?php if ($carro->is_car_modelo == 1) { 
                       $id_modelo=$carro->car_modelo;
                      ?>
                    <li data="<?php echo $carro->car_modelo; ?>" role="selected" tab-index='1'><span class="icon-mini icon-clear img-common icon-selected"></span><?php echo $carro->car_modelo; ?></li>
                  <?php } else { ?>
                    <li data="<?php echo $carro->car_modelo; ?>"><span class="icon-mini icon-clear img-common icon-error"></span><?php echo $carro->car_modelo; ?></li>
                  <?php } ?>
                <?php } else { ?>
                  <li>No hay modelos</li>
                <?php } ?>   
                <li><input name="modelo" type="hidden" value="<?php echo $id_modelo;?>"></li>
              </ul>
            </td>
            <td>
              <?php if ($carro->is_car_marca == 1 && $carro->is_car_modelo == 1) { 
                  $id_version=$carro->car_version;
                  ?>
                <ul id="version" class="vehicle-suggestion-list" role="version" data="selected">
                  <li data="<?php echo $carro->car_version; ?>" role="selected" tab-index='1'><span class="icon-mini icon-clear img-common icon-selected"></span><?php echo $carro->car_version; ?></li>
                <?php } else { ?>
                  <ul id="version" class="vehicle-suggestion-list" role="version">
                    <li>No hay versiones</li>
                  <?php } ?> 
                   <li><input name="version" type="hidden" value="<?php echo $id_version;?>"></li>
                </ul>
            </td>
            <td>
              <?php if ($carro->is_car_marca == 1 && $carro->is_car_modelo == 1) { 
                  $id_ano=$carro->car_ano;
                  ?>
                <ul id="ano" class="vehicle-suggestion-list" role="ano" data="selected">
                  <li data="<?php echo $carro->car_ano; ?>" role="selected" tab-index='1'><span class="icon-mini icon-clear img-common icon-selected"></span><?php echo $carro->car_ano; ?></li>
                <?php } else { ?>
                  <ul id="ano" class="vehicle-suggestion-list" role="ano">
                    <li>No hay años</li>
                  <?php } ?>
                 <li><input name="version" type="hidden" value="<?php echo $id_ano;?>"></li>
                </ul>
            </td>
            <td>
              
                <?php if ($carro->is_car_marca == 1 && $carro->is_car_modelo == 1) { 
                    $id_inma=$carro->valor_INMA;
                    ?>
                  <ul id="inma" class="vehicle-suggestion-list" role="inma" data="selected">
                  <li data="<?php echo $carro->valor_INMA; ?>" role="selected" tab-index='1'><span class="icon-mini icon-clear img-common icon-selected"></span><?php echo $carro->valor_INMA; ?></li>
                <?php } else { ?>
                  <ul id="inma" class="vehicle-suggestion-list" role="inma">
                  <li>No hay inma</li>
                <?php } ?>
                  <li><input name="inma" type="hidden" value="<?php echo $id_inma;?>"></li>
              </ul>
            </td>
            <td>
              <ul id="cobertura" class="vehicle-suggestion-list" role="cobertura" <?php echo $carro->is_tipo_cobertura == "1" ? "data='selected'" : "" ?>>
                <?php if ($carro->is_tipo_cobertura != "1") { ?><li><span class="icon-mini icon-clear img-common icon-error"></span><?php echo $convertidor->getCobertura($carro->tipo_cobertura); ?></li><?php } ?>
                <li data="2" <?php echo $carro->tipo_cobertura == "2" ? "role='selected' tab-index='1'" : "" ?>><span class="icon-mini icon-clear<?php echo $carro->tipo_cobertura == "2" ? " img-common icon-selected" : "" ?>"></span>TOTAL</li>
                <li data="1" <?php echo $carro->tipo_cobertura == "1" ? "role='selected' tab-index='1'" : "" ?>><span class="icon-mini icon-clear<?php echo $carro->tipo_cobertura == "1" ? " img-common icon-selected" : "" ?>"></span>AMPLIA</li>
                <li data="3" <?php echo $carro->tipo_cobertura == "3" ? "role='selected' tab-index='1'" : "" ?>><span class="icon-mini icon-clear<?php echo $carro->tipo_cobertura == "3" ? " img-common icon-selected" : "" ?>"></span>RCV</li>
                <li><input name="cobertura" type="hidden" value="<?php echo $carro->tipo_cobertura; ?>"></li>
              </ul>
            </td>
            <td>
              <ul class="vehicle-suggestion-list" role="uso" <?php echo $carro->is_tipo_carros == "1" ? "data='selected'" : "" ?>>
                <?php if ($carro->is_tipo_carros != "1") { ?><li><span class="icon-mini icon-clear img-common icon-error"></span><?php echo $convertidor->getTipoCarro($carro->tipo_carro); ?></li><?php } ?>
                <li data="1" <?php echo $carro->tipo_carro == "1" ? "role='selected' tab-index='1'" : "" ?>><span class="icon-mini icon-clear<?php echo $carro->tipo_carro == "1" ? " img-common icon-selected" : "" ?>"></span>PARTICULAR</li>
                <li data="2" <?php echo $carro->tipo_carro == "2" ? "role='selected' tab-index='1'" : "" ?>><span class="icon-mini icon-clear<?php echo $carro->tipo_carro == "2" ? " img-common icon-selected" : "" ?>"></span>RÚSTICO</li>
                <li data="3" <?php echo $carro->tipo_carro == "3" ? "role='selected' tab-index='1'" : "" ?>><span class="icon-mini icon-clear<?php echo $carro->tipo_carro == "3" ? " img-common icon-selected" : "" ?>"></span>PICKUP/VAN</li>
                <li><input name="uso" type="hidden" value="<?php echo $carro->tipo_carro; ?>"></li>
              </ul>
            </td>
            <td>
              <ul class="vehicle-suggestion-list" role="ocupantes" <?php echo $carro->is_car_ocupantes == "1" ? "data='selected'" : "" ?>>
                <?php if ($carro->is_car_ocupantes != "1") { ?><li><span class="icon-mini icon-clear img-common icon-error"></span><?php echo $carro->car_ocupantes; ?></li><?php } ?>
                <li data="2" <?php echo $carro->car_ocupantes == "2" ? "role='selected' tab-index='1'" : "" ?>><span class="icon-mini icon-clear<?php echo $carro->car_ocupantes == "2" ? " img-common icon-selected" : "" ?>"></span>2</li>
                <li data="3" <?php echo $carro->car_ocupantes == "3" ? "role='selected' tab-index='1'" : "" ?>><span class="icon-mini icon-clear<?php echo $carro->car_ocupantes == "3" ? " img-common icon-selected" : "" ?>"></span>3</li>
                <li data="4" <?php echo $carro->car_ocupantes == "4" ? "role='selected' tab-index='1'" : "" ?>><span class="icon-mini icon-clear<?php echo $carro->car_ocupantes == "4" ? " img-common icon-selected" : "" ?>"></span>4</li>
                <li data="5" <?php echo $carro->car_ocupantes == "5" ? "role='selected' tab-index='1'" : "" ?>><span class="icon-mini icon-clear<?php echo $carro->car_ocupantes == "5" ? " img-common icon-selected" : "" ?>"></span>5</li>
                <li data="6" <?php echo $carro->car_ocupantes == "6" ? "role='selected' tab-index='1'" : "" ?>><span class="icon-mini icon-clear<?php echo $carro->car_ocupantes == "6" ? " img-common icon-selected" : "" ?>"></span>6</li>
                <li data="7" <?php echo $carro->car_ocupantes == "7" ? "role='selected' tab-index='1'" : "" ?>><span class="icon-mini icon-clear<?php echo $carro->car_ocupantes == "7" ? " img-common icon-selected" : "" ?>"></span>7</li>
                <li data="8" <?php echo $carro->car_ocupantes == "8" ? "role='selected' tab-index='1'" : "" ?>><span class="icon-mini icon-clear<?php echo $carro->car_ocupantes == "8" ? " img-common icon-selected" : "" ?>"></span>8</li>
                <li data="13" <?php echo $carro->car_ocupantes == "13" ? "role='selected' tab-index='1'" : "" ?>><span class="icon-mini icon-clear<?php echo $carro->car_ocupantes == "13" ? " img-common icon-selected" : "" ?>"></span>13</li>
                <li data="17" <?php echo $carro->car_ocupantes == "17" ? "role='selected' tab-index='1'" : "" ?>><span class="icon-mini icon-clear<?php echo $carro->car_ocupantes == "17" ? " img-common icon-selected" : "" ?>"></span>17</li>
                <li><input name="ocupantes" type="hidden" value="<?php echo $carro->car_ocupantes; ?>"></li>
              </ul>
            </td>
            <td>
              <ul class="vehicle-suggestion-list" role="edad" <?php echo $carro->is_edad == "1" ? "data='selected'" : "" ?>>
                <?php if ($carro->is_edad != "1") { ?><li><span class="icon-mini icon-clear img-common icon-error"></span><?php echo "NO VÁLIDO"; ?></li><?php
                }
                for ($x = 18; $x < 95; $x++) {
                  ?>
                  <li data="<?php echo $x ?>" <?php echo $carro->edad == $x ? "role='selected' tab-index='1'" : "" ?>><span class="icon-mini icon-clear<?php echo $carro->edad == $x ? " img-common icon-selected" : "" ?>"></span><?php echo $x; ?></li>
                  <?php
                }
                ?>
                <li><input name="edad" type="hidden" value="<?php echo $carro->edad; ?>"></li>
              </ul>
            </td>
            <td>
              <ul class="vehicle-suggestion-list" role="sexo" <?php echo $carro->is_sexo == "1" ? "data='selected'" : "" ?>>
                <?php if ($carro->is_sexo != "1") { ?><li><span class="icon-mini icon-clear img-common icon-error"></span><?php echo $convertidor->getSexo($carro->sexo); ?></li><?php } ?>
                <li data="1" <?php echo $carro->sexo == "1" ? "role='selected' tab-index='1'" : "" ?>><span class="icon-mini icon-clear<?php echo $carro->sexo == "1" ? " img-common icon-selected" : "" ?>"></span>FEMENINO</li>
                <li data="2" <?php echo $carro->sexo == "2" ? "role='selected' tab-index='1'" : "" ?>><span class="icon-mini icon-clear<?php echo $carro->sexo == "2" ? " img-common icon-selected" : "" ?>"></span>MASCULINO</li>
                <li><input name="sexo" type="hidden" value="<?php echo $carro->sexo; ?>"></li>
              </ul>
            </td>
            <td class="no-border">
              <ul class="vehicle-suggestion-list" role="civil" <?php echo $carro->is_estado_civil == "1" ? "data='selected'" : "" ?>>
                <?php if ($carro->is_estado_civil != "1") { ?><li><span class="icon-mini icon-clear img-common icon-error"></span><?php echo $convertidor->getEstadoCivil($carro->estado_civil); ?></li><?php } ?>
                <li data="1" <?php echo $carro->estado_civil == "1" ? "role='selected' tab-index='1'" : "" ?>><span class="icon-mini icon-clear<?php echo $carro->estado_civil == "1" ? " img-common icon-selected" : "" ?>"></span>CASADO</li>
                <li data="2" <?php echo $carro->estado_civil == "2" ? "role='selected' tab-index='1'" : "" ?>><span class="icon-mini icon-clear<?php echo $carro->estado_civil == "2" ? " img-common icon-selected" : "" ?>"></span>SOLTERO</li>
                <li><input name="civil" type="hidden" value="<?php echo $carro->estado_civil; ?>"></li>
              </ul>
            </td>
          </tr>
        </tbody>
      </table>
      <input type="hidden" name="id">
    </div>
    <div class="buttons-panel" style="text-align: left">
      <br>
      <span style="display: inline-block">
        <div class="required hide">Uno o varios campos son invälidos.</div>
      </span>
      <div class="pull-rigth">
        <input type="submit" class="common-button img-common" value="Enviar">
        <input type="button" class="common-button img-common" value="Cancelar" onclick="$('#vehicle').dialog('close');">
      </div>
    </div>
  </form>
  <?php
} else {
  echo "Pepe";
}
?>
