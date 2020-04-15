<?php
global $cf;
$all_type = array();
$item_type_string = "";

$sqlUsers = "SELECT DISTINCT(item_type) as item_type FROM `subscriber`";
$arrData = $cf->getData($sqlUsers);
if(isset($arrData) && !empty($arrData)) {
    foreach($arrData as $data){
        $item_type_string .= $data['item_type'].", ";
    }
}

$arrFields = array(
    array(
        'name' => 'subscriber_id',
        'title' => 'ID',
        'type' =>'hidden'
    ),
    array(
        'name' => 'first_name',
        'title' => 'First Name',
        'type' =>'text',
        'value' => ''
    ),
    array(
        'name' => 'last_name',
        'title' => 'Last Name',
        'type' =>'text',
        'value' => ''
    ),
    array(
        'name' => 'item_type',
        'title' => 'Subscriber Type',
        'type' =>'text',
        'value' => 'newsletter'
    ),
    array(
        'name' => 'email_address',
        'title' => 'E-Mail Address',
        'mandatory' => 'Y',
        'validate' => 'email',
        'type' =>'text'
    ),
    array(
        'name' => 'display_status',
        'type' =>'select',
        'title' => 'Status',
        'options' => array('Y' => 'Publish','N' => 'Unpublish')
    ),
);
?>