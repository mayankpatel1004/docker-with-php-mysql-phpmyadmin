<?php
global $page_data,$currancy;
require $theme_path.'include/headerfront.php';
?>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="card">
      <div class="card-body">
        <div class="row">
            <div class="col-md-12 text-center">
                <label><h2 class="text-primary text-center">Order Placed</h2></label>
                <input type="hidden" id="cart_id" value="<?php echo $cart_id;?>" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-primary text-center">Your order has been successfully placed!!!</h1>
            <div><br /><br /><br />
            <div class="col-md-12 text-center">
                <a class="btn btn-primary" href="<?php echo $url;?>">Continue Shopping</a>
            </div><br /><br />
        </div>
        <br />
        </div>
    </div>
  </div>
  <br />
  <?php require_once $theme_path.'include/prefooterfront.php';?>
<?php require $theme_path.'include/scriptsfront.php';?>
</div>
<?php require_once $theme_path.'include/footerfront.php';?>
