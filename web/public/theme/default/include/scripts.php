<?php global $action;?>
<script src="<?php echo $theme_url;?>vendors/js/vendor.bundle.base.js"></script>
<?php if($action == 'form1'):?>
<script src="<?php echo $theme_url;?>vendors/progressbar.js/progressbar.min.js"></script>
<script src="<?php echo $theme_url;?>vendors/flot/jquery.flot.js"></script>
<script src="<?php echo $theme_url;?>vendors/flot/jquery.flot.resize.js"></script>
<script src="<?php echo $theme_url;?>vendors/flot/curvedLines.js"></script>
<script src="<?php echo $theme_url;?>vendors/chart.js/Chart.min.js"></script>
<script src="<?php echo $theme_url;?>js/off-canvas.js"></script>
<script src="<?php echo $theme_url;?>js/hoverable-collapse.js"></script>
<?php endif;?>

<script src="<?php echo $theme_url;?>js/template.js"></script>
<script src="<?php echo $theme_url;?>js/settings.js"></script>
<script src="<?php echo $theme_url;?>js/todolist.js"></script>
<script src="<?php echo $theme_url;?>vendors/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo $theme_url;?>js/alerts.js"></script>
<script src="<?php echo $theme_url;?>js/dashboard.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $(".add_row_point_a3").click(function(){
        $(".row_point_a3").append('<div class="row"><div class="col-md-3"><br /><label class="position-relative pt-3 text-center">Enter Specifications</label></div><div class="col-md-3"><br /><input type="text" name="specification_title[]" value="" class="form-control" placeholder="Specification Title" /></div><div class="col-md-4"><br /><input type="text" name="specification_value[]" value="" class="form-control" placeholder="Specification Value" /></div><div class="col-md-1"><br /><a href="javascript:void(0);" class="remCF"><i class="mdi mdi-delete position-relative pt-3"></i></a></div></div>');
    })
    $(".row_point_a3").on('click','.remCF',function(){
        if(confirm("Are you sure you wanna delete item?")){
            $(this).parent().parent().remove();
        }
    });

    $(".add_row_point_a4").click(function(){
        $(".row_point_a4").append('<div class="row product-price-border-top"> <div class="col-md-2"> <div class="form-group"> <label class="col-sm-12 col-form-label">Product <br>Price</label> <input type="text" class="form-control" name="product_option_price_1[]" autocomplete="off" value=""> </div> </div> <div class="col-md-2" style="display:none;"> <div class="form-group"> <label class="col-sm-12 col-form-label">Product Defult Price</label> <input type="text" class="form-control" name="is_default_price_1[]" autocomplete="off" value="N"> </div> </div> <div class="col-md-2"> <div class="form-group"> <label class="col-sm-12 col-form-label">Product Display Price</label> <input type="text" class="form-control" name="product_option_price_display_1[]" autocomplete="off" value=""> </div> </div> <div class="col-md-2"> <div class="form-group"> <label class="col-sm-12 col-form-label">Product Tax Amount</label> <input type="text" class="form-control" name="item_tax_amount_1[]" autocomplete="off" value=""> </div> </div> <div class="col-md-2"> <div class="form-group"> <label class="col-sm-12 col-form-label">Shipping Amount</label> <input type="text" class="form-control" name="item_shipping_amount_1[]" autocomplete="off" value=""> </div> </div> <div class="col-md-2"> <div class="form-group"> <label class="col-sm-12 col-form-label">Product Quantity</label> <input type="text" class="form-control" name="product_quantity_1[]" autocomplete="off" value=""> </div> </div> <div class="col-md-2"> <div class="form-group"> <label class="col-sm-12 col-form-label">Min. Quantity Notifications</label> <input type="text" class="form-control" name="min_quantity_notification_1[]" autocomplete="off" value=""> </div> </div> <div class="col-md-2"> <div class="form-group"> <label class="col-sm-12 col-form-label">Attribute-1</label> <input type="text" class="form-control" name="product_attribute_1[]" placeholder="Attribute Value" /> </div> </div> <div class="col-md-2"> <div class="form-group"> <label class="col-sm-12 col-form-label">Option-1</label> <input type="text" class="form-control" name="product_option_1[]" placeholder="Option Value" /> </div> </div> <div class="col-md-2"> <div class="form-group"> <label class="col-sm-12 col-form-label">Attribute-2</label> <input type="text" class="form-control" name="product_attribute_2[]" placeholder="Attribute Value" /> </div> </div> <div class="col-md-2"> <div class="form-group"> <label class="col-sm-12 col-form-label">Option-2</label> <input type="text" class="form-control" name="product_option_2[]" placeholder="Option Value" /> </div> </div> <div class="col-md-1"> <a href="javascript:void(0);" class="remCF"><i class="mdi mdi-delete position-relative pt-3"></i></a> </div></div>');

    })
    $(".row_point_a4").on('click','.remCF',function(){
        if(confirm("Are you sure you wanna delete item?")){
            $(this).parent().parent().remove();
        }
    });

});
</script>
<script type="text/javascript">
function checkAll(o) {
  var boxes = document.getElementsByTagName("input");
  for (var x = 0; x < boxes.length; x++) {
    var obj = boxes[x];
    if (obj.type == "checkbox") {
      if (obj.name != "check")
        obj.checked = o.checked;
    }
  }
}

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

function memberlogout() {
    $.ajax({
      dataType: 'json',
      method : "post",
      contentType: false,
      cache: false,
      processData:false, 
      url: '<?php echo $url;?>memberlogin/memberlogout',
      success: function (data) {
        if(data.success == 1){
          window.location.href = '<?php echo $url;?>memberlogin';
        }
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

</script>