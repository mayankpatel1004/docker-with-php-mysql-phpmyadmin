<?php
global $front_session_name,$cf;
$token = "";
if(isset($_SESSION[$front_session_name]['web_token']) && $_SESSION[$front_session_name]['web_token'] != ''){
    $token = $_SESSION[$front_session_name]['web_token'];
}

$customer_id = 0;
$first_name = "";
$last_name = "";
$email = "";
$birth_date = "";
$user_address1 = "";
$user_address2 = "";
$user_city = "";
$user_state = "";
$user_zipcode = "";
$user_country = "";
$contact_number = "";


$sqlQuery = "SELECT * FROM `customers` WHERE `web_token` = '$token'";
$arrData = $cf->getOneData($sqlQuery);
if(isset($arrData) && !empty($arrData)) {
    $customer_id = $arrData['customer_id'];
    $first_name = $arrData['first_name'];
    $last_name = $arrData['last_name'];
    $email = $arrData['email'];
    $birth_date = $arrData['birth_date'];
    $user_address1 = $arrData['user_address1'];
    $user_address2 = $arrData['user_address2'];
    $user_city = $arrData['user_city'];
    $user_state = $arrData['user_state'];
    $user_zipcode = $arrData['user_zipcode'];
    $user_country = $arrData['user_country'];
    $contact_number = $arrData['contact_number'];
}


$arrFields = array(
    array(
        'name' => 'customer_id',
        'title' => 'ID',
        'value' => $customer_id,
        'type' =>'hidden'
    ),
    array(
        'name' => 'first_name',
        'title' => 'First Name',
        'mandatory' => 'Y',
        'value' => $first_name,
        'type' =>'text'
    ),
    array(
        'name' => 'last_name',
        'title' => 'Last Name',
        'value' => $last_name,
        'mandatory' => 'Y',
        'type' =>'text'
    ),
    array(
        'name' => 'email',
        'title' => 'Email Address',
        'mandatory' => 'Y',
        'value' => $email,
        'type' =>'text'
    ),
    array(
        'name' => 'birth_date',
        'title' => 'Birth Date',
        'mandatory' => 'Y',
        'value' => $birth_date,
        'type' =>'date'
    ),
    array(
        'name' => 'user_address1',
        'title' => 'Address1',
        'mandatory' => 'Y',
        'value' => $user_address1,
        'type' =>'text'
    ),
    array(
        'name' => 'user_address2',
        'title' => 'Address 2',
        'value' => $user_address2,
        'type' =>'text'
    ),
    array(
        'name' => 'user_city',
        'title' => 'City',
        'value' => $user_city,
        'mandatory' => 'Y',
        'type' =>'text'
    ),
    array(
        'name' => 'user_state',
        'title' => 'State',
        'value' => $user_state,
        'mandatory' => 'Y',
        'type' =>'text'
    ),
    array(
        'name' => 'user_zipcode',
        'title' => 'Zipcode',
        'mandatory' => 'Y',
        'value' => $user_zipcode,
        'type' =>'text'
    ),
    array(
        'name' => 'user_country',
        'title' => 'Country',
        'value' => $user_country,
        'mandatory' => 'Y',
        'type' =>'text'
    ),
    array(
        'name' => 'contact_number',
        'title' => 'Contact',
        'value' => $contact_number,
        'mandatory' => 'Y',
        'type' =>'text'
    ),
    
);

?>