<?php
global $front_session_name,$cf;
$token = "";
if(isset($_SESSION[$front_session_name]['web_token']) && $_SESSION[$front_session_name]['web_token'] != ''){
    $token = $_SESSION[$front_session_name]['web_token'];
}

$customer_id = 0;

$sqlQuery = "SELECT `customer_id` FROM `customers` WHERE `web_token` = '$token'";
$arrData = $cf->getOneData($sqlQuery);
if(isset($arrData) && !empty($arrData)) {
    $customer_id = $arrData['customer_id'];
}


$arrFields = array(
    array(
        'name' => 'customer_id',
        'title' => 'ID',
        'value' => $customer_id,
        'type' =>'hidden'
    ),
    array(
        'name' => 'password',
        'title' => 'New Password',
        'mandatory' => 'Y',
        'type' =>'text'
    ),
    array(
        'name' => 'cpassword',
        'title' => 'Confirm New Password',
        'mandatory' => 'Y',
        'type' =>'text'
    ),
    
);

?>