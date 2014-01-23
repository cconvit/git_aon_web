<?php

class descarga_cotizacion{
    
    protected static $table_name="tbl_descarga_cotizacion";
    protected static $db_fields=array('id_cotizacion','nombre','seguro','link','ut_time');
    
    public $id_cotizacion;
    public $nombre;
    public $seguro;
    public $link;
    public $ut_time;

   
    
  public function descarga_cotizacion (){
      
      
  }
            
  // Common Database Methods

  public function find_by_id() {
      global $database;
      
    return self::find_by_sql("SELECT * FROM " . self::$table_name .
                             " WHERE id_cotizacion='{$database->escape_value($this->id_cotizacion)}'");
  }
  
  public static function find_by_sql($sql="") {
    
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

    $sql = "INSERT INTO " . self::$table_name . " (id_cotizacion,nombre,seguro,link) VALUES (
                                                '{$database->escape_value($this->id_cotizacion)}',
                                                '{$database->escape_value($this->nombre)}',
                                                '{$database->escape_value($this->seguro)}',
                                                '{$database->escape_value($this->link)}'
                                                 )";


    if ($database->query($sql)) {
      $this->id = $database->insert_id();
      return true;
    } else {
      return false;
    }
  }
  
  public function delete() {

    global $database;

    $sql = "DELETE FROM " . self::$table_name . " WHERE id_cotizacion='{$database->escape_value($this->id_cotizacion)}'";

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
        foreach($record as $attribute=>$value){
          if($object->has_attribute($attribute)) {
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
      foreach(self::$db_fields as $field) {
        if(property_exists($this, $field)) {
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
      foreach($this->attributes() as $key => $value){
        $clean_attributes[$key] = $database->escape_value($value);
      }
      return $clean_attributes;
    }
    
   
  ///////////////////////////FIN METODOS ESTANDAR//////////////////////////////
}
?>
