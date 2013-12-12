<?php

echo $_FILES['flota']['name'];
foreach ($_POST as $name => $value) {
  echo $name . ' : ' . $value . '<br />';
}
