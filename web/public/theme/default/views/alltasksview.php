<?php
global $page_data;
require $theme_path.'include/header.php';
?>
<div class="main-panel">
<div class="content-wrapper">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-primary"><?php echo $item_alias;?> View</h4>
                <div class="row"><div class="col-md-12" id="error_message" style="color:red;text-align:center;"></div></div>
                <form class="form-sample" action="<?php echo $save_url ; ?>" id="ajax-upload" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <?php
                        $login_id = 0;
                        $login_name = "";
                        $timecard_id = 0;
                        if(isset($_SESSION[$back_session_name]['user_id']) && $_SESSION[$back_session_name]['user_id'] > 0){
                            $login_id = $_SESSION[$back_session_name]['user_id'];
                            $login_name = $_SESSION[$back_session_name]['first_name']." ".$_SESSION[$back_session_name]['last_name'];
                        }
                        if(isset($_REQUEST['timecard_id']) && $_REQUEST['timecard_id'] > 0) {
                            $timecard_id = $_REQUEST['timecard_id'];
                        }
                        ?>
                        <input type="hidden" class="form-control" name="created_at" id="created_at" autocomplete="off" value="<?php echo date('Y-m-d h:i:s');?>" />
                        <input type="hidden" class="form-control" name="updated_at" id="updated_at" autocomplete="off" value="<?php echo date('Y-m-d h:i:s');?>" />
                        <input type="hidden" class="form-control" name="project_id" id="project_id" autocomplete="off" value="<?php echo $arrOnedata['project_id'];?>" />
                        <input type="hidden" class="form-control" name="task_id" id="task_id" autocomplete="off" value="<?php echo $arrOnedata['task_id'];?>" />
                        <input type="hidden" class="form-control" name="task_name" id="task_name" autocomplete="off" value="<?php echo $arrOnedata['task_name'];?>" />
                        <input type="hidden" class="form-control" name="user_id" id="user_id" autocomplete="off" value="<?php echo $login_id;?>" />
                        <input type="hidden" class="form-control" name="user_name" id="user_name" autocomplete="off" value="<?php echo $login_name;?>" />
                        <input type="hidden" class="form-control" name="timecard_id" id="timecard_id" autocomplete="off" value="<?php echo $timecard_id;?>" />
                        
                        
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
                                <div class="col-md-3">
                                    
                                        <label class="col-sm-12 col-form-label"><span class="text-primary"><?php echo $fields['title'];?></span> : <?php if(isset($arrOnedata[$fields['name']]) && $arrOnedata[$fields['name']] != ''){echo $arrOnedata[$fields['name']];}?></label>
                                        <?php
                                        if($fields['type'] == 'file') {
                                            if(isset($arrOnedata[$fields['name']]) && ($arrOnedata[$fields['name']] != "" && is_file(ITEMS_PATH.$arrOnedata[$fields['name']]))) {?>
                                                    <a href="<?php echo ITEMS_URL.$arrOnedata[$fields['name']];?>" title="<?php echo $arrOnedata[$fields['name']];?>" target="_blank">View file</a>
                                                <?php
                                            }
                                        }
                                        ?>
                                </div>
                                <?php
                                endif;

                                if($fields['type'] == 'date'):
                                    ?>
                                    <div class="col-md-3">
                                        
                                            <label class="col-sm-12 col-form-label"><span class="text-primary"><?php echo $fields['title'];?></span> : 
                                            <?php
                                                $date_value = "";
                                                if(isset($arrOnedata[$fields['name']]) && $arrOnedata[$fields['name']] != ''){
                                                    $date_value = date('m/d/Y',strtotime($arrOnedata[$fields['name']]));
                                                }
                                                ?>
                                                <?php if(isset($arrOnedata[$fields['name']]) && $arrOnedata[$fields['name']] != ''){echo $date_value;}?>
                                            </label>
                                            
                                            
                                            <?php
                                            if($fields['type'] == 'file') {
                                                if(isset($arrOnedata[$fields['name']]) && ($arrOnedata[$fields['name']] != "" && is_file(ITEMS_PATH.$arrOnedata[$fields['name']]))) {?>
                                                        <a href="<?php echo ITEMS_URL.$arrOnedata[$fields['name']];?>" title="<?php echo $arrOnedata[$fields['name']];?>" target="_blank">View file</a>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        
                                    </div>
                                    
                                    <?php
                                    endif;

                                if($fields['type'] == 'select'):
                                ?>
                                <div class="col-md-3">
                                    
                                        <label class="col-sm-12 col-form-label"><span class="text-primary"><?php echo $fields['title'];?></span> : 
                                        <?php
                                        $existing_value = '';
                                        if(isset($arrOnedata[$fields['name']]) && $arrOnedata[$fields['name']] != ''){
                                            $existing_value = $arrOnedata[$fields['name']];
                                        }
                                        $arrData = explode(',',$existing_value);
                                        ?>
                                                <?php if(isset($fields['options']) && !empty($fields['options'])):?>          
                                                    <?php foreach($fields['options'] as $key => $value):?>
                                                        <?php if(isset($arrData) && !empty($arrData)):?>
                                                            <?php foreach($arrData as $field_value):?>
                                                                <?php if(isset($field_value) && $field_value == $key){echo $value;}?>
                                                            <?php endforeach;?>
                                                        <?php endif;?>
                                                    <?php endforeach;?>
                                                <?php endif;?>
                                        </label>
                                </div>
                                <?php
                                endif;

                                if($fields['type'] == 'textarea'):
                                    ?>
                                    <div class="col-md-12">
                                        <label class="col-sm-12 col-form-label"><span class="text-primary"><?php echo $fields['title'];?></span></label>
                                            <div class="col-sm-12">
                                            <?php if(isset($arrOnedata[$fields['name']]) && $arrOnedata[$fields['name']] != ''){echo $arrOnedata[$fields['name']];}?>
                                            </div>
                                        </div>
                                    <?php
                                    endif;
                            }
                        }
                        ?>                            
                    </div>
                    <br />
                    <br />
                    <?php if(isset($arrTaskComments) && count($arrTaskComments) > 0):?>
                                    <label class="text-primary">Task Comments : </label>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                        <table id="order-listing1" class="table table-striped">
                                        <thead>
                                            <tr class="bg-primary text-white">
                                                <th>User</th>
                                                <th>Timecard Description</th>
                                                <th>Date</th>
                                                <th>ID</th>
                                                <th><i class="mdi mdi-delete"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($arrTaskComments as $comments):?>
                                            <?php
                                            $delete_link = $url.$item_alias."/view/?id=".$arrOnedata['task_id']."&task_comment_id=".$comments['task_comment_id']."&action=deletecomment&task_name=".$arrOnedata['task_name'];
                                            ?>
                                            <tr>
                                                <td><?php echo $comments['commented_by_name'];?></td>
                                                <td><?php echo $comments['comments'];?></td>
                                                <td><?php echo date(DATETIME_FORMAT,strtotime($comments['created_at']));?></td>
                                                <td><?php echo $comments['task_comment_id'];?></td>
                                                <td>
                                                <?php if($login_id == $comments['commented_by']):?>
                                                <?php /*?><a href="<?php echo $url.$item_alias."/view/?id=".$arrOnedata['task_id']."&timecard_id=".$comments['timecard_id'];?>"><i class="mdi mdi-lead-pencil"></i></a><?php */?>
                                                <a href="javascript:void(0)" onclick="return confirmDelete('<?php echo $delete_link;?>');"><i class="mdi mdi-delete"></i></a>
                                                <?php endif;?>
                                                </td>
                                            </tr>
                                            <?php endforeach;?>
                                            
                                        </tbody>
                                        
                                        </table>
                                        </div>
                                    </div>
                                </div>
                                <?php endif;?>
                                <br /><br />
                        <!-- Timecard accordion task start  -->
                    
                        <div class="card">
                            
                                <div class="accordion accordion-solid-header" id="accordion-4" role="tablist">
                                <div class="card">
                                    <div class="card-header" role="tab" id="heading-10">
                                    <h6 class="mb-0">
                                        <a data-toggle="collapse" href="#collapse-10" aria-expanded="false" aria-controls="collapse-10" class="collapsed bg-primary text-white">
                                        Time Card Details : 
                                        </a>
                                    </h6>
                                    </div>
                                    <div id="collapse-10" class="collapse" role="tabpanel" aria-labelledby="heading-10" data-parent="#accordion-4" style="">
                                    <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <label>Timecard Description</label>
                                        <textarea name="task_comment" id="summernoteExample1" class="form-control summernoteExample"><?php if(isset($arrOneTimecard['task_comment']) && $arrOneTimecard['task_comment'] != ''){echo $arrOneTimecard['task_comment'];}?></textarea>
                                        <div class="error" id="summernoteExample1_error"></div>
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                            <label>Date</label>
                                            <?php
                                            $timecard_date = date('Y-m-d');
                                            if(isset($arrOneTimecard['timecard_date']) && $arrOneTimecard['timecard_date'] != ''){
                                                $timecard_date = date('Y-m-d',strtotime($arrOneTimecard['timecard_date']));
                                            }
                                            ?>
                                            <input type="date" name="timecard_date" id="timecard_date" class="form-control" value="<?php echo $timecard_date;?>" />
                                            <div class="error" id="timecard_date_error"></div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <label>Hours</label>
                                            <input type="text" name="hours" id="hours" class="form-control" value="<?php if(isset($arrOneTimecard['hours']) && $arrOneTimecard['hours'] != ''){echo $arrOneTimecard['hours'];}?>" />
                                            <div class="error" id="hours_error"></div>
                                        </div>
                                </div>
                                <br />
                                <input class="btn btn-primary submitbutton" type="submit" value="Submit"/>
                                <input class="btn btn-primary submitbutton" type="reset" value="Reset"/>
                                <a class="btn btn-primary submitbutton" href="<?php echo $url.$item_alias;?>">Back</a>
                                <div class="dot-opacity-loader" style="display:none;"><span></span><span></span><span></span></div>

                                <br />
                                <?php if(isset($arrComments) && count($arrComments) > 0):?>
                                    <br /><br /><label class="text-primary">Previous Timecards : </label>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                        <table id="order-listing1" class="table table-striped">
                                        <thead>
                                            <tr class="bg-primary text-white">
                                                <th>User</th>
                                                <th>Timecard Description</th>
                                                <th>Hours</th>
                                                <th>Date</th>
                                                <th>ID</th>
                                                <th><i class="mdi mdi-delete"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $total_hours = 0;foreach($arrComments as $comments):?>
                                            <?php
                                            $delete_link = $url.$item_alias."/view/?id=".$arrOnedata['task_id']."&timecard_id=".$comments['timecard_id']."&action=delete&task_name=".$arrOnedata['task_name'];
                                            ?>
                                            <tr>
                                                <td><?php echo $comments['user_name'];?></td>
                                                <td><?php echo $comments['task_comment'];?></td>
                                                <td><?php echo $comments['hours'];?></td>
                                                <td><?php echo $comments['timecard_date'];?></td>
                                                <td><?php echo $comments['timecard_id'];?></td>
                                                <td>
                                                <?php if($login_id == $comments['user_id']):?>
                                                <?php /*?><a href="<?php echo $url.$item_alias."/view/?id=".$arrOnedata['task_id']."&timecard_id=".$comments['timecard_id'];?>"><i class="mdi mdi-lead-pencil"></i></a><?php */?>
                                                <a href="javascript:void(0)" onclick="return confirmDelete('<?php echo $delete_link;?>');"><i class="mdi mdi-delete"></i></a>
                                                <?php endif;?>
                                                </td>
                                            </tr>
                                            <?php $total_hours = $total_hours + $comments['hours'];?>
                                            <?php endforeach;?>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="10" class="text-right"><strong>Total Hours Spent : <?php echo $total_hours;?></strong></td>
                                            </tr>
                                        </tfoot>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                                <?php endif;?>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>

                        


                        <div class="accordion accordion-multi-colored" id="accordion-6" role="tablist">
                      <div class="card">
                        <div class="card-header  bg-primary" role="tab" id="heading-17">
                          <h6 class="mb-0">
                            <a class="collapsed text-white" data-toggle="collapse" href="#collapse-17" aria-expanded="false" aria-controls="collapse-17">
                              Comments
                            </a>
                          </h6>
                        </div>
                        <div id="collapse-17" role="tabpanel" aria-labelledby="heading-17" data-parent="#accordion-6" style="">
                          <div class="card-body bg-white">
                          <br />
                          
                          <br />
                          <label class="text-black">Please enter your task comment : </label>
                          <textarea name="task_comment" id="task_comments" class="form-control summernoteExample"></textarea>
                          <br />
                          <input class="btn btn-primary commentsubmit" type="submit" value="Submit"/>
                          <div class="dot-opacity-loader" style="display:none;"><span></span><span></span><span></span></div>
                          </div>
                        </div>
                      </div>
                    </div>




                <!-- Timecard accordion task end  -->                    
                </form>
            </div>
            



            








        </div>
    </div>
