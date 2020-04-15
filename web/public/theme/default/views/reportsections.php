<?php
require $theme_path.'include/header.php';
global $page_data;
?>
<div class="main-panel">
        <div class="content-wrapper">
			<form name="report" class="reportform" method="post" action="<?php echo $url.'reportitem/itemSectionReportExport';?>">
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
												$arraySkip = array('item_type','item_parent','item_category','guest_item','user_id','file1','file2','file3','controller','action','robots','published_at','published_end_at','html_sitemap','html_sitemap_order','admin_module','custom_view','display_order','deleted_status','deleted_by');
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
				<select name="item_type" class="form-control">
					<option value="">Select Type</option>
						<?php
						if(isset($arrItemtype) && !empty($arrItemtype)) {
							foreach($arrItemtype as $type) {
							?>
								<option value="<?php echo $type['item_type'];?>"><?php echo ucfirst($type['item_type']);?></option>
							<?php
							}
						}
						?>
				</select>
			</div>
			<div class="col-md-2">
				<select name="item_title" class="form-control">
					<option value="">Select Title</option>
						<?php
						if(isset($arrItemtitle) && !empty($arrItemtitle)) {
							foreach($arrItemtitle as $data) {
							?>
								<option value="<?php echo $data['item_section_id'];?>"><?php echo ucfirst($data['section_title']);?></option>
							<?php
							}
						}
						?>
				</select>
			</div>
			<div class="col-md-2">
				<select name="user_id" class="form-control">
					<option value="">Select Users</option>
						<?php
						if(isset($arrUsers) && !empty($arrUsers)) {
							foreach($arrUsers as $data) {
							?>
								<option value="<?php echo $data['user_id'];?>"><?php echo ucfirst($data['user_name']);?></option>
							<?php
							}
						}
						?>
				</select>
			</div>
			<div class="col-md-2">
				<select name="created_at" class="form-control">
					<option value="">Created Date</option>
						<?php
						if(isset($arrCreatedDate) && !empty($arrCreatedDate)) {
							foreach($arrCreatedDate as $data) {
							?>
								<option value="<?php echo $data['created_at'];?>"><?php echo $data['created_at'];?></option>
							<?php
							}
						}
						?>
				</select>
			</div>

			<div class="col-md-2">
				<select name="deleted_status" class="form-control">
					<option value="">Deleted Item</option>
						<?php
						if(isset($arrDeletedItems) && !empty($arrDeletedItems)) {
							foreach($arrDeletedItems as $data) {
							?>
								<option value="<?php echo $data['item_section_id'];?>"><?php echo $data['section_title'];?></option>
							<?php
							}
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