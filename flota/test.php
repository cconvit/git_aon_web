<?php

require_once("../php/db/config.php");
require_once ('../php/db/database.php');

//     Metodo para administrar una flota
require_once ('../php/entity/convenio_aseguradora.php');
$convenio_aseguradora = new convenio_aseguradora();
$convenio_aseguradora->id_aseguradora = "9";
$convenio_aseguradora->descripcion = "Pepetrueno";
$convenio_aseguradora->id = "13";
//$convenio_aseguradora->create();
$convenio_aseguradora->delete();


/*     Metodo para administrar una flota
  require_once ('../php/entity/re_flota_co_as.php');
  $re_flota_co_as=new re_flota_co_as();
  $re_flota_co_as->id_flota="2";
  $re_flota_co_as->id_aseguradora="9";
  $re_flota_co_as->id_convenio_as="9";

  $re_flota_co_as->create();
  $re_flota_co_as->delete();
 */



/*      Metodo para administrar una flota
  require_once ('../php/entity/flota.php');
  $flota=new flota();
  $flota->empresa="Alta4";
  $flota->porcentaje_INMA="0.05";
  $flota->avatar="logo4.png";
  $flota->id="3";

  //$flota->update_by_id();
  //$flota->create();
  //echo $flota->id;
  $flota->delete();
 */

/*      Metodo para administrar una aseguradora
  require_once ('../php/entity/aseguradora.php');
  $aseguradora=new aseguradora();
  $aseguradora->nombre="Alta3";
  $aseguradora->razon_social="Alta Sistema C.A.3";
  $aseguradora->logo_img="logo3.png";
  $aseguradora->id="11";

  $aseguradora->update_by_id();
  $aseguradora->create();
  $aseguradora->delete();
 */

/* Metodo para cliente
  require_once ('../php/entity/cliente.php');
  $cliente=new cliente();
  $cliente->nombre="Alta2";
  $cliente->razon_social="Alta Sistema C.A.2";
  $cliente->estatus="1";
  $cliente->id="4";
  //$cliente->update_by_id();
  //$cliente->create();
  $cliente->delete();
 */
?>
