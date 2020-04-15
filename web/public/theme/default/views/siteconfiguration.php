<?php require $theme_path.'include/header.php';?>
            <div class="main-panel">
                <div class="content-wrapper">          
                <form name="frm" method="post" action="/siteconfiguration/saveformdata">
                
                <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">                
                    <div class="card-body">
                    <h4 class="card-title text-primary">Site Configuration</h4>
                    
                  <?php
                  if(isset($arrData['arrParentData']) && !empty($arrData['arrParentData'])){
                    foreach($arrData['arrParentData'] as $parent){
                  ?>
                  <div class="mt-4">
                    <div class="accordion accordion-multi-colored" id="accordion-<?php echo $parent['site_config_parent_id'];?>" role="tablist">
                      <div class="card">
                        <div class="card-header" role="tab" id="heading-<?php echo $parent['site_config_parent_id'];?>">
                          <h6 class="mb-0">
                            <a data-toggle="collapse" href="#collapse-<?php echo $parent['site_config_parent_id'];?>" aria-expanded="false" aria-controls="collapse-<?php echo $parent['site_config_parent_id'];?>"><?php echo $parent['site_config_title'];?></a>
                          </h6>
                        </div>
                        <div id="collapse-<?php echo $parent['site_config_parent_id'];?>" class="collapse" role="tabpanel" aria-labelledby="heading-<?php echo $parent['site_config_parent_id'];?>" data-parent="#accordion-<?php echo $parent['site_config_parent_id'];?>">
                          <div class="card-body">
                            
                            <div class="row">
                            <?php
                            if(isset($arrChilddata[$parent['site_config_parent_id']])){
                              foreach($arrChilddata[$parent['site_config_parent_id']] as $childs){
                              ?>
                              <div class="col-3">
                                <label><?php echo $childs['config_title'];?></label>
                                
                                <?php if(isset($childs['input_type']) && ($childs['input_type'] == 'text' || $childs['input_type'] == 'email')):?>
                                <input type="text" name="<?php echo $childs['config_name'];?>" id="<?php echo $childs['config_name'];?>" class="form-control" value="<?php echo $childs['config_value'];?>" autocomplete="off" />
                                <?php endif;?>
                                
                                <?php if(isset($childs['input_type']) && $childs['input_type'] == 'file'):?>
                                <input type="file" name="<?php echo $childs['config_name'];?>" id="<?php echo $childs['config_name'];?>" class="form-control" value="<?php echo $childs['config_value'];?>" />
                                <?php if(isset($childs['config_value']) && $childs['config_value'] != ''):?>
                                  <a href="<?php echo ITEMS_URL.$childs['config_value'];?>" target="_blank">View File</a>
                                <?php endif;?>
                                <?php endif;?>

                                <?php if(isset($childs['input_type']) && $childs['input_type'] == 'textarea'):?>
                                <textarea name="<?php echo $childs['config_name'];?>" id="<?php echo $childs['config_name'];?>" class="form-control"><?php echo $childs['config_value'];?></textarea>
                                <?php endif;?>
                                
                                <?php if(isset($childs['input_type']) && $childs['input_type'] == 'select'):
                                  $fillArray = array();
                                  $arrData = explode('@=',$childs['comments']); 
                                  ?>
                                  <select name="<?php echo $childs['config_name'];?>" id="<?php echo $childs['config_name'];?>" class="form-control">
                                    <?php foreach($arrData as $data){?>
                                      <option value="<?php echo $data;?>" <?php if($data == $childs['config_value']){echo "selected='selected'";}?>><?php echo $data;?></option>
                                    <?php }?>
                                  </select>
                                <?php endif;?>
                              </div>
                              <?php  
                              }
                            }
                            ?>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <?php
                  }
                }
                ?>
                <input type="submit" name="submit" value="Save" class="btn btn-primary" />
                </div>
              </div>
            </div>
          </div>
          </form>    
          <?php require_once $theme_path.'include/prefooter.php';?>
          <?php require_once $theme_path.'include/scripts.php';?>
          <script type="text/javascript">
          $('form').on('submit', function (e) {
            e.preventDefault();
            var form = e.target;
            $.ajax({
              dataType: 'json',
              method : "post",
              contentType: false,
              cache: false,
              processData:false, 
              url: '<?php echo $url;?>siteconfiguration/saveformdata',
              data: new FormData(this),
              success: function (data) {
                alert("Data successfully updated.");
                location.reload();
                // obj = JSON.parse(data);
                // if(obj.success == '1'){
                //   alert("Data successfully updated.");
                //   location.reload();
                // }
              }
            });
          });
          </script>
    </div>
    <?php require_once $theme_path.'include/footer.php';?>