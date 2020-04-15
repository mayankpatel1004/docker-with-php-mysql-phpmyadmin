<?php

require_once $theme_path.'model/Siteconfiguration.php';
class Siteconfigurationcontroller {

    public $model;
    public function __construct(){
        $this->model = new Siteconfiguration();
    }

    public function setConfigdata() {
        global $back_session_name,$conn,$theme_path,$url,$cf;
        $sql = "SELECT * FROM `site_config` WHERE `display_status` = 'Y' AND `deleted_status` = 'N'";
        $arrData = $cf->getData($sql);
        
        $write = "";
        $write .= "<?php";
        $write .= "\r\n";
        foreach($arrData as $key=>$value) {
            $key = $value['config_name'];
            $value = $value['config_value'];
            $write .= "define('".$key."','".addslashes($value)."');";
            $write .="\r\n";
        }
        $write .= "?>";
        file_put_contents($theme_path."generated_files/configdata.php",$write);

        $sitemapType = "SELECT DISTINCT(item_type) FROM `items` WHERE admin_module = 'N' AND display_status = 'Y' AND deleted_status = 'N'";
        $arrType = $cf->getData($sitemapType);
        if(isset($arrType) && !empty($arrType)) {
            $return = "";
            $arrParent = [];
            foreach($arrType as $type) {
                $type = $type['item_type'];   
                $sqlSitemap = "SELECT item_id,item_title,item_type,item_alias FROM `items` WHERE `html_sitemap` = 'Y' AND `robots` = 'INDEX,FOLLOW' AND `item_type` = '$type' AND `admin_module` = 'N' AND `display_status` = 'Y' AND `deleted_status` = 'N' ORDER BY `html_sitemap_order` ASC,`item_id` DESC";
                $arrData = $cf->getData($sqlSitemap);
                if(isset($arrData) && !empty($arrData)){
                    foreach($arrData as $key=>$value) {
                        $arrParent[$type][] = array('title' => $value['item_title'],'alias' => $value['item_alias']);
                    }
                }
            }
        }
        file_put_contents($theme_path."generated_files/sitemapdata.php",serialize($arrParent));
    }

    public function index() {
        $this->setConfigdata();
        
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data;
        $cf->checkAdminLogin();
        $item_alias = "pages";
        if(isset($page_data['item_alias']) && $page_data['item_alias'] != ''){
            $item_alias = $page_data['item_alias'];
        }
        
        $sort_type = "asc";
        $sort_by = "item_id";
        $records_per_page = $back_end_rpp;
        $searchtext = '';
        $sortbytext = '';
        if(isset($_REQUEST['reset']) && $_REQUEST['reset'] == '1'){
            unset($_SESSION[$item_alias]);
            header('Location:'.$url.$item_alias);
        }
        $page_url = $url.$item_alias."/indexAjax";
        $reset_url = $url.$item_alias.'/index/?reset=1';
        $add_url = $url.$item_alias."/form";
        $columns_header = "Title,Alias,Status,Created,Updated,ID";
        $arrData = $this->model->getList();
        $arrChilddata = array();
        if(isset($arrData) && !empty($arrData)) {
            $arrChilddata = $arrData['arrChildData'];
        }
        
        $sort_array = array(
            'display_order__asc' => 'Oldest First',
            'display_order__desc' => 'Newest First'
        );
        require $theme_path.'views/siteconfiguration.php';
    }

    public function indexAjax() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data;
        $this->model->getList();
    }

    public function saveformdata() {
        
         //echo "<pre>";print_r($_REQUEST);exit;
            if(isset($_REQUEST['__cfduid']) && $_REQUEST['__cfduid'] != ''){
                unset($_REQUEST['__cfduid']);
                unset($_REQUEST['_ga']);
                unset($_REQUEST['PHPSESSID']);
            }

        if (isset($_FILES["DEFAULT_AVTAR"]["name"]) && $_FILES["DEFAULT_AVTAR"]["name"] != "") {
            $filename = $_FILES["DEFAULT_AVTAR"]["name"];
            $tmp_filename = $_FILES["DEFAULT_AVTAR"]["tmp_name"];
            $temp = explode(".", $filename);
            $newfilename = time() . "_" . rand() . '.' . end($temp);
            if (move_uploaded_file($tmp_filename, ITEMS_PATH . $newfilename)) {
                $_REQUEST["DEFAULT_AVTAR"] = $newfilename;
            }
        }
        
        $querystr = '';
        global $conn;
        if(isset($_REQUEST) && !empty($_REQUEST)) {
            foreach($_REQUEST as $key => $value) {
                $value = addslashes($value);
                $sql = "UPDATE `site_config` SET config_value = '$value' WHERE config_name = '$key'";
                $stmt = $conn->prepare($sql); 
                $stmt->execute();
            }
        }
        $response = array("success" => 1,"error" => 0);
        echo json_encode($response);exit;
    }
}
?>