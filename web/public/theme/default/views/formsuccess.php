<?php
require $theme_path.'include/headerfront.php';
global $page_data;
?>
<div class="main-panel">
<div class="content-wrapper">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title text-primary text-center">Submitted Successfully</h1>
                <p class="text-center">Thank you, your enquiry has been submitted successfully. Our representative will verify your inquiry shortly.</p>
            </div>
        </div>
    </div>
</div>

<?php require_once $theme_path.'include/prefooterfront.php';?>
<?php require $theme_path.'include/scripts.php';?>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#ajax-upload').on('submit', function(e){
            $(".submitbutton").hide();
            $(".dot-opacity-loader").show();
            e.preventDefault();
            var form = e.target;
            $(".formerror").html('');
            $.ajax({
                url: form.action,
                dataType: 'json',
                method : "post",
                contentType: false,
                cache: false,
                processData:false, 
                data: new FormData(this),
                //data: $('#ajax-upload').serialize(),
                success: function(result){
                    if(result.error == '0'){
                      showSwal('contact-success');
                      setTimeout(function(){ location.href = '<?php echo $url.$item_alias; ?>'; }, 2000);
                      
                    }else{
                        $(".submitbutton").show();
                        $(".dot-opacity-loader").hide();
                        var response = result.values;
                        if(result.message != '') {
                            $("#error_message").html(result.message);
                        }
                        for (var key in response) {
                            if (response.hasOwnProperty(key)) {
                                $("#error_"+key+"").html(response[key]);
                            }
                        }
                    }
                }
            });
        });
    });    
    </script>
<?php require_once $theme_path.'include/footerfront.php';?>