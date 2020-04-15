<?php
require_once $theme_path.'model/Home.php';
class Homecontroller {

    public $model;
    public function __construct(){
        $this->model = new Home();
    }

    public function index() {
        global $theme_path,$theme_url,$cf;
        $arrBanners = $this->model->getBanners();
        $arrDescription = $this->model->getHomedata();
        require $theme_path.'views/home.php';
    }

    public function default() {
        global $theme_path,$theme_url,$cf;
        require $theme_path.'views/404.php';
    }
    public function insertLogs() {
        global $theme_path,$theme_url,$cf;
        $url = "";
        if(isset($_REQUEST['url']) && $_REQUEST['url'] != ''){
            $url = $_REQUEST['url'];
        }
        $cf->internet_details($url);
    }

    public function subscribe() {
        global $theme_path,$theme_url,$cf,$conn;
        $url = "";
        $record_name = "";
        $message = "Your email address already registered.";
        $success = 0;
        $error = 1;

        $sql = "SELECT * FROM `subscriber` WHERE email_address = '".$_REQUEST['email']."'";
        $arrData = $cf->getOneData($sql);
        if(isset($arrData) && $arrData != false){
            $record_name = $arrData['email_address'];
        }
        if($record_name == '') {
            $sqlInsert = "INSERT INTO `subscriber` SET `email_address` = '".$_REQUEST['email']."',created_at = NOW(), updated_at = NOW()";
            $stmt = $conn->prepare($sqlInsert); 
            $stmt->execute();
            $message = "You are now successfully subscribed for newsletter.";
            $success = 1;
            $error = 0;
        }
        $response = array("success" => $success,"error" => $error,'message' => $message);
        echo json_encode($response);exit;
    }

    public function addToCart() {
        //print_r($_REQUEST);exit;
        $cart_id = 0;
        $item_id = 0;
        $product_price_id = 0;
        $quantity = 0;
        $has_option = 'N';

        if(isset($_REQUEST['cart_id']) && $_REQUEST['cart_id'] > 0) {
            $cart_id = $_REQUEST['cart_id'];
        }
        if(isset($_REQUEST['item_id']) && $_REQUEST['item_id'] > 0) {
            $item_id = $_REQUEST['item_id'];
        }
        if(isset($_REQUEST['product_price_id']) && $_REQUEST['product_price_id'] > 0) {
            $product_price_id = $_REQUEST['product_price_id'];
        }
        if(isset($_REQUEST['quantity']) && $_REQUEST['quantity'] > 0) {
            $quantity = $_REQUEST['quantity'];
        }
        if(isset($_REQUEST['has_option']) && $_REQUEST['has_option'] > 0) {
            $has_option = $_REQUEST['has_option'];
        }

        if($cart_id == 0 || $item_id == 0 || $product_price_id == 0) {
            $success = 0;
            $error = 1;
            $message = "Invalid product details. Please refresh page and try again.";
        } else {
            $arrResponse = $this->model->updateCartProducts($cart_id,$item_id,$product_price_id,$quantity,$has_option);
            if(isset($arrResponse) && !empty($arrResponse)) {
                $success = $arrResponse['success'];
                $error = $arrResponse['error'];
                $message = $arrResponse['message'];
            }
        }
        $response = array("success" => $success,"error" => $error,'message' => $message);
        echo json_encode($response);exit;

    }

    public function display_cart() {
        global $theme_path,$theme_url,$cf,$cart_id;
        $arrCartDetails = $this->model->getCartDetails($cart_id);
        $arrCartProductDetails = $this->model->getCartProductDetails($cart_id);
        require $theme_path.'views/display_cart.php';
    }

    public function emptycart() {
        $cart_id = 0;
        if(isset($_REQUEST['cart_id']) && $_REQUEST['cart_id'] > 0){
            $cart_id = $_REQUEST['cart_id'];
        }
        $this->model->emptycart($cart_id);
    }

    public function updateCartItems() {
        $cart_product_id = $_REQUEST['cart_product_id'];
        $quantity = $_REQUEST['quantity'];
        $this->model->updateCartItems($quantity,$cart_product_id);
    }

    public function deleteCartItem() {
        $cart_product_id = $_REQUEST['cart_product_id'];
        $cart_id = $_REQUEST['cart_id'];
        $this->model->deleteCartItems($cart_id,$cart_product_id);
    }

    public function display_checkout() {
        global $theme_path,$theme_url,$cf,$cart_id;
        $arrCartDetails = $this->model->getCartDetails($cart_id);
        $arrCartProductDetails = $this->model->getCartProductDetails($cart_id);
        require $theme_path.'views/display_checkout.php';
    }

    public function placeOrder() {
        $this->model->placeOrder();
    }

    public function ordersuccess(){
        global $theme_path,$theme_url,$cf,$cart_id;
        $order_id = 0;
        if(isset($_REQUEST['order_id']) && $_REQUEST['order_id'] > 0) {
            $order_id = $_REQUEST['order_id'];
        }
        //$this->model->reduceItemsQuantity($order_id);
        require $theme_path.'views/display_ordersuccess.php';
    }

    public function updateCartBillingAddress() {
        global $theme_path,$theme_url,$cf,$cart_id;
        $this->model->updateCartBillingAddress();
        print_r($_REQUEST);exit;
    }
}
?>