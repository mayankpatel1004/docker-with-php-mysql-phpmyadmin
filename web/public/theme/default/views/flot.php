<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Pie chart</h4>
                  <div class="flot-chart-container">
                    <div id="pie-chart" class="flot-chart"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Line Chart</h4>
                  <div class="flot-chart-container">
                    <div id="line-chart" class="flot-chart"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Bar Chart</h4>
                  <div class="flot-chart-container">
                    <div id="column-chart" class="flot-chart"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Stacked Bar Chart</h4>
                  <div class="flot-chart-container">
                    <div id="stacked-bar-chart" class="flot-chart"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Real-time Chart</h4>
                  <div class="flot-chart-container">
                    <div id="realtime-chart" class="flot-chart"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Area Chart</h4>
                  <div class="flot-chart-container">
                    <div id="area-chart" class="flot-chart"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php require_once $theme_path.'include/footer.php';?>
        <?php require $theme_path.'include/scripts.php';?>
        <script src="<?php echo $url;?>vendors/flot/jquery.flot.js"></script>
        <script src="<?php echo $url;?>vendors/flot/jquery.flot.resize.js"></script>
        <script src="<?php echo $url;?>vendors/flot/jquery.flot.categories.js"></script>
        <script src="<?php echo $url;?>vendors/flot/jquery.flot.fillbetween.js"></script>
        <script src="<?php echo $url;?>vendors/flot/jquery.flot.stack.js"></script>
        <script src="<?php echo $url;?>vendors/flot/jquery.flot.pie.js"></script>
        <script src="<?php echo $url;?>js/flot-chart.js"></script>
</div>