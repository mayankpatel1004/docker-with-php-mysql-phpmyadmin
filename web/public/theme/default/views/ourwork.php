<?php
require $theme_path.'include/headerfront.php';
global $page_data;
?>

<div class="main-panel">
        <div class="content-wrapper">
                <div class="card">
                        <div class="card-body">
                        <?php
                                if(isset($page_data['item_title']) && $page_data['item_title'] != ''){
                                        ?>
                                        <h1 class="text-center"><?php echo $page_data['item_title'];?></h1>
                                        <?php
                                }
                        ?>       
                        <br />
                        
                        <div class="card-columns1" id="ourwork_response"></div>
                        </div>
                        
                        <div class="ml-10 text-center text-danger">Note : Few of our projects are based on third party as well NDA from client. We can't place here.</div>
                        
                        </div>
                        
                        
                </div>
                
        </div>
<style type="text/css">
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
<?php require_once $theme_path.'include/scriptsfront.php';?>

<?php require_once $theme_path.'include/prefooterfront.php';?>
<?php require_once $theme_path.'include/footerfront.php';?>