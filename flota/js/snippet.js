var AON = {
  setMainWidth: function() {
    var windowWidth = $(window).width();
    var $main = $("#main");
    $main.css("width", windowWidth - 283);
  },
  setScrollHeight: function() {
    var windowHeight = $(window).height();
    var $main = $("#scroll");
    $main.css("height", windowHeight - 272);
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
      position: "center"
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
    if (isValidateSubmit(form)&& isfileSelected()) {
      form.trigger("submit");
    }
  },
  exit: function(page){
    if(confirm("Realmente desea salir del asistente?")){
      document.location.href = page;
    }  
  }
};

$(function(e) {

  //next: all event Jquery functions

  var load = $("#load");
  load.dialog({
    modal: true, 
    autoOpen: false, 
    width: 400, 
    resizable: false,
    position:"top+3%"
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
  $("input[id='next']").on("click", function(e){
    var wizard = WIZARD;
    var role = $(this).attr("role");
    switch(role){
      case "create":
        wizard.create($("body").find("form"));
        break;
      case "quotation":
        wizard.quotation();
    }
    return false;
  });
  
  //check and uncheck list
  $("#load").on("click", ".checkbox", function(e){
    check = $(this);
    if(check.attr("is-checked") === "true"){
      check.removeClass("is-checked").attr("is-checked", "false");
    }
    else{
      check.addClass("is-checked").attr("is-checked", "true");
    }
    return false;
  });
  
  //throw upload method excel flota
   var flag = false;
  $(".upload").click(function(e){
    fleet = $("#fleet");
    excel = $("#name");
    fleet.trigger("click").change(function(e){
      excel.val(fleet.val());
    });
  });
  
  // init all
  AON.init();
  UTIL.init();
});

 function URLSendAgreements(){
    var data = [], input = $("input[name='data[]']");
   $(".checkbox").each(function(index, value){
      checkbox = $(this);    
      if(checkbox.attr("is-checked")=== "true"){
       data.push(checkbox.attr("data"));
      }
    });
    if(data.length > 0){
     input.val(data);
     return true;
    }
    else{
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

function isFileSelected(form){
 file = form.find("input[type='file']");
 if(file.val() === ""){
   return false;
 }
 else{
   return true;
 }
}