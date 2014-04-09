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
        <title>Aon - Lo sentimos, ha ocurrido un error</title>
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
        <link href="css/normalize.css" rel="stylesheet" type="text/css">
        <link href="css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="contenedor">
            <div id="supper" class="separator"></div>
            <div id="header">
                <div class="center">
                    <p class="menu"><a class="current" href="index.php?i=<?php echo $id_flota;?>">Inicio</a><span>│</span><a href="terminos.html" target="_blank" onClick="window.open(this.href, this.target, 'width=500, height=400, resizable=0');">Términos de Uso</a></p>
                    <p><a href="index.php?i=<?php echo $id_flota;?>"><img src="img/logo.png"></a></p>                
                    <p> <span>Aon Risk Services Venezuela Corretaje de Seguros, C.A. | RIF J-00067607-0 | Inscripción SAA N 102.</span> <span style="float: right; margin-top: -9px">Facilidad disponible para empleados de <img src="img/cliente/<?php echo $flota->avatar; ?>" width="24" height="24"></span> </p>
                    <div class="exclusivo"></div>
                </div>
            </div>
            <div id="contenido">
                <div class="center">
                    <p>Lo sentimos, ha ocurrido un error interno y en estos momentos no podemos realizar tu cotización. Por favor, intenta nuevamente. Si este error persiste, comunícate con nuestros Ejecutivos de Venta a los teléfonos <span class="red">212 4009324</span> | <span class="red">212 4009322</span>.</p>
                </div>
            </div>
            <div id="mensaje">
                <div class="center"> <span>&nbsp;</span> <span id="error" class="red pull-rigth hide"></span></div>
            </div>
            <div id="footer">
                <div class="center">
                    <div class="separator"></div>
                    <div id="legal">
                        <input type="button" class="boton boton-footer" value="ir al inicio" style="width: 100px; background-position: -10px 0px" onclick="location.href = 'index.php?i=<?php echo $flota->id; ?>'">
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>