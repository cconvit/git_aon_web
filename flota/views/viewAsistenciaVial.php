<?php
session_start();
require_once("../../php/db/config.php");
require_once ('../../php/db/database.php');
require_once ('../../php/entity/grua.php');

$datos=null;

if (isset($_REQUEST["id"])) {
    
    $grua=new grua();
    $grua->id_convenio_aseguradora=$_REQUEST["id"];
    $datos=$grua->find_by_convenio();
}
?>
<div class="view-content">
    <table style="width:470px; text-align: center">
        <thead>
            <tr>
                <th class="text-center">TIPO DE CARRO</th>
                <th>AÑ0</th>
                <th>VALOR</th>
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
                    <td><?php echo $value->id_tipo_carro; ?></td>
                    <td><?php echo $value->ano; ?></td>
                    <td class="text-center"><?php echo $value->valor; ?></td>
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