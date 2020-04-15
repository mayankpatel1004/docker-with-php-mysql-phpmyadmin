<?php
require_once $theme_path.'model/Allusers.php';
class Alluserscontroller {

    public $model;
    public function __construct(){
        $this->model = new Allusers();
    }

    public function index() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$conn,$back_session_name,$backend_allow_action_dropdown,$backend_allow_apply_button,$backend_allow_addnew_button;
        //print_r($page_data);
        $cf->checkAdminLogin();
        $item_type = "users";
        $item_alias = "alias";
        $sort_type = "desc";
        $sort_by = "id";
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
        $columns_header = "First Name,Last Name,Email,Role,Status,Created,ID";
        $sort_array = array(
            'id__asc' => 'Oldest First',
            'id__desc' => 'Newest First',
            'email_address__asc' => 'Email ASC',
            'email_address__desc' =>'Email DESC'
        );
        require $theme_path.'views/allusers.php';
    }

    public function indexAjax() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data;
        $this->model->getList();
    }

    public function form() {  
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data;
        $item_type = "users";
        $item_alias = "users";
        $id = 0;

        if(isset($page_data['item_type']) && $page_data['item_type'] != "") {
            $item_type = $page_data['item_type'];
        }
        if(isset($page_data['item_alias']) && $page_data['item_alias'] != "") {
            $item_alias = $page_data['item_alias'];
        }
        
        $save_url = $url.$item_alias.'/saveformdata';
        $arrOnedata = array();
        
        if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0) {
            $id = $_REQUEST['id'];
            $arrOnedata = $this->model->getOnedata($_REQUEST['id']);
        }

        require_once($theme_path.'generated_files/'.$item_alias.'.php');
        require $theme_path.'views/allusersform.php';
    }

    public function saveformdata() {
        // echo "<pre>";
        // print_r($_FILES);
        // print_r($_REQUEST);
        // exit;
        global $conn,$cf,$back_session_name,$theme_path;
        require_once($theme_path.'controller/convertApiDataToRequest.php');
        $querystr = '';
        $success = 1;
        $error = 0;
        $message = "";        
        $save_request = '';
        $save_response = '';
        $table_name = "users";
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
        
        if(isset($_REQUEST['password']) && $_REQUEST['password'] != ''){
            $_REQUEST['password'] = base64_encode($_REQUEST['password']);
        }

        foreach ($_REQUEST as $field => $value) {
            if ($field == 'id' || $field == 'item_type' || $field == 'item_alias' || $field == 'PHPSESSID' || $field == '_ga' || $field == '__cfduid' || $field == '_gid' || $field == '_gat_gtag_UA_150266819_1') {
                    continue;
            } else {
                if($_REQUEST['id'] > 0 && $field == 'email'){
                    continue;    
                } else {
                    $querystr .= "`$field`='" . addslashes($value) . "', ";
                }
            }
        }
        $finalstring = substr($querystr, 0, -2);
        //echo $finalstring;exit;

        if($_REQUEST['id'] == 0 && $success == 1) {
            $response = $this->model->checkEmailaddressExists($_REQUEST['email']);
            if($response != ''){
                $success = 0;
                $error = 1;
                $message = "Email address aleady registered. Please try different.";
            }
        }

        if($success == 1){    
            $save_request = serialize($_REQUEST);
            if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0) {
                $sql = "UPDATE `users` SET $finalstring WHERE id = " . $_REQUEST['id'];
                $action = "Update";
            } else {
                $sql = "INSERT INTO `users` SET $finalstring";
                $action = "Insert";
            }
            //echo $sql;exit;

            try {
                $stmt = $conn->prepare($sql); 
                $stmt->execute();
                $success = 1;
                $error = 0;
                $message = "Your record successfully saved.";
                if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0) {
                    $lastId = $_REQUEST['id'];
                    $action = "Update";
                } else {
                    $lastId = $conn->lastInsertId();
                    $action = "Insert";
                }
            } catch (PDOException $ex) {
                include $theme_path.'controller/logError.php';
            }

            if($success == 1){
                $activity = "INSERT INTO `activity` SET
                `action` = '$action',
                `status_action` = '$display_status',
                `table_name` = '$table_name',
                `record_id` = '$lastId',
                `record_name` = '".$_REQUEST['first_name'].' '.$_REQUEST['last_name']."',
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
                    if(isset($_REQUEST['id']) && $_REQUEST['id'] == 0) {
                        $cf->memberSendregistrationPassword($_REQUEST['email']);
                    }
                } catch (PDOException $ex) {
                    include $theme_path.'controller/logError.php';
                }
            }
        }
        $response = array("success" => $success,"error" => $error,'message' => $message,'values' => $validate);
        $save_response = serialize($response);
        if($save_request != '' && $save_response != '') {
            $response_message = $cf->saveRequests($save_request,$save_response,$table_name,$action,$login_id);
            if($response_message != '') {
                $message = $response_message;
                $success = 0;
                $error = 1;
            }
        }
        $response = array("success" => $success,"error" => $error,'message' => $message,'values' => $validate);
        echo json_encode($response);exit;
    }

    public function listAction() {
        $success = 1;
        $error = 0;
        $message = "";
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$conn,$back_session_name;
        require_once($theme_path.'controller/convertApiDataToRequest.php');
        $table_name = "users";
        if(isset($_SESSION[$back_session_name]['user_id']) && $_SESSION[$back_session_name]['user_id'] > 0){
            $login_id = $_SESSION[$back_session_name]['user_id'];
            $login_name = $_SESSION[$back_session_name]['first_name']." ".$_SESSION[$back_session_name]['last_name'];
        }
        $action = $_REQUEST['action'];
        if(isset($_REQUEST['ids']) && $_REQUEST['ids'] != "") {
            $arrIds = explode(",",$_REQUEST['ids']);
            foreach($arrIds as $id) {
                if($action == 'N' || $action == 'Y') {
                    $sqlUpdate = "UPDATE `users` SET `display_status` = '".$action."' WHERE `id` = '".$id."'";
                    try {
                        $success = 1;
                        $error = 0;
                        $message = "Your record successfully saved.";
                        $stmt = $conn->prepare($sqlUpdate); 
                        $stmt->execute();
                        $update_action = "Update";
                        if($action == 'Y'){
                            $status_action = "Active";
                        }
                        if($action == 'N'){
                            $status_action = "Inactive";
                        }
                    } catch (PDOException $ex) {
                        include $theme_path.'controller/logError.php';
                    }
                }
                if($action == 'T') {
                    if(isset($_SESSION[$back_session_name]['user_id']) && $_SESSION[$back_session_name]['user_id'] != ""){
                        $login_id = $_SESSION[$back_session_name]['user_id'];
                        $login_name = $_SESSION[$back_session_name]['first_name']." ".$_SESSION[$back_session_name]['last_name'];
                    }
                    $sqlUpdate = "UPDATE `users` SET `deleted_status` = 'Y',deleted_by = '$login_id',deleted_by_name = '$login_name',deleted_time = NOW(),updated_at = NOW() WHERE `id` = '".$id."'";

                    try {
                        $stmt = $conn->prepare($sqlUpdate); 
                        $stmt->execute();
                        $update_action = "Delete";
                        if($action == 'T'){
                            $status_action = "Delete";
                        }
                        $success = 1;
                        $error = 0;
                        $message = "Your record successfully saved.";
                    } catch (PDOException $ex) {
                        include $theme_path.'controller/logError.php';
                    }
                }

                $record_name = "";
                $query = "SELECT `first_name`,`last_name` FROM `users` WHERE `id` = '$id'";
                $arrData = $cf->getOneData($query);
                if(isset($arrData) && $arrData != false){
                    $record_name = $arrData['first_name']." ".$arrData['last_name'];
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
                //echo $activity;
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
        $response = array("success" => $success,"error" => $error,'message' => $message);
        echo json_encode($response);exit;
    }
}
?>