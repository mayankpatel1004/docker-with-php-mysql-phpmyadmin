<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Line chart</h4>
                  <div id="morris-line-example"></div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Bar chart</h4>
                  <div id="morris-bar-example"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 grid-margin grid-margin-lg-0 stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Area chart</h4>
                  <div id="morris-area-example"></div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 grid-margin grid-margin-lg-0 stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Doughnut chart</h4>
                  <div id="morris-donut-example"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php require_once $theme_path.'include/footer.php';?>
<?php require $theme_path.'include/scripts.php';?>
<script src="<?php echo $url;?>vendors/raphael/raphael.min.js"></script>
<script src="<?php echo $url;?>vendors/morris.js/morris.min.js"></script>
<script src="<?php echo $url;?>js/morris.js"></script>
</div>