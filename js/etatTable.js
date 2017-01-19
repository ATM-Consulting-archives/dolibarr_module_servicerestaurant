$(document).ready(function(){
  $(".container-square[name$='occupe']").each(function() {
    $(this).children('.square').children('a').attr("data-target", "#myModal");
    $(this).children().css("color","#efefef");
    $(this).children().css("background-color","#00a885");
  });
  $(".container-square[name$='libre']").each(function() {
    $(this).children('.square').children('a').attr("data-target", "#myModalNew");
    $(this).children().css("color","#efefef");
    $(this).children().css("background-color","#d1d5d8");
  });
});
