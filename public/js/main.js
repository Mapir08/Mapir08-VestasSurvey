$(function(){

  let qNum, nbMaxQ, listeQuestions, listeReponses, saveReponse;
  let candidatName, areaMail, pourcentage;

  $('#log').submit(function(e){
    e.preventDefault();
    let logData = $('#log').serialize(); // A TESTER : remplacer '#log' par this
    $.ajax({
      type: 'POST',
      url: 'public/php/log.php',
      data: logData,
      dataType: 'json',
      success: function(retour){
        if(retour.confirmation.codeSuccess && retour.confirmation.nameSuccess && retour.confirmation.areaSuccess){
            listeQuestions = Object.values(retour.questionnaire);// Mets les questions dans un array
            candidatName = retour.confirmation.candidat; // on récupère le nom du candidat
            areaMail = retour.confirmation.area;         // on récupère le mail de l'area
            qNum = 0;                             // Première question
            nbMaxQ = listeQuestions.length;       // Nombre de question
            afficherPage("questionnaire");
            remplissageQuestionnaire();
        } else {
          if (!retour.confirmation.codeSuccess){
            $('#log_code').addClass('error');     // Si le code n'est pas bon -> message d'erreur
          }
          if (!retour.confirmation.nameSuccess){
            $('#log_name').addClass('error');     // Si le nom n'est pas bon -> message d'erreur
          }
          if (!retour.confirmation.areaSuccess){
            $('#log_area').addClass('error');     // Si l'area n'est pas bon -> message d'erreur
          }
        }
      }
    });
  });
  $('#exam').submit(function(e){
    e.preventDefault();
    if ($('input[name=choix]:checked').val()) {
      saveReponse.push($('input[name=choix]:checked').next().text()); // Pour la liste des réponses : La réponse choisi
      listeReponses.push(saveReponse);                                // enregistrement dans le listing des reponses
      $.ajax({
        type: 'POST',
        url: 'public/php/save.php',
        data: 'c='+ candidatName +'&q='+ saveReponse[0] +'&img='+ saveReponse[1] +'&br='+ saveReponse[2] +'&r='+ saveReponse[3] +'&a='+ areaMail,
        success: function(){
          if (qNum < nbMaxQ-1) { 
            qNum += 1;                                                    // QUESTION SUIVANTE
            remplissageQuestionnaire()
          } else {
            afficherPage('resultat');                                     // FIN
          }
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

  function afficherPage(laquelle) {
    switch (laquelle) {
      case 'questionnaire':
        listeReponses = []
        $('#login').remove();
        $('#questionnaire').removeAttr('style');
        break;
      case 'resultat':
        $('section').remove();
        enleveBonneReponse(listeReponses);
        pourcentage = 1-(listeReponses.length/nbMaxQ);
        $('header').after('\
          <section id="resultat" class="container-fluid blanc">\
            <div class="col-12 resultat-presentation">Voici le résultat pour le candidat : <span id="resultat-candidat" class="marque">'+ candidatName +'</span></div>\
            <div class="row resultat-bloc">\
              <div class="col-md-2 col-11 resultat_barre-ext"><div class="resultat_barre-int" style="height:'+Math.round(pourcentage * 100)+'%;width:'+Math.round(pourcentage * 100)+'%"><span>'+Math.round(pourcentage * 100)+'%</span></div></div>\
              <div class="col-md-9 col-11 resultat_panneau"></div>\
            </div>\
            <div class="resultat-btn"><a href="" class="btn btn-colored">Recommencer</a></div>\
          </section>\
        ');
        if (pourcentage == 1){
          $('.resultat-presentation').after('<div class="col-12 resultat-presentation" id="resultat-presentation">Bravo, c\'est un <span class="marque">100%</span>.</div>');
        }else{
          $('.resultat-presentation').after('<div class="col-12 resultat-presentation" id="resultat-presentation"><span class="marque">'+ Math.round(pourcentage * 100)+'%</span> de bonne réponse. Ci-dessous les erreurs :</div>');
          for (let i = 0 ; i<listeReponses.length ; i++) {
            const tempo = '\
            <div class="row resultat_panneau-detail" id="temporaire">\
              <div class="col-md-8 col-9">\
                <div class="resultat_panneau-question">'+listeReponses[i][0]+'</div>\
                <div class="resultat_panneau-reponseDonnee">'+listeReponses[i][3]+'</div>\
                <div class="resultat_panneau-bonneReponse">'+listeReponses[i][2]+'</div>\
              </div>\
            </div>';
            $('.resultat_panneau').append(tempo);
            if (listeReponses[i][1]){
              $('#temporaire').append('<div class="col-md-4 col-3 resultat_panneau-img"><img src="public/img/questions/'+listeReponses[i][1]+'.png"></div>');
            }
            $("#temporaire").removeAttr('id');
          }
        }
        break;
      case 'error':
        $('section').remove();
        $('header').after('\
          <section id="error" class="container-fluid">\
            <div class="error-msg">!! ERREUR !!</div>\
            <a href="" class="btn btn-colored">Recommencer</a>\
          </section>\
        ');
    }
  };
  function remplissageQuestionnaire(){
    saveReponse = [];
    $('.exam_question').text(listeQuestions[qNum].question);   
    saveReponse.push(listeQuestions[qNum].question);           // Pour la liste des réponses : La question
    if (listeQuestions[qNum].img){                             // Condition d'affichage IMAGE
      $('.exam_img').html('<img src="public/img/questions/'+listeQuestions[qNum].img+'.png">');
      saveReponse.push(listeQuestions[qNum].img);              // Pour la liste des réponses : L'image
      $('.exam_listeReponses').addClass('col-md-6');
      $('.exam_img').removeAttr('style');
    } else {
      $('.exam_img').html('');
      saveReponse.push(false);                                 // Pour la liste des réponses : Pas d'image
      $('.exam_img').attr('style="display:none;"');
      $('.exam_listeReponses').removeClass('col-md-6');
    }
    let codeHtmlReponses = '';
    codeHtmlReponses += '<input type="radio" name="choix" id="choix1" hidden><label for="choix1" class="choix-rep col-12"></label>';
    codeHtmlReponses += '<input type="radio" name="choix" id="choix2" hidden><label for="choix2" class="choix-rep col-12"></label>';
    if (Object.values(listeQuestions[qNum].choix3) != ''){
      codeHtmlReponses += '<input type="radio" name="choix" id="choix3" hidden><label for="choix3" class="choix-rep col-12"></label>';
      if (Object.values(listeQuestions[qNum].choix4) != ''){
        codeHtmlReponses += '<input type="radio" name="choix" id="choix4" hidden><label for="choix4" class="choix-rep col-12"></label>';
      }
    }
    $('.exam_listeReponses').html(codeHtmlReponses);
    $('#choix1').next().text(listeQuestions[qNum].choix1);
    $('#choix2').next().text(listeQuestions[qNum].choix2);
    $('#choix3').next().text(listeQuestions[qNum].choix3);
    $('#choix4').next().text(listeQuestions[qNum].choix4);
    saveReponse.push($('#choix'+listeQuestions[qNum].reponse).next().text()) // Pour la liste des réponses : La bonne réponse
    $('.exam_compteur').html('<span class="exam_compteur_num">'+(qNum+1)+'</span> / '+nbMaxQ);
  };
  function enleveBonneReponse(liste){
    for (let i=0; i<liste.length; i++) {
      if (liste[i][2] == liste[i][3]){
        liste.splice(i, 1);
        i -= 1;
      }
    }
    return liste;
  }
});