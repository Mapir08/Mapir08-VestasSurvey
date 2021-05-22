$('#log').submit(function(e){
  e.preventDefault();
  let listeQuestion;
  $.ajax({
    type: 'POST',
    url: 'public/php/log.php',
    data: listeQuestion,
    dataType: 'json',
    success: function(result){
      if(result.isSuccess){
        // Confirmer que TOUTES les questions sont bien dans liste questions
        // lancer la modification de l'HTML
        // la première question
      }
    }
  });
  
});