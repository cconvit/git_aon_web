<?php

class cotizacion_carro {

    protected static $table_name = "tbl_cotizacion_carros";
    protected static $db_fields = array('id', 'asegurado', 'identificacion', 'edad',
        'sexo', 'estado_civil', 'tipo_carro', 'car_marca', 'car_modelo', 'car_ano',
        'car_version', 'placa', 'car_ocupantes', 'tipo_cobertura', 'id_cotizacion',
        'valor_INMA', 'porcentaje_inma', 'is_car_marca', 'is_car_modelo', 'is_car_ocupantes', 'is_edad',
        'is_sexo', 'is_estado_civil', 'is_tipo_carros', 'is_tipo_cobertura', 'is_porcentaje_inma', 'cr_time',
        'ut_time');
    public $id;
    public $asegurado;
    public $identificacion;
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
    public $id_cotizacion;
    public $valor_INMA;
    public $porcentaje_inma;
    public $placa;
    public $is_car_marca;
    public $is_car_modelo;
    public $is_car_ocupantes;
    public $is_edad;
    public $is_sexo;
    public $is_tipo_carros;
    public $is_tipo_cobertura;
    public $is_estado_civil;
    public $is_porcentaje_inma;
    public $cr_time;
    public $ut_time;

    public function cotizacion_carro() {
        
    }

    // Common Database Methods
    public function find_by_id_cotizacion() {

        global $database;

        return self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE `id_cotizacion`='{$database->escape_value($this->id_cotizacion)}'");
    }

    public function find_by_id_cotizacion_carro() {

        global $database;

        return self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE `id`='{$database->escape_value($this->id)}'");
    }

    // Common Database Methods
    public function find_by_id_cotizacion_error() {

        global $database;

        return self::find_by_sql("SELECT * FROM `tbl_cotizacion_carros` 
                                  WHERE (`is_car_marca`=0 
                                  OR `is_car_modelo`=0 
                                  OR `is_car_ocupantes`=0 
                                  OR `is_tipo_carros`=0 
                                  OR `is_tipo_cobertura`=0
                                  OR `is_porcentaje_inma`=0) 
                                  AND `id_cotizacion`='{$database->escape_value($this->id_cotizacion)}'");
    }

    // Common Database Methods
    public function find_by_id_cotizacion_success() {

        global $database;

        return self::find_by_sql("SELECT * FROM `tbl_cotizacion_carros`  
                                  WHERE `is_car_marca`=1 
                                  AND `is_car_modelo`=1
                                  AND `is_car_ocupantes`=1 
                                  AND `is_tipo_carros`=1 
                                  AND `is_tipo_cobertura`=1
                                  AND `is_porcentaje_inma`=1
                                  AND `id_cotizacion`='{$database->escape_value($this->id_cotizacion)}'");
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

        $sql = "INSERT INTO " . self::$table_name . " (`asegurado`, `identificacion`, `edad`, `sexo`, 
            `estado_civil`, `tipo_carro`, `car_marca`, `car_modelo`, `car_ano`, `car_version`, `placa`,
            `car_ocupantes`, `tipo_cobertura`, `id_cotizacion`, `valor_INMA`,`porcentaje_inma`, `is_car_marca`, `is_car_modelo`,
            `is_car_ocupantes`, `is_edad`, `is_sexo`, `is_estado_civil`, `is_tipo_carros`, `is_tipo_cobertura`,`is_porcentaje_inma`,
            `cr_time`) VALUES (
                                                '{$database->escape_value($this->asegurado)}',
                                                '{$database->escape_value($this->identificacion)}',
                                                '{$database->escape_value($this->edad)}',
                                                '{$database->escape_value($this->sexo)}',
                                                '{$database->escape_value($this->estado_civil)}',
                                                '{$database->escape_value($this->tipo_carro)}',   
                                                '{$database->escape_value($this->car_marca)}',
                                                '{$database->escape_value($this->car_modelo)}',
                                                '{$database->escape_value($this->car_ano)}',
                                                '{$database->escape_value($this->car_version)}',
                                                '{$database->escape_value($this->placa)}',
                                                '{$database->escape_value($this->car_ocupantes)}', 
                                                '{$database->escape_value($this->tipo_cobertura)}',
                                                '{$database->escape_value($this->id_cotizacion)}',
                                                '{$database->escape_value($this->valor_INMA)}',
                                                '{$database->escape_value($this->porcentaje_inma)}',
                                                '{$database->escape_value($this->is_car_marca)}',
                                                '{$database->escape_value($this->is_car_modelo)}',
                                                '{$database->escape_value($this->is_car_ocupantes)}',   
                                                '{$database->escape_value($this->is_edad)}',
                                                '{$database->escape_value($this->is_sexo)}',
                                                '{$database->escape_value($this->is_estado_civil)}',
                                                '{$database->escape_value($this->is_tipo_carros)}',
                                                '{$database->escape_value($this->is_tipo_cobertura)}',
                                                '{$database->escape_value($this->is_porcentaje_inma)}',
                                                 NOW())";

        if ($database->query($sql)) {
            $this->id = $database->insert_id();
            return true;
        } else {
            return false;
        }
    }

    public function update() {

        global $database;

        $qry = "UPDATE " . self::$table_name . " SET 
                                    edad='{$database->escape_value($this->edad)}',
                                    sexo='{$database->escape_value($this->sexo)}',
                                    estado_civil='{$database->escape_value($this->estado_civil)}',
                                    tipo_carro='{$database->escape_value($this->tipo_carro)}',
                                    car_marca='{$database->escape_value($this->car_marca)}',
                                    car_modelo='{$database->escape_value($this->car_modelo)}',
                                    car_ano='{$database->escape_value($this->car_ano)}',
                                    car_version='{$database->escape_value($this->car_version)}',
                                    car_ocupantes='{$database->escape_value($this->car_ocupantes)}',
                                    tipo_cobertura='{$database->escape_value($this->tipo_cobertura)}',
                                    valor_INMA='{$database->escape_value($this->valor_INMA)}',
                                    porcentaje_inma='{$database->escape_value($this->porcentaje_inma)}',
                                    is_car_marca='{$database->escape_value($this->is_car_marca)}',
                                    is_car_modelo='{$database->escape_value($this->is_car_modelo)}',
                                    is_car_ocupantes='{$database->escape_value($this->is_car_ocupantes)}',
                                    is_edad='{$database->escape_value($this->is_edad)}',
                                    is_sexo='{$database->escape_value($this->is_sexo)}',
                                    is_tipo_carros='{$database->escape_value($this->is_tipo_carros)}',
                                    is_tipo_cobertura='{$database->escape_value($this->is_tipo_cobertura)}',
                                    is_estado_civil='{$database->escape_value($this->is_estado_civil)}',
                                    is_porcentaje_inma='{$database->escape_value($this->is_porcentaje_inma)}'
                                  WHERE id='{$database->escape_value($this->id)}'
";

        if ($database->query($qry)) {

            return true;
        } else {
            return false;
        }
    }

    public function delete() {

        global $database;

        $sql = "DELETE FROM " . self::$table_name . " WHERE id='{$database->escape_value($this->id)}'";

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
