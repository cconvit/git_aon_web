<?php
session_start();
require_once("../../php/db/config.php");
require_once ('../../php/db/database.php');
require_once ('../../php/entity/re_tipo_cobertura_aseguradora.php');
require_once ('../../php/entity/cobertura_aseguradora.php');
require_once ('../../php/entity/tipo_calculo.php');


if (isset($_SESSION["id_convenio_as"]) && isset($_REQUEST["id"])) {
  $re_tipo_cobertura_aseguradora = new re_tipo_cobertura_aseguradora();
  $re_tipo_cobertura_aseguradora->id_convenio_as = $_SESSION["id_convenio_as"];
  $re_tipo_cobertura_aseguradora->id_cob_as = $_REQUEST["id"];
  
  $aux = $re_tipo_cobertura_aseguradora->find_re_by_convenio_id_cobertura();
  $aux_tp = $re_tipo_cobertura_aseguradora->find_re_by_convenio_id_cobertura_group_by_tipo_carro();//Group by tipo carro
  $aux_tc = $re_tipo_cobertura_aseguradora->find_re_by_convenio_id_cobertura_group_by_tipo_cob();//Group by tipo seguro
  
  $cobertura_aseguradora = new cobertura_aseguradora();
  $cobertura_aseguradora->id=$_REQUEST["id"];
  $cobertura = $cobertura_aseguradora->find_by_id_cobertura();
  
  $tipo_calculo = new tipo_calculo();
  $calculos = $tipo_calculo->find_all();

}
  ?>
<div>
  <form id="add-cooverage" method="post" action="../php/operation/administration.php?operation_type=14&target=../../flota/cargar-condiciones.php" onsubmit="return checksSelected($(this))">
    <table align="center" width="360">
      <tbody>
        <tr>
          <td>Cobertura</td>
        </tr>
        <tr>
          <td><select readonly="readonly" name="cobertura" class="common-input common-select">
              <option selected value="<?php echo $cobertura[0]->id; ?>"><?php echo $cobertura[0]->desc_cobertura; ?></option>
              </select>
          </td>
        </tr>
        <tr>
          <td>Tipo de Cálculo</td>
        </tr>
        <tr>
          <td><select name="calculo" class="common-input common-select">
             <?php
                  if (sizeof($calculos) > 0) {
                    foreach ($calculos as $value) {
                      ?>
                      <option <?php echo $value->id==$aux[0]->tipo_calculo ? "selected":"";?> value="<?php echo $value->id; ?>"><?php echo utf8_encode($value->descripcion); ?></option>
                      <?php
                    }
                  }
                  ?>           
                </select>
          </td>
        </tr>
      <td>Limite</td>
      </tr>
      <tr>
        <td><input type="text" name="limite" class="common-input" value="<?php echo $aux[0]->limite;?>"></td>
      </tr>
      <tr>
        <td>Tasa</td>
      </tr>
      <tr>
        <td><input type="text" name="tasa" class="common-input" value="<?php echo $aux[0]->tasa;?>"></td>
      </tr>                          
      <tr>
        <td>
          <table>
            <tr>
              <td><div class="common-value">Particular</div></td>
              <td><div class="common-value text-center">Rustico</div></td>
              <td><div class="common-value text-center">Pickup/Van</div></td>
            </tr>
            <tr>
              <td><input type="text" name="particular" class="common-input common-value is-required" style="margin-right: 10px;" value="<?php foreach ($aux_tp as $tp) if($tp->id_tipo_carro == 1)echo $tp->valor; ?>"></td>
              <td><input type="text" name="rustico" class="common-input common-value is-required" style="margin-right: 10px;" value="<?php foreach ($aux_tp as $tp) if($tp->id_tipo_carro == 2)echo $tp->valor; ?>"></td>
              <td><input type="text" name="pickup" class="common-input common-value is-required" value="<?php foreach ($aux_tp as $tp) if($tp->id_tipo_carro == 3)echo $tp->valor; ?>"></td>
            </tr>                  
          </table>
        </td>
      </tr>
      <tr>
        <td style="padding-top: 12px;">Asociar a las siguientes coberturas:</td>
      </tr>
      <tr>
        <td>
          <ul id="check-list" style="margin-top: 7px;">
            <li>
                <input type="checkbox" name="cobertura_amplia" value="true" <?php foreach ($aux_tc as $tc) if($tc->id_tipo_cob == 1)echo "checked"; ?>>
              <label form="cobertura_amplia">Cobertura amplia</label></li>
            <li>
              <input type="checkbox" name="perdida_total" value="true" <?php foreach ($aux_tc as $tc) if($tc->id_tipo_cob == 2)echo "checked"; ?>>
              <label form="perdida_total">Pérdida total</label></li>
            <li>
              <input type="checkbox" name="rcv" value="true" <?php foreach ($aux_tc as $tc) if($tc->id_tipo_cob == 3)echo "checked"; ?>>
              <label form="rcv">RCV</label>
            </li>               
          </ul>
        </td>
      </tr>
      <tr>
        <td style="padding-top: 10px; padding-bottom: 10px">Aplica en las siguientes condiciones:</td>
      </tr>
      <tr>
        <td>
          <input type="checkbox" name="incluida" value="true" <?php echo $aux[0]->incluida==1 ? "checked":"";?>>
          <label form="rcv">Incluida sin costo</label>
        </td>
      </tr>
      <tr>
        <td style="padding-top: 10px;"><div class="required hide">Uno o más campos son inválidos.</div></td>
      </tr>
      </tbody>
      <tfoot>
        <tr>
          <td>
            <div class="buttons-panel">
              <input type="submit" class="img-common common-button" value="Guardar">
              <input type="button" class="img-common common-button" value="Salir" onclick="$('#modify').dialog('close');">
            </div>
          </td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>