<?php
session_start();

$msg = "hide";
$msg_desc = "";
$msg_type = "succesfull";

$_SESSION['cargar_convenios']=1;
if (isset($_SESSION['msg'])) {
  if ($_SESSION['msg'] == "show") {
    $msg = "show";
    $msg_desc = $_SESSION['msg_desc'];
    $msg_type = $_SESSION['msg_type'];
  }
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Aon - Crear flota</title>
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link href="css/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css">
	<link href="css/normalize.css" rel="stylesheet" type="text/css">
	<link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div id="container">
		<div id="header">
			<a href="index.php">
				<img id="logo" src="img/logo.png">
			</a>
			<div id="top-nav"></div>
		</div>
		<div id="content">
			<div class="message hide"></div>
			<div id="left-nav">
				<ul>
					<li>
						<a href="clientes.php">Clientes</a>
					</li>
					<li>
						<a href="seguros.php">Seguros</a>
					</li>
					<li>
						<a href="coberturas.php">Coberturas</a>
					</li>
					<li class="current">
						<a href="convenios.php">Convenios</a>
					</li>
					<li>
						<a href="flotas.php">Flotas</a>
					</li>
					<li style="border: none;">
						<a href="cotizaciones.php">Cotizaciones</a>
					</li>
				</ul>
			</div>
			<div id="main">
				<div id="main-detail">
					<div id="nav-operations">
						<span class="title">Crear flota</span>
					</div>
					<div id="scroll" style="height: 455px;">
						<div style="margin-top: 30px">
							<form method="post" action="../php/operation/administration.php?operation_type=16&target=../../flota/cargar-convenios.php" onsubmit="return isValidateSubmit($(this))">
								<table>
									<tbody>
										<tr>
											<td>Nombre</td>
										</tr>
										<tr>
											<td>
												<input type="text" class="common-input is-required" name="nombre">
											</td>
										</tr>
										<tr>
											<td>Descripción</td>
										</tr>
										<tr>
											<td>
												<textarea class="common-input is-required" name="descripcion" style="height: 66px;"></textarea>
											</td>
										</tr>
										<tr>
											<td>Fecha de inicio</td>
										</tr>
										<tr>
											<td>
												<input type="text" class="common-input input-date datepicker">
												<span class="icon-calendar" style="margin-right: 10px"></span>
											</td>
										</tr>
										<tr>
											<td>Fecha de vencimiento</td>
										</tr>
										<tr>
											<td>
												<input type="text" class="common-input input-date datepicker">
												<span class="icon-calendar" style="margin-right: 10px"></span>
											</td>
										</tr>										
										<tr>
											<td>INMA (%)</td>
										</tr>
										<tr>
											<td>
												<div id="checkbox-wrapper">
													<div id="checkbox-list">
													<input type="checkbox" name="-15"><label>-15</label>
													<input type="checkbox" name="-10"><label>-10</label>
													<input type="checkbox"><label>-5</label>
													<input type="checkbox"><label>0</label>
													<input type="checkbox"><label>5</label>
													<input type="checkbox"><label>10</label>
													<input type="checkbox"><label>20</label>
													<input type="checkbox"><label>30</label>
												</div>
													</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="required hide">Uno o más campos son inválidos.</div>
											</td>
										</tr>
									</tbody>
								</table>
							</form>
						</div>
					</div>
				</div>
				<div id="footer">
					<div id="nav-step">
						<ul>
							<li>
								<input type="button" class="img-common icon-step icon-exit" value="Salir" onclick="Wizard.exit('flotas.php');">
							</li>
							<li>
								<a class='current-step' href="crear-flota.php">Crear flota</a>
							</li>
							<li>
								<span class="img-common arrow"></span>
							</li>
							<li>
								<a>Agregar convenios</a>
							</li>
							<li>
								<input id="next" type="button" class="img-common icon-step icon-next" value="Siguiente" role="create">
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="../plugins/jquery-1.10.2.min.js"></script>
	<script src="../plugins/jquery-ui-1.10.4.custom.min.js"></script>
	<script src="js/main.js"></script>
	<script>
		$(".datepicker").datepicker();
	</script>
</body>

</html>
<?php
$_SESSION['msg'] = "hide";
$_SESSION['msg_desc'] = "";
$msg_type = "succesfull";
?>
