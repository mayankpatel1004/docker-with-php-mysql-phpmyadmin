<?php
require_once $theme_path.'model/Customeraccount.php';
class Customeraccountcontroller {

    public $model;
    public function __construct(){
        $this->model = new Customeraccount();
    }

    public function index() {
        global $theme_path;
        require $theme_path.'views/customerdashboard.php';
    }

    public function guestpost() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$cf,$front_session_name,$backend_allow_action_dropdown,$backend_allow_apply_button,$backend_allow_addnew_button;
        $item_type = "blogs";
        $item_alias = "guestpost";
        $sort_type = "asc";
        $sort_by = "item_id";
        $records_per_page = $back_end_rpp;
        $page_no = "1";
        $searchtext = '';
        $sortbytext = '';

        if(isset($page_data['item_alias']) && $page_data['item_alias'] != ''){
            $item_alias = $page_data['item_alias'];
        }
        
        if(isset($_REQUEST['reset']) && $_REQUEST['reset'] == '1'){
            unset($_SESSION[$front_session_name][$item_alias]);
            header('Location:'.$url.$item_alias);
        }

        if(isset($_SESSION[$front_session_name][$item_alias]['search_text']) && $_SESSION[$front_session_name][$item_alias]['search_text'] != ''){
            $searchtext = $_SESSION[$front_session_name][$item_alias]['search_text'];
        }

        if(isset($_SESSION[$back_session_name][$item_alias]['page_no']) && $_SESSION[$back_session_name][$item_alias]['page_no'] != ''){
            $page_no = $_SESSION[$back_session_name][$item_alias]['page_no'];   
        }

        if(isset($_SESSION[$back_session_name][$item_alias]['records_per_page']) && $_SESSION[$back_session_name][$item_alias]['records_per_page'] != ''){
            $records_per_page = $_SESSION[$back_session_name][$item_alias]['records_per_page'];
        }

        if(isset($_SESSION[$front_session_name][$item_alias]['sort_by']) && $_SESSION[$front_session_name][$item_alias]['sort_by'] != ''){
            $sortbytext = $_SESSION[$front_session_name][$item_alias]['sort_by'];
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

        $page_url = $url.$item_alias;
        $reset_url = $url.$item_alias.'/?reset=1';
        $add_url = $url.$item_alias."/form";
        $columns_header = "Title,Alias,Status,Created,Updated,ID";

        require $theme_path.'views/customerpost.php';
    }
    
    public function customerprofile() {
        global $theme_path;
        require $theme_path.'views/customerprofile.php';
    }

    public function myorders() {
        global $theme_path,$front_session_name;
        $customer_id = $_SESSION[$front_session_name]['customer_id'];
        $arrOrderData = $this->model->myorders($customer_id);
        require $theme_path.'views/myorders.php';
    }

    public function myinvoice() {
        global $theme_path,$front_session_name;
        $order_id = 0;
        if(isset($_REQUEST['order']) && $_REQUEST['order'] > 0) {
            $order_id = $_REQUEST['order'];
        }
        $arrAllData = $this->model->myinvoice($order_id);
        require $theme_path.'views/invoice.php';
    }

    public function customerpasswordchange() {
        global $theme_path;
        require $theme_path.'views/customerpasswordchange.php';
    }

    public function getDashboardDetails() {
        global $cf,$conn,$theme_path;
        require_once($theme_path.'getRequestData.php');
        $token = "";
        $customer_id = 0;
        $first_name = "";
        $last_name = "";
        $email = "";
        $arrAddress = array();
        $arrProfile = array();

        if(isset($_REQUEST['token']) && $_REQUEST['token'] != '') {
            $token = $_REQUEST['token'];
        }
        $arrData = $cf->decodeCustomertoken($token);
        if(isset($arrData) && !empty($arrData)) {
            $customer_id = $arrData['customer_id'];
            $first_name = $arrData['first_name'];
            $last_name = $arrData['last_name'];
            $email = $arrData['email'];
        }
        
        $sqlQuery = "SELECT * FROM `customers` WHERE customer_id = '".$customer_id."'";
        $arrCustomerData = $cf->getOneData($sqlQuery);
        $arrAddress = array(
            'user_address1' => $arrCustomerData['user_address1'],
            'user_address2' => $arrCustomerData['user_address2'],
            'user_city' => $arrCustomerData['user_city'],
            'user_state' => $arrCustomerData['user_state'],
            'user_country' => $arrCustomerData['user_country'],
            'user_zipcode' => $arrCustomerData['user_zipcode'],
            'contact_number' => $arrCustomerData['contact_number'],
            'email' => $arrCustomerData['email']
        );
        $arrProfile = array(
            'customer_id' => $arrCustomerData['customer_id'],
            'first_name' => $arrCustomerData['first_name'],
            'last_name' => $arrCustomerData['last_name'],
            'birth_date' => $arrCustomerData['birth_date'],
            'created_at' => $arrCustomerData['created_at'],
            'updated_at' => $arrCustomerData['updated_at']
        );

        $arrData = array(
            'address' => $arrAddress,
            'customer_data' => $arrProfile
        );
        
        echo json_encode($arrData);exit;
    }

