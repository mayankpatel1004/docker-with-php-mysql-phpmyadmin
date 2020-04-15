<div class="row">
    <?php global $cf;if(isset($arrProductData['arrProductAdditionalImages']) && !empty($arrProductData['arrProductAdditionalImages'])):?>
    <div class="col-lg-12 grid-margin1 stretch-card">
        <div class="owl-carousel owl-theme full-width">
            <?php foreach($arrProductData['arrProductAdditionalImages'] as $banner):?>
            <div class="item">
                <div class="card text-white">
                    <?php $displaybanner = $cf->displayFile(PRODUCTS_PATH . $banner['specification_value'], PRODUCTS_URL . $banner['specification_value'], $thumb = '', 500,500);?>
                    <img class="card-img" src="<?php echo $displaybanner;?>" alt="<?php echo $banner['specification_value'];?>" />
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
    <?php endif;?>
</div>
