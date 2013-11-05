<?php

require_once("../php/db/config.php");
	require_once ('../php/db/database.php');
	require_once ('../php/entity/cliente.php');
        
        $cliente=new cliente();
        
        $cliente->nombre="Alta2";
        $cliente->razon_social="Alta Sistema C.A.2";
        $cliente->estatus="1";
        $cliente->id="4";
        
        
        //$cliente->update_by_id();
        //$cliente->create();
        $cliente->delete();
        
        
?>
