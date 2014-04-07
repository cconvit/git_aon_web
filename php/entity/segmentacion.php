<?php

class segmentacion {

    protected static $table_name = "tbl_segmentacion";
    protected static $db_fields = array('id_convenio_as', 'id_estado_civil', 'id_sexo', 'edad', 'tasa');
    public $id_convenio_as;
    public $id_estado_civil;
    public $id_sexo;
    public $edad;
    public $tasa;

    public function segmentacion() {
        
    }

    // Common Database Methods
    public static function find_all() {
        return self::find_by_sql("SELECT * FROM " . self::$table_name);
    }

    public function find_tasa() {

        global $database;

        return self::find_by_sql("SELECT * FROM " . self::$table_name . " 
                                                   WHERE id_convenio_as='{$database->escape_value($this->id_convenio_as)}'
                                                   AND   id_estado_civil='{$database->escape_value($this->id_estado_civil)}'
                                                   AND   edad='{$database->escape_value($this->edad)}'
                                                   AND   id_sexo='{$database->escape_value($this->id_sexo)}'
                                                   LIMIT 1");
    }
    
    public function find_by_convenio() {

        global $database;

        return self::find_by_sql("SELECT * FROM " . self::$table_name . " 
                                                   WHERE id_convenio_as='{$database->escape_value($this->id_convenio_as)}'
                                                   ");
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

        $sql = "INSERT INTO " . self::$table_name . " (id_convenio_as,id_estado_civil,id_sexo,edad,tasa) VALUES (
                            '{$database->escape_value($this->id_convenio_as)}',
                            '{$database->escape_value($this->id_estado_civil)}',
                            '{$database->escape_value($this->id_sexo)}',
                            '{$database->escape_value($this->edad)}',
                            '{$database->escape_value($this->tasa)}'
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
