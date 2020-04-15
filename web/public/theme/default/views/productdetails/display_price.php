<?php
$product_price_display = 0;
$product_price_id = 0;
$product_price = $arrProductData['arrProductDefaultPrice']['product_option_price'];
if($arrProductData['arrProductDefaultPrice']['product_option_price'] < $arrProductData['arrProductDefaultPrice']['product_option_price_display']) {
    $product_price_display  = $arrProductData['arrProductDefaultPrice']['product_option_price_display'];
}
if(isset($arrProductData['arrProductDefaultPrice']['product_price_id']) && $arrProductData['arrProductDefaultPrice']['product_price_id'] > 0) {
    $product_price_id = $arrProductData['arrProductDefaultPrice']['product_price_id'];
}
?>
<?php if(DISPLAY_PRICE == 'Y'):?>
<p>Product Price : <?php if($product_price_display > 0){?><s><?php echo $currancy;?><span id="print_price_display"><?php echo $product_price_display;?></span></s><?php }?>&nbsp;&nbsp;<?php echo $currancy;?><span id="print_price"><?php echo $product_price;?></span></p>
<?php endif;?>
<input type="hidden" id="product_price_id" value="<?php echo $product_price_id;?>" />