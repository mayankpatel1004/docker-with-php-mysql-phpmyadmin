<?php
global $theme_path;
require_once $theme_path.'generated_files/checkout_shipping.php';
?>
<div class="col-md-6 col-sm-12">
    <p><h5 class="text-primary">Your Shipping address</h5></p>
    <div class="row" id="shipping_part">      
        <?php if(isset($arrFields) && !empty($arrFields)):?>
            <?php foreach($arrFields as $fields):?>
                <div class="col-md-4">
                    <div class="form-group">
                    <input type="text" class="form-control" id="<?php echo $fields['name'];?>" name="<?php echo $fields['name'];?>" placeholder="<?php echo $fields['title'];?>" value="<?php echo $fields['value'];?>" />
                    </div>
                </div>
            <?php endforeach;?>
        <?php endif;?>
    </div>
</div>