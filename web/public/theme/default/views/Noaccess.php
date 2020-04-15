<?php
global $page_data;
require $theme_path.'include/header.php';
?>

<?php global $url;?>
<div class="main-panel">
        <div class="content-wrapper">          
        <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center text-center error-page bg-primary">
        <div class="row flex-grow">
          <div class="col-lg-7 mx-auto text-white">
            <div class="row align-items-center d-flex flex-row">
              <div class="col-lg-6 text-lg-right pr-lg-4">
                <h1 class="display-1 mb-0 text-white">404</h1>
              </div>
              <div class="col-lg-6 error-page-divider text-lg-left pl-lg-4">
                <h2 class="text-white">SORRY!</h2>
                <h3 class="font-weight-light text-white">You don't have sufficient access for this page. Please contact administrator for more details.</h3>
              </div>
            </div>
            <div class="row mt-5">
              <div class="col-12 text-center mt-xl-2">
                <a class="text-white font-weight-medium" href="<?php echo $url;?>">Back to home</a>
              </div>
            </div>
            <div class="row mt-5">
              <div class="col-12 mt-xl-2">
                <p class="text-white font-weight-medium text-center">Copyright &copy; 2018  All rights reserved.</p>
              </div>
            </div>
          </div>
        </div>
        </div>
        
        </div>
        </div>
        </div>
        <?php require_once $theme_path.'include/footer.php';?>    
    <?php require $theme_path.'include/scripts.php';?>
</div>