<?php

var_dump($_FILES["coverage"]["name"]);
$allowedExts = array("xls", "xlsx", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ((($_FILES["coverage"]["type"] == "application/xls")
|| ($_FILES["coverage"]["type"] == "application/x-xls")
|| ($_FILES["coverage"]["type"] == "application/x-dos_ms_excel")
|| ($_FILES["coverage"]["type"] == "application/x-excel")
|| ($_FILES["coverage"]["type"] == "application/x-ms-excel")
|| ($_FILES["coverage"]["type"] == "application/msexcel")
|| ($_FILES["coverage"]["type"] == "application/vnd.ms-excel")
|| ($_FILES["coverage"]["type"] == "application/x-msexcel"))
&& ($_FILES["coverage"]["size"] < 200000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["coverage"]["error"] > 0)
    {
    echo "Error: " . $_FILES["coverage"]["error"] . "<br>";
    }
  else
    {
    echo "Upload: " . $_FILES["coverage"]["name"] . "<br>";
    echo "Type: " . $_FILES["coverage"]["type"] . "<br>";
    echo "Size: " . ($_FILES["coverage"]["size"] / 1024) . " kB<br>";
    echo "Stored in: " . $_FILES["coverage"]["tmp_name"];
    }
  }
else
  {
  echo "Invalid file";
  }
/*
$path = $_REQUEST['coverage'];
include("../class/sql.php");
require '../class/PHPExcel.php';
require_once '../class/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load($path);
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
}
 * */
 
?>
