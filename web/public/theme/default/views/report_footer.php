
<?php require_once $theme_path.'include/prefooter.php';?>
<?php require $theme_path.'include/scripts.php';?>
</div>
<link rel="stylesheet" href="<?php echo $theme_url;?>vendors/bootstrap-datepicker/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="<?php echo $theme_url;?>vendors/summernote/dist/summernote.css" />        
    <script src="<?php echo $theme_url;?>vendors/select2/select2.min.js"></script>
    <script src="<?php echo $theme_url;?>vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo $theme_url;?>vendors/summernote/dist/summernote.min.js"></script>
    <style>
                .list-group-item.active {
                        z-index: 2;
                        color: #fff !important;
                        background-color: #25378B;
                        border-color: #25378B;
                }
                h4 {
                        color : #FFF;
                }
                h1,h2,h3,b {
                        color: #25378B;
                }
                </style>
    <script type="text/javascript">
        
        (function($) {
        'use strict';
        if ($(".js-example-basic-single").length) {
            $(".js-example-basic-single").select2();
        }
        if ($(".js-example-basic-multiple").length) {
            $(".js-example-basic-multiple").select2();
        }
        })(jQuery);
    </script>
    <script type="text/javascript">
    (function($) {
    'use strict';
    $(function() {
        $('.file-upload-browse').on('click', function() {
        var file = $(this).parent().parent().parent().find('.file-upload-default');
        file.trigger('click');
        });
        $('.file-upload-default').on('change', function() {
        $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
        });
    });
    })(jQuery);
    </script>
    <?php if($page_data['custom_view'] == 'gallery'):?>
    <link rel="stylesheet" href="<?php echo $theme_url;?>vendors/lightgallery/css/lightgallery.css" />
    <script src="<?php echo $theme_url;?>vendors/lightgallery/js/lightgallery-all.min.js"></script>
    <script src="<?php echo $theme_url;?>js/light-gallery.js"></script>
    <?php endif;?>

    <script src="<?php echo $theme_url;?>vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="<?php echo $theme_url;?>vendors/bootstrap-datepicker/bootstrap-datepicker.min.css" />
<script type="text/javascript">
    $(document).ready(function() {
        $('#btnRight').click(function(e) {
            var selectedOpts = $('#lstBox1 option:selected');
            if (selectedOpts.length == 0) {
                alert("Please select atleast one option to move.");
                e.preventDefault();
            }
            $('#lstBox2').append($(selectedOpts).clone());
            $(selectedOpts).remove();
            e.preventDefault();
        });
        $('#btnLeft').click(function(e) {
            var selectedOpts = $('#lstBox2 option:selected');
            if (selectedOpts.length == 0) {
                alert("Please select atleast one option to move.");
                e.preventDefault();
            }
            $('#lstBox1').append($(selectedOpts).clone());
            $(selectedOpts).remove();
            e.preventDefault();
        });
    });
    </script>
    <script type="text/javascript">
    $(document).ready(function(){
        $(".left_right_click").click(function(){
            let string = '';
            $("#lstBox2 option").each(function(){
                string = string+$(this).val()+',';
            });
            $("#exportfields").val(string);
        });
    });
</script>