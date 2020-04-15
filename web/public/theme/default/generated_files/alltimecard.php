<?php

global $cf;
$all_users = array();
$all_projects = array();

$sqlUsers = "SELECT * FROM `users` WHERE `display_status` = 'Y' AND `blocked` = 'N' AND `deleted_status` = 'N' ORDER BY id ASC";
$arrData = $cf->getData($sqlUsers);
if(isset($arrData) && !empty($arrData)) {
    foreach($arrData as $data){
        $all_users[$data['id']] = $data['first_name'].' '.$data['last_name'];
    }
}

$sqProjects = "SELECT * FROM `item_section` WHERE `item_type` IN ('projects','clients') AND `deleted_status` = 'N' ORDER BY item_section_id DESC";
$arrProjects = $cf->getData($sqProjects);
if(isset($arrProjects) && !empty($arrProjects)) {
    foreach($arrProjects as $data){
        if($data['item_type'] == 'projects'){
            $all_projects[$data['item_section_id']] = $data['section_title'];
        } else {
            $all_clients[$data['item_section_id']] = $data['section_title'];
        }       
    }
}

$arrFields = array(
    array(
        'name' => 'timcard_id',
        'title' => 'ID',
        'type' =>'hidden'
    ),
    array(
        'name' => 'user_id',
        'type' =>'select',
        'title' => 'User',
        'mandatory' => 'Y',
        'options' => $all_users
    ),
    array(
        'name' => 'project_id',
        'title' => 'Select Project',
        'type' =>'select',
        'mandatory' => 'Y',
        'onchange' => 'getTasks(this.value)',
        'options' => $all_projects
    ),
    array(
        'name' => 'task_id',
        'title' => 'Task',
        'mandatory' => 'Y',
        'type' =>'select',
        'value' => ''
    ),
    array(
        'name' => 'hours',
        'type' =>'text',
        'mandatory' => 'Y',
        'title' => 'Hours'
    ),
    array(
        'name' => 'timecard_date',
        'type' =>'date',
        'mandatory' => 'Y',
        'title' => 'Date'
    ),
    array(
        'name' => 'task_comment',
        'title' => 'Comment',
        'mandatory' => 'Y',
        'type' =>'textarea'
    ),
);
?>