    public function validateForm($request) {
        global $theme_path;
        $item_alias = "";
        $mandatory_fields = array();
        if(isset($request['item_alias']) && $request['item_alias'] != ""){
            $item_alias = $request['item_alias'];
        }
        require_once($theme_path.'generated_files/customer_profile.php');
        if(isset($arrFields) && !empty($arrFields)) {
            foreach($arrFields as $fields) {
                    if(isset($fields['mandatory']) && $fields['mandatory'] == 'Y'){
                        $mandatory_fields[] = $fields['name'];
                    }
                    if(isset($fields['validate']) && $fields['validate'] == 'email'){
                        $mandatory_fields['validate'][] = $fields['name'];
                    }
            }
        }
        
        $arrResponseData = array();
        $final_array = array();
        foreach($request as $field => $value) {
            if(in_array($field,$mandatory_fields)){
                $final_array[] = $field;
            }
        }

        if(!empty($final_array)) {
            foreach($final_array as $field_name) {
                if($request[$field_name] == '') {
                    $arrResponseData[$field_name] = ucfirst(str_replace("_"," ",$field_name)." is required.");
                }
            }
        }

        if(!empty($mandatory_fields['validate'])) {
            foreach($mandatory_fields['validate'] as $key => $field) {
                if($field == 'email') {
                    if(!filter_var($request[$field], FILTER_VALIDATE_EMAIL)){
                        $arrResponseData[$field] = "This is not a valid email address";
                    }
                }
            }
        }

        return $arrResponseData;
    }

    public function saveformdata() {
        $querystr = '';
        global $conn,$cf,$back_session_name;
        $success = 1;
        $error = 0;
        $message = "";        
        $save_request = '';
        $save_response = '';
        $table_name = "customers";
        $display_status = "Active";
        $validate = $this->validateForm($_REQUEST);
        //echo "<pre>";print_r($validate);exit;
        if(!empty($validate)){
            $success = 0;
            $error = 1;
            $message = "Please enter all required valid fields.";
        }
        
        foreach ($_REQUEST as $field => $value) {
            if ($field == 'customer_id' || $field == 'email') {
                continue;
            } else {
                $querystr .= "`$field`='" . addslashes($value) . "', ";
            }
        }
        $finalstring = substr($querystr, 0, -2);
    
        
        if($success == 1){
            $save_request = serialize($_REQUEST);
            if(isset($_REQUEST['customer_id']) && $_REQUEST['customer_id'] > 0) {
                $sql = "UPDATE `customers` SET $finalstring WHERE customer_id = " . $_REQUEST['customer_id'];
                $action = "Update";
            }
            //echo $sql;exit;
            $stmt = $conn->prepare($sql); 
            if($stmt->execute()) {
                
                $success = 1;
                $error = 0;
                $message = "Your record successfully saved.";

                if(isset($_REQUEST['customer_id']) && $_REQUEST['customer_id'] > 0) {
                    $lastId = $_REQUEST['customer_id'];
                    $action = "Update";
                    
                } 

                $activity = "INSERT INTO `activity` SET
                `action` = '$action',
                `status_action` = '$display_status',
                `table_name` = '$table_name',
                `record_id` = '$lastId',
                `record_name` = '".$_REQUEST['first_name'].' '.$_REQUEST['last_name']."',
                `created_by` = $lastId,
                `note1` = 'Customer Profile Updated',
                `created_by_name` = '".$_REQUEST['first_name'].' '.$_REQUEST['last_name']."',
                `created_at` = NOW(),
                `updated_at` = NOW()";
                $stmt = $conn->prepare($activity); 
                $stmt->execute();

            }
        }
        $response = array("success" => $success,"error" => $error,'message' => $message,'values' => $validate);
        $save_response = serialize($response);
        if($save_request != '' && $save_response != ''){
            $cf->saveRequests($save_request,$save_response,$table_name,$action,$lastId);
        }
        echo json_encode($response);exit;
    }
    
