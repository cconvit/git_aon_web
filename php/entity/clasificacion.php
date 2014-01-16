<?php

class clasificacion{
    
    protected static $table_name = "tbl_clasificacion";
    protected static $db_fields=array('id','id_aseguradora','as_nombre','marca','modelo','clasificacion','tipo_carro','tasa','ano','convenio');
    
    public $id;
    public $id_aseguradora;
    public $as_nombre;
    public $marca;
    public $modelo;
    public $clasificacion;
    public $tipo_carro;
    public $tasa;
    public $ano;
    public $convenio;
    public $coberturas;
    
    
    
    
  public function clasificacion (){
      
      
  }
  //Buscamos por Marca, Modelo y Tipo de Carro
  public function find_clasificacion_by_marca_modelo_carro_ano($tipo_cobertura,$id_flota) {
   
      global $database;
    
      return self::find_by_sql("SELECT c.id as 'id',a.id_aseguradora as 'id_aseguradora',ase.nombre as 'as_nombre',c.marca as 'marca',
                                       c.modelo as 'modelo',c.clasificacion as 'clasificacion',
                                       c.tipo_carro as 'tipo_carro',t.tasa as 'tasa',t.ano as 'ano',
                                       t.id_convenio_as as 'convenio'
                                FROM tbl_clasificacion c INNER JOIN tbl_tasa_casco t 
                                ON   (c.tipo_carro=t.tipo_carro AND c.clasificacion=t.clasificacion AND t.id_convenio_as=c.id_convenio_as)
                                INNER JOIN tbl_re_flota_co_as a ON (t.id_convenio_as=a.id_convenio_as)
                                INNER JOIN tbl_aseguradora ase ON ase.id=a.id_aseguradora
                                WHERE marca='{$database->escape_value($this->marca)}' 
                                      AND modelo='{$database->escape_value($this->modelo)}' 
                                      AND c.tipo_carro='{$database->escape_value($this->tipo_carro)}' 
                                      AND t.ano='{$database->escape_value($this->ano)}' 
                                      AND t.id_tipo_co='{$database->escape_value($tipo_cobertura)}'
                                      AND a.id_flota='{$database->escape_value($id_flota)}'");
                                      
                                     

     /*  $result_array=array();  
       
       while ($row = $database->fetch_array($result_set)) {
           
           array_push($result_array,$row);
       }
      
      return $result_array;
      * 
      */
  }
  
  //Buscamos por  Tipo de Carro, ano y monto asegurado
  public function find_clasificacion_by_carro_ano_montoAsegurado($tipo_cobertura,$id_flota,$suma_asegurada) {
   
      global $database;
    
      return self::find_by_sql("SELECT c.id as 'id',a.id_aseguradora as 'id_aseguradora',ase.nombre as 'as_nombre','TODOS' as 'marca',
                                       'TODOS' as 'modelo',c.clasificacion as 'clasificacion',
                                       c.tipo_carro as 'tipo_carro',t.tasa as 'tasa',t.ano as 'ano',
                                       t.id_convenio_as as 'convenio'
                                FROM tbl_clasificacion_ma c INNER JOIN tbl_tasa_casco t 
                                ON   (c.tipo_carro=t.tipo_carro AND c.clasificacion=t.clasificacion AND t.id_convenio_as=c.id_convenio_as)
                                INNER JOIN tbl_re_flota_co_as a ON (t.id_convenio_as=a.id_convenio_as)
                                INNER JOIN tbl_aseguradora ase ON ase.id=a.id_aseguradora
                                WHERE c.monto_min <='{$database->escape_value($suma_asegurada)}' 
                                      AND c.monto_max >'{$database->escape_value($suma_asegurada)}' 
                                      AND c.tipo_carro='{$database->escape_value($this->tipo_carro)}' 
                                      AND t.ano='{$database->escape_value($this->ano)}' 
                                      AND t.id_tipo_co='{$database->escape_value($tipo_cobertura)}'
                                      AND a.id_flota='{$database->escape_value($id_flota)}'");
                                      
                                    
  }
  
  //Buscamos por tipo de carro, ano, aseguradora y monsto asegurado
  public function find_clasificacion_by_carro_ano_aseguradora_monstoAsegurado($tipo_cobertura,$id_flota,$descartar,$suma_asegurada) {
   
      global $database;

      return self::find_by_sql("SELECT c.id as 'id',a.id_aseguradora as 'id_aseguradora',ase.nombre as 'as_nombre','TODOS' as 'marca',
                                       'TODOS' as 'modelo',c.clasificacion as 'clasificacion',
                                       c.tipo_carro as 'tipo_carro',t.tasa as 'tasa',t.ano as 'ano',
                                       t.id_convenio_as as 'convenio'
                                FROM tbl_clasificacion_ma c INNER JOIN tbl_tasa_casco t 
                                ON   (c.tipo_carro=t.tipo_carro AND c.clasificacion=t.clasificacion AND t.id_convenio_as=c.id_convenio_as)
                                INNER JOIN tbl_re_flota_co_as a ON (t.id_convenio_as=a.id_convenio_as)
                                INNER JOIN tbl_aseguradora ase ON ase.id=a.id_aseguradora
                                WHERE c.monto_min <='{$database->escape_value($suma_asegurada)}' 
                                      AND c.monto_max >'{$database->escape_value($suma_asegurada)}' 
                                      AND c.tipo_carro='{$database->escape_value($this->tipo_carro)}' 
                                      AND t.ano='{$database->escape_value($this->ano)}' 
                                      AND t.id_tipo_co='{$database->escape_value($tipo_cobertura)}'
                                      AND a.id_flota='{$database->escape_value($id_flota)}'
                                      {$descartar}");
                                     
  }
  
  
  public function find_clasificacion_by_marca_modelo_carro_ano_aseguradora($tipo_cobertura,$id_flota,$descartar) {
   
      global $database;

      return self::find_by_sql("SELECT c.id as 'id',a.id_aseguradora as 'id_aseguradora',ase.nombre as 'as_nombre',c.marca as 'marca',
                                       c.modelo as 'modelo',c.clasificacion as 'clasificacion',
                                       c.tipo_carro as 'tipo_carro',t.tasa as 'tasa',t.ano as 'ano',
                                       t.id_convenio_as as 'convenio'
                                FROM tbl_clasificacion c INNER JOIN tbl_tasa_casco t 
                                ON   (c.tipo_carro=t.tipo_carro AND c.clasificacion=t.clasificacion AND t.id_convenio_as=c.id_convenio_as) 
                                INNER JOIN tbl_re_flota_co_as a ON (t.id_convenio_as=a.id_convenio_as)
                                INNER JOIN tbl_aseguradora ase ON ase.id=a.id_aseguradora
                                WHERE marca='{$database->escape_value($this->marca)}' 
                                      AND modelo='{$database->escape_value($this->modelo)}' 
                                      AND c.tipo_carro='{$database->escape_value($this->tipo_carro)}' 
                                      AND t.ano='{$database->escape_value($this->ano)}' 
                                      AND t.id_tipo_co='{$database->escape_value($tipo_cobertura)}'
                                      AND a.id_flota='{$database->escape_value($id_flota)}'
                                      {$descartar}");
                                     
  }
  
  //Buscamos por Marca, Modelo y Tipo de Carro
  public function find_clasificacion_by_marca_modelo_carro_ano_RCV($id_flota) {
   
      global $database;
    
      return self::find_by_sql("SELECT c.id as 'id',a.id_aseguradora as 'id_aseguradora',ase.nombre as 'as_nombre',c.marca as 'marca',
                                       c.modelo as 'modelo',c.clasificacion as 'clasificacion',
                                       c.tipo_carro as 'tipo_carro','0' as 'tasa','{$database->escape_value($this->ano)}'  as 'ano',
                                       a.id_convenio_as as 'convenio'
                                FROM tbl_clasificacion c 
                                INNER JOIN tbl_re_flota_co_as a ON (a.id_convenio_as=c.id_convenio_as)
                                INNER JOIN tbl_aseguradora ase ON ase.id=a.id_aseguradora
                                WHERE marca='{$database->escape_value($this->marca)}' 
                                      AND modelo='{$database->escape_value($this->modelo)}' 
                                      AND c.tipo_carro='{$database->escape_value($this->tipo_carro)}' 
                                      AND a.id_flota='{$database->escape_value($id_flota)}'");
                                      
                                   
  }
    //Buscamos por Marca, Modelo y Tipo de Carro
  public function find_clasificacion_by_marca_modelo_carro_ano_aseguradora_RCV($id_flota,$descartar) {
   
      global $database;
    
      return self::find_by_sql("SELECT c.id as 'id',a.id_aseguradora as 'id_aseguradora',ase.nombre as 'as_nombre',c.marca as 'marca',
                                       c.modelo as 'modelo',c.clasificacion as 'clasificacion',
                                       c.tipo_carro as 'tipo_carro','0' as 'tasa','{$database->escape_value($this->ano)}'  as 'ano',
                                       a.id_convenio_as as 'convenio'
                                FROM tbl_clasificacion c 
                                INNER JOIN tbl_re_flota_co_as a ON (a.id_convenio_as=c.id_convenio_as)
                                INNER JOIN tbl_aseguradora ase ON ase.id=a.id_aseguradora
                                WHERE marca='{$database->escape_value($this->marca)}' 
                                      AND modelo='{$database->escape_value($this->modelo)}' 
                                      AND c.tipo_carro='{$database->escape_value($this->tipo_carro)}' 
                                      AND a.id_flota='{$database->escape_value($id_flota)}'
                                      {$descartar}");
                                      
                                   
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

        $sql = "INSERT INTO " . self::$table_name . " (id_convenio_as,marca,modelo,clasificacion,tipo_carro) VALUES (
                            '{$database->escape_value($this->id_convenio_as)}',
                            '{$database->escape_value($this->marca)}',
                            '{$database->escape_value($this->modelo)}',
                            '{$database->escape_value($this->clasificacion)}',
                            '{$database->escape_value($this->tipo_carro)}'
                            )";

        if ($database->query($sql)) {
            $this->id = $database->insert_id();
            return true;
        } else {
            return false;
        }
    }
    public function delete_by_convenio() {

    global $database;

    $sql = "DELETE FROM " . self::$table_name . " 
        WHERE id_convenio_as='{$database->escape_value($this->id_convenio_as)}'
       ";
        
    if ($database->query($sql)) {
      return true;
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