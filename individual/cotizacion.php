<?php
	session_start();
	require_once("../php/db/config.php");
	require_once ('../php/db/database.php');
	require_once ('../php/entity/cotizacion.php');
	require_once ('../php/operation/solicitud.php');
	require_once ('../php/operation/calcular_primas.php');
	require_once ('../php/entity/flota.php');
	require_once ('../php/entity/clasificacion.php');
	require_once ('../php/entity/re_tipo_cobertura_aseguradora.php');
	require_once ('../php/entity/parametros.php');
	require_once ('../php/entity/plantilla_grupo.php');
	require_once ('../php/entity/re_plantilla_detalle_tipo_seguro.php');
	require_once ('tool/function_tool.php');
	require_once ('../php/entity/tipo_seguro.php');
  require_once ('../php/entity/grua.php');
  require_once ('../php/entity/segmentacion.php');
	require_once ('../php/entity/flota.php');
        
  $flota=unserialize($_SESSION['flota']);
	$solicitud=  unserialize($_SESSION['solicitud']);
	$var_aseguradoras=$_POST['aseguradoras'];
	if(isset($solicitud) && isset($var_aseguradoras)){
		$var_aseguradoras=  urldecode($var_aseguradoras);
		$aseguradoras=  explode(",", $var_aseguradoras);
		$solicitud->calcular_primas($aseguradoras);
		$_SESSION['solicitud']=serialize($solicitud);
		$plantilla_grupo=new plantilla_grupo();
		$grupos=$plantilla_grupo->find_re_plantilla_detalle_tipo_seguro($solicitud->cotizacion->id_flota, $solicitud->cotizacion->tipo_cobertura);		
		$tipo_seguro=new tipo_seguro();
		$cobertura_seguro=$tipo_seguro->find_by_id($solicitud->cotizacion->tipo_cobertura);		         
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Aon - Cotización</title>
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
<link href="css/normalize.css" rel="stylesheet" type="text/css">
<link href="css/jquery-ui-1.10.3.custom.min" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="dialog">
<p class="dialog-message">Estamos cotizando su vehículo. Esta operación puede durar unos minutos, por favor espere.</p>
<p style="text-align: center"><img src="img/loader.gif" width="30" height="30"></p>
</div>
<div id="contenedor">
	<div id="supper" class="separator"></div>
	<div id="header">
		<div class="center">
			<p class="menu"><a class="current" href="index.php">Inicio</a><span>│</span><a href="terminos.html" target="_blank" onClick="window.open(this.href, this.target, 'width=500, height=400, resizable=0'); return false;">Términos de Uso</a></p>
			<p><a href="index.php"><img src="img/logo.png"></a></p>
			<p> <span>Aon Risk Services Venezuela Corretaje de Seguros, C.A. | RIF J-00067607-0 | Inscripción SAA N 102.</span> <span style="float: right; margin-top: -9px">Facilidad disponible para empleados de <img src="img/cliente/<?php echo $flota->avatar;?>" width="24" height="24"></span> </p>
			<div class="exclusivo"></div>
		</div>
	</div>
	<div id="contenido">
		<div class="center">
			<p style="text-align:center">Selecciona una cotización.</p>
			<div id="lista-cotizacion">
				<?php foreach ($solicitud->re_aseguradora_cotizacion as $cotizacion_aseguradora){?>
				<form id="form-cotizacion" method="post" action="ws/enviarCotizacion.php">
					<table class="tbl-content" border="0" cellspacing="0" cellpadding="0">
						<tbody>
							<tr>
								<td><table class="tbl-cotizacion" width="615" border="0" cellspacing="0" cellpadding="0">
										<thead class="gt">
										<th width="255"><?php echo $cotizacion_aseguradora->as_nombre; ?></th>
											<th width="128">&nbsp;</th>
											<th>&nbsp;</th>
											<th>&nbsp;</th>
												</thead>
										<tbody>
											<tr>
												<td class="gm">&nbsp;</td>
												<td class="gc bold italic"style="text-align: right">L&iacute;mite</td>
												<td class="gc bold italic italic"style="text-align: right">&nbsp;&nbsp;&nbsp;Tasa&nbsp;&nbsp;&nbsp;</td>
												<td class="gc bold italic"style="text-align: right">Prima</td>
											</tr>
											<?php
												$plantilla_detalle=new re_plantilla_detalle_tipo_seguro();
												$suma_total=0;
												foreach ($grupos as $grupo) {
											?>
											<tr>
												<td class="gm bold italic"><?php echo $grupo->descripcion; ?></td>
												<td class="gc clear-cobertura">&nbsp;</td>
												<td class="gc">&nbsp;</td>
												<td class="gc">&nbsp;</td>
											</tr>
											<?php
												$detalles=$plantilla_detalle->find_re_plantilla_detalle_tipo_seguro($solicitud->cotizacion->id_flota, $solicitud->cotizacion->tipo_cobertura, $grupo->id_grupo);
												//  var_dump($plantilla_detalle);
												$suma_primas=0;
												foreach ($detalles as $detalle){
														$tasa="";
														$prima="";
														$limite="";
														
														foreach ($cotizacion_aseguradora->coberturas as $cobertura){													
																if($cobertura->id_cob_as == $detalle->id_cobertura){
																		
																		if($cobertura->tasa != 0)$tasa=$cobertura->tasa." %";
																		if($cobertura->prima != 0){
																				$prima=formatMoney($cobertura->prima,true);
																				$suma_primas=$suma_primas+$cobertura->prima;
																		}
																		if($cobertura->limite != 0)$limite=formatMoney($cobertura->limite,true);
																		if($cobertura->incluida == 1)$prima="INCLUIDA";
																		break;
																}
														}
											?>
											<tr>
												<td class="gm"><?php echo $detalle->descripcion; ?></td>
												<td class="gc right italic"><?php echo $limite; ?></td>
												<td class="gc italic"><?php echo $tasa; ?></td>
												<td class="gc italic" style="text-align: right"><?php echo $prima; ?></td>
											</tr>
											<?php            
											 }//End foreach plantilla_detalle
											?>
											<tr class="sub-total">
												<td class="gm">&nbsp;</td>
												<td colspan="2" class="sub bold italic">Sub-total</td>
												<td class="total-cobertura bold italic" style="text-align: right"><?php echo formatMoney($suma_primas,true);?></td>
											</tr>
											<?php
											$suma_total=$suma_total+$suma_primas;
											}//End foreach plantilla grupo
										?>
										</tbody>
										<tfoot class="gt">
											<tr>
												<td colspan="2">Prima Total <?php echo $cobertura_seguro[0]->nombre;?></td>
												<td colspan="2" class="right">Bs. <span class="total-prima" style="text-align: right"><?php echo formatMoney($suma_total,true); ?></span></td>
											</tr>
										</tfoot>
									</table></td>
								<?php 
									$datos=get_data_aseguradora($cotizacion_aseguradora->id_aseguradora);
								?>
								<td>
                  <div class="logo-select">
										<div id="<?php echo $datos["id"];?>" data="<?php echo $cotizacion_aseguradora->id_aseguradora;?>" class="icono-aseguradora"></div>
										<div><?php echo $datos["name"];?></div>
									</div>
                </td>
							</tr>
						</tbody>
					</table>
					<br/>
					<br />
					<?php
					}
					//End foreach aseguradora cotizada  
					?>
					<input id="cotizacion" type="hidden" value="">
				</form>
			</div>
		</div>
	</div>
<div id="mensaje">
		<div class="center"><span style="display: inline-block;">&nbsp;</span><span id="error" class="red pull-rigth hide"></span> </div>
	</div>
	<div id="footer">
		<div class="center">
			<div class="separator"></div>
			<div id="legal">
				<ul>
					<li>Aon emite esta cotización a modo puramente referencial, a partir de los datos suministrados en línea; por lo tanto, la suma asegurada, tasas y demás rubros aquí previstos, pueden ser objeto de modificación con base en la documentación que efectivamente presente el Propuesto Tomador</li>
					<li>al solicitar formalmente la contratación de la póliza, la cual también dependerá de los resultados de inspección del vehículo. Esta cotización no implica que la aseguradora esté obligada a emitir la póliza, bajo éstas u otras condiciones.</li>
					<li style="width: 220px;">Tampoco será responsable por los daños y perjuicios – materiales, morales y/o eventuales – derivados de la negativa a suscribir una póliza que asegure el riesgo a que se contrae esta cotización. Válida por siete (07) días contados a partir de la fecha de solicitud.  </li>
				</ul>
				<input type="button" id="btn-enviar" class="boton boton-footer" value="Solcitar poliza" style="width: 125px; background-position: 15px 0px">
			</div>
		</div>
	</div>
</div>
<script src="../plugins/jquery-1.10.2.min.js"></script>
<script src="../plugins/jquery-ui-1.10.3.custom.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
<?php
}
?>