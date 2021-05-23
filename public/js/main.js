$(function(){

  let qNum, nbMaxQ;
  let listeQuestions=[];

  $('#log').submit(function(e){
    e.preventDefault();
    // RECUPERER LA LISTE DES QUESTION VOULU en vérifiant si le formulaire est correct
    let logData = $('#log').serialize();
    $.ajax({
      type: 'POST',
      url: 'public/php/log.php',
      data: logData,
      dataType: 'json',
      success: function(liste){
        if(liste.isSuccess){
          // Confirmer que TOUTES les questions sont bien dans liste questions
            console.log(liste); // ATTENTION c'est un tableau JSON
            
            
            
            console.log(listeQuestions);
            qNum = 0;
            nbMaxQ = Object.keys(liste).length;
            afficherPage("questionnaire");
            remplissageQuestionnaire();
          // la première question
        } else {
          $('#log_code').addClass('error');
        }
      }
    });
  });
  $('#exam').submit(function(e){
    e.preventDefault();
    // CONTROLER SI UN CHOIX A ETE FAIT

    // ENREGISTREMENT DE LA REPONSE

    // QUESTION SUIVANTE
    if (qNum < nbMaxQ) {
      qNum += 1;
      remplissageQuestionnaire()
    } else {
      afficherPage('resultat');
    }
  });
  
  function afficherPage(laquelle) {
    switch (laquelle) {
      case 'questionnaire':
        $('#login').remove();
        $('#questionnaire').removeAttr('style');
        break;
      case 'resultat':
        $('section').remove();
        $('header').after('\
        <section id="error" class="container-fluid">\
          <div class="error-msg">FINI !</div>\
          <a href="" class="btn btn-colored">Bravo</a>\
        </section>'
      );
        break;
    }
  };
  function remplissageQuestionnaire(){
    $('.exam_question').text('Question 1 ?');
    $('.exam_img').html('<img src="public/img/questions/Q'+ (qNum+1) +'.png">');
    $('#choix1').next().text('Réponse A');
    $('#choix2').next().text('Reponse B');
    $('#choix3').next().text('Reponse C');
    $('#choix4').next().text('Reponse D');
    $('.exam_compteur').html('<span class="exam_compteur_num">' + (qNum+1) + '</span> / ' + nbMaxQ);
  };

});