<?php

$uploaddir = '';
$uploadfile = $uploaddir . basename($_FILES['coverage']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['coverage']['tmp_name'], $uploadfile)) {
    echo "El archivo es válido y fue cargado exitosamente.\n";
} else {
    echo "¡Posible ataque de carga de archivos!\n";
}

echo 'Aquí hay más información de depurado:';
print_r($_FILES);

print "</pre>";

//foreach ($_REQUEST as $param_name => $param_val) {
//  echo "name: $param_name; value: $param_val<br />\n";
//}
?>

