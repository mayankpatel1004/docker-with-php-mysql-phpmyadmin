<?php
class Home {
    
    public function getBanners() {
        global $cf,$page_data,$url;
        $sql = "SELECT `item_id`,`item_title`,`item_description`,`external_url`,`file1`,`external_url` FROM `items` WHERE `item_type` = 'banners' AND `display_status` = 'Y' AND `admin_module` = 'N' AND `deleted_status` = 'N'";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function getHomedata() {
        global $cf,$page_data,$url;
        $sql = "SELECT `item_description` FROM `items` WHERE `item_alias` = 'home'";
        $arrData = $cf->getOneData($sql);
        return $arrData;
    }

    public function checkProductExistsOnCart($cart_id,$item_id,$product_price_id) {
        global $cf,$page_data,$url;
        $exist = 'N';
        $sql = "SELECT count(*) as total FROM `ec_cart_product` WHERE `cart_id` = '$cart_id' AND `item_id` = '$item_id' AND `product_price_id` = '$product_price_id'";
        //echo $sql;exit;
        $arrData = $cf->getOneData($sql);
        if(isset($arrData['total']) && $arrData['total'] > 0) {
            $exist = 'Y';
        }
        return $exist;
    }

    public function insertProduct($cart_id,$item_id,$product_price_id,$ordered_quantity) {
        global $cf,$page_data,$url,$conn;

        $user_id = 0;
        $item_name = "";
        $item_alias = "";
        $product_attribute_1 = "";
        $product_attribute_2 = "";
        $product_attribute_3 = "";
        $product_option_1 = "";
        $product_option_2 = "";
        $product_option_3 = "";
        $product_option_4 = "";
        $product_option_price = "";
        $product_option_price_display = "";
        $item_shipping_amount = "0.00";
        $currancy = "";
        $item_tax_amount = "";
        $is_default_price = "";
        $item_final_price = '0';
        $item_shipping_total = '0';

        $sqlSelectProductData = "SELECT p.user_id,p.item_title,p.item_alias,p.parent_item_id,pp.product_price_id,pp.item_id,pp.user_id,pp.product_attribute_1,pp.product_attribute_2,pp.product_attribute_3,pp.product_option_1,pp.product_option_2,pp.product_option_3,pp.product_option_4,pp.product_option_price,pp.product_option_price_display,pp.currancy,pp.item_tax_amount,pp.is_default_price,pp.product_quantity,pp.item_shipping_amount FROM `ec_products` p INNER JOIN `ec_product_price` pp ON p.item_id = pp.item_id AND product_price_id = '$product_price_id'";
        $arrCheckDataExists = $cf->getOneData($sqlSelectProductData);
        //print_r($arrCheckDataExists);exit;
        if(isset($arrCheckDataExists['product_quantity']) && ($arrCheckDataExists['product_quantity'] > $quantity)) {
            
            if(isset($arrCheckDataExists['user_id']) && $arrCheckDataExists['user_id'] > 0) :
                $user_id = $arrCheckDataExists['user_id'];
            endif;
            if(isset($arrCheckDataExists['item_title']) && $arrCheckDataExists['item_title'] != "") :
                $item_name = $arrCheckDataExists['item_title'];
            endif;
            if(isset($arrCheckDataExists['item_alias']) && $arrCheckDataExists['item_alias'] != "") :
                $item_alias = $arrCheckDataExists['item_alias'];
            endif;
            if(isset($arrCheckDataExists['ordered_quantity']) && $arrCheckDataExists['ordered_quantity'] > 0) :
                $ordered_quantity = $quantity;
            endif;
            if(isset($arrCheckDataExists['product_attribute_1']) && $arrCheckDataExists['product_attribute_1'] != "") :
                $product_attribute_1 = $arrCheckDataExists['product_attribute_1'];
            endif;
            if(isset($arrCheckDataExists['product_attribute_2']) && $arrCheckDataExists['product_attribute_2'] != "") :
                $product_attribute_2 = $arrCheckDataExists['product_attribute_2'];
            endif;
            if(isset($arrCheckDataExists['product_attribute_3']) && $arrCheckDataExists['product_attribute_3'] != "") :
                $product_attribute_3 = $arrCheckDataExists['product_attribute_3'];
            endif;
            if(isset($arrCheckDataExists['product_option_1']) && $arrCheckDataExists['product_option_1'] != "") :
                $product_option_1 = $arrCheckDataExists['product_option_1'];
            endif;
            if(isset($arrCheckDataExists['product_option_2']) && $arrCheckDataExists['product_option_2'] != "") :
                $product_option_2 = $arrCheckDataExists['product_option_2'];
            endif;
            if(isset($arrCheckDataExists['product_option_3']) && $arrCheckDataExists['product_option_3'] != "") :
                $product_option_3 = $arrCheckDataExists['product_option_3'];
            endif;
            if(isset($arrCheckDataExists['product_option_4']) && $arrCheckDataExists['product_option_4'] != "") :
                $product_option_4 = $arrCheckDataExists['product_option_4'];
            endif;
            if(isset($arrCheckDataExists['product_option_price']) && $arrCheckDataExists['product_option_price'] != "") :
                $product_option_price = $arrCheckDataExists['product_option_price'];
            endif;
            if(isset($arrCheckDataExists['product_option_price_display']) && $arrCheckDataExists['product_option_price_display'] != "") :
                $product_option_price_display = $arrCheckDataExists['product_option_price_display'];
            endif;
            if(isset($arrCheckDataExists['currancy']) && $arrCheckDataExists['currancy'] != "") :
                $currancy = $arrCheckDataExists['currancy'];
            endif;
            if(isset($arrCheckDataExists['item_tax_amount']) && $arrCheckDataExists['item_tax_amount'] > 0) :
                $item_tax_amount = $arrCheckDataExists['item_tax_amount'];
            endif;
            if(isset($arrCheckDataExists['item_shipping_amount']) && $arrCheckDataExists['item_shipping_amount'] > 0) :
                $item_shipping_amount = $arrCheckDataExists['item_shipping_amount'];
            endif;
            if(isset($arrCheckDataExists['is_default_price']) && $arrCheckDataExists['is_default_price'] != '') :
                $is_default_price = $arrCheckDataExists['is_default_price'];
            endif;
           
            $item_price_total = $product_option_price * $ordered_quantity;
            $item_tax_total = $item_tax_amount * $ordered_quantity;
            $item_shipping_total = $item_shipping_amount * $ordered_quantity;
            $final_item_price = $item_price_total+$item_tax_total+$item_shipping_total;

            $sqlInsert = "INSERT INTO `ec_cart_product` SET cart_id = '$cart_id',customer_id = '0',item_id = '$item_id',`user_id` = '$user_id',product_price_id = '$product_price_id',item_name = '$item_name',item_alias = '$item_alias',ordered_quantity = '$ordered_quantity',product_attribute_1 = '$product_attribute_1',product_attribute_2 = '$product_attribute_2',product_attribute_3 = '$product_attribute_3',product_option_1 = '$product_option_1',product_option_2 = '$product_option_2',product_option_3 = '$product_option_3',product_option_4 = '$product_option_4',product_option_price = '$product_option_price',product_option_price_display = '$product_option_price_display',currancy = '$currancy',item_tax_amount = '$item_tax_amount',item_shipping_amount = '$item_shipping_amount',is_default_price = '$is_default_price',item_price_total = '$item_price_total',item_tax_total = '$item_tax_total',item_shipping_total = '$item_shipping_total',final_item_price = '$final_item_price',created_at = NOW()";
            //echo $sqlInsert;exit;
            $stmt = $conn->prepare($sqlInsert); 
            $stmt->execute();
            $response = 1;
        } else {
            $response = "You can order maximum ".$arrCheckDataExists['product_quantity']." quantity for this product.";
        }
        return $response;
    }

    public function updateProduct($cart_id,$item_id,$product_price_id,$quantity) {
        global $cf,$page_data,$url,$conn;
        $product_option_price = 0;
        $item_tax_amount = 0;
        $existing_quantity = 0;
        $item_shipping_total = 0;

        $sqlOrderProductData = "SELECT ordered_quantity FROM `ec_cart_product` WHERE `product_price_id` = $product_price_id";
        $arrCheckProductDataExists = $cf->getOneData($sqlOrderProductData);
        if(isset($arrCheckProductDataExists) && !empty($arrCheckProductDataExists)){
            $ordered_quantity = $arrCheckProductDataExists['ordered_quantity'];
        }
        
        $sqlSelectProductData = "SELECT product_option_price,item_tax_amount,product_quantity,item_shipping_amount FROM `ec_product_price` WHERE `product_price_id` = $product_price_id";
        $arrCheckDataExists = $cf->getOneData($sqlSelectProductData);
        if(isset($arrCheckDataExists) && !empty($arrCheckDataExists)){
            $product_option_price = $arrCheckDataExists['product_option_price'];
            $item_tax_amount = $arrCheckDataExists['item_tax_amount'];
            $existing_quantity = $arrCheckDataExists['product_quantity'];
            $item_shipping_amount = $arrCheckDataExists['item_shipping_amount'];
        }

        $ordered_quantity = $ordered_quantity+$quantity;
        if($existing_quantity < $ordered_quantity){
            $response = "You can order maximum ".$existing_quantity." quantity for this product.";
        } else {
            $product_option_price = $arrCheckDataExists['product_option_price'] * $ordered_quantity;
            $item_tax_amount = $arrCheckDataExists['item_tax_amount'] * $ordered_quantity;
            $item_shipping_total = $item_shipping_amount * $ordered_quantity;
            $final_item_price = $product_option_price + $item_tax_amount + $item_shipping_total;
    
            $sqlUpdate = "UPDATE `ec_cart_product` SET ordered_quantity = $ordered_quantity,item_price_total = '$product_option_price',item_tax_total = '$item_tax_amount',final_item_price = '$final_item_price',item_shipping_amount = '$item_shipping_amount',item_shipping_total = '$item_shipping_total' WHERE product_price_id = '$product_price_id'";
            $stmt = $conn->prepare($sqlUpdate); 
            $stmt->execute();
            $response = 2;
        }
        return $response;
    }

    public function updateCartTotal($cart_id) {
        global $cf,$page_data,$url,$conn;
        $success = 0;
        $error = 1;
        $message = "";
        $response_data = array();

        $cashback_amount_applied = 0;
        $coupon_amount_applied = 0;
        $cashback_wallet_amount_used = 0;
        $shipping_amount = 0;
        $sqlGetCartData = "SELECT `cashback_amount_applied`,`coupon_amount_applied`,`cashback_wallet_amount_used`,`shipping_amount` FROM `ec_cart` WHERE `cart_id` = '$cart_id'";
        $arrCartDetails = $cf->getOneData($sqlGetCartData);
        if(isset($arrCartDetails) && !empty($arrCartDetails)) {
            $cashback_amount_applied = $arrCartDetails['cashback_amount_applied'];
            $coupon_amount_applied = $arrCartDetails['coupon_amount_applied'];
            $cashback_wallet_amount_used = $arrCartDetails['cashback_wallet_amount_used'];
            $shipping_amount = $arrCartDetails['shipping_amount'];
        }
        
        $sqlgetProductDetails = "SELECT 
        SUM(item_price_total) as total_items_amount,
        SUM(item_tax_total) as total_items_tax_amount,
        SUM(item_shipping_total) as total_items_shipping_amount,
        SUM(ordered_quantity) as total_ordered_quantity,
        SUM(final_item_price) as order_total FROM `ec_cart_product` WHERE cart_id = '$cart_id'";
        $arrCartProductSubtotals = $cf->getOneData($sqlgetProductDetails);
        // echo "<pre>";print_r($arrCartProductSubtotals);
        // exit;
        
        if(isset($arrCartProductSubtotals) && !empty($arrCartProductSubtotals) && $arrCartProductSubtotals['total_items_amount'] != '') {
            $order_total = ($arrCartProductSubtotals['order_total']+$shipping_amount)-($cashback_amount_applied+$coupon_amount_applied+$cashback_wallet_amount_used);
            $sqlUpdate = "UPDATE `ec_cart` SET 
            `total_items_amount` = '".$arrCartProductSubtotals['total_items_amount']."',
            `total_items_tax_amount` = '".$arrCartProductSubtotals['total_items_tax_amount']."',
            `total_items_shipping_amount` = '".$arrCartProductSubtotals['total_items_shipping_amount']."',
            `total_ordered_quantity` = '".$arrCartProductSubtotals['total_ordered_quantity']."',
            `order_total` = '".$order_total."'
            WHERE cart_id = '$cart_id'";
            $stmt = $conn->prepare($sqlUpdate); 
            $stmt->execute();
        } else {
        
        $sqlUpdate = "UPDATE `ec_cart` SET 
            `total_items_amount` = '0',
            `total_items_tax_amount` = '0',
            `total_items_shipping_amount` = '0',
            `total_ordered_quantity` = '0',
            `cashback_amount_applied` = '0',
            `coupon_amount_applied` = '0',
            `cashback_wallet_amount_used` = '0',
            `order_total` = '0'
            WHERE cart_id = '$cart_id'";
            $stmt = $conn->prepare($sqlUpdate); 
            $stmt->execute();
        }
    }

    public function updateCartProducts($cart_id,$item_id,$product_price_id,$quantity,$has_option) {
        global $cf,$page_data,$url;
        $success = 0;
        $error = 1;
        $message = $response;
        $response_data = array();
    
        $is_exists = $this->checkProductExistsOnCart($cart_id,$item_id,$product_price_id);
        if($is_exists == 'N') {
            $response = $this->insertProduct($cart_id,$item_id,$product_price_id,$quantity);
        } else {
            $response = $this->updateProduct($cart_id,$item_id,$product_price_id,$quantity);
        }

        if($response == 1) {
            $success = 1;
            $error = 0;
            $message = "Product successfully added to cart";
            $this->updateCartTotal($cart_id);
        }else if($response == 2) {
            $success = 1;
            $error = 0;
            $message = "Product successfully updated";
            $this->updateCartTotal($cart_id);
        } else {
            $success = 0;
            $error = 1;
            $message = $response;
        }

        $response_data = array("success" => $success,"error" => $error,'message' => $message);
        return $response_data;
    }

    public function getCartDetails($cart_id) {
        global $cf,$page_data,$url,$conn;
        $sqlGetCartData = "SELECT * FROM `ec_cart` WHERE `cart_id` = '$cart_id'";
        return $cf->getOneData($sqlGetCartData);
    }

    public function getCartProductDetails($cart_id) {
        global $cf,$page_data,$url,$conn;
        $sqlGetCartData = "SELECT cp.*,p.file1 FROM `ec_cart_product` cp LEFT JOIN `ec_products` p ON p.item_id = cp.item_id WHERE cp.cart_id = '$cart_id'";
        return $cf->getData($sqlGetCartData);
    }
    public function emptycart($cart_id){
        global $cf,$page_data,$url,$conn;
        $success = "1";
        $error = "0";
        $message = "Your cart is empty now.";
        $sqlDelete = "DELETE FROM `ec_cart_product` WHERE cart_id = '$cart_id'";
        $stmt = $conn->prepare($sqlDelete); 
        $stmt->execute();
        $this->updateCartTotal($cart_id);
        $response_data = array("success" => $success,"error" => $error,'message' => $message);
        echo json_encode($response_data);exit;
    }

    public function updateCartItems($quantity,$cart_product_id) {
        global $cf,$page_data,$url,$conn;
        $success = "1";
        $error = "0";
        $message = "Your items updated successfully";

        $item_price_total = 0;
        $item_tax_total = 0;
        $item_shipping_total = 0;
        $final_item_price = 0;
        $cart_id = 0;
        
        $sqlUpdate = "UPDATE `ec_cart_product` SET `ordered_quantity` = '$quantity' WHERE cart_product_id = '$cart_product_id'";
        $stmt = $conn->prepare($sqlUpdate); 
        $stmt->execute();

        $sqlGetCartProductData = "SELECT cart_id,ordered_quantity,product_option_price,item_tax_amount,item_shipping_amount FROM `ec_cart_product` WHERE `cart_product_id` = '$cart_product_id'";
        $arrExistingData = $cf->getOneData($sqlGetCartProductData);
        if(isset($arrExistingData) && !empty($arrExistingData)) {
            $cart_id = $arrExistingData['cart_id'];
            $item_price_total = $arrExistingData['product_option_price'] * $arrExistingData['ordered_quantity'];
            $item_tax_total = $arrExistingData['item_tax_amount'] * $arrExistingData['ordered_quantity'];
            $item_shipping_total = $arrExistingData['item_shipping_amount'] * $arrExistingData['ordered_quantity'];
            $final_item_price = $item_price_total+$item_tax_total+$item_shipping_total;
        }

        $sqlUpdate = "UPDATE `ec_cart_product` SET `item_price_total` = '$item_price_total',`item_tax_total` = '$item_tax_total',`item_shipping_total` = '$item_shipping_total',`final_item_price` = '$final_item_price' WHERE cart_product_id = '$cart_product_id'";
        $stmt = $conn->prepare($sqlUpdate); 
        $stmt->execute();

        $this->updateCartTotal($cart_id);
        $response_data = array("success" => $success,"error" => $error,'message' => $message,'item_price_total' => $item_price_total,'item_tax_total' => $item_tax_total,'item_shipping_total' => $item_shipping_total,'final_item_price' => $final_item_price,'cart_product_id' => $cart_product_id,'ordered_quantity' => $quantity);
        echo json_encode($response_data);exit;
    }

    public function deleteCartItems($cart_id,$cart_product_id) {
        global $cf,$page_data,$url,$conn;
        $sqlDelete = "DELETE FROM `ec_cart_product` WHERE cart_product_id = '$cart_product_id'";
        $stmt = $conn->prepare($sqlDelete); 
        $stmt->execute();
        $this->updateCartTotal($cart_id);
        $response_data = array("success" => $success,"error" => $error,'message' => $message);
        echo json_encode($response_data);exit;
    }

    public function updateCartBillingAddress() {
        global $cf,$page_data,$url,$conn;
        $finalstring = "";
        $querystr = "";
        $customer_id = 0;
        $customer_name = "";
        //echo "Model called.......";
        //print_r($_REQUEST);exit;

        $sqlCheckCustomer = "SELECT `customer_id`,`email`,`first_name`,`last_name` FROM `customers` WHERE `email` = '".$_REQUEST['billing_email']."'";
        $arrCustomer = $cf->getOneData($sqlCheckCustomer);
        if($arrCustomer['email'] == ''){
           $sqlInsert = "INSERT INTO `customers` SET first_name = '".$_REQUEST['billing_first_name']."',last_name = '".$_REQUEST['billing_last_name']."',user_address1 = '".$_REQUEST['billing_address_1']."',user_address2 = '".$_REQUEST['billing_address_2']."',user_city = '".$_REQUEST['billing_city']."',user_state = '".$_REQUEST['billing_state']."',user_country = '".$_REQUEST['billing_country']."',user_zipcode = '".$_REQUEST['billing_zipcode']."',guest_customer = '1',role_id = '1',contact_number = '".$_REQUEST['billing_contact']."',email = '".$_REQUEST['billing_email']."'";
           $stmt = $conn->prepare($sqlInsert);
           $stmt->execute();
           $insert_customer_id = $conn->lastInsertId(); 
           $_REQUEST['customer_id'] = $insert_customer_id;
           $_REQUEST['customer_name'] = $_REQUEST['billing_first_name']." ".$_REQUEST['billing_last_name'];
        } else {
            if($arrCustomer['email'] != '') {
                $customer_id = $arrCustomer['customer_id'];
                $customer_name = $arrCustomer['first_name']." ".$arrCustomer['last_name'];
                $_REQUEST['customer_name'] = $customer_name;
            }
            $_REQUEST['customer_id'] = $customer_id;
        }

        foreach ($_REQUEST as $field => $value) {
            if ($field == 'cart_id' || $field == 'submit' || $field == 'billing_shipping_same' || $field == 'PHPSESSID' || $field == '_ga' || $field == '__cfduid' || $field == '_gid' || $field == '_gat_gtag_UA_150266819_1') {
                continue;
            } else {
                $querystr .= "`$field`='" . addslashes($value) . "', ";
            }
        }
        $finalstring = substr($querystr, 0, -2);
        $sql = "UPDATE `ec_cart` SET $finalstring WHERE cart_id = " . $_REQUEST['cart_id'];
        $stmt = $conn->prepare($sql); 
        $stmt->execute();

        $sqlCartProducts = "UPDATE `ec_cart_product` SET `customer_id` = '$customer_id' WHERE cart_id = " . $_REQUEST['cart_id'];
        $stmt = $conn->prepare($sqlCartProducts); 
        $stmt->execute();

        $success = 1;
        $error = 0;
        $message = "Your cart updated successfully.";
        $response = array("success" => $success,"error" => $error,'message' => $message);
        echo json_encode($response);exit;
    }

    public function verifyItemsQuantity($cart_id) {
        global $cf,$page_data,$url,$conn,$front_session_name;
        $quantity_available = "";

        $product_price_id = "0";
        $ordered_quantity = "0";
        $item_name = "";

        $sqlProducts = "SELECT product_price_id,ordered_quantity,item_name FROM ec_cart_product WHERE cart_id = '$cart_id'";
        $arrOrderProductDetails = $cf->getData($sqlProducts);
        if(isset($arrOrderProductDetails) && !empty($arrOrderProductDetails)){
            foreach($arrOrderProductDetails as $products):
                $product_price_id = $products['product_price_id'];
                $ordered_quantity = $products['ordered_quantity'];
                $item_name = $products['item_name'];
                $store_quantity = 0;
                $sqlProductPrice = "SELECT `product_quantity` FROM `ec_product_price` WHERE `product_price_id` = '$product_price_id'";
                $arrProductPrices = $cf->getOneData($sqlProductPrice);
                if(isset($arrProductPrices) && !empty($arrProductPrices)){
                    $store_quantity = $arrProductPrices['product_quantity'];
                }
                if($store_quantity < $ordered_quantity) {
                    $quantity_available .= "<br />".$item_name." Having insufficient Quantity. You can order maximum ".$store_quantity;
                }
            endforeach;
        }

        if($quantity_available != "") {
            $_SESSION[$front_session_name]['quantity_error'] = $quantity_available;
        }
        return $quantity_available;
    }

    public function placeOrder() {
        global $cf,$page_data,$url,$conn,$front_session_name;
        $cart_id = 0;
        $insert_order_id = 0;
        $success = "1";
        $error = "0";
        $message = "Your order has been failed due to technical reason. Please contact administrator for the same.";
        if(isset($_REQUEST['cart_id']) && $_REQUEST['cart_id'] > 0){
            $cart_id = $_REQUEST['cart_id'];
        }
        
        if(isset($cart_id) && $cart_id > 0) {
            
            // $sqlCustomerVerify = "SELECT customer_id FROM `ec_cart` WHERE cart_id = '$cart_id'";
            // $arrCartData = $cf->getOneData($sqlCustomerVerify);
            // print_r($arrCartData);exit;

            $verifyQuantity = $this->verifyItemsQuantity($cart_id); 
            if($verifyQuantity != '') {
                $success = 0;
                $error = 1;
                $message = $verifyQuantity;
            } else {
                $cartOrderColumn = "cart_id,cart_sub_id,session_id,is_customer,customer_id,customer_name,billing_first_name,billing_last_name,billing_address_1,billing_address_2,billing_city,billing_state_id,billing_state,billing_country_id,billing_country,billing_zipcode,billing_contact,billing_email,shipping_first_name,shipping_last_name,shipping_address_1,shipping_address_2,shipping_city,shipping_state_id,shipping_state,shipping_country,shipping_country_id,shipping_zipcode,shipping_contact,shipping_email,coupon_code,coupon_type,item_coupon_type,currancy,cashback_amount_applied,coupon_amount_applied,cashback_wallet_amount_used,total_ordered_quantity,total_items_amount,total_items_tax_amount,total_items_shipping_amount,order_total,ip_address,payment_type,shipping_type,shipping_amount,device,device_id,device_type,browser_name,user_agent,browser_version,platform,browser_pattern,site_id,order_notes";
                $order_id_unique = time().$cart_id;
                $sqlInsertorder = "INSERT INTO ec_order ($cartOrderColumn,order_status,payment_status,created_at,updated_at,order_id_unique) SELECT $cartOrderColumn,'pending','Payment Pending',NOW(),NOW(),$order_id_unique FROM ec_cart WHERE `cart_id` = '".$cart_id."'";
                $stmt = $conn->prepare($sqlInsertorder);
                $stmt->execute();
                $insert_order_id = $conn->lastInsertId();
                
                if($insert_order_id > 0) {
                    $message = "Order Has been successfully Placed.";
                    $cartOrderProductsColumn = "cart_id,cart_sub_id,customer_id,item_id,user_id,product_price_id,item_name,item_alias,ordered_quantity,product_attribute_1,product_attribute_2,product_attribute_3,product_option_1,product_option_2,product_option_3,product_option_4,product_option_price,product_option_price_display,currancy,item_tax_amount,item_shipping_amount,is_default_price,product_quantity,special_price_from_date,special_price_to_date,item_price_total,item_tax_total,item_shipping_total,final_item_price";
                    $sqlInsertOrderProduct = "INSERT INTO `ec_order_products` ($cartOrderProductsColumn,created_at,updated_at,order_id) SELECT $cartOrderProductsColumn,NOW(),NOW(),$insert_order_id FROM `ec_cart_product` WHERE `cart_id` = '".$cart_id."'";
                    $stmt = $conn->prepare($sqlInsertOrderProduct);
                    $stmt->execute();
                }

                $sqlGetOrderDetails = "SELECT cashback_amount_applied,customer_id,cashback_wallet_amount_used FROM `ec_order` WHERE order_id = '$insert_order_id' AND cashback_amount_applied > 0";
                $arrOrderDetails = $cf->getOneData($sqlGetOrderDetails);
                if(isset($arrOrderDetails) && $arrOrderDetails != false) {
                    $wallet_amount = $arrOrderDetails['cashback_amount_applied'];
                    $customer_id = $arrOrderDetails['customer_id'];
                    $cashback_wallet_amount_used = $arrOrderDetails['cashback_wallet_amount_used'];
                    
                    $insertTransaction = "INSERT INTO `ec_cashback_credit_transaction` SET `order_id` = '$insert_order_id', `customer_id` = '".$arrOrderDetails['customer_id']."', `cashback_amount` = '".$wallet_amount."'";
                    $stmt = $conn->prepare($insertTransaction);
                    $stmt->execute();
        
                    if(isset($cashback_wallet_amount_used) && $cashback_wallet_amount_used > 0) {
                        $sqlUpdate = "UPDATE `customers` SET wallet_amount = wallet_amount-$cashback_wallet_amount_used WHERE `customer_id` = '$customer_id'";
                        $stmt = $conn->prepare($sqlUpdate);
                        $stmt->execute();
                    }

                    if(isset($wallet_amount) && $wallet_amount > 0){
                        $sqlUpdate = "UPDATE `customers` SET wallet_amount = wallet_amount+$wallet_amount WHERE `customer_id` = '$customer_id'";
                        $stmt = $conn->prepare($sqlUpdate);
                        $stmt->execute();
                    }
                }
        
                if($insert_order_id > 0) {
                    $sqlUpdate = "UPDATE `ec_cart` SET coupon_code = '',coupon_type='',item_coupon_type='',cashback_amount_applied='0.00',coupon_amount_applied='0.00',cashback_wallet_amount_used='0.00',total_ordered_quantity='0.00',total_items_amount='0.00',total_items_tax_amount='0.00',total_items_shipping_amount='0.00',shipping_amount = '0.00',order_total='0.00' WHERE `cart_id` = '$cart_id'";
                    $sqlUpdate .= ";DELETE FROM `ec_cart_product` WHERE `cart_id` = '$cart_id'";
                    $stmt = $conn->prepare($sqlUpdate);
                    $stmt->execute();
                    

                    //Reduce product quantity from product price table start //
                    $product_price_id = 0;
                    $ordered_quantity = 0;
                    if(REDUCE_QTY_ON_ORDER == 'Y') {
                        $sqlProducts = "SELECT product_price_id,ordered_quantity FROM ec_order_products WHERE order_id = '$insert_order_id'";
                        $arrOrderProductDetails = $cf->getData($sqlProducts);
                        
                        if(isset($arrOrderProductDetails) && !empty($arrOrderProductDetails)){
                            foreach($arrOrderProductDetails as $products):
                            $product_price_id = $products['product_price_id'];
                            $ordered_quantity = $products['ordered_quantity'];
                            
                            $sqlReduceQuantity = "UPDATE `ec_product_price` SET product_quantity = product_quantity-$ordered_quantity WHERE product_price_id = '$product_price_id'";
                            //echo $sqlReduceQuantity;
                            $stmt = $conn->prepare($sqlReduceQuantity);
                            $stmt->execute();
                            endforeach;
                        }
                    }
                    //Reduce product quantity from product price table over //
                    
                    //$this->reduceItemsQuantity($insert_order_id);
                    $cf->sentOrderEmail($insert_order_id);
                }
            }
        }
        
        $response_data = array("success" => $success,"error" => $error,'message' => $message,'order_id' => $insert_order_id);
        echo json_encode($response_data);exit;
    }

    public function reduceItemsQuantity($insert_order_id) {
        global $cf,$conn;
        $product_price_id = 0;
        $ordered_quantity = 0;
        if(REDUCE_QTY_ON_ORDER == 'Y') {
            $sqlProducts = "SELECT product_price_id,ordered_quantity FROM ec_order_products WHERE order_id = '$insert_order_id'";
            $arrOrderProductDetails = $cf->getData($sqlProducts);
            //print_r($arrOrderProductDetails);
            
            if(isset($arrOrderProductDetails) && !empty($arrOrderProductDetails)){
                foreach($arrOrderProductDetails as $products):
                $product_price_id = $products['product_price_id'];
                $ordered_quantity = $products['ordered_quantity'];
                
                $sqlReduceQuantity = "UPDATE `ec_product_price` SET product_quantity = product_quantity-$ordered_quantity WHERE product_price_id = '$product_price_id'";
                //echo $sqlReduceQuantity;
                $stmt = $conn->prepare($sqlReduceQuantity);
                $stmt->execute();
                endforeach;
            }
        }
    }
}
?>