<?php
session_start();
require_once("../../php/db/config.php");
require_once ('../../php/db/database.php');
require_once ('../../php/entity/aseguradora.php');

if (isset($_REQUEST["id"])) {
  $aseguradora = new aseguradora();
  $aseguradora->id = $_REQUEST["id"];
  $aseguradora_aux = $aseguradora->find_by_id_aseguradora();
  ?>
  <div>   
    <form method="post" action="../php/operation/administration.php?operation_type=5&target=../../flota/seguros.php&id=<?Php echo $aseguradora_aux[0]->id; ?>" onsubmit="return isValidateSubmit($(this))">
      <table align="center" width="360">
        <tbody>
          <tr>
            <td>Nombre</td>
          </tr>
          <tr>
            <td><input type="text" class="common-input is-required" name="nombre" value="<?php echo $aseguradora_aux[0]->nombre; ?>"></td></td>
          </tr>
          <tr>
            <td>Razón Social</td>
          </tr>
          <tr>
            <td><input type="text" class="common-input is-required" name="rs" value="<?php echo $aseguradora_aux[0]->razon_social; ?>"></td></td>
          </tr>
          <tr>
            <td><div class="required hide">Uno o más campos son inválidos.</div></td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td>    
              <div class="buttons-panel">
                <input type="submit" class="common-button" value="Modificar">
                <input type="button" class="common-button" onclick="$('#modify').dialog('close');" value="Salir" > 
              </div> 
            </td>
          </tr>
        </tfoot>
      </table>
    </form>
  </div>
  <?php
} else {
  echo "Pepe";
}
?>