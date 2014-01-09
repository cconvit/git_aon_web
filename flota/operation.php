<?php

foreach ($_POST as $name => $value) {
  echo $name . ' : ' . $value . '<br />';
}
echo "file: " . $_FILES['file']['name'];