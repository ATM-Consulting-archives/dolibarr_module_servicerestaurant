$(document).ready(function() {
  //au click sur le lien chercher
  $("#plus").click(function(){
    //on recupere la valeur de l'attribut name pour afficher tel ou tel resultat
    var req=$(this).attr("name");
    //requ�te ajax, appel du fichier recherche.php
    $.ajax({
      type: "GET",
      url: "commande.php?add="+req,
      dataType : "html",
      //affichage de l'erreur en cas de probl�me
      error:function(msg, string){
        alert( "Error !: " + string );
      },
      success:function(data){
        alert(data);
        $(".p").text(data);
      }
    });
  });
});
