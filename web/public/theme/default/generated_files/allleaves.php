<?php
global $back_session_name;
$employee_id = 0;
$role_id = 0;
$employee_name = "";
if(isset($_SESSION[$back_session_name]['user_id']) && !empty($_SESSION[$back_session_name]['user_id'])){
    $employee_name = $_SESSION[$back_session_name]['first_name']." ".$_SESSION[$back_session_name]['last_name'];
    $employee_id = $_SESSION[$back_session_name]['user_id'];
    $role_id = $_SESSION[$back_session_name]['role_id'];
  }

  if($role_id > 2) {
        $status_option = array('N' => 'Inactive');
  } else {
        $status_option = array('Y' => 'Active','N' => 'Inactive');
  }

$arrFields = array(
    array(
        'name' => 'item_id',
        'title' => 'ID',
        'type' =>'hidden'
    ),
    array(
        'name' => 'user_id',
        'title' => 'Employee',
        'value' => $employee_id,
        'type' =>'hidden'
    ),
    array(
        'name' => 'meta_title',
        'title' => 'Employee Name',
        'mandatory' => 'Y',
        'type' =>'hidden',
        'value' => $employee_name
    ),
    array(
        'name' => 'meta_description',
        'title' => 'Employee Desc',
        'mandatory' => 'Y',
        'type' =>'hidden',
        'value' => "Meta Title is employee name"
    ),
    array(
        'name' => 'item_title',
        'title' => 'Leave Reason',
        'mandatory' => 'Y',
        'type' =>'text'
    ),
    array(
        'name' => 'published_at',
        'title' => 'Leave From',
        'mandatory' => 'Y',
        'type' =>'date'
    ),
    array(
        'name' => 'published_end_at',
        'title' => 'Leave To',
        'mandatory' => 'Y',
        'type' =>'date'
    ),
    array(
        'name' => 'display_status',
        'type' =>'select',
        'title' => 'Status (Inactive = Pending, Active = Approved)',
        'options' => $status_option
    ),
    
    array(
        'name' => 'item_description',
        'title' => 'Additional Notes (If Required)',
        'type' =>'textarea'
    )
);
?>