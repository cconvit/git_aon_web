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
  setMenuHeight: function(windowHeight){
    var menu = $("#left-nav");
    menu.css("height", windowHeight -127);
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
    id = $(button).attr("data");
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
    wizard = WIZARD;
    role = $(this).attr("role");
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
    check = $(this);
    if (check.attr("is-checked") === "true") {
      check.removeClass("is-checked").attr("is-checked", "false");
    }
    else {
      check.addClass("is-checked").attr("is-checked", "true");
    }
    return false;
  });

  //throw upload method excel flota
  var flag = false;
  $(".upload").click(function(e) {
    fleet = $("#fleet");
    excel = $("#name");
    fleet.trigger("click").change(function(e) {
      excel.val(fleet.val());
    });
  });
  
  //suggestion load promp
  $()

  // set width and height size
  $(window).resize(function() {
    AON.windowResize();
  });
  // init all
  AON.init();
  UTIL.init();
});

function URLSendAgreements() {
  var data = [], input = $("input[name='data']");
  $(".checkbox").each(function(index, value) {
    checkbox = $(this);
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
  message = form.find("div.required");
  fileName = $("#fleet").val();
  if (fileName === "") {
    message.show();
    return false;
  }
  else {
    return true;
  }
}