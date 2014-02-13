<?php

class re_flota_co_as {

  protected static $table_name = "tbl_re_flota_co_as";
  protected static $db_fields = array('id_flota', 'id_aseguradora', 'id_convenio_as');
  public $id_flota;
  public $id_aseguradora;
  public $id_convenio_as;

  public function re_flota_co_as() {
    
  }

  // Common Database Methods
  public static function find_all() {
    return self::find_by_sql("SELECT * FROM " . self::$table_name);
  }

  public  function find_by_id() {
    global $database;
    return self::find_by_sql("SELECT * FROM " . self::$table_name." WHERE id_flota='{$database->escape_value($this->id_flota)}'");
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

  public function create() {

    global $database;

    $sql = "INSERT INTO " . self::$table_name . " (id_flota,id_aseguradora,id_convenio_as) 
                            SELECT '{$database->escape_value($this->id_flota)}',
                                     co.id_aseguradora,'{$database->escape_value($this->id_convenio_as)}' FROM tbl_convenio_aseguradora co WHERE co.id='{$database->escape_value($this->id_convenio_as)}'
                            ";

    if ($database->query($sql)) {

      return true;
    } else {
      return false;
    }
  }

  public function delete() {

    global $database;

    $sql = "DELETE FROM " . self::$table_name . "
                                  WHERE id_flota='{$database->escape_value($this->id_flota)}'
                                  AND id_aseguradora='{$database->escape_value($this->id_aseguradora)}'";



    if ($database->query($sql)) {
      if (mysql_affected_rows() != 0)
        return true;
      else
        return false;
    } else {
      return false;
    }
  }
  
   public function delete_by_flota_convenio() {

    global $database;

    $sql = "DELETE FROM " . self::$table_name . "
                                  WHERE id_flota='{$database->escape_value($this->id_flota)}'
                                  AND id_convenio_as='{$database->escape_value($this->id_convenio_as)}'";



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