<?php
session_start();
session_destroy();
session_start();
$id_flota = $_GET['i'];

if (isset($id_flota)) {
  require_once("../php/db/config.php");
  require_once ('../php/db/database.php');
  require_once ('../php/entity/flota.php');
  $flota = new flota();
  $flota->id = $id_flota;
  $result = $flota->find_by_id_flota();

  if (sizeof($result) > 0) {

    $_SESSION['flota'] = serialize($result[0]);
    ?>
    <!DOCTYPE html>
    <html>
      <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Aon - Inicio</title>
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
        <link href="../plugins/css/normalize.css" rel="stylesheet" type="text/css">
        <link href="css/style.css" rel="stylesheet" type="text/css">
      </head>
      <body>
        <div id="contenedor">
          <div id="supper" class="separator"></div>
          <div id="header">
            <div class="center">
              <p class="menu"><a class="current" href="index.php">Inicio</a><span> │ </span><a href="terminos.html" target="_blank" onClick="window.open(this.href, this.target, 'width=500, height=400, resizable=0');
                  return false;">Términos de Uso</a></p>
              <p><a href="index.php"><img src="img/logo.png"></a></p>
              <p><span>Aon Risk Services Venezuela Corretaje de Seguros, C.A. | RIF J-00067607-0 | Inscripción SAA N 102.</span></p>
              <div class="exclusivo"></div>
            </div>
          </div>
          <div id="contenido">
            <div class="center">
              <form id="form-datos" action="ws/validador.php" method="POST">
                <ul>
                  <li style="margin-right: 165px">
                    <h1 class="titulo line">DATOS DE CONTACTO</h1>
                    <table class="tbl-datos">
                      <tr>
                        <td>Nombre completo</td>
                      </tr>
                      <tr>
                        <td class="padding"><input type="text" class="required" name="nombre"></td>
                      </tr>
                      <tr>
                        <td><div class="clear"></div></td>
                      </tr>
                      <tr>
                        <td>Cédula</td>
                      </tr>
                      <tr>
                        <td class="padding"><input type="text" class="required" name="cedula"></td>
                      </tr>
                      <tr>
                        <td>Teléfono</td>
                      </tr>
                      <tr>
                        <td class="padding"><input type="text" class="required" name="telefono"></td>
                      </tr>
                      <tr>
                        <td>Correo electrónico</td>
                      </tr>
                      <tr>
                        <td><input type="text" class="required" name="correo"></td>
                      </tr>
                    </table>
                  </li>
                  <li>
                    <h1 class="titulo line">DATOS DEL VEHÍCULO</h1>
                    <table class="tbl-datos">
                      <tr>
                        <td><input type="radio" id="usado" class="tipo" name="tipo" value="usado" checked>
                          <span class="label">Usado</span>
                          <input type="radio" id="nuevo" class="tipo" name="tipo" value="nuevo" style="margin-left: 15px">
                          <span class="label">Nuevo</span></td>
                      </tr>
                      <tr>
                        <td><div style="margin-bottom: 20px">&nbsp;</div></td>
                      </tr>
                      <tr>
                        <td>Marca</td>
                      </tr>
                      <tr>
                        <td class="padding"><select id="marca" class="required">
                            <option value="select" selected>Seleccion una marca</option>
                          </select>
                          <input type="hidden" id="txt-marca" name="marca" value="none"></td>
                      </tr>
                      <tr>
                        <td>Modelo</td>
                      </tr>
                      <tr>
                        <td class="padding"><select id="modelo" class="required">
                            <option value="select" selected>Seleccion un modelo</option>
                          </select>
                          <input type="hidden" id="txt-modelo" name="modelo" value="none"></td>
                      </tr>
                      <tr class="tr-version">
                        <td>Versión</td>
                      </tr>
                      <tr class="tr-version">
                        <td class="padding"><select id="version" class="required" name="version">
                            <option value="select" selected>Seleccion una versi&oacute;n</option>
                          </select></td>
                      </tr>
                      <tr class="tr-ano">
                        <td>Año</td>
                      </tr>
                      <tr class="tr-ano">
                        <td class="padding"><select id="valor" class="required" name="valor">
                            <option value="select" selected>Selecciona un a&ntilde;o</option>
                          </select>
                      </tr>
                      <tr class="tr-factura hide">
                        <td>Monto Factura</td>
                      </tr>
                      <tr class="tr-factura hide">
                        <td class="padding">
                          <input type="text" id="factura" name="factura" value=""></td>
                      </tr>							
                      <tr>
                        <td>N&uacute;mero de ocupantes</td>
                      </tr>
                      <tr>
                        <td class="padding"><select id="ocupantes" class="required no-precharged" name="ocupantes">
                            <option value="select" selected>Selecciona los ocupantes</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="13">13</option>
                            <option value="17">17</option>
                          </select></td>
                      </tr>
                      <tr>
                        <td>Uso</td>
                      </tr>
                      <tr>
                        <td class="padding"><select id="ocupantes" class="required no-precharged" name="uso">
                            <option value="select" selected>Selecciona el uso</option>
                            <option value="1">Particular</option>
                            <option value="2">R&uacute;stico</option>
                            <option value="3">Pick-Up
                            <option>
                          </select></td>
                      </tr>
                    </table>
                  </li>
                  <li class="pull-rigth">
                    <h1 class="titulo line">DATOS ADICIONALES</h1>
                    <table class="tbl-datos">
                      <tr>
                        <td>Edad</td>
                      </tr>
                      <tr>
                        <td class="padding"><select id="edad" class="required no-precharged" name="edad">
                            <option value="select" selected>Seleccione su edad</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                            <option value="32">32</option>
                            <option value="33">33</option>
                            <option value="34">34</option>
                            <option value="35">35</option>
                            <option value="36">36</option>
                            <option value="37">37</option>
                            <option value="38">38</option>
                            <option value="39">39</option>
                            <option value="40">40</option>
                            <option value="41">41</option>
                            <option value="42">42</option>
                            <option value="43">43</option>
                            <option value="44">44</option>
                            <option value="45">45</option>
                            <option value="46">46</option>
                            <option value="47">47</option>
                            <option value="48">48</option>
                            <option value="49">49</option>
                            <option value="50">50</option>
                            <option value="51">51</option>
                            <option value="52">52</option>
                            <option value="53">53</option>
                            <option value="54">54</option>
                            <option value="55">55</option>
                            <option value="56">56</option>
                            <option value="57">57</option>
                            <option value="58">58</option>
                            <option value="59">59</option>
                            <option value="60">60</option>
                            <option value="61">61</option>
                            <option value="62">62</option>
                            <option value="63">63</option>
                            <option value="64">64</option>
                            <option value="65">65</option>
                            <option value="66">66</option>
                            <option value="67">67</option>
                            <option value="68">68</option>
                            <option value="69">69</option>
                            <option value="70">70</option>
                            <option value="71">71</option>
                            <option value="72">72</option>
                            <option value="73">73</option>
                            <option value="74">74</option>
                            <option value="75">75</option>
                            <option value="76">76</option>
                            <option value="77">77</option>
                            <option value="78">78</option>
                            <option value="79">79</option>
                            <option value="80">80</option>
                            <option value="81">81</option>
                            <option value="82">82</option>
                            <option value="83">83</option>
                            <option value="84">84</option>
                            <option value="85">85</option>
                            <option value="86">86</option>
                            <option value="87">87</option>
                            <option value="88">88</option>
                            <option value="89">89</option>
                            <option value="90">90</option>
                            <option value="91">91</option>
                            <option value="92">92</option>
                            <option value="93">93</option>
                            <option value="94">94</option>
                            <option value="95">95</option>
                          </select></td>
                      </tr>
                      <tr>
                        <td>Sexo</td>
                      </tr>
                      <tr>
                        <td class="padding"><select class="required no-precharged" name="sexo">
                            <option value="select" selected>Seleccione su sexo</option>
                            <option value="1">Femenino</option>
                            <option value="2">Masculino</option>
                          </select></td>
                      </tr>
                      <tr>
                        <td>Estado Civil</td>
                      </tr>
                      <tr>
                        <td class="padding"><select class="required no-precharged" name="civil">
                            <option value="select" seleted>Seleccione su estado civil</option>
                            <option value="1">Casado</option>
                            <option value="2">Soltero</option>
                          </select></td>
                      </tr>
                      <tr>
                        <td>Tipo de Cobertura</td>
                      </tr>
                      <tr>
                        <td><select class="required no-precharged" name="cobertura">
                            <option value="select" selected>Seleccione una cobertura</option>
                            <option value="1">Cobertura amplia</option>
                            <option value="2">Perdita total</option>
                            <option value="3">Responsabilidad Civil</option>
                          </select></td>
                      </tr>
											<tr>
												<td>Inma %</td>
											</tr>
											<tr>
												<td>
													<select class="required no-precharged" name="inma-porcentaje">
														<option value="select" selected>Seleccione un porcentaje</option>
														<option value="-15">-15</option>
														<option value="10">-10</option>
														<option value="-5">-5</option>
														<option value="0">0</option>
														<option value="5">5</option>
														<option value="10">10</option>
														<option value="20">20</option>
														<option value="30">30</option>
												</select>
												</td>
											</tr>
                    </table>
                  </li>
                </ul>
                <input type="hidden" id="ano" name="ano" value="0">
              </form>
            </div>
          </div>
          <div id="mensaje">
            <div class="center"> <span>Todos los campos son requeridos.</span> <span id="error" class="red pull-rigth hide"></span> </div>
          </div>
          <div id="footer">
            <div class="center">
              <div class="separator"></div>
              <div id="legal">
                <ul>
                  <li>Al sistema que ud. está ingresando le son aplicables las disposiciones contenidas en la Ley sobre Mensajes de Datos y Firmas Electrónicas, así como también aquellas previstas en</li>
                  <li>los <a href="terminos.html" class="destacado" target="_blank" onClick="window.open(this.href, this.target, 'width=500, height=400, resizable=0');return false;">Términos de Uso</a> publicados en esta página.  Operar con el cotizador en línea implica aceptar los <a href="terminos.html" class="destacado" target="_blank" onClick="window.open(this.href, this.target, 'width=500, height=400, resizable=0'); return false;">Términos de Uso</a> en los que se ofrece el servicio.</li>
                  <li style="width: 220px;">
                    <input type="checkbox" id="acepto" name="acepto">
                    <label for="acepto" style="padding-left: 5px;">He leído y aceptado los <a href="terminos.html" class="destacado" target="_blank" onClick="window.open(this.href, this.target, 'width=500, height=400, resizable=0');return false;">Términos de Uso</a> y la <a href="legal.html" class="destacado" target="_blank" onClick="window.open(this.href, this.target, 'width=500, height=300, resizable=0'); return false;">Información Legal</a></label>
                  </li>
                </ul>
                <input type="button" id="datos-submit" class="boton boton-footer" value="Siguiente">
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
  } else {
    
  }
} else {
  
}
?>
