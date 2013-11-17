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

// kick it all off here 
$(document).ready(AON.init);
$(function (e){

  var dialog = $("#dialog");
  dialog.dialog({
     modal: true,
     autoOpen: false,
     width: 400,
     resizable: false,
     position: "top+15%" 
   });
   
  $("#close-dialog").bind("click", function(e){
    dialog.dialog("close");
    return false;
  });
  
  $("#open-dialog").bind("click", function(e){
    dialog.dialog("open");
    return false;
  });
  
});