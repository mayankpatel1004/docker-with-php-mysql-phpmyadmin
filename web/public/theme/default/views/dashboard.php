<?php require $theme_path.'include/header.php';?>
<?php require $theme_path.'generated_files/summary.php';?>
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-3 grid-margin grid-margin-md-0 stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-primary text-center">Today's Punch Report<br /><?php echo date('d/m/Y');?></h4>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="pt-1 pl-0">Employee</th>
                      <th class="pt-1">Hours</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(isset($todayPunchReport) && $todayPunchReport != false):
                      foreach($todayPunchReport as $data):
                        ?>
                        <?php
                          $class = "badge badge-primary";
                          if($data['hours'] > '8.5') {
                            $class = "badge badge-success";
                          }
                          if($data['hours'] < '8') {
                            $class = "badge badge-danger";
                          }
                        ?>
                        <tr>
                          <td class="py-1 pl-0"><?php echo $data['user_name'];?></td>
                          <td><span class="<?php echo $class;?>"><?php echo $data['hours'];?></span></td>
                        </tr>
                        <?php    
                      endforeach;
                      else :
                        ?>
                        <tr>
                          <td colspan="4" class="text-center text-primary">No One Punch Yet</td>
                        </tr>
                        <?php
                    endif;
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 grid-margin grid-margin-md-0 stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-primary text-center">Previous Day Punch<br /><?php echo date(DATE_FORMAT,strtotime($PreviousDay));?></h4>
              <div class="table-responsive">
              <table class="table">
                  <thead>
                    <tr>
                      <th class="pt-1 pl-0">Employee</th>
                      <th class="pt-1">Hours</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(isset($LastdatePunchReport) && $LastdatePunchReport != false):
                      foreach($LastdatePunchReport as $data):
                        ?>
                        <?php
                          $class = "badge badge-primary";
                          if($data['hours'] > '8.5') {
                            $class = "badge badge-success";
                          }
                          if($data['hours'] < '8') {
                            $class = "badge badge-danger";
                          }
                        ?>
                        <tr>
                          <td class="py-1 pl-0"><?php echo $data['user_name'];?></td>
                          <td><span class="<?php echo $class;?>"><?php echo $data['hours'];?></span></td>
                        </tr>
                        <?php    
                      endforeach;
                      else :
                        ?>
                        <tr>
                          <td colspan="4" class="text-center text-primary">No One Punch Yet</td>
                        </tr>
                        <?php
                    endif;
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-md-3 grid-margin grid-margin-md-0 stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-primary text-center">Previous Month Hours By Employee</h4>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="pt-1 pl-0">Employee</th>
                      <th class="pt-1">Working Hours</th>
                      <th class="pt-1">Total Hours</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $total_working_hours = 0;
                    if(isset($arrPrviousMonthTotalWorkingHours) && !empty($arrPrviousMonthTotalWorkingHours)){
                      $total_working_hours = $arrPrviousMonthTotalWorkingHours['total_working_days'] * 8;
                    }
                    if(isset($arrPreviousMonthHoursByMonth) && $arrPreviousMonthHoursByMonth != false):
                      foreach($arrPreviousMonthHoursByMonth as $data):
                        ?>
                        <?php
                          $class = "badge badge-primary";
                          if($data['total_hours'] > $total_working_hours) {
                            $class = "badge badge-success";
                          }
                          if($data['total_hours'] <= $total_working_hours) {
                            $class = "badge badge-danger";
                          }
                        ?>
                        <tr>
                          <td class="py-1 pl-0"><?php echo $data['user_name'];?></td>
                          <td><span class="<?php echo $class;?>"><?php echo $data['total_hours'];?></span></td>
                          <td class="text-center"><?php echo $total_working_hours;?></td>
                        </tr>
                        <?php    
                      endforeach;
                      else :
                        ?>
                        <tr>
                          <td colspan="4" class="text-center text-primary">No One Punch Yet</td>
                        </tr>
                        <?php
                    endif;
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 grid-margin grid-margin-md-0 stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-primary text-center">Previous Month Weekend Hours</h4>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="pt-1 pl-0">Employee</th>
                      <th class="pt-1">Working Hours</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(isset($arrPrviousMonthTotalWeekendWorkingHours) && $arrPrviousMonthTotalWeekendWorkingHours!= false):
                      foreach($arrPrviousMonthTotalWeekendWorkingHours as $data):
                        ?>
                        <tr>
                          <td class="py-1 pl-0"><?php echo $data['user_name'];?></td>
                          <td><span class="<?php echo $class;?>"><?php echo $data['total_hours'];?></span></td>
                        </tr>
                        <?php    
                      endforeach;
                      else :
                        ?>
                        <tr>
                          <td colspan="4" class="text-center text-primary">No One Punch Yet</td>
                        </tr>
                        <?php
                    endif;
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br />
      <div class="row">
        <div class="col-md-6 grid-margin grid-margin-md-0 stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-primary text-center">Employee Current Month Leave</h4>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="pt-1 pl-0">Employee</th>
                      <th class="pt-1">Date</th>
                      <th class="pt-1">Reason</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(isset($currentmonthemployeeleave) && $currentmonthemployeeleave != false):
                      foreach($currentmonthemployeeleave as $data):
                        ?>
                        <?php
                          $class = "badge badge-danger";
                          if($data[3] < date('Y-m-d')) {
                            $class = "badge badge-primary";  
                          }
                        ?>
                        <tr>
                          <td class="py-1 pl-0"><?php echo $data[2];?></td>
                          <td><span class="<?php echo $class;?>"><?php echo $data[3];?><span></td>
                          <td><?php echo $data[4];?></td>
                          
                        </tr>
                        <?php    
                      endforeach;
                      else :
                        ?>
                        <tr>
                        <td colspan="4" class="text-center text-primary">No One Applied/Taken Leave Till Now</td>
                        </tr>
                        <?php
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
              <h4 class="card-title text-primary text-center">Employee Current Year Leave</h4>
              <div class="table-responsive">
              <table class="table">
                  <thead>
                    <tr>
                      <th class="pt-1 pl-0">Employee</th>
                      <th class="pt-1">Date</th>
                      <th class="pt-1">Reason</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    if(isset($currentyearemployeeleave) && $currentyearemployeeleave != false):
                      foreach($currentyearemployeeleave as $data):
                        ?>
                        <?php
                          $class = "badge badge-danger";
                          if($data[3] < date('Y-m-d')) {
                            $class = "badge badge-primary";  
                          }
                        ?>
                        <tr>
                          <td class="py-1 pl-0"><?php echo $data[2];?></td>
                          <td><span class="<?php echo $class;?>"><?php echo $data[3];?><span></td>
                          <td><?php echo $data[4];?></td>
                          
                        </tr>
                        <?php    
                      endforeach;
                      else :
                        ?>
                        <tr>
                        <td colspan="4" class="text-center text-primary">No One Applied/Taken Leave Till Now</td>
                        </tr>
                        <?php
                    endif;
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br />
      <div class="row">
        <div class="col-md-4 grid-margin grid-margin-md-0 stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-primary text-center">Project Wise Pending Tasks</h4>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="pt-1 pl-0">Project</th>
                      <th class="pt-1">Pending Tasks</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(isset($projectwisependingtasks) && $projectwisependingtasks != false):
                      foreach($projectwisependingtasks as $data):
                        ?>
                        <tr>
                          <td class="py-1 pl-0"><?php echo $data[2];?></td>
                          <td><?php echo $data[3];?></td>
                          
                        </tr>
                        <?php    
                      endforeach;
                      else :
                        ?>
                        <tr>
                        <td colspan="4" class="text-center text-primary">No Pending Tasks Found</td>
                        </tr>
                        <?php
                    endif;
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 grid-margin grid-margin-md-0 stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-primary text-center">Status Wise Pending Tasks</h4>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="pt-1 pl-0">Status</th>
                      <th class="pt-1">Pending Tasks</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(isset($statuswisependingtasks) && $statuswisependingtasks != false):
                      foreach($statuswisependingtasks as $data):
                        ?>
                        <tr>
                          <td class="py-1 pl-0"><?php echo $data[2];?></td>
                          <td><?php echo $data[3];?></td>
                          
                        </tr>
                        <?php    
                      endforeach;
                      else :
                        ?>
                        <tr>
                        <td colspan="4" class="text-center text-primary">No Pending Tasks Found</td>
                        </tr>
                        <?php
                    endif;
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 grid-margin grid-margin-md-0 stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-primary text-center">Employee Wise Pending Task</h4>
              <div class="table-responsive">
              <table class="table">
                  <thead>
                    <tr>
                      <th class="pt-1 pl-0">Employee</th>
                      <th class="pt-1">Pending Tasks</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    if(isset($employeewisependingtasks) && $employeewisependingtasks != false):
                      foreach($employeewisependingtasks as $data):
                        ?>
                        <tr>
                          <td class="py-1 pl-0"><?php echo $data[2];?></td>
                          <td><?php echo $data[3];?></td>
                          
                        </tr>
                        <?php    
                      endforeach;
                      else :
                        ?>
                        <tr>
                        <td colspan="4" class="text-center text-primary">No One Applied/Taken Leave Till Now</td>
                        </tr>
                        <?php
                    endif;
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br />
      <div class="row">
      <div class="col-md-12 grid-margin grid-margin-md-0 stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-primary text-left">Pending Tasks</h4>
              <div class="table-responsive">
              <table class="table">
                  <thead>
                    <tr>
                      <th class="pt-1 pl-0">Project</th>
                      <th class="pt-1">Task</th>
                      <th class="pt-1">Status</th>
                      <th class="pt-1">Priority</th>
                      <th class="pt-1">Description</th>
                      <th class="pt-1">Assign To</th>
                      <th class="pt-1">ID</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(isset($pendingTasks) && $pendingTasks != false):
                      foreach($pendingTasks as $data):
                        ?>
                        <?php
                          $class = "badge badge-dark";
                          if($data['task_status'] == 'To Do') {
                            $class = "badge badge-success";
                          }
                          if($data['task_status'] == 'In Progress') {
                            $class = "badge badge-primary";
                          }
                        ?>
                        <tr>
                          <td class="py-1 pl-0"><?php echo $data['project_name'];?></td>
                          <td><?php echo $data['task_name'];?></td>
                          <td><span class="<?php echo $class;?>"><?php echo $data['task_status'];?></span></td>
                          <td><?php echo $data['task_priority'];?></td>
                          <td><?php echo $data['task_description'];?></td>
                          <td><?php echo $data['user_name'];?></td>
                          <td><?php echo $data['task_id'];?></td>
                        </tr>
                        <?php    
                      endforeach;
                      else :
                        ?>
                        <tr>
                          <td colspan="4" class="text-center text-primary">No Pending Task Found</td>
                        </tr>
                        <?php
                    endif;
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br />
      <div class="row">
        <div class="col-md-3 grid-margin grid-margin-md-0 stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-primary text-center">City Visitor Month</h4>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="pt-1 pl-0">City Name</th>
                      <th class="pt-1">Visitors</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(isset($currentmonthcityvisitors) && $currentmonthcityvisitors != false):
                      foreach($currentmonthcityvisitors as $data):
                        ?>
                        <tr>
                          <td class="py-1 pl-0"><?php echo $data[2];?></td>
                          <td><?php echo $data[3];?></td>
                        </tr>
                        <?php    
                      endforeach;
                      else :
                        ?>
                        <tr>
                          <td colspan="4" class="text-center text-primary">No Visitors Found</td>
                        </tr>
                        <?php
                    endif;
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 grid-margin grid-margin-md-0 stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-primary text-center">Country Visitor Month</h4>
              <div class="table-responsive">
              <table class="table">
                  <thead>
                    <tr>
                      <th class="pt-1 pl-0">Country</th>
                      <th class="pt-1">Visitors</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(isset($currentmonthcountryvisitors) && $currentmonthcountryvisitors != false):
                      foreach($currentmonthcountryvisitors as $data):
                        ?>
                        <tr>
                          <td class="py-1 pl-0"><?php echo $data[2];?></td>
                          <td><?php echo $data[3];?></td>
                        </tr>
                        <?php    
                      endforeach;
                      else :
                        ?>
                        <tr>
                          <td colspan="4" class="text-center text-primary">No Visitors Found</td>
                        </tr>
                        <?php
                    endif;
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 grid-margin grid-margin-md-0 stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-primary text-center">City Visitors Year</h4>
              <div class="table-responsive">
              <table class="table">
                  <thead>
                    <tr>
                      <th class="pt-1 pl-0">City</th>
                      <th class="pt-1">Visitors</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(isset($currentyearcityvisitors) && $currentyearcityvisitors != false):
                      foreach($currentyearcityvisitors as $data):
                        ?>
                        <tr>
                          <td class="py-1 pl-0"><?php echo $data[2];?></td>
                          <td><?php echo $data[3];?></td>
                        </tr>
                        <?php    
                      endforeach;
                      else :
                        ?>
                        <tr>
                          <td colspan="4" class="text-center text-primary">No Visitors Found</td>
                        </tr>
                        <?php
                    endif;
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 grid-margin grid-margin-md-0 stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-primary text-center">Country Visitors Year</h4>
              <div class="table-responsive">
              <table class="table">
                  <thead>
                    <tr>
                      <th class="pt-1 pl-0">Country</th>
                      <th class="pt-1">Visitors</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(isset($currentyearcountryvisitors) && $currentyearcountryvisitors != false):
                      foreach($currentyearcountryvisitors as $data):
                        ?>
                        <tr>
                          <td class="py-1 pl-0"><?php echo $data[2];?></td>
                          <td><?php echo $data[3];?></td>
                        </tr>
                        <?php    
                      endforeach;
                      else :
                        ?>
                        <tr>
                          <td colspan="4" class="text-center text-primary">No Visitors Found</td>
                        </tr>
                        <?php
                    endif;
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br />
    <?php require_once $theme_path.'include/prefooter.php';?>
    <?php require $theme_path.'include/scripts.php';?>
</div>
<?php require_once $theme_path.'include/footer.php';?>