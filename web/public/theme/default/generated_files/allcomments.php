<?php

global $cf;
$all_items = array();
$sqlItems = "SELECT `item_id`,`item_title`  FROM `items` WHERE `item_type` = 'blogs' AND `admin_module` = 'N' AND `display_status` = 'Y' AND `deleted_status` = 'N' ORDER BY `item_id` ASC";
$arrData = $cf->getData($sqlItems);
if(isset($arrData) && !empty($arrData)) {
    foreach($arrData as $data){
        $all_items[$data['item_id']] = $data['item_title'];
    }
}

$arrFields = array(
    array(
        'name' => 'forms_id',
        'title' => 'ID',
        'type' =>'hidden'
    ),
    array(
        'name' => 'first_name',
        'title' => 'First Name',
        'mandatory' => 'Y',
        'type' =>'text'
    ),
    array(
        'name' => 'last_name',
        'title' => 'Last Name',
        'mandatory' => 'Y',
        'type' =>'text'
    ),
    array(
        'name' => 'email_address',
        'title' => 'E-Mail Address',
        'mandatory' => 'Y',
        'validate' => 'email',
        'type' =>'text'
    ),
    array(
        'name' => 'subject',
        'title' => 'Subject',
        'mandatory' => 'Y',
        'type' =>'text'
    ),
    array(
        'name' => 'item_id',
        'type' =>'select',
        'title' => 'Item',
        'options' => $all_items
    ),
    array(
        'name' => 'display_status',
        'type' =>'select',
        'title' => 'Status',
        'options' => array('Y' => 'Active','N' => 'Inactive')
    ),
    array(
        'name' => 'message',
        'title' => 'Message',
        'mandatory' => 'Y',
        'type' =>'textarea'
    ),
);
?>