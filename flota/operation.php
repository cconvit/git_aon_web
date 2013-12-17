<?php

echo $_FILES['file']['name'];
foreach ($_POST as $name => $value) {
  echo $name . ' : ' . $value . '<br />';
}
