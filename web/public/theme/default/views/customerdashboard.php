<?php
require $theme_path.'include/headerfront.php';
require $theme_path.'generated_files/AccountSidebar.php';
global $page_data,$front_session_name,$url;
$page_alias = "";
if(isset($page_data['item_alias']) && $page_data['item_alias'] != ''){
  $page_alias = $page_data['item_alias'];
}
if(!isset($_SESSION[$front_session_name]['web_token'])) {
  ?>
  <script type="text/javascript">window.location.href="<?php echo $url.'login';?>";</script>
  <?php
}
?>
<div class="main-panel">
        <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <form id="example-vertical-wizard" action="#">
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
                        <div class="content clearfix">
                      <h3 id="steps-uid-1-h-0" tabindex="-1" class="title current">Account</h3>
                      <section id="steps-uid-1-p-0" role="tabpanel" aria-labelledby="steps-uid-1-h-0" class="body current" aria-hidden="false">
                        <h3>Dashboard</h3>
                          <div class="row">
                          <div class="col-md-6 col-sm-12">
                              <div class="form-group">
                                <label for="userName">Your Profile</label>
                                <div id="profile_html"></div>
                              </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                              <div class="form-group">
                                <label for="userName">Your Address </label>
                                <div id="address_html"></div>
                              </div>
                            </div>
                            
                          </div>
                      </section>
                    </div>
                    <div class="actions clearfix">
                      <ul role="menu" aria-label="Pagination">
                        <li class="disabled" aria-disabled="true"><a href="#previous" role="menuitem">Save</a></li>
                        <li aria-hidden="false" aria-disabled="false"><a href="#next" role="menuitem">Cancel</a></li>
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
    $.ajax({
        type: 'POST',
        url: '<?php echo $url.$page_alias."/getDashboardDetails/?token=".$_SESSION[$front_session_name]['web_token'];?>',
        data:'customer_id=1',
        beforeSend: function () {
            $('.loading-overlay').show();
        },
        success: function (response) {
            console.log(response);
            const response_address = response.address;
            const response_profile = response.customer_data;
            //console.log(response_address.user_address1)
            
            var address_html = '';
            var profile_html = '';

            address_html += '<address>';
            address_html += response_address.user_address1+' '+response_address.user_address2+'<br />';
            address_html += response_address.user_city+' <br />';
            address_html += response_address.user_state+','+response_address.user_zipcode;
            address_html += response_address.user_country+' <br />';
            address_html += response_address.contact_number+' <br />';
            address_html += '</address>';
            $("#address_html").html(address_html);

            profile_html += '<address>';
            profile_html += response_profile.first_name+' '+response_profile.last_name+'<br />';
            profile_html += '<a href=mailto:'+response_address.email+'>'+response_address.email+' </a><br />';
            profile_html += '<b>Last Updated :</b> '+response_profile.updated_at;
            profile_html += '</address>';
            $("#profile_html").html(profile_html);
        }
    });
  });
  
  </script>
</div>
<?php require_once $theme_path.'include/footerfront.php';?>