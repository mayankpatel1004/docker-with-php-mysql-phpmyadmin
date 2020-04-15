<?php
require_once $theme_path.'model/Allsubscribers.php';
class Allsubscriberscontroller {

    public $model;
    public function __construct(){
        $this->model = new Allsubscribers();
    }

    public function index() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$cf,$back_session_name,$backend_allow_action_dropdown,$backend_allow_apply_button,$backend_allow_addnew_button;
        //print_r($page_data);
        $cf->checkAdminLogin();
        $item_type = "allsubscribers";
        $item_alias = "allsubscribers";
        $sort_type = "desc";
        $sort_by = "subscriber_id";
        $records_per_page = $back_end_rpp;
        $page_no = "1";
        $searchtext = '';
        $sortbytext = '';

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

        $page_url = $url.$item_type."/indexAjax";
        $reset_url = $url.$item_type.'/index/?reset=1';
        $add_url = $url.$item_type."/form";
        $columns_header = "Email,Type,Status,Created,Updated,ID";

        $sort_array = array(
            'subscriber_id__asc' => 'Oldest First',
            'subscriber_id__desc' => 'Newest First',
            'email_address__asc' => 'Email ASC',
            'email_address__desc' =>'Email DESC'
        );
        require $theme_path.'views/allsubscribers.php';
    }

    public function indexAjax() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data;
        $this->model->getList();
    }

    public function form() {    
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data;
        $item_type = "allsubscribers";
        $item_alias = "allsubscribers";
        $id = 0;
        $save_url = $url.$item_type.'/saveformdata';
        $arrOnedata = array();
        
        if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0) {
            $id = $_REQUEST['id'];
            $arrOnedata = $this->model->getOnedata($_REQUEST['id']);
        }

        require_once($theme_path.'generated_files/'.$item_alias.'.php');
        require $theme_path.'views/allsubscribersform.php';
    }

    public function saveformdata() {
        global $conn,$cf,$back_session_name,$theme_path;
        require_once($theme_path.'controller/convertApiDataToRequest.php');
        require_once($theme_path.'getRequestData.php');
        // echo "<pre>";
        // print_r($_FILES);
        // print_r($_REQUEST);
        // exit;
        $token = "";
        $success = 1;
        $error = 0;
        $status = 200;
        $message = "";
        $values = array();
        $table_name = "subscriber";
        $display_status = "Active";
        if(isset($_REQUEST['display_status']) && $_REQUEST['display_status'] != ''){
            if($_REQUEST['display_status'] == 'N'){
                $display_status = 'Inactive';
            }    
        }

        $validate = $cf->validateForm($_REQUEST);
        if(!empty($validate)){
            $success = 0;
            $error = 1;
            $message = "Please enter all required valid fields.";
        }

        foreach ($_REQUEST as $field => $value) {
            if ($field == 'subscriber_id' || $field == 'item_alias' || $field == 'PHPSESSID' || $field == '_ga' || $field == '__cfduid') {
                continue;
            } else {
                $querystr .= "`$field`='" . addslashes($value) . "', ";
            }
        }
        $finalstring = substr($querystr, 0, -2);
        //echo $finalstring;exit;

        if($success == 1){
            $save_request = serialize($_REQUEST);
            if(isset($_REQUEST['subscriber_id']) && $_REQUEST['subscriber_id'] > 0) {
                $sql = "UPDATE `subscriber` SET $finalstring WHERE subscriber_id = " . $_REQUEST['subscriber_id'];
                $action = "Update";
            } else {
                $sql = "INSERT INTO `subscriber` SET $finalstring";
                $action = "Insert";
            }
            //echo $sql;exit;
            try {
                $stmt = $conn->prepare($sql); 
                $stmt->execute();
                if(isset($_REQUEST['subscriber_id']) && $_REQUEST['subscriber_id'] > 0) {
                    $lastId = $_REQUEST['subscriber_id'];
                    $action = "Update";
                    $success = 1;
                    $error = 0;
                    $message = "Your record successfully saved.";    
                } else {
                    $lastId = $conn->lastInsertId();
                    $action = "Insert";
                    $success = 1;
                    $error = 0;
                    $message = "Your record successfully saved.";
                }
            } catch (PDOException $ex) {
                include $theme_path.'controller/logError.php';
            }
        }
            
        if($success == 1){
            $activity = "INSERT INTO `activity` SET
            `action` = '$action',
            `status_action` = '$display_status',
            `table_name` = '$table_name',
            `record_id` = '$lastId',
            `record_name` = '".$_REQUEST['email_address']."',
            `created_by` = $login_id,
            `created_by_name` = '$login_name',
            `created_at` = NOW(),
            `updated_at` = NOW()";
            try {
                $success = 1;
                $error = 0;
                $stmt = $conn->prepare($activity); 
                $stmt->execute();
            } catch (PDOException $ex) {
                include $theme_path.'controller/logError.php';
            }
        }

        $response = array("success" => $success,"error" => $error,'message' => $message,'values' => $validate);
        $save_response = serialize($response);
        if($save_request != '' && $save_response != ''){
            $response_message = $cf->saveRequests($save_request,$save_response,$table_name,$action,$login_id);
            if($response_message != '') {
                $message = $response_message;
                $success = 0;
                $error = 1;
            }
        }
        $arrData = array(
            'token' => $token,
            'success' => $success,
            'error' => $error,
            'status' => $status,
            'message' => $message,
            'values' => $values
        );
        echo json_encode($arrData);exit;
    }

    public function listAction() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$conn,$back_session_name;
        require_once($theme_path.'controller/convertApiDataToRequest.php');
        require_once($theme_path.'getRequestData.php');
        $table_name = "items";
        $token = "";
        $success = 1;
        $error = 0;
        $status = 200;
        $message = "";
        $values = array();
        $action = $_REQUEST['action'];
        if(isset($_REQUEST['ids']) && $_REQUEST['ids'] != "") {
            $arrIds = explode(",",$_REQUEST['ids']);
            foreach($arrIds as $id) {
                if($action == 'N' || $action == 'Y') {
                    $sqlUpdate = "UPDATE subscriber SET display_status = '".$action."' WHERE subscriber_id = '".$id."'";
                    try {
                        $stmt = $conn->prepare($sqlUpdate); 
                        $stmt->execute();
                        $update_action = "Update";
                        if($action == 'Y'){
                            $status_action = "Active";
                        }
                        if($action == 'N'){
                            $status_action = "Inactive";
                        }
                        $success = 1;
                        $error = 0;
                        $message = "Record Successfully Updated.";
                    } catch (PDOException $ex) {
                        include $theme_path.'controller/logError.php';
                    }
                    
                }
                if($action == 'T') {
                    $sqlUpdate = "UPDATE subscriber SET deleted_status = 'Y',deleted_by = '$login_id',deleted_by_name = '$login_name',deleted_time = NOW(),updated_at = NOW() WHERE subscriber_id = '".$id."'";
                    try {
                        $stmt = $conn->prepare($sqlUpdate); 
                        $stmt->execute();
                        $update_action = "Delete";
                        if($action == 'T'){
                            $status_action = "Delete";
                        }
                        $success = 1;
                        $error = 0;
                        $message = "Record Successfully Deleted.";
                    } catch (PDOException $ex) {
                        include $theme_path.'controller/logError.php';
                    }
                }

                $record_name = "";
                $query = "SELECT `email_address` FROM `subscriber` WHERE `subscriber_id` = '$id'";
                $arrData = $cf->getOneData($query);
                if(isset($arrData) && $arrData != false){
                    $record_name = $arrData['email_address'];
                }

                $activity = "INSERT INTO `activity` SET
                `action` = '$update_action',
                `status_action` = '$status_action',
                `table_name` = '$table_name',
                `record_id` = '$id',
                `record_name` = '$record_name',
                `created_by` = $login_id,
                `created_by_name` = '$login_name',
                `created_at` = NOW(),
                `updated_at` = NOW()";
                try {
                    $stmt = $conn->prepare($activity); 
                    $stmt->execute();
                    $success = 1;
                    $error = 0;
                    $message = "Your record successfully saved.";
                } catch (PDOException $ex) {
                    include $theme_path.'controller/logError.php';
                }
            }
        }
        $arrData = array(
            'token' => $token,
            'success' => $success,
            'error' => $error,
            'status' => $status,
            'message' => $message,
            'values' => $values
        );
        echo json_encode($arrData);exit;
    }

    public function importsubscribers() {
        global $cf,$conn;
        $current_date = date('Y-m-d h:i:s');
        $success = 1;
        $error = 0;
        $message = "";

        $sqlClient = "SELECT `email_address`,`section_title`,`contact` FROM `item_section` WHERE item_type='clients' AND  email_address != ''";
        $arrClientData = $cf->getData($sqlClient);
        if(isset($arrClientData) && count($arrClientData) > 0) {
            foreach($arrClientData as $client){
                if(isset($client['email']) && $client['email'] != ""){
                    $sqlSubscriber = "SELECT `email_address` FROM `subscriber` WHERE `email_address` = '".$client['email_address']."'";
                    $arrClientData = $cf->getOneData($sqlSubscriber);
                    if(isset($arrClientData['email_address']) && $arrClientData['email_address'] != "") {
                            $sqlInsert = "UPDATE `subscriber` SET 
                            `first_name` = '".$client['section_title']."',
                            `company_name` = '".$client['section_title']."',
                            `contact` = '".$client['contact']."',
                            `item_type` = 'clients',
                            `updated_at` = '".$current_date."'";
                    } else {
                        if (filter_var($client['email'], FILTER_VALIDATE_EMAIL)) {
                            $sqlInsert = "INSERT INTO `subscriber` SET 
                            `first_name` = '".$client['section_title']."',
                            `company_name` = '".$client['section_title']."',
                            `contact` = '".$client['contact']."',
                            `email_address` = '".strtolower($client['email'])."',
                            `item_type` = 'clients',
                            `created_at` = '".$current_date."',
                            `updated_at` = '".$current_date."'";
                          }
                    }
                    try {
                        $stmt = $conn->prepare($sqlInsert);
                        $stmt->execute();
                        $message = "Data Successfully Inserted";
                        $success = 1;
                        $error = 0;
                    } catch (PDOException $ex) {
                        include $theme_path.'controller/logError.php';
                    }
                }
            }
        }

        if($success == 1){
            $sqlUser = "SELECT `first_name`,`last_name`,`email`,`contact_number` FROM `users` WHERE `role_id` IN ('3') ";
            $arrUserData = $cf->getData($sqlUser);
            if(isset($arrUserData) && count($arrUserData) > 0) {
                foreach($arrUserData as $client){
                    if(isset($client['email']) && $client['email'] != ""){
                        $sqlSubscriber = "SELECT `email_address` FROM `subscriber` WHERE `email_address` = '".$client['email']."'";
                        $arrClientData = $cf->getOneData($sqlSubscriber);
                        if(isset($arrClientData['email_address']) && $arrClientData['email_address'] != "") {
                                $sqlInsert = "UPDATE `subscriber` SET 
                                `first_name` = '".$client['first_name']."',
                                `last_name` = '".$client['last_name']."',
                                `contact` = '".$client['contact_number']."',
                                `item_type` = 'employee',
                                `updated_at` = '".$current_date."'
                                WHERE email_address = '".$client['email']."'";
                        } else {
                            if (filter_var($client['email'], FILTER_VALIDATE_EMAIL)) {
                                $sqlInsert = "INSERT INTO `subscriber` SET 
                                `first_name` = '".$client['first_name']."',
                                `last_name` = '".$client['last_name']."',
                                `email_address` = '".strtolower($client['email'])."',
                                `contact` = '".$client['contact_number']."',
                                `item_type` = 'employee',
                                `created_at` = '".$current_date."',
                                `updated_at` = '".$current_date."'";
                            }
                        }
                        try {
                            $stmt = $conn->prepare($sqlInsert); 
                            $stmt->execute();
                            $message = "Data Successfully Inserted";
                            $success = 1;
                            $error = 0;
                        } catch (PDOException $ex) {
                            include $theme_path.'controller/logError.php';
                        }
                    }
                    
                }
            }
        }
        
        if($success == 1) {
            if(isset($_FILES['import_csv']['name']) && $_FILES['import_csv']['name'] != ""){
                $filename = "subscribercsv_".$_FILES['import_csv']['name'];
                $filename_tmp = $_FILES['import_csv']['tmp_name'];
                move_uploaded_file($filename_tmp,ITEMS_PATH.$filename);
                $file = fopen(ITEMS_PATH.$filename,"r");
                while(! feof($file)) {
                        $arrData = fgetcsv($file);       
                        if(isset($arrData[0]) && $arrData[0] != 'first_name') {
                            $first_name = trim($arrData[0]);
                            $last_name = trim($arrData[1]);
                            $email = trim(strtolower($arrData[2]));
                            $item_type = trim($arrData[3]);
                            $contact = trim($arrData[4]);
                            $address1 = trim($arrData[5]);
                            $address2 = trim($arrData[6]);
                            $city = trim($arrData[7]);
                            $state = trim($arrData[8]);
                            $zipcode = trim($arrData[9]);
                            $country = trim($arrData[10]);
                            $cellphone1 = trim($arrData[11]);
                            $cellphone2 = trim($arrData[12]);
                            $company_name = trim($arrData[13]);
                            
                            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                if(isset($email) && $email != "") {
                                    $query = "SELECT `email_address` FROM `subscriber` WHERE `email_address` = '$email'";
                                    //echo $query;exit;
                                    $arrData = $cf->getOneData($query);
                                    if($arrData){
                                        $sqlQuery = "UPDATE `subscriber` SET 
                                        `first_name` = '$first_name',
                                        `last_name` = '$last_name',
                                        `email_address` = '$email',
                                        `item_type` = '$item_type',
                                        `contact` = '$contact',
                                        `address1` = '$address1',
                                        `address2` = '$address2',
                                        `city` = '$city',
                                        `state` = '$state',
                                        `zipcode` = '$zipcode',
                                        `country` = '$country',
                                        `cellphone1` = '$cellphone1',
                                        `cellphone2` = '$cellphone2',
                                        `company_name` = '$company_name',
                                        `updated_at` = '$current_date'
                                         WHERE email_address = '$email'";
                                    } else {
                                        $sqlQuery = "INSERT INTO `subscriber` SET 
                                        `first_name` = '$first_name',
                                        `last_name` = '$last_name',
                                        `email_address` = '$email',
                                        `item_type` = '$item_type',
                                        `contact` = '$contact',
                                        `address1` = '$address1',
                                        `address2` = '$address2',
                                        `city` = '$city',
                                        `state` = '$state',
                                        `zipcode` = '$zipcode',
                                        `country` = '$country',
                                        `cellphone1` = '$cellphone1',
                                        `cellphone2` = '$cellphone2',
                                        `company_name` = '$company_name',
                                        `created_at` = '$current_date',
                                        `updated_at` = '$current_date'
                                        ";
                                    }
        
                                    try {
                                        $stmt = $conn->prepare($sqlQuery); 
                                        $stmt->execute();
                                        $message = "CSV Successfully Updated";
                                        $success = 1;
                                        $error = 0;
                                    } catch (PDOException $ex) {
                                        include $theme_path.'controller/logError.php';
                                    }
                                }
                            }
                            
                        }
                }
                fclose($file);
            }
        }
        $response = array("success" => $success,"error" => $error,'message' => $message);
        echo json_encode($response);exit;
    }
}
?>