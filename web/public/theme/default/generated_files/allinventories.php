<?php
global $cf,$back_session_name;
$all_type = array();
$all_items = array();
$all_users = array();

$sqlItems = "SELECT * FROM `inv_inventories` WHERE `display_status` = 'Y' AND `deleted_status` = 'N' ORDER BY inventory_id ASC";
$arrData = $cf->getData($sqlItems);
if(isset($arrData) && !empty($arrData)) {
    $all_items['0'] = "Select Item";
    foreach($arrData as $data){
        $all_items[$data['inventory_id']] = $data['item_title'].' '.$data['items_alias'];
    }
}


$sqlUsers = "SELECT * FROM `users` WHERE `display_status` = 'Y' AND `deleted_status` = 'N' AND `blocked` = 'N' ORDER BY id DESC";
$arrUserData = $cf->getData($sqlUsers);
if(isset($arrUserData) && !empty($arrUserData)) {
    $all_users['0'] = "Select User";
    foreach($arrUserData as $data){
        $all_users[$data['id']] = $data['first_name'].' '.$data['last_name'];
    }
}

$arrFieldsStock = array(
    array(
        'name' => 'inventories_activities_id',
        'title' => 'ID',
        'type' =>'hidden'
    ), 
    array(
        'name' => 'inventory_id',
        'type' =>'select',
        'mandatory' => 'Y',
        'title' => 'Select Item',
        'options' => $all_items,
        'onChange' => 'fnGetItemDetails'
    ),
    array(
        'name' => 'operation',
        'type' =>'select',
        'mandatory' => 'Y',
        'title' => 'Select Operation',
        'options' => array('Addition' => 'Addition','Substraction' => 'Substraction','Damage' => 'Damage','Lost' => 'Lost','Restore' => 'Restore')
    ),
    array(
        'name' => 'total_items',
        'title' => 'No. Of Items',
        'mandatory' => 'Y',
        'type' =>'text',
        'value' => ''
    ),
    array(
        'name' => 'total_items_before_entry',
        'title' => 'Items Before This Entry',
        'type' =>'hidden',
        'value' => ''
    ),
    array(
        'name' => 'item_price',
        'mandatory' => 'Y',
        'title' => 'Item Price (Per Item)',
        'type' =>'text'
    ),
    array(
        'name' => 'attachment',
        'title' => 'Bill Attachment',
        'type' =>'file'
    ),
    array(
        'name' => 'bill_picture',
        'title' => 'Bill Photo',
        'type' =>'file'
    ),
    array(
        'name' => 'po_number',
        'title' => 'PO Number',
        'mandatory' => 'Y',
        'type' =>'text'
    ),
    array(
        'name' => 'item_title',
        'title' => 'Item Title',
        'mandatory' => 'Y',
        'type' =>'hidden'
    ),
    array(
        'name' => 'is_partial',
        'title' => 'Is Partial?',
        'mandatory' => 'Y',
        'type' =>'hidden'
    ),
    array(
        'name' => 'item_size',
        'title' => 'Size (For Partial Used Only)',
        'type' =>'hidden',
        'value' => '0'
    ),
    array(
        'name' => 'item_unit',
        'title' => 'Item Unit',
        'mandatory' => 'Y',
        'type' =>'hidden'
    ),
    array(
        'name' => 'description',
        'title' => 'Notes',
        'type' =>'textarea'
    )
);

