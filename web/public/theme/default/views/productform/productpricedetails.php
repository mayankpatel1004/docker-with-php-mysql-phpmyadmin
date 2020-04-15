<?php //print_r($arrProductDefaultPricedata);?>
<div class="card">
    <div class="card-header" role="tab" id="heading-11">
        <h6 class="mb-0">
            <a class="collapsed" data-toggle="collapse" href="#collapse-11"
                aria-expanded="false" aria-controls="collapse-11">
                Product Price Details
            </a>
        </h6>
    </div>
    <div id="collapse-11" class="collapse" role="tabpanel" aria-labelledby="heading-11"
        data-parent="#accordion-4">
        <div class="card-body">
        <p class="text-primary text-center">Please enter your product price</p>
            <div class="row">
                <?php
                if(isset($arrPriceFields) && !empty($arrPriceFields)) {
                    foreach($arrPriceFields as $fields) {
                        $mandatory = "";
                        $required = "";
                        if($fields['type'] == 'text' || $fields['type'] == 'file'):
                            ?>
                            <div class="col-md-2" <?php if(isset($fields['db_column']) && $fields['db_column'] == "is_default_price"){echo "style='display:none;'";}?>>
                                <div class="form-group">
                                    <?php
                                    $readonly = "";
                                    if($id > 0){
                                        if(isset($fields['readonly']) && $fields['readonly'] == '1'){
                                            $readonly = "readonly='readonly'";
                                        }
                                    }
                                    ?>
                                    <?php 
                                    $product_price_value = "";
                                    if(isset($fields['db_column']) && $fields['db_column'] != "" && isset($fields['value'])) { $product_price_value = $fields['value'];}
                                    if(isset($arrProductDefaultPricedata[$fields['db_column']]) && $arrProductDefaultPricedata[$fields['db_column']] != ''){$product_price_value = $arrProductDefaultPricedata[$fields['db_column']];}
                                    ?>
                                    <label class="col-sm-12 col-form-label"><?php echo $fields['title'];?><?php echo $mandatory;?></label>
                                    <input type="<?php echo $fields['type'];?>" class="form-control"
                                        name="<?php echo $fields['name'];?>"
                                        id="<?php echo $fields['name'];?>" autocomplete="off"
                                        value="<?php echo $product_price_value;?>"
                                        <?php echo $readonly;?> />
                                    <div id="error_<?php echo $fields['db_column'];?>" class="formerror"
                                        style="color:red;"></div>
                                </div>
                            </div>
                            <?php
                            endif;
                    }
                }
                ?>
            </div>

            <?php
            if(isset($arrProductAttributesData) && $arrProductAttributesData != false):
                ?>
                <p class="text-primary text-center">Your Product existing attributes</p>
                <div class="row product-price-border-top pt-4 existing-attribues">
                    <div class="col-md-1">Price</div>
                    <div class="col-md-2">Display</div>
                    <div class="col-md-1">Tax</div>
                    <div class="col-md-1">Ship.</div>
                    <div class="col-md-1">Qty</div>
                    <div class="col-md-2">Min Qty.</div>
                    <div class="col-md-1">Att. 1</div>
                    <div class="col-md-1">Opt. 1</div>
                    <div class="col-md-1">Att. 2</div>
                    <div class="col-md-1">Opt. 2</div>
                </div>
                
                    <?php
                foreach($arrProductAttributesData as $data):
                    ?>
                    <div class="row existing-attribues">
                        <div class="col-md-1"><br /><input type="text" value="<?php echo $data['product_option_price'];?>" class="form-control" placeholder="Attribute" /></div>
                        <div class="col-md-2"><br /><input type="text" value="<?php echo $data['product_option_price_display'];?>" class="form-control" placeholder="Option" /></div>
                        <div class="col-md-1"><br /><input type="text" value="<?php echo $data['item_tax_amount'];?>" class="form-control" placeholder="Product Price" /></div>
                        <div class="col-md-1"><br /><input type="text" value="<?php echo $data['item_shipping_amount'];?>" class="form-control" placeholder="Display Price" /></div>
                        <div class="col-md-1"><br /><input type="text" value="<?php echo $data['product_quantity'];?>" class="form-control" placeholder="Quantity" /></div>
                        <div class="col-md-2"><br /><input type="text" value="<?php echo $data['min_quantity_notification'];?>" class="form-control" placeholder="Tax" /></a></div>
                        <div class="col-md-1"><br /><input type="text" value="<?php echo $data['product_attribute_1'];?>" class="form-control" placeholder="Tax" /></a></div>
                        <div class="col-md-1"><br /><input type="text" value="<?php echo $data['product_option_1'];?>" class="form-control" placeholder="Tax" /></a></div>
                        <div class="col-md-1"><br /><input type="text" value="<?php echo $data['product_attribute_2'];?>" class="form-control" placeholder="Tax" /></a></div>
                        <div class="col-md-1"><br /><input type="text" value="<?php echo $data['product_option_2'];?>" class="form-control" placeholder="Tax" /></a></div>
                        </div>
                    <?php
                endforeach;
                ?><?php
            endif;
            ?>

            <div class="row_point_a4 list-group">

            </div>
            <br />
            <p class="text-danger">Note : Product attributes won't be change once it will added to this product. In case you are willing to modify or remove, you need to delete this product.</p>
            <br />
            <?php if(isset($arrProductAttributesData) && $arrProductAttributesData == false):?>
            <input type="button" value="Add Attribute" class="btn ml-2 btn-primary add_row_point_a4 mb-2" />
            <?php endif;?>
        </div>
    </div>
</div>