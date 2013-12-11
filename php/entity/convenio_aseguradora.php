<?php

class convenio_aseguradora {

  protected static $table_name = "tbl_convenio_aseguradora";
  protected static $db_fields = array('id', 'id_aseguradora', 'nombre', 'descripcion', 'num_poliza', 'as_nombre', 'ut_time', 'cr_time');
  public $id;
  public $id_aseguradora;
  public $nombre;
  public $descripcion;
  public $num_poliza;
  public $as_nombre;
  public $ut_time;
  public $cr_time;

  public function convenio_aseguradora() {
    
  }

// Common Database Methods
  public static function find_all() {
    return self::find_by_sql("SELECT ca.id,ca.id_aseguradora,ca.nombre,ca.descripcion,ca.num_poliza,a.nombre as 'as_nombre',ca.cr_time as 'cr_time',ca.ut_time as 'ut_time' FROM `tbl_convenio_aseguradora` ca INNER JOIN tbl_aseguradora a ON ca.id_aseguradora=a.id");
  }

  public static function find_by_sql($sql = "") {

    global $database;
    $result_set = $database->query($sql);
    $object_array = array();
    while ($row = $database->fetch_array($result_set)) {
      $object_array[] = self::instantiate($row);
    }
    return $object_array;
  }

  public function find_by_id_convenio() {

    global $database;

    return self::find_by_sql("SELECT ca.id,ca.id_aseguradora,ca.nombre,ca.descripcion,ca.num_poliza,a.nombre as 'as_nombre',ca.cr_time as 'cr_time',ca.ut_time as 'ut_time' FROM `tbl_convenio_aseguradora` ca INNER JOIN tbl_aseguradora a ON ca.id_aseguradora=a.id
             WHERE ca.id='{$database->escape_value($this->id)}'");
  }

  public function create() {

    global $database;

    $sql = "INSERT INTO " . self::$table_name . " (id_aseguradora,nombre,descripcion,num_poliza,cr_time) VALUES (
'{$database->escape_value($this->id_aseguradora)}',
'{$database->escape_value($this->nombre)}',
'{$database->escape_value($this->descripcion)}',
'{$database->escape_value($this->num_poliza)}',
NOW())";


    if ($database->query($sql)) {
      $this->id = $database->insert_id();
      return true;
    } else {
      return false;
    }
  }

  public function update_by_id() {

    global $database;

    $sql = "UPDATE " . self::$table_name . " SET
  nombre='{$database->escape_value($this->nombre)}',
  descripcion='{$database->escape_value($this->descripcion)}',
  num_poliza='{$database->escape_value($this->num_poliza)}',
  id_aseguradora='{$database->escape_value($this->id_aseguradora)}'
  WHERE id='{$database->escape_value($this->id)}'";



    if ($database->query($sql)) {

      if (mysql_affected_rows() != 0) {
        $this->id_user = $database->insert_id();
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  public function delete() {

    global $database;

    $sql = "DELETE FROM " . self::$table_name . "
WHERE id='{$database->escape_value($this->id)}'";



    if ($database->query($sql)) {
      if (mysql_affected_rows() != 0)
        return true;
      else
        return false;
    } else {
      return false;
    }
  }

///////////////////////////METODOS ESTANDAR//////////////////////////////////

  private static function instantiate($record) {
// Could check that $record exists and is an array
    $object = new self;
// Simple, long-form approach:
// $object->id 				= $record['id'];
// $object->username 	= $record['username'];
// $object->password 	= $record['password'];
// $object->first_name = $record['first_name'];
// $object->last_name 	= $record['last_name'];
// More dynamic, short-form approach:
    foreach ($record as $attribute => $value) {
      if ($object->has_attribute($attribute)) {
        $object->$attribute = $value;
      }
    }
    return $object;
  }

  private function has_attribute($attribute) {
// We don't care about the value, we just want to know if the key exists
// Will return true or false
    return array_key_exists($attribute, $this->attributes());
  }

  protected function attributes() {
// return an array of attribute names and their values
    $attributes = array();
    foreach (self::$db_fields as $field) {
      if (property_exists($this, $field)) {
        $attributes[$field] = $this->$field;
      }
    }
    return $attributes;
  }

  protected function sanitized_attributes() {
    global $database;
    $clean_attributes = array();
// sanitize the values before submitting
// Note: does not alter the actual value of each attribute
    foreach ($this->attributes() as $key => $value) {
      $clean_attributes[$key] = $database->escape_value($value);
    }
    return $clean_attributes;
  }

///////////////////////////FIN METODOS ESTANDAR//////////////////////////////
}

?>
