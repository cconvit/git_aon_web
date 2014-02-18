<?php

class inma {

  public function inma() {

    mysql_connect("localhost", "root", "");
    mysql_select_db("inma");
  }

  public function isMarca($marca) {

    $result = mysql_query("SELECT CODVEHICULOMARCA as codigo, DESCVEHICULOMARCA as marca FROM SG_VEHICULOMARCA as marcas WHERE ESTADO = 'A' and CODVEHICULOMARCA <> 0 and DESCVEHICULOMARCA='" . mysql_real_escape_string($marca) . "' ORDER BY DESCVEHICULOMARCA ASC LIMIT 1;");

    if (mysql_affected_rows() != 0) {
      while ($row = mysql_fetch_array($result))
        return $row['codigo'];
    } else
      return 0;
  }

  public function isModelo($marca, $modelo) {

    mysql_query("SELECT CODVEHICULOGRUPOMODELO AS codigo, DESCVEHICULOGRUPOMODELO AS modelo FROM SG_VEHICULOGRUPOMODELO WHERE CODVEHICULOMARCA =  '" . mysql_real_escape_string($marca) . "' AND DESCVEHICULOGRUPOMODELO='" . mysql_real_escape_string($modelo) . "' ORDER BY DESCVEHICULOGRUPOMODELO ASC LIMIT 1;");

    if (mysql_affected_rows() != 0)
      return true;
    else
      return false;
  }

}

?>