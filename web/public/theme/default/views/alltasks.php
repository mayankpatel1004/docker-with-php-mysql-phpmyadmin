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
      <?php require $theme_path.'include/backendtasksearch.php';?>
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
setTimeout(function(){ searchFilterTasks(<?php echo $page_no;?>,'<?php echo $page_url;?>','<?php echo $item_alias;?>'); }, 300);

function fnUpdateStatus(priority,task_id,task_name,assign_to) {
  //alert(task_id+'==='+status+'==='+task_name);
  $.ajax({
    type: 'POST',
    url: '<?php echo $url.'alltasks/updatePriority';?>',
    data:'task_id='+task_id+'&priority='+priority+'&task_name='+task_name+'&assign_to='+assign_to,
    beforeSend: function () {
        $('.loading-overlay').show();
    },
    success: function (response) {
        swal(
          'Success!',
          'Priority has been successfully updated.',
          'success'
        );
        setTimeout(function(){location.reload();}, 1000);
    }
  });    
}

function fnUpdateAssignee(assign_to,task_id,task_name) {
  //alert(task_id+'==='+status+'==='+task_name);
  $.ajax({
    type: 'POST',
    url: '<?php echo $url.'alltasks/updateAssignee';?>',
    data:'task_id='+task_id+'&assign_to='+assign_to+'&task_name='+task_name,
    beforeSend: function () {
        $('.loading-overlay').show();
    },
    success: function (response) {
        swal(
          'Success!',
          'Assignee has been successfully updated.',
          'success'
        );
        setTimeout(function(){location.reload();}, 1000);
    }
  });    
}

function fnUpdateTaskStatus(new_status,task_id,task_name) {
  //alert(new_status+'==='+task_id+'==='+task_name);
  //return false;
  $.ajax({
    type: 'POST',
    url: '<?php echo $url.'alltasks/fnUpdateTaskStatus';?>',
    data:'task_id='+task_id+'&task_status='+new_status+'&task_name='+task_name,
    beforeSend: function () {
        $('.loading-overlay').show();
    },
    success: function (response) {
        swal(
          'Success!',
          'Status has been successfully updated.',
          'success'
        );
        setTimeout(function(){location.reload();}, 1000);
    }
  });    
}


</script>
</div>
<?php require_once $theme_path.'include/footer.php';?>