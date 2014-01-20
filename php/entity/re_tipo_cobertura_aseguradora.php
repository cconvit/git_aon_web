<?php

class re_tipo_cobertura_aseguradora{
    
    protected static $table_name="tbl_re_tipo_cob_as";
    protected static $db_fields=array('id_convenio_as','id_tipo_cob','id_cob_as','id_tipo_carro','tipo_calculo','valor','descripcion','limite','tasa','incluida');
    
    public $id_convenio_as;
    public $id_tipo_cob;
    public $id_cob_as;
    public $id_tipo_carro;
    public $tipo_calculo;
    public $valor;
    public $descripcion;
    public $prima;
    public $limite;
    public $tasa;
    public $incluida;
    
  public function re_tipo_cobertura_aseguradora (){
      
      
  }
  
  public function find_re_by_convenio_cobertura_tipo_carro_descripcion() {
	
      global $database;
      
      return self::find_by_sql("SELECT re.id_convenio_as as 'id_convenio_as',re.id_tipo_cob as 'id_tipo_cob',
                                       re.id_cob_as as 'id_cob_as', re.id_tipo_carro as 'id_tipo_carro',
                                       re.tipo_calculo as 'tipo_calculo',re.valor as 'valor',
                                       de.desc_cobertura as 'descripcion',re.limite as 'limite',re.tasa as 'tasa',
                                       re.incluida as 'incluida'
                               FROM  tbl_re_tipo_cob_as re
                               INNER JOIN tbl_cob_as de ON (de.id=re.id_cob_as)
                               WHERE re.id_convenio_as='{$database->escape_value($this->id_convenio_as)}' 
                               AND   re.id_tipo_cob='{$database->escape_value($this->id_tipo_cob)}' 
                               AND   re.id_tipo_carro='{$database->escape_value($this->id_tipo_carro)}' 
                               AND   de.desc_cobertura='{$database->escape_value($this->descripcion)}' 
                               ");
  }
  
   public function find_re_by_convenio_cobertura_tipo_carro_id_cob_as() {
	
      global $database;
      
      return self::find_by_sql("SELECT re.id_convenio_as as 'id_convenio_as',re.id_tipo_cob as 'id_tipo_cob',
                                       re.id_cob_as as 'id_cob_as', re.id_tipo_carro as 'id_tipo_carro',
                                       re.tipo_calculo as 'tipo_calculo',re.valor as 'valor',
                                       de.desc_cobertura as 'descripcion',re.limite as 'limite',re.tasa as 'tasa',
                                       re.incluida as 'incluida'
                               FROM  tbl_re_tipo_cob_as re
                               INNER JOIN tbl_cob_as de ON (de.id=re.id_cob_as)
                               WHERE re.id_convenio_as='{$database->escape_value($this->id_convenio_as)}' 
                               AND   re.id_tipo_cob='{$database->escape_value($this->id_tipo_cob)}' 
                               AND   re.id_tipo_carro='{$database->escape_value($this->id_tipo_carro)}' 
                               AND   de.id='{$database->escape_value($this->id_cob_as)}' 
                               ");
  }
  
   public function find_re_by_convenio_cobertura_tipo_carro() {
	
      global $database;
      
      return self::find_by_sql("SELECT re.id_convenio_as as 'id_convenio_as',re.id_tipo_cob as 'id_tipo_cob',
                                       re.id_cob_as as 'id_cob_as', re.id_tipo_carro as 'id_tipo_carro',
                                       re.tipo_calculo as 'tipo_calculo',re.valor as 'valor',
                                       de.desc_cobertura as 'descripcion',re.limite as 'limite',re.tasa as 'tasa',
                                       re.incluida as 'incluida'
                               FROM  tbl_re_tipo_cob_as re
                               INNER JOIN tbl_cob_as de ON (de.id=re.id_cob_as)
                               WHERE re.id_convenio_as='{$database->escape_value($this->id_convenio_as)}' 
                               AND   re.id_tipo_cob='{$database->escape_value($this->id_tipo_cob)}' 
                               AND   re.id_tipo_carro='{$database->escape_value($this->id_tipo_carro)}' 
                              ");
  }
  
  public function find_re_by_convenio_cobertura() {
	
      global $database;
      
      return self::find_by_sql("SELECT re.id_convenio_as as 'id_convenio_as',
                                       de.desc_cobertura as 'descripcion',re.id_cob_as as 'id_cob_as',re.tipo_calculo as 'tipo_calculo',re.tasa as 'tasa',re.incluida as 'incluida'
                               FROM  tbl_re_tipo_cob_as re
                               INNER JOIN tbl_cob_as de ON (de.id=re.id_cob_as)
                               WHERE re.id_convenio_as='{$database->escape_value($this->id_convenio_as)}' 
                               GROUP BY re.id_cob_as
                              ");
  }
  
  public function find_re_by_convenio_id_cobertura() {
	
      global $database;
      
      return self::find_by_sql("SELECT re.id_convenio_as as 'id_convenio_as',
                                       de.desc_cobertura as 'descripcion',re.id_cob_as as 'id_cob_as',re.tipo_calculo as 'tipo_calculo',re.tasa as 'tasa',re.incluida as 'incluida',re.limite as 'limite'
                               FROM  tbl_re_tipo_cob_as re
                               INNER JOIN tbl_cob_as de ON (de.id=re.id_cob_as)
                               WHERE re.id_convenio_as='{$database->escape_value($this->id_convenio_as)}' 
                               AND re.id_cob_as='{$database->escape_value($this->id_cob_as)}' 
                               GROUP BY re.id_cob_as
                              ");
  }
  
    public function find_re_by_convenio_id_cobertura_group_by_tipo_cob() {
	
      global $database;
      
      return self::find_by_sql("SELECT re.id_convenio_as as 'id_convenio_as',
                                       de.desc_cobertura as 'descripcion',re.id_cob_as as 'id_cob_as',re.id_tipo_cob as 'id_tipo_cob',re.id_tipo_carro as 'id_tipo_carro', re.tipo_calculo as 'tipo_calculo',re.valor as 'valor', re.limite as 'limite', re.tasa as 'tasa',re.incluida as 'incluida'
                               FROM  tbl_re_tipo_cob_as re
                               INNER JOIN tbl_cob_as de ON (de.id=re.id_cob_as)
                               WHERE re.id_convenio_as='{$database->escape_value($this->id_convenio_as)}' 
                               AND re.id_cob_as='{$database->escape_value($this->id_cob_as)}' 
                               GROUP BY re.id_tipo_cob
                              ");
  }
  
      public function find_re_by_convenio_id_cobertura_group_by_tipo_carro() {
	
      global $database;
      
      return self::find_by_sql("SELECT re.id_convenio_as as 'id_convenio_as',
                                       de.desc_cobertura as 'descripcion',re.id_cob_as as 'id_cob_as',re.id_tipo_cob as 'id_tipo_cob',re.id_tipo_carro as 'id_tipo_carro', re.tipo_calculo as 'tipo_calculo',re.valor as 'valor', re.limite as 'limite', re.tasa as 'tasa',re.incluida as 'incluida'
                               FROM  tbl_re_tipo_cob_as re
                               INNER JOIN tbl_cob_as de ON (de.id=re.id_cob_as)
                               WHERE re.id_convenio_as='{$database->escape_value($this->id_convenio_as)}' 
                               AND re.id_cob_as='{$database->escape_value($this->id_cob_as)}' 
                               GROUP BY re.id_tipo_carro
                              ");
  }
  
  
    public function find_re_by_convenio_cobertura_all() {
	
      global $database;
      
      return self::find_by_sql("SELECT re.id_convenio_as as 'id_convenio_as',
                                       de.desc_cobertura as 'descripcion',re.id_cob_as as 'id_cob_as',re.id_tipo_cob as 'id_tipo_cob',re.id_tipo_carro as 'id_tipo_carro', re.tipo_calculo as 'tipo_calculo',re.valor as 'valor', re.limite as 'limite', re.tasa as 'tasa',re.incluida as 'incluida'
                               FROM  tbl_re_tipo_cob_as re
                               INNER JOIN tbl_cob_as de ON (de.id=re.id_cob_as)
                               WHERE re.id_convenio_as='{$database->escape_value($this->id_convenio_as)}' 
                               
                              ");
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
  
  public  function create() {
      
      global $database;
      
        $sql="INSERT INTO ".self::$table_name." (id_convenio_as,id_tipo_cob,id_cob_as,id_tipo_carro,tipo_calculo,valor,limite,tasa,incluida) VALUES (
                            '{$database->escape_value($this->id_convenio_as)}',
                            '{$database->escape_value($this->id_tipo_cob)}',
                            '{$database->escape_value($this->id_cob_as)}',
                            '{$database->escape_value($this->id_tipo_carro)}',
                            '{$database->escape_value($this->tipo_calculo)}',
                            '{$database->escape_value($this->valor)}',
                            '{$database->escape_value($this->limite)}',
                            '{$database->escape_value($this->tasa)}',
                            '{$database->escape_value($this->incluida)}'
                            )";
                                          
         // echo $sql." \n";                                
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
                                  WHERE id_convenio_as='{$database->escape_value($this->id_convenio_as)}'
                                  AND id_cob_as ='{$database->escape_value($this->id_cob_as)}'";

    
                              
      if($database->query($sql)) {
         if(mysql_affected_rows() != 0)
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
