<?php
session_start();

require_once("../php/db/config.php");
require_once ('../php/db/database.php');
require_once ('../php/entity/flota.php');

$flota = unserialize($_SESSION['flota']);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Aon - Contáctanos</title>
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
        <link href="css/normalize.css" rel="stylesheet" type="text/css">
        <link href="css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="contenedor">
            <div id="supper" class="separator"></div>
            <div id="header">
                <div class="center">
                    <p class="menu"><a class="current" href="index.php?i=<?php echo $flota->id;?>">Inicio</a><span>│</span><a href="terminos.html" target="_blank" onClick="window.open(this.href, this.target, 'width=500, height=400, resizable=0');">Términos de Uso</a></p>
                    <p><a href="index.php?i=<?php echo $flota->id;?>"><img src="img/logo.png"></a></p>
                    <p> <span>Aon Risk Services Venezuela Corretaje de Seguros, C.A. | RIF J-00067607-0 | Inscripción SAA N 102.</span></p>
                    <div class="exclusivo"></div>
                </div>
            </div>
            <div id="contenido">
                <div class="center">
                    <p>No hemos encontrado aseguradoras para cotizar tu vehículo según la informacioón suministrada. Por favor, contacta a un Ejecutivo de Ventas a los teléfonos 212 4009324 | 212 4009322 o por correo electrónico a la cuenta ve.solicito.cotizacion@aon.com</p>
                </div>
            </div>
            <div id="mensaje">
                <div class="center"> <span>&nbsp;</span> <span id="error" class="red pull-rigth hide"></span></div>
            </div>
            <div id="footer">
                <div class="center">
                    <div class="separator"></div>
                    <div id="legal">
                        <input type="button" class="boton boton-footer" value="ir al inicio" style="width: 100px; background-position: -10px 0px" onclick="location.href = 'index.php'">
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>