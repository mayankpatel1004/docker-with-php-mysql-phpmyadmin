<?php
require_once $theme_path.'model/Allproducts.php';
class Allproductscontroller {

    public $model;
    public function __construct(){
        $this->model = new Allproducts();
    }

    public function index() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$conn,$back_session_name;
        //print_r($page_data);
        $cf->checkAdminLogin();
        $item_type = "products";
        $item_alias = "";
        $sort_type = "desc";
        $sort_by = "item_id";
        $records_per_page = $back_end_rpp;
        $page_no = "1";
        $searchtext = '';
        $sortbytext = '';
        
        if(isset($page_data['item_type']) && $page_data['item_type'] != "") {
            $item_type = $page_data['item_type'];
        }
        
        if(isset($page_data['item_alias']) && $page_data['item_alias'] != "") {
            $item_alias = $page_data['item_alias'];
        }
        
        if(isset($_REQUEST['reset']) && $_REQUEST['reset'] == '1'){
            unset($_SESSION[$back_session_name][$item_alias]);
            header('Location:'.$url.$item_alias);
        }

        if(isset($_SESSION[$back_session_name][$item_alias]['search_text']) && $_SESSION[$back_session_name][$item_alias]['search_text'] != ''){
            $searchtext = $_SESSION[$back_session_name][$item_alias]['search_text'];
        }

        if(isset($_SESSION[$back_session_name][$item_alias]['page_no']) && $_SESSION[$back_session_name][$item_alias]['page_no'] != ''){
            $page_no = $_SESSION[$back_session_name][$item_alias]['page_no'];   
        }

        if(isset($_SESSION[$back_session_name][$item_alias]['records_per_page']) && $_SESSION[$back_session_name][$item_alias]['records_per_page'] != ''){
            $records_per_page = $_SESSION[$back_session_name][$item_alias]['records_per_page'];
        }

        if(isset($_SESSION[$back_session_name][$item_alias]['sort_by']) && $_SESSION[$back_session_name][$item_alias]['sort_by'] != ''){
            $sortbytext = $_SESSION[$back_session_name][$item_alias]['sort_by'];
            $arrData = explode('__',$sortbytext);
            if(isset($arrData[2]) && $arrData[2] != ''){$sort_type = $arrData[2];}
            else{$sort_type = $arrData[1];}
            if(isset($arrData[1]) && ($arrData[1] != 'asc' && $arrData[1] != 'desc')){
                $sort_by = $arrData[0]."_".$arrData[1];
            }
            else{
                $sort_by = $arrData[0];
            }
        }
        
