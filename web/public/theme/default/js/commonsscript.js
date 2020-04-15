$(document).ready(function(){
      var site_url = $("#site_url").val();
      setTimeout(function(){
        $.ajax({
          dataType: 'json',
          method : "post",
          contentType: false,
          cache: false,
          processData:false, 
          url: site_url+'memberlogin/loginmemberdetails',
          success: function (response) {
            new_response = JSON.parse(response);
            $(".email_input").attr('encryptsource',new_response.email_string);
            $(".password_input").attr('encryptsource',new_response.password_string);
          }
        });
      }, 2000);

      $('form').on('submit', function (e) {
        $("#error_message").html();
        e.preventDefault();
        var form = e.target;
        $.ajax({
          dataType: 'json',
          method : "post",
          contentType: false,
          cache: false,
          processData:false, 
          url: site_url+'memberlogin/checkLogin',
          data: new FormData(this),
          success: function (data) {
            if(data.success == 1){
              window.location.href = site_url+'dashboard';
            }else {
              var message = "Your credentials mismatch.";
              if (typeof data.message !== 'undefined') {
                message = data.message;
              }
              //console.log(data);
              $("#error_message").html(message);
            }
          }
        });
      });
    });