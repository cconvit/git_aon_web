<?php header('Access-Control-Allow-Origin: *'); ?>  
<?php

$db = '(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 10.10.180.21)(PORT = 1521)))(CONNECT_DATA=(SID=AONVEPRO)))';
$c = OCILogon("SRV_INMA", "RjK7#e21zQ", $db);

$json = array();

switch ($_REQUEST['ot']) {
    case "1":
        $result = oci_parse($c, "SELECT CODVEHICULOMARCA as codigo, DESCVEHICULOMARCA as marca FROM SG_VEHICULOMARCA as marcas WHERE ESTADO = 'A' and CODVEHICULOMARCA <> 0 ORDER BY DESCVEHICULOMARCA ASC;");
        oci_execute($result);
        while ($row = oci_fetch_array($result)) {
            $array = array("codigo" => $row['codigo'], "marca" => $row['marca']);
            array_push($json, $array);
        }
        echo json_encode($json);
        break;
    case "2":
        $result = oci_parse($c, "SELECT CODVEHICULOGRUPOMODELO AS codigo, DESCVEHICULOGRUPOMODELO AS modelo FROM SG_VEHICULOGRUPOMODELO WHERE CODVEHICULOMARCA =  " . $_REQUEST['ma'] . " ORDER BY DESCVEHICULOGRUPOMODELO ASC;");
        oci_execute($result);
        while ($row = oci_fetch_array($result)) {
            $array = array("codigo" => $row['codigo'], "modelo" => $row['modelo']);
            array_push($json, $array);
        }
        echo json_encode($json);
        break;
    case "3":
        $result = oci_parse($c, "SELECT DISTINCT IDVEHICULO AS codigo, DESCVEHICULO AS version FROM SG_VEHICULO WHERE CODVEHICULOMARCA =  " . $_REQUEST['ma'] . " AND ESTADO =  'A' AND CODVEHICULOGRUPOMODELO =  " . $_REQUEST['mo'] . " ORDER BY DESCVEHICULO ASC");
        oci_execute($result);
        while ($row = oci_fetch_array($result)) {
            $array = array("codigo" => $row['codigo'], "version" => $row['version']);
            array_push($json, $array);
        }
        echo json_encode($json);
        break;
    case "4":
        $year = date("Y");
        $result = oci_parse($c, "SELECT * FROM SG_VEHICULOVALOR WHERE IDVEHICULO =" . $_REQUEST['co'] . "");
        oci_execute($result);
        $row = oci_fetch_array($result);
        for ($i = 1; $i < 33; $i++) {
            if ($row[$i] > 0) {
                $ano = $year - $i + 2;
                $array = array("inma" => $row[$i], "ano" => $ano);
                array_push($json, $array);
            }
        }
        echo json_encode($json);
        break;
}
?>