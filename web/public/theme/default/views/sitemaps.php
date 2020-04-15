<?php require $theme_path.'include/headerfront.php';global $page_data;?>
<div class="main-panel">
        <div class="content-wrapper">
                <div class="card">
                        <div class="card-body">
                                <h1 class="text-center text-primary">Sitemap</h1>                 
                                <br />
                                <?php
                                if(isset($arrData) && !empty($arrData)) {
                                        foreach($arrData as $item_type => $data) {
                                        ?>
                                                <br /><h4 class="card-title text-primary"><?php echo $item_type;?></h4>
                                                <?php
                                                $total_item_type = count($data);
                                                for($i = 0; $i < $total_item_type; $i++) {
                                                        ?>
                                                        <div class="d-flex align-items-center pb-3 border-bottom">
                                                                <div class="ml-3">
                                                                        <a href="<?php echo $url.$arrData[$item_type][$i]['alias'];?>"><?php echo $arrData[$item_type][$i]['title'];?></a>
                                                                </div>
                                                        </div>
                                                        <?php
                                                }
                                                ?>
                                        
                                        <?php
                                        }
                                } else {
                                        echo "<div class='text-center'>Content available soon</div>";
                                }
                                ?>
                        </div>
                </div>  
        </div>
</div>


<?php require_once $theme_path.'include/scriptsfront.php';?>
<?php require_once $theme_path.'include/prefooterfront.php';?>
<?php require_once $theme_path.'include/footerfront.php';?>