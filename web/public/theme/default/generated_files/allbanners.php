<?php
$arrFields = array(
    array(
        'name' => 'item_id',
        'title' => 'ID',
        'type' =>'hidden'
    ),
    
    array(
        'name' => 'item_title',
        'title' => 'Banner Title',
        'mandatory' => 'Y',
        'type' =>'text'
    ),
    array(
        'name' => 'file1',
        'title' => 'Banner',
        'id' => 'banner',
        'mandatory' => 'Y',
        'type' =>'file'
    ),
    array(
        'name' => 'display_status',
        'type' =>'select',
        'title' => 'Status',
        'options' => array('Y' => 'Active','N' => 'Inactive')
    ),
    array(
        'name' => 'meta_title',
        'title' => 'Meta Title',
        'type' =>'text'
    ),
    array(
        'name' => 'meta_description',
        'title' => 'Meta Description',
        'type' =>'text'
    ),
    array(
        'name' => 'robots',
        'title' => 'Robots',
        'type' =>'select',
        'options' => array('INDEX,FOLLOW'=>'INDEX,FOLLOW','NOINDEX,NOFOLLOW' => 'NOINDEX,NOFOLLOW')
    )
);

?>