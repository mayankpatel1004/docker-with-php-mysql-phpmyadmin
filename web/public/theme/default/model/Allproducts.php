<?php
class Allproducts {
    public function getList() {
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path;
        $page_no = 1;
        $start = 0;
        $item_alias = "allproducts";
        $item_type = "products";
        $search_text = "";
        $sort_by = "item_id";
        $sort_type = "DESC";
        $page_url = "";
        $records_per_page = $back_end_rpp;
        $search_string = "";
        $columns_list = "item_title,item_id,item_alias,status,action,created_at,activity_id";
        $token = "";
        $success = 1;
        $error = 0;
        $status = 200;
        $message = "";

        if(isset($_REQUEST['item_alias']) && $_REQUEST['item_alias'] != ''){
            $item_alias = $_REQUEST['item_alias'];
        }

        if(isset($_REQUEST['item_type']) && $_REQUEST['item_type'] != ''){
            $item_type = $_REQUEST['item_type'];
        }
        
        if(isset($_REQUEST['records_per_page']) && $_REQUEST['records_per_page'] > 0){
            $records_per_page = $_REQUEST['records_per_page'];
            $_SESSION[$back_session_name][$item_alias]['records_per_page'] = $records_per_page;
        }

        if(isset($_REQUEST['page_no']) && $_REQUEST['page_no'] > 0){
            $page_no = $_REQUEST['page_no'];
            $_SESSION[$back_session_name][$item_alias]['page_no'] = $page_no;
        }

        $start = ($page_no - 1) * $records_per_page;
        
        if(isset($_REQUEST['search_text']) && $_REQUEST['search_text'] != ''){
            $search_text = $_REQUEST['search_text'];
            $search_string = " AND (`item_title` LIKE '%" . addslashes($search_text) . "%' OR `item_description` LIKE '%" . addslashes($search_text) . "%') ";
            $_SESSION[$back_session_name][$item_alias]['search_text'] = $search_text;
        }
        if(isset($_REQUEST['sort_type']) && $_REQUEST['sort_type'] != ''){
            $sort_type = $_REQUEST['sort_type'];
        }

        if(isset($_REQUEST['sort_by']) && $_REQUEST['sort_by'] != ''){
            $sort_by = $_REQUEST['sort_by'];
            $newstring = substr($_REQUEST['sort_by'], -4);
            $sort_by = str_replace("__desc","",$_REQUEST['sort_by']);
            if($newstring == '_asc'){
                $sort_by = str_replace("__asc","",$_REQUEST['sort_by']);
            }
        }

        if(isset($_REQUEST['url']) && $_REQUEST['url'] != ''){
            $page_url = $_REQUEST['url'].'/';
        }

        if($sort_by != '' && $sort_type != ''){
            $_SESSION[$back_session_name][$item_alias]['sort_by'] = $sort_by."__".$sort_type;
        }

        $sql = "SELECT * FROM `ec_products` WHERE item_type_alias = '$item_type' $search_string ORDER BY $sort_by $sort_type LIMIT $start,$records_per_page";
        //echo $sql;exit;
        $arrData = $cf->getData($sql);

        $sqlCount = "SELECT * FROM `ec_products` WHERE item_type_alias = '$item_type' $search_string ";
        $arrDataCount = $cf->getData($sqlCount);
        $totalData = count($arrDataCount);
        
        $string = "";
        if(isset($arrData) && !empty($arrData)){
            foreach($arrData as $data) {
                $edit_url = $url."allproducts/form/?id=".$data['item_id'];
                $stock_status = $data['in_stock'] == 'Y' ? 'Yes' : 'No';
                $display_status = $data['display_status'] == 'Y' ? 'Yes' : 'No';
                $string .= '<tr>
                <td>'.$data['item_id'].'</td>
                <td><a href="'.$edit_url.'">'.$data['item_title'].'</a></td>
                <td>'.$data['item_alias'].'</td>
                <td>'.$data['item_weight'].'</td>
                <td>'.$stock_status.'</td>
                <td>'.$display_status.'</td>
                <td>'.date(DATE_FORMAT,strtotime($data['created_at'])).'</td>
                <td>'.$data['item_id'].'</td>
              </tr>';
            }
        }else {
            $string .= '<tr><td colspan="10" class="text-center">Sorry, No record available</td></tr>';
        }

        $pagination = $cf->getPagination($records_per_page,$page_no,$page_url,$totalData,$item_type);
        $string .= '<tr><td colspan="10" class="text-right">'.$pagination.'</td></tr>';
        
        if(isset($_REQUEST['device']) && $_REQUEST['device'] == 'Nonweb'){
            $total_pages = 1;
            if(isset($totalData) && $totalData > 0) {
                if($totalData > $records_per_page) {
                    $total_pages = ceil($totalData / $records_per_page);
                    $message = "Data Successfully Retrieved !!!";
                }
            }
            require_once($theme_path.'getRequestData.php');
            $arrData = array(
                'token' => $token,
                'success' => $success,
                'error' => $error,
                'status' => $status,
                'message' => $message,
                'total_pages' => $total_pages,
                'values' => $arrData
            );
        } else {
            $arrData = array('data' => $string);
        }
        
        echo json_encode($arrData);exit;
    }

