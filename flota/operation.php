<?php

$OT = $_REQUEST["operation_type"];

switch ($OT) {
  case "1":
    echo $_POST["nombre"] . "<br>" . $_POST["rs"];
}


