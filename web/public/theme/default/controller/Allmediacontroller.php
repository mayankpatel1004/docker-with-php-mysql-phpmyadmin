<?php
require_once $theme_path.'model/Allmedia.php';
class Allmediacontroller {

    public $model;
    public function __construct(){
        $this->model = new Allmedia();
    }

    public function index() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$cf,$back_session_name,$backend_allow_action_dropdown,$backend_allow_apply_button,$backend_allow_addnew_button;
        //print_r($page_data);
        $cf->checkAdminLogin();
        $item_type = "allmedia";
        $item_alias = "allmedia";
        $sort_type = "desc";
        $sort_by = "media_id";
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
        $columns_header = "Name,Attachment,Status,Created,Updated,ID";

        $sort_array = array(
            'subscriber_id__asc' => 'Oldest First',
            'subscriber_id__desc' => 'Newest First',
            'name_address__asc' => 'Name ASC',
            'name_address__desc' =>'Name DESC'
        );
        require $theme_path.'views/allmedia.php';
    }

    public function indexAjax() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data;
        $this->model->getList();
    }

    public function form() {    
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data;
        $item_type = "allmedia";
        $item_alias = "allmedia";
        $id = 0;
        $save_url = $url.$item_type.'/saveformdata';
        $arrOnedata = array();
        
        if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0) {
            $id = $_REQUEST['id'];
            $arrOnedata = $this->model->getOnedata($_REQUEST['id']);
        }

        require_once($theme_path.'generated_files/'.$item_alias.'.php');
        require $theme_path.'views/allmediaform.php';
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
        $table_name = "media";
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

        if(isset($_FILES['attachment']['name']) && $_FILES['attachment']['name'] != ""){
            $filename = time()."_".$_FILES['attachment']['name'];
            $filename_tmp = $_FILES['attachment']['tmp_name'];
            move_uploaded_file($filename_tmp,MEDIA_PATH.$filename);
            $_REQUEST['attachment'] = $filename;
            $_REQUEST['media_extension'] = substr(strrchr($_FILES['attachment']['name'],'.'),1);
        }

        foreach ($_REQUEST as $field => $value) {
            if ($field == 'media_id' || $field == 'item_alias' || $field == 'PHPSESSID' || $field == '_ga' || $field == '__cfduid' || $field == '_gid') {
                continue;
            } else {
                $querystr .= "`$field`='" . addslashes($value) . "', ";
            }
        }
        $finalstring = substr($querystr, 0, -2);
        //echo $finalstring;exit;

        if($success == 1){
            $save_request = serialize($_REQUEST);
            if(isset($_REQUEST['media_id']) && $_REQUEST['media_id'] > 0) {
                $sql = "UPDATE `media` SET $finalstring WHERE media_id = " . $_REQUEST['media_id'];
                $action = "Update";
            } else {
                $sql = "INSERT INTO `media` SET $finalstring";
                $action = "Insert";
            }
            //echo $sql;exit;
            try {
                $stmt = $conn->prepare($sql); 
                $stmt->execute();
                if(isset($_REQUEST['media_id']) && $_REQUEST['media_id'] > 0) {
                    $lastId = $_REQUEST['media_id'];
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
            `record_name` = '".$_REQUEST['name']."',
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
                    $sqlUpdate = "UPDATE media SET display_status = '".$action."' WHERE media_id_id = '".$id."'";
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
                    $sqlUpdate = "UPDATE media_id SET deleted_status = 'Y',deleted_by = '$login_id',deleted_by_name = '$login_name',deleted_time = NOW(),updated_at = NOW() WHERE media_id_id = '".$id."'";
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
                $query = "SELECT `name` FROM `media` WHERE `media_id` = '$id'";
                $arrData = $cf->getOneData($query);
                if(isset($arrData) && $arrData != false){
                    $record_name = $arrData['name'];
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
}
?>