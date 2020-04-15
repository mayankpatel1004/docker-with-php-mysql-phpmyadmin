<?php
    //session_start();
    require_once $theme_path.'Commonfunctions.php';
    require_once $theme_path.'generated_files/configdata.php';
    $cart_id = 0;
    if($cart_id == 0) {
        $cart_id = $cf->getCartId();
    }
    if(SITE_CONSTRUCTION == 'Yes' || SITE_CONSTRUCTION == 'Y') {
        require_once 'underconstruction.php';
    }
    else {
        $cf = new Commonfunctions();
        $access_response = "Access";
        if(is_file($theme_path.'controller/'.$controller.'.php')) {
            include($theme_path.'controller/'.$controller.'.php');
            if($action == 'memberlogout'){
                $access_response = "Access";
            } else {
                $access_response = $cf->checkRolesPermissions('grant_view');
                if(!isset($_SESSION['backendapp']['user_id'])){
                    $access_response = "Access";
                }
            }
            if($access_response == 'Access'){
                $controller = new $controller();
                $controller->$action();        
            } else {
                $controller = "Noaccesscontroller";
                include($theme_path.'controller/'.$controller.'.php');
                $controller = new $controller();
                $controller->index();
            }
        } else {
            $controller = "Homecontroller";
            include($theme_path.'controller/'.$controller.'.php');
            $controller = new $controller();
            $controller->index();
        }
    }
  ?>