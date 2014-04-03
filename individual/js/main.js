$(function() {    // required vars to submit    var txt_modelo = $("#txt-modelo");    var txt_marca = $("#txt-marca");    var ano = $("#ano");    var tr_ano = $(".tr-ano");    var tr_factura = $(".tr-factura");    var tr_version = $(".tr-version");    var usado = $("#usado");    // init vars to submit: above pre-charged input hidden values    ano.val("none");    txt_marca.val("none");    txt_modelo.val("none");    // clean and start    usado.prop("checked", true);    // load all brands    var marca = $("#marca");    marca.load("../inma/inma.php?ot=1", function(e) {        marca.prepend('<option value="select" selected>Selecciona una marca</option>');    });    // load inma data from changes methods    marca.change(function(e) {        txt_marca.val(this.options[this.selectedIndex].text);        modelo.load("../inma/inma.php?ot=2&ma=" + this.value, function() {            modelo.prepend('<option value="select" selected>Selecciona un modelo</option>');            version.empty().prepend('<option value="select" selected>Selecciona una versi&oacute;n</option>');            valor.empty().prepend('<option value="select" selected>Selecciona un a&ntilde;o</option>');            ocupantes.val("select");        });        return false;    });    var modelo = $("#modelo");    modelo.change(function(e) {        txt_modelo.val(this.options[this.selectedIndex].text);        version.load("../inma/inma.php?ot=3&ma=" + marca.val() + "&mo=" + this.value, function() {            version.prepend('<option value="select" selected>Selecciona una versi&oacute;n</option>');            ano.empty().prepend('<option value="select" selected>Selecciona un a&ntilde;o</option>');        });        return false;    });    var version = $("#version");    version.change(function(e) {        valor.load("../inma/inma.php?ot=4&co=" + this.value, function() {            valor.prepend('<option value="select" selected>Selecciona un a&ntilde;o</option>');        });        return false;    });    var valor = $("#valor");    valor.change(function() {        ano.val(valor.find(":selected").text());        return false;    });    // submit data form    var acepto = $("#acepto");    var ocupantes = $("#ocupantes");    var factura = $("#factura");    var correo = $("#form-datos").find("input[name='correo']");    var is_email = /^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/;    $("#datos-submit").click(function(e) {        if (!usado.is(":checked")) {            valor.val(factura.val());        }        if (errorData() === 0) {            if (acepto.prop("checked")) {                document.forms["form-datos"].submit();            }            else            {                error.html('Debes estar de acuerdo con los <a href="terminos.html" target="_blank" class="red" onclick="window.open(this.href, this.target, \'width=500, height=400, resizable=0\'); return false;">Terminos de uso</a> para continuar el proceso.').show();            }        }        else {            error.html('Debes completar todos los datos del formulario para continuar el proceso.').show();        }    });    // search all data form errors    var error = $("#error");    function errorData() {        var element, cont = 0;        $("#form-datos .required").each(function(index, value) {            element = $(this);            if (this.tagName === "INPUT") {                if (this.value === "") {                    element.addClass("is-required");                    cont += 1;                }                else {                    if ($(this).prop("name") === "correo") {                        if (!is_email.test($(this).val())) {                            element.addClass("is-required");                            cont += 1;                        }                        else {                            console.log("remove")                            element.removeClass("is-required");                        }                    }                    else {                        element.removeClass("is-required");                    }                }            }            else if (this.tagName === "SELECT") {                if (this.options[this.selectedIndex].value === "select") {                    element.addClass("is-required");                    cont += 1;                }                else {                    element.removeClass("is-required");                }            }        })        return cont;    }    // reset all input and select no=precharged    $("#datos .no-precharged").each(function(e) {        $(this).val("select");    });    // choose insurances    var insurances = [], insurance, insurance_name, insurance_id;    $("#lista-aseguradoras .icono-aseguradora").click(function(e) {        insurance = $(this);        insurance_name = insurance.prop("id");        insurance_id = insurance.attr("data");        if (insurance.hasClass("selected"))        {            insurance.removeClass("selected");            insurance.removeClass(insurance_name + "-selected");            insurances.splice(insurances.indexOf(insurance_name, 1));        }        else {            insurance.addClass("selected");            insurance.addClass(insurance_name + "-selected");            insurances.push(insurance_id);        }        return false;    })    // select car use    $("input[type='radio'].tipo").click(function(e) {        if ($(this).prop("id") === "nuevo") {            tr_ano.hide();            tr_version.hide();            tr_factura.show("slow");            valor.removeClass("required");            version.removeClass("required");        }        else {            tr_ano.show("slow");            tr_version.show("slow");            tr_factura.hide();        }    })    // start proccess    var insurances_url = $("#aseguradoras");    $("#btn-cotizar").click(function(e) {        if (insurances.length > 0) {            insurances_url.val(encodeURIComponent(insurances));            document.forms["form-aseguradoras"].submit();        }        else {            error.html("Debes seleccionar al menos una aseguradora para continuar el proceso.").show();        }    })    // choose a insurance    var cotizacion = $("#cotizacion");    $("#lista-cotizacion .icono-aseguradora").click(function(e) {        cleanInsurances();        insurance = $(this);        insurance_name = insurance.prop("id");        insurance_id = insurance.attr("data");        insurance.addClass("selected");        insurance.addClass(insurance_name + "-selected");        cotizacion.val(insurance_id);        return false;    })    // send an email and finished proccess    $("#btn-enviar").click(function(e) {        if (cotizacion.val() === "") {            error.html("Debes seleccionar una cotización para continuar el proceso.").show();        }        else {            $("#dialog").dialog("open");            document.forms["form-cotizacion"].submit();        }        return false;    })    // clean selected insurance icon    function cleanInsurances() {        $("#lista-cotizacion .icono-aseguradora").each(function(e) {            insurance = $(this);            insurance_name = insurance.prop("id");            insurance_id = insurance.attr("data");            if (insurance.hasClass("selected")) {                insurance.removeClass("selected");                insurance.removeClass(insurance_name + "-selected");            }        })    }    // setup dialog box    $("#dialog").dialog({        modal: true,        autoOpen: false,        width: 500,        resizable: false,        position: "center"    })})