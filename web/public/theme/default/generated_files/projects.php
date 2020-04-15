<?php

global $cf;
$client_category = array();
$all_users = array();

$sqlClients = "SELECT `section_title`,`item_section_id`  FROM `item_section` WHERE `item_type` = 'clients' AND `display_status` = 'Y' AND `deleted_status` = 'N' ORDER BY `item_section_id` ASC";
$arrData = $cf->getData($sqlClients);
if(isset($arrData) && !empty($arrData)) {
    $client_category[] = 'Select Client';
    foreach($arrData as $data){
        $client_category[$data['item_section_id']] = $data['section_title'];
    }
}

$sqlUsers = "SELECT * FROM `users` WHERE role_id = '4' AND `display_status` = 'Y' AND `blocked` = 'N' AND `deleted_status` = 'N' ORDER BY id ASC";
$arrData = $cf->getData($sqlUsers);
if(isset($arrData) && !empty($arrData)) {
        $all_users[''] = "Select Client";
    foreach($arrData as $data){
        $all_users[$data['id']] = $data['first_name'].' '.$data['last_name'];
    }
}

$arrFields = array(
    array(
        'name' => 'item_section_id',
        'title' => 'ID',
        'type' =>'hidden'
    ),
    array(
        'name' => 'section_alias',
        'title' => 'Alias',
        'mandatory' => 'Y',
        'type' =>'hidden'
    ),
    array(
        'name' => 'section_title',
        'title' => 'Name',
        'mandatory' => 'Y',
        'type' =>'text'
    ),
    array(
        'name' => 'user_id',
        'type' =>'select',
        'title' => 'Select Client Account ',
        'mandatory' => 'Y',
        'options' => $all_users
    ),
    array(
        'name' => 'item_section_parent_id',
        'type' =>'select',
        'title' => 'Client',
        'options' => $client_category
    ),
    array(
        'name' => 'display_status',
        'type' =>'select',
        'title' => 'Status',
        'options' => array('Y' => 'Active','N' => 'Inactive')
    ),
    array(
        'name' => 'description',
        'title' => 'Description',
        'type' =>'textarea'
    )
    
);

?>