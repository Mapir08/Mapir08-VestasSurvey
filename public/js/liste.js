$(function(){

  let index = -1;
  let heightOuvert = '500px';
  let heightFerme = '50px';
  let pourcentage = 0;
  let area ="";

  $.ajax({
    type: 'POST',
    url: 'public/php/verif.php',
    success: function(statut){
      if (statut != ''){
        window.location.href = 'index.html';
      }
    }
  });
  $.ajax({
    type: 'POST',
    url: 'public/php/liste.php',
    dataType: 'json',
    success: function(liste){
      let confirm = "";
      let nbBonneReponse = 0;
      let nbReponse = 0;
      for (let i in liste){ // réécrire le liste[i].reagion pour ne prendre que les 5 première lettre de les mettres en Majuscule
        if (liste[i].candidat == confirm){
          divQuestion(liste[i].question, liste[i].reponseChoisi, liste[i].bonneReponse, liste[i].img);
        }else{
          if (i != 0) {
            pourcentage = Math.round((nbBonneReponse / nbReponse)*100);
            $('.tempo .done-candidat_pourcentage').text(pourcentage + " %");
          }
          $('.tempo').removeClass('tempo');
          area = liste[i].region.split("@");
          divNewCandidat(liste[i].candidat, area[0].toUpperCase(), liste[i].date);
          divQuestion(liste[i].question, liste[i].reponseChoisi, liste[i].bonneReponse, liste[i].img);
          confirm = liste[i].candidat;
        }
        nbReponse +=1;
        if (liste[i].reponseChoisi == liste[i].bonneReponse){
          nbBonneReponse +=1;
        }
      }
      pourcentage = Math.round((nbBonneReponse / nbReponse)*100);
      $('.tempo .done-candidat_pourcentage').text(pourcentage + " %");
      $('.done-candidat_voir').click(function(){
        let listeIndex = $('#done-candidat ul').children('li');
        let newIndex = $(this).parent().parent().index();
        let item = listeIndex.eq(newIndex);
        if (newIndex == index){
          animate(item, false);
          rotateTag(item, false);
          index= -1;
        }else{
          let oldItem = listeIndex.eq(index);
          animate(oldItem, false);
          rotateTag(oldItem, false);
          animate(item, true);
          rotateTag(item, true);
          index = newIndex;
        }
      });
    }
  });

  $('#footer-detail_area').click(function(){
    $('#footer-modal').fadeIn();
    $.ajax({
      url: 'public/php/area.php',
      type: 'POST',
      dataType: 'json',
      success: function(retour){
        console.log(retour);
        let listeArea='';
        for (let i in retour){
          listeArea += '<li><span class="footer-modal_color">'+ retour[i].nomRegion +'</span> - '+ retour[i].nom +'</li>';
        }
        $('#footer-modal_ul').html(listeArea);
      }
    });
  });
  $('#footer-modal').click(function(){
    $('#footer-modal').fadeOut();
  });
  function animate($item, toOpen){
    let itemParam = toOpen ? {height: heightOuvert} : {height: heightFerme};
    $item.animate(itemParam);
  };
  let rotateTag = function($item, toOpen){
    let deg= toOpen ? [180, 1.2] : [0, 1] ;
    let color= toOpen ? 0.5 : 1;
    $item.children('.done-candidat_presentation').children('.done-candidat_voir').css({transform: 'rotate('+ deg[0] +'deg) scale('+ deg[1] +')', transition: 'transform 500ms ease-in-out'});
    $item.children('.done-candidat_presentation').children('.done-candidat_voir').css({color: 'rgba(30, 34, 50, '+ color +')'});
  };
  function divNewCandidat(candidat, area, date){
    let div = '<li class="container-fluid tempo">\
      <div class="done-candidat_presentation row">\
        <div class="done-candidat_voir col-1"><i class="bi bi-caret-down-fill"></i></div>\
        <div class="done-candidat_nom col-4">'+ candidat +'</div>\
        <div class="done-candidat_pourcentage col-1">0%</div>\
        <div class="done-candidat_region col-3">'+ area +'</div>\
        <div class="done-candidat_date col-3">'+ date +'</div>\
      </div>\
      <div class="done-candidat_liste container-fluid">\
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
    $('.tempo .done-candidat_liste').append(ligne);
    if (img != 'false') {
      $('.tempoBis').append('<img src="public/img/questions/'+ img +'.png">');
    }
    $('.tempoBis').removeClass('tempoBis');
  };

});