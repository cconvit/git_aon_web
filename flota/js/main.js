var AON = {
	setContentHeight: function(windowHeight) {
		var content = $("#content");
		content.css("height", windowHeight - 127);
	},
	setMainWidth: function(windowWidth) {
		var main = $("#main");
		main.css("width", windowWidth - 283);
	},
	setScrollHeight: function(windowHeight) {
		var main = $("#scroll");
		main.css("height", windowHeight - 272);
	},
	setScrollListHeight: function(windowHeight) {
		var list = $(".scrollable-list");
		list.css("height", windowHeight - 230);
	},
	setMenuHeight: function(windowHeight) {
		var menu = $("#left-nav");
		menu.css("height", windowHeight - 127);
	},
	windowResize: function() {
		var self = AON;
		var windowWidth = $(window).width(),
				windowHeight = $(window).height();
		self.setMainWidth(windowWidth);
		self.setScrollHeight(windowHeight);
		self.setContentHeight(windowHeight);
		self.setMenuHeight(windowHeight);
		self.setScrollListHeight(windowHeight);
	},
	init: function() {
		var self = this;
		self.windowResize();
	}
};

var UTIL = {
	initDialogs: function(width) {
		$(".dialog").dialog({
			modal: true,
			autoOpen: false,
			width: width,
			resizable: false,
			position: "top+15%"
		});
	},
	loadDialog: function(page, button, dialog) {
		var id = button.attr("data"),
				url = page + "?id=" + id;
		dialog.load(url, function(e) {
			dialog.dialog("open");
		});
	},
	loadList: function(page, dialog) {
		dialog.load(page, function(e) {
			dialog.dialog("open");
		});
	},
	selectedItem: function(item) {
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
	getSelectedItem: function(item) {
		var selected = item.find("li[role='selected']");
		return {item: selected, data: selected.attr("data"), span: selected.find("span")};
	},
	suggestionClick: function() {
		var vehicle = $("#vehicle");
		var self = this;
		$("#list-error").on("click", ".suggestion", function(e) {
			self.loadDialog("load/loadVehicle.php", $(this), vehicle);
			return false;
		});
	},
	setSuggestionList: function(item) {	
		if(SUGGESTION.flag){			
			SUGGESTION.tag = { marca: $("#marca"), modelo: $("#modelo"), version: $("#version"), ano: $("#ano"), inma: $("#inma")};
				SUGGESTION.flag = false;
		}
		var ul = item.parent(),
				data = item.attr("data"),
				role = ul.attr("role"),
				tag = SUGGESTION.tag;
		
		switch (role) {
			case "marca":
				SUGGESTION.marca = data;
				$.getJSON("../inma/json.php?ot=2&ma=" + data, function(data) {
					tag.modelo.empty();
					$.each(data, function(index, value) {
						tag.modelo.append("<li data=\"" + value.codigo + "\"><span class=\"icon-mini icon-clear\"></span>" + value.modelo + "</span></li>");
					});
				});
				ul.attr("selected", "selected");
				break;
			case "modelo":
				SUGGESTION.vehicle.modelo = data;
				$.getJSON("../inma/json.php?ot=3&ma=" + SUGGESTION.marca + "&mo=" + data, function(data) {
					tag.version.empty();
					$.each(data, function(index, value) {
						tag.version.append("<li data=\"" + value.codigo + "\"><span class=\"icon-mini icon-clear\"></span>" + value.version + "</span></li>");
					});
				});
				break;
			case "version":
				SUGGESTION.version = data;
				$.getJSON("../inma/json.php?ot=4&co=" + data, function(data) {
					tag.ano.empty();
					$.each(data, function(index, value) {
						tag.ano.append("<li data=\"" + value.inma + "\" data-text=\"" + value.ano + "\" ><span class=\"icon-mini icon-clear\"></span>" + value.ano + "</span></li>");
					});
				});
				break;
			case "ano":
				SUGGESTION.ano = item.attr("data-text");
				SUGGESTION.inma = data;
				tag.inma.empty().append("<li data=\"" + SUGGESTION.inma + "\" role=\"selected\"><span class=\"icon-mini icon-clear img-common icon-selected\"></span>" + SUGGESTION.inma + "</span></li>");
				break;
		}
	},
	init: function() {
		this.initDialogs(400);
	}
};

var WIZARD = {
	create: function(form) {
		if (isValidateSubmit(form)) {
			form.trigger("submit");
		}
	},
	quotation: function(form) {
		if (isValidateSubmit(form)) {
			if (isFileSelected(form)) {
				form.trigger("submit");
			}
		}
	},
	exit: function(page) {
		if (confirm("Realmente desea salir del asistente?")) {
			document.location.href = page;
		}
	}
};

$(function(e) {

	var util = UTIL,
			wizard = WIZARD;

	var load = $("#load");
	load.dialog({
		modal: true,
		autoOpen: false,
		width: 400,
		resizable: false,
		position: "top+3%"
	});

	var tabs = $("#tabs");
	tabs.tabs().find("ul").css({
		"background-color": "#FFFFFF",
		"display": "block",
		"border": "none"
	});

	var vehicle = $("#vehicle");
	vehicle.dialog({
		modal: true,
		autoOpen: false,
		width: 900,
		resizable: false,
		position: "center"
	});

	//throw click input file event
	$("input[id='input-file']").on("click", function(e) {
		$(this).next().trigger("click").change(function(e) {
			$(this).parents("form").trigger("submit");
			load.dialog("open");
		});
		return false;
	});

	//send next step form
	$("input[id='next']").on("click", function(e) {
		var role = $(this).attr("role"),
				form = $("body").find("form");
		switch (role) {
			case "create":
				wizard.create(form);
				break;
			case "quotation":
				wizard.quotation(form);
		}
		return false;
	});

	//check and uncheck list
	$("#load").on("click", ".checkbox", function(e) {
		var check = $(this);
		if (check.attr("is-checked") === "true") {
			check.removeClass("is-checked").attr("is-checked", "false");
		}
		else {
			check.addClass("is-checked").attr("is-checked", "true");
		}
		return false;
	});

	//throw upload method excel flota
	$(".upload").click(function(e) {
		var fleet = $("#fleet"),
				excel = $("#name");
		fleet.trigger("click").change(function(e) {
			excel.val(fleet.val());
		});
	});
	
	//select a list suggestion element
	$("#vehicle").on("click", "#vehicle-suggestion ul li", function(e) {
		var item = $(this);
		util.setSuggestionList(item);
		util.selectedItem(item);
		return false;
	});
});

function URLSendAgreements() {
	var data = [], input = $("input[name='data']");
	$(".checkbox").each(function(index, value) {
		var checkbox = $(this);
		if (checkbox.attr("is-checked") === "true") {
			data.push(checkbox.attr("data"));
		}
	});
	if (data.length > 0) {
		input.val(data);
		return true;
	}
	else {
		return false;
	}
}

function formOperation() {
	if (confirm("¿Desea eliminar este registro. Esta operación es permanente")) {
		return true;
	}
	else {
		return false;
	}
}

function isValidateSubmit(form) {
	var cont, element, message;
	cont = 0;
	message = form.find("div.required");
	form.find("input.is-required").each(function() {
		element = $(this);
		if (element.val() === "") {
			cont++;
		}
	});
	if (cont > 0) {
		message.show();
		return false;
	}
	else {
		return true;
	}
}

function isFileSelected(form) {
	var message = form.find("div.required"),
			fileName = $("#fleet").val();
	if (fileName === "") {
		message.show();
		return false;
	}
	else {
		return true;
	}
}

$(function(e) {
	AON.init();
	UTIL.init();
	$(window).resize(function() {
		AON.windowResize();
	});
});
