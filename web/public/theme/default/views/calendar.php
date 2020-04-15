
<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title text-primary">Fullcalendar</h4>
                  <div id="calendar" class="full-calendar"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
    <?php require_once $theme_path.'include/footer.php';?>
    <?php require $theme_path.'include/scripts.php';?>
    <link rel="stylesheet" href="<?php echo $url;?>vendors/fullcalendar/fullcalendar.min.css">
    <script src="<?php echo $url;?>vendors/moment/moment.min.js"></script>
    <script src="<?php echo $url;?>vendors/fullcalendar/fullcalendar.min.js"></script>
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
                defaultDate: '2017-07-12',
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: [{
                    title: 'All Day Event',
                    start: '2017-07-08'
                },
                {
                    title: 'Long Event',
                    start: '2017-07-01',
                    end: '2017-07-07'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2017-07-09T16:00:00'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2017-07-16T16:00:00'
                },
                {
                    title: 'Conference',
                    start: '2017-07-11',
                    end: '2017-07-13'
                },
                {
                    title: 'Meeting',
                    start: '2017-07-12T10:30:00',
                    end: '2017-07-12T12:30:00'
                },
                {
                    title: 'Lunch',
                    start: '2017-07-12T12:00:00'
                },
                {
                    title: 'Meeting',
                    start: '2017-07-12T14:30:00'
                },
                {
                    title: 'Happy Hour',
                    start: '2017-07-12T17:30:00'
                },
                {
                    title: 'Dinner',
                    start: '2017-07-12T20:00:00'
                },
                {
                    title: 'Birthday Party',
                    start: '2017-07-13T07:00:00'
                },
                {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: '2017-07-28'
                }
                ]
            })
            }
        });
        })(jQuery);
    </script>
</div>