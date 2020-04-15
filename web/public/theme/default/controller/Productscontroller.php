<?php
require_once $theme_path.'model/Allproducts.php';

class Productscontroller {
    public $model;
    public function __construct(){
        $this->model = new Allproducts();
    }

    public function index() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$conn,$back_session_name;
        //print_r($page_data);
        $item_type = "products";
        $item_alias = "";
        $sort_type = "desc";
        $sort_by = "item_id";
        $records_per_page = $back_end_rpp;
        $page_no = "1";
        $searchtext = '';
        $sortbytext = '';
        
        if(isset($page_data['item_type']) && $page_data['item_type'] != "") {
            $item_type = $page_data['item_type'];
        }
        
        if(isset($page_data['item_alias']) && $page_data['item_alias'] != "") {
            $item_alias = $page_data['item_alias'];
        }
        
        if(isset($_REQUEST['reset']) && $_REQUEST['reset'] == '1'){
            unset($_SESSION[$back_session_name][$item_alias]);
            header('Location:'.$url.$item_alias);
        }

        if(isset($_SESSION[$back_session_name][$item_alias]['search_text']) && $_SESSION[$back_session_name][$item_alias]['search_text'] != ''){
            $searchtext = $_SESSION[$back_session_name][$item_alias]['search_text'];
        }

        if(isset($_SESSION[$back_session_name][$item_alias]['page_no']) && $_SESSION[$back_session_name][$item_alias]['page_no'] != ''){
            $page_no = $_SESSION[$back_session_name][$item_alias]['page_no'];   
        }

        if(isset($_SESSION[$back_session_name][$item_alias]['records_per_page']) && $_SESSION[$back_session_name][$item_alias]['records_per_page'] != ''){
            $records_per_page = $_SESSION[$back_session_name][$item_alias]['records_per_page'];
        }

        if(isset($_SESSION[$back_session_name][$item_alias]['sort_by']) && $_SESSION[$back_session_name][$item_alias]['sort_by'] != ''){
            $sortbytext = $_SESSION[$back_session_name][$item_alias]['sort_by'];
            $arrData = explode('__',$sortbytext);
            if(isset($arrData[2]) && $arrData[2] != ''){$sort_type = $arrData[2];}
            else{$sort_type = $arrData[1];}
            if(isset($arrData[1]) && ($arrData[1] != 'asc' && $arrData[1] != 'desc')){
                $sort_by = $arrData[0]."_".$arrData[1];
            }
            else{
                $sort_by = $arrData[0];
            }
        }
        
        $page_url = $url.$item_alias."/indexAjax";
        $reset_url = $url.$item_alias.'/index/?reset=1';
        $add_url = $url.$item_alias."/form";
        $columns_header = "Rec-ID,Title,Alias,Weight,Instock,Active,Created At,ID";
        $sort_array = array(
            'item_id__asc' => 'Oldest First',
            'item_id__desc' => 'Newest First',
            'item_title__asc' => 'Title ASC',
            'item_title__desc' =>'Title DESC'
        );
        //print_r($_SESSION[$back_session_name][$item_alias]);
        require $theme_path.'views/products.php';
    }

    public function indexAjax() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data;
        $this->model->getListFront();
    }

    public function detail() {
        global $theme_path;
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $parts = explode("/",$actual_link);
        $alias = end($parts);
        $arrProductData = $this->model->getProductDetails($alias);
        require $theme_path.'views/productdetail.php';
    }

    public function reviewform() {
        global $cf,$conn,$front_session_name;
        $login_id = 0;
        if(isset($_SESSION[$front_session_name]['customer_id']) && $_SESSION[$front_session_name]['customer_id'] > 0){
            $login_id = $_SESSION[$front_session_name]['customer_id'];
        }
        $validate = array();
        $sqlInsert = "INSERT INTO `ec_product_reviews` SET 
        `item_id` = '".$_REQUEST['item_id']."',
        `item_alias` = '".$_REQUEST['item_alias']."',
        `customer_name` = '".addslashes($_REQUEST['customer_name'])."',
        `customer_id` = '".$login_id."',
        `display_status` = 'Y',
        `customer_email` = '".addslashes($_REQUEST['customer_email'])."',
        `customer_phone` = '".addslashes($_REQUEST['customer_phone'])."',
        `ratings` = '".addslashes($_REQUEST['ratings'])."',
        `review_text` = '".addslashes($_REQUEST['review_text'])."',
        `created_at` = NOW()";
        $stmt = $conn->prepare($sqlInsert); 
        $stmt->execute();
        $success = 1;
        $error = 0;
        $message = "Your Review successfully saved.";

        $response = array("success" => $success,"error" => $error,'message' => $message,'values' => $validate);
        echo json_encode($response);exit;
    }

    public function getAjaxOptions() {
        $this->model->getAjaxOptions();
    }
}
?>