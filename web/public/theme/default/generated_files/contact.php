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
        'name' => 'item_type',
        'title' => 'Item Type',
        'value' => 'contact',
        'mandatory' => 'Y',
        'type' =>'hidden'
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
        'name' => 'message',
        'title' => 'Message',
        'mandatory' => 'Y',
        'type' =>'textarea'
    ),
);
?>