<?php
require_once 'define.php';
global $front_session_name,$url;
if(isset($_SESSION[$front_session_name]['customer_id']) && !empty($_SESSION[$front_session_name]['customer_id'])) {
  header('Location:'.$url);
}
?>
<?php global $url,$theme_url;?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title class="text-primary">Member Login</title>
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
                  <img src="<?php echo $theme_url;?>images/logo.png" alt="logo" />
                </div>
                <h4>Hello Customer ! let's get started</h4>
                <h6 class="font-weight-light">Register your account by filling below details.</h6>
                <div style="color:red;" id="error_message" class="error"></div>
                <form class="pt-3" method="post" id="register">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="first_name" name="first_name" placeholder="First Name" />
                    <div class="error error_first_name" style="color:red;"></div>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="last_name" name="last_name" placeholder="Last Name" />
                    <div class="error error_last_name" style="color:red;"></div>
                  </div>
                  <div class="form-group">
                    <input type="hidden" id="site_url" value="<?php echo $url;?>" />
                    <input type="email" class="form-control form-control-lg email_input" id="emails" id="exampleInputEmail1" name="email_address" placeholder="Email Address" encryptsource="" />
                    <div class="error error_email" style="color:red;"></div>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg password_input" id="passwords" id="exampleInputPassword1" placeholder="Password" name="password" encryptsource="" />
                    <div class="error error_password" style="color:red;"></div>
                  </div>
                  <div class="mt-3">
                    <input class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit" value="SIGN IN" />
                  </div>
                  <div class="text-center mt-4 font-weight-light">
                    Already Registered? <a href="<?php echo $url."login";?>" class="text-primary">Click here</a>
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
  <!-- container-scroller -->
  <script src="<?php echo $theme_url;?>vendors/js/vendor.bundle.base.js"></script>
  <script src="<?php echo $theme_url;?>js/off-canvas.js"></script>
  <script src="<?php echo $theme_url;?>js/hoverable-collapse.js"></script>
  <script src="<?php echo $theme_url;?>js/template.js"></script>
  <script src="<?php echo $theme_url;?>js/settings.js"></script>
  <script src="<?php echo $theme_url;?>js/todolist.js"></script>
  <script src="<?php echo $theme_url;?>js/authscript.js"></script>
</body>
</html>