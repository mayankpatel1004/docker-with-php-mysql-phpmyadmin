<?php require $theme_path.'include/header.php';?>
            <div class="main-panel">
                <div class="content-wrapper">          
                <form name="frm" method="post" action="/siteconfiguration/saveformdata">
                
                <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                    <h1 class="card-title text-primary">Newsletters</h1>
                    <br />
                      <div class="row">
                      <div class="col-md-6">
                        <label>Select Group</label>
                        <select name="subscriber_group" class="form-control" onChange="getEmailData(this.value)">
                          <option value="">Select Option</option>
                          <?php
                          if(isset($getParentDetails) && count($getParentDetails) > 0){
                            foreach($getParentDetails as $data){
                              ?>
                              <option value="<?php echo $data['item_type'];?>"><?php echo ucfirst($data['item_type']);?></option>
                              <?php
                            }
                          }
                          ?>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label>Select Email Address</label>
                        <select name="email_address" id="email_address" class="form-control">
                            <option value="">Select Option</option>
                        </select>
                      </div>
                      <br /><br /><br />
                      <div class="col-md-12">
                      <br /><br />
                      <label>Subject Tagline</label>
                        <input type="text" name="subject" id="subject" value="" class="form-control" />
                      </div>
                      <br /><br />
                      <div class="col-md-12">
                      <br /><br /><br />
                      <label>Email Content</label>
                        <textarea id="summernoteExample" name="newsletter_content"></textarea>
                        <br /><br />
                      </div>
                      
                      <div class="col-md-12 text-danger text-center" id="error_message"></div>
                      <br /><br />
                      <input type="submit" name="submit" value="Save" class="btn btn-primary submitbutton" />
                      <div class="dot-opacity-loader" style="display:none;"><span></span><span></span><span></span></div>
                      </div>
                </div>
                
              </div>
              
            </div>
          </div>
          </form>    
          <?php require_once $theme_path.'include/prefooter.php';?>
          <?php require_once $theme_path.'include/scripts.php';?>
          <link rel="stylesheet" href="<?php echo $theme_url;?>vendors/summernote/dist/summernote.css" />        
          <script src="<?php echo $theme_url;?>vendors/summernote/dist/summernote.min.js"></script>
          <script type="text/javascript">
          $(document).ready(function(){
            $('#summernoteExample').summernote({
              height:300,tabsize:2
            });
          });
          $('form').on('submit', function (e) {
            $(".submitbutton").hide();
            $(".dot-opacity-loader").show();
            e.preventDefault();
            var form = e.target;
            $.ajax({
              dataType: 'json',
              method : "post",
              contentType: false,
              cache: false,
              processData:false, 
              url: '<?php echo $url;?>allnewsletters/saveformdata',
              data: new FormData(this),
              success: function (result) {
                if(result.error == '0'){
                        showSwal('success-comment');
                        setTimeout(function(){ location.reload(); }, 1000);
                    }else{
                        $(".submitbutton").show();
                        $(".dot-opacity-loader").hide();
                        var response = result.values;
                        if(result.message != '') {
                            $("#error_message").html(result.message);
                        }
                    }
              }
            });
          });

          function getEmailData(group_name) {
            $.ajax({
              method : "post",
              url: '<?php echo $url;?>allnewsletters/getEmaildata/?group_name='+group_name,
              success: function (response) {
                console.log(response);
                $("#email_address").html(response);
              }
            });
          }
          
          </script>
    </div>
    <?php require_once $theme_path.'include/footer.php';?>