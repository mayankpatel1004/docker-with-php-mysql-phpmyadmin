<?php
require_once $theme_path.'model/Allloginlogs.php';
class Allloginlogscontroller {

    public $model;
    public function __construct(){
        $this->model = new Allloginlogs();
    }

    public function index() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$conn,$back_session_name;
        //print_r($page_data);
        $cf->checkAdminLogin();
        $item_type = "login";
        $item_alias = "allitemlogs";
        $sort_type = "desc";
        $sort_by = "log_id";
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
        $columns_header = "Rec-ID,User Name,Email,Platform,Browser,Created At";
        $sort_array = array(
            'log_id__asc' => 'Oldest First',
            'log_id__desc' => 'Newest First',
            'user_name__asc' => 'Title ASC',
            'user_name__desc' =>'Title DESC'
        );
        require $theme_path.'views/allloginlogs.php';
    }

    public function indexAjax() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data;
        $this->model->getList();
    }
}
?>