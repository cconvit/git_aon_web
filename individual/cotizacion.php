<?phpsession_start();      require_once ('../php/db/database.php');      require_once ('../php/entity/cotizacion.php');      require_once ('../php/operation/solicitud.php');      require_once ('../php/operation/calcular_primas.php');      require_once ('../php/entity/flota.php');      require_once ('../php/entity/clasificacion.php');      require_once ('../php/entity/re_tipo_cobertura_aseguradora.php');      require_once ('../php/entity/parametros.php');      require_once ('../php/entity/plantilla_grupo.php');      require_once ('../php/entity/re_plantilla_detalle_tipo_seguro.php');      require_once ('tool/function_tool.php');      require_once ('../php/entity/tipo_seguro.php');      $solicitud=  unserialize($_SESSION['solicitud']);$var_aseguradoras=$_POST['aseguradoras'];if(isset($solicitud) && isset($var_aseguradoras)){               $var_aseguradoras=  urldecode($var_aseguradoras);                     $aseguradoras=  explode(",", $var_aseguradoras);           //$aseguradoras=array();                        //$aseguradoras[0]="1";            //$aseguradoras[1]="2";                      $solicitud->calcular_primas($aseguradoras);            $plantilla_grupo=new plantilla_grupo();            $grupos=$plantilla_grupo->find_re_plantilla_detalle_tipo_seguro($solicitud->cotizacion->id_flota, $solicitud->cotizacion->tipo_cobertura);                       $tipo_seguro=new tipo_seguro();           $cobertura_seguro=$tipo_seguro->find_by_id($solicitud->cotizacion->tipo_cobertura);                     //  var_dump($solicitud);           // echo $solicitud->re_aseguradora_cotizacion[0]->coberturas[1]->prima;            ?><!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><title>Aon - Inicio</title><link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"><link href="css/normalize.css" rel="stylesheet" type="text/css"><link href="css/style.css" rel="stylesheet" type="text/css"></head><body><div id="contenedor">	<div id="supper" class="separator"></div>	<div id="header">		<div class="center">			<p class="menu"><a class="current" href="index.php">Inicio</a> <span>│</span> <a href="terminos.html">Términos de Uso</p>			<p><a href="index.php"><img src="img/logo.png"></a></p>			<p> <span>Aon Risk Services Venezuela Corretaje de Seguros, C.A. | RIF J-00067607-0 | Inscripción SAA N 102.</span> <span style="float: right; margin-top: -9px">Uso excusivo de <img src="img/gm.png" width="24" height="24"></span> </p>			<div class="exclusivo"></div>		</div>	</div>	<div id="contenido">		<div class="center">                    <?php                                        foreach ($solicitud->re_aseguradora_cotizacion as $cotizacion_aseguradora){                                              ?>                         <table class="tbl-cotizacion" width="615" border="0" cellspacing="0" cellpadding="0">				<thead class="gt">				<th width="255"><?php echo $cotizacion_aseguradora->as_nombre; ?></th>					<th width="128">&nbsp;</th>					<th>&nbsp;</th>					<th>&nbsp;</th>						</thead>				<tbody>					<tr>						<td class="gm">&nbsp;</td>						<td class="gc bold"style="text-align: center" >L&iacute;mite</td>						<td class="gc bold"style="text-align: center">&nbsp;&nbsp;&nbsp;Tasa&nbsp;&nbsp;&nbsp;</td>						<td class="gc bold"style="text-align: center">Prima</td>					</tr>                       <?php                        $plantilla_detalle=new re_plantilla_detalle_tipo_seguro();                        $suma_total=0;                                                foreach ($grupos as $grupo) {                                                        ?>                                        <tr>						<td class="gm bold" s><?php echo $grupo->descripcion; ?></td>						<td class="gc clear-cobertura">&nbsp;</td>						<td class="gc">&nbsp;</td>						<td class="gc">&nbsp;</td>					</tr>                            <?php                            $detalles=$plantilla_detalle->find_re_plantilla_detalle_tipo_seguro($solicitud->cotizacion->id_flota, $solicitud->cotizacion->tipo_cobertura, $grupo->id_grupo);                          //  var_dump($plantilla_detalle);                            $suma_primas=0;                            foreach ($detalles as $detalle){                                                                $tasa="";                                $prima="";                                $limite="";                                $incluida="";                                                                foreach ($cotizacion_aseguradora->coberturas as $cobertura){                                                                        if($cobertura->id_cob_as == $detalle->id_cobertura){                                                                                if($cobertura->tasa != 0)$tasa=$cobertura->tasa." %";                                        if($cobertura->prima != 0){                                            $prima=formatMoney($cobertura->prima,true);                                            $suma_primas=$suma_primas+$cobertura->prima;                                        }                                        if($cobertura->limite != 0)$limite=formatMoney($cobertura->limite,true);                                        if($cobertura->incluida == 1)$incluida="incluida";                                        break;                                    }                                }                                ?>                                        <tr>						<td class="gm"><?php echo $detalle->descripcion; ?></td>						<td class="gc right"><?php echo $limite; ?></td>						<td class="gc"><?php echo $tasa; ?></td>						<td class="gc" style="text-align: right"><?php echo $prima; ?></td>					</tr>                                <?php                                                            }//End foreach plantilla_detalle                           ?>                                         <tr class="sub-total">						<td class="gm">&nbsp;</td>						<td colspan="2" class="sub bold">Sub-total</td>						<td class="total-cobertura bold" style="text-align: right"><?php echo formatMoney($suma_primas,true);?></td>					</tr>                            <?php                            $suma_total=$suma_total+$suma_primas;                        }//End foreach plantilla grupo                             ?>                                        </tbody>				<tfoot class="gt">					<tr>                                                <td colspan="2">Prima Total <?php echo $cobertura_seguro[0]->nombre;?></td>						<td colspan="2" class="right">Bs. <span class="total-prima" style="text-align: right"><?php echo formatMoney($suma_total,true); ?></span></td>					</tr>				</tfoot>			</table>                    <?php                                                                                                          }  //End foreach aseguradora cotizada                      ?>						</div>	</div>	<div id="mensaje">		<div class="center"></div>	</div>	<div id="footer">		<div class="center">			<div id="legal">				<input type="button" class="boton boton-footer" value="Siguiente">			</div>		</div>	</div></div><script src="../plugins/jquery-1.10.2.min.js"></script> <script src="js/main.js"></script></body></html><?php}            ?>