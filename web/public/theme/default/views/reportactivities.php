<?php
require $theme_path.'include/header.php';
global $page_data;
?>
<div class="main-panel">
        <div class="content-wrapper">
		<form name="report" class="reportform" method="post" action="<?php echo $url.'reportitem/activityReportExport';?>">
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
												$arraySkip = array('item_type','note1','note2');
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
				<select name="table_name" class="form-control">
					<option value="">Database Table</option>
					<?php
					foreach($arrDatabaseTables as $data) {
						?>
						<option value="<?php echo $data['table_name'];?>"><?php echo $data['table_name'];?></option>
						<?php
					}
					?>
				</select>
			</div>
			<div class="col-md-2">
				<select name="record_name" class="form-control">
					<option value="">Record Name</option>
					<?php
					foreach($arrRecordname as $data) {
						?>
						<option value="<?php echo $data['record_name'];?>"><?php echo $data['record_name'];?></option>
						<?php
					}
					?>
				</select>
			</div>
			<div class="col-md-2">
				<select name="created_by" class="form-control">
					<option value="">Created By</option>
					<?php
					foreach($arrCreatedby as $data) {
						?>
						<option value="<?php echo $data['created_by_name'];?>"><?php echo $data['created_by_name'];?></option>
						<?php
					}
					?>
				</select>
			</div>
			<div class="col-md-2">
				<select name="status_action" class="form-control">
					<option value="">Status Action</option>
					<?php
					foreach($arrStatusAction as $data) {
						?>
						<option value="<?php echo $data['status_action'];?>"><?php echo $data['status_action'];?></option>
						<?php
					}
					?>
				</select>
			</div>
			<div class="col-md-2">
				<select name="action" class="form-control">
					<option value="">Action</option>
					<?php
					foreach($arrAction as $data) {
						?>
						<option value="<?php echo $data['action'];?>"><?php echo $data['action'];?></option>
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
			
			<br /><br />
			</form>
		</div>
	</div>
<?php require_once 'report_footer.php';?>
</div>
<?php require_once $theme_path.'include/footerfront.php';?>