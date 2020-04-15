<?php
global $cf;
$all_type = array();
$item_type_string = "";

$arrOrderStatus = array('Pending' => 'Pending','Processing' => 'Processing','Payment Pending' => 'Payment Pending','Payment Paid' => 'Payment Paid','Delivered' => 'Delivered','Cancelled' => 'Cancelled');

$arrFields = array(
    array(
        'name' => 'order_status',
        'type' =>'select',
        'title' => 'Status',
        'options' => $arrOrderStatus
    ),
);
?>