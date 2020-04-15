<?php
require_once $theme_path.'model/Allforms.php';
class Allformscontroller {

    public $model;
    public function __construct(){
        $this->model = new Allforms();
    }

    public function contact() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$cf,$back_session_name,$backend_allow_action_dropdown,$backend_allow_apply_button,$backend_allow_addnew_button;
        //print_r($page_data);
        $cf->checkAdminLogin();
        $item_type = "allcontact";
        $item_alias = "contact";
        $sort_type = "asc";
        $sort_by = "forms_id";
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
        $reset_url = $url.$item_alias.'/contact/?reset=1';
        $add_url = $url.$item_alias."/form";
        $columns_header = "Name,Email,Subject,Status,Created,Updated,ID";
        
        $sort_array = array(
            'forms_id__asc' => 'Oldest First',
            'forms_id__desc' => 'Newest First',
            'first_name__asc' => 'Name ASC',
            'first_name__desc' =>'Name DESC',
            'email_address__asc' => 'Email ASC',
            'email_address__desc' =>'Email DESC'
        );
        require $theme_path.'views/allforms.php';
    }

    public function indexAjax() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data;
        $this->model->getList();
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

    public function form() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data;
        $item_alias = "allcontacts";
        $item_type = "contact";
        $id = 0;
        //print_r($page_data);
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
        require $theme_path.'views/allformsform.php';
    }

    public function saveformdata() {
        // echo "<pre>";
        // print_r($_FILES);
        // print_r($_REQUEST);
        // exit;

        global $conn,$cf,$back_session_name,$theme_path;
        $querystr = '';
        $success = 1;
        $error = 0;
        $message = "";
        $action = "update";
        $save_request = '';
        $save_response = '';
        $login_id = $_SESSION[$back_session_name]['user_id'];
        $login_name = $_SESSION[$back_session_name]['first_name']." ".$_SESSION[$back_session_name]['last_name'];
        $table_name = "items";
        $display_status = "Active";
        if(isset($_REQUEST['display_status']) && $_REQUEST['display_status'] != '') {
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
            if ($field == 'forms_id' || $field == 'item_alias' || $field == 'PHPSESSID' || $field == '_ga' || $field == '__cfduid') {
                continue;
            } else {
                $querystr .= "`$field`='" . addslashes($value) . "', ";
            }
        }
        $finalstring = substr($querystr, 0, -2);
        //echo $finalstring;exit;

        if($success == 1){
            $save_request = serialize($_REQUEST);
            if(isset($_REQUEST['forms_id']) && $_REQUEST['forms_id'] > 0) {
                $sql = "UPDATE `forms` SET $finalstring WHERE forms_id = " . $_REQUEST['forms_id'];
            } else {
                $sql = "INSERT INTO `forms` SET $finalstring";
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
            if(isset($_REQUEST['forms_id']) && $_REQUEST['forms_id'] > 0) {
                $lastId = $_REQUEST['forms_id'];
                $action = "Update";
                
            } else {
                $lastId = $conn->lastInsertId();
                $action = "Insert";
            }

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
            } catch (PDOException $ex) {
                include $theme_path.'controller/logError.php';
            }
        }
        if($success == 1) {

            if(isset($_FILES['file1']['name']) && $_FILES['file1']['name'] != ""){
                $filename = $lastId."_1_".time()."_".$_FILES['file1']['name'];
                $filename_tmp = $_FILES['file1']['tmp_name'];
                move_uploaded_file($filename_tmp,ITEMS_PATH.$filename);
                $sql = "UPDATE `forms` SET `file1` = '$filename' WHERE forms_id = ".$lastId;
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
            $response_message = $cf->saveRequests($save_request,$save_response,$table_name,$action,$login_id);;
            if($response_message != '') {
                $message = $response_message;
                $success = 0;
                $error = 1;
            }
        }
        echo json_encode($response);exit;
    }

    public function listAction() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$conn,$back_session_name;
        require_once($theme_path.'controller/convertApiDataToRequest.php');
        $update_action = "update";
        $status_action = "";
        $table_name = "items";
        $action = $_REQUEST['action'];
        $token = "";
        $success = 1;
        $error = 0;
        $status = 200;
        $message = "";
        $values = array();
        $login_id = $_SESSION[$back_session_name]['user_id'];
        $login_name = $_SESSION[$back_session_name]['first_name']." ".$_SESSION[$back_session_name]['last_name'];

        if(isset($_REQUEST['ids']) && $_REQUEST['ids'] != "") {
            $arrIds = explode(",",$_REQUEST['ids']);
            foreach($arrIds as $id) {
                if($action == 'N' || $action == 'Y') {
                    $sqlUpdate = "UPDATE `forms` SET display_status = '".$action."' WHERE forms_id = '".$id."'";
                    //echo $sqlUpdate."<Br />";
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
                    $sqlUpdate = "UPDATE forms SET deleted_status = 'Y',deleted_by = '$login_id',deleted_by_name = '$login_name',deleted_time = NOW(),updated_at = NOW() WHERE forms_id = '".$id."'";
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
                $query = "SELECT `first_name`,`last_name` FROM `forms` WHERE `forms_id` = '$id'";
                $arrData = $cf->getOneData($query);
                if(isset($arrData) && $arrData != false){
                    $record_name = $arrData['first_name'].' '.$arrData['last_name'];
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