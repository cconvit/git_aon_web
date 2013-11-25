<div>
  <form method="post" action="operation.php?operation_type=11" onsubmit="return isValidateSubmit($(this))">
    <table align="center" width="360">
      <tbody>
        <tr>
          <td>Nombre</td>
        </tr>
        <tr>
          <td><input type="text" class="common-input is-required" name="nombre" id="nombre"></td></td>
        </tr>
        <tr>
          <td>Descripción</td>
        </tr>
        <tr>
          <td><input type="text" class="common-input is-required" name="rs" id="rs"></td></td>
        </tr>
        <tr>
          <td>Seguro</td>
        </tr>
        <tr>
          <td>
            <select class="common-input" name="seguro">
              <option value="1">Mercantil</option>
              <option value="2">Caracas</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>Poliza</td>
        </tr>
        <tr>
          <td><input type="text" class="common-input is-required" name="rs" id="rs"></td></td>
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
              <input type="button" id="close-dialog" class="common-button" onclick="$('#new').dialog('close');" value="Salir" >
            </div>
          </td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>