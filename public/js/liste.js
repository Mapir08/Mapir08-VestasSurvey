$(function(){

  let index = -1;
  let heightOuvert = '500px';
  let heightFerme = '50px';

  $.ajax({
    type: 'POST',
    url: 'public/php/liste.php',
    dataType: 'json',
    success: function(liste){
      let confirm = "";
      for (let i in liste){
        if (liste[i].candidat == confirm){
          divQuestion(liste[i].question, liste[i].reponseChoisi, liste[i].bonneReponse, liste[i].img);
        }else{
          // if (candidat_nom != "") {
            // Cacluer le pourcentage si ce n'est pas le premier nom
            // Afficher le pourcentage
          // }
          $('.tempo').removeClass('tempo');
          divNewCandidat(liste[i].candidat, liste[i].region, liste[i].date);
          divQuestion(liste[i].question, liste[i].reponseChoisi, liste[i].bonneReponse, liste[i].img);
          confirm = liste[i].candidat;
        }
      }
      $('.done-candidat_voir').click(function(){
        let listeIndex = $('#done-candidat ul').children('li');
        let newIndex = $(this).parent().parent().index();
        let item = listeIndex.eq(newIndex);
        if (newIndex == index){
          animate(item, false);
          index= -1;
        }else{
          let oldItem = listeIndex.eq(index);
          animate(oldItem, false);
          animate(item, true);
          index = newIndex;
        }
      });
    }
  });

  function animate($item, toOpen){
    let itemParam = toOpen ? {height: heightOuvert} : {height: heightFerme};
    $item.animate(itemParam);
  };

  function divNewCandidat(candidat, area, date){
    let div = '<li class="container-fluid">\
      <div class="done-candidat_presentation row">\
        <div class="done-candidat_voir col-1"><i class="bi bi-caret-down-fill"></i></div>\
        <div class="done-candidat_nom col-4">'+ candidat +'</div>\
        <div class="done-candidat_pourcentage col-1">0%</div>\
        <div class="done-candidat_region col-3">'+ area +'</div>\
        <div class="done-candidat_date col-3">'+ date +'</div>\
      </div>\
      <div class="done-candidat_liste tempo container-fluid">\
      </div>\
    </li>';
    $('#done-candidat_listing').append(div);
    index += 1;
  };

  function divQuestion(question ,reponseChoisi, bonneReponse, img){
    if (bonneReponse == reponseChoisi){
      reponseChoisi = "";
    }
    let ligne = '<div class="row">\
                  <div class="col-9">\
                    <div class="done-candidat_question">'+ question +'</div>\
                    <div class="done-candidat_reponseChoisi">'+ reponseChoisi +'</div>\
                    <div class="done-candidat_bonneReponse">'+ bonneReponse +'</div>\
                  </div>\
                  <div class="col-3 done-candidat_img tempoBis"></div>\
                </div>';
    $('.tempo').append(ligne);
    if (img != 'false') {
      $('.tempoBis').append('<img src="public/img/questions/'+ img +'.png">');
    }
    $('.tempoBis').removeClass('tempoBis');
  };

});