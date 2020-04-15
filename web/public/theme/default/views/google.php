<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Region chart</h4>
                  <div class="google-chart-container">
                    <div id="regions-chart" class="google-charts"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Bar chart</h4>
                  <div class="google-chart-container d-flex align-items-center justify-content-center h-100">
                    <div id="Bar-chart" class="google-charts"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Histogram chart</h4>
                  <div class="google-chart-container">
                    <div id="Histogram-chart" class="google-charts"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Area Chart</h4>
                  <div class="google-chart-container">
                    <div id="area-chart" class="google-charts"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 grid-margin grid-margin-lg-0 stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Donut  Chart</h4>
                  <div class="google-chart-container">
                    <div id="Donut-chart" class="google-charts"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 grid-margin grid-margin-lg-0 stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Curve Chart</h4>
                  <div class="google-chart-container">
                    <div id="curve_chart"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
    <?php require_once $theme_path.'include/footer.php';?>
    <?php require $theme_path.'include/scripts.php';?>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="<?php echo $url;?>js/google-charts.js"></script>
    </div>