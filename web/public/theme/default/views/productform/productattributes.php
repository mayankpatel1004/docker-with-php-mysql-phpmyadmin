<div class="card">
    <div class="card-header" role="tab" id="heading-121">
        <h6 class="mb-0">
            <a class="collapsed" data-toggle="collapse" href="#collapse-121" aria-expanded="false" aria-controls="collapse-121">Product Specifications</a>
        </h6>
    </div>
    <div id="collapse-121" class="collapse" role="tabpanel" aria-labelledby="heading-12"
        data-parent="#accordion-4">
        <div class="card-body">
            <div class="row_point_a3 list-group">
            <?php if(isset($arrProductSpecifications) && $arrProductSpecifications != false):?>
                <?php foreach($arrProductSpecifications as $specifications):?>
                    <?php if($specifications['specification_type'] == 'default'):?>
                    <div class="row">
                        <div class="col-md-3"><br />
                            <label class="position-relative pt-3 text-center">Enter Specifications</label>
                        </div>
                        <div class="col-md-3"><br />
                            <input type="text" name="specification_title[]" value="<?php echo $specifications['specification_title'];?>" class="form-control" placeholder="Specification Title" />
                        </div>
                        <div class="col-md-4"><br />
                            <input type="text" name="specification_value[]" value="<?php echo $specifications['specification_value'];?>" class="form-control" placeholder="Specification Value" />
                        </div>
                        <div class="col-md-1"><br />
                            <a href="javascript:void(0);" class="remCF"><i class="mdi mdi-delete position-relative pt-3"></i></a>
                        </div>
                    </div>
                    <?php endif;?>
                <?php endforeach;?>
            <?php endif;?>
            </div>
            <br />
            <input type="button" value="Add Specification" class="btn ml-2 btn-primary add_row_point_a3 mb-2" />
        </div>
    </div>
</div>
