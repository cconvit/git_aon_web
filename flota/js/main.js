var Aon = {
	setContentHeight: function (windowHeight) {
		var content = $("#content");
		content.css("height", windowHeight - 127);
	},
	setMainWidth: function (windowWidth) {
		var main = $("#main");
		main.css("width", windowWidth - 283);
	},
	setScrollHeight: function (windowHeight) {
		var main = $("#scroll");
		main.css("height", windowHeight - 272);
	},
	setScrollListHeight: function (windowHeight) {
		var list = $(".scrollable-list");
		list.css("height", windowHeight - 230);
	},
	setMenuHeight: function (windowHeight) {
		var menu = $("#left-nav"),
			li = menu.find("ul li");
		if (windowHeight - 42 < 615) {
			li.css("height", "73px");
		} else {
			li.css("height", "93px");
		}
		menu.css("height", windowHeight - 127);
	},
	windowResize: function () {
		var self = this,
			windowWidth = $(window).width(),
			windowHeight = $(window).height();
		self.setMainWidth(windowWidth);
		self.setScrollHeight(windowHeight);
		self.setContentHeight(windowHeight);
		self.setMenuHeight(windowHeight);
		self.setScrollListHeight(windowHeight);
	},
	init: function () {
		var self = this;
		self.windowResize();
	}
};

var Utils = {
	messagePromp: $("#container").find("div.required"),
	initDialogs: function (width) {
		$(".dialog").dialog({
			modal: true,
			autoOpen: false,
			width: width,
			resizable: false,
			position: "center"
		});
	},
	loadDialog: function (page, button, dialog) {
		var id = button.attr("data"),
			url = page + "?id=" + id;
		dialog.load(url, function (e) {
			dialog.dialog("open");
		});
	},
	loadList: function (page, dialog) {
		dialog.load(page, function (e) {
			dialog.dialog("open");
		});
	},
	selectedItem: function (item) {
		if (item.attr("role") !== "error") {
			var self_item = item,
				self_span = item.find("span"),
				selected_object = this.getSelectedItem(self_item.parent()),
				selected_item = selected_object.item,
				selected_span = selected_object.span;

			if (selected_item.length > 0) {
				selected_item.removeAttr("role");
				selected_span.removeClass("img-common icon-selected");
			}
			self_item.attr("role", "selected");
			self_span.addClass("img-common icon-selected");
		}
	},
	getSelectedItem: function (item) {
		var selected = item.find("li[role='selected']");
		return {
			item: selected,
			data: selected.attr("data"),
			span: selected.find("span")
		};
	},
	setSuggestionList: function (item) {},
	init: function () {
		this.initDialogs(400);
	}
};

var Wizard = {
	create: function (form) {
		if (existCheckeds(form)) {
			if (isValidateSubmit(form)) {
				form.trigger("submit");
			}
		}
	},
	fleet: function (form) {
		if (isValidateSubmit(form)) {
			if (isFileSelected(form)) {
				$("#load").dialog("open");
				form.trigger("submit");
			}
		}
	},
	quotation: function () {
		var errors = $("#list-errors >tbody >tr").length;
		if (errors === 0) {
			$("#load").dialog("open");
			location.href = "descargar-cotizacion.php";
		} else {
			alert("Aún existen vehículos con errores.")
		}
	},
	exit: function (page) {
		if (confirm("Realmente desea salir del asistente?")) {
			document.location.href = page;
		}
	}
};

