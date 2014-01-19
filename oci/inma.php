<?php header('Access-Control-Allow-Origin: *'); ?>  
<?php

$db = '(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 10.10.180.21)(PORT = 1521)))(CONNECT_DATA=(SID=AONVEPRO)))';
$c = OCILogon("SRV_INMA", "RjK7#e21zQ", $db);

switch ($_REQUEST['ot']) {
  case "1":
    $result = oci_parse($c, "SELECT DISTINCT M.CODVEHICULOMARCA, M.DESCVEHICULOMARCA FROM SG_VEHICULOMARCA M INNER JOIN SG_VEHICULO V ON M.CODVEHICULOMARCA=V.CODVEHICULOMARCA WHERE (V.CODVEHICULOTIPO = '001' OR V.CODVEHICULOTIPO = '002') AND V.ESTADO='A' ORDER BY M.DESCVEHICULOMARCA ASC");
    oci_execute($result);
    while ($row = oci_fetch_array($result)) {
      echo "<option value=" . $row[0] . ">" . $row[1] . "</option>";
    }
    break;
  case "2":
    $result = oci_parse($c, "SELECT CODVEHICULOGRUPOMODELO, DESCVEHICULOGRUPOMODELO FROM SG_VEHICULOGRUPOMODELO WHERE CODVEHICULOMARCA =  " . $_REQUEST['ma'] . " ORDER BY DESCVEHICULOGRUPOMODELO ASC");
    oci_execute($result);
    while ($row = oci_fetch_array($result)) {
      echo "<option value=" . $row[0] . ">" . $row[1] . "</option>";
    }
    break;
  case "3":
    $result = oci_parse($c, "SELECT IDVEHICULO, DESCVEHICULO FROM SG_VEHICULO WHERE CODVEHICULOMARCA =  " . $_REQUEST['ma'] . " AND ESTADO =  'A' AND CODVEHICULOGRUPOMODELO =  " . $_REQUEST['mo'] . " ORDER BY DESCVEHICULO ASC");
    oci_execute($result);
    while ($row = oci_fetch_array($result)) {
      echo "<option value=" . $row[0] . ">" . $row[1] . "</option>";
    }
    break;
  case "4":
    $year = date("Y");
    $result = oci_parse($c, "SELECT * FROM SG_VEHICULOVALOR WHERE IDVEHICULO =" . $_REQUEST['co'] . "");
    oci_execute($result);
    $row = oci_fetch_array($result);
    for ($i = 1; $i < 33; $i++) {
      if ($row[$i] > 0) {
        $ano = $year - $i + 2;
        echo "<option value=" . $row[$i] . ">" . $ano . "</option>" . "<br />";
      }
    }
    break;
}
?>