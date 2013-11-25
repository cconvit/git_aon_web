<div>
  <form method="post" action="operation.php?operation_type=11" onsubmit="return isValidateSubmit($(this))">
    <table align="center" width="360">
      <tbody>
        <tr>
          <td>Nombre</td>
        </tr>
        <tr>
          <td><input type="text" class="common-input is-required" name="nombre"></td></td>
        </tr>
        <tr>
          <td>Seguro</td>
        </tr>
        <tr>
          <td>
            <select class="common-input" name="seguro" style="width: 370px">
              <option value="1">Mercantil</option>
              <option value="2">Caracas</option>
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