<?php require $theme_path.'include/header.php';?>
<div class="main-panel">
                <div class="content-wrapper">                  
                 <div class="row">
                    <div class="col-md-6 grid-margin grid-margin-md-0 stretch-card">
                      <div class="card">
                        <div class="card-body">
                          <h4 class="card-title text-primary text-center">Your Projects</h4>
                          <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th class="pt-1 pl-0 col-md-2">Description</th>
                                  <th class="pt-1 col-md-2">Project Name</th>
                                  <th class="pt-1 col-md-2">ID</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $arrProjectId = array();
                                if(isset($arrClientProjects) && count($arrClientProjects) > 0):
                                    foreach($arrClientProjects as $project):
                                        $arrProjectId[] = $project['item_section_id'];
                                        ?>
                                        <tr>
                                            <td><?php echo $project['description'];?></td>
                                            <td><?php echo $project['section_title'];?></td>
                                            <td><?php echo $project['item_section_id'];?></td>
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
                          <h4 class="card-title text-primary text-center">Hours By Project</h4>
                          <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th class="pt-1 pl-0">Project Name</th>
                                  <th class="pt-1">Hours</th>
                                  <th class="pt-1">ID</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                if(isset($arrGetHoursByProject) && count($arrGetHoursByProject) > 0) {
                                    foreach($arrGetHoursByProject as $project) {
                                        ?>
                                        <tr>
                                            <td><?php echo $project['project_name'];?></td>
                                            <td><?php echo $project['hours'];?></td>
                                            <td><?php echo $project['project_id'];?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                  
                    </div>
                  </div>
                  <br />
                  <?php if(isset($employeeProjectHours) && count($employeeProjectHours)):?>
                    <br />
                    <h4 class="card-title text-primary text-left">Project Wise Employee Hours</h4><hr />
                    <br />
                  <div class="row">
                      <?php foreach($employeeProjectHours as $project){?>
                    <div class="col-md-4 grid-margin grid-margin-md-0 stretch-card">
                      <div class="card">
                        <div class="card-body">
                            
                          
                          <h5 class="text-primary text-center"><?php echo isset($project[0]['project_name']) && $project[0]['project_name'] != "" ? $project[0]['project_name'] : "N/A";?></h5>
                          <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th class="pt-1 pl-0 col-md-2">Employee</th>
                                  <th class="pt-1 col-md-2">Hours</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php for($i=0;$i<count($project);$i++){?>
                                    <tr>
                                        <td><?php echo $project[$i]['user_name'];?></td>
                                        <td><?php echo $project[$i]['hours'];?></td>
                                    </tr>
                                    <?php
                                    }
                                ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php }?>
                </div>
                <?php 
            endif;?>
                <br />
                <?php if(isset($employeeInprogressTask) && count($employeeInprogressTask)):?>
                    <br />
                    <h4 class="card-title text-primary text-left">Project Wise In Progress Tasks</h4><hr />
                    <br />
                  <div class="row">
                      <?php foreach($employeeInprogressTask as $project){?>
                    <div class="col-md-12 grid-margin grid-margin-md-0 stretch-card mb-5">
                      <div class="card">
                        <div class="card-body">
                            
                          
                          <h5 class="text-primary text-center"><?php echo isset($project[0]['project_name']) && $project[0]['project_name'] != "" ? $project[0]['project_name'] : "N/A";?></h5>
                          <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th class="pt-1 col-md-2">Task</th>
                                  <th class="pt-1 col-md-2">Description</th>
                                  <th class="pt-1 col-md-2">Status</th>
                                  <th class="pt-1 col-md-2">Priority</th>
                                  <th class="pt-1 col-md-2">Employee</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php for($i=0;$i<count($project);$i++){?>
                                  <?php
                                  $class = "badge badge-success";
                                  if($project[$i]['task_status'] == 'To Do') {
                                    $class = "badge badge-primary";
                                  }
                                  else if($project[$i]['task_status'] == 'In Progress') {
                                    $class = "badge badge-info";
                                  }
                                  else if($project[$i]['task_status'] == 'QA Review') {
                                    $class = "badge badge-warning";
                                  }
                                  ?>
                                    <tr>
                                        <td><?php echo $project[$i]['task_name'];?></td>
                                        <td><?php echo $project[$i]['task_description'];?></td>
                                        <td><span class="<?php echo $class;?>"><?php echo $project[$i]['task_status'];?></span></td>
                                        <td><?php echo $project[$i]['task_priority'];?></td>
                                        <td><?php echo $project[$i]['user_name'];?></td>
                                    </tr>
                                    <?php
                                    }
                                ?>
                              </tbody>
                              
                            </table>
                            
                          </div>
                        </div>
                      </div>
                      <br />
                    </div>
                    <br />
                    <?php }?>
                </div>
                <?php 
            endif;?>
                <br />
                </div>
                <?php require_once $theme_path.'include/prefooter.php';?>
                <?php require $theme_path.'include/scripts.php';?>
</div>
<?php require_once $theme_path.'include/footer.php';?>