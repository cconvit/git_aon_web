<?php
session_start();
require_once("../../php/db/config.php");
require_once ('../../php/db/database.php');
require_once ('../../php/entity/clasificacion_ma.php');

$datos=null;

if (isset($_REQUEST["id"])) {
    
    $clasificacion_ma=new clasificacion_ma();
    $clasificacion_ma->id_convenio_as=$_REQUEST["id"];
    $datos=$clasificacion_ma->find_by_convenio();
}
?>
<div class="view-content">
    <table style="width:470px;">
        <thead>
            <tr>
                <th style="text-align: left">MONTO MÍNIMO</th>
                <th style="text-align: left">MONTO MÁXIMO</th>
                <th style="text-align: left">CLASIFICACION</th>
                <th style="text-align: left">TIPO DE CARRO</th>
            </tr>
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
                    <td><?php echo $value->monto_min; ?></td>
                    <td><?php echo $value->monto_max; ?></td>
                    <td class="text-center"><?php echo $value->clasificacion; ?></td>
                    <td class="text-center"><?php echo $value->tipo_carro; ?></td>
                </tr>
               <?php
                }
            }
            ?>
        </tbody>
        </thead>
    </table>
</div>
<div style="text-align: center">
    <input type="button" class="common-button img-common" value="Cerrar" style="margin: 20px auto 0px auto" onclick="$('#view').dialog('close');">
</div>