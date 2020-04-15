<?php
global $page_data,$currancy;
require $theme_path.'include/header.php';
?>
<div class="main-panel">
<div class="content-wrapper">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-primary"><?php echo $item_alias;?> form</h4>
                <div class="row"><div class="col-md-12" id="error_message" style="color:red;text-align:center;"></div></div>
                <form class="form-sample" action="<?php echo $save_url ; ?>" id="ajax-upload" method="post" enctype="multipart/form-data">
                <h4 class="text-primary">Order # - <?php echo $arrOrderData['order_id_unique'];?></h4>
                <br />
                <div class="row">
                    <div class="col-md-6">
                        <p><b>Billing Details</b></p>
                        <p><?php echo $arrOrderData['billing_address_1'];?> <?php echo $arrOrderData['billing_address_2'];?><br><?php echo $arrOrderData['billing_city'];?> <?php echo $arrOrderData['billing_state'];?>,<br><?php echo $arrOrderData['billing_country'];?>, <?php echo $arrOrderData['billing_zipcode'];?></p>
                    </div>
                    <div class="col-md-6">
                    <p class="text-right"><b>Shipping Details</b></p>
                    <p class="text-right"><?php echo $arrOrderData['shipping_address_1'];?> <?php echo $arrOrderData['shipping_address_2'];?><br><?php echo $arrOrderData['shipping_city'];?> <?php echo $arrOrderData['shipping_state'];?>,<br><?php echo $arrOrderData['shipping_country'];?>, <?php echo $arrOrderData['shipping_zipcode'];?></p>
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
                <div class="row">
                        <?php if($id == 0):?>
                        <input type="hidden" class="form-control" name="created_at" id="created_at" autocomplete="off" value="<?php echo date('Y-m-d h:i:s');?>" />
                        <?php else :?>
                        <input type="hidden" class="form-control" name="updated_at" id="updated_at" autocomplete="off" value="<?php echo date('Y-m-d h:i:s');?>" />
                        <?php endif;?>
                        <input type="hidden" class="form-control" name="order_id" id="order_id" autocomplete="off" value="<?php echo $arrOrderData['order_id'];?>" />
                        <?php
                        if(isset($arrFields) && !empty($arrFields)) {
                            foreach($arrFields as $fields) {
                                if($fields['type'] == 'hidden') :
                                    ?>
                                    <input type="hidden" class="form-control" name="<?php echo $fields['name'];?>" id="<?php echo $fields['name'];?>" autocomplete="off" value="<?php if(isset($arrOrderData[$fields['name']]) && $arrOrderData[$fields['name']] != ''){echo $arrOrderData[$fields['name']];}?>" />
                                    <?php
                                endif;
                                if($fields['type'] == 'text'):
                                ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-12 col-form-label"><?php echo $fields['title'];?></label>
                                        <input type="<?php echo $fields['type'];?>" class="form-control" name="<?php echo $fields['name'];?>" id="<?php echo $fields['name'];?>" autocomplete="off" value="<?php if(isset($arrOrderData[$fields['name']]) && $arrOrderData[$fields['name']] != ''){echo $arrOrderData[$fields['name']];}?>" />
                                        <div id="error_<?php echo $fields['name'];?>" class="formerror" style="color:red;"></div>
                                    </div>
                                </div>
                                
                                <?php
                                endif;

                                if($fields['type'] == 'select'):
                                ?>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                    <label class="col-sm-12 col-form-label"><?php echo $fields['title'];?></label>
                                        <div class="col-sm-12">
                                            <select class="js-example-basic-single w-100" name="<?php echo $fields['name'];?>" id="<?php echo $fields['name'];?>">
                                                <?php if(isset($fields['options']) && !empty($fields['options'])):?>
                                                    <?php foreach($fields['options'] as $key => $value):?>
                                                        <option value="<?php echo $key;?>" <?php if(isset($arrOrderData[$fields['name']]) && $arrOrderData[$fields['name']] == $key){echo "selected='selected'";}?>><?php echo $value;?></option>
                                                    <?php endforeach;?>
                                                <?php endif;?>
                                            </select>
                                            <div id="error_<?php echo $fields['name'];?>" class="formerror" style="color:red;"></div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                endif;

                                if($fields['type'] == 'textarea'):
                                    ?>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                        <label class="col-sm-12 col-form-label"><?php echo $fields['title'];?></label>
                                            <div class="col-sm-12">
                                                <textarea class="form-control" id="<?php if(isset($fields['id'])){echo $fields['id'];}else{echo $fields['name'];}?>" name="<?php echo $fields['name'];?>"><?php if(isset($arrOrderData[$fields['name']]) && $arrOrderData[$fields['name']] != ''){echo $arrOrderData[$fields['name']];}?></textarea>
                                                <div id="error_<?php echo $fields['name'];?>" class="formerror" style="color:red;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    endif;
                            }
                        }
                        ?>                            
                    </div>
                    <input class="btn btn-primary" type="submit" value="Submit"/>
                    <input class="btn btn-primary" type="reset" value="Reset"/>
                    <a class="btn btn-primary" href="<?php echo $url.$item_alias;?>">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once $theme_path.'include/prefooter.php';?>