$arrFields = array(
    array(
        'name' => 'inventory_id',
        'title' => 'ID',
        'value' => '0',
        'type' =>'hidden'
    ),
    array(
        'name' => 'item_title',
        'title' => 'Title',
        'type' =>'text',
        'mandatory' => 'Y',
        'value' => ''
    ),
    
    array(
        'name' => 'items_alias',
        'title' => 'Alias',
        'type' =>'hidden',
        'value' => ''
    ),
    
    array(
        'name' => 'total_item',
        'title' => 'Total Items',
        'mandatory' => 'Y',
        'readonly' => 1,
        'type' =>'text'
    ),
    array(
        'name' => 'item_price',
        'title' => 'Item Price (Per Item)',
        'mandatory' => 'Y',
        'readonly' => 1,
        'type' =>'text'
    ),
    // array(
    //     'name' => 'item_price_with_quantity',
    //     'title' => 'Item Price (With Quantity)',
    //     'type' =>'text'
    // ),
    array(
        'name' => 'is_partial',
        'type' =>'select',
        'title' => 'Partial Used?',
        'options' => array('N' => 'No','Y' => 'Yes')
    ),
    array(
        'name' => 'item_size',
        'title' => 'Size (For Partial Used Only)',
        'type' =>'text',
        'value' => '0'
    ),
    
    array(
        'name' => 'item_unit',
        'type' =>'select',
        'title' => 'Item Unit?',
        'options' => array('Number' => 'Number','Liter' => 'Liter','Meter' => 'Meter','Centimeter' => 'Centimeter','Gram' => 'Gram','Kilogram' => 'Kilogram')
    ),
    array(
        'name' => 'attachment',
        'title' => 'Bill Attachment',
        'type' =>'file'
    ),
    array(
        'name' => 'bill_picture',
        'title' => 'Bill Photo',
        'type' =>'file'
    ),
    array(
        'name' => 'po_number',
        'title' => 'PO Number',
        'type' =>'text',
        'value' => ''
    ),
    array(
        'name' => 'gst_number',
        'title' => 'GST Number',
        'type' =>'text'
    ),
    array(
        'name' => 'is_consumable',
        'type' =>'select',
        'title' => 'Consumed Item?',
        'options' => array('N' => 'No','Y' => 'Yes')
    ),
    array(
        'name' => 'display_status',
        'type' =>'select',
        'title' => 'Status',
        'options' => array('Y' => 'Publish','N' => 'Unpublish')
    ),
    array(
        'name' => 'item_description',
        'title' => 'Description',
        'type' =>'textarea',
        'value' => ''
    )
);


$arrFieldsDispatches = array(
    array(
        'name' => 'operation',
        'title' => 'Select Operation',
        'type' =>'hidden',
        'value' => 'Dispatch'
    ),
    array(
        'name' => 'inventory_id',
        'type' =>'select',
        'mandatory' => 'Y',
        'title' => 'Select Item',
        'options' => $all_items,
        'onChange' => 'fnGetItemDetails'
    ),
    array(
        'name' => 'item_size',
        'title' => 'Item Size',
        'type' =>'hidden'
    ),
    array(
        'name' => 'total_item_size',
        'title' => 'Total Item Size',
        //'readonly' => 1,
        'type' =>'select',
        'options' => array('0' => 'Select Size')
    ),
    array(
        'name' => 'total_items',
        'title' => 'No. Of Items',
        'mandatory' => 'Y',
        'type' =>'select',
        'options' => array('0' => 'Select Total Item')
    ),
    array(
        'name' => 'taken_by',
        'type' =>'select',
        'mandatory' => 'Y',
        'title' => 'Select User',
        'options' => $all_users
    ),
    array(
        'name' => 'total_items_before_entry',
        'title' => 'Items Before This Entry',
        'type' =>'hidden',
        'value' => ''
    ),
    array(
        'name' => 'item_price',
        'mandatory' => 'Y',
        'title' => 'Item Price (Per Item)',
        'type' =>'hidden'
    ),
    // array(
    //     'name' => 'attachment',
    //     'title' => 'Bill Attachment',
    //     'type' =>'file'
    // ),
    // array(
    //     'name' => 'bill_picture',
    //     'title' => 'Bill Photo',
    //     'type' =>'file'
    // ),
    array(
        'name' => 'po_number',
        'title' => 'PO Number',
        'mandatory' => 'Y',
        'type' =>'hidden'
    ),
    array(
        'name' => 'item_title',
        'title' => 'Item Title',
        'mandatory' => 'Y',
        'type' =>'hidden'
    ),
    array(
        'name' => 'is_partial',
        'title' => 'Is Partial?',
        'mandatory' => 'Y',
        'type' =>'hidden'
    ),
    array(
        'name' => 'item_unit',
        'title' => 'Item Unit',
        'mandatory' => 'Y',
        'type' =>'hidden'
    ),
    // array(
    //     'name' => 'description',
    //     'title' => 'Notes',
    //     'type' =>'textarea'
    // )
);
?>