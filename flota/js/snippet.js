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
    var windowWidth = $(window).width();
    var windowHeight = $(window).height();
    //setup and fix size 
    self.setMainWidth(windowWidth);
    self.setScrollHeight(windowHeight);
    self.setContentHeight(windowHeight);
    self.setMenuHeight(windowHeight);
    self.setScrollListHeight(windowHeight);
  },
  init: function() {
    var self = AON;
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
    var id = $(button).attr("data"),
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
          self_span = item.find("span");

      var selected_object = UTIL.getSelectedItem(self_item.parent()),
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
    return {item: item.find("li[role='selected']"), span: item.find("li[role='selected'] span")};
  },
  setSuggestionList: function(item) {
    var ul = item.parent(),
        data = item.attr("data"),
        role = ul.attr("role");

    switch (role) {
      case "marca":
        var modelo = $("#modelo");
        $.getJSON("../inma/json.php?ot=2&ma=" + data, function(data) {
          modelo.empty()
          $.each(data, function(index, value) {
            modelo.append("<li data=\"" + data.codigo + "\"><span class=\"icon-mini icon-clear\"></span>" + value.modelo + "</span></li>");
          });
        });
        break;
    }
  },
  init: function() {
    UTIL.initDialogs(400);
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

  //next: all event Jquery functions

  var util = UTIL;

  //init jquery-UI elements
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
    var wizard = WIZARD,
        role = $(this).attr("role"),
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

  //suggestion load promp
  $("a.suggestion").click(function(e) {
    util.loadDialog("load/loadVehicle.php?", $(this), vehicle);
    return false;
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
