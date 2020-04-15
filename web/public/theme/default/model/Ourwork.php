<?php
class Ourwork {
    public function getList() {
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path;
        $item_type = "";
        $string = "";
        if(isset($_REQUEST['itemtype']) && $_REQUEST['itemtype'] != '') {
            $item_type = $_REQUEST['itemtype'];
        }

        $sqlCategories = "SELECT `section_title`,`section_alias`  FROM `item_section` WHERE `item_type` = 'portfolio_category' AND `display_status` = 'Y' AND `deleted_status` = 'N' ORDER BY `display_order` DESC";
        $arrCategoryData = $cf->getData($sqlCategories);

        $sql = "SELECT * FROM `items` WHERE `item_type` = '$item_type' AND admin_module = 'N' ORDER BY `item_id` DESC";
        //echo $sql;exit;
        $arrData = $cf->getData($sql);
        //if(isset($arrData) && !empty($arrData)) {
              if(isset($arrCategoryData) && count($arrCategoryData) > 0) {
                  $counter_category = 0;
                  $string .='<ul class="nav nav-pills nav-pills-custom" id="pills-tab-custom" role="tablist">';
                  foreach($arrCategoryData as $data){
                      $counter_category++;
                      $active_class = "";
                      if($counter_category == 1){
                          $active_class = "active";
                      }
                    $string .='<li class="nav-item"><a class="nav-link '.$active_class.'" id="pills-home-tab-custom'.$data['section_alias'].'" data-toggle="pill" href="#pills-health'.$data['section_alias'].'" role="tab" aria-controls="pills-home" aria-selected="true">'.$data['section_title'].'</a></li>';
                  }
                  $string .= '</ul>';
              }
              $string .='<div class="tab-content tab-content-custom-pill" id="pills-tabContent-custom">';
              if(isset($arrCategoryData) && count($arrCategoryData) > 0) {
                $counter_category = 0;
                foreach($arrCategoryData as $data){
                    $filter_data = $data['section_alias'];
                    $sqlInside = "SELECT * FROM `items` WHERE FIND_IN_SET ('$filter_data', item_category) AND display_status = 'Y' AND deleted_status = 'N'";
                    $arrInsideData = $cf->getData($sqlInside);
                        
                        if(isset($arrInsideData) && count($arrInsideData) > 0) {
                        $counter_category++;
                        $active_class = "";
                        if($counter_category == 1){
                            $active_class = "active";
                        }
                        $string .='<div class="tab-pane fade show '.$active_class.'" id="pills-health'.$data['section_alias'].'" role="tabpanel" aria-labelledby="pills-home-tab-custom'.$data['section_alias'].'"><div class="row">';
                        foreach($arrInsideData as $data) {
                            $image = ITEMS_URL.$data['file1'];
                            $string .= '<div class="mb-4 col-md-4"><a href='.$data['external_url'].' target="_blank"><img class="card-img-top" src="'.$image.'" alt="'.$data['item_title'].'" /></a></div>';
                        }
                        $string .= '</div></div>';
                    }
                }
            }
            $string .= '</div><style>.nav-pills.nav-pills-custom .nav-link{padding:5px 10px !important;}.nav-pills.nav-pills-custom .nav-link.active {background: #25378B;color: #ffffff;}</style>';
            //   $string .='
            //   <div class="tab-content tab-content-custom-pill" id="pills-tabContent-custom">
            //     <div class="tab-pane fade show active" id="pills-health" role="tabpanel" aria-labelledby="pills-home-tab-custom">
            //       <div class="d-flex mb-4">
            //         <img src="https://via.placeholder.com/115x115" class="w-25 h-100 rounded" alt="sample image">
            //         <img src="https://via.placeholder.com/115x115" class="w-25 h-100 ml-4 rounded" alt="sample image">
            //         <img src="https://via.placeholder.com/115x115" class="w-25 h-100 ml-4 rounded" alt="sample image">
            //       </div>
            //     </div>';  
        //}

        if(isset($_REQUEST['device']) && $_REQUEST['device'] == 'Nonweb'){
            require_once($theme_path.'getRequestData.php');
            $arrData = array('data' => $arrData,'total_pages' => '10');
        }else {
            $arrData = array('data' => $string);
        }
        echo json_encode($arrData);exit;
    }
}
?>