<?phpsession_start();require_once("../php/db/config.php");require_once ('../php/db/database.php');require_once ('../php/entity/flota.php');$flota = unserialize($_SESSION['flota']);?><!DOCTYPE html><html>    <head>        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />        <title>Aon - Inicio</title>        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">        <link href="css/normalize.css" rel="stylesheet" type="text/css">        <link href="css/style.css" rel="stylesheet" type="text/css">    </head>    <body>        <div id="supper" class="separator"></div>        <div id="contenedor">            <div id="header">                <p class="menu"><a class="current" href="index.php?i=<?php echo $id_flota;?>">Inicio</a><span>│</span><a href="terminos.html" target="_blank" onClick="window.open(this.href, this.target, 'width=500, height = 400, resizable = 0');">Términos de Uso</a></p>                <p><a href="index.php?i=<?php echo $id_flota;?>"><img src="img/logo.png"></a></p>                <p><span>Aon Risk Services Venezuela Corretaje de Seguros, C.A. | RIF J-00067607-0 | Inscripción SAA N 102.</span></p>                <div class="exclusivo"></div>            </div>            <div id="contenido">                <h1 class="titulo line" style="width: 212px; margin-bottom: 60px;">COMPROBANTE Y CONTACTO</h1>                <div id="zurich" class="icono-aseguradora"></div>                <div id="detalle">                    <ul>                        <li><span class="italic">Zurich</span> </li>                        <li><span class="prima italic"><strong>BsF</strong>. 29.801,71</span></li>                        <li><span class="check"></span> </li>                    </ul>                </div>            </div>            <div id="footer">                <div class="separator"></div>                <div id="legal">                    <ul>                        <li>AON emite esta cotización a modo puramente referencial, a partir de los datos suministrados en línea; por lo tanto, la suma asegurada, tasas y demás rubros aquí previstos, pueden ser objeto de modificación con base en la documentación que efectivamente presente el Propuesto Tomador al solicitar formalmente la contratación de la póliza, la cual también dependerá de los resultados de inspección del vehículo.</li>                        <li>Esta cotización no implica que la aseguradora esté obligada a emitir la póliza, bajo éstas u otras condiciones.  Tampoco será responsable por los daños y perjuicios – materiales, morales y/o eventuales – derivados de la negativa a suscribir una póliza que asegure el riesgo a que se contrae esta cotización.</li>                        <li style="width: 220px;">Válida por siete (07) días contados a partir de la fecha de solicitud</li>                    </ul>                    <input type="button" class="boton boton-footer solicitar" style="width:" value="Solicitar poliza">                </div>            </div>        </div>    </div></div><script src="../plugins/jquery-1.10.2.min.js"></script> <script src="js/main.js"></script></body></html>