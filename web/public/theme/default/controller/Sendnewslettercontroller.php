<?php

require_once $theme_path.'model/Sendnewsletter.php';
class Sendnewslettercontroller {

    public $model;
    public function __construct(){
        $this->model = new Sendnewsletter();
    }

    public function index() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data;
        $cf->checkAdminLogin();
        $getParentDetails = $this->model->getList();
        require $theme_path.'views/sendnewsletter.php';
    }

    public function getEmaildata() {
        $group_name = "";
        $option_string = "";
        if(isset($_REQUEST['group_name']) && $_REQUEST['group_name'] != "") {
            $group_name = $_REQUEST['group_name'];
            $this->model->getGroupEmail($group_name);
        }
    }

    public function saveformdata() {
        //echo "<pre>";print_r($_REQUEST);exit;
        global $cf;
        $to = "";
        $error = 0;
        $success = 1;
        if(isset($_REQUEST['__cfduid']) && $_REQUEST['__cfduid'] != ''){
            unset($_REQUEST['__cfduid']);
            unset($_REQUEST['_ga']);
            unset($_REQUEST['PHPSESSID']);
        }
        
        if(isset($_REQUEST['email_address']) && $_REQUEST['email_address'] != "") {
            $to = $_REQUEST['email_address'];
        }

        if(isset($_REQUEST['subscriber_group']) && $_REQUEST['subscriber_group'] == "") {
            $message = "Please select group";
            $success = 0;
            $error = 1;
        }
        else if(isset($_REQUEST['subject']) && $_REQUEST['subject'] == "") {
            $message = "Please enter subject";
            $success = 0;
            $error = 1;
        }
        else if(isset($_REQUEST['newsletter_content']) && $_REQUEST['newsletter_content'] == "") {
            $message = "Please enter content for sending email";
            $success = 0;
            $error = 1;
        }

        if($success == 1){
            if($to != ""){
                $this->sentEmailtoOnePerson($_REQUEST);
            } else {
                $this->sentEmailtoGroup($_REQUEST);
            }
        }
        
        $response = array("success" => $success,"error" => $error,"message" => $message);
        echo json_encode($response);exit;
    }

    public function sentEmailtoGroup($request) {
        
        global $cf,$conn,$theme_path;
        $to = "";
        $subject = "";
        $newsletter_content = "";
        $signature = "";
        $subscriber_group = "";
        $message = "Please fillup all fields for sending email.";
        $error = 1;
        $success = 0;
        
        if(isset($request['subject']) && $request['subject'] != "") {
            $subject = $request['subject'].' - '.FRONT_APPLICATION_NAME;
        }
        if(isset($request['subscriber_group']) && $request['subscriber_group'] != "") {
            $subscriber_group = $request['subscriber_group'];
        }
        
        if($subject != "" && $request['newsletter_content'] != ""){
            $sqlSubscribers = "SELECT `subscriber_id`,`email_address`,CONCAT(first_name,' ',last_name) as first_name FROM `subscriber` WHERE `item_type` = '$subscriber_group' AND deleted_status = 'N' ORDER BY `subscriber_id` DESC";
            $arrSubscribers = $cf->getData($sqlSubscribers);
            if($arrSubscribers) {
                
                foreach($arrSubscribers as $subscriber) {
                    $signature = "";
                    $newsletter_content = "";
                    $to = $subscriber['email_address'];
                    $first_name = $to;
                    if($subscriber['first_name'] != ''){
                        $first_name = $subscriber['first_name'];
                    }
                    $newsletter_content .= "Hello $first_name,<br />";
                    $newsletter_content .= $request['newsletter_content'];
                    $signature .= "<br />Best Regards,";
                    $signature .= "<br />".FRONT_APPLICATION_NAME;
                    $signature .= "<br /><a href='mailto:".FROM_EMAIL_ADDRESS."'>".FROM_EMAIL_ADDRESS."</a>";
                    $signature .= "<br />";
                    $newsletter_content .= $signature;
                    $cf->sentEmail($to, $subject, $newsletter_content);

                    $subscriber = "UPDATE `subscriber` SET `last_email_sent` = '".date('Y-m-d h:i:s')."',updated_at = '".date('Y-m-d h:i:s')."' WHERE subscriber_id = '".$subscriber['subscriber_id']."'";
                    try {
                        $stmt = $conn->prepare($subscriber); 
                        $stmt->execute();
                    } catch (PDOException $ex) {
                        include $theme_path.'controller/logError.php';
                    }

                    $content = addslashes($newsletter_content);
                    $subscriber_log = "INSERT INTO `subscriber_email_logs` SET 
                    `email_to` = '$to',
                    `subject` = '$subject',
                    `message` = '$content'";
                    try {
                        $stmt = $conn->prepare($subscriber_log); 
                        $stmt->execute();
                    } catch (PDOException $ex) {
                        include $theme_path.'controller/logError.php';
                    }
                    $success = 1;
                    $error = 0;
                    $message = "Email has been successfully sent to your selected email address.";
                    sleep(5);
                }
            }
        }

        $response = array("success" => $success,"error" => $error,"message" => $message);
        echo json_encode($response);exit;

    }

    public function sentEmailtoOnePerson($request) {
        global $cf,$conn,$theme_path;
        $to = "";
        $subject = "";
        $newsletter_content = "";
        $signature = "";
        $message = "Please fillup all fields for sending email.";
        $error = 1;
        $success = 0;
        $signature .= "<br />Best Regards,";
        $signature .= "<br />".FRONT_APPLICATION_NAME;
        $signature .= "<br /><a href='mailto:".FROM_EMAIL_ADDRESS."'>".FROM_EMAIL_ADDRESS."</a>";
        $signature .= "<br />";
       
        if(isset($request['email_address']) && $request['email_address'] != "") {
            $to = $request['email_address'];
        }
        if(isset($request['subject']) && $request['subject'] != "") {
            $subject = $request['subject'].' - '.FRONT_APPLICATION_NAME;
        }
        if(isset($request['newsletter_content']) && $request['newsletter_content'] != "") {
            $newsletter_content = $request['newsletter_content'].$signature;
        }

        if($to != '' && $subject != "" && $newsletter_content != ""){
            $cf->sentEmail($to, $subject, $newsletter_content);

            $subscriber = "UPDATE `subscriber` SET `last_email_sent` = '".date('Y-m-d h:i:s')."',updated_at = '".date('Y-m-d h:i:s')."' WHERE email_address = '".$to."'";
            try {
                $stmt = $conn->prepare($subscriber); 
                $stmt->execute();
            } catch (PDOException $ex) {
                include $theme_path.'controller/logError.php';
            }

            $content = addslashes($newsletter_content);
            $subscriber_log = "INSERT INTO `subscriber_email_logs` SET 
                    `email_to` = '$to',
                    `subject` = '$subject',
                    `message` = '$content'";
                    try {
                        $stmt = $conn->prepare($subscriber_log); 
                        $stmt->execute();
                    } catch (PDOException $ex) {
                        include $theme_path.'controller/logError.php';
                    }

            $success = 1;
            $error = 0;
            $message = "Email has been successfully sent to your selected email address.";
        }
        
        $response = array("success" => $success,"error" => $error,"message" => $message);
        echo json_encode($response);exit;
    }
}
?>