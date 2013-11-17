<?php
session_start();

    require_once("../php/db/config.php");
    require_once ('../php/db/database.php');
    require_once ('../php/entity/aseguradora.php');   
    
        $aseguradora=new aseguradora();
        $aseguradoras=$aseguradora->find_all();
       
        
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Aon - Seguros</title>
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
<link href="css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css">
<link href="css/normalize.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<body>
  <div id="dialog">   
    <table align="center" width="360">
      <tbody>
        <tr>
          <td>Nombre</td>
        </tr>
        <tr>
          <td><input type="text" class="common-input" name="nombre_cliente" id="nombre-cliente"></td></td>
        </tr>
         <tr>
          <td>Razón Social</td>
        </tr>
        <tr>
          <td><input type="text" class="common-input" name="rs_cliente" id="rs-cliente"></td></td>
        </tr>        
      </tbody>
      <tfoot>
        <tr>
          <td>    
            <div class="buttons-panel">
              <input type="button" class="common-button" value="Guardar">
              <input type="button" id="close-dialog" class="common-button" value="Salir" > 
            </div> 
          </td>
        </tr>
      </tfoot>
    </table> 
  </div>
  <div id="container">
    <div id="header">
      <img id="logo" src="img/logo.png">
      <div id="top-nav"></div>
    </div>
    <div id="content">
      <div class="message">Ocurrio un error mientras se cargaba el seguro. Por favor intente mas tarde. Si el error persiste, comuniquese con el administrador del sistema.</div>
      <div id="left-nav">
        <ul>
          <li><a href="clientes.php">Clientes</a></li>
          <li class="current"><a href="seguros.php">Seguros</a></li>
          <li><a href="coberturas.php">Coberturas</a></li>
          <li><a href="convenios.php">Convenios</a></li>
          <li><a href="flotas.php">Flotas</a></li>
          <li style="border: none;"><a href="Cotizaciones">Cotizaciones</a></li>
        </ul>
      </div>
      <div id="main">
        <div id="main-detail">
          <div id="nav-operations">
            <span class="title">Seguros</span>  
            <input type="button" id="open-dialog" class="add-button" value="Nuevo seguro">
          </div>
          <div id="scroll-panel">
            <table class="tbl-details" cellspacing="0" borderspacing="0">
              <tbody>
<?php
 
          if(sizeof($aseguradoras) > 0){
              
              foreach ($aseguradoras as $value) {         
 ?>
                  <tr>
                  <td>
                    <div class="item">
                      <p class="item-title"><?php echo $value->nombre; ?></p>
                      <p clas="item-sub-title"><?php echo $value->razon_social; ?></p>
                      <p class="separator"></p>
                      <p class="item-info">Fecha de creación: <span><?php echo $value->cr_time; ?></span></p>
                      <p class="item-info">Última modificación: <span><?php echo $value->ut_time; ?></span></p>
                      <div class="options">
                        <input type="button" id-item="<?php echo $value->id; ?>" class="icon-operation icon-modified">
                        <input type="button" id-item="<?php echo $value->id; ?>" class="icon-operation icon-delete">
                      </div>
                    </div>
                  </td>
                </tr>
<?php
              }
          }
 ?>               
              </tbody>
            </table>
          </div>
         </div>
      </div>
      </div>
  </div>
  <div id="footer"></div>
  <script src="../plugins/jquery-1.10.2.min.js"></script>  
  <script src="../plugins/jquery-ui-1.10.3.custom.min.js"></script>
  <script src="js/snippet.js"></script>
  <script src="js/function.js"></script>
</body>