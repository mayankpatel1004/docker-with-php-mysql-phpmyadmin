<?php
$arrFields = array(
    array(
        'name' => 'forms_id',
        'title' => 'ID',
        'type' =>'hidden'
    ),
    array(
        'name' => 'first_name',
        'title' => 'First Name',
        'mandatory' => 'Y',
        'type' =>'text'
    ),
    array(
        'name' => 'last_name',
        'title' => 'Last Name',
        'mandatory' => 'Y',
        'type' =>'text'
    ),
    array(
        'name' => 'email_address',
        'title' => 'E-Mail Address',
        'mandatory' => 'Y',
        'validate' => 'email',
        'type' =>'text'
    ),
    array(
        'name' => 'file1',
        'title' => 'Document',
        'id' => 'file1',
        'type' =>'file'
    ),
    array(
        'name' => 'subject',
        'title' => 'Subject',
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
        'name' => 'message',
        'title' => 'Message',
        'mandatory' => 'Y',
        'type' =>'textarea'
    ),
);
?>