<?php

global $cf;
$portfolio_category = array();
$sqlBlog = "SELECT `section_title`,`section_alias`  FROM `item_section` WHERE `item_type` = 'portfolio_category' AND `display_status` = 'Y' AND `deleted_status` = 'N' ORDER BY `item_section_id` ASC";
$arrData = $cf->getData($sqlBlog);
if(isset($arrData) && !empty($arrData)) {
    foreach($arrData as $data){
        $portfolio_category[$data['section_alias']] = $data['section_title'];
    }
}

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
        'name' => 'item_category',
        'type' =>'select',
        'title' => 'Category',
        'multiple' => 'multiple',
        'options' => $portfolio_category
    ),
    array(
        'name' => 'item_description',
        'title' => 'Description',
        'mandatory' => 'Y',
        'type' =>'text'
    ),
    array(
        'name' => 'external_url',
        'title' => 'URL',
        'mandatory' => 'Y',
        'type' =>'text'
    ),
    array(
        'name' => 'file1',
        'title' => 'Site Image',
        'id' => 'banner',
        'mandatory' => 'Y',
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