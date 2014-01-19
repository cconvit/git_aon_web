<div>
  <form id="add-cooverage" method="post" action="../php/operation/administration.php?operation_type=13&target=../../flota/cargar-condiciones.php" onsubmit="return checksSelected($(this))">
    <table align="center" width="360">
      <tbody>
        <tr>
          <td>Cobertura</td>
        </tr>
        <tr>
          <td><select name="cobertura" class="common-input common-select"></select>
          </td>
        </tr>
        <tr>
          <td>Tipo de Cálculo</td>
        </tr>
        <tr>
          <td><select name="calculo" class="common-input common-select"></select>
          </td>
        </tr>
      <td>Limite</td>
      </tr>
      <tr>
        <td><input type="text" name="limite" class="common-input"></td>
      </tr>
      <tr>
        <td>Tasa</td>
      </tr>
      <tr>
        <td><input type="text" name="tasa" class="common-input"></td>
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
              <td><input type="text" name="particular" class="common-input common-value is-required" style="margin-right: 10px;"></td>
              <td><input type="text" name="rustico" class="common-input common-value is-required" style="margin-right: 10px;"></td>
              <td><input type="text" name="pickup" class="common-input common-value is-required"></td>
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
              <input type="checkbox" name="cobertura_amplia" value="true">
              <label form="cobertura_amplia">Cobertura amplia</label></li>
            <li>
              <input type="checkbox" name="perdida_total" value="true">
              <label form="perdida_total">Pérdida total</label></li>
            <li>
              <input type="checkbox" name="rcv" value="true">
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
          <input type="checkbox" name="incluida" value="true">
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