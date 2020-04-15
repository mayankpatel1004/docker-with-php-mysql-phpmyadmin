<?php
$arrFields = array(
    array(
        'name' => 'item_id',
        'title' => 'ID',
        'type' =>'hidden'
    ),
    array(
        'name' => 'item_title',
        'title' => 'Title',
        'mandatory' => 'Y',
        'type' =>'text'
    ),
    array(
        'name' => 'display_status',
        'type' =>'select',
        'title' => 'Status',
        'options' => array('Y' => 'Active','N' => 'Inactive')
    ),
    array(
        'name' => 'html_sitemap',
        'type' =>'select',
        'title' => 'Display on Sitemap Page ?',
        'options' => array('N' => 'No','Y' => 'Yes')
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
    ),
    array(
        'name' => 'Controller',
        'title' => 'Controller',
        'type' =>'text',
        'value' => 'pages'
    ),
    array(
        'name' => 'Action',
        'title' => 'action',
        'type' =>'text',
        'value' => 'pages'
    ),
    array(
        'name' => 'snippets_code',
        'title' => 'Rich Snippets',
        'type' =>'textarea'
    ),
    array(
        'name' => 'item_description',
        'title' => 'Description',
        'mandatory' => 'Y',
        'id' => 'summernoteExample',
        'type' =>'textarea'
    ),
    
);
?>