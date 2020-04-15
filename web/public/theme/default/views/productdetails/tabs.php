<div class="col-md-12 col-xl-12 grid-margin stretch-card">
              <div class="card1">
                <div class="card-body">
                  <ul class="nav nav-pills nav-pills-success" id="pills-tab" role="tablist">
                    <?php if(DISPLAY_DESCRIPTION == 'Y'):?>
                    <li class="nav-item">
                      <a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-selected="true">Description</a>
                    </li>
                    <?php endif;?>

                    <?php if(DISPLAY_SPECIFICATIONS == 'Y'):?>  
                    <li class="nav-item">
                      <a class="nav-link" id="pills-specifications-tab" data-toggle="pill" href="#pills-specifications" role="tab" aria-controls="pills-specifications" aria-selected="false">Specifications</a>
                    </li>
                    <?php endif;?>

                    <?php if(DISPLAY_REVIEWS == 'Y'):?>
                    <li class="nav-item">
                      <a class="nav-link" id="pills-reviews-tab" data-toggle="pill" href="#pills-reviews" role="tab" aria-controls="pills-reviews" aria-selected="false">Reviews</a>
                    </li>
                    <?php endif;?>

                      <?php if(DISPLAY_WRITE_REVIEWS == 'Y'):?>
                    <li class="nav-item">
                      <a class="nav-link" id="pills-write-reviews-tab" data-toggle="pill" href="#pills-write-reviews" role="tab" aria-controls="pills-write-reviews" aria-selected="false">Write Review</a>
                    </li>
                      <?php endif;?>
                  </ul>
                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
                      <div class="media">
                        <div class="media-body">
                          <p><?php if(isset($arrProductData['arrProductDetails']['item_description']) && $arrProductData['arrProductDetails']['item_description'] != ""){
                                echo $arrProductData['arrProductDetails']['item_description'];
                            } else {
                                echo "Content Coming Soon...";
                            }?></p>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="pills-specifications" role="tabpanel" aria-labelledby="pills-specifications-tab">
                    <?php
                    //echo "<pre>";print_r($arrProductData['arrProductDetails']['item_alias']);
                    if(isset($arrProductData['arrProductSpecifications']) && $arrProductData['arrProductSpecifications'] != false): ?>
                        <ul class="list-star">
                            <?php foreach($arrProductData['arrProductSpecifications'] as $specifications):?>
                            <li><b><?php echo $specifications['specification_title'];?></b> : <?php echo $specifications['specification_value'];?></li>
                            <?php endforeach;?>
                        </ul>
                        <?php else :?>
                        <p>No specifications placed</p>
                    <?php endif;?>
                    </div>
                    <div class="tab-pane fade" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab">
                      <?php //print_r($arrProductData['arrProductReviews']);?>
                      <div class="col-md-12 grid-margin stretch-card">
                            <?php if(isset($arrProductData['arrProductReviews']) && $arrProductData['arrProductReviews'] != false):?>
                            <ul class="bullet-line-list">
                                <?php foreach($arrProductData['arrProductReviews'] as $reviews):?>
                                  <li>
                                    <h6><?php echo $reviews['customer_name'];?></h6>
                                    <p><?php echo $reviews['review_text'];?></p>
                                    <p class="text-muted mb-4">
                                      <i class="mdi mdi-clock-outline"></i>
                                      <?php echo date(DATE_FORMAT,strtotime($reviews['created_at']));?>
                                    </p>
                                  </li>
                                <?php endforeach;?>
                            </ul>
                            <?php else :?>
                            <p>No one reviewed till now.</p>
                            <?php endif;?>
                          </div>
                    </div>
                    <div class="tab-pane fade" id="pills-write-reviews" role="tabpanel" aria-labelledby="pills-write-reviews-tab">
                      <div class="col-md-12 grid-margin stretch-card">
                      <form class="w-100">
                          <div class="form-group">
                            <input type="text" autocomplete="off" class="form-control form-control-lg" id="customer_name" name="customer_name" placeholder="Username" />
                            <div class="error" id="customer_name_error"></div>
                          </div>
                          <div class="form-group">
                            <input type="email" autocomplete="off" class="form-control form-control-lg" id="customer_email" name="customer_email" placeholder="Email" />
                            <div class="error" id="customer_email_error"></div>
                          </div>

                          <div class="form-group">
                            <input type="text" autocomplete="off" class="form-control form-control-lg" id="customer_phone" name="customer_phone" placeholder="Contact">
                            <div class="error" id="customer_phone_error"></div>
                          </div>

                          <div class="form-group">
                            <select class="form-control form-control-lg" id="ratings" name="ratings">
                            <option value="5.0">5.0 Star</option>
                            <option value="4.5">4.5 Star</option>  
                            <option value="4.0">4.0 Star</option>  
                            <option value="3.5">3.5 Star</option>  
                            <option value="3.0">3.0 Star</option>  
                            <option value="2.5">2.5 Star</option>  
                            <option value="2.0">2.0 Star</option>  
                            <option value="1.5">1.5 Star</option>  
                            <option value="1.0">1.0 Star</option>
                            </select>
                            <div class="error" id="ratings_error"></div>
                          </div>

                          <div class="form-group">
                              <textarea autocomplete="off" class="form-control form-control-lg" id="review_text" name="review_text" placeholder="Write a review"></textarea>
                              <div class="error" id="review_text_error"></div>
                          </div>
                          
                          <div class="mt-3">
                            <input class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="button" name="submit" value="Submit" onClick="return fnSubmitForm()" />
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <script type="text/javascript">
            function fnSubmitForm() {
              $(".error").html('');
              if($("#customer_name").val() == '') {
                $("#customer_name_error").html('Please enter your name');
                $("#customer_name_error").css('color','red');
                return false;
              }
              else if($("#customer_email").val() == '') {
                $("#customer_email_error").html('Please enter your email');
                $("#customer_email_error").css('color','red');
                return false;
              }
              else if($("#review_text").val() == '') {
                $("#review_text_error").html('Please enter your review');
                $("#review_text_error").css('color','red');
                return false;
              } else {
                let url = "<?php echo $url.'products/reviewform';?>";
                $.ajax({
                    type: 'POST',
                    url: url,
                    data:'customer_name='+$("#customer_name").val()+'&customer_email='+$("#customer_email").val()+'&review_text='+$("#review_text").val()+'&customer_phone='+$('#customer_phone').val()+"&ratings="+$("#ratings").val()+"&review_text="+$("#review_text").val()+"&item_alias=<?php echo $arrProductData['arrProductDetails']['item_alias'];?>&item_id=<?php echo $arrProductData['arrProductDetails']['item_id'];?>",
                    beforeSend: function () {
                        $('.loading-overlay').show();
                    },
                    success: function (response) {
                        $(".dot-opacity-loader").hide();
                        data = JSON.parse(response);
                        alert(data.message);
                        location.reload();
                        //$("#data_response").html(data.data);
                    }
                });
              }
            }
            </script>