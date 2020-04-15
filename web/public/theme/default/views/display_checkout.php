<?php
global $page_data,$currancy;
require $theme_path.'include/headerfront.php';
?>
<div class="main-panel">
  <div class="content-wrapper">
    <form name="frm" id="checkout-form" method="post" action="<?php echo $url.'Home/updateCartBillingAddress';?>">
    <div class="card">
        <div class="card-body">
        <div class="row">
        <div class="col-md-12">
           <label><h2 class="text-primary text-center">Checkout</h2></label>
           <input type="hidden" id="cart_id" name="cart_id" value="<?php echo $cart_id;?>" />
        </div>
      </div>
        <br />
        <div class="row">
          <?php require_once 'checkout/billing_address.php';?>
          <?php require_once 'checkout/shipping_address.php';?>
        </div>
        <?php require_once 'checkout/display_order.php';?>
        <br />
        </div>
    </div>
    </form>
  </div>
  <?php require_once $theme_path.'include/prefooterfront.php';?>
<?php require $theme_path.'include/scriptsfront.php';?>
<script src="<?php echo $theme_url;?>js/add_to_cart.js"></script>
</div>
<?php require_once $theme_path.'include/footerfront.php';?>