    public function getOnedata($id) {
        global $cf,$page_data,$url;
        if($id > 0){
            $sql = "SELECT * FROM `ec_products` WHERE item_id = '$id'";
            return $cf->getOneData($sql);
        }
    }

    public function getProductDefaultPriceData($id) {
        global $cf,$page_data,$url;
        $arrData = array();
        if($id > 0){
            $sql = "SELECT * FROM `ec_product_price` WHERE item_id = '$id' AND is_default_price = 'Y' ORDER BY is_default_price DESC";
            $arrData = $cf->getOneData($sql);
        }
        return $arrData;
    }

    public function getProductAttributesPriceData($id) {
        global $cf,$page_data,$url;
        $arrData = array();
        if($id > 0){
            $sql = "SELECT * FROM `ec_product_price` WHERE item_id = '$id' AND is_default_price = 'N' ORDER BY is_default_price DESC";
            $arrData = $cf->getData($sql);
        }
        return $arrData;
    }

    public function getProductAdditionalImages($id) {
        global $cf,$page_data,$url;
        $arrData = array();
        if($id > 0){
            $sql = "SELECT * FROM `ec_product_specifications` WHERE item_id = '$id' AND specification_type = 'image' ORDER BY product_specification_id ASC";
            $arrData = $cf->getData($sql);
        }
        return $arrData;
    }

    public function getProductSpecifications($id) {
        global $cf,$page_data,$url;
        $arrData = array();
        if($id > 0){
            $sql = "SELECT * FROM `ec_product_specifications` WHERE item_id = '$id' ORDER BY product_specification_id ASC";
            $arrData = $cf->getData($sql);
        }
        return $arrData;
    }

    public function getAllmodules() {

    }

