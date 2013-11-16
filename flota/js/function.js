$(function (e){

  $("#close-dialog").bind("click", function(e){
    dialog.dialog("close");
    return false;
  });
  
  $("#open-dialog").bind("click", function(e){
    dialog.dialog("open");
    return false;
  });
  
  
})
