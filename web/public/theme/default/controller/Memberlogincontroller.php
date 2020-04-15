<?php

require_once $theme_path.'Commonfunctions.php';
class Memberlogincontroller {

    public $model;
    public function __construct(){
        $this->model = new Commonfunctions();
    }

    public function index() {
        global $theme_path,$theme_url;
        require $theme_path.'views/memberlogin.php';
    }

    public function memberforgotpassword() {
        global $theme_path,$theme_url;
        require $theme_path.'views/memberforgotpassword.php';
    }

    public function memberresetpassword() {
        global $theme_path,$theme_url;
        $token = "";
        if(isset($_REQUEST['token']) && $_REQUEST['token'] != "") {
            $token = $_REQUEST['token'];
        }
        require $theme_path.'views/resetpassword.php';
    }

    public function checkLogin(){
        global $theme_path,$theme_url,$back_session_name,$cf;
        $login_id = 0;
        require_once($theme_path.'getRequestData.php');
        $save_request = serialize($_REQUEST);
        $arrData = $this->model->memberLoginCheck();

        $save_response = serialize($arrData);
        if($save_request != '' && $save_response != ''){
            if(isset($_SESSION[$back_session_name]['user_id']) && $_SESSION[$back_session_name]['user_id'] > 0){
                $login_id = $_SESSION[$back_session_name]['user_id'];
            }
            $cf->saveRequests($save_request,$save_response,'users','loginaction',$login_id);
        }

        echo json_encode($arrData);exit;
    }

    public function memberlogout() {
        global $theme_path,$theme_url,$url;
        $arrData = $this->model->memberLogout();
        echo json_encode($arrData);exit;
    }

    public function checkForgotpassword() {
        global $theme_path,$theme_url,$url;
        require_once($theme_path.'getRequestData.php');
        $arrData = $this->model->memberCheckemailexists();
        echo json_encode($arrData);exit;
    }

    public function loginmemberdetails() {
        global $theme_path,$theme_url,$url;
        $arrData = $this->model->loginmemberdetails();
        echo json_encode($arrData);exit;
    }

    public function checkResetpassword() {
        global $theme_path,$theme_url,$url;
        $arrData = $this->model->checkResetpassword();
        echo json_encode($arrData);exit;
    }
    
}
?>