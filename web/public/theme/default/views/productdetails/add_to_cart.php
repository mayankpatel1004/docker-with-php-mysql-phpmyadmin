<?php
global $cart_id;
$has_option = 'N';
if(isset($arrProductData['arrPrimaryAttributes']['product_attribute_1']) && $arrProductData['arrPrimaryAttributes']['product_attribute_1'] != "") {
    $has_option = 'Y';
}
?>
<div class="row">
    <?php if(isset($arrProductData['arrPrimaryAttributes']) && $arrProductData['arrPrimaryAttributes'] != false):?>
        <?php        
            for($i=1;$i<=3;$i++) {
                if($arrProductData['arrPrimaryAttributes']['product_attribute_'.$i] != ""):
                ?>
                <div class="col-md-4 col-xs-12">
                    <select name="attribute_title" id="product_attribute_<?php echo $i;?>" onchange="getOptions(<?php echo $i;?>,this.value)" class="form-control attributes_select_box">
                        <option value="<?php echo $arrProductData['arrPrimaryAttributes']['product_attribute_'.$i];?>">Select <?php echo $arrProductData['arrPrimaryAttributes']['product_attribute_'.$i];?></option>
                        <?php if(isset($arrProductData['arrPrimaryOptions']) && $arrProductData['arrPrimaryOptions'] != false):?>
                            <?php if($i == 1):?>
                            <?php foreach($arrProductData['arrPrimaryOptions'] as $options):?>
                                <option value="<?php echo $options['product_option_1'];?>"><?php echo ucfirst($options['product_option_1']);?></option>
                            <?php endforeach;?>
                            <?php endif;?>
                        <?php endif;?>
                    </select>
                    <br />
                </div>
                <?php
                endif;
            }
            ?>
    <?php endif;?>
</div>
<div class="row">
    <div class="col-md-3">
        <input type="text" name="item_quantity" id="item_quantity" class="form-control" value="1" />
    </div>
    <div class="col-md-3">
        <input type="button" name="add_to_cart" onclick="addToCart('<?php echo $cart_id;?>','<?php echo $arrProductData['arrProductDetails']['item_id'];?>',document.getElementById('product_price_id').value,'<?php echo $url;?>',document.getElementById('item_quantity').value,'<?php echo $has_option;?>')" id="add_to_cart" class="btn btn-primary" value="Add to cart" />
        
    </div>
</div>
<div class="row">
    <div class="col-md-12">
    <div id="cart_error" class="cart-status-message"></div>
    <div id="cart_success" class="cart-status-message"></div>
    </div>
</div>
<script type="text/javascript">
function getOptions(number,current_value) {
    //alert($(".attributes_select_box").length);
    var option = '';
    var next_option = parseInt(number)+parseInt(1);
    for(i=1;i<4;i++){
        option += $("#product_attribute_"+i).val()+",";
    }
    $.ajax({
        method: "POST",
        url: "<?php echo $url.'products/getAjaxOptions';?>",
        data: { option:option, attribute_number: number,total_options : $(".attributes_select_box").length,item_id : '<?php echo $arrProductData['arrProductDetails']['item_id'];?>' }
    })
    .done(function( response ) {
        //alert( "Data Saved: " + msg );
        response = JSON.parse(response);
        $("#product_attribute_"+next_option).html(response.option_string);
        $("#print_price").html(response.product_option_price);
        $("#print_price_display").html(response.product_option_price_display);
        $("#product_price_id").val(response.product_price_id);
        //console.log(response.option_string);
    });

}
</script>