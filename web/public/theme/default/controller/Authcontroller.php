<?php

require_once $theme_path.'Commonfunctions.php';
class Authcontroller {

    public $model;
    public function __construct(){
        $this->model = new Commonfunctions();
    }

    public function index() {
        global $theme_path,$theme_url;
        require $theme_path.'views/login.php';
    }

    public function register() {
        global $theme_path,$theme_url;
        require $theme_path.'views/register.php';
    }

    public function forgotpassword() {
        global $theme_path,$theme_url;
        require $theme_path.'views/forgotpasswords.php';
    }

    public function resetpasswords() {
        global $theme_path,$theme_url;
        $token = "";
        if(isset($_REQUEST['token']) && $_REQUEST['token'] != "") {
            $token = $_REQUEST['token'];
        }
        require $theme_path.'views/resetpasswords.php';
    }

    public function checkLogin(){
        global $theme_path,$theme_url,$front_session_name,$cf;
        $login_id = 0;
        require_once($theme_path.'getRequestData.php');
        $save_request = serialize($_REQUEST);
        $arrData = $this->model->authLoginCheck();

        $save_response = serialize($arrData);
        if($save_request != '' && $save_response != ''){
            if(isset($_SESSION[$front_session_name]['customer_id']) && $_SESSION[$front_session_name]['customer_id'] > 0){
                $login_id = $_SESSION[$front_session_name]['customer_id'];
            }
            $cf->saveRequests($save_request,$save_response,'customers','customerlogin',$login_id);
        }
        echo json_encode($arrData);exit;
    }

    public function checkRegister(){
        global $theme_path,$theme_url,$front_session_name,$cf;
        $login_id = 0;
        require_once($theme_path.'getRequestData.php');
        $save_request = serialize($_REQUEST);
        $arrData = $this->model->authRegisterCheck();

        $save_response = serialize($arrData);
        if($save_request != '' && $save_response != ''){
            if(isset($_SESSION[$front_session_name]['customer_id']) && $_SESSION[$front_session_name]['customer_id'] > 0){
                $login_id = $_SESSION[$front_session_name]['customer_id'];
            }
            $cf->saveRequests($save_request,$save_response,'customers','customerlogin',$login_id);
        }
        echo json_encode($arrData);exit;
    }
    

    public function customerlogout() {
        global $theme_path,$theme_url,$url;
        $arrData = $this->model->customerlogout();
        echo json_encode($arrData);exit;
    }

    public function checkForgotpassword() {
        global $theme_path,$theme_url,$url;
        require_once($theme_path.'getRequestData.php');
        $arrData = $this->model->checkForgotpassword();
        echo json_encode($arrData);exit;
    }

    public function loginmemberdetails() {
        global $theme_path,$theme_url,$url;
        $arrData = $this->model->loginmemberdetails();
        echo json_encode($arrData);exit;
    }

    public function resetcustomerpassword() {
        global $theme_path,$theme_url,$url;
        $arrData = $this->model->resetcustomerpassword();
        echo json_encode($arrData);exit;
    }
}
?>