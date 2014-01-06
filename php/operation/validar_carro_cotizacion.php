<?php

class validar_carro_cotizacion {

  public function validar_carro_cotizacion() {
    
  }

  public function processFile($path, $id_cotizacion) {

    $objPHPExcel = PHPExcel_IOFactory::load($path);

    foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {


      $highestRow = $worksheet->getHighestRow(); // e.g. 10
      $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
      $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
      $nrColumns = ord($highestColumn) - 64;
      return $this->validarRegistros($worksheet, $nrColumns, $highestRow, $highestColumnIndex, $id_cotizacion);
    }
  }

  function validarRegistros($worksheet, $nrColumns, $highestRow, $highestColumnIndex, $id_cotizacion) {

    require_once '../entity/inma.php';
    require_once '../entity/cotizacion_carro.php';

    $inma = new inma();
    $result = false;


    //Verificamos que el archivo tenga las columnas determinadas para esta importacion
    if (($nrColumns >= 14) && ($highestRow > 1)) {

      //Iteramos sobre las filas
      for ($row = 2; $row <= $highestRow; ++$row) {

        $marca = "";
        $carro = new cotizacion_carro();
        $carro->id_cotizacion = $id_cotizacion;

        //Iteramos sobre las columnas
        for ($col = 0; $col < 15; ++$col) {
          //Obtenemos la informacion de la celda
          $cell = $worksheet->getCellByColumnAndRow($col, $row);
          $val = $cell->getValue();
          $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);

          //Asignamos el valor de la celda en un array
          switch ($col) {
            case 0:
              $reg_valido = $this->isValidType("s", $dataType);
              $carro->identificacion = $val;
              break;
            case 1:
              $reg_valido = $this->isValidType("n", $dataType);
              $carro->asegurado = $val;
              break;
            case 2:
              $reg_valido = $this->isValidType("s", $dataType);
              $carro->placa = $val;
              break;
            case 3:
              $reg_valido = $this->isValidType("s", $dataType);
              $carro->car_marca = $val;
              $marca = $inma->isMarca($val);
              if ($marca != 0)
                $carro->is_car_marca = 1;
              else
                $carro->is_car_marca = 0;
              break;
            case 4:
              $reg_valido = $this->isValidType("s", $dataType);
              $carro->car_modelo = $val;

              if ($inma->isModelo($marca, $val))
                $carro->is_car_modelo = 1;
              else
                $carro->is_car_modelo = 0;
              break;
            case 5:
              $reg_valido = $this->isValidType("s", $dataType);
              $carro->car_version = $val;
              break;
            case 6:
              $reg_valido = $this->isValidType("n", $dataType);
              $carro->car_ano = $val;
              break;
            case 7:
              $reg_valido = $this->isValidType("n", $dataType);
              $carro->valor_INMA = $val;
              break;
            case 8:
              $reg_valido = $this->isValidType("s", $dataType);
              $carro->tipo_carro = $this->isTipoCarro($val);

              if ($carro->tipo_carro != 0)
                $carro->is_tipo_carros = 1;
              else
                $carro->is_tipo_carros = 0;
              break;
            case 9:
              $reg_valido = $this->isValidType("n", $dataType);
              $carro->car_ocupantes = $val;
              if ($this->isNumOcupantes($val))
                $carro->is_car_ocupantes = 1;
              else
                $carro->is_car_ocupantes = 0;
              break;

            case 10:
              $reg_valido = $this->isValidType("n", $dataType);
              $carro->tipo_cobertura = $this->isCobertura($val);
              if ($carro->tipo_cobertura != 0)
                $carro->is_tipo_cobertura = 1;
              else
                $carro->is_tipo_cobertura = 0;
              break;
            case 11:
              $reg_valido = $this->isValidType("n", $dataType);
              $carro->edad = $val;
              if ($reg_valido)
                $carro->is_edad = 1;
              else
                $carro->is_edad = 0;
              break;
            case 12:
              $reg_valido = $this->isValidType("s", $dataType);
              $carro->sexo = $this->isSexo($val);
              if ($carro->sexo != 0)
                $carro->is_sexo = 1;
              else
                $carro->is_sexo = 0;
              break;
            case 13:
              $reg_valido = $this->isValidType("s", $dataType);
              $carro->estado_civil = $this->isEstadoCivil($val);
              if ($carro->estado_civil != 0)
                $carro->is_estado_civil = 1;
              else
                $carro->is_estado_civil = 0;
              break;
          }//End switch
          //Verificamos si todos los datos estaban correctos
        }//End for COL
        if ($carro->identificacion != "")
          $carro->create();
      }//End for ROW
      //Si todos los registros estan correctos entonces procedemos a guardar en la base de datos
      $this->set_msg("La carga del archivo fue exitosa", "succesfull");
      $result = true;
    }//End IF
    else
      $this->set_msg("Error al importar el archivo. El archivo tiene datos errados para la importacion", "error");

    return $result;
  }

  public function isCobertura($cobertura) {

    switch ($cobertura) {

      case "TOTAL": return 2;
      case "AMPLIA": return 1;
      case "RCV": return 3;
      default : return 0;
    }
  }

  public function isSexo($sexo) {

    switch ($sexo) {

      case "M": return 2;
      case "F": return 1;
      default : return 0;
    }
  }

  public function isEstadoCivil($estado_civil) {

    switch ($estado_civil) {

      case "CASADO": return 1;
      default : return 2;
    }
  }

  public function isTipoCarro($tipo_carro) {

    switch ($tipo_carro) {

      case "PARTICULAR": return 1;
      case "RUSTICO": return 2;
      case "PICKUP": return 3;
      default : return 0;
    }
  }

  public function getCobertura($cobertura) {

    switch ($cobertura) {

      case 2: return "TOTAL";
      case 1: return "AMPLIA";
      case 3: return "RCV";
      default : return "";
    }
  }

  public function getSexo($sexo) {

    switch ($sexo) {

      case 2: return "M";
      case 1: return "F";
      default : return "";
    }
  }

  public function getEstadoCivil($estado_civil) {

    switch ($estado_civil) {

      case 1: return "CASADO";
      default : return "SOLTERO";
    }
  }

  public function getTipoCarro($tipo_carro) {

    switch ($tipo_carro) {

      case 1: return "PARTICULAR";
      case 2: return "RUSTICO";
      case 3: return "PICKUP";
      default : return "";
    }
  }

  public function isNumOcupantes($ocupantes) {

    if (2 <= $ocupantes && $ocupantes <= 17)
      return true;
    else
      return false;
  }

  function set_msg($msg_desc, $msg_type) {

    $_SESSION["msg"] = "show";

    $_SESSION["msg_desc"] = $msg_desc;
    $_SESSION["msg_type"] = $msg_type;
  }

  function isValidType($req_dataType, $dataType) {

    if ($dataType == $req_dataType)
      return true;
    else
      return false;
  }

}

?>