<?php
require_once $theme_path.'model/Alltasks.php';
class Alltaskscontroller {

    public $model;
    public function __construct(){
        $this->model = new Alltasks();
    }

    public function index() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$cf,$back_session_name,$backend_allow_action_dropdown,$backend_allow_apply_button,$backend_allow_addnew_button;
        //print_r($page_data);
        $cf->checkAdminLogin();
        $item_type = "alltasks";
        $item_alias = "alltasks";
        $sort_type = "asc";
        $sort_by = "task_id";
        $records_per_page = $back_end_rpp;
        $page_no = "1";
        $searchtext = '';
        $sortbytext = '';
        $assigneeid = "";
        $task_status = "";
        $projectid = "";

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

        if(isset($_SESSION[$back_session_name][$item_alias]['task_status']) && $_SESSION[$back_session_name][$item_alias]['task_status'] != ''){
            $task_status = $_SESSION[$back_session_name][$item_alias]['task_status'];
        }

        

        if(isset($_SESSION[$back_session_name][$item_alias]['assigneeid']) && $_SESSION[$back_session_name][$item_alias]['assigneeid'] != ''){
            $assigneeid = $_SESSION[$back_session_name][$item_alias]['assigneeid'];
        }

        if(isset($_SESSION[$back_session_name][$item_alias]['projectid']) && $_SESSION[$back_session_name][$item_alias]['projectid'] != ''){
            $projectid = $_SESSION[$back_session_name][$item_alias]['projectid'];
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
        $columns_header = "Task Name,Project,Priority,Status,Assign To,Created,View,ID";

        $arrAssignees = $this->model->getAssignees();
        $arrProjects = $this->model->getProjects();
        
        $sort_array = array(
            'task_id__asc' => 'Oldest First',
            'task_id__desc' => 'Newest First',
            'assign_to__asc' => 'Assign To Older',
            'assign_to__desc' => 'Assign To Newer',
            'task_name__asc' => 'Name ASC',
            'task_name__desc' =>'Name DESC'
        );
        require $theme_path.'views/alltasks.php';
    }

