<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Line chart</h4>
            <canvas id="lineChart"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Bar chart</h4>
            <canvas id="barChart"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Area chart</h4>
            <canvas id="areaChart"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Doughnut chart</h4>
            <canvas id="doughnutChart"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 grid-margin grid-margin-lg-0 stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Pie chart</h4>
            <canvas id="pieChart"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-6 grid-margin grid-margin-lg-0 stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Scatter chart</h4>
            <canvas id="scatterChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require_once $theme_path.'include/footer.php';?>
  <?php require $theme_path.'include/scripts.php';?>
  <script src="<?php echo $theme_url;?>vendors/chart.js/Chart.min.js"></script>
  <script src="<?php echo $theme_url;?>js/chart.js"></script>
</div>