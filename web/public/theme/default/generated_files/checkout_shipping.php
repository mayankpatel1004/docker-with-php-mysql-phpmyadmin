<?php
global $cf,$cart_id;
$customer_id = 0;
if(isset($_SESSION[$front_session_name]['customer_id'])) {
    $customer_id = $_SESSION[$front_session_name]['customer_id'];
    $arrCustomerData = $cf->getCustomerAddress($customer_id);
    //print_r($arrCustomerData);exit;
}

if($cart_id > 0) {
    $arrCustomerData = $cf->getCartShippingData($cart_id);
}

$arrFields = array(
    array(
        'name' => 'shipping_first_name',
        'db_column' => 'shipping_first_name',
        'title' => 'First Name',
        'type' =>'text',
        'value' => isset($arrCustomerData['first_name']) ? $arrCustomerData['first_name'] : ''
    ),
    array(
        'name' => 'shipping_last_name',
        'db_column' => 'shipping_last_name',
        'title' => 'Last Name',
        'type' =>'text',
        'value' => isset($arrCustomerData['last_name']) ? $arrCustomerData['last_name'] : ''
    ),
    array(
        'name' => 'shipping_address_1',
        'db_column' => 'shipping_address_1',
        'title' => 'Address 1',
        'type' =>'text',
        'value' => isset($arrCustomerData['user_address1']) ? $arrCustomerData['user_address1'] : ''
    ),
    array(
        'name' => 'shipping_address_2',
        'db_column' => 'shipping_address_2',
        'title' => 'Address 2',
        'type' =>'text',
        'value' => isset($arrCustomerData['user_address2']) ? $arrCustomerData['user_address2'] : ''
    ),
    array(
        'name' => 'shipping_city',
        'db_column' => 'shipping_city',
        'title' => 'City',
        'type' =>'text',
        'value' => isset($arrCustomerData['user_city']) ? $arrCustomerData['user_city'] : ''
    ),
    array(
        'name' => 'shipping_state',
        'db_column' => 'shipping_state',
        'title' => 'State',
        'type' =>'text',
        'value' => isset($arrCustomerData['user_state']) ? $arrCustomerData['user_state'] : ''
    ),
    array(
        'name' => 'shipping_country',
        'db_column' => 'shipping_country',
        'title' => 'Country',
        'type' =>'text',
        'value' => isset($arrCustomerData['user_country']) ? $arrCustomerData['user_country'] : ''
    ),
    array(
        'name' => 'shipping_zipcode',
        'db_column' => 'shipping_zipcode',
        'title' => 'Zipcode',
        'type' =>'text',
        'value' => isset($arrCustomerData['user_zipcode']) ? $arrCustomerData['user_zipcode'] : ''
    ),
    array(
        'name' => 'shipping_contact',
        'db_column' => 'shipping_contact',
        'title' => 'Contact',
        'type' =>'text',
        'value' => isset($arrCustomerData['contact_number']) ? $arrCustomerData['contact_number'] : ''
    ),
    array(
        'name' => 'shipping_email',
        'db_column' => 'shipping_email',
        'title' => 'Email',
        'type' =>'text',
        'value' => isset($arrCustomerData['email']) ? $arrCustomerData['email'] : ''
    )
    
);
?>