<?php
require_once $theme_path.'model/Sitemap.php';
class Sitemapcontroller {

    public $model;
    public function __construct(){
        $this->model = new Sitemap();
    }

    public function index() {
        global $theme_path,$theme_url,$cf,$url;
        $fileContents = file_get_contents($theme_path.'generated_files/sitemapdata.php');
        $arrData = unserialize($fileContents);    
        require $theme_path.'views/sitemaps.php';
    }

    public function sitemap() {
        global $theme_path,$theme_url,$cf,$path,$url;
        $fileContents = file_get_contents($theme_path.'generated_files/sitemapdata.php');
        $arrData = unserialize($fileContents);    
        $string = '';
        header( 'Content-Type: application/xml' );
        if(isset($arrData) && !empty($arrData)) {
            $string .= '<?xml version="1.0" encoding="UTF-8"?>';
            $string .= '<urlset
            xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
            xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
            xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

            foreach($arrData as $item_type => $data) {
                $total_item_type = count($data);
                for($i = 0; $i < $total_item_type; $i++) {
                    $string .= '
                    <url>
                        <loc>'.$url.$arrData[$item_type][$i]['alias'].'</loc>
                        <lastmod>'.date('Y-m-d\Th:i:s').'+00:00</lastmod>
                        <priority>1.00</priority>
                    </url>';
                }
            }
            $string .= '</urlset>';
            $fp = fopen($path.'sitemap.xml', 'w+');
            fwrite($fp,$string);
            fclose($fp);
        }
    }

    public function emailToAdmin() {
        $this->model->emailToAdmin();
    }

    public function dailyTodoEmail() {
        $this->model->dailyTodoEmail();
    }

    public function updateSummary() {
        global $theme_path,$theme_url,$cf;
        $this->model->updateSummary();
    }

    public function overtimeCalculations() {
        $this->model->overtimeCalculations();
    }

    function insertHtmlWrapper ($ret) {
        return '<html><head><style>body{font-family:Arial;font-size:14px;}.sm{padding:10px;color:#aaa;font-size:11px}</style></head></body>' . $ret . '</body></html>';
        return '<html><head><style>body{font-family:Arial;font-size:14px;}table{border:1px solid #ccc;}table th{padding:5px;background:#eee;border:1px solid #fff;text-align:right;color:#aaa}table td{padding:5px;background:#f1f1f1;border:1px solid #fff;color:#333;}.sm{padding:10px;color:#aaa;font-size:11px}</style></head></body>' . $ret . '</body></html>';
    }

    public function backup() {
        //echo "fffffffffffff";exit;
        ini_set('max_execution_time','-1');
        ini_set('memory_limit', '-1');
        global $theme_path,$theme_url,$cf;
        require_once $theme_path.'phpmailer/PHPMailerAutoload.php';
        //echo !extension_loaded('openssl')?"Not Available":"Available";
        // if(is_file($theme_path.'phpmailer/PHPMailerAutoload.php')) {
        //     echo "File exists<br />";
        // }else {
        //     echo "file not exists<br />";
        // }

        //$array_data = $this->model->getCountriesLogs();
        // if(isset($array_data['string']) && $array_data['string'] != '') {
        //     $emailBody = $cf->readTemplateFile($theme_path."email/country_wise_email.php");
        //     require_once $theme_path.'email_fix_keywords.php';
        //     $subject = FRONT_APPLICATION_NAME." - Current Month Visitors Report";
        //     $emailBody = str_replace("#username#", 'Administrator', $emailBody);
        //     $emailBody = str_replace("#email#", 'mayank.patel104@gmail.com', $emailBody);
        //     $emailBody = str_replace("#countrydata#", $array_data['string'], $emailBody);
        //     $emailBody = str_replace("#citydata#", $array_data['city_string'], $emailBody);
        //     $emailBody = str_replace("#subject#", $subject, $emailBody);
        //     $email_response = $cf->sentEmail(COMPANY_EMAIL,$subject,$emailBody);
        // }

        $dir = "/home/u148603101/domains/cloudswiftsolutions.com/public_html/Backup_Scripts/Fiveminutes/";
        
        if (is_dir($dir)){
            if ($dh = opendir($dir)){
                while (($file = readdir($dh)) !== false){
                    if($file == '..' || $file == '.'){
                        continue;
                    }else {
                        $subject_filename = $file;
                        $arrData = explode("u148603101_",$file);
                        if(isset($arrData[1]) && $arrData[1] != ""){
                            $date = "_".date('Y-m-d').".sql";
                            $arrDataInetnal = explode($date,$arrData[1]);
                            $current_date = "";
                            if(isset($arrDataInetnal[0]) && $arrDataInetnal[0] != "") {
                                $subject_filename = $arrDataInetnal[0];
                            }
                        }
                        
                        if (strpos($file, date('Y-m-d')) !== false) {
                            $from_email = "connect@cloudswiftsolutions.com";
                            $from_name = $subject_filename." - ".date('Y-m-d-h-i-s');
                            $subject = "Database Backup - ".$subject_filename." - ".date('Y-m-d-h-i-s');
                            $name = "Cloudswift Database Backup";
                            $email = "cloudswiftsolutions@gmail.com";
                            //$bcc = "connect@cloudswiftsolutions.com";
                            $message = "Please find attachment as ".$file." database backup.";

                            $mail = new PHPMailer();
                            $mail->IsSMTP();
                            $mail->SMTPDebug = 2;
                            $mail->Host = 'smtp.hostinger.in';
                            $mail->Port = '587';
                            $mail->SMTPAuth = true;
                            $mail->Username = 'connect@cloudswiftsolutions.com';
                            $mail->Password = 'Mayank@203';
                            
                            // $mail->Host = 'smtp.gmail.com';
                            // $mail->Port = '587';
                            // $mail->SMTPAuth = true;
                            // $mail->Username = 'mayank.patel.developer@gmail.com';
                            // $mail->Password = 'Mayank@203';

                            $mail->IsHTML(true);
                            $mail->setFrom($from_email,$from_name);
                            $mail->addAttachment($dir.$file);
                            //$mail->From = $from_email;
                            //$mail->FromName = $from_name;
                            $mail->Subject  = $subject;
                            //echo $subject;exit;
                            try {
                                $mail->AddAddress( $email, $name );
                                
                                if ( strlen($bcc) > 0) {
                                    //$mail->AddBCC( $bcc );
                                    //$mail->AddBCC("connect@cloudswiftsolutions.com");
                                }
                                //put html wrappers in place
                                $ret = $this->insertHtmlWrapper($message);
                                                
                                $mail->Body = $ret;
                                //$mail->AddEmbeddedImage('../gfx/logo.gif', 'email_header', 'email_header.gif');
                                
                                if ($mail->Send()) {
                                    $valid = true;
                                    unlink($dir.$file);
                                    echo "Send <br />";
                                }
                                else {
                                    echo $error = 'The system is unabled to send email at this time. ' . $mail->ErrorInfo.'<br />';
                                }
                            }
                            catch(Exception $e) {
                                echo $error = $e->getMessage();
                                //exit();
                            }
                        }

                        
                    }
                
                }
                closedir($dh);
                //exit;
            }
        }
    }

}
?>