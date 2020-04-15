<?php require_once 'define.php';
$name = "";
$user_id = "";
$email = "";

$arrTokendata = explode(".",$token);
if(isset($arrTokendata[0]) && $arrTokendata[0] != "") {
  $email = base64_decode($arrTokendata[0]);
}
if(isset($arrTokendata[1]) && $arrTokendata[1] != "") {
  $name = base64_decode($arrTokendata[1]);
}
if(isset($arrTokendata[2]) && $arrTokendata[2] != "") {
  $user_id = $arrTokendata[2];
}

?>
<?php global $url,$theme_url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title class="text-primary">Reset Your Password</title>
  <!-- base:css -->
  <link rel="stylesheet" href="<?php echo $theme_url;?>vendors/mdi/css/materialdesignicons.min.css" />
  <link rel="stylesheet" href="<?php echo $theme_url;?>vendors/css/vendor.bundle.base.css" />
  <link rel="stylesheet" href="<?php echo $theme_url;?>vendors/flag-icon-css/css/flag-icon.min.css" />
  <!-- endinject -->
  <!-- plugin css for this page -->

  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo $theme_url;?>css/horizontal-layout-light/style.css" />
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo $theme_url;?>images/favicon.png" />
</head>

<body>

<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="main-panel">
        <div class="content-wrapper d-flex align-items-center auth px-0">
          <div class="row w-100 mx-0">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                <div class="brand-logo">
                <a href="<?php echo $url;?>"><img src="<?php echo $theme_url;?>images/logo.png" alt="logo"></a>
                </div>
                <?php if($name != ''):?>
                <h3 class="text-primary"><?php echo "Hello ".$name." ,";?></h3><br />
                <?php endif;?>
                <h4 class="text-primary">Reset your password</h4>
                <h6 class="text-primary"You got an email that we sent to your registered E-mail address?</h6>
                <div id="success_response" class="success_response" style="color:green;font-weight:bold;"></div>
                <form class="pt-3">
                  <div class="form-group">
                    <input type="hidden" name="site_url" id="site_url" value="<?php echo $url;?>" />
                    <input type="hidden" name="token" id="token" value="<?php echo $token;?>" />
                    <input type="hidden" name="user_id" id="id" value="<?php echo $user_id;?>" />
                    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email Address" readonly="readonly" name="email" value="<?php echo $email;?>" />
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="password" placeholder="Enter Password" name="password" onkeyup="validatePassword(this.value);"/>
                    <span id="validate_msg"></span>
                    <span id="error_msg" style="color:red;"></span>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="cpassword" placeholder="Confirm Password" name="cpassword" />
                  </div>
                  <div class="mt-3">
                    <input type="submit" disabled="true" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" onClick="return fnResetpassword()" value="RESET PASSWORD" />
                  </div>                  
                  <div class="text-center mt-4 font-weight-light"> Not You ? <a href="<?php echo $url."memberlogin/memberforgotpassword";?>" class="text-primary">Click here.</a>
                  <div class="text-center mt-4 font-weight-light"> Know your password ? <a href="<?php echo $url."memberlogin";?>" class="text-primary">Click here.</a>
                  <br /><br />
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <script type="text/javascript" src="<?php echo $theme_url;?>js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript">
    
      
        var site_url = $("#site_url").val();
        $('form').on('submit', function (e) {
          document.getElementById("error_msg").innerHTML = "";
          if(document.getElementById("password").value == ''){
            document.getElementById("error_msg").innerHTML = "Please enter your password.";
            return false;
          }
          else if(document.getElementById("password").value != document.getElementById("cpassword").value){
            document.getElementById("error_msg").innerHTML = "Your password mismatch.";
            return false;
          }
          else {
            $(".success_error").html('');
              e.preventDefault();
              var form = e.target;
              $.ajax({
                dataType: 'json',
                method : "post",
                contentType: false,
                cache: false,
                processData:false, 
                url: site_url+'memberlogin/checkResetpassword',
                data: new FormData(this),
                success: function (response) {
                    new_response = JSON.parse(response);
                    if(new_response.error == 0){
                      $("#success_response").html(new_response.message);
                      setTimeout(function(){ window.location.href=site_url+'memberlogin' }, 5000);
                    }
                }
              });
          }
        });
      
    function validatePassword(password) {
        if (password.length === 0) {
            document.getElementById("validate_msg").innerHTML = "";
            return;
        }
        // Create an array and push all possible values that you want in password
        var matchedCase = new Array();
        matchedCase.push("[$@$!%*#?&]"); // Special Charector
        matchedCase.push("[A-Z]"); // Uppercase Alpabates
        matchedCase.push("[0-9]"); // Numbers
        matchedCase.push("[a-z]"); // Lowercase Alphabates

        // Check the conditions
        var ctr = 0;
        for (var i = 0; i < matchedCase.length; i++) {
            if (new RegExp(matchedCase[i]).test(password)) {
                ctr++;
            }
        }
        // Display it
        var color = "";
        var strength = "";
        switch (ctr) {
            case 0:
            case 1:
            case 2:
                strength = "Very Weak Password.";
                color = "red";
                break;
            case 3:
                strength = "Medium Password.";
                color = "orange";
                break;
            case 4:
                strength = "Strong Password.";
                color = "green";
                break;
        }
        if(strength == "Strong Password.") {
          $(".btn-primary").attr('disabled',false);
        }
        document.getElementById("validate_msg").innerHTML = strength;
        document.getElementById("validate_msg").style.color = color;
    }
    </script>
</body>
</html>
