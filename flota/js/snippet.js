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
