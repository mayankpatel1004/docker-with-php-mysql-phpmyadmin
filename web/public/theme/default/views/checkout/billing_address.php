<?php
global $theme_path;
require_once $theme_path.'generated_files/checkout_billing.php';
?>
<div class="col-md-6 col-sm-12">
    <p><h5 class="text-primary">Your billing address</h5></p>
    <div class="row" id="billing_part">      
        <?php if(isset($arrFields) && !empty($arrFields)):?>
            <?php foreach($arrFields as $fields):?>
                <div class="col-md-4">
                    <div class="form-group">
                    <input type="text" class="form-control" id="<?php echo $fields['name'];?>" name="<?php echo $fields['name'];?>" placeholder="<?php echo $fields['title'];?>" value="<?php echo $fields['value'];?>" />
                    </div>
                </div>
            <?php endforeach;?>
                <div class="col-md-6">
                    <select name="billing_shipping_same" class="form-control" onchange="updateShippingAddress(this.value)">
                        <option value="">Both Same Address</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
        <?php endif;?>
    </div>
</div>
<script type="text/javascript">
function updateShippingAddress(value){
    if(value == 'Yes') {
        $("#shipping_part #shipping_first_name").val($("#billing_part #billing_first_name").val());
        $("#shipping_part #shipping_last_name").val($("#billing_part #billing_last_name").val());
        $("#shipping_part #shipping_address_1").val($("#billing_part #billing_address_1").val());
        $("#shipping_part #shipping_address_2").val($("#billing_part #billing_address_2").val());
        $("#shipping_part #shipping_city").val($("#billing_part #billing_city").val());
        $("#shipping_part #shipping_state").val($("#billing_part #billing_state").val());
        $("#shipping_part #shipping_country").val($("#billing_part #billing_country").val());
        $("#shipping_part #shipping_zipcode").val($("#billing_part #billing_zipcode").val());
        $("#shipping_part #shipping_contact").val($("#billing_part #billing_contact").val());
        $("#shipping_part #shipping_email").val($("#billing_part #billing_email").val());
    }
}
</script>