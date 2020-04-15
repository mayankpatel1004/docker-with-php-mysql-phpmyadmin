<?php
// Application data start //
global $theme_path,$back_session_name;
$login_id = 0;
$login_name = "";
$success = 1;
$error = 0;
$querystr = '';
$save_request = '';
$save_response = '';
$message = "Your record successfully saved.";
$data = json_decode(file_get_contents('php://input'), true);
if (isset($data) && $data != false) {
    $_REQUEST = $data;
}

if(isset($_SESSION[$back_session_name]['user_id']) && $_SESSION[$back_session_name]['user_id'] > 0){
    $login_id = $_SESSION[$back_session_name]['user_id'];
    $login_name = $_SESSION[$back_session_name]['first_name']." ".$_SESSION[$back_session_name]['last_name'];
}

if(isset($_REQUEST['user_id']) && $_REQUEST['user_id'] > 0){
    $login_id = $_REQUEST['user_id'];
    if(isset($_REQUEST['user_name']) && $_REQUEST['user_name'] != ""){
        $login_name = $_REQUEST['user_name'];
    }
}
require_once($theme_path.'getRequestData.php');
// Application data over //
?>