</div>

<?php require_once $theme_path.'include/prefooter.php';?>
<?php require $theme_path.'include/scripts.php';?>
</div>
<link rel="stylesheet" href="<?php echo $theme_url;?>vendors/bootstrap-datepicker/bootstrap-datepicker.min.css" />
    <script type="text/javascript">
    function confirmDelete(url) {
        if(confirm("Are you sure you wanna delete?")){
            window.location.href = url;
        } else {
            return false;
        }
    }
    $(document).ready(function(){
        $('#ajax-upload').on('submit', function(e){
            $(".error").html('');
            if($("#summernoteExample1").val() == ''){
                $("#summernoteExample1_error").html('Please enter your comments');
                $(".error").css('color','red');
                return false;
            }
            else if($("#timecard_date").val() ==  ''){
                $("#timecard_date_error").html('Please select date');
                $(".error").css('color','red');
                return false;
            }
            else if($("#hours").val() ==  ''){
                $("#hours_error").html('Please enter your hours');
                $(".error").css('color','red');
                return false;
            }
            else {
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
                    success: function(result){
                        if(result.error == '0'){
                            
                            showSwal('success-comment');
                            setTimeout(function(){ location.href = '<?php echo $url.$item_alias."/view/?id=".$arrOnedata['task_id'];?>'; }, 1000);
                            
                        } else {
                            $(".submitbutton").show();
                            $(".dot-opacity-loader").hide();
                            var response = result.values;
                            if(result.message != '') {
                                $("#error_message").html(result.message);
                            }
                        }
                    }
                });
            }


        });
    });    
    </script>
    <link rel="stylesheet" href="<?php echo $theme_url;?>vendors/summernote/dist/summernote.css" />        
    <script src="<?php echo $theme_url;?>vendors/summernote/dist/summernote.min.js"></script>
     <script type="text/javascript">
        $('.summernoteExample').summernote({
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
    <script type="text/javascript">
        $(".commentsubmit").click(function(){
            var comment = $("#task_comments").val();
            if(comment == ''){
                alert("Please enter task comments");    
                return false;
            } else {
                $(".commentsubmit").hide();
                $(".dot-opacity-loader").show();
                $.ajax({
                    url: '<?php echo $url.$item_alias."/saveComments/?id=".$arrOnedata['task_id'];?>',
                    method : "post",
                    data: { task_id: $("#task_id").val(), task_name: $("#task_name").val(),comments : comment,commented_by : <?php echo $login_id?>,commented_by_name : '<?php echo $login_name?>' },
                    success: function(result){
                        if(result.error == '0'){ 
                            showSwal('success-comment');
                            setTimeout(function(){ location.href = '<?php echo $url.$item_alias."/view/?id=".$arrOnedata['task_id'];?>'; }, 1000);
                        } else {
                            $(".commentsubmit").show();
                            $(".dot-opacity-loader").hide();
                            var response = result.values;
                            if(result.message != '') {
                                $("#error_message").html(result.message);
                            }
                        }
                    }
                });
            }
        });
    </script>
    
<?php require_once $theme_path.'include/footer.php';?>