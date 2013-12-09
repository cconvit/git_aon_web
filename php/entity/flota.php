<?php

class flota{
    
    protected static $table_name="tbl_flota";
    protected static $db_fields=array('id','empresa','porcentaje_INMA','descripcion','cr_time','ut_time','avatar');
    
    public $id;
    public $empresa;
    public $porcentaje_INMA;
    public $descripcion;
    public $cr_time;
    public $ut_time;
    public $avatar;
    
  public function flota (){
      
      
  }
            
  // Common Database Methods
  public static function find_all() {
		return self::find_by_sql("SELECT * FROM ".self::$table_name);
  }
  
  public  function find_by_id_flota() {
      
      global $database;
      
		return self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE id='{$database->escape_value($this->id)}'");
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
  
  
    public  function update_by_id() {
      
      global $database;
      
        $sql="UPDATE ".self::$table_name." SET
                                  empresa='{$database->escape_value($this->empresa)}',
                                  porcentaje_INMA='{$database->escape_value($this->porcentaje_INMA)}',
                                  avatar='{$database->escape_value($this->avatar)}',
                                  descripcion='{$database->escape_value($this->descripcion)}',
                                  WHERE id='{$database->escape_value($this->id)}'";

    
                                 
      if($database->query($sql)) {
          
          if(mysql_affected_rows() != 0){
             
          return true;}
         else{
             return false;
         }

      } else {
        return false;
      }
      
  }
  
  public  function create() {
      
      global $database;
      
        $sql="INSERT INTO ".self::$table_name." (empresa,porcentaje_INMA,avatar,descripcion,cr_time) VALUES (
                            '{$database->escape_value($this->empresa)}',
                            '{$database->escape_value($this->porcentaje_INMA)}',
                            '{$database->escape_value($this->avatar)}',
                            '{$database->escape_value($this->descripcion)}',
                            NOW())";
                                          
                                          
      if($database->query($sql)) {
        $this->id = $database->insert_id();
        return true;
      } else {
        return false;
      }
  }
  
   public  function delete() {
      
      global $database;
      
        $sql="DELETE FROM ".self::$table_name."
                                  WHERE id='{$database->escape_value($this->id)}'";

    
                                 
      if($database->query($sql)) {
         if(mysql_affected_rows() != 0)
             return true;
         else
             return false;
      } else {
          echo "pepe";
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
