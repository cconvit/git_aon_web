<?php		mysql_connect("localhost","root","");	mysql_select_db("inma");		switch ($_REQUEST['ot']){		case "1":			$result= mysql_query("SELECT CODVEHICULOMARCA as codigo, DESCVEHICULOMARCA as marca FROM SG_VEHICULOMARCA as marcas WHERE ESTADO = 'A' and CODVEHICULOMARCA <> 0 ORDER BY DESCVEHICULOMARCA ASC;");			while($row=mysql_fetch_array($result))			{				echo "<option value=" . $row['codigo'] . ">" . $row['marca'] . "</option>";			}		break;		case "2":			$result= mysql_query("SELECT CODVEHICULOGRUPOMODELO AS codigo, DESCVEHICULOGRUPOMODELO AS modelo FROM SG_VEHICULOGRUPOMODELO WHERE CODVEHICULOMARCA =  " . $_REQUEST['ma'] . "");			while($row=mysql_fetch_array($result))			{				echo "<option value=" . $row['codigo'] . ">" . $row['modelo'] . "</option>";			}		break;		case "3":			$result=mysql_query("SELECT IDVEHICULO AS codigo, DESCVEHICULO AS version FROM SG_VEHICULO WHERE CODVEHICULOMARCA =  " . $_REQUEST['ma'] . " AND ESTADO =  'A' AND CODVEHICULOGRUPOMODELO =  " . $_REQUEST['mo'] . " ORDER BY DESCVEHICULO ASC");			while($row=mysql_fetch_array($result))			{ 				echo "<option value=" . $row['codigo'] . ">" . $row['version'] . "</option>";			}		break;			case "4":			$year = date("Y");			$result=mysql_query("SELECT * FROM SG_VEHICULOVALOR WHERE IDVEHICULO =" . $_REQUEST['co'] . "");			$row=mysql_fetch_array($result);			for($i=1;$i<33;$i++)			{					if($row[$i] > 0)				{					$ano = $year-$i + 2;					echo "<option value=" . $row[$i] . ">" . $ano ."</option>" . "<br />";				}			}		break;	} ?>