<?php
require_once $theme_path.'model/Alltimecard.php';
class Alltimecardcontroller {

    public $model;
    public function __construct(){
        $this->model = new Alltimecard();
    }

    public function index() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$cf,$back_session_name,$backend_allow_action_dropdown,$backend_allow_apply_button,$backend_allow_addnew_button;
        $cf->checkAdminLogin();
        $item_type = "allsections";
        $item_alias = "blogs";
        $sort_type = "asc";
        $sort_by = "timecard_id";
        $records_per_page = $back_end_rpp;
        $page_no = "1";
        $searchtext = '';
        $sortbytext = '';

        if(isset($page_data['item_alias']) && $page_data['item_alias'] != ''){
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
        $columns_header = "Task,Comment,Hours,Date,User,ID";
        
        $sort_array = array(
            'timecard_id__asc' => 'Oldest First',
            'timecard_id__desc' => 'Newest First',
            'section_title__asc' => 'Title ASC',
            'section_title__desc' =>'Title DESC'
        );


        require $theme_path.'views/alltimecard.php';
    }

    public function indexAjax() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data;
        $this->model->getList();
    }
    
    public function form() {    
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data;
        $item_type = "alltimecard";
        $item_alias = "alltimecard";
        $id = 0;
        $save_url = $url.$item_type.'/saveformdata';
        $arrOnedata = array();
        
        if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0) {
            $id = $_REQUEST['id'];
            $arrOnedata = $this->model->getOnedata($_REQUEST['id']);
        }

        require_once($theme_path.'generated_files/'.$item_alias.'.php');
        require $theme_path.'views/alltimecardform.php';
    }

    public function saveformdata() {
        global $conn,$cf,$back_session_name,$theme_path;
        $user_name = "";
        $task_name = "";
        $token = "";
        $success = 1;
        $error = 0;
        $status = 200;
        $message = "";
        $values = array();
        require_once($theme_path.'controller/convertApiDataToRequest.php');
        require_once($theme_path.'getRequestData.php');
        // echo "<pre>";
        // print_r($_FILES);
        // print_r($_REQUEST);
        // exit;
        
        $table_name = "timecard";
        $display_status = "Active";
        
        if(isset($_REQUEST['user_id']) && $_REQUEST['user_id'] > 0){
            $query = "SELECT first_name,last_name FROM `users` WHERE `id` = ".$_REQUEST['user_id'];
            $arrUserData = $cf->getOneData($query);
            if(isset($arrUserData) && $arrUserData != false) {
                $user_name = $arrUserData['first_name']." ".$arrUserData['last_name'];
                $_REQUEST['user_name'] = $user_name;
            }
        }
        
        if(isset($_REQUEST['task_id']) && $_REQUEST['task_id'] > 0){
            $query2 = "SELECT task_name FROM `task` WHERE `task_id` = ".$_REQUEST['task_id'];
            $arrTaskData = $cf->getOneData($query2);
            if(isset($arrTaskData) && $arrTaskData != false) {
                $task_name = $arrTaskData['task_name'];
                $_REQUEST['task_name'] = $task_name;
            }
        }

        $validate = $cf->validateForm($_REQUEST);
        if(!empty($validate)){
            $success = 0;
            $error = 1;
            $message = "Please enter all required valid fields.";
        }

        $day = date('D', strtotime($_REQUEST['timecard_date']));
        if(isset($day) && $day != ""){
            $_REQUEST['is_weekend'] = 'N';
            if($day == 'Sat' || $day == 'Sun'){
                $_REQUEST['is_weekend'] = 'Y';
            }
        }
        

        foreach ($_REQUEST as $field => $value) {
            if ($field == 'timcard_id' || $field == 'item_type' || $field == 'item_alias' || $field == 'PHPSESSID' || $field == '_ga' || $field == '__cfduid' || $field == '_gid' || $field == '_gat_gtag_UA_150266819_1') {
                continue;
            } else {
                $querystr .= "`$field`='" . addslashes($value) . "', ";
            }
        }
        $finalstring = substr($querystr, 0, -2);
        //echo $finalstring;exit;

        if($success == 1){
            $save_request = serialize($_REQUEST);
            if(isset($_REQUEST['timecard_id']) && $_REQUEST['timecard_id'] > 0) {
                $sql = "UPDATE `timecard` SET $finalstring WHERE timecard_id = " . $_REQUEST['timecard_id'];
                $action = "Update";
            } else {
                $sql = "INSERT INTO `timecard` SET $finalstring";
                $action = "Insert";
            }
            //echo $sql;exit;
            try {
                $stmt = $conn->prepare($sql); 
                $stmt->execute();
                if(isset($_REQUEST['timecard_id']) && $_REQUEST['timecard_id'] > 0) {
                    $lastId = $_REQUEST['timecard_id'];
                    $action = "Update";
                } else {
                    $lastId = $conn->lastInsertId();
                    $action = "Insert";    
                }
                $success = 1;
                $error = 0;
                $message = "Record Successfully Updated.";
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
            `record_name` = '".$_REQUEST['task_name']."',
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
        $response = array("success" => $success,"error" => $error,'message' => $message,'values' => $validate);
        echo json_encode($response);exit;
    }

    public function listAction() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$conn,$back_session_name;
        require_once($theme_path.'controller/convertApiDataToRequest.php');
        require_once($theme_path.'getRequestData.php');
        $action = $_REQUEST['action'];
        $table_name = "timecard";
        $update_action = "Status Updated";
        $status_action = $action;
        $token = "";
        $success = 1;
        $error = 0;
        $status = 200;
        $message = "";
        $values = array();
        
        if(isset($_REQUEST['ids']) && $_REQUEST['ids'] != "") {
            $arrIds = explode(",",$_REQUEST['ids']);
            foreach($arrIds as $id) {

                if($action == 'T') {
                    $sqlUpdate = "UPDATE timecard SET deleted_status = 'Y',deleted_by = '$login_id',deleted_by_name = '$login_name',deleted_time = NOW(),updated_at = NOW() WHERE timecard_id = '".$id."'";
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
                $query = "SELECT `task_name` FROM `timecard` WHERE `timecard_id` = '$id'";
                $arrData = $cf->getOneData($query);
                if(isset($arrData) && $arrData != false){
                    $record_name = $arrData['task_name'];
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

                $activity = "INSERT INTO `task_activity` SET
                `task_id` = '$id',
                `task_name` = '".$record_name."',
                `task_action` = '$update_action',
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

    public function getTasks() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$conn,$back_session_name;
        require_once($theme_path.'controller/convertApiDataToRequest.php');
        $table_name = "items";
        $project_id = 0;
        $string = "";
        $token = "";
        $success = 1;
        $error = 0;
        $status = 200;
        $message = "";
        $values = array();
        if(isset($_REQUEST['project_id']) && $_REQUEST['project_id'] > 0) {
            $project_id = $_REQUEST['project_id'];
        }

        $query = "SELECT * FROM `task` WHERE `project_id` = '$project_id'";
        $arrData = $cf->getData($query);
        if(isset($arrData) && $arrData != false){
            $string .= "<option value=''>Select Option</option>";
            foreach($arrData as $data) {
                $string .= "<option value='".$data['task_id']."'>".$data['task_name']."</option>";
            }
        }

        $arrData = array(
            'token' => $token,
            'success' => $success,
            'error' => $error,
            'status' => $status,
            'message' => $message,
            'values' => $string
        );
        echo json_encode($arrData);exit;
    }

    public function updateTask() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$conn,$back_session_name;
        require_once($theme_path.'controller/convertApiDataToRequest.php');
        require_once($theme_path.'getRequestData.php');
        $table_name = "timecard";
        $success = 1;
        $error = 0;
        $update_action = "";
        $status_action = "";
        $token = "";
        $success = 1;
        $error = 0;
        $status = 200;
        $message = "";
        $values = array();
        //print_r($_REQUEST);exit;
        $timecard_date = date("Y-m-d",strtotime($_REQUEST['timecard_date']));
        $day = date('D', strtotime($_REQUEST['timecard_date']));
        $is_weekend = 'N';
        if($day == 'Sat' || $day == 'Sun'){
            $is_weekend = 'Y';
        }
        $sqlUpdate = "UPDATE timecard SET 
        `task_comment` = '".$_REQUEST['comments']."',
        `is_weekend` = '".$is_weekend."',
        `timecard_date` = '".$timecard_date."',
        `hours` = '".$_REQUEST['hours']."',
        `updated_at` = NOW()
        WHERE timecard_id = '".$_REQUEST['timecard_id']."'";
        try {
            $stmt = $conn->prepare($sqlUpdate); 
            $stmt->execute();
            $update_action = "Update";
            $status_action = "Update";
            $success = 1;
            $error = 0;
            $message = "Timecard successfully Updated.";
        } catch (PDOException $ex) {
            include $theme_path.'controller/logError.php';
        }
        
        
        $activity = "INSERT INTO `activity` SET
            `action` = '$update_action',
            `status_action` = '$status_action',
            `table_name` = '$table_name',
            `record_id` = '".$_REQUEST['timecard_id']."',
            `record_name` = '".$_REQUEST['task_name']."',
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