<?php
require_once $theme_path.'model/Allitems.php';
class Allitemscontroller {

    public $model;
    public function __construct(){
        $this->model = new Allitems();
    }

    public function index() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$cf,$back_session_name,$backend_allow_action_dropdown,$backend_allow_apply_button,$backend_allow_addnew_button;
        //print_r($page_data);
        $cf->checkAdminLogin();
        $item_type = "allpages";
        $item_alias = "pages";
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
        $columns_header = "Title,Alias,Status,Created,Updated,ID";
        
        $sort_array = array(
            'item_id__asc' => 'Oldest First',
            'item_id__desc' => 'Newest First',
            'item_title__asc' => 'Title ASC',
            'item_title__desc' =>'Title DESC'
        );
        require $theme_path.'views/allitems.php';
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
        $item_alias = "pages";
        $item_type = "pages";
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
            $arrOnedataGallery = $this->model->getAllgallerydata($_REQUEST['id']);
        }
        
        require_once($theme_path.'generated_files/'.$item_alias.'.php');
        require $theme_path.'views/allitemsform.php';
    }

    public function saveformdata() {
        // echo "<pre>";
        // print_r($_FILES);
        // print_r($_REQUEST);
        // exit;
        global $conn,$cf,$back_session_name,$theme_path,$theme_url;
        $item_type = "";
        if(isset($_REQUEST['item_type']) && $_REQUEST['item_type'] != "") {
            $item_type = $_REQUEST['item_type'];
        }
        require_once($theme_path.'controller/convertApiDataToRequest.php');
        //print_r($_REQUEST);exit;

        $_REQUEST['meta_title_length'] = strlen(strip_tags($_REQUEST['item_title']));
        $_REQUEST['meta_description_length'] = strlen(strip_tags($_REQUEST['item_description']));
        if(isset($_REQUEST['meta_title']) && $_REQUEST['meta_title'] != "") {
            $_REQUEST['meta_title_length'] = strlen(strip_tags($_REQUEST['meta_title']));
        }
        if(isset($_REQUEST['meta_description']) && $_REQUEST['meta_description'] != "") {
            $_REQUEST['meta_description_length'] = strlen(strip_tags($_REQUEST['meta_description']));
        }

        if(isset($_REQUEST['published_at']) && $_REQUEST['published_at'] != '') {
            $_REQUEST['published_at'] = date('Y-m-d h:i:s',strtotime($_REQUEST['published_at']));
        }
        if(isset($_REQUEST['published_end_at']) && $_REQUEST['published_end_at'] != '') {
            $_REQUEST['published_end_at'] = date('Y-m-d h:i:s',strtotime($_REQUEST['published_end_at']));
        }
        $action = "update";
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
        //print_r($validate);exit;
        if(!empty($validate)){
            $error = 1;
            $success = 0;
            $message = "Please enter all required valid fields.";
        }

        if(isset($_REQUEST['item_id']) && $_REQUEST['item_id'] == 0) {
            $_REQUEST['item_alias'] = $this->getItemalias($_REQUEST['item_title']);
        }else {
            unset($_REQUEST['item_alias']);
        }
        
        foreach ($_REQUEST as $field => $value) {
            if ($field == 'item_id' || $field == 'PHPSESSID' || $field == '_ga' || $field == '__cfduid' || $field == '_gid' || $field == '_gat_gtag_UA_150266819_1') {
                continue;
            } else {
                $querystr .= "`$field`='" . addslashes($value) . "', ";
            }
        }

        if($success == 1) {
            $finalstring = substr($querystr, 0, -2);
            //echo $finalstring;exit;
            $save_request = serialize($_REQUEST);
            if(isset($_REQUEST['item_id']) && $_REQUEST['item_id'] > 0) {
                $sql = "UPDATE `items` SET $finalstring WHERE item_id = " . $_REQUEST['item_id'];
            } else {
                $sql = "INSERT INTO `items` SET $finalstring";
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
            if(isset($_REQUEST['item_id']) && $_REQUEST['item_id'] > 0) {
                $lastId = $_REQUEST['item_id'];
                $action = "Update";
                
            } else {
                $lastId = $conn->lastInsertId();
                $action = "Insert";    
                $email = COMPANY_EMAIL;
                if($item_type == 'leaves'){
                    $emailBody = $cf->readTemplateFile($theme_path."email/appliedleave.php");
                    $leave_from = date(DATE_FORMAT,strtotime($_REQUEST['published_at']));
                    $leave_to = date(DATE_FORMAT,strtotime($_REQUEST['published_end_at']));
                    $applied_date = date(DATE_FORMAT);
                    $subject = $_REQUEST['meta_title']." Applied Leave on between ".$leave_from.' AND '.$leave_to.' - '.FRONT_APPLICATION_NAME;
                    if($leave_from == $leave_to) {
                        $subject = $_REQUEST['meta_title']." Applied Leave on ".$leave_from." - ".FRONT_APPLICATION_NAME;
                    }
                    $emailBody = str_replace("#logo_url#",$theme_url.'images/logo.png',$emailBody);
                    $emailBody = str_replace("#meta_title#",$_REQUEST['meta_title'],$emailBody);
                    $emailBody = str_replace("#meta_description#",$_REQUEST['meta_description'],$emailBody);
                    $emailBody = str_replace("#applied_date#",$applied_date,$emailBody);
                    $emailBody = str_replace("#published_at#",$leave_from,$emailBody);
                    $emailBody = str_replace("#published_at_end#",$leave_to,$emailBody);
                }
                else {
                    $emailBody = $cf->readTemplateFile($theme_path."email/newitemcreated.php");
                    $subject = " New ".$item_type." Created"." - ".FRONT_APPLICATION_NAME;
                }

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
                $emailBody = str_replace("#email#", $email, $emailBody);
                $emailBody = str_replace("#subject#", $subject, $emailBody);
                $emailBody = str_replace("#item_name#",$_REQUEST['item_title'],$emailBody);
                $emailBody = str_replace("#item_type#",$_REQUEST['item_type'],$emailBody);
                $emailBody = str_replace("#item_description#",$_REQUEST['item_description'],$emailBody);
                //echo $emailBody;exit;
                $email_response = $cf->sentEmail($email,$subject,$emailBody);
            }
        }
        
        //echo $message;exit;
        if($success == 1) {
            $activity = "INSERT INTO `activity` SET
            `action` = '$action',
            `status_action` = '$display_status',
            `table_name` = '$table_name',
            `record_id` = '$lastId',
            `record_name` = '".$_REQUEST['item_title']."',
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
                $sql = "UPDATE `items` SET `file1` = '$filename' WHERE item_id = ".$lastId;
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

        if($success == 1) {
            if(isset($_FILES['file2']['name']) && $_FILES['file2']['name'] != ""){
                $filename = $lastId."_2_".time()."_".$_FILES['file2']['name'];
                $filename_tmp = $_FILES['file2']['tmp_name'];
                move_uploaded_file($filename_tmp,ITEMS_PATH.$filename);
                $sql = "UPDATE `items` SET `file2` = '$filename' WHERE item_id = ".$lastId;
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

        if($success == 1) {
            if(isset($_FILES['file3']['name']) && $_FILES['file3']['name'] != ""){
                $filename = $lastId."_3_".time()."_".$_FILES['file3']['name'];
                $filename_tmp = $_FILES['file3']['tmp_name'];
                move_uploaded_file($filename_tmp,ITEMS_PATH.$filename);
                $sql = "UPDATE `items` SET `file3` = '$filename' WHERE item_id = ".$lastId;
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
        

        if($success == 1) {
            if(isset($_FILES['meta_name']) && count($_FILES['meta_name']) > 0) {
                for($i = 0; $i < 4; $i++) {
                    if(isset($_FILES['meta_name']['name'][$i]) && $_FILES['meta_name']['name'][$i] != ""){
                        $filename = $lastId."_gallery_".$i."_".time()."_".$_FILES['meta_name']['name'][$i];
                        $filename_tmp = $_FILES['meta_name']['tmp_name'][$i];
                        move_uploaded_file($filename_tmp,ITEMS_PATH.$filename);
                        $sql = "INSERT INTO `item_meta` SET `item_id` = '$lastId',`meta_key` = 'gallery',`meta_value` = '$filename'";
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
                    $sqlUpdate = "UPDATE `items` SET display_status = '".$action."' WHERE item_id = '".$id."'";
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
                    $sqlUpdate = "UPDATE items SET deleted_status = 'Y',deleted_by = '$login_id',deleted_by_name = '$login_name',deleted_time = NOW(),updated_at = NOW() WHERE item_id = '".$id."'";
                    $stmt = $conn->prepare($sqlUpdate); 
                    $stmt->execute();
                    $update_action = "Delete";
                    if($action == 'T'){
                        $status_action = "Delete";
                    }
                    $message = "Record Successfully Deleted.";
                }

                $record_name = "";
                $query = "SELECT `item_title` FROM `items` WHERE `item_id` = '$id'";
                $arrData = $cf->getOneData($query);
                if(isset($arrData) && $arrData != false){
                    $record_name = $arrData['item_title'];
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

    public function deleteMeta() {
        global $conn;
        $item_meta_id = '';
        $image_name = '';
        $success = 1;
        $error = 0;
        $message = "";
        if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0){
            $item_meta_id = $_REQUEST['id'];
        }
        if(isset($_REQUEST['image']) && $_REQUEST['image'] != ""){
            $image_name = $_REQUEST['image'];
        }
        if($item_meta_id > 0){
            $delete_meta = "UPDATE `item_meta` SET `deleted_status` = '1',`updated_at` = NOW() WHERE item_meta_id = '".$item_meta_id."'";
            $stmt = $conn->prepare($delete_meta); 
            $stmt->execute();
            $message = "Image successfully deleted";
        }
        $response = array("success" => $success,"error" => $error,'message' => $message);
        echo json_encode($response);exit;
    }
}
?>