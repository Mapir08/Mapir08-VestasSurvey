$(function(){

  $('#account-form').submit(function(e){
    e.preventDefault();
    let logAccount = $('#account-form').serialize();
    $.ajax({
      type: 'POST',
      url: 'public/php/log.php',
      data: logAccount,
      success: function(confirm){
        if (confirm === ""){
          window.location.href = 'exam.html';
        }else{
          $('#account-form_log').addClass('error');
          $('#account-form_pass').addClass('error');
        }
      }
    });
  });

});