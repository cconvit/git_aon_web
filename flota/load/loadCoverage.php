<?php
session_start();
require_once("../../php/db/config.php");
require_once ('../../php/db/database.php');
require_once ('../../php/entity/cobertura_aseguradora.php');

if (isset($_REQUEST["id"])) {
  $cobertura_aseguradora = new cobertura_aseguradora();
  $cobertura_aseguradora->id = $_REQUEST["id"];
  $cobertura_aseguradora_aux = $cobertura_aseguradora->find_by_id_cobertura();
  ?>
  <div>
<div>   
  <form method="post" action="../php/operation/administration.php?operation_type=8&target=../../flota/coberturas.php&id=<?Php echo $cobertura_aseguradora_aux[0]->id; ?>" onsubmit="return isValidateSubmit($(this))">
    <table align="center" width="360">
      <tbody>
        <tr>
          <td>Nombre</td>
        </tr>
        <tr>
          <td><input type="text" class="common-input is-required" name="nombre" value="<?php echo $cobertura_aseguradora_aux[0]->desc_cobertura; ?>"></td></td>
        </tr>
         <tr>
          <td>Descripción</td>
        </tr>
        <tr>
          <td><input type="text" class="common-input is-required" name="descripcion" value="<?php echo "";//$cobertura_aseguradora_aux[0]->desc_cobertura; ?>"></td></td>
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