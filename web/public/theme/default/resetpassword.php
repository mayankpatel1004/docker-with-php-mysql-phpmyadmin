<?php require_once 'define.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Reset Your Password</title>
  <!-- base:css -->
  <link rel="stylesheet" href="<?php $url;?>vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?php $url;?>vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?php $url;?>vendors/flag-icon-css/css/flag-icon.min.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php $url;?>css/horizontal-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php $url;?>images/favicon.png" />
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
                  <img src="<?php $url;?>images/logo.png" alt="logo">
                </div>
                <h4 class="text-primary">Reset your password</h4>
                <h6 class="text-primary">You got an email that we sent to your registered E-mail address?</h6><br />
                <form class="pt-3">
                  <div class="form-group">
                    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email Address">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="exampleInputEmail2" placeholder="Enter Password">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="exampleInputEmail3" placeholder="Confirm Password">
                  </div>
                  <div class="mt-3">
                    <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="<?php echo $url;?>">RESET PASSWORD</a>
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
  <script src="<?php $url;?>vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="<?php $url;?>js/off-canvas.js"></script>
  <script src="<?php $url;?>js/hoverable-collapse.js"></script>
  <script src="<?php $url;?>js/template.js"></script>
  <script src="<?php $url;?>js/settings.js"></script>
  <script src="<?php $url;?>js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
