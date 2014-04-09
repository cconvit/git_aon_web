<?php
session_start();
require_once("../../php/db/config.php");
require_once ('../../php/db/database.php');
require_once ('../../php/entity/tasa_casco.php');

$datos=null;

if (isset($_REQUEST["id"])) {
    
    $tasa_casco=new tasa_casco();
    $tasa_casco->id_convenio_as=$_REQUEST["id"];
    $tasa_casco->id_tipo_co="2";
    $datos=$tasa_casco->find_by_convenio_tipo_seguro();
}
?>
<div class="view-content">
    <table style="width:470px; text-align: center">
        <thead>
            <tr>
                <th class="text-center">CLASIFICACION</th>
                <th>TIPO DE CARRO</th>
                <th>AÑO</th>
                <th>TASA</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($datos != null){
                $color=false;
                foreach ($datos as $value){
                    if($color)
                        echo '<tr class="grey">';
                    else
                        echo '<tr></tr>';
                    $color=!$color;
                    
                ?>
                    <td><?php echo $value->clasificacion; ?></td>
                    <td><?php echo $value->tipo_carro; ?></td>
                    <td class="text-center"><?php echo $value->ano; ?></td>
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