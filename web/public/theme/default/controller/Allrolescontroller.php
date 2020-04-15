<?php
require_once $theme_path.'model/Allroles.php';
class Allrolescontroller {

    public $model;
    public function __construct(){
        $this->model = new Allroles();
    }

    public function index() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$cf,$back_session_name,$backend_allow_action_dropdown,$backend_allow_apply_button,$backend_allow_addnew_button;
        //print_r($page_data);
        $cf->checkAdminLogin();
        $item_type = "allroles";
        $item_alias = "allroles";
        $sort_type = "desc";
        $sort_by = "role_id";
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
        $columns_header = "Role,Status,Created,Updated,ID";

        $sort_array = array(
            'role_id__asc' => 'Oldest First',
            'role_id__desc' => 'Newest First',
            'role_title__asc' => 'Title ASC',
            'role_title__desc' =>'Title DESC'
        );
        require $theme_path.'views/allroles.php';
    }

    public function indexAjax() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data;
        $this->model->getList();
    }

    public function form() {    
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data;
        $item_type = "role";
        $item_alias = "allroles";
        $id = 0;
        $save_url = $url.$item_alias.'/saveformdata';
        $arrOnedata = array();
        
        $all_modules = $this->model->getAllmodules();
        if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0) {
            $id = $_REQUEST['id'];
            $arrOnedata = $this->model->getOnedata($_REQUEST['id']);
        }
        
        require_once($theme_path.'generated_files/'.$item_alias.'.php');
        require $theme_path.'views/allrolesform.php';
    }

    

    public function saveformdata() {
        //echo "<pre>";
        //print_r($_FILES);
        //print_r($_REQUEST);
        //exit;
        global $conn,$cf,$back_session_name,$theme_path;
        require_once($theme_path.'controller/convertApiDataToRequest.php');
        require_once($theme_path.'getRequestData.php');
        $table_name = "role";
        $display_status = "Active";
        $token = "";
        $success = 1;
        $error = 0;
        $status = 200;
        $message = "";
        $values = array();
        if(isset($_REQUEST['display_status']) && $_REQUEST['display_status'] != ''){
            if($_REQUEST['display_status'] == 'N'){
                $display_status = 'Inactive';
            }
        }

        $validate = $cf->validateForm($_REQUEST);
        //echo "<pre>";print_r($validate);exit;
        if(!empty($validate)){
            $success = 0;
            $error = 1;
            $message = "Please enter all required valid fields.";
        }

        foreach ($_REQUEST as $field => $value) {
            if ($field == 'role_id' || $field == 'item_type' || $field == 'item_alias' || $field == 'view' || $field == 'add' || $field == 'edit' || $field == 'del'  || $field == 'PHPSESSID' || $field == '_ga' || $field == '__cfduid' || $field == '_gid' || $field == '_gat_gtag_UA_150266819_1') {
                continue;
            } else {
                $querystr .= "`$field`='" . addslashes($value) . "', ";
            }
        }
        $finalstring = substr($querystr, 0, -2);
        //echo $finalstring;exit;

        if($success == 1){
            $save_request = serialize($_REQUEST);
            if(isset($_REQUEST['role_id']) && $_REQUEST['role_id'] > 0) {
                $sql = "UPDATE `role` SET $finalstring WHERE role_id = " . $_REQUEST['role_id'];
                $action = "Update";
            } else {
                $sql = "INSERT INTO `role` SET $finalstring";
                $action = "Insert";
            }
        }

        if($success == 1) {
            try {
                $stmt = $conn->prepare($sql); 
                $stmt->execute();
                if(isset($_REQUEST['role_id']) && $_REQUEST['role_id'] > 0) {
                    $lastId = $_REQUEST['role_id'];
                    $action = "Update";

                    $sqlDelete = "DELETE FROM `role_access` WHERE `role_id` = '" . $lastId . "'";
                    $stmt = $conn->prepare($sqlDelete);
                    $stmt->execute();

                } else {
                    $lastId = $conn->lastInsertId();
                    $action = "Insert";
                }
                $success = 1;
                $error = 0;
                $message = "Your record successfully saved.";
            } catch (PDOException $ex) {
                include $theme_path.'controller/logError.php';
            }

        }
        if($success == 1) {
            if (isset($_REQUEST["view"]) && count($_REQUEST["view"]) > 0):
                foreach ($_REQUEST["view"] as $item_id => $value) :
                    $intRows = $this->model->checkRowexists($item_id,$lastId);
                    if ($intRows > 0) :
                        $sqlUpdate = "UPDATE `role_access` SET `grant_view` = 'Y' WHERE `role_id` = '" .$lastId. "' AND `module_id` = '$item_id'";
                        try {
                            $stmt = $conn->prepare($sqlUpdate); 
                            $stmt->execute();
                            $success = 1;
                            $error = 0;
                            $message = "Your record successfully saved.";
                        } catch (PDOException $ex) {
                            include $theme_path.'controller/logError.php';
                        }
                        
                    else :
                        $sqlUpdate = "INSERT INTO `role_access` SET `grant_view` = 'Y',`role_id` = '" .$lastId. "' , `module_id` = '$item_id',created_at = NOW()";    
                        try {
                            $stmt = $conn->prepare($sqlUpdate); 
                            $stmt->execute();
                            $success = 1;
                            $error = 0;
                            $message = "Your record successfully saved.";
                        } catch (PDOException $ex) {
                            include $theme_path.'controller/logError.php';
                        }
                    endif;
                endforeach;
            endif;
        }

        if($success == 1) {
            if (isset($_REQUEST["edit"]) && count($_REQUEST["edit"]) > 0):
                foreach ($_REQUEST["edit"] as $item_id => $value) :
                    $intRows = $this->model->checkRowexists($item_id,$lastId);
                    if ($intRows > 0) :
                        $sqlUpdate = "UPDATE `role_access` SET `grant_edit` = 'Y' WHERE `role_id` = '" .$lastId. "' AND `module_id` = '$item_id'";
                        try {
                            $stmt = $conn->prepare($sqlUpdate); 
                            $stmt->execute();
                            $success = 1;
                            $error = 0;
                            $message = "Your record successfully saved.";
                        } catch (PDOException $ex) {
                            include $theme_path.'controller/logError.php';
                        }
                    else :
                        $sqlUpdate = "INSERT INTO `role_access` SET `grant_edit` = 'Y', `role_id` = '" .$lastId. "', `module_id` = '$item_id',created_at = NOW()";
                        try {
                            $stmt = $conn->prepare($sqlUpdate); 
                            $stmt->execute();
                            $success = 1;
                            $error = 0;
                            $message = "Your record successfully saved.";
                        } catch (PDOException $ex) {
                            include $theme_path.'controller/logError.php';
                        }
                    endif;
                endforeach;
            endif;
        }

        if($success == 1) {
            if (isset($_REQUEST["add"]) && count($_REQUEST["add"]) > 0):
                foreach ($_REQUEST["add"] as $item_id => $value) :
                    $intRows = $this->model->checkRowexists($item_id,$lastId);
                    if ($intRows > 0) :
                        $sqlUpdate = "UPDATE `role_access` SET `grant_add` = 'Y' WHERE `role_id` = '" .$lastId. "' AND `module_id` = '$item_id'";
                        try {
                            $stmt = $conn->prepare($sqlUpdate); 
                            $stmt->execute();
                            $success = 1;
                            $error = 0;
                            $message = "Your record successfully saved.";
                        } catch (PDOException $ex) {
                            include $theme_path.'controller/logError.php';
                        }
                    else :
                        $sqlUpdate = "INSERT INTO `role_access` SET `grant_add` = 'Y', `role_id` = '" .$lastId. "', `module_id` = '$item_id',created_at = NOW()";
                        try {
                            $stmt = $conn->prepare($sqlUpdate); 
                            $stmt->execute();
                            $success = 1;
                            $error = 0;
                            $message = "Your record successfully saved.";
                        } catch (PDOException $ex) {
                            include $theme_path.'controller/logError.php';
                        }
                    endif;    
                endforeach;
            endif;
        }

        if($success == 1) {
            if (isset($_REQUEST["del"]) && count($_REQUEST["del"]) > 0):
                foreach ($_REQUEST["del"] as $item_id => $value) :
                    $intRows = $this->model->checkRowexists($item_id,$lastId);
                    if ($intRows > 0) :
                        $sqlUpdate = "UPDATE `role_access` SET `grant_delete` = 'Y' WHERE `role_id` = '" .$lastId. "' AND `module_id` = '$item_id'";
                        try {
                            $stmt = $conn->prepare($sqlUpdate); 
                            $stmt->execute();
                            $success = 1;
                            $error = 0;
                            $message = "Your record successfully saved.";
                        } catch (PDOException $ex) {
                            include $theme_path.'controller/logError.php';
                        }
                        
                    else :
                        $sqlUpdate = "INSERT INTO `role_access` SET `grant_delete` = 'Y', `role_id` = '" .$lastId. "', `module_id` = '$item_id',created_at = NOW()";
                        try {
                            $stmt = $conn->prepare($sqlUpdate); 
                            $stmt->execute();
                            $success = 1;
                            $error = 0;
                            $message = "Your record successfully saved.";
                        } catch (PDOException $ex) {
                            include $theme_path.'controller/logError.php';
                        }
                    endif;
                endforeach;
            endif;
        }

        if($success == 1) {
            $activity = "INSERT INTO `activity` SET
            `action` = '$action',
            `status_action` = '$display_status',
            `table_name` = '$table_name',
            `record_id` = '$lastId',
            `record_name` = '".$_REQUEST['role_title']."',
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
            'values' => $validate
        );
        echo json_encode($arrData);exit;
    }

    public function listAction() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$conn,$back_session_name;
        require_once($theme_path.'controller/convertApiDataToRequest.php');
        require_once($theme_path.'getRequestData.php');
        $table_name = "role";
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
                    $sqlUpdate = "UPDATE role SET display_status = '".$action."' WHERE role_id = '".$id."'";
                    $stmt = $conn->prepare($sqlUpdate); 
                    $stmt->execute();
                    $update_action = "Update";
                    if($action == 'Y'){
                        $status_action = "Active";
                    }
                    if($action == 'N'){
                        $status_action = "Inactive";
                    }
                    $message = "Record Successfully Updated.";
                }
                if($action == 'T') {
                    $sqlUpdate = "UPDATE `role` SET `deleted_status` = 'Y',`deleted_by` = '$login_id',deleted_by_name = '$login_name',deleted_time = NOW(),updated_at = NOW() WHERE role_id = '".$id."'";
                    //echo $sqlUpdate;exit;
                    $stmt = $conn->prepare($sqlUpdate); 
                    $stmt->execute();
                    $update_action = "Delete";
                    if($action == 'T'){
                        $status_action = "Delete";
                    }
                    $message = "Record Successfully Deleted.";
                }

                $record_name = "";
                $query = "SELECT `role_title` FROM `role` WHERE `role_id` = '$id'";
                $arrData = $cf->getOneData($query);
                if(isset($arrData) && $arrData != false){
                    $record_name = $arrData['role_title'];
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
                $stmt = $conn->prepare($activity); 
                $stmt->execute();

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
}
?>