var AON = {
  setMainWidth: function(){
    var windowWidth = $(window).width();
    var $main = $("#main");
    $main.css("width", windowWidth - 283 );
    console.log(windowWidth - 283);
  },
  setScrollHeight: function (){
    var windowHeight = $(window).height();
    var $main = $("#scroll");
    $main.css("height", windowHeight - 272 );
    console.log(windowHeight - 272);
  },

  init: function(){
    AON.setMainWidth();
    $(window).resize(function() {
      AON.setMainWidth();
      AON.setScrollHeight();
    });
  }
};

var UTIL = {
  initDialogs: function(width){
    $(".dialog").dialog({ 
      modal: true, 
      autoOpen: false, 
      width: width, 
      resizable: false, 
      position: "top+15%"
    });
  },
  loadDialog: function(page, dialog){
    dialog.load(page, function(e){
      dialog.dialog("open");
    });
  },
  init: function(){
    UTIL.initDialogs(400);
  }
};

$(document).ready(function(e){
  AON.init();
  UTIL.init();
});

function isValidateSubmit(form){
  var cont, element, message;
  cont = 0;
  message = form.find("div.error");
  form.find("input.is-required").each(function () {
   element = $(this);
   if(element.val() === ""){
     cont++;
   }
  });
  if(cont > 0){
    message.show();
    return false;
  }
  else{
    return true;
  }
}

