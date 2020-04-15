<?php
require_once 'define.php';
global $back_session_name,$url,$conn;
if(isset($_SESSION[$back_session_name]['user_id']) && !empty($_SESSION[$back_session_name]['user_id'])) {
  header('Location:'.$url);
}
function setConfigdata() {
  global $back_session_name,$conn,$theme_path,$url,$cf;
  $sql = "SELECT * FROM `site_config` WHERE `display_status` = 'Y' AND `deleted_status` = 'N'";
  $arrData = $cf->getData($sql);
  
  $write = "";
  $write .= "<?php";
  $write .= "\r\n";
  foreach($arrData as $key=>$value) {
      $key = $value['config_name'];
      $value = $value['config_value'];
      $write .= "define('".$key."','".addslashes($value)."');";
      $write .="\r\n";
  }
  $write .= "?>";
  file_put_contents($theme_path."generated_files/configdata.php",$write);

  $sitemapType = "SELECT DISTINCT(item_type) FROM `items` WHERE admin_module = 'N' AND display_status = 'Y' AND deleted_status = 'N'";
  $arrType = $cf->getData($sitemapType);
  if(isset($arrType) && !empty($arrType)) {
      $return = "";
      $arrParent = [];
      foreach($arrType as $type) {
          $type = $type['item_type'];   
          $sqlSitemap = "SELECT item_id,item_title,item_type,item_alias FROM `items` WHERE `html_sitemap` = 'Y' AND `item_type` = '$type' AND `admin_module` = 'N' AND `display_status` = 'Y' AND `deleted_status` = 'N' ORDER BY `html_sitemap_order` ASC,`item_id` DESC";
          $arrData = $cf->getData($sqlSitemap);
          if(isset($arrData) && !empty($arrData)){
              foreach($arrData as $key=>$value) {
                  $arrParent[$type][] = array('title' => $value['item_title'],'alias' => $value['item_alias']);
              }
          }
      }
  }
  file_put_contents($theme_path."generated_files/sitemapdata.php",serialize($arrParent));
}
?>
<?php global $url,$theme_url;
if(isset($_REQUEST['uc']) && $_REQUEST['uc'] == "Yes") {
  $sql = "UPDATE `site_config` SET `config_value` = 'Yes' WHERE `site_config`.`config_name` = 'SITE_CONSTRUCTION'";
  $stmt = $conn->prepare($sql); 
  $stmt->execute();
  setConfigdata();
}
if(isset($_REQUEST['uc']) && $_REQUEST['uc'] == "No") {
  $sql = "UPDATE `site_config` SET `config_value` = 'No' WHERE `site_config`.`config_name` = 'SITE_CONSTRUCTION'";
  $stmt = $conn->prepare($sql); 
  $stmt->execute();
  setConfigdata();
}
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
                <div class="brand-logo text-center">
                  <a href="<?php echo $url;?>"><img src="<?php echo $theme_url;?>images/admin-logo-login.png" alt="logo"></a>
                </div>
                <h4 class="text-primary">Hello User ! let's get started</h4>
                <h6 class="font-weight-light text-primary">Sign in to continue.</h6>
                <div style="color:red;" id="error_message" class="error"></div>
                <form class="pt-3" method="post">
                  <div class="form-group">
                    <input type="hidden" id="site_url" value="<?php echo $url;?>" />
                    <input type="email" class="form-control form-control-lg email_input" id="exampleInputEmail1" name="email_address" placeholder="Email Address" encryptsource="" />
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg password_input" id="exampleInputPassword1" placeholder="Password" name="password" encryptsource="" />
                  </div>
                  <div class="mt-3">
                    <input class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit" value="SIGN IN" />
                  </div>
                  <div class="text-center mt-4 font-weight-light">
                    Forgot password? <a href="<?php echo $url."memberlogin/memberforgotpassword";?>" class="text-primary">Click here</a>
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
  <script src="<?php echo $theme_url;?>js/commonsscript.js"></script>
</body>
</html>