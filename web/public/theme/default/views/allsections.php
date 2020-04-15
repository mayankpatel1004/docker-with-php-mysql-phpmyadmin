<?php
global $page_data;
require $theme_path.'include/header.php';
?>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="card">
      <div class="card-body">
      <div class="row">
      <div class="col-md-12 col-sm-12"><label><h2 style="vertical-align:middle;" class="text-primary"><?php echo ucfirst(str_replace('_',' ',$item_alias));?></h2></label></div>
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
</script>
</div>
<?php require_once $theme_path.'include/footer.php';?>