<?php
class Notfoundcontroller {
    public function index() {
        global $theme_path,$theme_url;
        require $theme_path.'views/404.php';
    }
}
?>