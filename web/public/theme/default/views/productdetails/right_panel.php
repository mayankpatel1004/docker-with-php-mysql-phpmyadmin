<?php //echo "<pre>";print_r($arrProductData);
$arrProductDetails = $arrProductData['arrProductDetails'];
global $currancy;
?>
<div class="row">
    <div class="col-md-12">
        <?php if(DISPLAY_CATEGORY == 'Y'):?>
            <?php if(isset($arrProductDetails['item_category_alias']) && $arrProductDetails['item_category_alias'] != ""):?>
            <p>Categories : <?php echo $arrProductDetails['item_category_alias'];?></p>
            <?php endif;?>
        <?php endif;?>
        
        <?php require 'display_price.php';?>
        
        <?php if(DISPLAY_WEIGHT == 'Y'):?>
            <?php if(isset($arrProductDetails['item_weight']) && $arrProductDetails['item_weight'] != ""):?>
            <p>Weight : <?php echo $arrProductDetails['item_weight'];?></p>
            <?php endif;?>
        <?php endif;?>
        
        <?php if(DISPLAY_INSTOCK == 'Y'):?>
            <?php if(isset($arrProductDetails['in_stock']) && $arrProductDetails['in_stock'] != ""):?>
            <p>In Stock : <?php echo $arrProductDetails['in_stock'] == 'Y' ? 'Yes' : 'No';?></p>
            <?php endif;?>
        <?php endif;?>
        
        <?php if(DISPLAY_SHIPPING_PRICE == 'Y'):?>
            <?php if(isset($arrProductDetails['item_shipping_price']) && $arrProductDetails['item_shipping_price'] > 0):?>
            <p>Shipping Price : <?php echo $arrProductDetails['item_shipping_price'];?></p>
            <?php endif;?>
        <?php endif;?>
        
        <?php if(DISPLAY_DESCRIPTION == 'Y'):?>
            <?php if(isset($arrProductDetails['item_description']) && $arrProductDetails['item_description'] != ''):?>
            <p>Description : <?php echo $arrProductDetails['item_description'];?></p>
            <?php endif;?>
        <?php endif;?>

        <?php if(DISPLAY_TERMS_CONDITIONS == 'Y'):?>
            <?php if(isset($arrProductDetails['item_terms_conditions']) && $arrProductDetails['item_terms_conditions'] != ''):?>
            <p>Terms & Conditions : <?php echo $arrProductDetails['item_terms_conditions'];?></p>
            <?php endif;?>
        <?php endif;?>
        <br />
        <?php if(DISPLAY_ADD_TO_CART == 'Y'):?>
            <?php require_once 'add_to_cart.php';?>
        <?php endif;?>
        <br />
        <div class="sharethis-inline-share-buttons"></div>
    </div>
</div>