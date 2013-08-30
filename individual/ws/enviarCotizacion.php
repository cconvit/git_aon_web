<?php
session_start();

      require_once("../../php/db/config.php");
      require_once ('../../php/db/database.php');
      require_once ('../../php/entity/cotizacion.php');
      require_once ('../../php/operation/solicitud.php');
      require_once ('../../php/operation/calcular_primas.php');
      require_once ('../../php/entity/flota.php');
      require_once ('../../php/entity/clasificacion.php');
      require_once ('../../php/entity/re_tipo_cobertura_aseguradora.php');
      require_once ('../../php/entity/parametros.php');
      require_once ('../../php/entity/plantilla_grupo.php');
      require_once ('../../php/entity/re_plantilla_detalle_tipo_seguro.php');
      require_once ('../tool/function_tool.php');
      require_once ('../../php/entity/tipo_seguro.php');
      require_once ('../../php/mail/class.phpmailer.php');
      require_once ('../../php/mail/class.smtp.php');
      require_once ('../../php/mail/sendMail.php');
      
      
        $id_aseguradora_cotizar=1;//Cargamos el id de la aseguradora que se quiere la cotizacion final
        $solicitud=  unserialize($_SESSION['solicitud']);//Se deserializa el objeto de solicitud
   
        
        
        //LLenamos las variables para el envio del correo
        $cotizacion=$solicitud->cotizacion;
        $to=$cotizacion->email;
        $to_name=$cotizacion->nombre;
        $redirect="http://www.google.com";
        $body_html="";
        
        
        $aseguradora=null;
        //Buscamos la cotizacion que se eligio
        //var_dump($solicitud->re_aseguradora_cotizacion);
        foreach ($solicitud->re_aseguradora_cotizacion as $cotizacion_aseguradora){
            
            if($cotizacion_aseguradora->id_aseguradora == $id_aseguradora_cotizar){
                $aseguradora=$cotizacion_aseguradora;
                break;
            }
        }
        
        if($aseguradora != null){
            
            
        }
        
       
        $body_html='<table class="tbl-content" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                    <tr>
                            <td>
                        <table class="tbl-cotizacion" width="615" border="0" cellspacing="0" cellpadding="0">
				<thead class="gt">
				<th width="255">'.$cotizacion_aseguradora->as_nombre.'</th>
					<th width="128">&nbsp;</th>
					<th>&nbsp;</th>
					<th>&nbsp;</th>
						</thead>
				<tbody>
					<tr>
						<td class="gm">&nbsp;</td>
						<td class="gc bold"style="text-align: center" >L&iacute;mite</td>
						<td class="gc bold"style="text-align: center">&nbsp;&nbsp;&nbsp;Tasa&nbsp;&nbsp;&nbsp;</td>
						<td class="gc bold"style="text-align: center">Prima</td>
					</tr>';
        
        
        
                        $plantilla_grupo=new plantilla_grupo();//Se crea un objeto para saber que grupos tiene la plantilla
                        //Se hace la consulta a la base de datos
                        $grupos=$plantilla_grupo->find_re_plantilla_detalle_tipo_seguro($solicitud->cotizacion->id_flota, $solicitud->cotizacion->tipo_cobertura);
                        
                        
                        $tipo_seguro=new tipo_seguro();//Se crea un objeto tipo_seguro para obtener la descripción
                        //Se consulta a la base de datos
                        $cobertura_seguro=$tipo_seguro->find_by_id($solicitud->cotizacion->tipo_cobertura);
           
                        //Se crea un objeto para obtener el detalle de las coberturas de una plantilla
                        $plantilla_detalle=new re_plantilla_detalle_tipo_seguro();
                        //Variable para obtener la prima total
                        $suma_total=0;
                        
                        
                        foreach ($grupos as $grupo) {
                            
                           
                             $body_html=$body_html.'<tr>
                                                            <td class="gm bold" s>'.$grupo->descripcion.'</td>
                                                            <td class="gc clear-cobertura">&nbsp;</td>
                                                            <td class="gc">&nbsp;</td>
                                                            <td class="gc">&nbsp;</td>
                                                    </tr>';
                           
                            $detalles=$plantilla_detalle->find_re_plantilla_detalle_tipo_seguro($solicitud->cotizacion->id_flota, $solicitud->cotizacion->tipo_cobertura, $grupo->id_grupo);
                          //  var_dump($plantilla_detalle);
                            $suma_primas=0;
                            foreach ($detalles as $detalle){
                                
                                $tasa="";
                                $prima="";
                                $limite="";
                                $incluida="";
                                
                                foreach ($cotizacion_aseguradora->coberturas as $cobertura){
                                    
                                    if($cobertura->id_cob_as == $detalle->id_cobertura){
                                        
                                        if($cobertura->tasa != 0)$tasa=$cobertura->tasa." %";
                                        if($cobertura->prima != 0){
                                            $prima=formatMoney($cobertura->prima,true);
                                            $suma_primas=$suma_primas+$cobertura->prima;
                                        }
                                        if($cobertura->limite != 0)$limite=formatMoney($cobertura->limite,true);
                                        if($cobertura->incluida == 1)$incluida="incluida";
                                        break;
                                    }
                                }
                                
                                        $body_html=$body_html.'<tr>
                                                                        <td class="gm">'.$detalle->descripcion.'</td>
                                                                        <td class="gc right"><?php echo $limite; ?></td>
                                                                        <td class="gc">'.$tasa.'</td>
                                                                        <td class="gc" style="text-align: right">'.$prima.'</td>
                                                                </tr>';
                                
                                
                            }//End foreach plantilla_detalle
                           
                                        $body_html=$body_html.'<tr class="sub-total">
                                                                <td class="gm">&nbsp;</td>
                                                                <td colspan="2" class="sub bold">Sub-total</td>
                                                                <td class="total-cobertura bold" style="text-align: right">'.formatMoney($suma_primas,true).'</td>
                                                        </tr>';
                            
                            $suma_total=$suma_total+$suma_primas;
                        }//End foreach plantilla grupo
                
                     $body_html=$body_html.
                                        '</tbody>
				<tfoot class="gt">
					<tr>
                                                <td colspan="2">Prima Total <?php echo '.$cobertura_seguro[0]->nombre.'</td>
						<td colspan="2" class="right">Bs. <span class="total-prima" style="text-align: right">'.formatMoney($suma_total,true).'</span></td>
					</tr>
				</tfoot>
			</table>
                    </td>
                    </tr>
                    </tbody>
            </table>';
        
        sendMail($to, $to_name,$body_html,$redirect);
        


?>
