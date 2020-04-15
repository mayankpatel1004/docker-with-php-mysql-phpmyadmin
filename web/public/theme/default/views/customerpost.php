<?php
require $theme_path.'include/headerfront.php';
require $theme_path.'generated_files/AccountSidebar.php';
require $theme_path.'generated_files/customer_profile.php';
global $page_data,$url;
$page_alias = "";
if(isset($page_data['item_alias']) && $page_data['item_alias'] != ''){
  $page_alias = $page_data['item_alias'];
}
$page_url = $url.'getguestposts';
if(!isset($_SESSION[$front_session_name]['web_token'])) {
  ?>
  <script type="text/javascript">window.location.href="<?php echo $url.'login';?>";</script>
  <?php
}
?>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="card">
      <div class="card-body">
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
                        
                        <section id="steps-uid-1-p-0" role="tabpanel" aria-labelledby="steps-uid-1-h-0" class="body current" aria-hidden="false">
                          <div class="row"><div class="col-md-12" id="error_message" style="color:red;text-align:center;"></div></div>
                          <div class="row"><div class="col-md-12" id="success_message" style="color:green;text-align:center;"></div></div>
                          <div class="row">
                            <div class="col-md-1 col-sm-12"><label><h2 style="vertical-align:middle;" class="text-primary"><?php echo ucfirst($item_alias);?></h2></label></div>
                            </div>
                            <div class="row searchbar">
                            <div class="col-md-4 col-sm-12 col-xs-12"><input type="text" value="<?php echo $searchtext;?>" style="padding:11px 10px;" name="searchtext" id="search_text" class="form-control  w-100 mb-10" placeholder="Search By Title..." autocomplete="off" onkeyup="searchFilter(1,'<?php echo $page_url;?>','<?php echo $item_alias;?>')" /><br /></div>
                            <div class="col-md-4 col-sm-12 col-xs-12"><a href="<?php echo $reset_url;?>" class="btn btn-info">Reset</a><br /><br /></div>
                            <div class="col-md-4 col-sm-12 col-xs-12 text-right">
                              <?php if(isset($backend_allow_addnew_button) && $backend_allow_addnew_button == 'Y'):?>
                                  <a href="<?php echo $add_url;?>" class="btn btn-primary">Add New</a><br />
                              <?php endif;?>
                            </div>
                            <input type="hidden" id="sort_type" value="<?php echo $sort_type;?>" />
                            <input type="hidden" id="sort_by" value="<?php echo $sort_by;?>" />
                            <input type="hidden" id="records_per_page" value="<?php echo $records_per_page;?>" />
                            </div>
                            <br />

      <div class="row">
        <div class="col-12">
        <div class="table-responsive">
          <table id="order-listing1" class="table table-striped">
          <thead>
            <?php
            $columns_header = explode(',',$columns_header);
            ?>
            <tr class="bg-primary text-white">
              <?php foreach($columns_header as $headers):?>
              <th><?php echo $headers;?></th>
              <?php endforeach;?>
            </tr>
          </thead>
            <tbody id="data_response"></tbody>
          </table>
          <div class="dot-opacity-loader"><span></span><span></span><span></span></div>
        </div>
        </div>
      </div>
                        </section>
    </div>      
  </div>
  
    <script type="text/javascript">
      function sortdata(value) {
          var lastThree = value.substr(value.length - 3);
          let sorttype = 'desc';
          if(lastThree == 'asc'){
              sorttype = 'asc';
          }
          document.getElementById('sort_type').value = sorttype;
          document.getElementById('sort_by').value = value;
          searchFilter(1,'<?php echo $page_url;?>','<?php echo $item_alias;?>');
      }
    </script>
  </div>
  </div>
  <br />
<?php require_once $theme_path.'include/prefooter.php';?>
<?php require_once $theme_path.'include/scriptsfront.php';?>
<script type="text/javascript">
setTimeout(function(){ 
  function searchFilter(page_no,url,item_alias) {
    $.ajax({
        type: 'POST',
        url: url,
        data:'page_no='+page_no+'&item_alias='+item_alias+'&search_text='+$("#search_text").val()+'&sort_by='+$('#sort_by').val()+"&sort_type="+$("#sort_type").val()+"&url="+url+"&records_per_page="+$("#records_per_page").val(),
        beforeSend: function () {
            $('.loading-overlay').show();
        },
        success: function (response) {
          //console.log(response);
            $(".dot-opacity-loader").hide();
            data = JSON.parse(response);
            $("#data_response").html(data.data);
        }
    });
  }
  searchFilter(1,'<?php echo $url.'getguestposts';?>','<?php echo $item_alias;?>');}, 300);
</script>