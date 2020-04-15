<?php require_once 'define.php';?>
<?php global $url,$theme_url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Member Login</title>
  <meta name="robots" CONTENT="noindex, nofollow">
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
                  <img src="<?php echo $theme_url;?>images/logo.png" alt="logo">
                </div>
                <h6 class="text-primary">Hello User ! You really forgot your existing password?</h6><br />
                <h6 class="font-weight-light text-primary">Enter your email to continue.</h6>
                <div id="success_response" class="success_error" style="text-align:center;color:green;"></div>
                <div id="error_response" class="success_error" style="text-align:center;color:red;"></div>
                <input type="hidden" id="site_url" value="<?php echo $url;?>" />
                <form class="pt-3" method="post">
                  <div class="form-group">
                    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email Address" name="email_address"/>
                  </div>
                  <div class="mt-3">
                  <input class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit" value="SUBMIT" />
                  </div>
                  <div class="text-center mt-4 font-weight-light">
                    Already know your password? <a href="<?php echo $url."memberlogin";?>" class="text-primary">Login</a>
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
  <!-- base:js -->
  <script src="<?php echo $theme_url;?>vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="<?php echo $theme_url;?>js/off-canvas.js"></script>
  <script src="<?php echo $theme_url;?>js/hoverable-collapse.js"></script>
  <script src="<?php echo $theme_url;?>js/template.js"></script>
  <script src="<?php echo $theme_url;?>js/settings.js"></script>
  <script src="<?php echo $theme_url;?>js/todolist.js"></script>
  <script src="<?php echo $theme_url;?>js/fp.js"></script>
  <!-- endinject -->
  
</body>

</html>
