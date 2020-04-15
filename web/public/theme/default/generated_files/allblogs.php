<?php
global $cf;
$blog_category = array();
$sqlBlog = "SELECT `section_title`,`section_alias`  FROM `item_section` WHERE `item_type` = 'blog_category' AND `display_status` = 'Y' AND `deleted_status` = 'N' ORDER BY `item_section_id` ASC";
$arrData = $cf->getData($sqlBlog);
if(isset($arrData) && !empty($arrData)) {
    foreach($arrData as $data){
        $blog_category[$data['section_alias']] = $data['section_title'];
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
        'name' => 'display_status',
        'type' =>'select',
        'title' => 'Status',
        'options' => array('Y' => 'Active','N' => 'Inactive')
    ),
    array(
        'name' => 'html_sitemap',
        'type' =>'select',
        'title' => 'Display on Sitemap Page ?',
        'options' => array('Y' => 'Yes','N' => 'No')
    ),
    array(
        'name' => 'item_category',
        'type' =>'select',
        'title' => 'Category',
        'multiple' => 'multiple',
        'options' => $blog_category
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
        'name' => 'controller',
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
        'name' => 'robots',
        'title' => 'Robots',
        'type' =>'select',
        'options' => array('INDEX,FOLLOW'=>'INDEX,FOLLOW','NOINDEX,NOFOLLOW' => 'NOINDEX,NOFOLLOW')
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