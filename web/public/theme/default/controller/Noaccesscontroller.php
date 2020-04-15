<?php
class Noaccesscontroller {
    public function index() {
        global $theme_path,$theme_url;
        require $theme_path.'views/Noaccess.php';
    }
}
?>