        $page_url = $url.$item_alias."/indexAjax";
        $reset_url = $url.$item_alias.'/index/?reset=1';
        $add_url = $url.$item_alias."/form";
        $columns_header = "Rec-ID,Title,Alias,Weight,Instock,Active,Created At,ID";
        $sort_array = array(
            'item_id__asc' => 'Oldest First',
            'item_id__desc' => 'Newest First',
            'item_title__asc' => 'Title ASC',
            'item_title__desc' =>'Title DESC'
        );
        //print_r($_SESSION[$back_session_name][$item_alias]);
        require $theme_path.'views/allproducts.php';
    }

    public function form() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data;
        $cf->checkAdminLogin();
        $item_type = "products";
        $item_alias = "allproducts";
        $id = 0;
        $save_url = $url.$item_alias.'/saveformdata';
        $arrOnedata = array();
        $arrProductDefaultPricedata = array();
        $arrAdditionalImages = array();
        $arrProductSpecifications = array();
        $arrProductAttributesData = array();

        if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0) {
            $id = $_REQUEST['id'];
            $arrOnedata = $this->model->getOnedata($_REQUEST['id']);
            $arrProductDefaultPricedata = $this->model->getProductDefaultPriceData($_REQUEST['id']);
            $arrProductAttributesData = $this->model->getProductAttributesPriceData($_REQUEST['id']);
            $arrAdditionalImages = $this->model->getProductAdditionalImages($_REQUEST['id']);
            $arrProductSpecifications = $this->model->getProductSpecifications($_REQUEST['id']);
        }

        require_once($theme_path.'generated_files/'.$item_alias.'.php');
        require $theme_path.'views/allproductsform.php';
    }

    public function validateForm($arrProducts,$arrProductPrice,$id) {
        // echo "<pre>";
        // print_r($arrProductPrice);
        // print_r($arrProducts);
        // exit;
        $status = "200";
        $error = array();

        if(isset($arrProducts['item_title']) && $arrProducts['item_title'] == "") {
            $error['item_title'] = "Please enter product title";
        }
        if(isset($arrProducts['item_description']) && $arrProducts['item_description'] == "") {
            $error['item_description'] = "Please enter product description";
        }
        if(isset($arrProductPrice['product_option_price']) && $arrProductPrice['product_option_price'] == "") {
            $error['product_option_price'] = "Please enter product option price";
        }
        if(isset($arrProductPrice['product_option_price']) && $arrProductPrice['product_option_price'] != "") {
            if(!is_numeric($arrProductPrice['product_option_price'])){
                $error['product_option_price'] = "Please enter product price as numeric";
            }    
        }
        if(isset($arrProductPrice['product_quantity']) && $arrProductPrice['product_quantity'] == "") {
            $error['product_quantity'] = "Please enter product quantity";
        }
        if(isset($arrProductPrice['product_quantity']) && $arrProductPrice['product_quantity'] != "") {
            if(!is_numeric($arrProductPrice['product_quantity'])){
                $error['product_quantity'] = "Please enter product quantity as numeric";
            }    
        }
        

        return $error;
    }

    public function getItemalias($item_title){
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$conn;

        $aliastext = preg_replace('~[^\pL\d]+~u', '-', $item_title);
        $aliastext = iconv('utf-8', 'us-ascii//TRANSLIT', $aliastext);
        $aliastext = preg_replace('~[^-\w]+~', '', $aliastext);
        $aliastext = trim($aliastext, '-');
        $aliastext = preg_replace('~-+~', '-', $aliastext);
        $aliastext = strtolower($aliastext);

        $query = "SELECT count(*) as total FROM ec_products WHERE item_alias = '$aliastext'";
        $arrDataCount = $cf->getOneData($query);
        if(isset($arrDataCount['total']) && $arrDataCount['total'] > 0){
            $itemalias = $aliastext . "-1";
            $aliastext = $this->getItemalias($itemalias);
        }
        return $aliastext;
    }

    public function saveformdata() {
        
        // echo "<pre>";
        // echo $_FILES['products']['name']['file1'];
        // print_r($_FILES);
        // print_r($_REQUEST);
        // exit;
        
        global $conn,$cf,$back_session_name,$theme_path,$currancy;
        $querystrProducts = '';
        $success = 1;
        $error = 0;
        $message = "";
        $action = "update";
        $table_name = "ec_products";
        $display_status = "Active";
        $login_id = $_SESSION[$back_session_name]['user_id'];
        $login_name = $_SESSION[$back_session_name]['first_name']." ".$_SESSION[$back_session_name]['last_name'];
        if(isset($login_id) && $login_id > 0) {
            $_REQUEST['products']['user_id'] = $login_id;
            $_REQUEST['products']['user_name'] = $login_name;
        }
        if(isset($_REQUEST['products']['related_products']) && $_REQUEST['products']['related_products'] != "") {
            $_REQUEST['products']['related_products'] = implode(",",$_REQUEST['products']['related_products']);
        }
        if(isset($_REQUEST['products']['item_category_alias']) && $_REQUEST['products']['item_category_alias'] != "") {
            $_REQUEST['products']['item_category_alias'] = implode(",",$_REQUEST['products']['item_category_alias']);
        }
        //print_r($_REQUEST['products']);
        $validate = $this->validateForm($_REQUEST['products'],$_REQUEST['productprice'],$_REQUEST['item_id']);
        if(!empty($validate)) {
            $success = 0;
            $error = 1;
            $message = "Please enter all required valid fields.";
        }
        
        if($success == 1){
            if(isset($_REQUEST['products']) && !empty($_REQUEST['products'])) {
                foreach($_REQUEST['products'] as $column_name => $column_value) {
                    if ($column_name == 'item_id' || $column_name == 'item_alias' || $column_name == 'PHPSESSID' || $column_name == '_ga' || $column_name == '__cfduid') {
                        continue;
                    } else {
                        $querystrProducts .= "`$column_name`='" . addslashes($column_value) . "', ";
                    }
                }
                if(isset($_REQUEST['item_id']) && $_REQUEST['item_id'] == 0) {
                    $querystrProducts .= "`item_alias`='" .$this->getItemalias($_REQUEST['products']['item_title'])."', ";
                    $querystrProducts .= "`currancy`='" .$currancy."', ";
                    $querystrProducts .= "`publish_month`='" .date('m',strtotime($_REQUEST['products']['publish_date']))."', ";
                    $querystrProducts .= "`publish_year`='" .date('Y',strtotime($_REQUEST['products']['publish_date']))."', ";
                    $querystrProducts .= "`publish_end_date`='" .date('Y-m-d', strtotime('+10 years'))."', ";            
                }
                $finalstringProducts = substr($querystrProducts, 0, -2);    
            }

            $save_request = serialize($_REQUEST);
            if(isset($_REQUEST['item_id']) && $_REQUEST['item_id'] > 0) {
                $sql = "UPDATE `ec_products` SET $finalstringProducts WHERE item_id = " . $_REQUEST['item_id'];
            } else {
                $sql = "INSERT INTO `ec_products` SET $finalstringProducts";
            }
            //echo $sql;exit;
            try {
                $stmt = $conn->prepare($sql); 
                $stmt->execute();
                $success = 1;
                $error = 0;
                $message = "Your record successfully saved.";
            } catch (PDOException $ex) {
                include 'logError.php';
            }
        }

        if($success == 1) {
            if(isset($_REQUEST['item_id']) && $_REQUEST['item_id'] > 0) {
                $lastId = $_REQUEST['item_id'];
                $action = "Update";    
            } else {
                $lastId = $conn->lastInsertId();
                $action = "Insert";
            }

            if(isset($_FILES['products']['name']['file1']) && $_FILES['products']['name']['file1'] != ""){
                $filename = "product_".$lastId."_".time()."_".$_FILES['products']['name']['file1'];
                $filename_tmp = $_FILES['products']['tmp_name']['file1'];
                move_uploaded_file($filename_tmp,PRODUCTS_PATH.$filename);
                $sqlUpdateFile = "UPDATE `ec_products` SET `file1` = '$filename' WHERE item_id = ".$lastId;
                try {
                    $stmt = $conn->prepare($sqlUpdateFile); 
                    $stmt->execute();
                    $success = 1;
                    $error = 0;
                } catch (PDOException $ex) {
                    include $theme_path.'controller/logError.php';
                }   
            }

            if(isset($_FILES['image']) && !empty($_FILES['image'])) {
                for($i=0;$i<4;$i++) {
                    if(isset($_FILES['image']['name'][$i]) && $_FILES['image']['name'][$i] != "") {
                        $filename = "ps_".$i."_".time()."_".$_FILES['image']['name'][$i];
                        $filename_tmp = $_FILES['image']['tmp_name'][$i];
                        if(move_uploaded_file($filename_tmp,PRODUCTS_PATH.$filename)){
                            $product_path = PRODUCTS_PATH;
                            $sqlUpdateFile = "INSERT INTO `ec_product_specifications` SET 
                            `specification_title` = '$product_path',
                            `specification_value` = '$filename',
                            `item_id` = '$lastId',
                            `specification_type` = 'additional'";
                            //echo $sqlUpdateFile;
                            try {
                                $stmt = $conn->prepare($sqlUpdateFile); 
                                $stmt->execute();
                                $success = 1;
                                $error = 0;
                            } catch (PDOException $ex) {
                                include $theme_path.'controller/logError.php';
                            }
                        }
                           
                    }
                }       
            }
            //exit;
            $finalstringProducts = "";
            $querystrProducts = "";
            
            if($lastId > 0) {
                if(isset($_REQUEST['productprice']) && !empty($_REQUEST['productprice'])) {
                    $sqlDelete = "DELETE from `ec_product_price` WHERE item_id = '".$lastId."' AND is_default_price = 'Y'";
                    $stmt = $conn->prepare($sqlDelete); 
                    $stmt->execute();

                    foreach($_REQUEST['productprice'] as $column_name => $column_value) {
                        if ($column_name == 'item_alias' || $column_name == 'PHPSESSID' || $column_name == '_ga' || $column_name == '__cfduid') {
                            continue;
                        } else {
                            $querystrProducts .= "`$column_name`='" . addslashes($column_value) . "', ";
                        }
                    }
                    $querystrProducts .= "`item_id`='".$lastId."', ";
                    $querystrProducts .= "`user_id`='".$login_id."', ";
                    $querystrProducts .= "`currancy`='".$currancy."', ";
                    $finalstringProducts = substr($querystrProducts, 0, -2);    

                    $sql = "INSERT INTO `ec_product_price` SET $finalstringProducts";
                    $stmt = $conn->prepare($sql); 
                    $stmt->execute();
                    $success = 1;
                    $error = 0;
                }

                if(isset($_REQUEST['product_attribute_1']) && $_REQUEST['product_attribute_1'] != false && $_REQUEST['item_id'] == 0) {
                    $counter = 0;
                    foreach($_REQUEST['product_attribute_1'] as $key => $product_attribute) {
                        $product_attribute1 = addslashes($_REQUEST['product_attribute_1'][$counter]);
                        $product_option1 = addslashes($_REQUEST['product_option_1'][$counter]);
                        $product_attribute2 = addslashes($_REQUEST['product_attribute_2'][$counter]);
                        $product_option2 = addslashes($_REQUEST['product_option_2'][$counter]);
                        $product_option_price = addslashes($_REQUEST['product_option_price_1'][$counter]);
                        $product_option_price_display = addslashes($_REQUEST['product_option_price_display_1'][$counter]);
                        $product_quantity = addslashes($_REQUEST['product_quantity_1'][$counter]);
                        $is_default_price = addslashes($_REQUEST['is_default_price_1'][$counter]);
                        $item_tax_amount = addslashes($_REQUEST['item_tax_amount_1'][$counter]);
                        $min_quantity_notification = addslashes($_REQUEST['min_quantity_notification_1'][$counter]);
                        $item_shipping_amount = addslashes($_REQUEST['item_shipping_amount_1'][$counter]);
        
                        if($product_attribute1 != "" && $product_option1 != "" && $product_quantity != "") {
                            $insertProductOptions = "INSERT INTO `ec_product_price` SET 
                            `item_id` = '$lastId',
                            `product_attribute_1` = '$product_attribute1',
                            `product_option_1` = '$product_option1',
                            `product_attribute_2` = '$product_attribute2',
                            `product_option_2` = '$product_option2',
                            `min_quantity_notification` = '$min_quantity_notification',
                            `item_shipping_amount` = '$item_shipping_amount',
                            `product_option_price` = '$product_option_price',
                            `product_option_price_display` = '$product_option_price_display',
                            `currancy` = '$currancy',
                            `item_tax_amount` = '$item_tax_amount',
                            `is_default_price` = '$is_default_price',
                            `product_quantity` = '$product_quantity'";
                            //echo "<br />".$insertProductOptions;
                            try {
                                $stmt = $conn->prepare($insertProductOptions); 
                                $stmt->execute();
                                $success = 1;
                                $error = 0;
                            } catch (PDOException $ex) {
                                include $theme_path.'controller/logError.php';
                                $success = 0;
                                $error = 1;
                            }
                        }
                        $counter++;
                    }
                }

                if(isset($_REQUEST['specification_title']) && count($_REQUEST['specification_title']) > 0) {
                    $counter = 0;
                    $sqlDelete = "DELETE from `ec_product_specifications` WHERE item_id = '".$_REQUEST['item_id']."' AND `specification_type` = 'Default'";
                    $stmt = $conn->prepare($sqlDelete); 
                    $stmt->execute();

                    foreach($_REQUEST['specification_title'] as $key => $specification_title) {
                        $specification_value = $_REQUEST['specification_value'][$counter];
                        if($specification_title != "" && $specification_value != "") {
                            $sqlInsertSpecifications = "INSERT INTO ec_product_specifications SET 
                            item_id = '".$lastId."',
                            specification_title = '$specification_title',
                            specification_value = '$specification_value',
                            specification_type = 'default'";
                            $stmt = $conn->prepare($sqlInsertSpecifications); 
                            $stmt->execute();
                        }
                        $counter++;
                    }
                }
            }

            $activity = "INSERT INTO `activity` SET
            `action` = '$action',
            `status_action` = '$display_status',
            `table_name` = '$table_name',
            `record_id` = '$lastId',
            `record_name` = '".$_REQUEST['products']['item_title']."',
            `created_by` = $login_id,
            `created_by_name` = '$login_name',
            `created_at` = NOW(),
            `updated_at` = NOW()";
            try {
                $stmt = $conn->prepare($activity); 
                $stmt->execute();
                $success = 1;
                $error = 0;
            } catch (PDOException $ex) {
                include $theme_path.'controller/logError.php';
            }
        }
        $response = array("success" => $success,"error" => $error,'message' => $message,'values' => $validate);
        $save_response = serialize($response);
        if($save_request != '' && $save_response != ''){
            $response_message = $cf->saveRequests($save_request,$save_response,$table_name,$action,$login_id);;
            if($response_message != '') {
                $message = $response_message;
                $success = 0;
                $error = 1;
            }
        }
        //exit;
        echo json_encode($response);exit;
    }

    public function indexAjax() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data;
        $this->model->getList();
    }
}
?>