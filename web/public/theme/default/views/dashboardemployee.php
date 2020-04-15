<?php require $theme_path.'include/header.php';?>
<div class="main-panel">
                <div class="content-wrapper">                  
                 <div class="row">
                    <div class="col-md-6 grid-margin grid-margin-md-0 stretch-card">
                      <div class="card">
                        <div class="card-body">
                          <h4 class="card-title text-primary text-center">Your Recent Timecard</h4>
                          <div class="row">
                            <div class="col-md-12 text-center">
                              <a href="<?php echo $url;?>alltimecard/form" class="text-primary text-center"><small>Add Timecard</small></a>
                            </div>
                          </div>
                          
                          <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th class="pt-1 pl-0 col-md-2">Task</th>
                                  <th class="pt-1 col-md-2">Hours</th>
                                  <th class="pt-1 col-md-2">Date</th>
                                  <th class="pt-1 col-md-6">Comment</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $todays_hours = "0.00";
                                foreach($arrTimecard as $timecard):  
                                  if($timecard['timecard_date'] == date('Y-m-d')){
                                    $todays_hours = $timecard['hours'];
                                  }
                                endforeach;
                                if(isset($arrTimecard) && $arrTimecard != false):
                                  $counter = 0;
                                  ?>
                                  <?php if($todays_hours == '0.00'):?>
                                    <tr>
                                      <td colspan="4" class="text-left text text-danger">Your Today's time card is pending.</td>
                                    </tr>
                                    <?php endif;?>
                                  <?php
                                  foreach($arrTimecard as $timecard):
                                    $today_date = "";
                                    if($timecard['timecard_date'] == date('Y-m-d')){
                                      $today_date = "bg-info";
                                      $counter++;
                                    }
                                    ?>
                                    <tr class="<?php echo $today_date;?>">
                                      <td class="col-md-2"><?php echo $timecard['task_name'];?></td>
                                      <td class="col-md-2"><?php echo $timecard['hours'];?></td>
                                      <td class="col-md-2"><label><?php echo date(DATE_FORMAT,strtotime($timecard['timecard_date']));?></label></td>
                                      <td class="col-md-6"><?php echo $timecard['task_comment'];?></td>
                                    </tr>
                                    <?php    
                                  endforeach;
                                endif;
                                ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 grid-margin grid-margin-md-0 stretch-card">
                      <div class="card">
                        <div class="card-body">
                          <h4 class="card-title text-primary text-center">Your Progress Tasks</h4>
                          <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th class="pt-1 pl-0">Project</th>
                                  <th class="pt-1">Task</th>
                                  <th class="pt-1">Priority</th>
                                  <th class="pt-1">Status</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if(isset($arrEmployeeTasks) && !empty($arrEmployeeTasks)):?>
                                  <?php foreach($arrEmployeeTasks as $task):?>
                                  <?php
                                  $class = "badge badge-success";
                                  if($task['task_priority'] == 'Normal') {
                                    $class = "badge badge-primary";
                                  }
                                  else if($task['task_priority'] == 'Trival') {
                                    $class = "badge badge-success";
                                  }
                                  else if($task['task_priority'] == 'Higher') {
                                    $class = "badge badge-danger";
                                  }
                                  ?>
                                <tr>
                                  <td class="py-1 pl-0"><?php echo $task['project_name'];?></td>
                                  <td><?php echo $task['task_name'];?></td>
                                  <td><label class="<?php echo $class;?>"><?php echo $task['task_priority'];?></label></td>
                                  <td><label><?php echo $task['task_status'];?></label></td>
                                </tr>
                                  <?php endforeach;?>
                                <?php endif;?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                  
                    </div>
                  </div>
                  <br />
                </div>
                <?php require_once $theme_path.'include/prefooter.php';?>
                <?php require $theme_path.'include/scripts.php';?>
</div>
<?php require_once $theme_path.'include/footer.php';?>