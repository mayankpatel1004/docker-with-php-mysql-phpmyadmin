<?php
require $theme_path.'include/headerfront.php';
require $theme_path.'generated_files/AccountSidebar.php';
require $theme_path.'generated_files/customer_profile.php';
global $page_data,$url;
$page_alias = "";
if(isset($page_data['item_alias']) && $page_data['item_alias'] != ''){
  $page_alias = $page_data['item_alias'];
}
if(!isset($_SESSION[$front_session_name]['web_token'])) {
  ?>
  <script type="text/javascript">window.location.href="<?php echo $url.'login';?>";</script>
  <?php
  exit;
}
?>
<div class="main-panel">
        <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                <div class="row"><div class="col-md-12" id="error_message" style="color:red;text-align:center;"></div></div>
                <div class="row"><div class="col-md-12" id="success_message" style="color:green;text-align:center;"></div></div>
                  <form id="ajax-upload" action="<?php echo $url.'customerprofile/saveformdata';?>">
                      <div role="application" class="wizard clearfix vertical" id="steps-uid-1">
                        <div class="steps clearfix">
                          <ul role="tablist">
                            <?php if(isset($arrAccount) && !empty($arrAccount)):?>
                              <?php $counter = 0;?>
                              <?php foreach($arrAccount as $alias => $label):?>
                                <?php $counter++;?>
                                  <?php 
                                  $class_name = "disabled";
                                  ?>
                                  <li role="tab" class="<?php if($counter == 1):?>first<?php endif;?> <?php if($page_alias == $alias){?>current<?php }else {?>disabled<?php }?>"><a href="<?php echo $url;?><?php echo $alias;?>" style="cursor:pointer;"><?php echo $label;?></a></li>
                              <?php endforeach;?>
                            <?php endif;?>
                          </ul>
                        </div>
                        <div class="content1 clearfix">
                      <h3 id="steps-uid-1-h-0" tabindex="-1" class="title current" style="margin-left:5%;">Edit your profile</h3>
                      <section id="steps-uid-1-p-0" role="tabpanel" aria-labelledby="steps-uid-1-h-0" class="body current" aria-hidden="false">
                          <div class="row">
                            <?php
                            if(isset($arrFields) && !empty($arrFields)) {
                              foreach($arrFields as $fields) {
                                if(isset($fields['type']) && $fields['type'] != 'hidden'){
                                ?>
                                  <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                      <label for="<?php echo $fields['name'];?>"><?php echo $fields['title'];?> <?php if(isset($fields['mandatory']) && $fields['mandatory'] == 'Y'){?> <span style="color:red;">*</span><?php }?></label>
                                      <input id="<?php echo $fields['name'];?>" name="<?php echo $fields['name'];?>" type="<?php echo $fields['type'];?>" value="<?php echo $fields['value'];?>" class="form-control" />
                                      <div id="error_<?php echo $fields['name'];?>" class="formerror" style="color:red;"></div>
                                    </div>
                                  </div>
                                  <?php    
                                }
                                if(isset($fields['type']) && $fields['type'] == 'hidden'){
                                  ?>
                                    <input id="<?php echo $fields['name'];?>" name="<?php echo $fields['name'];?>" type="<?php echo $fields['type'];?>" class="form-control" value="<?php echo $fields['value'];?>" />
                                    <?php    
                                }
                              }
                            }
                            ?>
                          </div>
                      </section>
                    </div>
                    <div class="actions clearfix">
                      <ul role="menu" aria-label="Pagination">
                        <li class="disabled" aria-disabled="true"><button type="submit" class="btn btn-primary" name="submit" role="menuitem">Save</button></li>
                      </ul>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
  <?php require_once $theme_path.'include/prefooterfront.php';?>
  <?php require_once $theme_path.'include/scriptsfront.php';?>

  <script type="text/javascript">
    $(document).ready(function(){
        $('#ajax-upload').on('submit', function(e){
            e.preventDefault();
            var form = e.target;
            $(".formerror").html('');
            $("#success_message").html('');
            $("#error_message").html('');
            $.ajax({
                url: form.action,
                dataType: 'json',
                method : "post",
                contentType: false,
                cache: false,
                async: false,
                processData:false, 
                data: new FormData(this),
                //data: $('#ajax-upload').serialize(),
                success: function(result){
                    if(result.error == '0'){
                        $("#ajax-upload")[0].reset();
                        $("#success_message").html(result.message);
                        setTimeout(function(){ $("#success_message").html(''); }, 1000);
                        setTimeout(function(){ location.reload() }, 2000);
                    } else {
                        var response = result.values;
                        if(result.message != '') {
                            $("#error_message").html(result.message);
                        }
                        //console.log(response);
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
</div>
<?php require_once $theme_path.'include/footerfront.php';?>