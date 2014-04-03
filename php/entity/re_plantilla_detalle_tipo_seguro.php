<?php

class re_plantilla_detalle_tipo_seguro {

    protected static $db_fields = array('id_cobertura', 'id_grupo', 'descripcion');
    public $id_cobertura;
    public $id_grupo;
    public $descripcion;

    public function re_plantilla_detalle_tipo_seguro() {
        
    }

    //Buscamos por Marca, Modelo y Tipo de Carro
    public function find_re_plantilla_detalle_tipo_seguro($id_flota, $tipo_seguro, $id_grupo) {

        global $database;

        return self::find_by_sql("SELECT d.id_cobertura as 'id_cobertura',d.id_grupo as 'id_grupo',
                                       c.desc_cobertura as 'descripcion' 
                                FROM `tbl_plantilla_detalle` d 
                                INNER JOIN tbl_re_plantilla_flota r ON d.id_plantilla=r.id_plantilla 
                                INNER JOIN tbl_cob_as c ON d.id_cobertura=c.id  
                                WHERE     r.id_flota='{$database->escape_value($id_flota)}' 
                                      AND r.id_tipo_seguro='{$database->escape_value($tipo_seguro)}'
                                      AND d.id_grupo='{$database->escape_value($id_grupo)}'
                                ");
    }

    // Common Database Methods
    public static function find_all() {
        return self::find_by_sql("SELECT * FROM " . self::$table_name);
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