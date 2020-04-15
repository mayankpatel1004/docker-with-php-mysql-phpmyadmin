<?php
require_once $theme_path.'model/Ourwork.php';
class Ourworkcontroller {

    public $model;
    public function __construct(){
        $this->model = new Ourwork();
    }

    public function index() {
        global $theme_path,$theme_url,$cf;
        require $theme_path.'views/ourwork.php';
    }
    public function getdata() {
        $this->model->getList();
    }
}
?>