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

function formatMoney($number, $fractional=false) { 
    if ($fractional) { 
        $number = sprintf('%.2f', $number); 
    } 
    while (true) { 
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1%$2', $number); 
        if ($replaced != $number) { 
            $number = $replaced; 
        } else { 
            break; 
        } 
    } 
    
    $number=str_replace(".",",",$number);
    $number=str_replace("%",".",$number);
    return $number; 
} 
?>
