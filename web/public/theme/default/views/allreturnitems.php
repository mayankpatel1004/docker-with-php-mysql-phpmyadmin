<?php
global $page_data;
require $theme_path.'include/header.php';
$item_alias = "";
if(isset($page_data['item_alias']) && $page_data['item_alias'] != ''){
  $item_alias = $page_data['item_alias'];
}
?>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="card">
      <div class="card-body">
      <div class="row">
      <div class="col-md-1 col-sm-12"><label><h2 style="vertical-align:middle;" class="text-primary"><?php echo ucfirst($item_type);?></h2></label></div>
      </div>
      <?php require $theme_path.'include/backendinventoryreturnsearch.php';?>
      <br />
      <form class="form-sample" action="<?php echo $url."allsubscribers/importsubscribers"; ?>" id="ajax-upload" method="post" enctype="multipart/form-data">
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
      <div class="row"><div class="col-md-12 text-danger text-center" id="error_message"></div></div>
      </form>
    </div>
  </div>
  <div>
  
  </div>
<?php require_once $theme_path.'include/prefooter.php';?>
<?php require $theme_path.'include/scripts.php';?>
<script type="text/javascript">
setTimeout(function(){ searchFilter(<?php echo $page_no;?>,'<?php echo $page_url;?>','<?php echo $item_alias;?>'); }, 300);
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#ajax-upload').on('submit', function(e){
            $("#error_message").html('');
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
                  } else {
                    if(result.message != '') {
                        $("#error_message").html(result.message);
                    }
                  }
                }
            });
        });
    });    


    function updateDispatch(total_size,dispatch_id,inventory_id,column_name) {
      //alert(total_size+'======='+dispatch_id+'========'+inventory_id);
      // let data = {
      //   "total_size" : total_size,
      //   "dispatch_id" : dispatch_id,
      //   "inventory_id" : inventory_id
      // };
      let data = "total_size="+total_size+"&dispatch_id="+dispatch_id+"&inventory_id="+inventory_id+"&column_name="+column_name;
      $.ajax({
          url: "<?php echo $url."allreturnitems/savereturnitems/?"; ?>"+data,
          dataType: 'json',
          method : "get",
          contentType: false,
          cache: false,
          processData:false,
          success: function(result){
            if(result.error == '0'){
                  showSwal('success-comment');
                  setTimeout(function(){ location.reload(); }, 1000);
            } else {
              if(result.message != '') {
                  $("#error_message").html(result.message);
              }
            }
          }
      });
    }
    </script>
</div>
<?php require_once $theme_path.'include/footer.php';?>