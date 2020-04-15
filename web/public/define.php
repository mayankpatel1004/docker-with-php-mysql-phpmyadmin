<?php
$folder_name = "";
$url = "http://localhost:8000".$folder_name."/";
$servername = "mysql";
$username = "root";
$password = "root";
$databasename = "test";
$cnonical_prefix = "";
$cms_website = "1";
$is_live = 0;
$word = "cloudswiftsolutions.com";
$mystring = $_SERVER['SERVER_NAME'];
$port = "";

if(strpos($mystring, $word) !== false){
  $folder_name = "/";
  $url = "https://www.cloudswiftsolutions.com".$folder_name;
  $cnonical_prefix = "https://www.cloudswiftsolutions.com/";
	$servername = "localhost";
	$username = "u148603101_clou";
	$password = "Online@112018";
	$databasename = "u148603101_cloudswiftsol";
	$cms_website = "1";
  $is_live = 1;
  $port = "";
}

define('DISPLAY_CATEGORY','Y');
define('DISPLAY_WEIGHT','Y');
define('DISPLAY_INSTOCK','Y');
define('DISPLAY_SHIPPING_PRICE','Y');
define('DISPLAY_DESCRIPTION','Y');
define('DISPLAY_TERMS_CONDITIONS','Y');
define('DISPLAY_ADD_TO_CART','Y');
define('DISPLAY_PRICE','Y');
define('DISPLAY_REVIEWS','Y');
define('DISPLAY_SPECIFICATIONS','Y');
define('DISPLAY_WRITE_REVIEWS','Y');
define('DISPLAY_RELATED_PRODUCTS','Y');

define('ORDER_EMAIL_TO_USERS','Y'); //Send email to individual seller after place order

define('GUEST_POST','Y');
define('MY_ORDERS','Y');
define('REDUCE_QTY_ON_ORDER','Y');

$path = dirname(__FILE__)."/";
$theme_url = $url.'theme/default/';
$theme_path = $path."theme/default/";


ini_set('log_errors',1);
ini_set('error_log','log.txt');

$front_session_name = "frontendapp";
$back_session_name = "backendapp";
$page_data = array();

define('DEVICETYPE','desktop');
define('DEVICEID','123');
define('APPVERSION','1.0');
define('DATE_FORMAT','d/m/Y');
define('DATETIME_FORMAT','d/m/Y h:i:s');
define('ITEMS_PATH',$path.'uploads/items/');
define('ITEMS_URL',$url.'uploads/items/');
define('PRODUCTS_PATH',$path.'uploads/products/');
define('PRODUCTS_URL',$url.'uploads/products/');
define('MEDIA_PATH',$path.'uploads/media/');
define('MEDIA_URL',$url.'uploads/media/');
define('DEFAULT_PATH',$path.'uploads/default/');
define('DEFAULT_URL',$url.'uploads/default/');

$front_end_rpp = "20";
$back_end_rpp = "10";

$backend_allow_action_dropdown = "Y";
$backend_allow_apply_button = "Y";
$backend_allow_addnew_button = "Y";
$currancy = "$";

try {
    //echo $servername.'==='.$port.'==='.$databasename."===".$username."==".$password;exit;
    if($port != ""){
      $conn = new PDO("mysql:host=$servername.$port;dbname=".$databasename, $username, $password);
    }else {
      $conn = new PDO("mysql:host=$servername;dbname=".$databasename, $username, $password);
    }
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
}
catch(PDOException $e) {
    echo "Database Connection Failed: " . $e->getMessage();
    die();
}

require_once $theme_path.'Commonfunctions.php';
$cf = new Commonfunctions();

if(isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != ''){
    $arrData = explode($folder_name,$_SERVER['REQUEST_URI']. '?' . $_SERVER['QUERY_STRING']);
} else {
  if($folder_name != ""){
    $arrData = explode($folder_name,$_SERVER['REQUEST_URI']);
  }
}
$arrControllerdetails = $cf->getUrldetails();
$controller = $arrControllerdetails['controller'].'controller';
$action = $arrControllerdetails['action'];
if(isset($arrControllerdetails['page_data']) && !empty($arrControllerdetails['page_data'])){
  $page_data = $arrControllerdetails['page_data'];
}
?>