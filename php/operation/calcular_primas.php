<?php

class calcular_primas{
    
    public $ano;
    public $ocupantes;
    public $edad;
    public $estado_civil;
    public $sexo;
    public $valor_INMA;
    public $porcentaje_INMA;
    public $UT;
    public $tipo_carro;
    

            
    public function calcular_primas(){
        
    }
    
    public function get_prima($cobertura,$tasa){
        
        $suma_asegurada=$this->valor_INMA*$this->porcentaje_INMA;
        
        switch($cobertura->tipo_calculo){
            
            case 1: 
                    //Suma asegurada * Tasa Cobertura
                    $cobertura->prima=$suma_asegurada*($tasa/100);
                    break;
            
            case 2: 
                    //INMA + %
                    $cobertura->prima=$suma_asegurada;
                    break;
                
            case 3: 
                    //Valor * UT
                    $cobertura->prima=$cobertura->valor*$this->UT;
                    break;
                
            case 4: 
                    //Valor
                    $cobertura->prima=$cobertura->valor;
                    break;
                
            case 5: 
                    //Valor * (Suma asegurada)
                    $cobertura->prima=$cobertura->valor*$suma_asegurada;
                    break;
                
            case 6: 
                    //Valor * num ocupantes
                    $cobertura->prima=$cobertura->valor*$this->ocupantes;
                    break;
            
            case 7: 
                    //Valor % * RCV Basico
                    $rcv_cob=new re_tipo_cobertura_aseguradora();
                    $rcv_cob->id_convenio_as=$cobertura->id_convenio_as;
                    $rcv_cob->id_cob_as=$cobertura->id_cob_as;
                    $rcv_cob->id_tipo_carro=$cobertura->id_tipo_carro;
                    $rcv_cob->descripcion=$cobertura->descripcion;
                    
                    $result=$rcv_cob->find_re_by_convenio_cobertura_tipo_carro_descripcion();
                    if(sizeof($result) > 0)$cobertura->prima=($cobertura->valor*100)*$result[0]->valor;
                    break;
                
            case 8: 
                    //Valor Grua Segun ano del vehiculo
                    $grua=new grua();
                    $grua->ano=  $this->ano;
                    $grua->id_tipo_carro=$cobertura->tipo_carro;
                    $grua->id_convenio_aseguradora=$cobertura->id_convenio_as;
                    $result=$grua->find_by_convenio_carro_ano();
                    
                    if(sizeof($result) > 0)$cobertura->prima=$result[0]->valor;
                    
                    break;
                
                
        }
    }
}
?>
