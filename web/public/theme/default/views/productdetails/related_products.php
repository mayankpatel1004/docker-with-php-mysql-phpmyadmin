<?php if(DISPLAY_RELATED_PRODUCTS == 'Y'):?>
    <?php if(isset($arrProductData['arrAllRelatedProducts']) && $arrProductData['arrAllRelatedProducts'] != false):?>
        <div class="col-lg-12">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">Related Products</h4>
                <div class="owl-carousel owl-theme rtl-carousel">
                <?php foreach($arrProductData['arrAllRelatedProducts'] as $data):?>
                <div class="item text-center">
                    <?php
                    $file_url = $cf->displayFile(PRODUCTS_PATH.$data['file1'], PRODUCTS_URL.$data['file1'], 'thumb', 400,400);
                    $edit_url = $url."products/".$data['item_alias']
                    ?>
                    <a href="<?php echo $edit_url;?>"><img src="<?php echo $file_url;?>" alt="image"/></a>
                    <br />
                    <a href="<?php echo $edit_url;?>"><?php echo $data['item_title'];?></a>
                </div>
                <?php endforeach;?>
                </div>
            </div>
            </div>
        </div>
    <?php endif;?>
<?php endif;?>