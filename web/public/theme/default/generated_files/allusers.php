<?php
global $cf;
$all_roles = array();
$sqlUsers = "SELECT * FROM `role` WHERE `display_status` = 'Y' AND `deleted_status` = 'N' ORDER BY role_id DESC";
$arrData = $cf->getData($sqlUsers);
if(isset($arrData) && !empty($arrData)) {
        $all_roles[''] = 'Select Role';
    foreach($arrData as $data){
        $all_roles[$data['role_id']] = $data['role_title'];
    }
}

$arrFields = array(
            array(
                'name' => 'id',
                'title' => 'ID',
                'type' =>'hidden'
            ),
            array(
                'name' => 'first_name',
                'title' => 'First Name',
                'type' =>'text',
                'mandatory' => 'Y',
                'value' => ''
            ),
            array(
                'name' => 'last_name',
                'title' => 'Last Name',
                'type' =>'text',
                'mandatory' => 'Y',
                'value' => ''
            ),
            array(
                'name' => 'email',
                'title' => 'E-Mail Address',
                'type' =>'text',
                'mandatory' => 'Y',
                'validate' => 'email',
                'readonly' => 1
            ),
            array(
                'name' => 'birth_date',
                'title' => 'Birth Date',
                'type' =>'date'
            ),
            array(
                'name' => 'role_id',
                'title' => 'Role',
                'type' =>'select',
                'mandatory' => 'Y',
                'options' => $all_roles
            ),
            array(
                'name' => 'display_status',
                'type' =>'select',
                'title' => 'Status',
                'options' => array('Y' => 'Active','N' => 'Inactive')
            ),
        );
?>