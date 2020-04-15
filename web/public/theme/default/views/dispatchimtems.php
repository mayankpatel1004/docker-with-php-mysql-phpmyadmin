<?php
global $page_data;
require $theme_path.'include/header.php';
?>
<div class="main-panel">
<div class="content-wrapper">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-primary"><?php echo $item_alias;?> Dispatch </h4>
                <div class="row"><div class="col-md-12" id="error_message" style="color:red;text-align:center;"></div></div>
                <form class="form-sample" action="<?php echo $save_url ; ?>" id="ajax-upload" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <?php if($id == 0):?>
                        <input type="hidden" class="form-control" name="created_at" id="created_at" autocomplete="off" value="<?php echo date('Y-m-d h:i:s');?>" />
                        <input type="hidden" class="form-control" name="created_by" id="created_by" autocomplete="off" value="<?php echo $_SESSION[$back_session_name]['user_id'];?>" />
                        <input type="hidden" class="form-control" name="created_by_name" id="created_by_name" autocomplete="off" value="<?php echo $_SESSION[$back_session_name]['first_name']." ".$_SESSION[$back_session_name]['last_name'];?>" />
                        <?php else :?>
                        <input type="hidden" class="form-control" name="updated_at" id="updated_at" autocomplete="off" value="<?php echo date('Y-m-d h:i:s');?>" />
                        <?php endif;?>
                        <input type="hidden" class="form-control" name="item_alias" id="item_alias" autocomplete="off" value="<?php echo $item_alias;?>" />
                        <?php
                        if(isset($arrFieldsDispatches) && !empty($arrFieldsDispatches)) {
                            foreach($arrFieldsDispatches as $fields) {
                                $mandatory = "";
                                $required = "";
                                if(isset($fields['mandatory']) && $fields['mandatory'] == 'Y') {
                                    $mandatory = "<span style='color:red;'>*</span>";
                                    $required = "required='required'";
                                }
                                if($fields['type'] == 'hidden') :
                                    ?>
                                    <?php
                                    $hidden_value = "";
                                    if(isset($fields['value']) && $fields['value'] != ''){
                                        $hidden_value = $fields['value'];
                                    }
                                    if(isset($arrOnedata[$fields['name']]) && $arrOnedata[$fields['name']] != ''){
                                        $hidden_value = $arrOnedata[$fields['name']];
                                    }
                                    ?>
                                    <input type="hidden" class="form-control" name="<?php echo $fields['name'];?>" id="<?php echo $fields['name'];?>" autocomplete="off" value="<?php echo $hidden_value;?>" />
                                    <?php
                                endif;
                                if($fields['type'] == 'text'):
                                
                                    $readonly = "";
                                    if(isset($fields['readonly']) && $fields['readonly'] == '1'){
                                        $readonly = "readonly='readonly'";
                                    }
                                ?>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-sm-12 col-form-label"><?php echo $fields['title'];?><?php echo $mandatory;?></label>
                                        <input type="<?php echo $fields['type'];?>" class="form-control" name="<?php echo $fields['name'];?>" id="<?php echo $fields['name'];?>" autocomplete="off" value="<?php if(isset($arrOnedata[$fields['name']]) && $arrOnedata[$fields['name']] != ''){echo $arrOnedata[$fields['name']];}?>" <?php echo $readonly;?> />
                                        <div id="error_<?php echo $fields['name'];?>" class="formerror" style="color:red;"></div>
                                    </div>
                                </div>
                                
                                <?php
                                endif;
                                if($fields['type'] == 'file'):
                                    ?>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-sm-12 col-form-label"><?php echo $fields['title'];?><?php echo $mandatory;?></label>
                                            <input type="<?php echo $fields['type'];?>" class="form-control" name="<?php echo $fields['name'];?>" id="<?php echo $fields['name'];?>" autocomplete="off" value="<?php if(isset($arrOnedata[$fields['name']]) && $arrOnedata[$fields['name']] != ''){echo $arrOnedata[$fields['name']];}?>" />
                                            <div id="error_<?php echo $fields['name'];?>" class="formerror" style="color:red;"></div>
                                        </div>
                                    </div>
                                    
                                    <?php
                                    endif;

                                if($fields['type'] == 'select'):
                                ?>
                                <div class="col-md-3">
                                    <div class="form-group row">
                                    <label class="col-sm-12 col-form-label"><?php echo $fields['title'];?><?php echo $mandatory;?></label>
                                        <div class="col-sm-12">
                                            <?php 
                                            $action_name = "";
                                            if(isset($fields['onChange']) && $fields['onChange'] != ''){
                                                $action_name = $fields['onChange'].'(this.value)';
                                            }
                                            ?>
                                            <select  class="js-example-basic-single w-100" <?php if($action_name != ''){?>onchange="<?php echo $action_name;?>" <?php }?> name="<?php echo $fields['name'];?>" id="<?php echo $fields['name'];?>">
                                                <?php if(isset($fields['options']) && !empty($fields['options'])):?>
                                                    <?php foreach($fields['options'] as $key => $value):?>
                                                        <option value="<?php echo $key;?>" <?php if(isset($arrOnedata[$fields['name']]) && $arrOnedata[$fields['name']] == $key){echo "selected='selected'";}?>><?php echo $value;?></option>
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
                                        <label class="col-sm-12 col-form-label"><?php echo $fields['title'];?><?php echo $mandatory;?></label>
                                            <div class="col-sm-12">
                                                <textarea class="form-control" id="<?php if(isset($fields['id'])){echo $fields['id'];}else{echo $fields['name'];}?>" name="<?php echo $fields['name'];?>"><?php if(isset($arrOnedata[$fields['name']]) && $arrOnedata[$fields['name']] != ''){echo $arrOnedata[$fields['name']];}?></textarea>
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
<?php $get_data_url = $url.'allinventories/getItemdata/?item_id=';?>
</div>
    <link rel="stylesheet" href="<?php echo $theme_url;?>vendors/bootstrap-datepicker/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="<?php echo $theme_url;?>vendors/summernote/dist/summernote.css" />        
    <script src="<?php echo $theme_url;?>vendors/select2/select2.min.js"></script>
    <script src="<?php echo $theme_url;?>vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo $theme_url;?>vendors/summernote/dist/summernote.min.js"></script>

    <script type="text/javascript">
    function fnGetItemDetails(item_id) {
        $("#total_item_size").html('<option value="0">Select Size</option>');
        $("#total_items").html('<option value="0">Select Total Item</option>');
        $(".formerror").html('');
        $.ajax({
                url: '<?php echo $get_data_url;?>'+item_id,
                dataType: 'json',
                method : "post",
                contentType: false,
                cache: false,
                processData:false, 
                success: function(result){
                    if(typeof result !== undefined){
                        $("#item_title").val(result.values.item_title);
                        $("#is_partial").val(result.values.is_partial);
                        $("#item_unit").val(result.values.item_unit);
                        $("#item_price").val(result.values.item_price);
                        $("#po_number").val(result.values.po_number);
                        $("#item_size").val(result.values.item_size)
                        $("#total_items_before_entry").val(result.values.total_item);

                        if(result.values.is_partial == 'N'){
                            if(parseInt(result.values.total_item) > 0){
                                var total_items_options = "";
                                var counter = 1;
                                for(i = 1;i <= result.values.total_item;i++) {
                                    total_items_options = total_items_options + '<option value='+i+'>'+i+' '+result.values.item_unit+'</option>';
                                }
                                $("#total_items").html(total_items_options);
                            }
                        }
                        
                        if(result.values.is_partial == 'Y'){
                            if(parseInt(result.values.total_item_size) > 0){
                                //$("#error_total_item_size").html("You have maximum "+result.values.total_item_size+" "+result.values.item_unit+" "+result.values.item_title);
                                //$("#error_total_item_size").css("color","green");
                                var total_item_string = "";
                                var counter = 1;
                                if(result.values.total_item_size > 100000) {
                                    counter = 1000;
                                }
                                else if(result.values.total_item_size > 50000) {
                                    counter = 500;
                                }
                                else if(result.values.total_item_size > 10000) {
                                    counter = 100;
                                }
                                else if(result.values.total_item_size > 1000) {
                                    counter = 1;
                                }

                                for(i = 1;i <= result.values.total_item_size;i=i+counter) {
                                    total_item_string = total_item_string + '<option value="'+i+'">'+ i+ ' '+result.values.item_unit+"</option>";
                                }
                                $("#total_item_size").html(total_item_string);
                                //console.log(total_item_string);
                            } else {
                                $("#error_total_item_size").html("");
                            }
                        }
                    }
                }
            });
    }
    
    $(document).ready(function(){
        //console.log("form data ====>",new FormData(this));
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
                success: function(result){
                    if(result.error == '0'){
                        showSwal('success-comment');
                        setTimeout(function(){ location.reload(); }, 1000);
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