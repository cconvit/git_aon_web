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
require_once ('tool/function_tool.php');
require_once ('../php/entity/parametros.php');
require_once ('../php/entity/flota.php');

$solicitud = unserialize($_SESSION['solicitud']);
$flota = unserialize($_SESSION['flota']);

if ($solicitud != null) {
  ?>
  <!DOCTYPE html>
  <html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <title>Aon - Aseguradoras</title>
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
            <p class="menu"><a class="current" href="index.php">Inicio</a><span>│</span><a href="terminos.html" target="_blank" onClick="window.open(this.href, this.target, 'width=500, height=400, resizable=0');
                  return false;">Términos de Uso</a></p>
            <p><a href="index.php"><img src="img/logo.png"></a></p>
            <p><span>Aon Risk Services Venezuela Corretaje de Seguros, C.A. | RIF J-00067607-0 | Inscripción SAA N 102.</span></p>
            <div class="exclusivo"></div>
          </div>
        </div>
        <div id="contenido">
          <div class="center">
            <form id="form-aseguradoras" method="POST" action="cotizacion.php">
              <div id="lista-aseguradoras">
                <p style="text-align:center">Seleccione una o más aseguradoras.</p>
                <ul style="margin-top: 40px">
                  <?php
                  foreach ($solicitud->res_clasificacion as $aseguradora) {
                    $datos = get_data_aseguradora($aseguradora->id_aseguradora);
                    ?>
                    <li>
                      <div id="<?php echo $datos["id"]; ?>" class="icono-aseguradora" data="<?php echo $aseguradora->id_aseguradora; ?>"></div>
                      <div><?php echo $datos["name"]; ?></div>
                    </li>
                    <?php
                  }
                  ?>
                </ul>
              </div>
              <input type="hidden" id="aseguradoras" name="aseguradoras" value="">
            </form>
          </div>
        </div>
        <div id="mensaje">
          <div class="center"> <span>&nbsp;</span> <span id="error" class="red pull-rigth hide"></span> </div>
        </div>
        <div id="footer">
          <div class="center">
            <div class="separator"></div>
            <div id="legal">
              <ul>
                <li>Las siguientes son las aseguradoras que cotizan automáticamente el seguro de tu vehículo al completar el formulario. Haga clic en la(s) de su preferencia. Simplemente completa esta solicitud de información para obtener la comparación de los seguros de tu vehículo.</li>
                <li>Luego encuentra el que mejor cumpla con tus necesidades. Con más ofertas de seguros para comparar, estamos seguros que te podemos ayudar a obtener la mejor cobertura para tu vehículo.</li>
                <li style="width: 220px;">Conozca en pocos segundos/minutos los precios de las pólizas de seguro para su vehículo, compare aseguradoras, asistencias y servicios para escoger el seguro que mejor se adapte a sus necesidades. Si Ud. desea cotizar con alguna empresa aseguradora que no aparezca en el listado anterior, no dude en <a href="file:///Macintosh HD/Users/crivera/Google Drive/AON/contactanos.html">contactarnos</a>.</li>
              </ul>
              <input type="button" id="btn-cotizar" class="boton boton-footer" value="Siguiente">
            </div>
          </div>
        </div>
      </div>
      <script src="../plugins/js/jquery-1.10.2.min.js"></script>
      <script src="../plugins/js/jquery-ui-1.10.4.custom.min.js"></script>
      <script src="js/main.js"></script>
    </body>
  </html>
  <?php
} else
  echo "mensaje de error";
?>
