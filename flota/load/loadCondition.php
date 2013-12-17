<div>
  <form method="post" action="oeration.php" onsubmit="return isValidateSubmit($(this))">
    <table align="center" width="360">
      <tbody>
        <tr>
          <td>Cobertura</td>
        </tr>
        <tr>
          <td><select name="cobertura" class="common-input common-select"></select></td>
        </tr>
        <tr>
          <td>Tipo de Cálculo</td>
        </tr>
        <tr>
          <td><select name="calculo" class="common-input common-select"></select></td>
        </tr>
        <tr>
          <td>Particular</td>
        </tr>
        <tr>
          <td><input type="text" name="particular" class="common-input is-required"></td>
        </tr>
        <tr>
          <td>Rustico</td>
        </tr>
        <tr>
          <td><input type="text" name="rustico" class="common-input is-required"></td>
        </tr>
        <tr>
          <td>Pickup/Van</td>
        </tr>
        <tr>
          <td><input type="text" name="pickup" class="common-input is-required"></td>
        </tr>
        <tr>
          <td><div class="required hide">Uno o más campos son inválidos.</div></td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td>
            <div class="buttons-panel">
              <input type="submit" class="img-common common-button" value="Guardar">
              <input type="button" class="img-common common-button" value="Salir"onclick="$('#new').dialog('close')">
            </div>
          </td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>