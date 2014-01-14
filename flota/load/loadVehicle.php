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
              <ul id="marca" class="vehicle-suggestion-list" role="marca" data="unselected">
                <?php if ($carro->is_car_marca == 1) { ?>
                  <li data="1" role="selected"><span class="icon-mini icon-clear img-common icon-selected"></span><?php echo $carro->car_marca; ?></li>
                <?php } else { ?>
                  <li><span class="icon-mini icon-clear img-common icon-error"></span><?php echo $carro->car_marca; ?></li>
                <?php } ?>
                <li><input name="marca" type="hidden"></li>
              </ul>
            </td>
            <td>
              <ul id="modelo" class="vehicle-suggestion-list" role="modelo" data="unselected">
                <?php if ($carro->is_car_marca == 1) { ?>
                  <?php if ($carro->is_car_modelo == 1) { ?>
                    <li data="1" role="selected"><span class="icon-mini icon-clear img-common icon-selected"></span><?php echo $carro->car_modelo; ?></li>
                  <?php } else { ?>
                    <li data="1"><span class="icon-mini icon-clear img-common icon-error"></span><?php echo $carro->car_modelo; ?></li>
                  <?php } ?>
                <?php } else { ?>
                  <li>No hay modelos</li>
                <?php } ?>      
              </ul>
            </td>
            <td>
              <ul id="version" class="vehicle-suggestion-list" role="version" data="unselected">
                <?php if ($carro->is_car_marca == 1 && $carro->is_car_modelo == 1) { ?>
                  <li data="1" role="selected"><span class="icon-mini icon-clear img-common icon-selected"></span><?php echo $carro->car_version; ?></li>
                <?php } else { ?>
                  <li>No hay versiones</li>
                <?php } ?> 
              </ul>
            </td>
            <td>
              <ul id="ano" class="vehicle-suggestion-list" role="ano" data="unselected">
                <?php if ($carro->is_car_marca == 1 && $carro->is_car_modelo == 1) { ?>
                  <li data="1" role="selected"><span class="icon-mini icon-clear img-common icon-selected"></span><?php echo $carro->car_ano; ?></li>
                <?php } else { ?>
                  <li>No hay años</li>
                <?php } ?>
              </ul>
            </td>
            <td>
              <ul id="inma" class="vehicle-suggestion-list" role="inma" data="unselected">
                <?php if ($carro->is_car_marca == 1 && $carro->is_car_modelo == 1) { ?>
                  <li data="1" role="selected"><span class="icon-mini icon-clear img-common icon-selected"></span><?php echo $carro->valor_INMA; ?></li>
                <?php } else { ?>
                  <li>No hay inma</li>
                <?php } ?>
              </ul>
            </td>
            <td>
              <ul class="vehicle-suggestion-list" role="cobertura" data="<?php echo $carro->tipo_cobertura == "2" ? "selected" : "unselected" ?>">
                <?php if ($carro->is_tipo_carros != "1") { ?><li><span class="icon-mini icon-clear img-common icon-error"></span><?php echo $convertidor->getCobertura($carro->tipo_cobertura); ?></li><?php } ?>
                <li role="<?php echo $carro->tipo_cobertura == "2" ? "selected" : "unselected" ?>"><span class="icon-mini icon-clear<?php echo $carro->tipo_cobertura == "2" ? " img-common icon-selected" : "" ?>"></span>TOTAL</li>
                <li role="<?php echo $carro->tipo_cobertura == "1" ? "selected" : "unselected" ?>"><span class="icon-mini icon-clear<?php echo $carro->tipo_cobertura == "1" ? " img-common icon-selected" : "" ?>"></span>AMPLIA</li>
                <li role="<?php echo $carro->tipo_cobertura == "3" ? "selected" : "unselected" ?>"><span class="icon-mini icon-clear<?php echo $carro->tipo_cobertura == "3" ? " img-common icon-selected" : "" ?>"></span>RCV</li>
                <li><input name="cobertura" type="hidden" value="<?php echo $carro->tipo_cobertura; ?>"></li>
              </ul>
            </td>
            <td>
              <ul class="vehicle-suggestion-list" role="uso" data="<?php echo $carro->is_tipo_carros == "1" ? "selected" : "unselected" ?>">
                <?php if ($carro->is_tipo_carros != "1") { ?><li><span class="icon-mini icon-clear img-common icon-error"></span><?php echo $convertidor->getTipoCarro($carro->tipo_carro); ?></li><?php } ?>
                <li role="<?php echo $carro->tipo_carro == "1" ? "selected" : "unselected" ?>"><span class="icon-mini icon-clear<?php echo $carro->tipo_carro == "1" ? " img-common icon-selected" : "" ?>"></span>PARTICULAR</li>
                <li role="<?php echo $carro->tipo_carro == "2" ? "selected" : "unselected" ?>"><span class="icon-mini icon-clear<?php echo $carro->tipo_carro == "2" ? " img-common icon-selected" : "" ?>"></span>RÚSTICO</li>
                <li role="<?php echo $carro->tipo_carro == "3" ? "selected" : "unselected" ?>"><span class="icon-mini icon-clear<?php echo $carro->tipo_carro == "3" ? " img-common icon-selected" : "" ?>"></span>PICKUP/VAN</li>
                <li><input name="uso" type="hidden" value="<?php echo $carro->tipo_carro; ?>"></li>
              </ul>
            </td>
            <td>
              <ul class="vehicle-suggestion-list" role="ocupantes" data="<?php echo $carro->is_car_ocupantes == "1" ? "selected" : "unselected" ?>">
                <?php if ($carro->is_car_ocupantes != "1") { ?><li><span class="icon-mini icon-clear img-common icon-error"></span><?php echo $carro->car_ocupantes; ?></li><?php } ?>
                <li role="<?php echo $carro->car_ocupantes == "2" ? "selected" : "unselected" ?>"><span class="icon-mini icon-clear<?php echo $carro->car_ocupantes == "2" ? " img-common icon-selected" : "" ?>"></span>2</li>
                <li role="<?php echo $carro->car_ocupantes == "3" ? "selected" : "unselected" ?>"><span class="icon-mini icon-clear<?php echo $carro->car_ocupantes == "3" ? " img-common icon-selected" : "" ?>"></span>3</li>
                <li role="<?php echo $carro->car_ocupantes == "4" ? "selected" : "unselected" ?>"><span class="icon-mini icon-clear<?php echo $carro->car_ocupantes == "4" ? " img-common icon-selected" : "" ?>"></span>4</li>
                <li role="<?php echo $carro->car_ocupantes == "5" ? "selected" : "unselected" ?>"><span class="icon-mini icon-clear<?php echo $carro->car_ocupantes == "5" ? " img-common icon-selected" : "" ?>"></span>5</li>
                <li role="<?php echo $carro->car_ocupantes == "6" ? "selected" : "unselected" ?>"><span class="icon-mini icon-clear<?php echo $carro->car_ocupantes == "6" ? " img-common icon-selected" : "" ?>"></span>6</li>
                <li role="<?php echo $carro->car_ocupantes == "7" ? "selected" : "unselected" ?>"><span class="icon-mini icon-clear<?php echo $carro->car_ocupantes == "7" ? " img-common icon-selected" : "" ?>"></span>7</li>
                <li role="<?php echo $carro->car_ocupantes == "8" ? "selected" : "unselected" ?>"><span class="icon-mini icon-clear<?php echo $carro->car_ocupantes == "8" ? " img-common icon-selected" : "" ?>"></span>8</li>
                <li role="<?php echo $carro->car_ocupantes == "13" ? "selected" : "unselected" ?>"><span class="icon-mini icon-clear<?php echo $carro->car_ocupantes == "13" ? " img-common icon-selected" : "" ?>"></span>13</li>
                <li role="<?php echo $carro->car_ocupantes == "17" ? "selected" : "unselected" ?>"><span class="icon-mini icon-clear<?php echo $carro->car_ocupantes == "17" ? " img-common icon-selected" : "" ?>"></span>17</li>
                <li><input name="ocupantes" type="hidden" value="<?php echo $carro->car_ocupantes; ?>"></li>
              </ul>
            </td>
            <td>
              <ul class="vehicle-suggestion-list" role="edad" data="<?php echo $carro->is_edad == "1" ? "selected" : "unselected" ?>">
                <?php if ($carro->is_edad != "1") { ?><li><span class="icon-mini icon-clear img-common icon-error"></span><?php echo $carro->edad; ?></li><?php
                }
                for ($x = 18; $x < 95; $x++) {
                  ?>
                  <li role="<?php echo $carro->edad == $x ? "selected" : "unselected" ?>"><span class="icon-mini icon-clear<?php echo $carro->edad == $x ? " img-common icon-selected" : "" ?>"></span><?php echo $x; ?></li>
                  <?php
                }
                ?>
                <li><input name="edad" type="hidden" value="<?php echo $carro->edad; ?>"></li>
              </ul>
            </td>
            <td>
              <ul class="vehicle-suggestion-list" role="sexo" data="<?php echo $carro->is_sexo == "1" ? "selected" : "unselected" ?>">
                <?php if ($carro->is_sexo != "1") { ?><li><span class="icon-mini icon-clear img-common icon-error"></span><?php echo $carro->sexo; ?></li><?php } ?>
                <li role="<?php echo $carro->sexo == "1" ? "selected" : "unselected" ?>"><span class="icon-mini icon-clear<?php echo $carro->sexo == "1" ? " img-common icon-selected" : "" ?>"></span>FEMENINO</li>
                <li role="<?php echo $carro->sexo == "2" ? "selected" : "unselected" ?>"><span class="icon-mini icon-clear<?php echo $carro->sexo == "2" ? " img-common icon-selected" : "" ?>"></span>MASCULINO</li>
                <li><input name="sexo" type="hidden" value="<?php echo $carro->sexo; ?>"></li>
              </ul>
            </td>
            <td class="no-border">
              <ul class="vehicle-suggestion-list" role="sexo" data="<?php echo $carro->is_estado_civil == "1" ? "selected" : "unselected" ?>">
                <?php if ($carro->is_estado_civil != "1") { ?><li><span class="icon-mini icon-clear img-common icon-error"></span><?php echo $carro->estado_civil; ?></li><?php } ?>
                <li role="<?php echo $carro->estado_civil == "1" ? "selected" : "unselected" ?>"><span class="icon-mini icon-clear<?php echo $carro->estado_civil == "1" ? " img-common icon-selected" : "" ?>"></span>CASADO</li>
                <li role="<?php echo $carro->estado_civil == "2" ? "selected" : "unselected" ?>"><span class="icon-mini icon-clear<?php echo $carro->estado_civil == "2" ? " img-common icon-selected" : "" ?>"></span>SOLTERO</li>
                <li><input name="sexo" type="hidden" value="<?php echo $carro->estado_civil; ?>"></li>
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