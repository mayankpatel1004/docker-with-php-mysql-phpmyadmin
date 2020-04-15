<div class="main-panel">
<div class="content-wrapper">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pageform</h4>
                <form class="form-sample">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                            <label class="col-sm-12 col-form-label">Title</label>
                            <input type="text" class="form-control" id="billingfirstname" placeholder="Title" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label class="col-sm-12 col-form-label">Title2</label>
                            <input type="text" class="form-control" id="billingfirstname2" placeholder="Title2" />
                            </div>
                        </div>
                        <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label">Publisher</label>
                                    <div class="col-sm-12">
                                        <select class="js-example-basic-single w-100">
                                            <option value="1">Developer</option>
                                            <option value="2">Administrator</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label">Category</label>
                                    <div class="col-sm-12">
                                            <select class="js-example-basic-multiple w-100" multiple="multiple">
                                            <option value="1">Main Category</option>
                                            <option value="2">Sub Category</option>
                                        </select>
                                    </div>
                                </div>
                            </div>    
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label">Media</label>
                                    <div class="col-sm-12">
                                            <input type="file" name="fileupload1[]" class="file-upload-default">
                                            <div class="input-group col-xs-12">
                                                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                                <span class="input-group-append">
                                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                                </span>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label">Publish Date</label>
                                    <div class="col-sm-12">
                                        <div id="datepicker-popup" class="input-group date datepicker">
                                            <input type="text" class="form-control" />
                                            <span class="input-group-addon input-group-append border-left">
                                                <span class="mdi mdi-calendar input-group-text"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label">Tags</label>
                                    <div class="col-sm-12">
                                    <input name="tags" id="tags" value="" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label">Autocomplete</label>
                                    <div class="col-sm-12">
                                    <input class="typeahead form-control" type="text">
                                    </div>
                                </div>
                            </div>

                            


                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label">Description</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="summernoteExample" />
                                    </div>
                                </div>
                            </div>
                    </div>
                    <input class="btn btn-primary" type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>
</div>
    <?php require_once $theme_path.'include/footer.php';?>
    <?php require $theme_path.'include/scripts.php';?>
    
    <link rel="stylesheet" href="<?php echo $url;?>vendors/bootstrap-datepicker/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="<?php echo $url;?>vendors/summernote/dist/summernote.css" />        
    <script src="<?php echo $url;?>vendors/select2/select2.min.js"></script>
    <script src="<?php echo $url;?>vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo $url;?>vendors/summernote/dist/summernote.min.js"></script>
    <script type="text/javascript">
        $('#datepicker-popup').datepicker();
        $('#summernoteExample').summernote({
            height:300,tabsize:2
        });
        (function($) {
        'use strict';
        if ($("#fileuploader").length) {
            $("#fileuploader").uploadFile({
            url: "<?php echo $url;?>",
            fileName: "myfile"
            });
        }
        })(jQuery);
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
    

    <script src="<?php echo $url;?>vendors/jquery-tags-input/jquery.tagsinput.min.js"></script>
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

    <script src="<?php echo $url;?>js/bootstrap3-typeahead.min.js"></script>
    <script type="text/javascript">
    $('input.typeahead').typeahead({
        source:  function (query, process) {
        return $.get('http://localhost/designwork/paid-theme/front-theme/pages/ajaxpro.php', { query: query }, function (data) {
                console.log(data);
                data = $.parseJSON(data);
                return process(data);
            });
        }
    });
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
</div>