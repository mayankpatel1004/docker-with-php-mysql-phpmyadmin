<?php require $theme_path.'include/headerfront.php';?>
<div class="main-panel">
<div class="row">
    <?php if(isset($arrBanners) && !empty($arrBanners)):?>
    <div class="col-lg-12 grid-margin1 stretch-card">
        <div class="owl-carousel owl-theme full-width">
            <?php foreach($arrBanners as $banner):?>
            <div class="item">
                <div class="card text-white">
                    <?php
                    $link_url = "javascript::void(0)";
                    $banner_url = $banner['external_url']; 
                    $key = 'http';
                    if (strpos($url, $key) == false) { 
                        $link_url = $banner_url; 
                    } 
                    else { 
                        $link_url = $url.$banner['external_url'];
                    }
                    ?>
                    <?php $displaybanner = $cf->displayFile(ITEMS_PATH . $banner['file1'], ITEMS_URL . $banner['file1'], $thumb = '', 1349,550);?>
                    <a href="<?php echo $link_url;?>"><img class="card-img" src="<?php echo $displaybanner;?>" alt="<?php echo $banner['item_title'];?>"></a>
                    <div class="card-img-overlay d-flex">
                        <div class="mt-auto text-center w-100">
                            <h6 class="card-text mb-4 font-weight-normal"><a class="d-none" href="<?php echo $link_url;?>"><?php echo $banner['item_title'];?></a></h6>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
    <?php endif;?>
</div>

<div class="content-wrapper">
    <?php echo $arrDescription['item_description'];?>
    <br /><br />
	<h2 class="text-center text-primary">Our Services</h2>
	<Br />
    <div class="row">

    <div class="col-md-4 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
										<img src="<?php echo $theme_url."images/website_design.jpg";?>" class="img-lg rounded" alt="profile image">
										<div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
											<h6 class="mb-2 text-primary">Website design</h6>
											<p class="mb-0">We will provide you<br /> multiple website designs. <br />Excellent UI/UX.</p>
										</div>
									</div>
								</div>
							</div>
						</div>

                        <div class="col-md-4 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
										<img src="<?php echo $theme_url."images/website_development.jpg";?>" class="img-lg rounded" alt="profile image">
										<div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
											<h6 class="mb-2 text-primary">Website Development</h6>
											<p class="mb-0">Fully Customized Website<br /> dynamic applications. User<br />Friendly views.</p>
										</div>
									</div>
								</div>
							</div>
						</div>


                        <div class="col-md-4 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
										<img src="<?php echo $theme_url."images/mobile_applications.jpg";?>" class="img-lg rounded" alt="profile image">
										<div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
											<h6 class="mb-2 text-primary">Mobile Application</h6>
											<p class="mb-0">We are providing<br /> hybrid as well native<br /> mobile applications.</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-4 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
										<img src="<?php echo $theme_url.'images/hosting_provider.jpg';?>" class="img-lg rounded" alt="profile image">
										<div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
											<h6 class="text-primary mb-2">Excellent Hosting</h6>
                                            <p class="text-muted mb-1">You need to build, <br />host and manage<br /> your Online Website.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
										<img src="<?php echo $theme_url."images/optimized.jpg";?>" class="img-lg rounded" alt="profile image">
										<div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
											<h6 class="mb-2 text-primary">Optimized Applications</h6>
											<p class="text-muted mb-1">You will get optimized <br />application. Verification <br />on Page speed tools</p>
											
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
										<img src="<?php echo $theme_url."images/ssl.png";?>" class="img-lg rounded" alt="profile image">
										<div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
											<h6 class="mb-2 text-primary">SSL Certificates</h6>
											<p class="mb-0">You will get SSL certificates<br /> after completion of website<br /> and hosted on LIVE server</p>
										</div>
									</div>
								</div>
							</div>
						</div>
                        <div class="col-md-4 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
										<img src="<?php echo $theme_url."images/support.png";?>" class="img-lg rounded" alt="profile image">
										<div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
											<h6 class="mb-2 text-primary">Free Support</h6>
											<p class="mb-0">You will get free support<br /> for your queries. Will <br />show you demos of work.</p>
										</div>
									</div>
								</div>
							</div>
						</div>

                        <div class="col-md-4 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
										<img src="<?php echo $theme_url."images/report.jpg";?>" class="img-lg rounded" alt="profile image">
										<div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
											<h6 class="mb-2 text-primary">Monthly Reports</h6>
											<p class="mb-0">You will get monthly<br /> report of your <br />websites.</p>
										</div>
									</div>
								</div>
							</div>
						</div>

                        <div class="col-md-4 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
										<img src="<?php echo $theme_url."images/custom.png";?>" class="img-lg rounded" alt="profile image">
										<div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
											<h6 class="mb-2 text-primary">Customizations</h6>
											<p class="mb-0">You will get fully<br /> customized websites<br /> and mobile applications.</p>
										</div>
									</div>
								</div>
							</div>
						</div>

                        
					
					</div>

                    

</div>
    
<?php require_once $theme_path.'include/prefooterfront.php';?>
<?php require_once $theme_path.'include/scriptsfront.php';?>
</div>
<link rel="stylesheet" href="<?php echo $theme_url;?>vendors/owl-carousel-2/owl.carousel.min.css">
<link rel="stylesheet" href="<?php echo $theme_url;?>vendors/owl-carousel-2/owl.theme.default.min.css">
<script src="<?php echo $theme_url;?>vendors/js/vendor.bundle.base.js"></script>
<script src="<?php echo $theme_url;?>vendors/owl-carousel-2/owl.carousel.min.js"></script>
<script src="<?php echo $theme_url;?>js/owl-carousel.js"></script>

<?php require_once $theme_path.'include/footerfront.php';?>