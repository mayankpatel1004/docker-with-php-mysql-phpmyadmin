<?php
require $theme_path.'include/header.php';
global $page_data;
?>
<div class="main-panel">
        <div class="content-wrapper">
		<form name="report" class="reportform" method="post" action="<?php echo $url.'reportitem/taskReportExport';?>">
			<div class="card">
				<div class="card-body">
				<?php
				if(isset($page_data['item_description']) && $page_data['item_description'] != ''){
						echo "<h1 class='text-center'>".$page_data['item_title']."</h1><br />";
				}
				?>
			<div class="tab-content col-md-12">
                <table width="100%">
                        <tr>
                            <td style="width:20%">
                                <b>Select Option:</b><br/>
                               <select multiple="multiple" id='lstBox1' style="width:100%;height:400px;">
									   <?php
										 if(isset($arrItems) && !empty($arrItems)):
											foreach($arrItems as $item) :
												$title = str_replace("_"," ",$item['Field']);
												$arraySkip = array('item_type','assign_by','attachment','deleted_by');
												if(in_array($item['Field'],$arraySkip)) {
													continue;
												} else {
													?>
													<option value="<?php echo $item['Field'];?>"><?php echo ucfirst($title);?></option>
													<?php
												}
											endforeach;
										 endif;  
									   ?>
                            </select>
                        </td>
                        <td style='width:20%;text-align:center;vertical-align:middle;'>
                            <input type='button' class="left_right_click" id='btnRight' value ='  >  '/>
                            <br/><input type='button' class="left_right_click" id='btnLeft' value ='  <  '/>
                        </td>
                        <td style="width:20%">
                            <b>Export Fields: </b><br/>
                            <select multiple="multiple" id='lstBox2' name="exports[]" style="width:100%;height:400px;">
                            </select>
							<input type="hidden" name="exportfields" id="exportfields" />
                        </td>
                    </tr>
                </table>

        </div>
		<br />
		<div class="row">
			<div class="col-md-2">
				<select name="task_status" class="form-control">
					<option value="">Task Status</option>
					<?php
					foreach($arrTaskstatus as $data) {
						?>
						<option value="<?php echo $data['task_status'];?>"><?php echo $data['task_status'];?></option>
						<?php
					}
					?>
				</select>
			</div>
			<div class="col-md-2">
				<select name="task_priority" class="form-control">
					<option value="">Task Priority</option>
					<?php
					foreach($arrTaskpriority as $data) {
						?>
						<option value="<?php echo $data['task_priority'];?>"><?php echo $data['task_priority'];?></option>
						<?php
					}
					?>
				</select>
			</div>
			<div class="col-md-2">
				<select name="task_name" class="form-control">
					<option value="">Task Name</option>
					<?php
					foreach($arrTaskname as $data) {
						?>
						<option value="<?php echo $data['task_name'];?>"><?php echo $data['task_name'];?></option>
						<?php
					}
					?>
				</select>
			</div>
			<div class="col-md-2">
				<select name="assign_to" class="form-control">
					<option value="">Assignee</option>
					<?php
					foreach($arrTaskAssignto as $data) {
						?>
						<option value="<?php echo $data['assign_to'];?>"><?php echo $data['user_name'];?></option>
						<?php
					}
					?>
				</select>
			</div>
			<div class="col-md-2">
				<select name="milestone" class="form-control">
					<option value="">Milestone</option>
					<?php
					foreach($arrTaskmilestones as $data) {
						?>
						<option value="<?php echo $data['milestone'];?>"><?php echo $data['milestone'];?></option>
						<?php
					}
					?>
				</select>
			</div>
		</div>
		<br />
		<div class="row">
				<div class="col-md-3">
					<input type="date" name="start_date" class="form-control" />
				</div>
				<div class="col-md-3">
					<input type="date" name="end_date" class="form-control" />
				</div>
				<div class="col-md-1">
					<input type="submit" name="submit" value="Submit" class="btn btn-primary" />
				</div>
				<div class="col-md-1">
				
				</div>
				<div class="col-md-1">
					<a class="btn btn-primary" href="<?php echo $url.$page_data['item_alias'];?>">Reset</a>
				</div>
			</div>
			</div>
				</form>
			<br /><br />
		</div>
	</div>
<?php require_once 'report_footer.php';?>
</div>
<?php require_once $theme_path.'include/footerfront.php';?>