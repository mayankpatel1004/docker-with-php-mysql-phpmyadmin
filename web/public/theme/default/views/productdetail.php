<?php global $page_data;
require $theme_path.'include/headerfront.php';
?>
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5e131574fd633a0012559c1f&product=inline-share-buttons' async='async'></script>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="card">
      <div class="card-body">
      <div class="row">
        <div class="col-md-12 col-sm-12 text-center">
           <label><h2 class="text-primary">
           <?php if(isset($arrProductData['arrProductDetails']['item_title']) && $arrProductData['arrProductDetails']['item_title'] != ""){
             echo $arrProductData['arrProductDetails']['item_title'];
           } else {
             echo "Product";
           }?>
           </h2></label>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
           <?php require_once 'productdetails/image_slider.php';?>
        </div>
        <div class="col-md-6">
          <?php require_once 'productdetails/right_panel.php';?>
        </div>
      </div>
      <div class="row">
        <?php require_once 'productdetails/tabs.php';?>
      </div>
      <div class="row grid-margin">
        <?php require_once 'productdetails/related_products.php';?>
      </div>
      <br />
      </div>
    </div>
  </div>
  <?php require_once $theme_path.'include/prefooterfront.php';?>
<?php require $theme_path.'include/scripts.php';?>
</div>
<link rel="stylesheet" href="<?php echo $theme_url;?>vendors/owl-carousel-2/owl.carousel.min.css">
<link rel="stylesheet" href="<?php echo $theme_url;?>vendors/owl-carousel-2/owl.theme.default.min.css">
<script src="<?php echo $theme_url;?>vendors/js/vendor.bundle.base.js"></script>
<script src="<?php echo $theme_url;?>vendors/owl-carousel-2/owl.carousel.min.js"></script>
<script src="<?php echo $theme_url;?>js/owl-carousel.js"></script>
<script src="<?php echo $theme_url;?>js/add_to_cart.js"></script>
<?php require_once $theme_path.'include/footerfront.php';?>