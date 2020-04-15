<?php
global $cf;
$product_category = array();
$related_products = array();
$sqlBlog = "SELECT `section_title`,`section_alias`  FROM `item_section` WHERE `item_type` = 'product_category' AND `display_status` = 'Y' AND `deleted_status` = 'N' ORDER BY `item_section_id` ASC";
$arrData = $cf->getData($sqlBlog);
if(isset($arrData) && !empty($arrData)) {
    //$product_category[""] = "Select Category";
    foreach($arrData as $data){
        $product_category[$data['section_alias']] = $data['section_title'];
    }
}

$sqlRelatedProducts = "SELECT * FROM `ec_products` WHERE display_status = 'Y' AND deleted_status = 'N'";
$arrRelatedProducts = $cf->getData($sqlRelatedProducts);
if(isset($arrRelatedProducts) && !empty($arrRelatedProducts)) {
    //$related_products[""] = "Related Products";
    foreach($arrRelatedProducts as $data){
        $related_products[$data['item_alias']] = $data['item_title'];
    }
}

$arrFields = array(
    array(
        'name' => 'item_id',
        'db_column' => 'item_id',
        'title' => 'ID',
        'value' => '0',
        'type' =>'hidden'
    ),
    array(
        'name' => 'products[item_type_alias]',
        'title' => 'Item Type Alias',
        'db_column' => 'item_type_alias',
        'type' =>'hidden',
        'value' => 'products'
    ),
    array(
        'name' => 'products[item_title]',
        'db_column' => 'item_title',
        'title' => 'Title',
        'mandatory' => 'Y',
        'type' =>'text'
    ),  
    array(
        'name' => 'products[item_category_alias][]',
        'type' =>'select',
        'title' => 'Category',
        'multiple' => 'multiple',
        'db_column' => 'item_category_alias',
        'options' => $product_category
    ),
    array(
        'name' => 'products[item_weight]',
        'title' => 'Weight (In KG)',
        'db_column' => 'item_weight',
        'mandatory' => 'Y',
        'value' => '0.00',
        'type' =>'text'
    ),
    array(
        'name' => 'products[in_stock]',
        'type' =>'select',
        'db_column' => 'in_stock',
        'title' => 'In Stock',
        'options' => array('Y' => 'Yes','N' => 'No')
    ),
    // array(
    //     'name' => 'products[item_shipping_price]',
    //     'type' =>'text',
    //     'db_column' => 'item_shipping_price',
    //     'title' => 'Shipping Charge',
    //     'value' => '0.00'
    // ),
    array(
        'name' => 'products[file1]',
        'type' =>'file',
        'db_column' => 'file1',
        'title' => 'Product Image'
    ),
    array(
        'name' => 'products[is_featured]',
        'type' =>'select',
        'db_column' => 'is_featured',
        'title' => 'Is Featured',
        'options' => array('Y' => 'Yes','N' => 'No')
    ),
    array(
        'name' => 'products[is_home]',
        'type' =>'select',
        'db_column' => 'is_home',
        'title' => 'Is Home',
        'options' => array('Y' => 'Yes','N' => 'No')
    ),
    array(
        'name' => 'products[display_status]',
        'type' =>'select',
        'db_column' => 'display_status',
        'title' => 'Status',
        'options' => array('Y' => 'Active','N' => 'Inactive')
    ),
    array(
        'name' => 'products[display_on_sitemap]',
        'type' =>'select',
        'db_column' => 'display_on_sitemap',
        'title' => 'Display On Sitemap?',
        'options' => array('Y' => 'Yes','N' => 'No')
    ),
    array(
        'name' => 'products[related_products][]',
        'type' =>'select',
        'db_column' => 'related_products',
        'title' => 'Related Products',
        'multiple' => 'multiple',
        'options' => $related_products
    ),
    array(
        'name' => 'products[meta_title]',
        'db_column' => 'meta_title',
        'title' => 'Meta Title',
        'type' =>'text'
    ),
    array(
        'name' => 'products[publish_date]',
        'db_column' => 'publish_date',
        'title' => 'Publish Date',
        'mandatory' => 'Y',
        'value' => date('Y-m-d'),
        'type' =>'date'
    ),
    array(
        'name' => 'products[meta_description]',
        'db_column' => 'meta_description',
        'title' => 'Meta Description',
        'mandatory' => 'Y',
        'type' =>'text'
    ),
    array(
        'name' => 'products[item_terms_conditions]',
        'type' =>'textarea',
        'db_column' => 'item_terms_conditions',
        'title' => 'Terms & Conditions'
    ),
    array(
        'name' => 'products[item_description]',
        'type' =>'textarea',
        'db_column' => 'item_description',
        'title' => 'Description'
    )
);


$arrPriceFields = array(
    array(
        'name' => 'productprice[product_option_price]',
        'title' => 'Product <br />Price',
        'db_column' => 'product_option_price',
        'type' =>'text'
    ),
    array(
        'name' => 'productprice[is_default_price]',
        'title' => 'Product Defult Price',
        'db_column' => 'is_default_price',
        'type' =>'text',
        'readonly' => 1,
        'value' => 'Y'
    ),
    array(
        'name' => 'productprice[product_option_price_display]',
        'title' => 'Product Display Price',
        'db_column' => 'product_option_price_display',
        'type' =>'text'
    ),
    array(
        'name' => 'productprice[item_tax_amount]',
        'title' => 'Product Tax Amount',
        'db_column' => 'item_tax_amount',
        'type' =>'text'
    ),
    array(
        'name' => 'productprice[item_shipping_amount]',
        'title' => 'Shipping Amount',
        'db_column' => 'item_shipping_amount',
        'type' =>'text'
    ),
    array(
        'name' => 'productprice[product_quantity]',
        'title' => 'Product Quantity',
        'db_column' => 'product_quantity',
        'type' =>'text'
    ),
    array(
        'name' => 'productprice[min_quantity_notification]',
        'title' => 'Min. Quantity Notifications',
        'db_column' => 'min_quantity_notification',
        'type' =>'text'
    ),
);
?>