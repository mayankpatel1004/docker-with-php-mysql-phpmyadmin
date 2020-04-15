<?php global $page_data,$currancy;
require $theme_path.'include/headerfront.php';
?>
<div class="main-panel">
  <div class="content-wrapper">          
  <div class="card">
          <div class="card-body">
            <div class="row">
            <div class="col-md-12 grid-margin grid-margin-md-0 stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title text-primary">My Orders</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Order No.</th>
                          <th class="pt-1">Date</th>
                          <th class="pt-1">Quantity</th>
                          <th class="pt-1">Total</th>
                          <th class="pt-1">Status</th>
                          <th class="pt-1">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if(isset($arrOrderData) && count($arrOrderData) > 0):
                            foreach($arrOrderData as $data):
                        ?>
                        <tr>
                          <td class="py-1 pl-0"><?php echo $data['order_id_unique'];?></td>
                          <td class="py-1 pl-0"><?php echo date(DATE_FORMAT,strtotime($data['created_at']));?></td>
                          <td><label class=""><?php echo $data['total_ordered_quantity'];?></label></td>
                          <td><?php echo $currancy.$data['order_total'];?></td>
                          <td><label class=""><?php echo $data['order_status'];?></label></td>
                          <td><a href="<?php echo $url.'myinvoice/?order='.$data['order_id_unique'];?>" target="_blank">View Invoice</a></td>
                        </tr>
                        <?php
                          endforeach;
                        endif;
                        ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="6"><a href="<?php echo $url.'customerdashboard';?>" class="btn btn-primary pull-right">Back to Dashboard</a></td>
                          </tr>
                        </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>  
        <br />
<?php require_once $theme_path.'include/prefooterfront.php';?>
<?php require $theme_path.'include/scripts.php';?>
</div>
<?php require_once $theme_path.'include/footerfront.php';?>