<div class="card">
                                <div class="card-header" role="tab" id="heading-10">
                                    <h6 class="mb-0">
                                        <a data-toggle="collapse" href="#collapse-10" aria-expanded="true"
                                            aria-controls="collapse-10">Product Details</a>
                                    </h6>
                                </div>
                                <div id="collapse-10" class="collapse show" role="tabpanel" aria-labelledby="heading-10"
                                    data-parent="#accordion-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <?php if($id == 0):?>
                                            <input type="hidden" class="form-control" name="products[created_at]" id="created_at"
                                                autocomplete="off" value="<?php echo date('Y-m-d h:i:s');?>" />
                                            <?php else :?>
                                            <input type="hidden" class="form-control" name="products[updated_at]" id="updated_at"
                                                autocomplete="off" value="<?php echo date('Y-m-d h:i:s');?>" />
                                            <?php endif;?>
                                            <input type="hidden" class="form-control" name="item_type" id="item_type"
                                                autocomplete="off" value="<?php echo $item_type;?>" />
                                            <input type="hidden" class="form-control" name="products[item_alias]" id="item_alias"
                                                autocomplete="off" value="<?php echo $item_alias;?>" />
                                            <?php
                                if(isset($arrFields) && !empty($arrFields)) {
                                    foreach($arrFields as $fields) {
                                        $mandatory = "";
                                        $required = "";
                                        if(isset($fields['mandatory']) && $fields['mandatory'] == 'Y') {
                                            $mandatory = "<span style='color:red;'>*</span>";
                                            $required = "required='required'";
                                        }
                                        if($fields['type'] == 'hidden') :
                                            ?>
                                            <?php 
                                            $field_value_hidden = "";
                                            if(isset($fields['value']) && $fields['value'] != "") {
                                                $field_value_hidden = $fields['value'];
                                            }
                                            if(isset($arrOnedata[$fields['db_column']]) && $arrOnedata[$fields['db_column']] != ''){$field_value_hidden = $arrOnedata[$fields['db_column']];}
                                            ?>
                                            <input type="hidden" class="form-control"
                                                name="<?php echo $fields['name'];?>" id="<?php echo $fields['name'];?>"
                                                autocomplete="off"
                                                value="<?php echo $field_value_hidden;?>" />
                                            <?php
                                        endif;
                                        if($fields['type'] == 'text' || $fields['type'] == 'date' || $fields['type'] == 'file'):
                                        ?>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?php
                                                $readonly = "";
                                                if($id > 0){
                                                    if(isset($fields['readonly']) && $fields['readonly'] == '1'){
                                                        $readonly = "readonly='readonly'";
                                                    }
                                                }
                                                ?>
                                                    <label
                                                        class="col-sm-12 col-form-label"><?php echo $fields['title'];?><?php echo $mandatory;?></label>
                                                        <?php 
                                                        $field_value = "";
                                                        if(isset($fields['value']) && $fields['value'] != "") {
                                                            $field_value = $fields['value'];
                                                        }
                                                        if(isset($arrOnedata[$fields['db_column']]) && $arrOnedata[$fields['db_column']] != ''){$field_value = $arrOnedata[$fields['db_column']];}?>
                                                    <input type="<?php echo $fields['type'];?>" class="form-control"
                                                        name="<?php echo $fields['name'];?>"
                                                        id="<?php echo $fields['name'];?>" autocomplete="off"
                                                        value="<?php echo $field_value;?>"
                                                        <?php echo $readonly;?> />
                                                    <div id="error_<?php echo $fields['db_column'];?>" class="formerror"
                                                        style="color:red;"></div>
                                                        <?php
                                                        if($fields['type'] == 'file') {
                                                            if(isset($arrOnedata[$fields['db_column']]) && $arrOnedata[$fields['db_column']] != "") {?>
                                                                <a class="text-center" target="_blank" href="<?php echo PRODUCTS_URL.$arrOnedata[$fields['db_column']];?>">View File</a>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                </div>
                                            </div>
                                            <?php
                                        endif;
                                        if($fields['type'] == 'select'):
                                            //print_r($arrOnedata[$fields['db_column']]);
                                        ?>
                                        <?php
                                        $arrExistingMultipleData = array();
                                        if(isset($fields['multiple']) && $fields['multiple'] != "" && isset($fields['db_column'])){
                                            $arrExistingMultipleData = explode(",",$arrOnedata[$fields['db_column']]); 
                                            //print_r($arrExistingMultipleData);          
                                        }?>
                                            <div class="col-md-3">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-sm-12 col-form-label"><?php echo $fields['title'];?><?php echo $mandatory;?></label>
                                                    <div class="col-sm-12">
                                                        <select class="js-example-basic-single w-100"
                                                            name="<?php echo $fields['name'];?>"
                                                            <?php if(isset($fields['multiple']) && $fields['multiple'] != ""){echo "multiple='multiple'";}?>
                                                            id="<?php echo $fields['name'];?>">
                                                            <?php if(isset($fields['options']) && !empty($fields['options'])):?>
                                                            <?php foreach($fields['options'] as $key => $value):?>
                                                            <option value="<?php echo $key;?>"
                                                                <?php 
                                                                foreach($arrExistingMultipleData as $multipleData){
                                                                    $selected = "";
                                                                    if($multipleData == $key) {
                                                                        $selected = "selected='selected'";
                                                                    }
                                                                    echo $selected; 
                                                                }
                                                                ?>
                                                                <?php if(isset($arrOnedata[$fields['db_column']]) && $arrOnedata[$fields['db_column']] == $key){echo "selected='selected'";}?>
                                                                >
                                                                <?php echo $value;?></option>
                                                            <?php endforeach;?>
                                                            <?php endif;?>
                                                        </select>
                                                        <div id="error_<?php echo $fields['db_column'];?>" class="formerror"
                                                            style="color:red;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        endif;
                                        if($fields['type'] == 'textarea'):
                                            ?>
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-sm-12 col-form-label"><?php echo $fields['title'];?></label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control"
                                                            id="<?php if(isset($fields['id'])){echo $fields['id'];}else{echo $fields['name'];}?>"
                                                            name="<?php echo $fields['name'];?>"><?php if(isset($arrOnedata[$fields['db_column']]) && $arrOnedata[$fields['db_column']] != ''){echo $arrOnedata[$fields['db_column']];}?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            endif;
                                    }
                                }
                                ?>
                                        </div>
                                    </div>
                                </div>
                            </div>