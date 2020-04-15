<?php
global $cf,$back_session_name;
$all_users = array();
$all_projects = array();
$all_clients = array();
$search_string = "";
$user_search_string = "";

if(isset($_SESSION[$back_session_name]['role_id']) && $_SESSION[$back_session_name]['role_id'] == 4){
    $search_string .= " AND  `user_id` = '".$_SESSION[$back_session_name]['user_id']."' ";
    $user_search_string .= " AND  `role_id` = '3' ";
}

$sqlUsers = "SELECT * FROM `users` WHERE `display_status` = 'Y' $user_search_string AND `blocked` = 'N' AND `deleted_status` = 'N' ORDER BY id ASC";
$arrData = $cf->getData($sqlUsers);
if(isset($arrData) && !empty($arrData)) {
    foreach($arrData as $data){
        $all_users[$data['id']] = $data['first_name'].' '.$data['last_name'];
    }
}

$sqProjects = "SELECT * FROM `item_section` WHERE `item_type` IN ('projects','clients') $search_string AND  `deleted_status` = 'N' ORDER BY item_section_id DESC";
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
        'name' => 'task_id',
        'title' => 'ID',
        'type' =>'hidden'
    ),
    
    array(
        'name' => 'task_name',
        'title' => 'Task Name',
        'mandatory' => 'Y',
        'type' =>'text'
    ),
    array(
        'name' => 'project_id',
        'title' => 'Project',
        'mandatory' => 'Y',
        'type' =>'select',
        'options' => $all_projects
    ),
    array(
        'name' => 'client_id',
        'title' => 'Client',
        'mandatory' => 'Y',
        'type' =>'select',
        'options' => $all_clients
    ),
    array(
        'name' => 'task_status',
        'type' =>'select',
        'title' => 'Task Status',
        'options' => array('' => 'Select Option','To Do' => 'To Do','In Progress' => 'In Progress','Hold' => 'Hold','QA Review' => 'QA Review','Cancelled' => 'Cancelled','Bug' => 'Bug','Client Review' => 'Client Review','Not Possible' => 'Not Possible','Done' => 'Done')
    ),
    array(
        'name' => 'task_priority',
        'type' =>'select',
        'title' => 'Task Priority',
        'options' => array('' => 'Select Option','Normal' => 'Normal','Higher' => 'Higher','Trival' => 'Trival','Blocker' => 'Blocker')
    ),
    array(
        'name' => 'assign_to',
        'title' => 'Assign To',
        'mandatory' => 'Y',
        'type' =>'select',
        'options' => $all_users
    ),
    array(
        'name' => 'assign_by',
        'title' => 'Assign By',
        'mandatory' => 'Y',
        'type' =>'select',
        'options' => $all_users
    ),
    array(
        'name' => 'milestone',
        'title' => 'Milestone',
        'mandatory' => 'Y',
        'type' =>'select',
        'options' => array('' => 'Select Option','Initial' => 'Initial','Requirement Completed' => 'Requirement Completed','Revision' => 'Revision','Client Changes' => 'Client Changes','After Client Feedback' => 'After Client Feedback','Unit Testing' => 'Unit Testing')
    ),
    array(
        'name' => 'start_date',
        'title' => 'Start Date',
        'mandatory' => 'Y',
        'type' =>'date'
    ),
    array(
        'name' => 'end_date',
        'title' => 'End Date',
        'mandatory' => 'Y',
        'type' =>'date'
    ),
    array(
        'name' => 'estimate_hours',
        'title' => 'Estimate Hours',
        'mandatory' => 'Y',
        'type' =>'text'
    ),
    
    array(
        'name' => 'attachment',
        'title' => 'Task Document',
        'mandatory' => 'Y',
        'type' =>'file'
    ),
    array(
        'name' => 'task_description',
        'title' => 'Description',
        'mandatory' => 'Y',
        'id' => 'summernoteExample',
        'type' =>'textarea'
    ),
);
?>