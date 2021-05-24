$(function(){

  let qNum, nbMaxQ, listeQuestions, listeReponses, saveReponse;

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
            listeQuestions = Object.values(liste);// Mets les questions dans un array
            listeQuestions.pop()                  // supprime le isSuccess maintenant inutile
            qNum = 0;                             // Première question
            nbMaxQ = listeQuestions.length;       // Nombre de question
            afficherPage("questionnaire");
            remplissageQuestionnaire();
          // la première question
        } else {
          $('#log_code').addClass('error');       // Si le code n'est pas bon -> message d'erreur
        }
      }
    });
  });
  $('#exam').submit(function(e){
    e.preventDefault();
    // CONTROLER SI UN CHOIX A ETE FAIT
    if ($('input[name=choix]:checked').val()) {
      // ENREGISTREMENT DE LA REPONSE
      saveReponse.push($('input[name=choix]:checked').next().text()); // Pour la liste des réponses : La réponse choisi
      listeReponses.push(saveReponse); // enregistrement dans le listing des reponse
      // QUESTION SUIVANTE
      if (qNum < nbMaxQ-1) {
        qNum += 1;
        remplissageQuestionnaire()
      } else {
        afficherPage('resultat');
      }
    }
  });
  
  function afficherPage(laquelle) {
    switch (laquelle) {
      case 'questionnaire':
        listeReponses = []
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
    saveReponse = [];
    // La question
    $('.exam_question').text(listeQuestions[qNum].question);
    saveReponse.push(listeQuestions[qNum].question); // Pour la liste des réponses : La question
    // Condition d'affichage IMAGE
    if (listeQuestions[qNum].img){
      $('.exam_img').html('<img src="public/img/questions/'+listeQuestions[qNum].img+'.png">');
      saveReponse.push(listeQuestions[qNum].img); // Pour la liste des réponses : L'image
      $('.exam_listeReponses').addClass('col-md-6');
      $('.exam_img').removeAttr('style');
    } else {
      $('.exam_img').html('');
      saveReponse.push(false); // Pour la liste des réponses : Pas d'image
      $('.exam_img').attr('style="display:none;"');
      $('.exam_listeReponses').removeClass('col-md-6');
    }
    // Le choix des réponses
    let nbChoix = Object.keys(listeQuestions[qNum]).length - 3;
    let codeHtmlReponses = '';
    for (let i=1 ; i < nbChoix+1 ; i++){
      codeHtmlReponses += '<input type="radio" name="choix" id="choix'+i+'" hidden><label for="choix'+i+'" class="choix-rep col-12"></label>';
    }
    $('.exam_listeReponses').html(codeHtmlReponses); // créer les div pour le nombre de réponse possible
    $('#choix1').next().text(listeQuestions[qNum].choix1); // remplir les choix possible
    $('#choix2').next().text(listeQuestions[qNum].choix2);
    $('#choix3').next().text(listeQuestions[qNum].choix3);
    $('#choix4').next().text(listeQuestions[qNum].choix4);
    saveReponse.push($('#choix'+listeQuestions[qNum].reponse).next().text()) // Pour la liste des réponses : La bonne réponse
    // Le compteur
    $('.exam_compteur').html('<span class="exam_compteur_num">' + (qNum+1) + '</span> / ' + nbMaxQ);
  };
});