    public function validatePasswordForm($request) {
        global $theme_path;
        $item_alias = "";
        $mandatory_fields = array();
        require_once($theme_path.'generated_files/customer_password_fields.php');
        if(isset($arrFields) && !empty($arrFields)) {
            foreach($arrFields as $fields) {
                    if(isset($fields['mandatory']) && $fields['mandatory'] == 'Y'){
                        $mandatory_fields[] = $fields['name'];
                    }
                    if(isset($fields['validate']) && $fields['validate'] == 'email'){
                        $mandatory_fields['validate'][] = $fields['name'];
                    }
            }
        }
        
        $arrResponseData = array();
        $final_array = array();
        foreach($request as $field => $value) {
            if(in_array($field,$mandatory_fields)){
                $final_array[] = $field;
            }
        }

        if(!empty($final_array)) {
            foreach($final_array as $field_name) {
                if($request[$field_name] == '') {
                    $arrResponseData[$field_name] = ucfirst(str_replace("_"," ",$field_name)." is required.");
                }
            }
        }

        if($request['password'] != $request['cpassword']) {
            $arrResponseData['password'] = ucfirst("Your password mismatch.");
        }

        return $arrResponseData;
    }

    public function saveformpassword() {
        $querystr = '';
        global $conn,$cf,$front_session_name;
        $success = 1;
        $error = 0;
        $message = "";        
        $save_request = '';
        $save_response = '';
        $table_name = "customers";
        $display_status = "Active";
        $validate = $this->validatePasswordForm($_REQUEST);
        //echo "<pre>";print_r($validate);exit;
        if(!empty($validate)){
            $success = 0;
            $error = 1;
            $message = "Please enter all required valid fields.";
        }
        
        foreach ($_REQUEST as $field => $value) {
            if ($field == 'customer_id' || $field == 'cpassword') {
                continue;
            } else {
                $value = base64_encode($value);
                $querystr .= "`$field`='" . addslashes($value) . "', ";
            }
        }
        $finalstring = substr($querystr, 0, -2);
    
        
        if($success == 1){
            $save_request = serialize($_REQUEST);
            if(isset($_REQUEST['customer_id']) && $_REQUEST['customer_id'] > 0) {
                $sql = "UPDATE `customers` SET $finalstring WHERE customer_id = " . $_REQUEST['customer_id'];
                $action = "Update";
            }
            //echo $sql;exit;
            $stmt = $conn->prepare($sql); 
            if($stmt->execute()) {
                
                $success = 1;
                $error = 0;
                $message = "Your record successfully saved.";

                if(isset($_REQUEST['customer_id']) && $_REQUEST['customer_id'] > 0) {
                    $lastId = $_REQUEST['customer_id'];
                    $action = "Update";
                } 

                $activity = "INSERT INTO `activity` SET
                `action` = '$action',
                `status_action` = '$display_status',
                `table_name` = '$table_name',
                `record_id` = '$lastId',
                `record_name` = '".$_SESSION[$front_session_name]['first_name'].' '.$_SESSION[$front_session_name]['last_name']."',
                `created_by` = $lastId,
                `note1` = 'Customer Changed Password',
                `created_by_name` = '".$_SESSION[$front_session_name]['first_name'].' '.$_SESSION[$front_session_name]['last_name']."',
                `created_at` = NOW(),
                `updated_at` = NOW()";
                $stmt = $conn->prepare($activity); 
                $stmt->execute();

            }
        }
        $response = array("success" => $success,"error" => $error,'message' => $message,'values' => $validate);
        $save_response = serialize($response);
        if($save_request != '' && $save_response != ''){
            $cf->saveRequests($save_request,$save_response,$table_name,$action,$lastId);
        }
        echo json_encode($response);exit;
    }

