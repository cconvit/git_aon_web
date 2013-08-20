<?php

function get_data_aseguradora($id_aseguradora){
    $datos=array();
    switch($id_aseguradora){
                                                    
        case 1:
            $id="mercantil";
            $name="mercantil";
            break;

        case 2:
            $id="banesco";
            $name="banesco seguros";
            break;

        case 3:
            $id="zurich";
            $name="zurich";
            break;

        case 4:
            $id="venezolana";
            $name="venezolana";
            break;

        case 5:
            $id="vitalica";
            $name="seguros la vitalica";
            break;

        case 6:
            $id="caracas";
            $name="seguros caracas";
            break;

        case 7:
            $id="canarias";
            $name="seguros canarias";
            break;

        case 8:
            $id="estar";
            $name="estar seguros";
            break;

        case 9:
            $id="altamira";
            $name="seguros altamira";
            break;

    }
    
    $datos["id"]=$id;
    $datos["name"]=$name;
    
    return $datos;
}
?>
