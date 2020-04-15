<div class="main-panel">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3690.227717527664!2d73.18707141442998!3d22.345028946917576!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395fcfbed02d98ef%3A0xfcd797eb2e58fa61!2sJayKrishna+Software+-+Website+Development+Company+%2C+Native+Application+Development+Company+Vadodara!5e0!3m2!1sen!2sin!4v1561361909475!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        <div class="content-wrapper">          
          <div class="row">
          <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Your Name</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Your's Name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Your E-mail Address">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword2">Contact</label>
                      <input type="text" class="form-control" id="exampleInputPassword2" placeholder="Contact Number">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Subject</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Subject">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputConfirmPassword1">Your's Thought</label>
                      <textarea name="" class="form-control"></textarea>
                    </div>
                    <button type="button" onclick="return submitform()" class="btn btn-primary mr-2">Submit</button>
                  </form>
                  <script type="text/javascript">
                  function submitform() {
                      $(".form-control").val('');
                      showSwal('contact-success');
                    }
                  </script>
                </div>
              </div>
            </div>

            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Office Details</h4>
                  <p>Phone: 098796 18640</p>
                  <p>E-mail : <a href="mailto:jaykrishnasoftware@gmail.com">jaykrishnasoftware@gmail.com</a></p>
                  <address><br /> B-7 Trimurti Society, Behind, New Sama Rd, Swati Society, Raghuvir Nagar, Ekta Nagar, New Sama, Vadodara, Gujarat 390024</address>
                  <p><strong><br />Working Hours:</strong></p>
                  <p>Monday - Friday : 10:00AM to 7:00PM</p>
                </div>
              </div>
            </div>
          </div>
          
        </div>
        <?php require_once $theme_path.'include/footer.php';?>
    <?php require $theme_path.'include/scripts.php';?>
</div>
<link rel="stylesheet" href="<?php $url;?>vendors/lightgallery/css/lightgallery.css" />
<script src="<?php $url;?>vendors/lightgallery/js/lightgallery-all.min.js"></script>
<script src="<?php $url;?>js/light-gallery.js"></script>