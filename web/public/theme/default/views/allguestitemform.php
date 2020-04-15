<?php
global $page_data,$front_session_name;
require $theme_path.'include/headerfront.php';
?>
<div class="main-panel">
<div class="content-wrapper">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-primary"><?php echo $item_alias;?> form</h4>
                <div class="row"><div class="col-md-12" id="error_message" style="color:red;text-align:center;"></div></div>
                <form class="form-sample" action="<?php echo $save_url ; ?>" id="ajax-upload" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <?php if($id == 0):?>
                        <input type="hidden" class="form-control" name="created_at" id="created_at" autocomplete="off" value="<?php echo date('Y-m-d h:i:s');?>" />
                        <input type="hidden" class="form-control" name="display_status" id="display_status" autocomplete="off" value="N" />
                        <?php else :?>
                        <input type="hidden" class="form-control" name="updated_at" id="updated_at" autocomplete="off" value="<?php echo date('Y-m-d h:i:s');?>" />
                        <?php endif;?>
                        <input type="hidden" class="form-control" name="guest_item" id="guest_item" autocomplete="off" value="Y" />
                        <input type="hidden" class="form-control" name="controller" id="controller" autocomplete="off" value="pages" />
                        <input type="hidden" class="form-control" name="user_id" id="user_id" autocomplete="off" value="<?php echo $_SESSION[$front_session_name]['customer_id'];?>" />
                        <input type="hidden" class="form-control" name="item_alias" id="item_alias" autocomplete="off" value="<?php echo $item_alias;?>" />
                        <input type="hidden" class="form-control" name="item_type" id="item_type" autocomplete="off" value="<?php echo $item_type;?>" />
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
                                    <input type="hidden" class="form-control" name="<?php echo $fields['name'];?>" id="<?php echo $fields['name'];?>" autocomplete="off" value="<?php if(isset($arrOnedata[$fields['name']]) && $arrOnedata[$fields['name']] != ''){echo $arrOnedata[$fields['name']];}?>" />
                                    <?php
                                endif;
                                if($fields['type'] == 'text' || $fields['type'] == 'file' || $fields['type'] == 'number'):
                                ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-12 col-form-label"><?php echo $fields['title'];?><?php echo $mandatory;?></label>
                                        <input type="<?php echo $fields['type'];?>" class="form-control" name="<?php echo $fields['name'];?>" id="<?php echo $fields['name'];?>" autocomplete="off" value="<?php if(isset($arrOnedata[$fields['name']]) && $arrOnedata[$fields['name']] != ''){echo $arrOnedata[$fields['name']];}?>" />
                                        <?php
                                        if($fields['type'] == 'file') {
                                            if(isset($arrOnedata[$fields['name']]) && ($arrOnedata[$fields['name']] != "" && is_file(ITEMS_PATH.$arrOnedata[$fields['name']]))) {?>
                                                    <a href="<?php echo ITEMS_URL.$arrOnedata[$fields['name']];?>" title="<?php echo $arrOnedata[$fields['name']];?>" target="_blank">View file</a>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <div id="error_<?php echo $fields['name'];?>" class="formerror" style="color:red;"></div>
                                    </div>
                                </div>
                                <?php
                                endif;

                                if($fields['type'] == 'date'):
                                    ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-sm-12 col-form-label"><?php echo $fields['title'];?><?php echo $mandatory;?></label>
                                            <div class="input-group date datepicker datepicker-popup">
                                                <?php
                                                $date_value = "";
                                                if(isset($arrOnedata[$fields['name']]) && $arrOnedata[$fields['name']] != ''){
                                                    $date_value = date('m/d/Y',strtotime($arrOnedata[$fields['name']]));
                                                }
                                                ?>
                                                <input type="text" class="form-control" name="<?php echo $fields['name'];?>" id="<?php echo $fields['name'];?>" autocomplete="off" value="<?php if(isset($arrOnedata[$fields['name']]) && $arrOnedata[$fields['name']] != ''){echo $date_value;}?>" />
                                                <span class="input-group-addon input-group-append border-left">
                                                <span class="mdi mdi-calendar input-group-text"></span>
                                                </span>
                                            </div>
                                            
                                            <?php
                                            if($fields['type'] == 'file') {
                                                if(isset($arrOnedata[$fields['name']]) && ($arrOnedata[$fields['name']] != "" && is_file(ITEMS_PATH.$arrOnedata[$fields['name']]))) {?>
                                                        <a href="<?php echo ITEMS_URL.$arrOnedata[$fields['name']];?>" title="<?php echo $arrOnedata[$fields['name']];?>" target="_blank">View file</a>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <div id="error_<?php echo $fields['name'];?>" class="formerror" style="color:red;"></div>
                                        </div>
                                    </div>
                                    
                                    <?php
                                    endif;

                                if($fields['type'] == 'select'):
                                ?>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-form-label"><?php echo $fields['title'];?><?php echo $mandatory;?></label>
                                        <div class="col-sm-12">
                                        <?php //print_r($arrOnedata[$fields['name']]);
                                        $existing_value = '';
                                        if(isset($arrOnedata[$fields['name']]) && $arrOnedata[$fields['name']] != ''){
                                            $existing_value = $arrOnedata[$fields['name']];
                                        }
                                        $arrData = explode(',',$existing_value);
                                        //print_r($arrData);
                                        ?>
                                            <select class="js-example-basic-single w-100" name="<?php echo $fields['name'];?><?php if(isset($fields['multiple']) && $fields['multiple'] != ''){?>[]<?php }?>" id="<?php echo $fields['name'];?>" <?php if(isset($fields['multiple']) && $fields['multiple'] != ''){echo "multiple";}?>>
                                                <?php if(isset($fields['options']) && !empty($fields['options'])):?>          
                                                    <?php foreach($fields['options'] as $key => $value):?>
                                                        <option value="<?php echo $key;?>" 
                                                        <?php if(isset($arrData) && !empty($arrData)):?>
                                                            <?php foreach($arrData as $field_value):?>
                                                                <?php if(isset($field_value) && $field_value == $key){echo "selected='selected'";}?>
                                                            <?php endforeach;?>
                                                        <?php endif;?>
                                                        
                                                        ><?php echo $value;?></option>
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
                    
                    <?php require_once $theme_path.'views/allitemsgalleryview.php';?>

                    <input class="btn btn-primary submitbutton" type="submit" value="Submit"/>
                    <input class="btn btn-primary submitbutton" type="reset" value="Reset"/>
                    <a class="btn btn-primary submitbutton" href="<?php echo $url.$item_alias;?>">Back</a>
                    <div class="dot-opacity-loader" style="display:none;"><span></span><span></span><span></span></div>
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
            $(".submitbutton").hide();
            $(".dot-opacity-loader").show();
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
                        $(".submitbutton").show();
                        $(".dot-opacity-loader").hide();
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
        $('.datepicker-popup').datepicker();
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
    <?php if($page_data['custom_view'] == 'gallery'):?>
    <link rel="stylesheet" href="<?php echo $theme_url;?>vendors/lightgallery/css/lightgallery.css" />
    <script src="<?php echo $theme_url;?>vendors/lightgallery/js/lightgallery-all.min.js"></script>
    <script src="<?php echo $theme_url;?>js/light-gallery.js"></script>
    <?php endif;?>

    <script src="<?php echo $theme_url;?>vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="<?php echo $theme_url;?>vendors/bootstrap-datepicker/bootstrap-datepicker.min.css" />

<?php require_once $theme_path.'include/footer.php';?>