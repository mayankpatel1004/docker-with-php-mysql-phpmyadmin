<?php
global $page_data;
require $theme_path.'include/header.php';
?>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="card">
      <div class="card-body">
      <div class="row">
      <div class="col-md-1 col-sm-12"><label><h2 style="vertical-align:middle;" class="text-primary"><?php echo ucfirst($item_alias);?></h2></label></div>
      </div>
      <?php require $theme_path.'include/backendlistingsearch.php';?>
      <br />
      <div class="row">
        <div class="col-12">
        <div class="table-responsive">
          <table id="order-listing1" class="table table-striped">
          <thead>
            <?php $columns_header = explode(',',$columns_header);?>
            <tr class="bg-primary text-white">
              <th><input type="checkbox" id="cc" onclick="javascript:checkAll(this)"/></th>
              <?php foreach($columns_header as $headers):?>
              <th><?php echo $headers;?></th>
              <?php endforeach;?>
            </tr>
          </thead>
          <tbody id="data_response">
          </tbody>
          
          </table>
          <div class="dot-opacity-loader"><span></span><span></span><span></span></div>
        </div>
        </div>
      </div>
      </div>
    </div>
  </div>
<?php require_once $theme_path.'include/prefooter.php';?>
<?php require $theme_path.'include/scripts.php';?>
<script type="text/javascript">
setTimeout(function(){ searchFilter(<?php echo $page_no;?>,'<?php echo $page_url;?>','<?php echo $item_alias;?>'); }, 300);
function fnUpdateTimecard(timecard_id){
  $("#timecard_error_"+timecard_id).html('');
  var comments = $("#task_comment_"+timecard_id).val();
  var hours = $("#hours_"+timecard_id).val();
  var timecard_date = $("#timecard_date_"+timecard_id).val();
  var task_name = $("#task_name_"+timecard_id).val()
  
  if(comments == '' || hours == '') {
    $("#timecard_error_"+timecard_id).html('Please enter valid comment and hours');
    return false;
  }else {
    $.ajax({
        type: 'POST',
        url: '<?php echo $url.'alltimecard/updateTask/';?>',
        data:'comments='+comments+'&hours='+hours+'&timecard_id='+timecard_id+'&task_name='+task_name+'&timecard_date='+timecard_date,
        beforeSend: function () {
            $('.loading-overlay').show();
        },
        success: function (response) {
          showSwal('success-comment');
          setTimeout(function(){ location.reload() }, 1000);
        }
    });
  }
}
</script>
</div>
<?php require_once $theme_path.'include/footer.php';?>