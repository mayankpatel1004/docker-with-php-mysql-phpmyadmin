<?php
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
        'title' => 'Title',
        'mandatory' => 'Y',
        'type' =>'text'
    ),
    array(
        'name' => 'description',
        'title' => 'Description',
        'type' =>'text'
    ),
    array(
        'name' => 'display_status',
        'type' =>'select',
        'title' => 'Status',
        'options' => array('Y' => 'Active','N' => 'Inactive')
    )
);

?>