<?php
global $page_data,$currancy,$front_session_name;
require $theme_path.'include/headerfront.php';
$item_alias = "products";
?>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="card">
      <div class="card-body">
      <div class="row">
        <div class="col-md-12">
           <label><h2 class="text-primary text-center">Shopping Cart</h2></label>
           <input type="hidden" id="cart_id" value="<?php echo $cart_id;?>" />
        </div>
      </div>
      <?php if(isset($_SESSION[$front_session_name]['quantity_error']) && $_SESSION[$front_session_name]['quantity_error'] != ""){
        
        ?>
        <div class="row">
          <div class="col-md-12 text-center text-danger">
              <?php echo $_SESSION[$front_session_name]['quantity_error'];
              unset($_SESSION[$front_session_name]['quantity_error']);
              ?>
          </div>
        </div>
        <?php
      }?>
        <br />
        <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <?php if(isset($arrCartProductDetails) && !empty($arrCartProductDetails)):?>
                        <thead>
                          <tr>
                            <th class="text-primary" style="width:5%;"></th>
                            <th class="text-primary">Title</th>
                            <th class="text-primary">Amount</th>
                            <th class="text-primary">Qty</th>
                            <th class="text-primary">Item Price</th>
                            <th class="text-primary">Final Total</th>
                            <th class="text-primary">Action</th>
                          </tr>
                        </thead>
                        <tbody>  
                            <?php foreach($arrCartProductDetails as $data):?>
                                <?php $file_url = $cf->displayFile(PRODUCTS_PATH.$data['file1'], PRODUCTS_URL.$data['file1'], 'medium', 300,300);?>
                                <tr id="p_p_id_<?php echo $data['product_price_id'];?>">
                                    <td><a href="<?php echo $url."product/".$data['item_alias'];?>"><img src="<?php echo $file_url;?>" alt="image"></a></td>
                                    <td>
                                        <a href="<?php echo $url."product/".$data['item_alias'];?>"><?php echo $data['item_name'];?></a>
                                        <br /><br />
                                        <ul  class="list-unstyled">
                                            <?php if(isset($data['product_attribute_1']) && $data['product_attribute_1'] != ""):?>
                                            <li><?php echo $data['product_attribute_1'];?> : <?php echo $data['product_option_1'];?></li>
                                            <?php endif;?>
                                            <?php if(isset($data['product_attribute_2']) && $data['product_attribute_2'] != ""):?>
                                            <li><?php echo $data['product_attribute_2'];?> : <?php echo $data['product_option_2'];?></li>
                                            <?php endif;?>
                                            <?php if(isset($data['product_attribute_3']) && $data['product_attribute_3'] != ""):?>
                                            <li><?php echo $data['product_attribute_3'];?> : <?php echo $data['product_option_3'];?></li>
                                            <?php endif;?>
                                            <?php if(isset($data['item_tax_total']) && $data['item_tax_total'] > 0):?>
                                            <li class="text-primary">Total Tax : <?php echo $currancy.$data['item_tax_total'];?></li>
                                            <?php endif;?>
                                            <?php if(isset($data['item_shipping_total']) && $data['item_shipping_total'] > 0):?>
                                            <li class="text-primary">Total Shipping : <?php echo $currancy.$data['item_shipping_total'];?></li>
                                            <?php endif;?>
                                        </ul>
                                    </td>
                                    
                                    <td><?php echo $currancy.$data['product_option_price'];?></td>
                                    <td width="7%"><input onkeypress="return isNumber(event)" onChange="updateCartItems(this.value,'<?php echo $data['cart_product_id'];?>')" type="text" name="qty" id="qty" value="<?php echo $data['ordered_quantity'];?>" class="form-control" /></td>
                                    <td><?php echo $currancy.$data['item_price_total'];?></td>
                                    <td><?php echo $currancy.$data['final_item_price'];?></td>
                                    <td style="width:5%;text-align:center;"><a title="<?php echo $data['cart_product_id'];?>" class="delete-cart-item" onClick="fnDeleteCartItem('<?php echo $data['cart_id'];?>','<?php echo $data['cart_product_id'];?>')" style="cursor:pointer;"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                            <?php endforeach;?>
                      </tbody>
                      <?php else:?>
                      <tbody>
                        <tr>
                          <td class="text-center"><h5 class="text-primary">Your cart is now empty</h5></td>
                        </tr>
                      </tbody>
                      <?php endif;?>
                    </table>
                    <br />
                    <?php if(isset($arrCartDetails) && $arrCartDetails != false):?>
                    <table class="table table-bordered pull-right">
                        <thead>
                            <?php if(isset($arrCartDetails['total_items_amount']) && $arrCartDetails['total_items_amount'] > 0):?>
                            <tr>
                                <td width="90%" align="right">Product Total (+): </td>
                                <td><?php echo $currancy.$arrCartDetails['total_items_amount'];?></td>
                            </tr>
                            <?php endif;?>
                            <?php if(isset($arrCartDetails['cashback_amount_applied']) && $arrCartDetails['cashback_amount_applied'] > 0):?>
                            <tr>         
                                <td width="90%" align="right">Cashback Amount Applied (-): </td>
                                <td><?php echo $currancy.$arrCartDetails['cashback_amount_applied'];?></td>
                            </tr>
                            <?php endif;?>
                            <?php if(isset($arrCartDetails['coupon_amount_applied']) && $arrCartDetails['coupon_amount_applied'] > 0):?>
                            <tr>    
                                <td width="90%" align="right">Coupon Amount Applied1 (-): </td>
                                <td><?php echo $currancy.$arrCartDetails['coupon_amount_applied'];?></td>
                            </tr>
                            <?php endif;?>
                            
                            <?php if(isset($arrCartDetails['cashback_wallet_amount_used']) && $arrCartDetails['cashback_wallet_amount_used'] > 0):?>
                            <tr>
                                <td width="90%" align="right">Wallet Amount Used (-): </td>
                                <td><?php echo $currancy.$arrCartDetails['cashback_wallet_amount_used'];?></td>
                            </tr>
                            <?php endif;?>
                            <?php if(isset($arrCartDetails['total_ordered_quantity']) && $arrCartDetails['total_ordered_quantity'] > 0):?>
                            <tr>
                                <td width="90%" align="right">Total Quantity : </td>
                                <td><?php echo $arrCartDetails['total_ordered_quantity'];?></td>
                            </tr>
                            <?php endif;?>
                            <?php if(isset($arrCartDetails['total_items_tax_amount']) && $arrCartDetails['total_items_tax_amount'] > 0):?>
                            <tr>
                                <td width="90%" align="right">Total Tax (+): </td>
                                <td><?php echo $currancy.$arrCartDetails['total_items_tax_amount'];?></td>
                            </tr>
                            <?php endif;?>
                            <?php if(isset($arrCartDetails['total_items_shipping_amount']) && $arrCartDetails['total_items_shipping_amount'] > 0):?>
                            <tr>
                                <td width="90%" align="right">Total Shipping (Items) (+): </td>
                                <td><?php echo $currancy.$arrCartDetails['total_items_shipping_amount'];?></td>
                            </tr>
                            <?php endif;?>
                            
                            <?php if(isset($arrCartDetails['shipping_amount']) && $arrCartDetails['shipping_amount'] > 0):?>
                            <tr>
                                <td width="90%" align="right">Shipping Amount (+): </td>
                                <td><?php echo $currancy.$arrCartDetails['shipping_amount'];?></td>
                            </tr>
                            <?php endif;?>
                            
                            <?php if(isset($arrCartDetails['order_total']) && $arrCartDetails['order_total'] > 0):?>
                            <tr>
                                <td width="90%" align="right">Order Total (=): </td>
                                <td><?php echo $currancy.$arrCartDetails['order_total'];?></td>
                            </tr>
                            <?php endif;?>
                        </thead>
                    </table>
                    <?php endif;?>
                  </div>
                  <br />
                  <?php if(isset($arrCartProductDetails) && !empty($arrCartProductDetails)):?>
                  <div class="row text-center">
                      <div class="col-md-8"></div>
                      <div class="col-md-2"><br /><button class="btn btn-primary text-white cursor-pointer" onClick="showSwal('confirm-empty');">Empty Cart</button></div>
                      <div class="col-md-2"><br /><a href="<?php echo $url.'checkout';?>" class="btn btn-primary text-white">Checkout</a></div>
                  </div>
                  <?php endif;?>  
      </div>
    </div>
  </div>
  <?php require_once $theme_path.'include/prefooterfront.php';?>
<?php require $theme_path.'include/scriptsfront.php';?>
<script src="<?php echo $theme_url;?>js/alerts.js"></script>
<script src="<?php echo $theme_url;?>vendors/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo $theme_url;?>js/add_to_cart.js"></script>
</div>
<?php require_once $theme_path.'include/footerfront.php';?>