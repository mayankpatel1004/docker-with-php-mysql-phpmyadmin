<?php
require $theme_path.'include/header.php';
global $page_data;
?>
<div class="main-panel">
        <div class="content-wrapper">
		<form name="report" class="reportform" method="post" action="<?php echo $url.'reportitem/timecardReportExport';?>">
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
												$arraySkip = array('task_name','timecard_id','user_id','project_id','task_id','deleted_by');
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
				<select name="user_id" class="form-control">
					<option value="">Select User</option>
					<?php
					foreach($arrTimecardUsers as $data) {
						?>
						<option value="<?php echo $data['user_name'];?>"><?php echo $data['user_name'];?></option>
						<?php
					}
					?>
				</select>
			</div>
			<div class="col-md-2">
				<select name="project_id" class="form-control">
					<option value="">Select Project</option>
					<?php
					foreach($arrTimecardProjects as $data) {
						?>
						<option value="<?php echo $data['project_id'];?>"><?php echo $data['project_name'];?></option>
						<?php
					}
					?>
				</select>
			</div>
			<div class="col-md-2">
				<select name="task_id" class="form-control">
					<option value="">Select Task</option>
					<?php
					foreach($arrTimecardTask as $data) {
						?>
						<option value="<?php echo $data['task_id'];?>"><?php echo $data['task_name'];?></option>
						<?php
					}
					?>
				</select>
			</div>
			<div class="col-md-2">
				<select name="timecard_date" class="form-control">
					<option value="">Select Date</option>
					<?php
					foreach($arrTimecardDate as $data) {
						?>
						<option value="<?php echo $data['timecard_date'];?>"><?php echo $data['timecard_date'];?></option>
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
		</div>
	</div>
<?php require_once 'report_footer.php';?>
</div>
<?php require_once $theme_path.'include/footerfront.php';?>