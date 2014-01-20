<?php

function get_data_aseguradora($id_aseguradora) {
  $datos = array();
  switch ($id_aseguradora) {

    case 1:
      $id = "mercantil";
      $name = "Mercantil";
      break;

    case 2:
      $id = "banesco";
      $name = "Banesco Seguros";
      break;

    case 3:
      $id = "zurich";
      $name = "Zurich";
      break;

    case 4:
      $id = "venezolana";
      $name = "Venezolana";
      break;

    case 5:
      $id = "vitalicia";
      $name = "Seguros la Vitalica";
      break;

    case 6:
      $id = "caracas";
      $name = "Seguros Caracas";
      break;

    case 7:
      $id = "canarias";
      $name = "Seguros Canarias";
      break;

    case 8:
      $id = "estar";
      $name = "Estar Seguros";
      break;

    case 9:
      $id = "altamira";
      $name = "Seguros Altamira";
      break;

    case 10:
      $id = "multinacional";
      $name = "Multinacional de Seguros";
      break;
  }

  $datos["id"] = $id;
  $datos["name"] = $name;

  return $datos;
}

function formatMoney($number, $fractional = false) {
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

  $number = str_replace(".", ",", $number);
  $number = str_replace("%", ".", $number);
  return $number;
}

?>
