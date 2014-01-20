<p>Gracias por cotizar con nosotros. En la brevedad un Ejecutivo de Atención al Cliente se comunicará con usted. Si desea contactarnos directamente lo puede hacer a través de los teléfonos 212 4009324 | 212 4009322 o por correo electrónico a la cuenta ve.solicito.cotizacion@aon.com</p>
<br />
<table class="tbl-content" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td><table class="tbl-cotizacion" width="615" border="0" cellspacing="0" cellpadding="0"> 
          <thead class="gt">
            <tr> 
              <th width="255">'.$cotizacion_aseguradora->as_nombre.'</th> 
              <th width="128">&nbsp;</th> 
              <th>&nbsp;</th> <th>&nbsp;</th> 
            </tr>
          </thead> 
          <tbody> 
            <tr> 
              <td class="gm">&nbsp;</td> 
              <td class="gc bold"style="text-align: center" >L&iacute;mite</td> 
              <td class="gc bold"style="text-align: center">&nbsp;&nbsp;&nbsp;Tasa&nbsp;&nbsp;&nbsp;</td> 
              <td class="gc bold"style="text-align: center">Prima</td>
            </tr>;
            $plantilla_grupo=new plantilla_grupo();
            $grupos=$plantilla_grupo->find_re_plantilla_detalle_tipo_seguro($solicitud->cotizacion->id_flota, $solicitud->cotizacion->tipo_cobertura);
            $tipo_seguro=new tipo_seguro();
            $cobertura_seguro=$tipo_seguro->find_by_id($solicitud->cotizacion->tipo_cobertura);
            $plantilla_detalle=new re_plantilla_detalle_tipo_seguro(); 
            $suma_total=0;
            foreach ($grupos as $grupo) {
            $body_html=$body_html.'<tr> <td class="gm bold" s>'.$grupo->descripcion.'</td> <td class="gc clear-cobertura">&nbsp;</td> <td class="gc">&nbsp;</td> <td class="gc">&nbsp;</td> </tr>';
            $detalles=$plantilla_detalle->find_re_plantilla_detalle_tipo_seguro($solicitud->cotizacion->id_flota, $solicitud->cotizacion->tipo_cobertura, $grupo->id_grupo); 
            $suma_primas=0; foreach ($detalles as $detalle){
            $tasa=""; $prima=""; $limite="";
            foreach ($cotizacion_aseguradora->coberturas as $cobertura){
            if($cobertura->id_cob_as == $detalle->id_cobertura){
            if($cobertura->tasa != 0)$tasa=$cobertura->tasa." %"; if($cobertura->prima != 0){ $prima=formatMoney($cobertura->prima,true); $suma_primas=$suma_primas+$cobertura->prima; } if($cobertura->limite != 0)$limite=formatMoney($cobertura->limite,true); if($cobertura->incluida == 1)$prima="INCLUIDA"; break; } }

            $body_html=$body_html.'<tr> <td class="gm">'.$detalle->descripcion.'</td> <td class="gc right">'.$limite.'</td> <td class="gc">'.$tasa.'</td> <td class="gc" style="text-align: right">'.$prima.'</td> </tr>';

            }//End foreach plantilla_detalle

            $body_html=$body_html.'<tr class="sub-total"> <td class="gm">&nbsp;</td> <td colspan="2" class="sub bold">Sub-total</td> <td class="total-cobertura bold" style="text-align: right">'.formatMoney($suma_primas,true).'</td> </tr>';

            $suma_total=$suma_total+$suma_primas; }//End foreach plantilla grupo

            $body_html=$body_html. '</tbody> <tfoot class="gt"> <tr> <td colspan="2">Prima Total '.$cobertura_seguro[0]->nombre.'</td> <td colspan="2" class="right">Bs. <span class="total-prima" style="text-align: right">'.formatMoney($suma_total,true).'</span></td> </tr> </tfoot> </table> </td> </tr> </tbody> </table>';
try{	
sendMail($to, $to_name,$body_html,$redirect,$error);
} 
catch (Exception $e) {
echo 'Caught exception: ',  $e->getMessage(), "\n";
}