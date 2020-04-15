<?php
$arrFields = array(
    array(
        'name' => 'item_id',
        'title' => 'ID',
        'type' =>'hidden'
    ),
    
    array(
        'name' => 'item_title',
        'title' => 'Event Title',
        'mandatory' => 'Y',
        'type' =>'text'
    ),
    array(
        'name' => 'published_at',
        'title' => 'Event Start Date',
        'mandatory' => 'Y',
        'type' =>'date'
    ),
    array(
        'name' => 'published_end_at',
        'title' => 'Event End Date',
        'mandatory' => 'Y',
        'type' =>'date'
    ),
    array(
        'name' => 'display_status',
        'type' =>'select',
        'title' => 'Status',
        'options' => array('Y' => 'Active','N' => 'Inactive')
    ),
    array(
        'name' => 'item_description',
        'title' => 'Description',
        'type' =>'text'
    )
);

?>