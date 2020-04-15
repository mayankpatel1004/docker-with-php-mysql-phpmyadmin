<div class="row searchbar">
      <div class="col-md-2 col-sm-12 col-xs-12"><input type="text" value="<?php echo $searchtext;?>" style="padding:11px 10px;" name="searchtext" id="search_text" class="form-control  w-100 mb-10" placeholder="Search By Title..." autocomplete="off" onkeyup="searchFilter(1,'<?php echo $page_url;?>','<?php echo $item_alias;?>')" /><br /></div>
      <div class="col-md-2 col-sm-12 col-xs-12"><a href="<?php echo $reset_url;?>" class="btn btn-info">Reset</a><br /><br /></div>
      <div class="col-md-2 col-sm-12 col-xs-12">&nbsp;<br /><br /></div>
      <div class="col-md-2  col-sm-12 col-xs-12">
        <?php if(isset($backend_allow_action_dropdown) && $backend_allow_action_dropdown == 'Y'):?>
          <select name="selectbox" id="actionbox" class="form-control">
              <option value="">Select Action</option>
              <option value="To Do">To Do</option>
              <option value="In Progress">In Progress</option>
              <option value="Hold">Hold</option>
              <option value="QA Review">QA Review</option>
              <option value="Cancelled">Cancelled</option>
              <option value="Bug">Bug</option>
              <option value="Client Review">Client Review</option>
              <option value="Not Possible">Not Possible</option>
              <option value="Done">Done</option>
              <option value="T">Move To Trash</option>
          </select>
        <?php endif;?>
      </div>

      <div class="col-md-2 col-sm-12 col-xs-12">
        <?php if(isset($backend_allow_apply_button) && $backend_allow_apply_button == 'Y'):?>
            <input type="button" name="action" class="btn btn-success" value="Apply" onclick="showSwal('confirm-delete')" /><br /><br />
        <?php endif;?>
      </div>

      <div class="col-md-2 col-sm-12 col-xs-12 text-right">
        <?php if(isset($backend_allow_addnew_button) && $backend_allow_addnew_button == 'Y'):?>
            <a href="<?php echo $add_url;?>" class="btn btn-primary">+</a><br />
        <?php endif;?>
      </div>
      <input type="hidden" id="sort_type" value="DESC" />
      <input type="hidden" id="sort_by" value="task_id" />
  </div>

  <div class="row">
        <div class="col-md-2 col-sm-12 col-xs-12">
          <select name="selectbox" id="projectid" class="form-control" onchange="filterdata(this.value)">
              <option value="">Project</option>
                <?php if(isset($arrProjects) && !empty($arrProjects)):?>
                    <?php foreach($arrProjects as $key => $value):?>
                        <option value="<?php echo $key;?>" <?php if($projectid == $key){echo 'selected="selected"';}?>><?php echo $value;?></option>
                    <?php endforeach;?>
                <?php endif;?>
          </select>
        </div>

        <div class="col-md-2  col-sm-12 col-xs-12">
            <select name="selectbox" id="task_status" name="task_status" class="form-control" onchange="filterdata(this.value)">
                <option value="">Status</option>
                <option value="To Do" <?php if($task_status == 'To Do'){echo "selected='selected'";}?>>To Do</option>
                <option value="In Progress" <?php if($task_status == 'In Progress'){echo "selected='selected'";}?>>In Progress</option>
                <option value="Hold" <?php if($task_status == 'Hold'){echo "selected='selected'";}?>>Hold</option>
                <option value="QA Review" <?php if($task_status == 'QA Review'){echo "selected='selected'";}?>>QA Review</option>
                <option value="Cancelled" <?php if($task_status == 'Cancelled'){echo "selected='selected'";}?>>Cancelled</option>
                <option value="Bug" <?php if($task_status == 'Bug'){echo "selected='selected'";}?>>Bug</option>
                <option value="Client Review" <?php if($task_status == 'Client Review'){echo "selected='selected'";}?>>Client Review</option>
                <option value="Not Possible" <?php if($task_status == 'Not Possible'){echo "selected='selected'";}?>>Not Possible</option>
                <option value="Done" <?php if($task_status == 'Done'){echo "selected='selected'";}?>>Done</option>
            </select>
        </div>

      <div class="col-md-2 col-sm-12 col-xs-12">
          <select name="assignee" id="assigneeid" class="form-control" onchange="filterdata(this.value)">
              <option value="">Assignee</option>
                <?php if(isset($arrAssignees) && !empty($arrAssignees)):?>
                    <?php foreach($arrAssignees as $key => $value):?>
                        <option value="<?php echo $key;?>" <?php if($assigneeid == $key){echo 'selected="selected"';}?>><?php echo $value;?></option>
                    <?php endforeach;?>
                <?php endif;?>
          </select>
      </div>

      <div class="col-md-2 col-sm-12 col-xs-12">
          <select name="records_per_page" id="records_per_page" class="form-control" onchange="filterdata(this.value)">
              <option value="">Records</option>
                    <?php for($i=0;$i<500;$i=$i+50){?>
                        <?php if($i == 0){?>
                            <option value="10" <?php if($records_per_page == $i){echo 'selected="selected"';}?>><?php echo "10";?></option>
                        <?php } else { ?>
                        <option value="<?php echo $i;?>" <?php if($records_per_page == $i){echo 'selected="selected"';}?>><?php echo $i;?></option>
                    <?php }
                }?>
          </select>
      </div>
      
  </div>
  
  <script type="text/javascript">
    function filterdata(value) {
        searchFilterTasks(1,'<?php echo $page_url;?>','<?php echo $item_alias;?>'); 
    }

    function searchFilterTasks(page_no,url,item_alias) {
          $.ajax({
              type: 'POST',
              url: url,
              data:'page_no='+page_no+'&item_alias='+item_alias+'&search_text='+$("#search_text").val()+'&projectid='+$('#projectid').val()+"&assigneeid="+$("#assigneeid").val()+"&url="+url+"&records_per_page="+$("#records_per_page").val()+'&task_status='+$("#task_status").val(),
              beforeSend: function () {
                  $('.loading-overlay').show();
              },
              success: function (response) {
                  $(".dot-opacity-loader").hide();
                  data = JSON.parse(response);
                  $("#data_response").html(data.data);
              }
          });
      }
  </script>