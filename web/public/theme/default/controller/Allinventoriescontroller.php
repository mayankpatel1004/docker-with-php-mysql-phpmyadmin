<?php
require_once $theme_path.'model/Allinventories.php';
class allinventoriescontroller {

    public $model;
    public function __construct(){
        $this->model = new Allinventories();
    }

    public function index() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$cf,$back_session_name,$backend_allow_action_dropdown,$backend_allow_apply_button,$backend_allow_addnew_button;
        //print_r($page_data);
        $cf->checkAdminLogin();
        $item_type = "allinventories";
        $item_alias = "allinventories";
        $sort_type = "desc";
        $sort_by = "inventory_id";
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
        $columns_header = "Title,Total,Unit,Price,Partial,GST,PO No.,Consume,Bill,Attachment,Status,Created";

        $sort_array = array(
            'inventory_id__asc' => 'Oldest First',
            'inventory_id__desc' => 'Newest First',
            'item_title__asc' => 'Title ASC',
            'item_title__desc' =>'Title DESC',
            'unit__asc' => 'Unit Asc',
            'unit__desc' => 'Unit DESC'
        );
        require $theme_path.'views/allinventories.php';
    }

    public function dispatchimtems() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data;
        $cf->checkAdminLogin();
        $item_type = "allinventories";
        $item_alias = "allinventories";
        $id = 0;
        $save_url = $url.$item_type.'/saveinventoriesdispatchformdata';
        $arrOnedata = array();
        
        if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0) {
            $id = $_REQUEST['id'];
            $arrOnedata = $this->model->getOnedata($_REQUEST['id']);
        }

        require_once($theme_path.'generated_files/'.$item_alias.'.php');
        require $theme_path.'views/dispatchimtems.php';
    }

    public function inventorystock() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data;
        $cf->checkAdminLogin();
        $item_type = "allinventories";
        $item_alias = "allinventories";
        $id = 0;
        $save_url = $url.$item_type.'/saveinventoriesformdata';
        $arrOnedata = array();
        
        if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0) {
            $id = $_REQUEST['id'];
            $arrOnedata = $this->model->getOnedata($_REQUEST['id']);
        }

        require_once($theme_path.'generated_files/'.$item_alias.'.php');
        require $theme_path.'views/allinventoriesstock.php';
    }

    public function indexAjax() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data;
        $cf->checkAdminLogin();
        $this->model->getList();
    }

    public function indexdispatchAjax() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data;
        $cf->checkAdminLogin();
        $this->model->getDispatchList();
    }

    public function form() {   
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data;
        $cf->checkAdminLogin();
        $item_type = "allinventories";
        $item_alias = "allinventories";
        $id = 0;
        $save_url = $url.$item_type.'/saveformdata';
        $arrOnedata = array();
        
        if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0) {
            $id = $_REQUEST['id'];
            $arrOnedata = $this->model->getOnedata($_REQUEST['id']);
        }

        require_once($theme_path.'generated_files/'.$item_alias.'.php');
        require $theme_path.'views/allinventoriesform.php';
    }

    public function getItemalias($item_title){
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$conn;

        $aliastext = preg_replace('~[^\pL\d]+~u', '-', $item_title);
        $aliastext = iconv('utf-8', 'us-ascii//TRANSLIT', $aliastext);
        $aliastext = preg_replace('~[^-\w]+~', '', $aliastext);
        $aliastext = trim($aliastext, '-');
        $aliastext = preg_replace('~-+~', '-', $aliastext);
        $aliastext = strtolower($aliastext);

        $query = "SELECT count(*) as total FROM `inv_inventories` WHERE items_alias = '$aliastext'";
        $arrDataCount = $cf->getOneData($query);
        if(isset($arrDataCount['total']) && $arrDataCount['total'] > 0){
            $itemalias = $aliastext . "-1";
            $aliastext = $this->getItemalias($itemalias);
        }
        return $aliastext;
    }

    public function saveformdata() {
        global $conn,$cf,$back_session_name,$theme_path;
        $cf->checkAdminLogin();
        require_once($theme_path.'controller/convertApiDataToRequest.php');
        require_once($theme_path.'getRequestData.php');
        // echo "<pre>";
        // print_r($_FILES);
        // print_r($_REQUEST);
        // exit;
        $_REQUEST['total_item_size'] = $_REQUEST['total_items'] * $_REQUEST['item_size'];
        $token = "";
        $success = 1;
        $error = 0;
        $status = 200;
        $message = "";
        $values = array();
        $table_name = "inv_inventories";
        $display_status = "Active";
        if(isset($_REQUEST['display_status']) && $_REQUEST['display_status'] != ''){
            if($_REQUEST['display_status'] == 'N'){
                $display_status = 'Inactive';
            }    
        }
        $validate = $cf->validateForm($_REQUEST);

        if(isset($_REQUEST['inventory_id']) && $_REQUEST['inventory_id'] == 0) {
            $_REQUEST['items_alias'] = $this->getItemalias($_REQUEST['item_title']);
            $_REQUEST['total_item_size'] = $_REQUEST['total_item'] * $_REQUEST['item_size'];

            if(isset($_REQUEST['item_price']) && $_REQUEST['item_price'] > 0) {
                $_REQUEST['item_price_with_quantity'] = $_REQUEST['item_price'] * $_REQUEST['total_item'];
            }
        } else {
            unset($_REQUEST['items_alias']);
        }
        if(isset($_FILES['attachment']['name']) && $_FILES['attachment']['name'] != ""){
            $filename = "attachment_".time()."_".$_FILES['attachment']['name'];
            $filename_tmp = $_FILES['attachment']['tmp_name'];
            move_uploaded_file($filename_tmp,ITEMS_PATH.$filename);
            $_REQUEST['attachment'] = $filename;
        }

        if(isset($_FILES['bill_picture']['name']) && $_FILES['bill_picture']['name'] != ""){
            $filename2 = "bill_picture_".time()."_".$_FILES['bill_picture']['name'];
            $filename_tmp2 = $_FILES['bill_picture']['tmp_name'];
            move_uploaded_file($filename_tmp2,ITEMS_PATH.$filename2);
            $_REQUEST['bill_picture'] = $filename2;
        }

        if(!empty($validate)){
            $success = 0;
            $error = 1;
            $message = "Please enter all required valid fields.";
        }

        foreach ($_REQUEST as $field => $value) {
            if ($field == 'inventory_id' || $field == 'item_alias' || $field == 'PHPSESSID' || $field == '_ga' || $field == '__cfduid') {
                continue;
            } else {
                $querystr .= "`$field`='" . addslashes($value) . "', ";
            }
        }
        $finalstring = substr($querystr, 0, -2);
        //echo $finalstring;exit;

        if($success == 1){
            $save_request = serialize($_REQUEST);
            if(isset($_REQUEST['inventory_id']) && $_REQUEST['inventory_id'] > 0) {
                $sql = "UPDATE `inv_inventories` SET $finalstring WHERE inventory_id = " . $_REQUEST['inventory_id'];
                $action = "Update";
            } else {
                $sql = "INSERT INTO `inv_inventories` SET $finalstring";
                $action = "Insert";
            }
            //echo $sql;exit;
            try {
                $stmt = $conn->prepare($sql); 
                $stmt->execute();
                if(isset($_REQUEST['inventory_id']) && $_REQUEST['inventory_id'] > 0) {
                    $lastId = $_REQUEST['inventory_id'];
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

                    // INSERT to Stock //
                    $bill_attachment = "";
                    $bill_picture = "";
                    if(isset($_REQUEST['attachment']) && $_REQUEST['attachment'] != ""){
                        $bill_attachment = $_REQUEST['attachment'];
                    }
                    if(isset($_REQUEST['bill_picture']) && $_REQUEST['bill_picture'] != ""){
                        $bill_picture = $_REQUEST['bill_picture'];
                    }
                    $sqlInsert = "INSERT INTO inv_inventories_activities SET 
                    inventory_id = '".$lastId."',
                    item_title = '".$_REQUEST['item_title']."',
                    operation = 'Insert',
                    item_price = '".$_REQUEST['item_price']."',
                    item_size = '".$_REQUEST['item_size']."',
                    total_items = '".$_REQUEST['total_item']."',
                    total_price_with_qty = '".$_REQUEST['item_price_with_quantity']."',
                    is_partial = '".$_REQUEST['is_partial']."',
                    item_unit = '".$_REQUEST['item_unit']."',
                    attachment = '".$bill_attachment."',
                    po_number = '".$_REQUEST['po_number']."',
                    bill_picture = '".$bill_picture."',
                    created_by = '".$_REQUEST['created_by']."',
                    created_by_name = '".$_REQUEST['created_by_name']."',
                    created_at = NOW()";
                    $stmt = $conn->prepare($sqlInsert); 
                    $stmt->execute();

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
            `record_name` = '".$_REQUEST['item_title']."',
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
        $cf->checkAdminLogin();
        require_once($theme_path.'controller/convertApiDataToRequest.php');
        require_once($theme_path.'getRequestData.php');
        $table_name = "inv_inventories";
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
                    $sqlUpdate = "UPDATE `inv_inventories` SET display_status = '".$action."' WHERE inventory_id = '".$id."'";
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
                    $sqlUpdate = "UPDATE `inv_inventories` SET deleted_status = 'Y',deleted_by = '$login_id',deleted_by_name = '$login_name',deleted_time = NOW(),updated_at = NOW() WHERE inventory_id = '".$id."'";
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
                $query = "SELECT `email_address` FROM `inv_inventories` WHERE `inventory_id` = '$id'";
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

    public function getItemdata(){
        global $cf;
        $cf->checkAdminLogin();
        $item_id = 0;
        $token = "";
        $success = 1;
        $error = 0;
        $status = 200;
        $message = "";
        $total_item_size = "";
        $values = array();
        if(isset($_REQUEST['item_id']) && $_REQUEST['item_id'] > 0) {
            $item_id = $_REQUEST['item_id'];
        }
        if($item_id > 0) {
            $values = $this->model->getOnedata($item_id);
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

    public function saveinventoriesformdata() {
        global $conn,$cf,$back_session_name,$theme_path;
        $cf->checkAdminLogin();
        require_once($theme_path.'controller/convertApiDataToRequest.php');
        require_once($theme_path.'getRequestData.php');
        
        $new_total_item = $_REQUEST['total_items'];
        $operation = $_REQUEST['operation'];
        $_REQUEST['total_item_size'] = $_REQUEST['item_size'];
        if(isset($_REQUEST['total_items_before_entry']) && $_REQUEST['total_items_before_entry'] > 0) {
            if($operation == 'Substraction' || $operation == 'Dispatch' || $operation == 'Damage' || $operation == 'Lost') {
                $new_total_item = $_REQUEST['total_items_before_entry'] - $_REQUEST['total_items'];
            } else {
                $new_total_item = $_REQUEST['total_items'] + $_REQUEST['total_items_before_entry'];
            }
            //echo $new_total_item;
            $_REQUEST['total_item_size'] = $new_total_item * $_REQUEST['item_size'];
        }

        if($_REQUEST['total_items_before_entry'] < $_REQUEST['total_items']) {
            $validate['total_items'] = "temp";
            $values['total_items'] = "You can substract maximum ".$_REQUEST['total_items_before_entry'];
            $success = 0;
            $error = 1;
        }

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
        $table_name = "inv_inventories_activities";
        $display_status = "Active";
        if(isset($_REQUEST['display_status']) && $_REQUEST['display_status'] != ''){
            if($_REQUEST['display_status'] == 'N'){
                $display_status = 'Inactive';
            }    
        }
        $validate = $cf->validateForm($_REQUEST);

        if(isset($_FILES['attachment']['name']) && $_FILES['attachment']['name'] != ""){
            $filename = "attachment_".time()."_".$_FILES['attachment']['name'];
            $filename_tmp = $_FILES['attachment']['tmp_name'];
            move_uploaded_file($filename_tmp,ITEMS_PATH.$filename);
            $_REQUEST['attachment'] = $filename;
        }

        if(isset($_FILES['bill_picture']['name']) && $_FILES['bill_picture']['name'] != ""){
            $filename2 = "bill_picture_".time()."_".$_FILES['bill_picture']['name'];
            $filename_tmp2 = $_FILES['bill_picture']['tmp_name'];
            move_uploaded_file($filename_tmp2,ITEMS_PATH.$filename2);
            $_REQUEST['bill_picture'] = $filename2;
        }

        if(isset($_REQUEST['operation']) && ($_REQUEST['operation'] == 'Substraction' || $_REQUEST['operation'] == 'Dispatch')) {
            $respose = $this->validateExistingQuantity($_REQUEST);
            if(isset($respose) && $respose != "") {
                $validate['total_items'] = "temp";
                $values['total_items'] = $respose;
                $success = 0;
                $error = 1;
            }
        }
        //print_r($validate);
        //print_r($_REQUEST);exit;
        if(!empty($validate)){
            $success = 0;
            $error = 1;
            $message = "Please enter all required valid fields.";
        }

        //print_r($validate);exit;

        if(isset($_REQUEST['total_items']) && $_REQUEST['total_items'] > 0){
            $_REQUEST['total_price_with_qty'] = $_REQUEST['total_items'] * $_REQUEST['item_price'];
        }
        

        foreach ($_REQUEST as $field => $value) {
            if ($field == 'inventories_activities_id' || $field == 'item_alias' || $field == 'PHPSESSID' || $field == '_ga' || $field == '__cfduid') {
                continue;
            } else {
                $querystr .= "`$field`='" . addslashes($value) . "', ";
            }
        }
        $finalstring = substr($querystr, 0, -2);
        //echo $finalstring;exit;

        if($success == 1){
            $save_request = serialize($_REQUEST);
            if(isset($_REQUEST['inventories_activities_id']) && $_REQUEST['inventories_activities_id'] > 0) {
                $sql = "UPDATE `inv_inventories_activities` SET $finalstring WHERE inventory_id = " . $_REQUEST['inventory_id'];
                $action = "Update";
            } else {
                $sql = "INSERT INTO `inv_inventories_activities` SET $finalstring";
                $action = "Insert";
            }
            //echo $sql;exit;
            try {
                $stmt = $conn->prepare($sql); 
                $stmt->execute();
                if(isset($_REQUEST['inventories_activities_id']) && $_REQUEST['inventories_activities_id'] > 0) {
                    $lastId = $_REQUEST['inventories_activities_id'];
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
                    $total_item = $_REQUEST['total_items'];
                    $total_item_size = $_REQUEST['total_item_size'];
                    if($operation == 'Substraction' || $operation == 'Dispatch' || $operation == 'Damage' || $operation == 'Lost') {
                        
                        $queryString = "SELECT is_partial,item_size FROM `inv_inventories` WHERE inventory_id = '".$_REQUEST['inventory_id']."'";
                        $arrExistingData = $cf->getOneData($queryString);
                        if(isset($arrExistingData['is_partial']) && $arrExistingData['is_partial'] == 'Y'){
                            $total_item_size = $arrExistingData['item_size'] * $total_item;
                            $sqlUpdate = "UPDATE `inv_inventories` SET total_item = total_item - $total_item,total_item_size = total_item_size - $total_item_size WHERE inventory_id = '".$_REQUEST['inventory_id']."'";
                        } else {
                            $sqlUpdate = "UPDATE `inv_inventories` SET total_item = total_item - $total_item,total_item_size = '$total_item_size' WHERE inventory_id = '".$_REQUEST['inventory_id']."'";
                        }
                    } else {
                        $queryString = "SELECT is_partial,item_size FROM `inv_inventories` WHERE inventory_id = '".$_REQUEST['inventory_id']."'";
                        $arrExistingData = $cf->getOneData($queryString);
                        if(isset($arrExistingData['is_partial']) && $arrExistingData['is_partial'] == 'Y'){
                            $total_item_size = $arrExistingData['item_size'] * $total_item;
                            $sqlUpdate = "UPDATE `inv_inventories` SET total_item = total_item + $total_item,total_item_size = total_item_size + $total_item_size WHERE inventory_id = '".$_REQUEST['inventory_id']."'";
                        } else {
                            $sqlUpdate = "UPDATE `inv_inventories` SET total_item = total_item + $total_item,total_item_size = '$total_item_size' WHERE inventory_id = '".$_REQUEST['inventory_id']."'";
                        }
                        
                        
                    }
                    //echo $sqlUpdate;exit;
                    $stmt = $conn->prepare($sqlUpdate); 
                    $stmt->execute();
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
            `record_name` = '".$_REQUEST['item_title']."',
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

    public function validateExistingQuantity($request) {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$conn;
        $cf->checkAdminLogin();
        $return = "";
        $query = "SELECT total_item FROM `inv_inventories` WHERE inventory_id = '".$request['inventory_id']."'";
        $arrData = $cf->getOneData($query);
        if(isset($arrData['total_item']) && $arrData['total_item'] > 0){
            if($_REQUEST['total_items'] > $arrData['total_item']) {
                $return = "You can apply maximum ".$arrData['total_item']." from your item.";
            }
        }
        else {
            $return = "You don't have sufficient items in your stock.";
        }
        return $return;
    }

    public function inventoryactivities() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$conn;
        //print_r($page_data);
        $cf->checkAdminLogin();
        $item_type = "inventoryactivities";
        $item_alias = "inventoryactivities";
        $sort_type = "desc";
        $sort_by = "inventories_activities_id";
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

        $page_url = $url.$item_type."/indexAjaxActivities";
        $reset_url = $url.$item_type.'/index/?reset=1';
        $add_url = $url.$item_type."/form";
        $columns_header = "Title,Action,Price,Items,Size,Unit,Partial,Attach,PO No.,Bill Picture,Notes,Created By,Created At";

        $sort_array = array(
            'inventory_id__asc' => 'Oldest First',
            'inventory_id__desc' => 'Newest First',
            'item_title__asc' => 'Title ASC',
            'item_title__desc' =>'Title DESC',
            'item_unit__asc' => 'Unit Asc',
            'item_unit__desc' => 'Unit DESC'
        );
        require $theme_path.'views/allinventoryactivities.php';
    }

    public function indexAjaxActivities() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data;
        $cf->checkAdminLogin();
        $this->model->getListActivities();
    }

    public function saveinventoriesdispatchformdata() {
        global $conn,$cf,$back_session_name,$theme_path;
        $cf->checkAdminLogin();
        require_once($theme_path.'controller/convertApiDataToRequest.php');
        require_once($theme_path.'getRequestData.php');
        // echo "<pre>";
        // print_r($_FILES);
        // print_r($_REQUEST);
        // exit;

        // To reduce total items if size is greater then total size start // 
        if(isset($_REQUEST['total_item_size']) && $_REQUEST['total_item_size'] > 0) {
            if(isset($_REQUEST['item_size']) && $_REQUEST['item_size'] > 0) {
                if($_REQUEST['total_item_size'] > $_REQUEST['item_size']){
                    $_REQUEST['total_items'] = floor($_REQUEST['total_item_size'] / $_REQUEST['item_size']);
                }
            }
        }
        // To reduce total items if size is greater then total size end // 

        $new_total_item = $_REQUEST['total_items'];
        $operation = $_REQUEST['operation'];
        $taken_by_name = "";
        $created_by_name = "";
        $token = "";
        $success = 1;
        $error = 0;
        $status = 200;
        $message = "";
        $values = array();
        $table_name = "inv_inventories_activities";
        $display_status = "Active";
        if(isset($_REQUEST['display_status']) && $_REQUEST['display_status'] != ''){
            if($_REQUEST['display_status'] == 'N'){
                $display_status = 'Inactive';
            } 
        }
        foreach ($_REQUEST as $field => $value) {
            if ($field == 'inventories_activities_id' || $field == 'item_alias' || $field == 'PHPSESSID' || $field == '_ga' || $field == '__cfduid') {
                continue;
            } else {
                $querystr .= "`$field`='" . addslashes($value) . "', ";
            }
        }
        $finalstring = substr($querystr, 0, -2);
        //echo $finalstring;exit;

        if($success == 1){
            $save_request = serialize($_REQUEST);
            $sql = "INSERT INTO `inv_inventories_activities` SET $finalstring";
            //echo $sql;exit;
            try {
                $stmt = $conn->prepare($sql); 
                $stmt->execute();
                $lastId = $conn->lastInsertId();
                $action = "Insert";
                $success = 1;
                $error = 0;
                $message = "Your record successfully saved.";
                $total_item = $_REQUEST['total_items'];
                $total_item_size = $_REQUEST['total_item_size'];
                $sqlUpdate = "UPDATE `inv_inventories` SET total_item = total_item - $total_item,total_item_size = total_item_size -$total_item_size WHERE inventory_id = '".$_REQUEST['inventory_id']."'";
                //echo $sqlUpdate;exit;
                $stmt = $conn->prepare($sqlUpdate); 
                $stmt->execute();

                if(isset($_REQUEST['total_item_size']) && $_REQUEST['total_item_size'] > 0){
                    $sqlUpdate = "UPDATE `inv_inventories` SET total_item = total_item_size/item_size WHERE inventory_id = '".$_REQUEST['inventory_id']."'";
                    $stmt = $conn->prepare($sqlUpdate);
                    $stmt->execute();
                }
                
                $queryStringUsername = "SELECT CONCAT(first_name,' ',last_name) as user_name FROM users WHERE id = '".$_REQUEST['taken_by']."'";
                $arrExistingUserData = $cf->getOneData($queryStringUsername);
                if(isset($arrExistingUserData['user_name']) && $arrExistingUserData['user_name'] != "") {
                    $taken_by_name = $arrExistingUserData['user_name'];
                }

                $queryStringUsernameCreatedBy = "SELECT CONCAT(first_name,' ',last_name) as user_name FROM users WHERE id = '".$_REQUEST['created_by']."'";
                $arrExistingUserDataCreatedBy = $cf->getOneData($queryStringUsernameCreatedBy);
                if(isset($arrExistingUserDataCreatedBy['user_name']) && $arrExistingUserDataCreatedBy['user_name'] != "") {
                    $created_by_name = $arrExistingUserDataCreatedBy['user_name'];
                }
                
                $sqlInsertDispatch = "INSERT INTO inv_dispatched SET 
                inventory_id = '".$_REQUEST['inventory_id']."',
                item_size = '".$_REQUEST['total_item_size']."',
                total_items = '".$_REQUEST['total_items']."',
                is_partial = '".$_REQUEST['is_partial']."',
                item_unit = '".$_REQUEST['item_unit']."',
                taken_by = '".$_REQUEST['taken_by']."',
                taken_by_name = '".$taken_by_name."',
                created_by = '".$_REQUEST['created_by']."',
                created_by_name = '".$created_by_name."',
                created_at = '".$_REQUEST['created_at']."',
                updated_at = '".$_REQUEST['created_at']."'";
                //echo $sqlInsertDispatch;exit;
                $stmt = $conn->prepare($sqlInsertDispatch); 
                $stmt->execute();

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
            `record_name` = '".$_REQUEST['item_title']."',
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

    public function allreturnitems() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$cf,$back_session_name,$backend_allow_action_dropdown,$backend_allow_apply_button,$backend_allow_addnew_button;
        //print_r($page_data);
        $cf->checkAdminLogin();
        $item_type = "allreturnitems";
        $item_alias = "allreturnitems";
        $sort_type = "desc";
        $sort_by = "dispatched_id";
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

        $page_url = $url.$item_type."/indexreturnAjax";
        $reset_url = $url.$item_type.'/allreturnitems/?reset=1';
        $add_url = $url.$item_type."/form";
        $columns_header = "Item,Total,Size,Unit,Partial,Taken By,Dispatch By,Dispatch At";

        $sort_array = array(
            'dispatched_id__asc' => 'Oldest First',
            'dispatched_id__desc' => 'Newest First',
            'item_title__asc' => 'Title ASC',
            'item_title__desc' =>'Title DESC',
            'item_unit__asc' => 'Unit Asc',
            'item_unit__desc' => 'Unit DESC',
            'taken_by_name__asc' => 'Taken By Asc',
            'taken_by_name__desc' => 'Taken By Desc'
        );
        require $theme_path.'views/allreturnitems.php';
    }

    public function indexreturnAjax() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data;
        $cf->checkAdminLogin();
        $this->model->getDispatchReturnList();
    }

    public function savereturnitems() {
        global $conn,$cf,$back_session_name,$theme_path;
        require_once($theme_path.'controller/convertApiDataToRequest.php');
        require_once($theme_path.'getRequestData.php');
        $token = "";
        $success = 1;
        $error = 0;
        $status = 200;
        $message = "";
        $values = array();
        $table_name = "inv_dispatched";
        $item_title = "";
        $item_unit = "";
        $is_partial = "";
        $taken_by = "";
        $taken_by_name = "";
        $item_size = 0;

        $quantity = $_REQUEST['total_size'];
        $dispatch_id = $_REQUEST['dispatch_id'];
        $inventory_id = $_REQUEST['inventory_id'];
        $column_name = $_REQUEST['column_name'];

        $query = "SELECT item_title,item_unit,is_partial,item_size FROM `inv_inventories` WHERE inventory_id = '".$inventory_id."'";
        $arrExistingData = $cf->getOneData($query);
        if(isset($arrExistingData['item_title']) && $arrExistingData['item_title'] != "") {
            $item_title = $arrExistingData['item_title'];
            $item_unit = $arrExistingData['item_unit'];
            $is_partial = $arrExistingData['is_partial'];
            $item_size = $arrExistingData['item_size'];
        }

        $update_inventory_column = "total_item";
        $is_partial = "N";
        if($column_name == 'item_size'){
            $update_inventory_column = "total_item_size";
            $sqlUpdate = "UPDATE `inv_inventories` SET $update_inventory_column = $update_inventory_column + $quantity,total_item = total_item_size/item_size WHERE inventory_id = '".$inventory_id."'";
        } else {
            $sqlUpdate = "UPDATE `inv_inventories` SET $update_inventory_column = $update_inventory_column + $quantity WHERE inventory_id = '".$inventory_id."'";
        }
        try {
            $success = 1;
            $error = 0;
            $stmt = $conn->prepare($sqlUpdate); 
            $stmt->execute();
        } catch (PDOException $ex) {
            $success = 0;
            $error = 1;
            include $theme_path.'controller/logError.php';
        }


        if($success == 1) {    
            $query = "SELECT taken_by,taken_by_name FROM `inv_dispatched` WHERE dispatched_id = '".$dispatch_id."'";
            $arrExistingData = $cf->getOneData($query);
            if(isset($arrExistingData['taken_by']) && $arrExistingData['taken_by'] != "") {
                $taken_by = $arrExistingData['taken_by'];
                $taken_by_name = $arrExistingData['taken_by_name'];
            }

            $sqlUpdateDispatch = "UPDATE `inv_dispatched` SET $column_name = $column_name - $quantity WHERE dispatched_id = '".$dispatch_id."'";
            try {
                $success = 1;
                $error = 0;
                $stmt = $conn->prepare($sqlUpdateDispatch); 
                $stmt->execute();
            } catch (PDOException $ex) {
                $success = 0;
                $error = 1;
                include $theme_path.'controller/logError.php';
            }   
        }

        if($success == 1) {
            $sqlUpdateActivities = "INSERT INTO `inv_inventories_activities` SET 
            `inventory_id` = '$inventory_id',
            `item_title` = '$item_title',
            `operation` = 'Returned',
            `item_size` = '0',
            `total_item_size` = '$quantity',
            `item_price` = '0',
            `total_items` = '$quantity',
            `total_items_before_entry` = '0',
            `total_price_with_qty` = '0',
            `is_partial` = '$is_partial',
            `item_unit` = '$item_unit',
            `taken_by` = '$taken_by',
            `taken_by_name` = '$taken_by_name',
            `created_by` = '$login_id',
            `created_by_name` = '$login_name',
            `created_at` = NOW(),
            `updated_at` = NOW()";
            try {
                $success = 1;
                $error = 0;
                $stmt = $conn->prepare($sqlUpdateActivities); 
                $stmt->execute();
            } catch (PDOException $ex) {
                $success = 0;
                $error = 1;
                include $theme_path.'controller/logError.php';
            }   
        }

        if($success == 1) {
            $note1 = 'Item Taken By '.$taken_by;
            $note2 = 'Item Taken By '.$taken_by_name;
            $activity = "INSERT INTO `activity` SET
            `action` = 'Return Item',
            `status_action` = 'Return',
            `table_name` = 'dispatched',
            `record_id` = '$dispatch_id',
            `record_name` = '".$item_title."',
            `created_by` = $login_id,
            `created_by_name` = '$login_name',
            `note1` = '$note1',
            `note2` = '$note2',
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

        if($success == 1) {    
            // If item size of any inventory is zero + 1 item quantity will added (Which is last quantity) to inventory START //    
            // $sqlCheckDispatch = "SELECT item_size FROM `inventories` WHERE inventory_id = '".$_REQUEST['inventory_id']."'";
            // $arrDispatchedData = $cf->getOneData($sqlCheckDispatch);
            // if(isset($arrDispatchedData['item_size']) && $arrDispatchedData['item_size'] == 0){
            //     $sqlUpdate = "UPDATE `inventories` SET `total_item` = total_item + 1 WHERE inventory_id = '".$_REQUEST['inventory_id']."'";
            //     $stmt = $conn->prepare($sqlUpdate); 
            //     $stmt->execute();
            // }
            // If item size of any inventory is zero + 1 item quantity will added (Which is last quantity) to inventory OVER //    
            
            // $sqlDeleteItems = "DELETE FROM dispatched WHERE item_size = 0 OR total_items = 0";
            // try {
            //     $success = 1;
            //     $error = 0;
            //     $stmt = $conn->prepare($sqlDeleteItems); 
            //     $stmt->execute();
            // } catch (PDOException $ex) {
            //     $success = 0;
            //     $error = 1;
            //     include $theme_path.'controller/logError.php';
            // }   
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

    
}
?>