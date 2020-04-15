<?php
global $page_data;
require $theme_path.'include/header.php';
?>
<link rel="stylesheet" href="<?php echo $theme_url;?>vendors/bootstrap-datepicker/bootstrap-datepicker.min.css" />
<link rel="stylesheet" href="<?php echo $theme_url;?>vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
<link rel="stylesheet" href="<?php echo $theme_url;?>vendors/select2/select2.min.css">
<link rel="stylesheet" href="<?php echo $theme_url;?>vendors/summernote/dist/summernote.css" />        
<div class="main-panel">
        <div class="content-wrapper">
		<form name="report" class="reportform" method="post" action="<?php echo $url.'reportitem/visitorsReportExport';?>">
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
												$arraySkip = array('url');
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
					<select name="title" id="title" class="form-control">
						<option value="">Select Title</option>
						<?php
						if(isset($arrTitle) && !empty($arrTitle)) {
							foreach($arrTitle as $column) {
								?>
								<option value="<?php echo $column['title'];?>"><?php echo $column['title'];?></option>
								<?php
							}
						}
						?>
					</select>
				</div>
				<div class="col-md-2">
					<select name="country" id="country" class="form-control">
						<option value="">Select Country</option>
						<?php
						if(isset($arrCountries) && !empty($arrCountries)) {
							foreach($arrCountries as $column) {
								?>
								<option value="<?php echo $column['country'];?>"><?php echo $column['country'];?></option>
								<?php
							}
						}
						?>
					</select>
				</div>
				<div class="col-md-2">
					<select name="city" id="city" class="form-control">
						<option value="">Select City</option>
						<?php
						if(isset($arrCities) && !empty($arrCities)) {
							foreach($arrCities as $column) {
								?>
								<option value="<?php echo $column['city'];?>"><?php echo $column['city'];?></option>
								<?php
							}
						}
						?>
					</select>
				</div>
				<div class="col-md-2">
					<select name="platform" id="platform" class="form-control">
						<option value="">Select Platform</option>
						<?php
						if(isset($arrPlatform) && !empty($arrPlatform)) {
							foreach($arrPlatform as $column) {
								?>
								<option value="<?php echo $column['platform'];?>"><?php echo $column['platform'];?></option>
								<?php
							}
						}
						?>
					</select>
				</div>
				<div class="col-md-2">
					<select name="browsername" id="browsername" class="form-control">
						<option value="">Select Browser</option>
						<?php
						if(isset($arrBrowsername) && !empty($arrBrowsername)) {
							foreach($arrBrowsername as $column) {
								?>
								<option value="<?php echo $column['browsername'];?>"><?php echo $column['browsername'];?></option>
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
		<br />
			</div>
					</form>
		</div>
	</div>
<?php require_once 'report_footer.php';?>
<?php require_once $theme_path.'include/footer.php';?>