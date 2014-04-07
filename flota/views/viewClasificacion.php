<?php
session_start();
require_once("../../php/db/config.php");
require_once ('../../php/db/database.php');
require_once ('../../php/entity/clasificacion.php');

$datos=null;

if (isset($_REQUEST["id"])) {
    
    $clasificacion=new clasificacion();
    $clasificacion->convenio=$_REQUEST["id"];
    $datos=$clasificacion->find_by_convenio();
}
?>
<div class="view-content">
    <table style="width:470px;">
        <thead>
            <tr>
                <th style="text-align: left">MARCA</th>
                <th style="text-align: left">MODELO</th>
                <th style="text-align: left">CLASIFICACION</th>
                <th style="text-align: left">TIPO DE CARRO</th>
            </tr>
        <tbody>
            <?php
            if($datos != null){
                foreach ($datos as $value){
                ?>
                    <tr class="grey">
                    <td><?php echo $value->marca; ?></td>
                    <td><?php echo $value->modelo; ?></td>
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