    public function getListFront() {
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path,$currancy;
        $page_no = 1;
        $start = 0;
        $item_alias = "allproducts";
        $item_type = "products";
        $search_text = "";
        $sort_by = "item_id";
        $sort_type = "DESC";
        $page_url = "";
        $records_per_page = $back_end_rpp;
        $search_string = "";
        $columns_list = "item_title,item_id,item_alias,status,action,created_at,activity_id";
        $token = "";
        $success = 1;
        $error = 0;
        $status = 200;
        $message = "";

        if(isset($_REQUEST['item_alias']) && $_REQUEST['item_alias'] != ''){
            $item_alias = $_REQUEST['item_alias'];
        }

        if(isset($_REQUEST['item_type']) && $_REQUEST['item_type'] != ''){
            $item_type = $_REQUEST['item_type'];
        }
        
        if(isset($_REQUEST['records_per_page']) && $_REQUEST['records_per_page'] > 0){
            $records_per_page = $_REQUEST['records_per_page'];
            $_SESSION[$back_session_name][$item_alias]['records_per_page'] = $records_per_page;
        }

        if(isset($_REQUEST['page_no']) && $_REQUEST['page_no'] > 0){
            $page_no = $_REQUEST['page_no'];
            $_SESSION[$back_session_name][$item_alias]['page_no'] = $page_no;
        }

        $start = ($page_no - 1) * $records_per_page;
        
        if(isset($_REQUEST['search_text']) && $_REQUEST['search_text'] != ''){
            $search_text = $_REQUEST['search_text'];
            $search_string = " AND (ec.item_title LIKE '%" . addslashes($search_text) . "%' OR ec.item_description LIKE '%" . addslashes($search_text) . "%') ";
            $_SESSION[$back_session_name][$item_alias]['search_text'] = $search_text;
        }
        if(isset($_REQUEST['sort_type']) && $_REQUEST['sort_type'] != ''){
            $sort_type = $_REQUEST['sort_type'];
        }

        if(isset($_REQUEST['sort_by']) && $_REQUEST['sort_by'] != ''){
            $sort_by = $_REQUEST['sort_by'];
            $newstring = substr($_REQUEST['sort_by'], -4);
            $sort_by = str_replace("__desc","",$_REQUEST['sort_by']);
            if($newstring == '_asc'){
                $sort_by = str_replace("__asc","",$_REQUEST['sort_by']);
            }
        }

        if(isset($_REQUEST['url']) && $_REQUEST['url'] != ''){
            $page_url = $_REQUEST['url'].'/';
        }

        if($sort_by != '' && $sort_type != ''){
            $_SESSION[$back_session_name][$item_alias]['sort_by'] = $sort_by."__".$sort_type;
        }

        $sql = "SELECT ec.item_id,ec.item_title,ec.item_alias,ec.file1,ep.product_option_price,ep.product_option_price_display FROM `ec_products` ec LEFT JOIN `ec_product_price` ep ON ec.item_id = ep.item_id WHERE ep.is_default_price = 'Y' AND ec.item_type_alias = '$item_type' $search_string ORDER BY $sort_by $sort_type LIMIT $start,$records_per_page";
        //echo $sql;exit;
        $arrData = $cf->getData($sql);

        $sqlCount = "SELECT ec.item_id,ec.item_title,ec.item_alias,ec.file1,ep.product_option_price,ep.product_option_price_display FROM `ec_products` ec LEFT JOIN `ec_product_price` ep ON ec.item_id = ep.item_id WHERE ep.is_default_price = 'Y' AND ec.item_type_alias = '$item_type' $search_string ORDER BY $sort_by $sort_type";
        $arrDataCount = $cf->getData($sqlCount);
        $totalData = count($arrDataCount);
        
        $string = "";
        $display_price = "";
        if(isset($arrData) && !empty($arrData)){
            $string .= "<div class='row'>";
            foreach($arrData as $data) {
                $edit_url = $url."product/".$data['item_alias'];
                $file_url = $cf->displayFile(PRODUCTS_PATH.$data['file1'], PRODUCTS_URL.$data['file1'], 'thumb', 400,400);
                $display_price_label = "<span>".$currancy.$data['product_option_price']."</span>";
                if($data['product_option_price'] < $data['product_option_price_display']){
                    $display_price_label = "<span><s>".$currancy.$data['product_option_price_display']."</s>&nbsp;&nbsp;</span><span>".$currancy.$data['product_option_price']."</span>";
                }

                if(DISPLAY_PRICE == 'Y') {
                    $display_price = $display_price_label;
                }

                $string .= '<div class="col-md-3 text-center">
                <br /><a href="'.$edit_url.'"><img style="width:100%;" src="'.$file_url.'" alt='.$data['item_title'].' /></a>
                    <a href="'.$edit_url.'">'.$data['item_title'].'</a>
                    <br />'.$display_price.'
                </div>';
            }
            $string .= "</div>";
        }else {
            $string .= '<div class="row"><div class="text-center col-md-12">Sorry, No record available</div></div>';
        }

        $pagination = $cf->getPaginationFront($records_per_page,$page_no,$page_url,$totalData,$item_type);
        $string .= '<div class="row text-right"><div class="col-md-11 position-relative pt-1"><br />Go to Page </div><div class="col-md-1"><br />'.$pagination.'</div></div>';
        
        if(isset($_REQUEST['device']) && $_REQUEST['device'] == 'Nonweb'){
            $total_pages = 1;
            if(isset($totalData) && $totalData > 0) {
                if($totalData > $records_per_page) {
                    $total_pages = ceil($totalData / $records_per_page);
                    $message = "Data Successfully Retrieved !!!";
                }
            }
            require_once($theme_path.'getRequestData.php');
            $arrData = array(
                'token' => $token,
                'success' => $success,
                'error' => $error,
                'status' => $status,
                'message' => $message,
                'total_pages' => $total_pages,
                'values' => $arrData
            );
        } else {
            $arrData = array('data' => $string);
        }
        
        echo json_encode($arrData);exit;
    }