    public function indexAjax() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data;
        $this->model->getList();
    }

    
    public function getItemalias($task_name){
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$conn;

        $aliastext = preg_replace('~[^\pL\d]+~u', '-', $task_name);
        $aliastext = iconv('utf-8', 'us-ascii//TRANSLIT', $aliastext);
        $aliastext = preg_replace('~[^-\w]+~', '', $aliastext);
        $aliastext = trim($aliastext, '-');
        $aliastext = preg_replace('~-+~', '-', $aliastext);
        $aliastext = strtolower($aliastext);

        $query = "SELECT count(*) as total FROM task WHERE item_alias = '$aliastext'";
        $arrDataCount = $cf->getOneData($query);
        if(isset($arrDataCount['total']) && $arrDataCount['total'] > 0){
            $itemalias = $aliastext . "-1";
            $aliastext = $this->getItemalias($itemalias);
        }
        return $aliastext;
    }

    public function form() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data;
        $item_alias = "alltasks";
        $item_type = "alltasks";
        $id = 0;
        if(isset($page_data['item_alias']) && $page_data['item_alias'] != ''){
            $item_alias = $page_data['item_alias'];
        }
        if(isset($page_data['item_type']) && $page_data['item_type'] != ''){
            $item_type = $page_data['item_type'];
        }
        
        $save_url = $url.$item_alias.'/saveformdata';
        $arrOnedata = array();

        if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0) {
            $id = $_REQUEST['id'];
            $arrOnedata = $this->model->getOnedata($_REQUEST['id']);
        }
        
        require_once($theme_path.'generated_files/'.$item_alias.'.php');
        require $theme_path.'views/alltasksform.php';
    }

    public function view() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data;
        $item_alias = "alltasks";
        $item_type = "alltasks";
        $id = 0;
        if(isset($page_data['item_alias']) && $page_data['item_alias'] != ''){
            $item_alias = $page_data['item_alias'];
        }
        if(isset($page_data['item_type']) && $page_data['item_type'] != ''){
            $item_type = $page_data['item_type'];
        }
        
        $save_url = $url.$item_alias.'/savecommentdata';
        $arrOnedata = array();

        if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0) {
            $id = $_REQUEST['id'];
            $arrOnedata = $this->model->getOnedata($_REQUEST['id']);
            $arrComments = $this->model->getAlltimecard($_REQUEST['id']);
            $arrTaskComments = $this->model->getAlltaskcomments($_REQUEST['id']);
        }
        
        if(isset($_REQUEST['timecard_id']) && $_REQUEST['timecard_id'] > 0) {
            $arrOneTimecard = $this->model->getOneTimecard($_REQUEST['timecard_id']);
        }

        if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete') {
            //print_r($_REQUEST);exit;
            $view_url = $url.$item_alias."/view/?id=".$_REQUEST['id'];
            $device = "";
            if(isset($_REQUEST['device']) && $_REQUEST['device'] == 'Nonweb') {
                $device = $_REQUEST['device'];
            }
            $response = $this->model->deleteTimecard($_REQUEST['timecard_id'],$_REQUEST['action'],$_REQUEST['task_name'],$device);
            if(isset($_REQUEST['device']) && $_REQUEST['device'] == 'Nonweb') {
                $response = array("success" => 1,"error" => 0,'message' => "Record successfully deleted",'values' => array());
                echo json_encode($response);exit;
            }else {
                header("Location:".$view_url);
                exit;
            }
            
        }

        if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'deletecomment') {
            $view_url = $url.$item_alias."/view/?id=".$_REQUEST['id'];
            $device = "";
            if(isset($_REQUEST['device']) && $_REQUEST['device'] == 'Nonweb') {
                $device = $_REQUEST['device'];
            }
            $response = $this->model->deleteTaskcomment($_REQUEST['task_comment_id'],$_REQUEST['action'],$_REQUEST['task_name'],$device);
            if(isset($_REQUEST['device']) && $_REQUEST['device'] == 'Nonweb') {
                $response = array("success" => 1,"error" => 0,'message' => "Record successfully deleted",'values' => array());
                echo json_encode($response);exit;
            }else {
                header("Location:".$view_url);
                exit;
            }
            
        }
        
        
        require_once($theme_path.'generated_files/'.$item_alias.'.php');
        require $theme_path.'views/alltasksview.php';
    }

    public function savecommentdata() {
        // echo "<pre>";
        // print_r($_FILES);
        // print_r($_REQUEST);
        // exit;
        global $conn,$cf,$back_session_name,$theme_path;
        $table_name = 'timecard';
        $validate = array();
        require_once($theme_path.'controller/convertApiDataToRequest.php');
        foreach ($_REQUEST as $field => $value) {
            if ($field == 'PHPSESSID' || $field == '_ga' || $field == '__cfduid' || $field == '_gid' || $field == 'item_alias' || $field == '_gat_gtag_UA_150266819_1') {
                continue;
            } else {
                $querystr .= "`$field`='" . addslashes($value) . "', ";
            }
        }
        if($success == 1) {
            $finalstring = substr($querystr, 0, -2);
            //echo $finalstring;exit;
            $save_request = serialize($_REQUEST);
            if(isset($_REQUEST['timecard_id']) && $_REQUEST['timecard_id'] > 0) {
                $sql = "UPDATE `timecard` SET $finalstring WHERE timecard_id = " . $_REQUEST['timecard_id'];
            } else {
                $sql = "INSERT INTO `timecard` SET $finalstring";
            }
            //echo $sql;exit;
            try {
                $stmt = $conn->prepare($sql); 
                $stmt->execute();
                $success = 1;
                $error = 0;
                $message = "Your record successfully saved.";
                if(isset($_REQUEST['timecard_id']) && $_REQUEST['timecard_id'] > 0) {
                    $lastId = $_REQUEST['timecard_id'];
                    $action = "Timecard Updated";
                } else {
                    $lastId = $conn->lastInsertId();
                    $action = "Timecard Added";
                }
                
                
            } catch (PDOException $ex) {
                include $theme_path.'controller/logError.php';
            }
        }

        if($success == 1) {
            $activity = "INSERT INTO `activity` SET
            `action` = '$action',
            `table_name` = '$table_name',
            `record_id` = '$lastId',
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
            } catch (PDOException $ex) {
                include $theme_path.'controller/logError.php';
            }
        }

        if($success == 1) {
            $activity = "INSERT INTO `task_activity` SET
            `task_id` = '$lastId',
            `task_name` = '".$_REQUEST['task_name']."',
            `task_action` = '$action',
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

    public function saveformdata() {
        // $system_max_post = (int)(ini_get('post_max_size'));
        // $data_max_post = (int) $_SERVER['CONTENT_LENGTH'];
        // error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
        // if($system_max_post < $data_max_post){            
        //     $message = "Max Post allow is $system_max_post MB";
        //     $validate = array();
        //     $response = array("success" => 0,"error" => 1,'message' => $message,'values' => $validate);
        //     echo json_encode($response);exit;
        // }
        // echo "<pre>";
        // print_r($_FILES);
        // print_r($_REQUEST);
        // exit;
        global $conn,$cf,$back_session_name,$theme_path;
        require_once($theme_path.'controller/convertApiDataToRequest.php');
        require_once($theme_path.'getRequestData.php');

        if(isset($_REQUEST['start_date']) && $_REQUEST['start_date'] != '') {
            $_REQUEST['start_date'] = date('Y-m-d h:i:s',strtotime($_REQUEST['start_date']));
        }
        if(isset($_REQUEST['end_date']) && $_REQUEST['end_date'] != '') {
            $_REQUEST['end_date'] = date('Y-m-d h:i:s',strtotime($_REQUEST['end_date']));
        }
        
        $action = "update";
        $table_name = "task";
        $display_status = "Active";
        $token = "";
        $success = 1;
        $error = 0;
        $status = 200;
        $message = "";
        $values = array();
        $_REQUEST['item_alias'] = 'alltasks';
        
        $validate = $cf->validateForm($_REQUEST);
        //print_r($validate);exit;
        if(!empty($validate)){
            $error = 1;
            $success = 0;
            $message = "Please enter all required valid fields.";
        }

        foreach ($_REQUEST as $field => $value) {
            if ($field == 'task_id' || $field == 'PHPSESSID' || $field == '_ga' || $field == '__cfduid' || $field == '_gid' || $field == 'item_alias' || $field == '_gat_gtag_UA_150266819_1') {
                continue;
            } else {
                $querystr .= "`$field`='" . addslashes($value) . "', ";
            }
        }

        if($success == 1) {
            $finalstring = substr($querystr, 0, -2);
            //echo $finalstring;exit;
            $save_request = serialize($_REQUEST);
            if(isset($_REQUEST['task_id']) && $_REQUEST['task_id'] > 0) {
                $sql = "UPDATE `task` SET $finalstring WHERE task_id = " . $_REQUEST['task_id'];
            } else {
                $sql = "INSERT INTO `task` SET $finalstring";
            }
            //echo $sql;exit;
            try {
                $stmt = $conn->prepare($sql); 
                $stmt->execute();
                $success = 1;
                $error = 0;
                $message = "Your record successfully saved.";
            } catch (PDOException $ex) {
                include $theme_path.'controller/logError.php';
            }
            if(isset($_REQUEST['task_id']) && $_REQUEST['task_id'] > 0) {
                $lastId = $_REQUEST['task_id'];
                $action = "Update";
                
            } else {
                $lastId = $conn->lastInsertId();
                $action = "Insert";

                // Email script start //
                $emailBody = $cf->readTemplateFile($theme_path."email/newtaskcreated.php");
                $email = COMPANY_EMAIL;

                $project_name = "";
                $assignee_name = "";
                
                if(isset($_REQUEST['project_id']) && $_REQUEST['project_id'] > 0){
                    $sqlProject = "SELECT * FROM `item_section` WHERE `item_section_id` = '".$_REQUEST['project_id']."'";
                    $arrProject = $cf->getOneData($sqlProject);
                    if(isset($arrProject) && !empty($arrProject)) {
                        $project_name = $arrProject['section_title'];
                    }
                }
                
                if(isset($_REQUEST['assign_to']) && $_REQUEST['assign_to'] > 0) {
                    $sqlAssignee = "SELECT * FROM `users` WHERE `id` = '".$_REQUEST['assign_to']."'";
                    $arrAssignee = $cf->getOneData($sqlAssignee);
                    if(isset($arrAssignee) && !empty($arrAssignee)) {
                        $assignee_name = $arrAssignee['first_name']." ".$arrAssignee['last_name'];
                    }
                }

                require_once $theme_path.'email_fix_keywords.php';
                $subject = $project_name." - "." - New Task Created"." - ".FRONT_APPLICATION_NAME;
                $emailBody = str_replace("#email#", $email, $emailBody);
                $emailBody = str_replace("#subject#", $subject, $emailBody);
                $emailBody = str_replace("#task_name#",$_REQUEST['task_name'],$emailBody);
                $emailBody = str_replace("#project_name#",$project_name,$emailBody);
                $emailBody = str_replace("#task_priority#",$_REQUEST['task_priority'],$emailBody);
                $emailBody = str_replace("#assign_to#",$assignee_name,$emailBody);
                $emailBody = str_replace("#start_date#",date(DATE_FORMAT,strtotime($_REQUEST['start_date'])),$emailBody);
                $emailBody = str_replace("#end_date#",date(DATE_FORMAT,strtotime($_REQUEST['start_date'])),$emailBody);
                $emailBody = str_replace("#task_description#",$_REQUEST['task_description'],$emailBody);
                $email_response = $cf->sentEmail($email,$subject,$emailBody);
                // Email script end //
            }
        }

        //echo $message;exit;
        if($success == 1) {
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
                $stmt = $conn->prepare($activity); 
                $stmt->execute();
                $success = 1;
                $error = 0;
            } catch (PDOException $ex) {
                include $theme_path.'controller/logError.php';
            }
        }

        if($success == 1) {
            $activity = "INSERT INTO `task_activity` SET
            `task_id` = '$lastId',
            `task_name` = '".$_REQUEST['task_name']."',
            `task_action` = '$action',
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

        if($success == 1) {
            if(isset($_FILES['attachment']['name']) && $_FILES['attachment']['name'] != ""){
                $filename = "task_".$lastId."_1_".time()."_".$_FILES['attachment']['name'];
                $filename_tmp = $_FILES['attachment']['tmp_name'];
                move_uploaded_file($filename_tmp,ITEMS_PATH.$filename);
                $sql = "UPDATE `task` SET `attachment` = '$filename' WHERE task_id = ".$lastId;
                //echo $sql;exit;
                try {
                    $stmt = $conn->prepare($sql); 
                    $stmt->execute();
                    $success = 1;
                    $error = 0;
                } catch (PDOException $ex) {
                    include $theme_path.'controller/logError.php';
                }   
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
        $success = 1;
        $error = 0;
        $message = "";
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$conn,$back_session_name;
        require_once($theme_path.'controller/convertApiDataToRequest.php');
        require_once($theme_path.'getRequestData.php');
        $update_action = "update";
        $status_action = "";
        $table_name = "task";
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
                
                    $sqlUpdate = "UPDATE task SET task_status = '".$_REQUEST['action']."' WHERE task_id = '".$id."'";
                    //echo $sqlUpdate."<Br />";
                    $stmt = $conn->prepare($sqlUpdate); 
                    $stmt->execute();
                    $update_action = "Update";
                    $message = "Record Successfully Updated.";
                if($action == 'T') {
                    $sqlUpdate = "UPDATE task SET deleted_status = 'Y',deleted_by = '$login_id',deleted_by_name = '$login_name',deleted_time = NOW(),updated_at = NOW() WHERE task_id = '".$id."'";
                    $stmt = $conn->prepare($sqlUpdate); 
                    $stmt->execute();
                    $update_action = "Delete";
                    if($action == 'T'){
                        $status_action = "Delete";
                    }
                    $message = "Record Successfully Deleted.";
                }

                $record_name = "";
                $query = "SELECT `task_name` FROM `task` WHERE `task_id` = '$id'";
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
                //echo $activity;
                try {
                    $stmt = $conn->prepare($activity); 
                    $stmt->execute();
                    $success = 1;
                    $error = 0;
                } catch (PDOException $ex) {
                    include $theme_path.'controller/logError.php';
                }
                
                if($success == 1) {
                    $action = $update_action." - ".$action;
                    $activity = "INSERT INTO `task_activity` SET
                    `task_id` = '$id',
                    `task_name` = '".$record_name."',
                    `task_action` = '$action',
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

    public function saveComments() {
        
        $token = "";
        $success = 1;
        $error = 0;
        $status = 200;
        $message = "";
        $values = array();
        $validate = array();
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$conn,$back_session_name;
        require_once($theme_path.'controller/convertApiDataToRequest.php');
        $update_action = "Insert";
        $status_action = "Active";
        $table_name = "task_comments";

        $sql = "INSERT INTO `task_comments` SET 
        `task_id` = '".$_REQUEST['task_id']."',
        `task_name` = '".$_REQUEST['task_name']."',
        `comments` = '".$_REQUEST['comments']."',
        `commented_by` = '".$_REQUEST['commented_by']."',
        `commented_by_name` = '".$_REQUEST['commented_by_name']."',
        `created_at` = NOW(),
        `updated_at` = NOW()";
        try {
                $stmt = $conn->prepare($sql); 
                $stmt->execute();
                $success = 1;
                $error = 0;
                $message = "Your record successfully saved.";
            } catch (PDOException $ex) {
                include $theme_path.'controller/logError.php';
            }
            $lastId = $conn->lastInsertId();
            $action = "Insert";

            if($success == 1) {
                $activity = "INSERT INTO `activity` SET
                `action` = '$action',
                `status_action` = '$status_action',
                `table_name` = '$table_name',
                `record_id` = '$lastId',
                `record_name` = '".$_REQUEST['task_name']."',
                `created_by` = '".$_REQUEST['commented_by']."',
                `created_by_name` = '".$_REQUEST['commented_by_name']."',
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

        if($success == 1) {
            $activity = "INSERT INTO `task_activity` SET
            `task_id` = '$lastId',
            `task_name` = '".$_REQUEST['task_name']."',
            `task_action` = '$action',
            `created_by` = '".$_REQUEST['commented_by']."',
            `created_by_name` = '".$_REQUEST['commented_by_name']."',
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

        $response = array("success" => $success,"error" => $error,'message' => $message,'values' => array());
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

    public function updatePriority() {
        $task_name = "";
        $task_id = 0;
        $priority = "";
        $assign_to = 0;
        $success = 1;
        $error = 0;
        $message = "";
        $email = "";
        $validate = array();
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$conn,$back_session_name;
        require_once($theme_path.'controller/convertApiDataToRequest.php');
        require_once($theme_path.'getRequestData.php');
        $update_action = "Insert";
        $status_action = "Active";
        $table_name = "task_comments";
        $user_name = "";

        if(isset($_REQUEST['task_id']) && $_REQUEST['task_id'] != "") {
            $task_id = $_REQUEST['task_id'];
        }
        if(isset($_REQUEST['assign_to']) && $_REQUEST['assign_to'] != "") {
            $assign_to = $_REQUEST['assign_to'];
            $query = "SELECT email,first_name,last_name FROM users WHERE id = '$assign_to'";
            $arrData = $cf->getOneData($query);
            if(isset($arrData['email']) && $arrData['email'] != ""){
                $email = $arrData['email'];
                $user_name = $arrData['first_name']." ".$arrData['last_name'];
            }
        }
        if(isset($_REQUEST['task_name']) && $_REQUEST['task_name'] != "") {
            $task_name = base64_decode($_REQUEST['task_name']);
        }
        if(isset($_REQUEST['priority']) && $_REQUEST['priority'] != "") {
            $priority = $_REQUEST['priority'];
        }

        $task_status = "UPDATE `task` SET
        `task_priority` = '".$priority."',
        `updated_at` = NOW() WHERE task_id = '".$task_id."'";
        try {
            $stmt = $conn->prepare($task_status); 
            $stmt->execute();
            $success = 1;
            $error = 0;
            $message = "Record Successfully Updated.";
        } catch (PDOException $ex) {
            include $theme_path.'controller/logError.php';
        }

        $priority = "Priority - ".$priority;
        $activity = "INSERT INTO `task_activity` SET
        `task_id` = '$task_id',
        `task_name` = '".$task_name."',
        `task_action` = '".$priority."',
        `created_by` = '".$login_id."',
        `created_by_name` = '".$login_name."',
        `created_at` = NOW(),
        `updated_at` = NOW()";
        //echo $activity;exit;
        try {
            $stmt = $conn->prepare($activity); 
            $stmt->execute();
            $success = 1;
            $error = 0;
        } catch (PDOException $ex) {
            include $theme_path.'controller/logError.php';
        }

        if($success == 1 && $email != "") {
            $subject = "Task Priority Updated "." - ".FRONT_APPLICATION_NAME;
            $emailBody = "";
            require_once($theme_path."generated_files/configdata.php");
            $emailBody = $cf->readTemplateFile($theme_path."email/taskpriorityupdated.php");
            $emailBody = str_replace("#sitename#", FRONT_APPLICATION_NAME, $emailBody);
            $emailBody = str_replace("#companyname#", COMPANY_NAME, $emailBody);
            $emailBody = str_replace("#companyaddress#", COMPANY_ADDRESS1, $emailBody);
            $emailBody = str_replace("#companyaddress2#", COMPANY_ADDRESS2, $emailBody);
            $emailBody = str_replace("#companycity#", COMPANY_CITY, $emailBody);
            $emailBody = str_replace("#companystate#", COMPANY_STATE, $emailBody);
            $emailBody = str_replace("#companycountry#", COMPANY_COUNTRY, $emailBody);
            $emailBody = str_replace("#companyzipcode#", COMPANY_ZIPCODE, $emailBody);
            $emailBody = str_replace("#companycontact#", COMPANY_CONTACT_NUMBER, $emailBody);
            $emailBody = str_replace("#companywebsite#", COMPANY_WEBSITE, $emailBody);
            $emailBody = str_replace("#companyemail#", COMPANY_EMAIL, $emailBody);
            $emailBody = str_replace("#logo_url#",$theme_url.'images/logo.png',$emailBody);
            $emailBody = str_replace("#sitename#", FRONT_APPLICATION_NAME, $emailBody);
            $emailBody = str_replace("#email#", $email, $emailBody);
            $emailBody = str_replace("#user_name#", $user_name, $emailBody);
            $emailBody = str_replace("#subject#", $subject, $emailBody);
            $emailBody = str_replace("#task_name#",$task_name,$emailBody);
            $emailBody = str_replace("#task_priority#",$priority,$emailBody);
            $email_response = $cf->sentEmail($email,$subject,$emailBody);
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


    public function updateAssignee() {
        $task_name = "";
        $task_id = 0;
        $priority = "";
        $assign_to = 0;
        $token = "";
        $success = 1;
        $error = 0;
        $status = 200;
        $message = "";
        $values = array();
        $email = "";
        $validate = array();
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$conn,$back_session_name;
        require_once($theme_path.'controller/convertApiDataToRequest.php');
        require_once($theme_path.'getRequestData.php');
        $update_action = "Insert";
        $status_action = "Active";
        $user_name = "";

        if(isset($_REQUEST['task_id']) && $_REQUEST['task_id'] != "") {
            $task_id = $_REQUEST['task_id'];
        }

        if(isset($_REQUEST['assign_to']) && $_REQUEST['assign_to'] != "") {
            $assign_to = $_REQUEST['assign_to'];
            $query = "SELECT email,first_name,last_name FROM users WHERE id = '$assign_to'";
            $arrData = $cf->getOneData($query);
            if(isset($arrData['email']) && $arrData['email'] != ""){
                $email = $arrData['email'];
                $user_name = $arrData['first_name']." ".$arrData['last_name'];
            }
        }
        if(isset($_REQUEST['task_name']) && $_REQUEST['task_name'] != "") {
            $task_name = base64_decode($_REQUEST['task_name']);
        }

        $task_status = "UPDATE `task` SET
        `assign_to` = '".$assign_to."',
        `updated_at` = NOW() WHERE task_id = '".$task_id."'";
        try {
            $stmt = $conn->prepare($task_status); 
            $stmt->execute();
            $success = 1;
            $error = 0;
            $message = "Record Successfully Updated.";
        } catch (PDOException $ex) {
            include $theme_path.'controller/logError.php';
        }

        $assign_to = "Assign To - ".$assign_to;
        $activity = "INSERT INTO `task_activity` SET
        `task_id` = '$task_id',
        `task_name` = '".$task_name."',
        `task_action` = '".$assign_to."',
        `created_by` = '".$login_id."',
        `created_by_name` = '".$login_name."',
        `created_at` = NOW(),
        `updated_at` = NOW()";
        //echo $activity;exit;
        try {
            $stmt = $conn->prepare($activity); 
            $stmt->execute();
            $success = 1;
            $error = 0;
        } catch (PDOException $ex) {
            include $theme_path.'controller/logError.php';
        }

        if($success == 1 && $email != "") {
            $subject = "Task Assigned to you "." - ".FRONT_APPLICATION_NAME;
            $emailBody = "";
            require_once($theme_path."generated_files/configdata.php");
            $emailBody = $cf->readTemplateFile($theme_path."email/taskassigneeupdated.php");
            $emailBody = str_replace("#sitename#", FRONT_APPLICATION_NAME, $emailBody);
            $emailBody = str_replace("#companyname#", COMPANY_NAME, $emailBody);
            $emailBody = str_replace("#companyaddress#", COMPANY_ADDRESS1, $emailBody);
            $emailBody = str_replace("#companyaddress2#", COMPANY_ADDRESS2, $emailBody);
            $emailBody = str_replace("#companycity#", COMPANY_CITY, $emailBody);
            $emailBody = str_replace("#companystate#", COMPANY_STATE, $emailBody);
            $emailBody = str_replace("#companycountry#", COMPANY_COUNTRY, $emailBody);
            $emailBody = str_replace("#companyzipcode#", COMPANY_ZIPCODE, $emailBody);
            $emailBody = str_replace("#companycontact#", COMPANY_CONTACT_NUMBER, $emailBody);
            $emailBody = str_replace("#companywebsite#", COMPANY_WEBSITE, $emailBody);
            $emailBody = str_replace("#companyemail#", COMPANY_EMAIL, $emailBody);
            $emailBody = str_replace("#logo_url#",$theme_url.'images/logo.png',$emailBody);
            $emailBody = str_replace("#sitename#", FRONT_APPLICATION_NAME, $emailBody);
            $emailBody = str_replace("#email#", $email, $emailBody);
            $emailBody = str_replace("#user_name#", $user_name, $emailBody);
            $emailBody = str_replace("#subject#", $subject, $emailBody);
            $emailBody = str_replace("#task_name#",$task_name,$emailBody);
            $emailBody = str_replace("#assign_to#",$user_name,$emailBody);
            $email_response = $cf->sentEmail($email,$subject,$emailBody);
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

    public function fnUpdateTaskStatus() {
        $task_name = "";
        $task_id = 0;
        $priority = "";
        $assign_to = 0;
        $success = 1;
        $error = 0;
        $message = "";
        $email = "";
        $validate = array();
        $task_status = "";
        $token = "";
        $success = 1;
        $error = 0;
        $status = 200;
        $message = "";
        $values = array();
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$conn,$back_session_name;
        require_once($theme_path.'controller/convertApiDataToRequest.php');
        require_once($theme_path.'getRequestData.php');
        $update_action = "Insert";
        $status_action = "Active";
        $user_name = "";

        if(isset($_REQUEST['task_id']) && $_REQUEST['task_id'] != "") {
            $task_id = $_REQUEST['task_id'];
        }
        if(isset($_REQUEST['task_name']) && $_REQUEST['task_name'] != "") {
            $task_name = base64_decode($_REQUEST['task_name']);
        }
        if(isset($_REQUEST['task_status']) && $_REQUEST['task_status'] != "") {
            $task_status = $_REQUEST['task_status'];
        }

        if($task_id > 0) {
            $task_status = "UPDATE `task` SET
            `task_status` = '".$task_status."',
            `updated_at` = NOW() WHERE task_id = '".$task_id."'";
            try {
                $stmt = $conn->prepare($task_status); 
                $stmt->execute();
                $success = 1;
                $error = 0;
                $message = "Record Successfully Updated.";
            } catch (PDOException $ex) {
                include $theme_path.'controller/logError.php';
            }
    
            $task_status = "Status Updated to ".$task_status;
            $activity = "INSERT INTO `task_activity` SET
            `task_id` = '$task_id',
            `task_name` = '".$task_name."',
            `task_action` = '".$task_status."',
            `created_by` = '".$login_id."',
            `created_by_name` = '".$login_name."',
            `created_at` = NOW(),
            `updated_at` = NOW()";
            //echo $activity;exit;
            try {
                $stmt = $conn->prepare($activity); 
                $stmt->execute();
                $success = 1;
                $error = 0;
            } catch (PDOException $ex) {
                include $theme_path.'controller/logError.php';
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

}
?>