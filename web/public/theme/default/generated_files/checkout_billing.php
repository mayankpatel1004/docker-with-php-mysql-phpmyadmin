<?php
global $cf,$cart_id;
$customer_id = 0;
if(isset($_SESSION[$front_session_name]['customer_id'])) {
    $customer_id = $_SESSION[$front_session_name]['customer_id'];
    $arrCustomerData = $cf->getCustomerAddress($customer_id);
    //print_r($arrCustomerData);exit;
}

if($cart_id > 0) {
    $arrCustomerData = $cf->getCartBillingData($cart_id);
}

$arrFields = array(
    array(
        'name' => 'billing_first_name',
        'db_column' => 'billing_first_name',
        'title' => 'First Name',
        'type' =>'text',
        'value' => isset($arrCustomerData['first_name']) ? $arrCustomerData['first_name'] : ''
    ),
    array(
        'name' => 'billing_last_name',
        'db_column' => 'billing_last_name',
        'title' => 'Last Name',
        'type' =>'text',
        'value' => isset($arrCustomerData['last_name']) ? $arrCustomerData['last_name'] : ''
    ),
    array(
        'name' => 'billing_address_1',
        'db_column' => 'billing_address_1',
        'title' => 'Address 1',
        'type' =>'text',
        'value' => isset($arrCustomerData['user_address1']) ? $arrCustomerData['user_address1'] : ''
    ),
    array(
        'name' => 'billing_address_2',
        'db_column' => 'billing_address_2',
        'title' => 'Address 2',
        'type' =>'text',
        'value' => isset($arrCustomerData['user_address2']) ? $arrCustomerData['user_address2'] : ''
    ),
    array(
        'name' => 'billing_city',
        'db_column' => 'billing_city',
        'title' => 'City',
        'type' =>'text',
        'value' => isset($arrCustomerData['user_city']) ? $arrCustomerData['user_city'] : ''
    ),
    array(
        'name' => 'billing_state',
        'db_column' => 'billing_state',
        'title' => 'State',
        'type' =>'text',
        'value' => isset($arrCustomerData['user_state']) ? $arrCustomerData['user_state'] : ''
    ),
    array(
        'name' => 'billing_country',
        'db_column' => 'billing_country',
        'title' => 'Country',
        'type' =>'text',
        'value' => isset($arrCustomerData['user_country']) ? $arrCustomerData['user_country'] : ''
    ),
    array(
        'name' => 'billing_zipcode',
        'db_column' => 'billing_zipcode',
        'title' => 'Zipcode',
        'type' =>'text',
        'value' => isset($arrCustomerData['user_zipcode']) ? $arrCustomerData['user_zipcode'] : ''
    ),
    array(
        'name' => 'billing_contact',
        'db_column' => 'billing_contact',
        'title' => 'Contact',
        'type' =>'text',
        'value' => isset($arrCustomerData['contact_number']) ? $arrCustomerData['contact_number'] : ''
    ),
    array(
        'name' => 'billing_email',
        'db_column' => 'billing_email',
        'title' => 'Email',
        'type' =>'text',
        'value' => isset($arrCustomerData['email']) ? $arrCustomerData['email'] : ''
    )
);
?>