$(function(){
	
	// required vars to submit
	var txt_modelo = $("#txt-modelo");
	var txt_marca = $("#txt-marca");
	var ano = $("#ano");
	
	// init vars to submit: above pre-charged input hidden values
	ano.val("none");
	txt_marca.val("none");
	txt_modelo.val("none");
	
	// load all brands
	var marca = $("#marca");
	marca.load("../inma/inma.php?ot=1", function(e){
		marca.prepend('<option value="select" selected>Selecciona una marca</option>');	
	});
	
	// load inma data from changes methods
	marca.change(function (e){
		txt_marca.val(this.options[this.selectedIndex].text);
		modelo.load("../inma/inma.php?ot=2&ma=" + this.value, function(){
			modelo.prepend('<option value="select" selected>Selecciona un modelo</option>');
			version.empty().prepend('<option value="select" selected>Selecciona una versi&oacute;n</option>');
			valor.empty().prepend('<option value="select" selected>Selecciona un a&ntilde;o</option>');
			ocupantes.val("select");
			
		})
		return false;
	})
	
	var modelo = $("#modelo");
	modelo.change(function (e){
		txt_modelo.val(this.options[this.selectedIndex].text);
		version.load("../inma/inma.php?ot=3&ma=" + marca.val() + "&mo=" + this.value, function(){
			version.prepend('<option value="select" selected>Selecciona una versi&oacute;n</option>');
			ano.empty().prepend('<option value="select" selected>Selecciona un a&ntilde;o</option>');
		});
		return false;
	})
	
	var version = $("#version");
	version.change(function (e){
		valor.load("../inma/inma.php?ot=4&co=" + this.value, function(){
			valor.prepend('<option value="select" selected>Selecciona un a&ntilde;o</option>');
		});
	return false;
	})
	
	var valor = $("#valor");
	valor.change(function(){
		ano.val(valor.find(":selected").text());
		return false;	
	})
		
	// submit data form
	var acepto = $("#acepto");
	var datos = $("#datos");
	var ocupantes = $("#ocupantes");
	$("#datos-submit").click(function(e){
			if(errorData() == 0){
				if(acepto.prop("checked")){
					document.forms["datos"].submit();
				}
				else{
					error.html('Debes estar de acuerdo con los <a href="terminos.html" class="red">Terminos de uso</a> para continuar el proceso.').show();
				}
			}
			else{
				error.html('Debes completar todos los datos del formulario para continuar el proceso.').show();
			}
	})
	
	// search all data form errors
	var error = $("#error");
	function errorData(){
		var element, cont = 0;
		$("#datos .required").each(function (index, value){
			element = $(this);
			if(this.tagName === "INPUT"){
				if(this.value === ""){
					element.addClass("is-required");
					cont += 1;
				}
				else{
					element.removeClass("is-required");
				}
			}
			else if(this.tagName === "SELECT"){
				if(this.options[this.selectedIndex].value === "select"){
					element.addClass("is-required");
					cont += 1;
				}
				else{
					element.removeClass("is-required");
				}
			}
		})
		return cont;
	}
	
	// reset all input and select no=precharged
	$("#datos .no-precharged").each(function(e){
		$(this).val("select");	
	})
	
})
