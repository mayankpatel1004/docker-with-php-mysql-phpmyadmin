<?php
global $page_data;
require $theme_path.'include/headerfront.php';
$item_alias = "products";

$backend_allow_action_dropdown = 'Y';
$backend_allow_apply_button = 'Y';
$backend_allow_addnew_button = 'Y';

?>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="card">
      <div class="card-body">
      <div class="row">
        <div class="col-md-1 col-sm-12">
           <label><h2 class="text-primary text-center">Products</h2></label>
        </div>
      </div>
      <?php require $theme_path.'include/productlistingsearch.php';?>
        <br />
        <div id="data_response"></div>
        <div class="dot-opacity-loader"><span></span><span></span><span></span></div>
        <br />
      </div>
    </div>
  </div>
  <?php require_once $theme_path.'include/prefooterfront.php';?>
<?php require $theme_path.'include/scripts.php';?>
<script type="text/javascript">
setTimeout(function(){ searchFilter(<?php echo $page_no;?>,'<?php echo $page_url;?>','<?php echo $item_alias;?>'); }, 300);
</script>
</div>
<?php require_once $theme_path.'include/footerfront.php';?>