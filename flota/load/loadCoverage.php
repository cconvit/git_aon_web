<div>   
  <form method="post" action="operation.php?operation_type=8">
    <table align="center" width="360">
      <tbody>
        <tr>
          <td>Nombre</td>
        </tr>
        <tr>
          <td><input type="text" class="common-input is-required" name="nombre" id="nombre" value="ALTA2"></td></td>
        </tr>
         <tr>
          <td>Descripción</td>
        </tr>
        <tr>
          <td><input type="text" class="common-input is-required" name="rs" id="rs" value="ALTA SISTEMA C.A.2"></td></td>
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