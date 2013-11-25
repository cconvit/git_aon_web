<?php
session_start();
require_once("../../php/db/config.php");
require_once ('../../php/db/database.php');
require_once ('../../php/entity/cliente.php');

if (isset($_GET["id"])) {
  $cliente = new cliente();
  $cliente->id = $_GET["id"];
  $cliente_aux = $cliente->find_by_id_cliente();
  ?>
  <div>   
    <form method="post" action="../php/operation/administration.php?operation_type=2&target=../../flota/clientes.php&id_item=<?Php echo $cliente_aux[0]->id; ?>">
      <table align="center" width="360">
        <tbody>
          <tr>
            <td>Nombre</td>
          </tr>
          <tr>
            <td><input type="text" class="common-input is-required" name="nombre" id="nombre" value="<?php echo $cliente_aux[0]->nombre; ?>"></td>
          </tr>
          <tr>
            <td>Razón Social</td>
          </tr>
          <tr>
            <td><input type="text" class="common-input is-required" name="rs" id="rs" value="<?php echo $cliente_aux[0]->razon_social; ?>"></td>
          </tr>
          <tr>
            <td><div class="error hide">Uno o más campos son inválidos.</div></td>
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
  echo "";
}
?>