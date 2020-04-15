<?php
$arrFields = array(
            array(
                'name' => 'role_id',
                'title' => 'ID',
                'type' =>'hidden'
            ),
            array(
                'name' => 'role_title',
                'title' => 'Role Name',
                'type' =>'text',
                'mandatory' => 'Y',
                'value' => ''
            ),
            array(
                'name' => 'display_status',
                'type' =>'select',
                'title' => 'Status',
                'options' => array('Y' => 'Active','N' => 'Inactive')
            ),
        );
?>