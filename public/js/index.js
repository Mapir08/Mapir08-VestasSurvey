$(function(){

  $('#account-form').submit(function(e){
    e.preventDefault();
    let logAccount = $('#account-form').serialize();
    $.ajax({
      type: 'POST',
      url: 'public/php/log.php',
      data: logAccount,
      dataType: 'text',
      success: function(confirm){
        if (confirm === "go"){
          window.location.href = 'exam.html';
        }else{
          $('#accountForm_log').addClass('error');
          $('#account-form_pass').addClass('error');
        }
      }
    });
  });

});