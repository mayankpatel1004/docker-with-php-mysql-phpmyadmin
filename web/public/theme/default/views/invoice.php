<?php global $page_data,$currancy;
require $theme_path.'include/headerfront.php';
$arrOrderData = array();
$arrOrderProductsData = array();

if(isset($arrAllData) && !empty($arrAllData)){
  $arrOrderData = $arrAllData['arrOrderData'];
  $arrOrderProductData = $arrAllData['arrOrderProductData'];
}
//echo "<pre>";print_r($arrOrderData);
//echo "<pre>";print_r($arrOrderProductData);
if(isset($arrOrderData) && !empty($arrOrderData)):
?>
  <div class="main-panel">
                <div class="content-wrapper">          
                <div class="row">
              <div class="col-lg-12">
                  <div class="card px-2">
                      <div class="card-body">
                          <div class="container-fluid">
                            <h3 class="text-right my-5">Invoice&nbsp;&nbsp;#<?php echo $arrOrderData['order_id_unique'];?></h3>
                            <hr>
                          </div>
                          <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-3 pl-0">
                              <p class="mt-5 mb-2"><b><?php echo $arrOrderData['billing_first_name'];?> <?php echo $arrOrderData['billing_last_name'];?></b></p>
                              <p><?php echo $arrOrderData['billing_address_1'];?> <?php echo $arrOrderData['billing_address_2'];?><br><?php echo $arrOrderData['billing_city'];?> <?php echo $arrOrderData['billing_state'];?>,<br><?php echo $arrOrderData['billing_country'];?>, <?php echo $arrOrderData['billing_zipcode'];?></p>
                            </div>
                            <div class="col-lg-3 pr-0">
                              <p class="mt-5 mb-2 text-right"><b>Invoice to</b></p>
                              <p class="text-right"><?php echo $arrOrderData['shipping_address_1'];?> <?php echo $arrOrderData['shipping_address_2'];?><br><?php echo $arrOrderData['shipping_city'];?> <?php echo $arrOrderData['shipping_state'];?>,<br><?php echo $arrOrderData['shipping_country'];?>, <?php echo $arrOrderData['shipping_zipcode'];?></p>
                            </div>
                          </div>
                          <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-3 pl-0">
                              <p class="mb-0 mt-5">Invoice Date : <?php echo date(DATETIME_FORMAT,strtotime($arrOrderData['created_at']));?></p>
                            </div>
                          </div>
                          <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                            <div class="table-responsive w-100">
                                <table class="table">
                                  <thead>
                                    <tr class="bg-dark text-white">
                                        <th>#</th>
                                        <th>Item</th>
                                        <th class="text-right">Quantity</th>
                                        <th class="text-right">Unit cost</th>
                                        <th class="text-right">Total</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <?php if(isset($arrOrderProductData) && !empty($arrOrderProductData)):?>
                                      <?php $i=0;foreach($arrOrderProductData as $data):$i++;?>
                                      <tr class="text-right">
                                        <td class="text-left"><?php echo $i;?></td>
                                        <td class="text-left">
                                          <p><b><?php echo $data['item_name'];?></b></p>
                                          <br />
                                          <?php if($data['product_attribute_1'] != ''):?>
                                            <?php echo $data['product_attribute_1'];?> : <?php echo $data['product_option_1'];?>
                                          <?php endif;?>
                                          <?php if($data['product_attribute_2'] != ''):?>
                                            <br /><?php echo $data['product_attribute_2'];?> : <?php echo $data['product_option_2'];?>
                                          <?php endif;?>
                                          <?php if($data['product_attribute_3'] != ''):?>
                                            <br /><?php echo $data['product_attribute_3'];?> : <?php echo $data['product_option_3'];?>
                                          <?php endif;?>
                                          <?php if($data['item_tax_amount'] > 0):?>
                                            <p><b><br />Tax : <?php echo $currancy.$data['item_tax_amount'];?></b></p>
                                          <?php endif;?>
                                          <?php if($data['item_shipping_amount'] > 0):?>
                                            <p><b>Shipping Charge : <?php echo $currancy.$data['item_shipping_amount'];?></b></p>
                                          <?php endif;?>
                                        </td>
                                        <td><?php echo $data['ordered_quantity'];?></td>
                                        <td><?php echo $currancy.$data['product_option_price'];?></td>
                                        <td><?php echo $currancy.$data['final_item_price'];?></td>
                                      </tr>
                                      <?php endforeach;?>
                                    <?php endif;?>
                                  </tbody>
                                </table>
                              </div>
                          </div>
                          <div class="container-fluid mt-5 w-100">
                            <p class="text-right mb-2">Quantity : <?php echo $currancy.$arrOrderData['total_ordered_quantity'];?></p>
                            <p class="text-right">Items Total: <?php echo $currancy.$arrOrderData['total_items_amount'];?></p>
                            <?php if(isset($arrOrderData['total_items_tax_amount']) && $arrOrderData['total_items_tax_amount'] > 0):?>
                            <p class="text-right">Tax Total : <?php echo $currancy.$arrOrderData['total_items_tax_amount'];?></p>
                            <?php endif;?>
                            <?php if(isset($arrOrderData['total_items_shipping_amount']) && $arrOrderData['total_items_shipping_amount'] > 0):?>
                            <p class="text-right">Shipping Total : <?php echo $currancy.$arrOrderData['total_items_shipping_amount'];?></p>
                            <?php endif;?>
                            <?php if(isset($arrOrderData['shipping_amount']) && $arrOrderData['shipping_amount'] > 0):?>
                            <p class="text-right">Shipping Amount : <?php echo $currancy.$arrOrderData['shipping_amount'];?></p>
                            <?php endif;?>
                            <h4 class="text-right mb-5">Total : <?php echo $currancy.$arrOrderData['order_total'];?></h4>
                          </div>
                      </div>
                  </div>
              </div>
          
<?php endif;?>
</div>
<?php require_once $theme_path.'include/footerfront.php';?>