// Jquery events:
$(function (e) {

	var wizard = Wizard,
		utils = Utils,
		load = $("#load"),
		tabs = $("#tabs"),
		vehicle = $("#vehicle");

	//init all dialogs and tabs
	load.dialog({
		modal: true,
		autoOpen: false,
		width: 400,
		resizable: false,
		position: "top+5%"
	});
	vehicle.dialog({
		modal: true,
		autoOpen: false,
		width: 900,
		resizable: false,
		position: "center"
	});
	tabs.tabs({
		active: 2
	}).find("ul").css({
		"background-color": "#FFFFFF",
		"display": "block",
		"border": "none"
	});

	//throw click input file event
	$("input[id='input-file']").on("click", function (e) {
		$(this).siblings("input[type='file']").trigger("click").change(function (e) {
			$(this).parents("form").trigger("submit");
			load.dialog("open");
		});
		return false;
	});

	//send next step form
	$("input[id='next']").on("click", function (e) {
		var role = $(this).attr("role"),
			form = $("body").find("form");
		switch (role) {
		case "create":
			wizard.create(form);
			break;
		case "fleet":
			wizard.fleet(form);
			break;
		}
		return false;
	});

	//check and uncheck list
	$("#load").on("click", ".checkbox", function (e) {
		var check = $(this);
		if (check.attr("is-checked") === "true") {
			check.removeClass("is-checked").attr("is-checked", "false");
		} else {
			check.addClass("is-checked").attr("is-checked", "true");
		}
		return false;
	});

	//throw upload method excel flota
	$(".upload").click(function (e) {
		var fleet = $("#fleet"),
			excel = $("#name");
		fleet.trigger("click").change(function (e) {
			excel.val(fleet.val());
		});
	});

	// open suggestion dialog
	var id, marca, modelo, version, ano, inma, reset, cobertura, uso, ocupantes, edad, sexo, civil;
	$(".list-fleet").on("click", ".suggestion", function (e) {
		id = $(this).attr("data");
		vehicle.load("load/loadVehicle.php?id=" + id, function () {
			marca = $("#marca"), modelo = $("#modelo"), version = $("#version"), ano = $("#ano"), inma = $("#inma"), cobertura = $("#cobertura"), uso = $("#uso"), ocupantes = $("#ocupantes"), edad = $("#edad"), sexo = $(sexo), civil = $("#civil"), $("input[name='id']").val(id), reset = $("#vehicle").find(".reset");
			vehicle.dialog("open");
		});
		return false;
	});

	//select a list suggestion element
	var item, ul, id, role, text, input, array = [];
	$("#vehicle").on("click", "#vehicle-suggestion ul li", function (e) {
		item = $(this), ul = item.parent(), id = item.attr("data-id"), role = ul.attr("role"), input = ul.siblings("input[type=hidden]"), text = item.attr("data");
		switch (role) {
		case "marca":
			$.getJSON("../inma/json.php?ot=2&ma=" + id, function (data) {
				modelo.empty();
				reset.empty().append("<li>NO CARGADO<li>");
				$.each(data, function (index, value) {
					modelo.append("<li data-id=\"" + value.codigo + "\" data=\"" + value.modelo + "\"><span class=\"icon-mini icon-clear\"></span>" + value.modelo + "</span></li>");
				});
				modelo.append("<li><input name=\"modelo\" type=\"hidden\"></li>");
			});
			break;
		case "modelo":
			$.getJSON("../inma/json.php?ot=3&ma=" + array.marca + "&mo=" + id, function (data) {
				version.empty();
				$.each(data, function (index, value) {
					version.append("<li data-id=\"" + value.codigo + "\" data=\"" + value.version + "\"><span class=\"icon-mini icon-clear\"></span>" + value.version + "</span></li>");
				});
				version.append("<li><input name=\"version\" type=\"hidden\"></li>");
			});
			break;
		case "version":
			$.getJSON("../inma/json.php?ot=4&co=" + id, function (data) {
				ano.empty();
				$.each(data, function (index, value) {
					ano.append("<li data-inma=\"" + value.inma + "\" data=\"" + value.ano + "\" ><span class=\"icon-mini icon-clear\"></span>" + value.ano + "</span></li>");
				});
				ano.append("<li><input name=\"ano\" type=\"hidden\"></li><li><input name=\"inma\" type=\"hidden\" value=/" + item.attr("data-inma") + "/></li>");
			});
			break;
		case "ano":
			inma.empty().append("<li data=\"" + item.attr("data-inma") + "\" role=\"selected\"><span class=\"icon-mini icon-clear img-common icon-selected\"></span>" + item.attr("data-inma") + "</span></li><li><input name=\"inma\" type=\"hidden\" value=" + item.attr("data-inma") + "></li>");
			inma.attr("data", "selected");
			break;
		}
		array[role] = id;
		ul.attr("data", "selected");
		input.val(text);
		utils.selectedItem(item);
		return false;
	});

	// submit suggestion form
	$("#vehicle").on("submit", "form", function (e) {
		if (!existUnselected($(this))) {
			$(this).trigger("submit");
		}
		return false;
	});
});

// generics functions 
function URLSendAgreements() {
	var data = [],
		input = $("input[name='data']"),
		checkbox;
	$(".checkbox").each(function (index, value) {
		checkbox = $(this);
		if (checkbox.attr("is-checked") === "true") {
			data.push(checkbox.attr("data"));
		}
	});
	if (data.length > 0) {
		input.val(data);
		return true;
	} else {
		return false;
	}
}

function formOperation() {
	if (confirm("¿Desea eliminar este registro. Esta operación es permanente")) {
		return true;
	} else {
		return false;
	}
}

function checksSelected(form) {
	var message;
	if (form.find("input[type='checkbox']:checked").length === 0) {
		message = form.find("div.required");
		message.show();
		return false;
	} else {
		return true;
	}
}

function isValidateSubmit(form) {
	var cont, element, message;
	cont = 0;
	message = form.find("div.required");
	form.find("input.is-required").each(function () {
		element = $(this);
		if (element.val() === "") {
			cont++;
		}
	});
	if (cont > 0) {
		message.show();
		return false;
	} else {
		return true;
	}
}

function existCheckeds(form) {
	var checked = 0;
	form.find("input[type='checkbox']").each(function (index, value) {
		if ($(this).prop("checked")) {
			checked++;
		}
	});
	if (checked > 0) {
		return true;
	} else {
		Utils.messagePromp.show();
		return false;
	}
}

function existUnselected() {
	var unselected = 0,
		message = $("#vehicle").find("form div.required");
	$("#vehicle").find("ul").each(function (index, value) {
		if ($(this).attr("data") === "unselected") {
			unselected++;
		}
	});
	if (unselected > 0) {
		message.show();
		return true;
	} else
		return false;
}

function isFileSelected(form) {
	var message = form.find("div.required"),
		fileName = $("#fleet").val();
	if (fileName === "") {
		message.show();
		return false;
	} else {
		return true;
	}
}


// when the DOM load: init tools
$(function (e) {
	Aon.init();
	Utils.init();
	$(window).resize(function () {
		Aon.windowResize();
	});
});