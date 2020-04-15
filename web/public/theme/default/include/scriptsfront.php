<?php global $action;?>
<?php /*  ?>
<script src="<?php echo $theme_url;?>js/todolist.js"></script>
<script src="<?php echo $theme_url;?>vendors/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo $theme_url;?>js/alerts.js"></script>
<script src="<?php echo $theme_url;?>js/dashboard.js"></script>
<script src="<?php echo $theme_url;?>js/settings.js"></script>
<?php */?>
<script src="<?php echo $theme_url;?>vendors/js/vendor.bundle.base.js"></script>
<script src="<?php echo $theme_url;?>js/template.js"></script>
<script type="text/javascript">
function validateEmail(emailField){
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        if (reg.test(emailField.value) == false) {
            alert('Invalid Email Address');
            return false;
        }
        return true;
}
$(document).ready(function(){
    $("#subscribe_newsletter").click(function(){
        $(".error").html('');
        if($("#newsletter_email").val() == ''){
            $(".newsletter_error").html('Please enter your email address.');
            $(".newsletter_error").css('color','red');
            $(".newsletter_error").css('text-align','center');
            $("#newsletter_email").focus();
            return false;
        }
        else if($("#newsletter_email").val() != ''){
            var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            if (reg.test($("#newsletter_email").val()) == false) {
                $(".newsletter_error").html('Please enter valid email address.');
                $(".newsletter_error").css('color','red');
                $(".newsletter_error").css('text-align','center');
                $("#newsletter_email").focus();
                return false;
            }
            else {
                $.ajax({
                    dataType: 'json',
                    method : "post",
                    contentType: false,
                    cache: false,
                    processData:false, 
                    url: '<?php echo $url;?>homecontroller/subscribe/?email='+$("#newsletter_email").val(),
                    success: function (data) {
                        if(data.success == 1) {
                            document.getElementById('newsletter_email').value = '';
                            alert(data.message);
                        } else {
                            $(".newsletter_error").html(data.message);
                            $(".newsletter_error").css('color','red');
                            $(".newsletter_error").css('text-align','center');
                            $("#newsletter_email").focus();
                        }
                    }
                });
            }
        }
    });
})
$(document).ready(function(){
        $.ajax({
                dataType: 'json',
                method : "post",
                contentType: false,
                cache: false,
                processData:false, 
                url: '<?php echo $url;?>ourwork/getdata/?itemtype=ourwork',
                success: function (response) {
                        //console.log(response.data);
                        $("#ourwork_response").html(response.data);
                }
        });
});
function searchFilter(page_no,url,item_alias) {
    $.ajax({
        type: 'POST',
        url: url,
        data:'page_no='+page_no+'&item_alias='+item_alias+'&search_text='+$("#search_text").val()+'&sort_by='+$('#sort_by').val()+"&sort_type="+$("#sort_type").val()+"&url="+url+"&records_per_page="+$("#records_per_page").val(),
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

$(document).ready(function(){
  setTimeout(function(){ 
    var url_data = '<?php echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];?>';
    $.ajax({
          dataType: 'json',
          method : "post",
          contentType: false,
          cache: false,
          processData:false, 
          url: '<?php echo $url;?>Homecontroller/insertLogs/?url='+encodeURIComponent(url_data),
          success: function (data) {
            if(data.success == 1){
            }
          }
        });
   },1000);
});

function customerlogout() {
        $.ajax({
          dataType: 'json',
          method : "post",
          contentType: false,
          cache: false,
          processData:false, 
          url: '<?php echo $url;?>login/customerlogout',
          success: function (data) {
            if(data.success == 1){
              window.location.href = '<?php $url;?>';
            }
          }
        });
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>