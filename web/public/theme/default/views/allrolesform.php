<?php
global $page_data;
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
                    <div class="row">
                        <?php if($id == 0):?>
                        <input type="hidden" class="form-control" name="created_at" id="created_at" autocomplete="off" value="<?php echo date('Y-m-d h:i:s');?>" />
                        <?php else :?>
                        <input type="hidden" class="form-control" name="updated_at" id="updated_at" autocomplete="off" value="<?php echo date('Y-m-d h:i:s');?>" />
                        <?php endif;?>
                        <input type="hidden" class="form-control" name="item_alias" id="item_alias" autocomplete="off" value="<?php echo $item_alias;?>" />
                        <?php
                        if(isset($arrFields) && !empty($arrFields)) {
                            foreach($arrFields as $fields) {
                                if($fields['type'] == 'hidden') :
                                    ?>
                                    <input type="hidden" class="form-control" name="<?php echo $fields['name'];?>" id="<?php echo $fields['name'];?>" autocomplete="off" value="<?php if(isset($arrOnedata[$fields['name']]) && $arrOnedata[$fields['name']] != ''){echo $arrOnedata[$fields['name']];}?>" />
                                    <?php
                                endif;
                                if($fields['type'] == 'text'):
                                ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-12 col-form-label"><?php echo $fields['title'];?></label>
                                        <input type="<?php echo $fields['type'];?>" class="form-control" name="<?php echo $fields['name'];?>" id="<?php echo $fields['name'];?>" autocomplete="off" value="<?php if(isset($arrOnedata[$fields['name']]) && $arrOnedata[$fields['name']] != ''){echo $arrOnedata[$fields['name']];}?>" />
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
                                        <label class="col-sm-12 col-form-label"><?php echo $fields['title'];?></label>
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
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                                function getModulepermission($module_id, $role_id, $column) {
                                    global $cf;
                                    $strColumn = "";
                                    $sqlQuery = "SELECT `$column` FROM  role_access WHERE module_id = $module_id AND role_id = $role_id";
                                    $fetch = $cf->getOneData($sqlQuery);
                                    if(isset($fetch[$column]) && $fetch[$column] != ""){
                                        $strColumn = $fetch[$column];
                                    }
                                    return $strColumn;
                                }

                            if(isset($all_modules) && !empty($all_modules)) {
                                //echo "<pre>";
                                ?>
                                    <table width="50%" align="center">
                                        <tr>
                                            <th>Module Title</th>
                                            <th style="text-align:center;">View <br /><input type="checkbox" id="cc1" onclick="javascript:checkAll2(this,'viewtd')"/></th>
                                            <th style="text-align:center;">Add <br /><input type="checkbox" id="cc2" onclick="javascript:checkAll2(this,'addtd')"/></th>
                                            <th style="text-align:center;">Edit <br /><input type="checkbox" id="cc3" onclick="javascript:checkAll2(this,'edittd')"/></th>
                                            <th style="text-align:center;">Delete<br /><input type="checkbox" id="cc4" onclick="javascript:checkAll2(this,'deletetd')"/></th>
                                            <th>ID<br /></th>
                                        </tr>
                                            <?php
                                            $addResult = "";
                                            $editResult = "";
                                            $deleteResult = "";
                                            $viewResult = "";
                                            foreach($all_modules as $data){
                                                //print_r($data);exit;
                                                $viewResult = getModulepermission($data['item_id'], $id, 'grant_view');
                                                $editResult = getModulepermission($data['item_id'], $id, 'grant_edit');
                                                $deleteResult = getModulepermission($data['item_id'], $id, 'grant_delete');
                                                $addResult = getModulepermission($data['item_id'], $id, 'grant_add');
                                                ?>
                                                <tr>
                                                    <td><?php echo $data["item_title"]; ?></td>
                                                    <td class="tac"><input type="checkbox" class="form-control p5 viewtd" name="view[<?php echo $data["item_id"]; ?>]" value="<?php echo $data["item_id"]; ?>" <?php if ($viewResult == 'Y') { echo "checked='checked'";} ?> /></td>
                                                    <td class="tac"><input type="checkbox" class="form-control p5 addtd" name="add[<?php echo $data["item_id"]; ?>]" value="<?php echo $data["item_id"]; ?>" <?php if ($addResult == 'Y') {echo "checked='checked'";} ?> /></td>
                                                    <td class="tac"><input type="checkbox" class="form-control p5 edittd" name="edit[<?php echo $data["item_id"]; ?>]" value="<?php echo $data["item_id"]; ?>" <?php if ($editResult == 'Y') {echo "checked='checked'";} ?> /></td>
                                                    <td class="tac"><input type="checkbox" class="form-control p5 deletetd" name="del[<?php echo $data["item_id"]; ?>]" value="<?php echo $data["item_id"]; ?>" <?php if ($deleteResult == 'Y') {echo "checked='checked'";} ?> /></td>
                                                    <td class="tac"><?php echo $data["item_id"];?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                    </table>
                                    <br /><br />
                                <?php
                            }
                            ?>
                        </div>
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
    function checkAll2(o,classname) {
        var boxes = document.getElementsByClassName(classname);
        for (var x = 0; x < boxes.length; x++) {
            var obj = boxes[x];
            if (obj.type == "checkbox") {
            if (obj.name != "check")
                obj.checked = o.checked;
            }
        }
    }

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