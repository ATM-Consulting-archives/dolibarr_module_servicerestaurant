$(document).ready(function(){
  $("input[name$='stock']").each(function() {
       valu = $(this).val();
       if (valu < 5) {
         $(this).parents('section').css("background-color","#e53935");
         $(this).parents('section').css("color","#efefef");
         $('.count').css("color","#333");
       }
       else {
         return 0;
       }
  });

  var counter = 0;
  $(".plus").click(function() {
    counter += 1;
      if (counter > 0) {
        $(this).parents('section').css("background-color","#00a885");
        $(this).parents('section').css("color","#efefef");
        $('.count').css("color","#333");
      }
  });
  $(".moins").click(function() {
    counter -= 1;
      if (counter < 0 ) {
        counter = 0;
        alert("You can't have a negative quantity")
      }
      if (counter == 0) {
        $(this).parents("section").css("background-color","#d1d5d8");
        $(this).parents("section").css("color","#333");
      }
  });


});
