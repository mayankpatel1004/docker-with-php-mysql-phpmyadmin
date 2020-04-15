<?php
global $cf;
$item_type_string = "";

$arrFields = array(
    array(
        'name' => 'media_id',
        'title' => 'ID',
        'type' =>'hidden'
    ),
    array(
        'name' => 'name',
        'title' => 'Name',
        'type' =>'text',
        'value' => ''
    ),
    array(
        'name' => 'attachment',
        'title' => 'Attachment',
        'mandatory' => 'Y',
        'type' =>'file'
    ),
    array(
        'name' => 'display_status',
        'type' =>'select',
        'title' => 'Status',
        'options' => array('Y' => 'Publish','N' => 'Unpublish')
    ),
);
?>