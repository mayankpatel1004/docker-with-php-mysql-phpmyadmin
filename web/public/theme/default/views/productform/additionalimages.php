<div class="card">
    <div class="card-header" role="tab" id="heading-12">
        <h6 class="mb-0">
            <a class="collapsed" data-toggle="collapse" href="#collapse-12"
                aria-expanded="false" aria-controls="collapse-12">
                Additional Images
            </a>
        </h6>
    </div>
    <div id="collapse-12" class="collapse" role="tabpanel" aria-labelledby="heading-12"
        data-parent="#accordion-4">
        <div class="card-body">
            <h5 class="text-primary">Your additional product images</h5><br />
            <div class="row">
                <div class="col-md-3"><input type="file" name="image[]" /></div>
                <div class="col-md-3"><input type="file" name="image[]" /></div>
                <div class="col-md-3"><input type="file" name="image[]" /></div>
                <div class="col-md-3"><input type="file" name="image[]" /></div>
            </div>
            <br />
            <?php 
            if(isset($arrProductSpecifications) && $arrProductSpecifications != false):?>
                <div class="row">
                <?php foreach($arrProductSpecifications as $specifications):?>
                    <?php if($specifications['specification_type'] == 'additional'):?>
                        <div class="col-md-3">
                            <a href="<?php echo PRODUCTS_URL.$specifications['specification_value'];?>" target="_blank"><img style="width:100%;" alt="Image Specifications" src="<?php echo PRODUCTS_URL.$specifications['specification_value'];?>" /></a>
                            <br /><br />
                        </div>
                    <?php endif;?>
                <?php endforeach;?>
                </div>
            <?php endif;?>
        </div>
    </div>
</div>