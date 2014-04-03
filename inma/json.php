<?php header('Access-Control-Allow-Origin: *'); ?>  
<?php
mysql_connect("localhost", "inma", "123456");
mysql_select_db("inma");
$json = array();

switch ($_REQUEST['ot']) {
    case "1":
        $result = mysql_query("SELECT CODVEHICULOMARCA as codigo, DESCVEHICULOMARCA as marca FROM SG_VEHICULOMARCA as marcas WHERE ESTADO = 'A' and CODVEHICULOMARCA <> 0 ORDER BY DESCVEHICULOMARCA ASC;");
        while ($row = mysql_fetch_array($result)) {
            $array = array("codigo" => $row['codigo'], "marca" => $row['marca']);
            array_push($json, $array);
        }
        echo json_encode($json);
        break;
    case "2":
        $result = mysql_query("SELECT CODVEHICULOGRUPOMODELO AS codigo, DESCVEHICULOGRUPOMODELO AS modelo FROM SG_VEHICULOGRUPOMODELO WHERE CODVEHICULOMARCA =  " . $_REQUEST['ma'] . " ORDER BY DESCVEHICULOGRUPOMODELO ASC;");
        while ($row = mysql_fetch_array($result)) {
            $array = array("codigo" => $row['codigo'], "modelo" => $row['modelo']);
            array_push($json, $array);
        }
        echo json_encode($json);
        break;
    case "3":
        $result = mysql_query("SELECT DISTINCT IDVEHICULO AS codigo, DESCVEHICULO AS version FROM SG_VEHICULO WHERE CODVEHICULOMARCA =  " . $_REQUEST['ma'] . " AND ESTADO =  'A' AND CODVEHICULOGRUPOMODELO =  " . $_REQUEST['mo'] . " ORDER BY DESCVEHICULO ASC");
        while ($row = mysql_fetch_array($result)) {
            $array = array("codigo" => $row['codigo'], "version" => $row['version']);
            array_push($json, $array);
        }
        echo json_encode($json);
        break;
    case "4":
        $year = date("Y");
        $result = mysql_query("SELECT * FROM SG_VEHICULOVALOR WHERE IDVEHICULO =" . $_REQUEST['co'] . "");
        $row = mysql_fetch_array($result);
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