    public function getProductDetails($alias) {
        
        global $cf;
        $item_id = 0;
        $related_products = "";
        $arrRelatedProducts = array();
        $arrAllRelatedProducts = array();

        $sqlProductDetails = "SELECT * FROM `ec_products` WHERE item_alias = '$alias' AND display_status = 'Y' AND deleted_status = 'N'";
        $arrProductDetails = $cf->getOneData($sqlProductDetails);
        if(isset($arrProductDetails['item_id']) && $arrProductDetails['item_id'] > 0) {
            $item_id = $arrProductDetails['item_id'];
            $related_products = $arrProductDetails['related_products'];
        }
        if($related_products != "") {
            $arrRelatedProducts = explode(",",$related_products);
            $in_result = "'" . implode ( "', '", $arrRelatedProducts ) . "'";
            if(isset($arrRelatedProducts) && !empty($arrRelatedProducts)){
                $sqlRelated = "SELECT ec.item_id,ec.item_title,ec.item_alias,ec.item_weight,ec.in_stock,ec.currancy,ec.file1,epp.product_option_price,epp.product_option_price_display FROM `ec_products` ec INNER JOIN `ec_product_price` epp ON ec.item_id = epp.item_id WHERE ec.item_alias IN ($in_result) AND epp.is_default_price = 'Y'";
                $arrAllRelatedProducts = $cf->getData($sqlRelated);
            }
        }
        
        $sqlProductDefaultPrice = "SELECT * FROM `ec_product_price` WHERE item_id = '$item_id' AND is_default_price = 'Y'";
        $arrProductDefaultPrice = $cf->getOneData($sqlProductDefaultPrice);

        $sqlProductPrices = "SELECT * FROM `ec_product_price` WHERE item_id = '$item_id' AND is_default_price = 'N'";
        $arrProductPrices = $cf->getData($sqlProductPrices);

        $sqlProductSpecifications = "SELECT * FROM `ec_product_specifications` WHERE item_id = '$item_id' AND specification_type = 'default'";
        $arrProductSpecifications = $cf->getData($sqlProductSpecifications);

        $sqlProductAdditionalImages = "SELECT * FROM `ec_product_specifications` WHERE item_id = '$item_id' AND specification_type = 'additional'";
        $arrProductAdditionalImages = $cf->getData($sqlProductAdditionalImages);

        $sqlProductReviews = "SELECT * FROM `ec_product_reviews` WHERE item_id = '$item_id' AND display_status = 'Y'";
        $arrProductReviews = $cf->getData($sqlProductReviews);

        $sqlPrimaryAttributes = "SELECT DISTINCT(product_attribute_1),product_attribute_2,product_attribute_3 FROM `ec_product_price` WHERE item_id = '$item_id' AND `is_default_price` = 'N'";
        $arrPrimaryAttributes = $cf->getOneData($sqlPrimaryAttributes);
        
        $sqlPrimaryOptions = "SELECT DISTINCT(product_option_1) FROM `ec_product_price` WHERE item_id = '$item_id' AND `is_default_price` = 'N'";
        //echo $sqlPrimaryOptions;exit;
        $arrPrimaryOptions = $cf->getData($sqlPrimaryOptions);

        return array(
            'arrProductDetails' => $arrProductDetails,
            'arrProductDefaultPrice' => $arrProductDefaultPrice,
            'arrProductPrices' => $arrProductPrices,
            'arrProductSpecifications' => $arrProductSpecifications,
            'arrProductAdditionalImages' => $arrProductAdditionalImages,
            'arrAllRelatedProducts' => $arrAllRelatedProducts,
            'arrProductReviews' => $arrProductReviews,
            'arrPrimaryAttributes' => $arrPrimaryAttributes,
            'arrPrimaryOptions' => $arrPrimaryOptions
        );
    }

