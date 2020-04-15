$(document).ready(function(){
	  var site_url = $("#site_url").val();
      $('form').on('submit', function (e) {
        $(".success_error").html('');
        e.preventDefault();
        var form = e.target;
        $.ajax({
          dataType: 'json',
          method : "post",
          contentType: false,
          cache: false,
          processData:false, 
          url: site_url+'memberlogin/checkForgotpassword',
          data: new FormData(this),
          success: function (response) {
              new_response = JSON.parse(response);
              if(new_response.error == 0){
                $("#success_response").html(new_response.message);
              }
              if(new_response.error == 1){
                $("#error_response").html(new_response.message);
              }
          }
        });
      });
    });