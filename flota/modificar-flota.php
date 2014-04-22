<?php
session_start();
require_once("../php/db/config.php");
require_once ('../php/db/database.php');
require_once ('../php/entity/flota.php');
require_once ('../php/entity/inma_flota.php');

$msg = "hide";
$msg_desc = "";
$msg_type = "succesfull";

$_SESSION['cargar_convenios'] = 2;
if (isset($_SESSION['msg'])) {
    if ($_SESSION['msg'] == "show") {
        $msg = "show";
        $msg_desc = $_SESSION['msg_desc'];
        $msg_type = $_SESSION['msg_type'];
    }
}

$flota = new flota();

if (isset($_REQUEST['id'])) {

    $_SESSION["id_flota"] = $_REQUEST['id'];
    $flota->id = $_REQUEST['id'];
    $aux = $flota->find_by_id_flota();
    $inma_flota = new inma_flota();
    $inma_flota->id_flota = $flota->id;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Aon - Flotas</title>
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
        <link href="../plugins/css/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css">
        <link href="../plugins/css/normalize.css" rel="stylesheet" type="text/css">
        <link href="css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="container">
            <div id="header">
                <!--<a href="index.php"><img id="logo" src="img/logo.png"></a>-->
                <div id="top-nav"></div>
            </div>
            <div id="content">
                <div class="message hide"></div>
                <div id="left-nav">
                    <ul>
                        <li><a href="clientes.php">Clientes</a></li>
                        <li><a href="seguros.php">Seguros</a></li>
                        <li><a href="coberturas.php">Coberturas</a></li>
                        <li class="current"><a href="convenios.php">Convenios</a></li>
                        <li><a href="flotas.php">Flotas</a></li>
                        <li style="border: none;"><a href="cotizaciones.php">Cotizaciones</a></li>
                    </ul>
                </div>
                <div id="main">
                    <div id="main-detail">
                        <div id="nav-operations">
                            <span class="title">Modificar flota</span>
                        </div>
                        <div id="scroll" style="height: 455px;">
                            <div style="margin-top: 30px">
                                <form method="post" action="../php/operation/administration.php?operation_type=17&target=../../flota/cargar-convenios.php&target_fail=../../flota/modificar-flota.php?id=<?php echo $_REQUEST['id']; ?>" onsubmit="return isValidateSubmit($(this))">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Nombre</td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" class="common-input is-required" name="nombre" value="<?php echo $aux[0]->empresa; ?>"></td></td>
                                            </tr>
                                            <tr>
                                                <td>Descripción</td>
                                            </tr>
                                            <tr>
                                                <td><textarea class="common-input is-required" name="descripcion" style="height: 66px;"><?php echo $aux[0]->descripcion; ?></textarea></td>
                                            </tr>
                                            <tr>
                                                <td>Fecha de inicio</td>
                                            <tr>
                                                <td>
                                                    <input id="fecha-inicio" type="text" name="fecha-inicio" value="<?php
                                                    $dt_inicio = DateTime::createFromFormat("Y-m-d", $aux[0]->validez_inicio);
                                                    echo $dt_inicio->format("d/m/Y");
                                                    ?>" class="common-input input-date datepicker is-required">
                                                    <span class="icon-calendar" style="margin-right: 10px"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Fecha de vencimiento</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input id="fecha-fin" type="text" name="fecha-fin" value="<?php
                                                    $dt_fin = DateTime::createFromFormat("Y-m-d", $aux[0]->validez_fin);
                                                    echo $dt_fin->format("d/m/Y");
                                                    ?>"  class="common-input input-date datepicker is-required">
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
                                                            <?php
                                                            $inma_flota->inma = "-15";
                                                            $result = $inma_flota->find_inma_flota_valid();
                                                            $check = (sizeof($result) > 0) ? " checked" : "";
                                                            ?>
                                                            <input type="checkbox" name="inma[]" value="-15"<?php echo $check; ?>><label>-15</label>
                                                            <?php
                                                            $inma_flota->inma = "-10";
                                                            $result = $inma_flota->find_inma_flota_valid();
                                                            $check = (sizeof($result) > 0) ? " checked" : "";
                                                            ?>
                                                            <input type="checkbox" name="inma[]" value="-10"<?php echo $check; ?>><label>-10</label>
                                                            <?php
                                                            $inma_flota->inma = "-5";
                                                            $result = $inma_flota->find_inma_flota_valid();
                                                            $check = (sizeof($result) > 0) ? " checked" : "";
                                                            ?>
                                                            <input type="checkbox" name="inma[]" value="-5"<?php echo $check; ?>><label>-5</label>
                                                            <?php
                                                            $inma_flota->inma = "0";
                                                            $result = $inma_flota->find_inma_flota_valid();
                                                            $check = (sizeof($result) > 0) ? " checked" : "";
                                                            ?>
                                                            <input type="checkbox" name="inma[]" value="0"<?php echo $check; ?>><label>0</label>
                                                            <?php
                                                            $inma_flota->inma = "5";
                                                            $result = $inma_flota->find_inma_flota_valid();
                                                            $check = (sizeof($result) > 0) ? " checked" : "";
                                                            ?>
                                                            <input type="checkbox" name="inma[]" value="5"<?php echo $check; ?>><label>5</label>
                                                            <?php
                                                            $inma_flota->inma = "10";
                                                            $result = $inma_flota->find_inma_flota_valid();
                                                            $check = (sizeof($result) > 0) ? " checked" : "";
                                                            ?>
                                                            <input type="checkbox" name="inma[]" value="10"<?php echo $check; ?>><label>10</label>
                                                            <?php
                                                            $inma_flota->inma = "20";
                                                            $result = $inma_flota->find_inma_flota_valid();
                                                            $check = (sizeof($result) > 0) ? " checked" : "";
                                                            ?>
                                                            <input type="checkbox" name="inma[]" value="20"<?php echo $check; ?>><label>20</label>
                                                            <?php
                                                            $inma_flota->inma = "30";
                                                            $result = $inma_flota->find_inma_flota_valid();
                                                            $check = (sizeof($result) > 0) ? " checked" : "";
                                                            ?>
                                                            <input type="checkbox" name="inma[]" value="30"<?php echo $check; ?>><label>30</label>
                                                            <?php
                                                            $inma_flota->inma = "35";
                                                            $result = $inma_flota->find_inma_flota_valid();
                                                            $check = (sizeof($result) > 0) ? " checked" : "";
                                                            ?>
                                                            <input type="checkbox" name="inma[]" value="35"<?php echo $check; ?>><label>35</label>
                                                            <?php
                                                            $inma_flota->inma = "40";
                                                            $result = $inma_flota->find_inma_flota_valid();
                                                            $check = (sizeof($result) > 0) ? " checked" : "";
                                                            ?>
                                                            <input type="checkbox" name="inma[]" value="40"<?php echo $check; ?>><label>40</label>
                                                            <?php
                                                            $inma_flota->inma = "45";
                                                            $result = $inma_flota->find_inma_flota_valid();
                                                            $check = (sizeof($result) > 0) ? " checked" : "";
                                                            ?>
                                                            <input type="checkbox" name="inma[]" value="45"<?php echo $check; ?>><label>45</label>
                                                            <?php
                                                            $inma_flota->inma = "50";
                                                            $result = $inma_flota->find_inma_flota_valid();
                                                            $check = (sizeof($result) > 0) ? " checked" : "";
                                                            ?>
                                                            <input type="checkbox" name="inma[]" value="50"<?php echo $check; ?>><label>50</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><div class="required hide">Uno o más campos son inválidos.</div></td>
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
                                <li><input type="button" class="img-common icon-step icon-exit" value="Salir" onclick="Wizard.exit('flotas.php');"></li>
                                <li><a class='current-step' href="modificar-flota.php?id=<?php echo $flota->id ?>">Modificar flota</a></li>
                                <li><span class="img-common arrow"></span></li>                      
                                <li><a>Asociar convenios</a></li>
                                <li><input id="next" type="button" class="img-common icon-step icon-next" value="Siguiente" role="checks"></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
        <script src="../plugins/js/jquery-1.10.2.min.js"></script>
        <script src="../plugins/js/jquery-ui-1.10.4.custom.min.js"></script>
        <script src="js/main.js"></script>
        <script>
                                    $("#fecha-inicio").datepicker({
                                        dateFormat: "dd/mm/yy",
                                        onSelect: function(selected) {
                                            $("#fecha-fin").datepicker("option", "minDate", selected);
                                        }
                                    });
                                    $("#fecha-fin").datepicker({
                                        dateFormat: "dd/mm/yy",
                                        onSelect: function(selected) {
                                            $("#fecha-inicio").datepicker("option", "maxDate", selected);
                                        }
                                    });
        </script>
    </body>
</html>
<?php
$_SESSION['msg'] = "hide";
$_SESSION['msg_desc'] = "";
$msg_type = "succesfull";
?>
