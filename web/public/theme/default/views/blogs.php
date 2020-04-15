<?php
require $theme_path.'include/headerfront.php';
global $page_data;
?>
<div class="main-panel">
        <div class="content-wrapper">
                <div class="card">
                        <div class="card-body">        
                                <?php
                                if(isset($page_data['item_description']) && $page_data['item_description'] != ''){
                                        echo "<h1 class='text-center'>".$page_data['item_title']."</h1><br />";
                                }
                                ?>
                                <div class="row">
                                        <div class="col-md-8 col-sm-12">
                                        <input type="hidden" id="sort_type" value="asc" />
                                        <input type="hidden" id="sort_by" value="item_id" />
                                        <input type="hidden" id="records_per_page" value="10" />
                                        <input type="hidden" id="page_no" value="1" />
                                        <input type="hidden" id="site_url" value="<?php echo $url;?>" />
                                        <input type="hidden" id="page_controller" value="pages" />
                                        
                                        <div id="blog_list"></div>
                                        <div class="dot-opacity-loader"><span></span><span></span><span></span></div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                                <input class="form-control" placeholder="Search your keyword..." type="text" name="search_text" id="search_text" value=""  />
                                                <br />
                                                <select name="category" id="category" class="form-control">
                                                        <option value="">Select Category</option>
                                                </select>
                                        </div>
                                
                                
                                </div>
                        </div>
                </div>
        </div>

<?php require_once $theme_path.'include/prefooterfront.php';?>
    <?php require_once $theme_path.'include/scriptsfront.php';?>
    <script type="text/javascript">
        $(document).ready(function(){
                var category_id = '';
                $("#search_text").keyup(function(){
                        var search_text = $("#search_text").val().length;
                        if(search_text > 3){
                                getBlog();
                        }
                });
                $("#category").change(function(){
                        getBlog();
                });
                
                function getBlog() {
                        $(".dot-opacity-loader").show();
                        $.ajax({
                        dataType: 'json',
                        method : "post",
                        contentType: false,
                        cache: false,
                        processData:false, 
                        url: '<?php echo $url;?>blogs/getData/?page_no='+$("#pagination").val()+'&search_text='+$("#search_text").val()+"&category="+$("#category").val(),
                        success: function (response) {
                                //console.log(response.data);
                                $(".dot-opacity-loader").hide();
                                $("#blog_list").html(response.data);
                                $("#category").html(response.categories);
                                var x = document.getElementById("pagination");
                                var total_pages = response.total_pages;
                                for(i=1;i<=total_pages;i++){
                                        var option = document.createElement("option");
                                        option.value = i;
                                        option.text = "Page "+i;
                                        if(i == response.page_no){
                                                option.selected = i;
                                        }
                                        x.add(option);
                                }
                                $("#pagination").change(function(){
                                        getBlog();
                                });
                        }
                        });
                }
                setTimeout(function(){ getBlog(); }, 100);     
        });
        </script>
    </div>
<?php require_once $theme_path.'include/footerfront.php';?>