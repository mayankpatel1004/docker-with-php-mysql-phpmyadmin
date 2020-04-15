<?php
global $cf;
$all_users = array();

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
        'name' => 'email_address',
        'title' => 'E-Mail Address',
        'type' =>'text'
    ),
    array(
        'name' => 'contact',
        'title' => 'Contact Number',
        'type' =>'text'
    ),
    array(
        'name' => 'description',
        'title' => 'Description',
        'type' =>'text'
    ),
    array(
        'name' => 'attachment1',
        'title' => 'Document (If Provide)',
        'type' =>'file'
    ),
    array(
        'name' => 'display_status',
        'type' =>'select',
        'title' => 'Status',
        'options' => array('Y' => 'Active','N' => 'Inactive')
    )
);
?>