var AON = {
  setMainWidth: function() {
    var windowWidth = $(window).width();
    var $main = $("#main");
    $main.css("width", windowWidth - 283);
    console.log(windowWidth - 283);
  },
  setScrollHeight: function() {
    var windowHeight = $(window).height();
    var $main = $("#scroll");
    $main.css("height", windowHeight - 272);
    console.log(windowHeight - 272);
  },
  init: function() {
    AON.setMainWidth();
    $(window).resize(function() {
      AON.setMainWidth();
      AON.setScrollHeight();
    });
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
    var id = $(button).attr("data");
    var url = page + "?id=" + id;
    dialog.load(url, function(e) {
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
      form.submit();
    }
  }
};

$(function(e) {

  //next: all event Jquery functions

  var load = $("#load");
  load.dialog({modal: true, autoOpen: false, width: 400, resizable: false, position: "center"});

  // throw click input file event
  $("input[id='input-file']").on("click", function(e) {
    $(this).next().trigger("click").change(function(e) {
      $(this).parents("form").submit();
      load.dialog("open");
    });
    return false;
  });

  AON.init();
  UTIL.init();
});

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