<?php
session_start();
require_once("../../php/db/config.php");
require_once ('../../php/db/database.php');
require_once ('../../php/entity/convenio_aseguradora.php');

$convenio_aseguradora = new convenio_aseguradora();
$convenios_aseguradoras = $convenio_aseguradora->find_all();
?>
<div id="agreements-list">
  <table class="tbl-details tbl-check-list" cellspacin="0" borderspacing="0">
    <tbody>
      <?php
      if (sizeof($convenios_aseguradoras) > 0) {
        foreach ($convenios_aseguradoras as $value) {
          ?> 
          <tr>
            <td>
              <div class="list-checks">
                <div class="img-common checkbox" is-checked="false" data="<?php echo $value->id; ?>"></div>
                <div class="info-check">
                  <p class="title-list"><?php echo $value->as_nombre; ?></p>
                  <p class="subtitle-list"><?php echo $value->descripcion; ?></p>   
                </div>
              </div>
              <div class="separator"></div>
            </td>
          </tr>
          <?php
        }
      }
      ?>       
    </tbody>
  </table>
</div>
<form action="../php/operation/administration.php?operation_type=19&target=../../flota/cargar-convenios.php" method="post" onsubmit="return URLSendAgreements();">
  <div class="buttons-panel" style="margin-top: 20px;">
    <input type="submit" class="img-common common-button" value="Aplicar" onclick="return URLSendAgreements()">
    <input type="button" class="img-common common-button" value="Salir" onclick="$('#load').dialog('close');">
    <input type="hidden" name="data" value="">
  </div>
</form>