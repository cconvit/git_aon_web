<?php

class solicitud{
    
    public $cotizacion;
    public $res_clasificacion;
    public $re_aseguradora_cotizacion;
    public $flota;
    
    
    
    
    public function solicitud(){
        
        
    }
    
    public function calcular_primas($aseguradoras){
        
        //Creamos el objeto para calcular las primas y seteamos campos requeridos para los calculos
        $calcular_primas=new calcular_primas();
        $calcular_primas->ano=$this->cotizacion->car_ano;
        $calcular_primas->ocupantes=$this->cotizacion->car_ocupantes;
        $calcular_primas->edad=$this->cotizacion->edad;
        $calcular_primas->estado_civil=$this->cotizacion->estado_civil;
        $calcular_primas->sexo=$this->cotizacion->sexo;
        $calcular_primas->valor_INMA=  $this->cotizacion->valor_INMA;
        $calcular_primas->porcentaje_INMA=  $this->flota->porcentaje_INMA;
        
        $this->re_aseguradora_cotizacion=array();
        
        foreach($aseguradoras as $item){
       
            
            for($x=0;$x<sizeof($this->res_clasificacion);$x++){
                
             
                if($this->res_clasificacion[$x]->id_aseguradora == $item){
                   
                    foreach ($this->res_clasificacion[$x]->coberturas as $cobertura){
                        
                        $tasa=  $this->res_clasificacion[$x]->tasa;
                        $ano=  $this->res_clasificacion[$x]->ano;
                        
                        $calcular_primas->get_prima($cobertura,$tasa,$ano);
                                

                    }
                    array_push($this->re_aseguradora_cotizacion,$this->res_clasificacion[$x]);
                }
            }
            
        }
    }
    
    
}
?>
