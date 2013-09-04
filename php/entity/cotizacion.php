<?php

class cotizacion{
    
    protected static $table_name="tbl_cotizacion";
    protected static $db_fields=array('id','nombre','cedula','telefono','email','edad',
                                      'sexo','estado_civil','tipo_carro','car_marca',
                                      'car_modelo','car_ano','car_version','car_ocupantes',
                                      'tipo_cobertura','id_flota','valor_INMA','cr_time','ut_time');
    
    public $id;
    public $nombre;
    public $cedula;
    public $telefono;
    public $email;
    public $edad;
    public $sexo;
    public $estado_civil;
    public $tipo_carro;
    public $car_marca;
    public $car_modelo;
    public $car_ano;
    public $car_version;
    public $car_ocupantes;
    public $tipo_cobertura;
    public $id_flota;
    public $valor_INMA;
    public $cr_time;
    public $ut_time;
    public $tipo;//Nevo , Usado
   
    
  public function cotizacion (){
      
      
  }
            
  // Common Database Methods
  public static function find_all() {
		return self::find_by_sql("SELECT * FROM ".self::$table_name);
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
    
    public function create() {
      
    global $database;
    // Don't forget your SQL syntax and good habits:
    // - INSERT INTO table (key, key) VALUES ('value', 'value')
    // - single-quotes around all values
    // - escape all values to prevent SQL injection
    $attributes = $this->sanitized_attributes();
    
    $sql = "INSERT INTO ".self::$table_name." (";
    
    $sql .= join(", ", array_keys($attributes));
    $sql .= ") VALUES ('";
    $sql .= join("', '", array_values($attributes));
    $sql .= "')";
    
    $sql=str_replace("'NOW()'","NOW()",$sql);
    
      if($database->query($sql)) {
        $this->id_user = $database->insert_id();
        return true;
      } else {
        return false;
      }
      
      
    }
  ///////////////////////////FIN METODOS ESTANDAR//////////////////////////////
}
?>