    public function getAjaxOptions() {
        global $cf;
        $first_option_filter = "";
        $option_string = "<option value=''>Select Option</option>";
        $number = $_REQUEST['attribute_number'];
        $total_options = $_REQUEST['total_options'];
        $item_id = 0;
        if(isset($_REQUEST['item_id']) && $_REQUEST['item_id'] > 0) {
            $item_id = $_REQUEST['item_id'];
        }

        $next_number = $number+1;
        $index = $number - 1;
        $product_price_id = 0;
        
        $product_option_price = '0.00';
        $product_option_price_display = '0.00';
        
        $next_attribute_column_name = "product_attribute_".$next_number;
        $current_option_column_name = "product_option_".$number;
        $next_option_column_name = "product_option_".$next_number;

        $arrSelectedOptions = explode(",",$_REQUEST['option']);
        $current_selected_value = $arrSelectedOptions[$index];

        if($number == 2) {
            $first_option_value = $arrSelectedOptions[0];
            $first_option_filter = " AND product_option_1 = '$first_option_value'";
        }

        if($number == $total_options) {
            $option_string = "";
            $arrOptions = array();
            $option_1 = $arrSelectedOptions[0];
            $option_2 = "";
            $option_3 = "";
            $option_2_string = "";
            $option_3_string = "";

            if(isset($arrSelectedOptions[1]) && $arrSelectedOptions[1] != "" && $arrSelectedOptions[1] != 'undefined'){
                $option_2 = $arrSelectedOptions[1];
                $option_2_string = " AND product_option_2 = '".$option_2."'";
            }
            if(isset($arrSelectedOptions[2]) && $arrSelectedOptions[2] != "" && $arrSelectedOptions[2] != 'undefined') {
                $option_3 = $arrSelectedOptions[2];
                $option_3_string = " AND product_option_3 = '".$option_3."'";
            }
            $sqlNextValue = "SELECT product_option_price,product_option_price_display,product_price_id FROM `ec_product_price` WHERE item_id = '$item_id' AND product_option_1 = '".$option_1."' $option_2_string $option_3_string";
            //echo $sqlNextValue;
            
            $arrOptions = $cf->getData($sqlNextValue);
            
            $product_price_id = $arrOptions[0]['product_price_id'];
            if(isset($arrOptions[0]['product_option_price']) && $arrOptions[0]['product_option_price'] > 0) {
                $product_option_price = $arrOptions[0]['product_option_price'];
            }
            if(isset($arrOptions[0]['product_option_price_display']) && $arrOptions[0]['product_option_price_display'] > 0) {
                $product_option_price_display = $arrOptions[0]['product_option_price_display'];
            }
        } else {
            $sqlNextValue = "SELECT DISTINCT($next_option_column_name),product_option_price,product_option_price_display,product_price_id FROM `ec_product_price` WHERE item_id = '$item_id' AND `is_default_price` = 'N' AND $next_option_column_name != '' $first_option_filter AND `$current_option_column_name` = '$current_selected_value'";
            $arrOptions = $cf->getData($sqlNextValue);
            $product_price_id = $arrOptions[0]['product_price_id'];
            if(isset($arrOptions[0]['product_option_price']) && $arrOptions[0]['product_option_price'] > 0) {
                $product_option_price = $arrOptions[0]['product_option_price'];
            }
            if(isset($arrOptions[0]['product_option_price_display']) && $arrOptions[0]['product_option_price_display'] > 0) {
                $product_option_price_display = $arrOptions[0]['product_option_price_display'];
            }
            if(isset($arrOptions) && count($arrOptions) > 0) {
                foreach($arrOptions as $data) {
                    $option_string .= "<option value='".$data[$next_option_column_name]."'>".$data[$next_option_column_name]."</option>";
                }
            }
        }
        $arrData = array('options' => $arrOptions,'option_string' => $option_string,'product_option_price_display' => $product_option_price_display,'product_option_price' => $product_option_price,'product_price_id' => $product_price_id);
        echo json_encode($arrData);exit;
    }
}
?>