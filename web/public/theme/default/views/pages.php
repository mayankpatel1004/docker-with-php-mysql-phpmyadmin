<?php
require $theme_path.'include/headerfront.php';
global $page_data;
?>
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5e131574fd633a0012559c1f&product=inline-share-buttons' async='async'></script>
<div class="main-panel">
        <div class="content-wrapper">
                <div class="card">
                        <div class="card-body">        
                        
                <?php
                if(isset($page_data['item_description']) && $page_data['item_description'] != ''){
                        echo "<h1 class='text-center'>".$page_data['item_title']."</h1><br />";
                }
                if($page_data['item_type'] == 'blogs'){
                        ?>
                        <p class="page-description mt-1 text-primary">Published By : Administrator on <?php echo date('D, F d, Y',strtotime($page_data['created_at'])) ?></p><br />
                        <div class="sharethis-inline-share-buttons"></div>
                        <?php        
                }
                ?>
                
                <br />
                <?php
                if(isset($page_data['item_description']) && $page_data['item_description'] != ''){
                        echo $page_data['item_description'];
                }else {
                        echo "Content coming soon...........";
                }
                if($page_data['item_type'] != 'blogs'){
                ?>
                <br /><div class="sharethis-inline-share-buttons"></div>
                <?php }?>
                </div>
                
                </div>
        </div>
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
                h1,h2,h3 {
                        color: #25378B;
                }
                </style>
<script type="text/javascript">
$(document).ready(function(){
        $.ajax({
                dataType: 'json',
                method : "post",
                contentType: false,
                cache: false,
                processData:false, 
                url: '<?php echo $url;?>pagescontroller/getdata/?alias=',
                success: function (data) {
                        console.log(data);
                }
        });
});

</script>
<?php require_once $theme_path.'include/prefooterfront.php';?>
    <?php require_once $theme_path.'include/scriptsfront.php';?>
    </div>
<?php require_once $theme_path.'include/footerfront.php';?>