<?php require $theme_path.'include/scripts.php';?>
</div>
    <link rel="stylesheet" href="<?php echo $theme_url;?>vendors/bootstrap-datepicker/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="<?php echo $theme_url;?>vendors/summernote/dist/summernote.css" />        
    <script src="<?php echo $theme_url;?>vendors/select2/select2.min.js"></script>
    <script src="<?php echo $theme_url;?>vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo $theme_url;?>vendors/summernote/dist/summernote.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function(){
        $('#ajax-upload').on('submit', function(e){
            e.preventDefault();
            var form = e.target;
            $(".formerror").html('');
            $.ajax({
                url: form.action,
                dataType: 'json',
                method : "post",
                contentType: false,
                cache: false,
                processData:false, 
                data: new FormData(this),
                //data: $('#ajax-upload').serialize(),
                success: function(result){
                    if(result.error == '0'){
                        location.href = '<?php echo $url.$item_alias; ?>';
                    }else{
                        var response = result.values;
                        if(result.message != '') {
                            $("#error_message").html(result.message);
                        }

                        for (var key in response) {
                            if (response.hasOwnProperty(key)) {
                                $("#error_"+key+"").html(response[key]);
                            }
                        }
                    }
                }
            });
        });
    });    
    </script>                

    <script type="text/javascript">
        $('#datepicker-popup').datepicker();
        $('#summernoteExample').summernote({
            height:300,tabsize:2
        });
        (function($) {
        'use strict';
        if ($("#fileuploader").length) {
            $("#fileuploader").uploadFile({
            url: "<?php echo $theme_url;?>",
            fileName: "myfile"
            });
        }
        })(jQuery);
        (function($) {
        'use strict';
        if ($(".js-example-basic-single").length) {
            $(".js-example-basic-single").select2();
        }
        if ($(".js-example-basic-multiple").length) {
            $(".js-example-basic-multiple").select2();
        }
        })(jQuery);
    </script>
    

    <script src="<?php echo $theme_url;?>vendors/jquery-tags-input/jquery.tagsinput.min.js"></script>
    <script type="text/javascript">
    $('#tags').tagsInput({
        'width': '100%',
        'height': '75%',
        'interactive': true,
        'defaultText': 'Add Tags',
        'removeWithBackspace': true,
        'minChars': 0,
        'maxChars': 20, // if not provided there is no limit
        'placeholderColor': '#666666'
    });
    </script>

    <script type="text/javascript">
    (function($) {
    'use strict';
    $(function() {
        $('.file-upload-browse').on('click', function() {
        var file = $(this).parent().parent().parent().find('.file-upload-default');
        file.trigger('click');
        });
        $('.file-upload-default').on('change', function() {
        $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
        });
    });
    })(jQuery);
    </script>
<?php require_once $theme_path.'include/footer.php';?>