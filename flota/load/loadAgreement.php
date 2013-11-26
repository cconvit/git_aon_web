<?php
session_start();
require_once("../../php/db/config.php");
require_once ('../../php/db/database.php');
require_once ('../../php/entity/convenio_aseguradora.php');
require_once ('../../php/entity/aseguradora.php');

if (isset($_GET["id"])) {
  $convenio_aseguradora = new convenio_aseguradora();
  $convenio_aseguradora->id = $_REQUEST["id"];
  $convenio_aseguradora_aux = $convenio_aseguradora->find_by_id_convenio();

  $aseguradora =new aseguradora();
  $aseguradoras=$aseguradora->find_all();
 ?>

<div>
  <form method="post" action="../php/operation/administration.php?operation_type=11&target=../../flota/convenios.php&id=<?Php echo $convenio_aseguradora_aux[0]->id; ?>" onsubmit="return isValidateSubmit($(this))">
    <table align="center" width="360">
      <tbody>
        <tr>
          <td>Nombre</td>
        </tr>
        <tr>
          <td><input type="text" class="common-input is-required" name="nombre" value="<?php echo $convenio_aseguradora_aux[0]->descripcion; ?>"></td></td>
        </tr>
        <tr>
          <td>Seguro</td>
        </tr>
        <tr>
          <td>
            <select class="common-input" id="seguro" name="seguro" style="width: 370px">
             <?php
             
               if (sizeof($aseguradoras) > 0) {
                    foreach ($aseguradoras as $value) {
             ?>
              <option value="<?php echo $value->id; ?>"><?php echo $value->nombre; ?></option>
              <?php
                    }
               }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>Poliza</td>
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
              <input type="button" class="common-button" onclick="$('#modify').dialog('close');" value="Salir" >
            </div>
          </td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script>
document.getElementById('seguro').value="<?php echo $convenio_aseguradora_aux[0]->id_aseguradora;?>";
</script>
  <?php
} else {
  echo "";
}
?>