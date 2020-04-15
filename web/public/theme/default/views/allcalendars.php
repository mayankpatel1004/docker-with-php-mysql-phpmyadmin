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
      <br />
      <div class="row">
        <div class="col-12">
        <div class="table-responsive">
          <?php //echo "<pre>";print_r($arrData);?>
          <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div id="calendar" class="full-calendar"></div>
                </div>
              </div>
            </div>
        </div>
        </div>
      </div>
      </div>
    </div>
  </div>
<?php require_once $theme_path.'include/prefooter.php';?>
</div>
  <link rel="stylesheet" href="<?php echo $theme_url;?>vendors/fullcalendar/fullcalendar.min.css" />
  <script src="<?php echo $theme_url;?>vendors/js/vendor.bundle.base.js"></script>
  <script src="<?php echo $theme_url;?>js/off-canvas.js"></script>
  <script src="<?php echo $theme_url;?>js/hoverable-collapse.js"></script>
  <script src="<?php echo $theme_url;?>js/template.js"></script>
  <script src="<?php echo $theme_url;?>js/settings.js"></script>
  <script src="<?php echo $theme_url;?>js/todolist.js"></script>
  <script src="<?php echo $theme_url;?>vendors/moment/moment.min.js"></script>
  <script src="<?php echo $theme_url;?>vendors/fullcalendar/fullcalendar.min.js"></script>

  <script type="text/javascript">
  (function($) {
  'use strict';
  $(function() {
    if ($('#calendar').length) {
      $('#calendar').fullCalendar({
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,basicWeek,basicDay'
        },
        defaultDate: '<?php echo date('Y-m-d');?>',
        navLinks: true,
        editable: true,
        eventLimit: true,
        events: [
          <?php foreach($arrData as $event):
            $title = $event['item_title'];
            if($event['meta_title'] != ''){
              $title = $event['meta_title'].' On Leave';
            }
            ?>
          {
            title: '<?php echo $title;?>',
            start: '<?php echo $event['published_at'];?>',
            end: '<?php echo $event['published_end_at'];?>'
          },
          <?php endforeach;?>
          
        ]
      })
    }
  });
})(jQuery);
  </script>
<?php require_once $theme_path.'include/footer.php';?>