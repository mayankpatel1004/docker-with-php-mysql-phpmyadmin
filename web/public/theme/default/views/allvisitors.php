<?php
global $page_data;
require $theme_path.'include/header.php';
$item_alias = "activities";

$backend_allow_action_dropdown = 'N';
$backend_allow_apply_button = 'N';
$backend_allow_addnew_button = 'N';

?>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="card">
      <div class="card-body">
      <div class="row">
      <div class="col-md-1 col-sm-12"><label><h2 style="vertical-align:middle;" class="text-primary"><?php echo ucfirst($item_type);?></h2></label></div>
      </div>
      <?php require $theme_path.'include/backendlistingsearch.php';?>
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
setTimeout(function(){ searchFilter(<?php echo $page_no;?>,'<?php echo $page_url;?>','<?php echo 'activities';?>'); }, 300);
</script>
</div>
<?php require_once $theme_path.'include/footer.php';?>