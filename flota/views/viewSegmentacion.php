<?php
session_start();
require_once("../../php/db/config.php");
require_once ('../../php/db/database.php');
require_once ('../../php/entity/segmentacion.php');

$datos=null;

if (isset($_REQUEST["id"])) {
    
    $segmentacion=new segmentacion();
    $segmentacion->id_convenio_as=$_REQUEST["id"];
    $datos=$segmentacion->find_by_convenio();
}
?>
<div class="view-content">
    <table style="width:470px; text-align: center">
        <thead>
            <tr>
                <th class="text-center">EDO. CIVIL</th>
                <th>SEXO</th>
                <th>EDAD</th>
                <th>TASA</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($datos != null){
                foreach ($datos as $value){
                ?>
                    <tr class="grey">
                    <td><?php echo $value->id_estado_civil; ?></td>
                    <td><?php echo $value->id_sexo; ?></td>
                    <td class="text-center"><?php echo $value->edad; ?></td>
                    <td class="text-center"><?php echo $value->tasa; ?></td>
                </tr>
               <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>
<div style="text-align: center">
    <input type="button" class="common-button img-common" value="Cerrar" style="margin: 20px auto 0px auto" onclick="$('#view').dialog('close');">
</div>