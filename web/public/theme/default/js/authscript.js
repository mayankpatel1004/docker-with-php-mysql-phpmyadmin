$(document).ready(function(){
  var site_url = $("#site_url").val();

  
  $('#register').on('submit', function (e) {
    $("#error_message").html();
    $(".error").html('');

    if($("#first_name").val() == ''){
      $(".error_first_name").html('Please enter your first name');
      return false;
    }
    else if($("#last_name").val() == ''){
      $(".error_last_name").html('Please enter your last name');
      return false;
    }
    else if($("#emails").val() == ''){
      $(".error_email").html('Please enter your email address');
      return false;
    }
    else if($("#passwords").val() == ''){
      $(".error_password").html('Please enter your Password');
      return false;
    }
    else if($("#passwords").val() != '' && $('#passwords').val().length < 8){
      $(".error_password").html('Please enter your Password atleast 8 characters');
      return false;
    }
    else {
      e.preventDefault();
      var form = e.target;
      $.ajax({
        dataType: 'json',
        method : "post",
        contentType: false,
        cache: false,
        processData:false,
        url: site_url+'login/checkRegister',
        data: new FormData(this),
        success: function (data) {
          //console.log(data.message);
          if(data.success == 1){
            window.location.href = site_url;
          }else {
            $("#error_message").html(data.message);
          }
        }
      });
    }
  });


  $('#loginform').on('submit', function (e) {
    $("#error_message").html();
    e.preventDefault();
    var form = e.target;
    $.ajax({
      dataType: 'json',
      method : "post",
      contentType: false,
      cache: false,
      processData:false,
      url: site_url+'login/checkLogin',
      data: new FormData(this),
      success: function (data) {
        if(data.success == 1){
          window.location.href = site_url;
        }else {
          $("#error_message").html("Your credentials mismatch.");
        }
      }
    });
  });
});