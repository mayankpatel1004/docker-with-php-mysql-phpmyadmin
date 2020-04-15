<?php
global $page_data;
require $theme_path.'include/header.php';
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-primary"><?php echo $item_alias;?> form</h4>
                    <div class="row">
                        <div class="col-md-12" id="error_message" style="color:red;text-align:center;"></div>
                    </div>
                    <form class="form-sample" action="<?php echo $save_url ; ?>" id="ajax-upload" method="post"
                        enctype="multipart/form-data">
                        <div class="accordion accordion-solid-header" id="accordion-4" role="tablist">
                            <?php require_once 'productform/productdetails.php';?>
                            <?php require_once 'productform/productpricedetails.php';?>
                            <?php require_once 'productform/additionalimages.php';?>
                            <?php require_once 'productform/productattributes.php';?>
                        </div>
                        <span id="submit_button">
                            <input class="btn btn-primary" type="submit" value="Submit" />
                            <input class="btn btn-primary" type="reset" value="Reset" />
                            <a class="btn btn-primary" href="<?php echo $url.$item_alias;?>">Back</a>
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php require_once $theme_path.'include/prefooter.php';?>
    <?php require $theme_path.'include/scripts.php';?>
</div>
<link rel="stylesheet" href="<?php echo $theme_url;?>vendors/bootstrap-datepicker/bootstrap-datepicker.min.css" />
<link rel="stylesheet" href="<?php echo $theme_url;?>vendors/summernote/dist/summernote.css" />
<script src="<?php echo $theme_url;?>vendors/select2/select2.min.js"></script>
<script src="<?php echo $theme_url;?>vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?php echo $theme_url;?>vendors/summernote/dist/summernote.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#ajax-upload').on('submit', function (e) {
            e.preventDefault();
            var form = e.target;
            $(".formerror").html('');
            $("#submit_button").hide();
            //return false;
            if(confirm("Are you sure you wanna save this record?")) {
                $.ajax({
                url: form.action,
                dataType: 'json',
                method: "post",
                contentType: false,
                cache: false,
                async: false,
                processData: false,
                data: new FormData(this),
                //data: $('#ajax-upload').serialize(),
                success: function (result) {
                    $("#submit_button").show();
                    if (result.error == '0') {
                        $("#ajax-upload")[0].reset();
                        location.href = '<?php echo $url.$item_alias; ?>';
                    } else {
                        var response = result.values;
                        if (result.message != '') {
                            $("#error_message").html(result.message);
                        }
                        //console.log(response);
                        for (var key in response) {
                            if (response.hasOwnProperty(key)) {
                                $("#error_" + key + "").html(response[key]);
                            }
                        }
                    }
                }
            });
            } else {
                $("#submit_button").show();
                return false;
            }
            
        });
    });    
</script>

<script type="text/javascript">
    $('#datepicker-popup').datepicker();
    $('#summernoteExample').summernote({
        height: 300, tabsize: 2
    });
    (function ($) {
        'use strict';
        if ($("#fileuploader").length) {
            $("#fileuploader").uploadFile({
                url: "<?php echo $theme_url;?>",
                fileName: "myfile"
            });
        }
    })(jQuery);
    (function ($) {
        'use strict';
        if ($(".js-example-basic-single").length) {
            $(".js-example-basic-single").select2();
        }
        if ($(".js-example-basic-multiple").length) {
            $(".js-example-basic-multiple").select2();
        }
    })(jQuery);
</script>


<script src="<?php echo $theme_url;?>vendors/jquery-tags-input/jquery.tagsinput.min.js"></script>
<script type="text/javascript">
    $('#tags').tagsInput({
        'width': '100%',
        'height': '75%',
        'interactive': true,
        'defaultText': 'Add Tags',
        'removeWithBackspace': true,
        'minChars': 0,
        'maxChars': 20, // if not provided there is no limit
        'placeholderColor': '#666666'
    });
</script>

<script type="text/javascript">
    (function ($) {
        'use strict';
        $(function () {
            $('.file-upload-browse').on('click', function () {
                var file = $(this).parent().parent().parent().find('.file-upload-default');
                file.trigger('click');
            });
            $('.file-upload-default').on('change', function () {
                $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
            });
        });
    })(jQuery);
</script>
<?php require_once $theme_path.'include/footer.php';?>