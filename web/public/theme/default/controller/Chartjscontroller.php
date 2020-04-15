<?php
class Chartjscontroller {
    public function index() {
        global $theme_path,$theme_url;
        require $theme_path.'views/chartjs.php';
    }
}
?>