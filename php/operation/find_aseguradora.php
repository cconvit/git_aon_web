<?php

class find_aseguradora{
    
    public function find_aseguradora(){
        
        
    }
    
    public function get_clasificacion($tipo_cobertura,$id_flota,$clasificacion,$suma_asegurada){
        
            $res_clasificacion=array();//Objeto con todas las clasificaciones posibles de las aseguradoras
            
            //Obtenemos el primer grupo de clasificacion basado en Marca y Modelo
            if($tipo_cobertura == 3)
                $res_clasificacion_1=$clasificacion->find_clasificacion_by_marca_modelo_carro_ano_RCV($id_flota);
            else
                $res_clasificacion_1=$clasificacion->find_clasificacion_by_marca_modelo_carro_ano($tipo_cobertura,$id_flota);
            
            //Generamos un String con todas las aseguradoras en el que se obtuvieron resultados
            foreach($res_clasificacion_1 as $item)
                $qry_clasificacion=$qry_clasificacion." AND a.id_aseguradora <> '{$item->id_aseguradora}'";
          
            //Cambiamos los parametros de busqueda
            $clasificacion->modelo="TODOS";
            
            if(sizeof($res_clasificacion_1) != 0){
               if($tipo_cobertura == 3)
                   $res_clasificacion_2=$clasificacion->find_clasificacion_by_marca_modelo_carro_ano_aseguradora_RCV($id_flota,$qry_clasificacion);
               else
                   $res_clasificacion_2=$clasificacion->find_clasificacion_by_marca_modelo_carro_ano_aseguradora($tipo_cobertura,$id_flota,$qry_clasificacion);
            }else{
                if($tipo_cobertura == 3)
                   $res_clasificacion_2=$clasificacion->find_clasificacion_by_marca_modelo_carro_ano_RCV($id_flota);
                else
                   $res_clasificacion_2=$clasificacion->find_clasificacion_by_marca_modelo_carro_ano($tipo_cobertura,$id_flota);
            }
             //Cambiamos los parametros de busqueda
            $clasificacion->marca="TODOS";
            $clasificacion->modelo="TODOS";
            
            //Generamos un String con todas las aseguradoras en el que se obtuvieron resultados
            foreach($res_clasificacion_2 as $item)
                $qry_clasificacion=$qry_clasificacion." AND a.id_aseguradora <> '{$item->id_aseguradora}'";
            
            if((sizeof($res_clasificacion_2) != 0) || (sizeof($res_clasificacion_1) != 0))
            {
                if($tipo_cobertura == 3)
                   $res_clasificacion_3=$clasificacion->find_clasificacion_by_marca_modelo_carro_ano_aseguradora_RCV($id_flota,$qry_clasificacion);
                else
                   $res_clasificacion_3=$clasificacion->find_clasificacion_by_marca_modelo_carro_ano_aseguradora($tipo_cobertura,$id_flota,$qry_clasificacion);
  
            }else{
                if($tipo_cobertura == 3)
                   $res_clasificacion_3=$clasificacion->find_clasificacion_by_marca_modelo_carro_ano_RCV($id_flota);
                else
                   $res_clasificacion_3=$clasificacion->find_clasificacion_by_marca_modelo_carro_ano($tipo_cobertura,$id_flota);          
            }
            
            //Generamos un String con todas las aseguradoras en el que se obtuvieron resultados
            foreach($res_clasificacion_3 as $item)
                $qry_clasificacion=$qry_clasificacion." AND a.id_aseguradora <> '{$item->id_aseguradora}'";
            
            
            //Realizamos la busqueda por monto asegurado
            if((sizeof($res_clasificacion_3) != 0) || (sizeof($res_clasificacion_2) != 0) || (sizeof($res_clasificacion_1) != 0))
            
                   $res_clasificacion_4=$clasificacion->find_clasificacion_by_carro_ano_aseguradora_monstoAsegurado($tipo_cobertura,$id_flota,$qry_clasificacion,$suma_asegurada);
            else
                   $res_clasificacion_4=$clasificacion->find_clasificacion_by_carro_ano_montoAsegurado($tipo_cobertura,$id_flota,$suma_asegurada);          
            
            
            
            
            //Agregamos los resultados de la primera busqueda a un array
            foreach ($res_clasificacion_1 as $item)
                array_push($res_clasificacion, $item);
            
            //Agregamos los resultados de la segunda busqueda a un array
            foreach ($res_clasificacion_2 as $item)
                array_push($res_clasificacion, $item);
            
            //Agregamos los resultados de la tercera busqueda a un array
            foreach ($res_clasificacion_3 as $item)
                array_push($res_clasificacion, $item);
            
            //Agregamos los resultados de la cuarta busqueda a un array
            foreach ($res_clasificacion_4 as $item)
                array_push($res_clasificacion, $item);
            
            
            return $res_clasificacion;
    }
    
    public function get_coberturas($tipo_cobertura,$res_clasificacion){
        
        foreach($res_clasificacion as $item){
            
            $cob=new re_tipo_cobertura_aseguradora();
            $cob->id_convenio_as=$item->convenio;
            $cob->id_tipo_carro=$item->tipo_carro;
            $cob->id_tipo_cob=$tipo_cobertura;
            
            $item->coberturas=$cob->find_re_by_convenio_cobertura_tipo_carro();
            
           
        }
        
         return $res_clasificacion;
    }
    
    
}
?>