    public function getGuestposts() {
        $arrData = $this->model->getList();
        $response = array("success" => $success,"error" => $error,'message' => $message,'values' => $validate);
    }

    public function form() {
        global $theme_path,$theme_url,$cf,$url,$front_end_rpp,$page_data;
        $item_alias = "guestpost";
        $item_type = "blogs";
        $id = 0;
        $save_url = $url.$item_alias.'/saveguestformdata';
        $arrOnedata = array();

        if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0) {
            $id = $_REQUEST['id'];
            $arrOnedata = $this->model->getOnedata($_REQUEST['id']);
        }
        
        require_once($theme_path.'generated_files/'.$item_alias.'.php');
        require $theme_path.'views/allguestitemform.php';
    }

    public function getItemalias($item_title){
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$conn;

        $aliastext = preg_replace('~[^\pL\d]+~u', '-', $item_title);
        $aliastext = iconv('utf-8', 'us-ascii//TRANSLIT', $aliastext);
        $aliastext = preg_replace('~[^-\w]+~', '', $aliastext);
        $aliastext = trim($aliastext, '-');
        $aliastext = preg_replace('~-+~', '-', $aliastext);
        $aliastext = strtolower($aliastext);

        $query = "SELECT count(*) as total FROM items WHERE item_alias = '$aliastext'";
        $arrDataCount = $cf->getOneData($query);
        if(isset($arrDataCount['total']) && $arrDataCount['total'] > 0){
            $itemalias = $aliastext . "-1";
            $aliastext = $this->getItemalias($itemalias);
        }
        return $aliastext;
    }

    public function saveguestformdata() {
        // echo "<pre>";
        // print_r($_FILES);
        // print_r($_REQUEST);
        // exit;

        if(isset($_REQUEST['published_at']) && $_REQUEST['published_at'] != '') {
            $_REQUEST['published_at'] = date('Y-m-d h:i:s',strtotime($_REQUEST['published_at']));
        }
        if(isset($_REQUEST['published_end_at']) && $_REQUEST['published_end_at'] != '') {
            $_REQUEST['published_end_at'] = date('Y-m-d h:i:s',strtotime($_REQUEST['published_end_at']));
        }

        global $conn,$cf,$back_session_name,$front_session_name,$theme_path;
        $querystr = '';
        $success = 1;
        $error = 0;
        $message = "";
        $action = "update";
        $save_request = '';
        $save_response = '';
        $login_id = $_SESSION[$front_session_name]['customer_id'];
        $login_name = $_SESSION[$front_session_name]['first_name']." ".$_SESSION[$front_session_name]['last_name'];
        $table_name = "items";
        $display_status = "Active";
        if(isset($_REQUEST['display_status']) && $_REQUEST['display_status'] != '') {
            if($_REQUEST['display_status'] == 'N'){
                $display_status = 'Inactive';
            }    
        }

        if(isset($_REQUEST['item_category']) && $_REQUEST['item_category'] != '') {
            $_REQUEST['item_category'] = implode(",",$_REQUEST['item_category']);
        }
        
        $validate = $cf->validateForm($_REQUEST);
        if(!empty($validate)){
            $success = 0;
            $error = 1;
            $message = "Please enter all required valid fields.";
        }

        if(isset($_REQUEST['item_id']) && $_REQUEST['item_id'] == 0) {
            $_REQUEST['item_alias'] = $this->getItemalias($_REQUEST['item_title']);
        }else {
            unset($_REQUEST['item_alias']);
        }
        
        foreach ($_REQUEST as $field => $value) {
            if ($field == 'item_id' || $field == 'PHPSESSID' || $field == '_ga' || $field == '__cfduid') {
                continue;
            } else {
                $querystr .= "`$field`='" . addslashes($value) . "', ";
            }
        }
        $finalstring = substr($querystr, 0, -2);
        //echo $finalstring;exit;

        if($success == 1){
            $save_request = serialize($_REQUEST);
            if(isset($_REQUEST['item_id']) && $_REQUEST['item_id'] > 0) {
                $sql = "UPDATE `items` SET $finalstring WHERE item_id = " . $_REQUEST['item_id'];
            } else {
                $sql = "INSERT INTO `items` SET $finalstring";
            }
            
            //echo $sql;exit;
            $stmt = $conn->prepare($sql); 
            $stmt->execute();
            if(isset($_REQUEST['item_id']) && $_REQUEST['item_id'] > 0) {
                $lastId = $_REQUEST['item_id'];
                $action = "Update";

                
            } else {
                $lastId = $conn->lastInsertId();
                $action = "Insert";
                if($lastId > 0) {
                    $name = $login_name;
                    $emailBody = $cf->readTemplateFile($theme_path."email/guestpostcreated.php");
                    require_once $theme_path.'email_fix_keywords.php';
                    $subject = FRONT_APPLICATION_NAME." - Guest Post Created";
                    $emailBody = str_replace("#username#", $login_name, $emailBody);
                    $emailBody = str_replace("#email#", $_SESSION[$front_session_name]['email'], $emailBody);
                    $emailBody = str_replace("#subject#", $subject, $emailBody);
                    $email_response = $cf->sentEmail(COMPANY_EMAIL,$subject,$emailBody);
                }
            }

            $success = 1;
            $error = 0;
            $message = "Your record successfully saved.";

            $activity = "INSERT INTO `activity` SET
            `action` = '$action',
            `status_action` = '$display_status',
            `table_name` = '$table_name',
            `record_id` = '$lastId',
            `record_name` = '".addslashes($_REQUEST['item_title'])."',
            `created_by` = $login_id,
            `created_by_name` = '$login_name',
            `created_at` = NOW(),
            `updated_at` = NOW()";
            $stmt = $conn->prepare($activity); 
            $stmt->execute();

            if(isset($_FILES['file1']['name']) && $_FILES['file1']['name'] != ""){
                $filename = $lastId."_1_".time()."_".$_FILES['file1']['name'];
                $filename_tmp = $_FILES['file1']['tmp_name'];
                move_uploaded_file($filename_tmp,ITEMS_PATH.$filename);
                $sql = "UPDATE `items` SET `file1` = '$filename' WHERE item_id = ".$lastId;
                //echo $sql;exit;
                $stmt = $conn->prepare($sql); 
                $stmt->execute();
            }
    
            if(isset($_FILES['file2']['name']) && $_FILES['file2']['name'] != ""){
                $filename = $lastId."_2_".time()."_".$_FILES['file2']['name'];
                $filename_tmp = $_FILES['file2']['tmp_name'];
                move_uploaded_file($filename_tmp,ITEMS_PATH.$filename);
                $sql = "UPDATE `items` SET `file2` = '$filename' WHERE item_id = ".$lastId;
                $stmt = $conn->prepare($sql); 
                $stmt->execute();
            }
            
            if(isset($_FILES['file3']['name']) && $_FILES['file3']['name'] != ""){
                $filename = $lastId."_3_".time()."_".$_FILES['file3']['name'];
                $filename_tmp = $_FILES['file3']['tmp_name'];
                move_uploaded_file($filename_tmp,ITEMS_PATH.$filename);
                $sql = "UPDATE `items` SET `file3` = '$filename' WHERE item_id = ".$lastId;
                $stmt = $conn->prepare($sql); 
                $stmt->execute();
            }

            if(isset($_FILES['meta_name']) && count($_FILES['meta_name']) > 0) {
                for($i = 0; $i < 4; $i++) {
                    if(isset($_FILES['meta_name']['name'][$i]) && $_FILES['meta_name']['name'][$i] != ""){
                        $filename = $lastId."_gallery_".$i."_".time()."_".$_FILES['meta_name']['name'][$i];
                        $filename_tmp = $_FILES['meta_name']['tmp_name'][$i];
                        move_uploaded_file($filename_tmp,ITEMS_PATH.$filename);
                        $sql = "INSERT INTO `item_meta` SET `item_id` = '$lastId',`meta_key` = 'gallery',`meta_value` = '$filename'";
                        $stmt = $conn->prepare($sql); 
                        $stmt->execute();
                    }    
                }
            }    
        }
        $response = array("success" => $success,"error" => $error,'message' => $message,'values' => $validate);
        $save_response = serialize($response);
        if($save_request != '' && $save_response != ''){
            $cf->saveRequests($save_request,$save_response,$table_name,$action,$login_id);
        }
        echo json_encode($response);exit;
    }
}
?>