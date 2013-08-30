<?php
session_start();
      require_once ('../../php/db/database.php');
      require_once ('../../php/entity/cotizacion.php');
      require_once ('../../php/operation/find_aseguradora.php');
      require_once ('../../php/operation/solicitud.php');
      require_once ('../../php/operation/calcular_primas.php');
      require_once ('../../php/entity/flota.php');
      require_once ('../../php/entity/clasificacion.php');
      require_once ('../../php/entity/re_tipo_cobertura_aseguradora.php');
      require_once ('../../php/entity/parametros.php');

     if(isset($_POST["nombre"]) && isset($_POST["cedula"]) && isset($_POST["telefono"]) && isset($_POST["correo"]) &&
        isset($_POST["edad"]) && isset($_POST["sexo"]) && isset($_POST["civil"]) && isset($_POST["tipo"]) && 
        isset($_POST["marca"]) && isset($_POST["modelo"]) && isset($_POST["ano"]) && isset($_POST["ocupantes"]) && 
        isset($_POST["cobertura"]) && isset($_POST["version"]) && isset($_POST["valor"])){
        //&& isset($_POST["flota"])
        //FALTA valor, usado 
         
     $flota=new flota();
     $flota->id=1;
     $array_flota=$flota->find_all();
            
     if(sizeof($array_flota) > 0){  
         
            $cotizacion=new cotizacion();

            $cotizacion->nombre=$_POST["nombre"];
            $cotizacion->cedula=$_POST["cedula"];
            $cotizacion->telefono=$_POST["telefono"];
            $cotizacion->email=$_POST["correo"];
            $cotizacion->edad=$_POST["edad"];
            $cotizacion->sexo=$_POST["sexo"];
            $cotizacion->estado_civil=$_POST["civil"];
            $cotizacion->tipo_carro=1;
            $cotizacion->car_marca=$_POST["marca"];
            $cotizacion->car_modelo=$_POST["modelo"];
            $cotizacion->car_version=$_POST["version"];
            $cotizacion->car_ano=$_POST["ano"];
            $cotizacion->car_ocupantes=$_POST["ocupantes"];
            $cotizacion->tipo_cobertura=$_POST["cobertura"];
            $cotizacion->id_flota=$_POST["flota"];
            $cotizacion->id_flota=1;
            $cotizacion->cr_time='NOW()';
            $cotizacion->ut_time='NOW()';
            $cotizacion->valor_INMA=$_POST["valor"];//Ver de donde sacamos este valor
 
 
   /*
            $cotizacion->nombre="Eduardo Convit";
            $cotizacion->cedula="17427127";
            $cotizacion->telefono="573124221042";
            $cotizacion->email="carlos.convit@gmail.com";
            $cotizacion->edad=27;
            $cotizacion->sexo=1;
            $cotizacion->estado_civil=1;
            $cotizacion->tipo_carro=1;
            $cotizacion->car_marca="FORD";
            $cotizacion->car_modelo="FIESTA";
            $cotizacion->car_version="LX";
            $cotizacion->car_ano="2013";
            $cotizacion->car_ocupantes=5;
            $cotizacion->tipo_cobertura=2;
            $cotizacion->id_flota=1;
            $cotizacion->valor_INMA="256000";
            $cotizacion->cr_time='NOW()';
            $cotizacion->ut_time='NOW()';
          */  
            //BUSCAR VALOR INMA
            
            //Busqueda de la clasificacion
            $find_aseguradora=new find_aseguradora();
            $clasificacion= new clasificacion();
            $clasificacion->marca=$cotizacion->car_marca;
            $clasificacion->modelo=$cotizacion->car_modelo;
            $clasificacion->ano=$cotizacion->car_ano;   
            $clasificacion->tipo_carro=$cotizacion->tipo_carro; 
            
            $res_clasificacion=$find_aseguradora->get_clasificacion($cotizacion->tipo_cobertura,$cotizacion->id_flota,$clasificacion);
            //var_dump($res_clasificacion);
            //Obtenemos las coberturas asociadas a cada registro de la clasificacion
            $find_aseguradora->get_coberturas($cotizacion->tipo_cobertura,$res_clasificacion);
            //var_dump($res_clasificacion);
            
            $parametros=new parametros();
            $array_parametros=$parametros->find_all();
            
            $solicitud=new solicitud();
            $solicitud->cotizacion=$cotizacion;
            $solicitud->res_clasificacion=$res_clasificacion;
            $solicitud->flota=$array_flota[0];
            $solicitud->parametros=$array_parametros;
            
            $_SESSION['solicitud']=serialize($solicitud);
    
            if(sizeof($solicitud->res_clasificacion) > 0)
                
                header("Location: ../aseguradoras.php");
            else
                header("Location: http://www.google.com");
                
     }
        }else
            echo "Error en las variables";
            
?>
