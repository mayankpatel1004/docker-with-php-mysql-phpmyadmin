<?php
class Sitemap {
    public function index() {
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path;
        
    }

    public function getCountriesLogs() {
        global $cf,$page_data,$url;
        $string = "";
        $city_string = "";
        $first_day = date('Y-m-01 00:00:00');
        $last_day = date('Y-m-31 23:59:59');
        $sql = "SELECT COUNT(country) as total,country as country_name FROM `logs` WHERE created_date BETWEEN '$first_day' AND '$last_day' GROUP BY country ORDER BY created_date DESC";
        $arrData = $cf->getData($sql);
        if(isset($arrData) && !empty($arrData)) {
            $serial_no = 0;
            foreach($arrData as $data) {
                $serial_no++;
                $string .= '<tr>
                <th scope="row">'.$serial_no.'</th>
                <td>'.$data['country_name'].'</td>
                <td>'.$data['total'].'</td>
            </tr>';
            }
        }else {
            $string .= "<tr><td colspan='8'>No visitors found on this month.</td></tr>";
        }

        $sql = "SELECT COUNT(city) as total,city FROM `logs` WHERE created_date BETWEEN '$first_day' AND '$last_day' GROUP BY country ORDER BY created_date DESC";
        $arrData = $cf->getData($sql);
        if(isset($arrData) && !empty($arrData)) {
            $serial_no = 0;
            foreach($arrData as $data) {
                $serial_no++;
                $city_string .= '<tr>
                <th scope="row">'.$serial_no.'</th>
                <td>'.$data['city'].'</td>
                <td>'.$data['total'].'</td>
            </tr>';
            }
        }else {
            $city_string .= "<tr><td colspan='8'>No visitors found on this month.</td></tr>";
        }

        return array('string' => $string,'city_string' => $city_string);
    }

    public function updateSummary() {
        global $cf,$page_data,$url,$conn,$theme_path;

        $sqlEmpty = "TRUNCATE table `summary`";
        try {
            $success = 1;
            $error = 0;
            $stmt = $conn->prepare($sqlEmpty); 
            $stmt->execute();
        } catch (PDOException $ex) {
            include $theme_path.'controller/logError.php';
        }

        $sqlCurrentMonthCities = "SELECT DISTINCT(city),COUNT(city) as total_visitors FROM `logs` WHERE MONTH(created_date) = MONTH(CURRENT_DATE()) AND YEAR(created_date) = YEAR(CURRENT_DATE()) GROUP BY city";
        $arrCurrentMonthCities = $cf->getData($sqlCurrentMonthCities);
        if(isset($arrCurrentMonthCities) && !empty($arrCurrentMonthCities)) {
            foreach($arrCurrentMonthCities as $data) {
                $sql = "INSERT INTO `summary` SET 
                `summary_type` = 'currentmonthcityvisitors',
                `summary_title` = '".$data['city']."',
                `summary_value` = '".$data['total_visitors']."'";
                try {
                    $success = 1;
                    $error = 0;
                    $stmt = $conn->prepare($sql); 
                    $stmt->execute();
                } catch (PDOException $ex) {
                    include $theme_path.'controller/logError.php';
                }
            }
        }

        $sqlCurrentYearCities = "SELECT DISTINCT(city),COUNT(city) as total_visitors FROM `logs` WHERE MONTH(created_date) = MONTH(CURRENT_DATE()) AND YEAR(created_date) = YEAR(CURRENT_DATE()) GROUP BY city";
        $arrCurrentYearCities = $cf->getData($sqlCurrentYearCities);
        if(isset($arrCurrentYearCities) && !empty($arrCurrentYearCities)) {
            foreach($arrCurrentYearCities as $data) {
                $sql = "INSERT INTO `summary` SET 
                `summary_type` = 'currentyearcityvisitors',
                `summary_title` = '".$data['city']."',
                `summary_value` = '".$data['total_visitors']."'";
                try {
                    $success = 1;
                    $error = 0;
                    $stmt = $conn->prepare($sql); 
                    $stmt->execute();
                } catch (PDOException $ex) {
                    include $theme_path.'controller/logError.php';
                }
            }
        }

        $sqlCurrentMonthCountries = "SELECT DISTINCT(country),COUNT(country) as total_visitors FROM `logs` WHERE MONTH(created_date) = MONTH(CURRENT_DATE()) AND YEAR(created_date) = YEAR(CURRENT_DATE()) GROUP BY country";
        $arrCurrentMonthCountries = $cf->getData($sqlCurrentMonthCountries);
        if(isset($arrCurrentMonthCountries) && !empty($arrCurrentMonthCountries)) {
            foreach($arrCurrentMonthCountries as $data) {
                $sql = "INSERT INTO `summary` SET 
                `summary_type` = 'currentmonthcountryvisitors',
                `summary_title` = '".$data['country']."',
                `summary_value` = '".$data['total_visitors']."'";
                try {
                    $success = 1;
                    $error = 0;
                    $stmt = $conn->prepare($sql); 
                    $stmt->execute();
                } catch (PDOException $ex) {
                    include $theme_path.'controller/logError.php';
                }
            }
        }


        $sqlCurrentYearCountries = "SELECT DISTINCT(country),COUNT(country) as total_visitors FROM `logs` WHERE MONTH(created_date) = MONTH(CURRENT_DATE()) AND YEAR(created_date) = YEAR(CURRENT_DATE()) GROUP BY country";
        $arrCurrentYearCountries = $cf->getData($sqlCurrentYearCountries);
        if(isset($arrCurrentYearCountries) && !empty($arrCurrentYearCountries)) {
            foreach($arrCurrentYearCountries as $data) {
                $sql = "INSERT INTO `summary` SET 
                `summary_type` = 'currentyearcountryvisitors',
                `summary_title` = '".$data['country']."',
                `summary_value` = '".$data['total_visitors']."'";
                try {
                    $success = 1;
                    $error = 0;
                    $stmt = $conn->prepare($sql); 
                    $stmt->execute();
                } catch (PDOException $ex) {
                    include $theme_path.'controller/logError.php';
                }
            }
        }


        $sqlEmployeeOnLeaveCurrentMonth = "SELECT item_title,item_description,published_at,published_end_at,meta_title FROM `items` WHERE item_type = 'leaves' AND MONTH(published_at) = MONTH(CURRENT_DATE()) AND YEAR(published_at) = YEAR(CURRENT_DATE()) ORDER BY `item_id` DESC";
        $arrEmployeeOnLeaveCurrentMonth = $cf->getData($sqlEmployeeOnLeaveCurrentMonth);
        if(isset($arrEmployeeOnLeaveCurrentMonth) && !empty($arrEmployeeOnLeaveCurrentMonth)) {
            foreach($arrEmployeeOnLeaveCurrentMonth as $data) {
                $sql = "INSERT INTO `summary` SET 
                `summary_type` = 'currentmonthemployeeleave',
                `summary_title` = '".$data['meta_title']."',
                `summary_value` = '".date('d/m/Y',strtotime($data['published_at'])).' '.date('d/m/Y',strtotime($data['published_end_at']))."',
                `summary_note` = '".$data['item_description']."'
                ";
                try {
                    $success = 1;
                    $error = 0;
                    $stmt = $conn->prepare($sql); 
                    $stmt->execute();
                } catch (PDOException $ex) {
                    include $theme_path.'controller/logError.php';
                }
            }
        }

        $sqlEmployeeOnLeaveCurrentYear = "SELECT item_title,item_description,published_at,published_end_at,meta_title FROM `items` WHERE item_type = 'leaves' AND YEAR(published_at) = YEAR(CURRENT_DATE()) AND admin_module = 'N' ORDER BY `item_id` DESC";
        //echo $sqlEmployeeOnLeaveCurrentYear;exit;
        $arrEmployeeOnLeaveCurrentYear = $cf->getData($sqlEmployeeOnLeaveCurrentYear);
        if(isset($arrEmployeeOnLeaveCurrentYear) && !empty($arrEmployeeOnLeaveCurrentYear)) {
            foreach($arrEmployeeOnLeaveCurrentYear as $data) {
                $sql = "INSERT INTO `summary` SET 
                `summary_type` = 'currentyearemployeeleave',
                `summary_title` = '".$data['meta_title']."',
                `summary_value` = '".date('d/m/Y',strtotime($data['published_at'])).' '.date('d/m/Y',strtotime($data['published_end_at']))."',
                `summary_note` = '".$data['item_description']."'
                ";
                try {
                    $success = 1;
                    $error = 0;
                    $stmt = $conn->prepare($sql); 
                    $stmt->execute();
                } catch (PDOException $ex) {
                    include $theme_path.'controller/logError.php';
                }
            }
        }


        $sqlEmployeeWiseTotalPendingTasks = "SELECT count(*) as total,t.assign_to,CONCAT(u.first_name,' ',u.last_name) as user_name FROM `task` t LEFT JOIN `users` u ON u.id = t.assign_to WHERE t.task_status IN ('To Do','In Progress','Hold','QA Review','Bug','Not Possible') GROUP BY t.assign_to";
        $arrEmployeeWiseTotalPendingTasks = $cf->getData($sqlEmployeeWiseTotalPendingTasks);
        if(isset($arrEmployeeWiseTotalPendingTasks) && !empty($arrEmployeeWiseTotalPendingTasks)) {
            foreach($arrEmployeeWiseTotalPendingTasks as $data) {
                $sql = "INSERT INTO `summary` SET 
                `summary_type` = 'employeewisependingtasks',
                `summary_title` = '".$data['user_name']."',
                `summary_value` = '".$data['total']."',
                `summary_note` = ''";
                try {
                    $success = 1;
                    $error = 0;
                    $stmt = $conn->prepare($sql); 
                    $stmt->execute();
                } catch (PDOException $ex) {
                    include $theme_path.'controller/logError.php';
                }
            }
        }


        $sqlStatusWisePendingTasks = "SELECT count(*) as total,t.task_status FROM `task` t LEFT JOIN `users` u ON u.id = t.assign_to WHERE t.task_status IN ('To Do','In Progress','Hold','QA Review','Bug','Not Possible') GROUP BY t.task_status";
        $arrStatusWisePendingTasks = $cf->getData($sqlStatusWisePendingTasks);
        if(isset($arrStatusWisePendingTasks) && !empty($arrStatusWisePendingTasks)) {
            foreach($arrStatusWisePendingTasks as $data) {
                $sql = "INSERT INTO `summary` SET 
                `summary_type` = 'statuswisependingtasks',
                `summary_title` = '".$data['task_status']."',
                `summary_value` = '".$data['total']."',
                `summary_note` = ''";
                try {
                    $success = 1;
                    $error = 0;
                    $stmt = $conn->prepare($sql); 
                    $stmt->execute();
                } catch (PDOException $ex) {
                    include $theme_path.'controller/logError.php';
                }
            }
        }

        $sqlProjectWisePendingTasks = "SELECT count(t.project_id) as pending_task,iss.section_title as project FROM `task` t LEFT JOIN `item_section` iss ON t.project_id = iss.item_section_id WHERE t.task_status IN ('To Do','In Progress','Hold','QA Review','Bug') GROUP BY t.project_id";
        $arrProjectWisePendingTasks = $cf->getData($sqlProjectWisePendingTasks);
        if(isset($arrProjectWisePendingTasks) && !empty($arrProjectWisePendingTasks)) {
            foreach($arrProjectWisePendingTasks as $data) {
                $sql = "INSERT INTO `summary` SET 
                `summary_type` = 'projectwisependingtasks',
                `summary_title` = '".$data['project']."',
                `summary_value` = '".$data['pending_task']."',
                `summary_note` = ''";
                try {
                    $success = 1;
                    $error = 0;
                    $stmt = $conn->prepare($sql); 
                    $stmt->execute();
                } catch (PDOException $ex) {
                    include $theme_path.'controller/logError.php';
                }
            }
        }


        // Writing code start //
        $write = "";
        $write .= "<?php";
        $write .= "\r\n";

        $sqlQuery = "SELECT DISTINCT(summary_type) FROM `summary` ORDER BY `summary_id` ASC";
        $arrData = $cf->getData($sqlQuery);
        if(isset($arrData) && !empty($arrData)) {
            foreach($arrData as $data) {
                $summarytype = $data['summary_type'];
                $write .= "$".$summarytype." = array (";
                $sqlQueryIn = "SELECT * FROM `summary` WHERE summary_type = '".$data['summary_type']."' ORDER BY `summary_id` ASC";
                $arrDataIn = $cf->getData($sqlQueryIn);
                if(isset($arrDataIn) && !empty($arrDataIn)) {
                    foreach($arrDataIn as $dataIn){
                        $write .= "array('".$dataIn['summary_id']."','".$dataIn['summary_type']."','".$dataIn['summary_title']."','".$dataIn['summary_value']."','".$dataIn['summary_note']."'),";
                    }    
                }
                $write .= ");";
                $write .= "\r\n";    
            }
            $write .= "\r\n";
        }
        $write .= "?>";
        file_put_contents($theme_path."generated_files/summary.php",$write);
        // Writing code end //

    }

    public function dailyTodoEmail() {
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path,$theme_url;
        $arrUsers = array();

        $sqlEmployee = "SELECT id,first_name,last_name,email FROM `users` WHERE `role_id` = 3 AND display_status = 'Y' AND deleted_status = 'N'";
        $arrEmployee =  $cf->getData($sqlEmployee);
        
        $sqlQuery = "SELECT t.task_id,t.assign_to as user_id,t.task_priority,t.task_name,t.task_description,CONCAT(u.first_name,' ',u.last_name) as user_name,t.estimate_hours,t.start_date,t.created_at FROM `task` t LEFT JOIN `users` u on t.assign_to = u.id WHERE t.task_status NOT IN ('DONE','Cancelled') ORDER BY t.task_priority ASC";
        $arrDailyTodo =  $cf->getData($sqlQuery);

        if(isset($arrEmployee) && count($arrEmployee) > 0){    
            foreach($arrEmployee as $user_data){
                $have_to_do = 0;
                $content = '<table width="100%" border="1" cellspacing="0" cellpadding="5" style="font-size:14px; font-family:Arial, Helvetica, sans-serif;">';
                $content .= '<tr>
                <th style="color:#25378b;">Task #</th>
                <th style="color:#25378b;">Task Name</th>
                <th style="color:#25378b;">Task Priority</th>
                <th style="color:#25378b;">Estimate Hours</th>
                <th style="color:#25378b;">Start Date</th>
                <th style="color:#25378b;">Create Date</th>
                <tr>';
                if(isset($arrDailyTodo) && count($arrDailyTodo) > 0) {
                    foreach($arrDailyTodo as $data){
                        if(isset($data['user_id']) && $data['user_id'] == $user_data['id']){
                            $have_to_do = 1;
                            $content .= "<tr>";
                                $content .= "<td>".$data['task_id']."</td>";
                                $content .= "<td>".$data['task_name']."</td>";
                                $content .= "<td>".$data['task_priority']."</td>";
                                $content .= "<td>".$data['estimate_hours']."</td>";
                                $content .= "<td>".date(DATE_FORMAT,strtotime($data['start_date']))."</td>";
                                $content .= "<td>".date(DATETIME_FORMAT,strtotime($data['created_at']))."</td>";
                            $content .= "</tr>";
                        }
                    }
                }
                if($have_to_do == 0) {
                    $content .= "<tr><td colspan='10' style='text-align:center;'>You don't have any task today. Please contact administrator.</td></tr>";
                }
                $content .= "</table>";
                $emailBody = $cf->readTemplateFile($theme_path."email/todo_today.php");
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

                $subject = " Your To Do List - ".FRONT_APPLICATION_NAME;
                $emailBody = str_replace("#username#", $user_data['first_name'].' '.$user_data['last_name'], $emailBody);
                $emailBody = str_replace("#email#", $user_data['email'], $emailBody);
                $emailBody = str_replace("#content#",$content,$emailBody);
                $emailBody = str_replace("#subject#", $subject, $emailBody);
                //echo $emailBody;exit;
                $email_response = $cf->sentEmail($user_data['email'],$subject,$emailBody);
            }
        }
        //print_r($arrDailyTodo);
        exit;
    }

    public function emailToAdmin() {
        //echo "email to admin called";exit;
        $email_string = "";
        $month_city_visitor_data = "";
        $month_country_visitor_data = "";
        $website_status = "";
        //daily_cron_email.php
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path;
        $today_date = date('Y-m-d');
        $arrEmployeeData = array();

        $sqlQuery = "DELETE FROM `ec_cart` WHERE expire_at < NOW() AND `is_customer` = 'N';SELECT user_name,SUM(hours) as hours FROM `timecard` WHERE timecard_date = '".$today_date."' GROUP by user_id ORDER BY `timecard_date` DESC";
        $arrEmployeeData =  $cf->getData($sqlQuery);

        $email_string .= '<table border="1" cellspacing="0" cellpadding="5" style="font-size:14px; font-family:Arial, Helvetica, sans-serif;">';
        $email_string .= '<tr><th style="color:#25378b;">Employee</th><th style="color:#25378b;">Total Hours</th><th style="color:#25378b;">Date</th><th style="color:#25378b;">Notification</th></tr>';
        if(isset($arrEmployeeData) && $arrEmployeeData != false):
            foreach($arrEmployeeData as $data):
                $style = "";
                $notification = "Normal Time";
                $style = "style='background-color:white';color:black;";
                if($data['hours'] < 8) {
                    $style = "style='background-color:red';color:white;";
                    $notification = "Lower Time";
                }
                if($data['hours'] > 8.5) {
                    $style = "style='color:white;background-color:#25378b';";
                    $notification = "Over Time";
                }
                $email_string .= '<tr '.$style.'><td>'.$data['user_name'].'</td><td>'.$data['hours'].'</td><td>'.date('d/m/Y').'</td><td>'.$notification.'</td></tr>';
            endforeach;
            else :
            $email_string .= '<tr><td colspan="4" style="text-align:center;">No one punch today</td></tr>';
            
        endif;
        $email_string .= '</table>';

        
        $today_date = date('Y-m-d');
        $arrEmployeeData = array();
        $email_string2 = "";
        $email_string2 .= '<table border="1" cellspacing="0" cellpadding="5" style="font-size:14px; font-family:Arial, Helvetica, sans-serif;">';
        $email_string2 .= '<tr><th style="color:#25378b;">Employee</th><th style="color:#25378b;">Total Hours</th><th style="color:#25378b;">Date</th><th style="color:#25378b;">Notification</th></tr>';
        $sql = "SELECT MAX(timecard_date) as previousday FROM `timecard` WHERE timecard_date < '$today_date'";
        $arrPreviousDate =  $cf->getOneData($sql);
        if(isset($arrPreviousDate['previousday']) && $arrPreviousDate['previousday'] != "") {
            $previousday = $arrPreviousDate['previousday'];
            $sqlQuery = "SELECT user_name,SUM(hours) as hours FROM `timecard` WHERE timecard_date = '".$arrPreviousDate['previousday']."' GROUP by user_id ORDER BY `timecard_date` DESC";
            $arrEmployeeData =  $cf->getData($sqlQuery);
            
            foreach($arrEmployeeData as $data):
                $style = "style='background-color:white';color:black;";
                $notification = "Normal Time";
                if($data['hours'] < 8) {
                    $style = "style='background-color:red';color:white;";
                    $notification = "Lower Time";
                }
                if($data['hours'] > 8.5) {
                    $style = "style='color:white;background-color:#25378b';";
                    $notification = "Over Time";
                }
                $email_string2 .= '<tr '.$style.'><td>'.$data['user_name'].'</td><td>'.$data['hours'].'</td><td>'.date(DATE_FORMAT,strtotime($previousday)).'</td><td>'.$notification.'</td></tr>';
            endforeach;
            
        } else {
            $email_string2 .= '<tr><td colspan="4">No one punched yesterday.</td></tr>';
        }
        $email_string2 .= '</table>';


        $email_string_today_punch = "";
        $sqlTodayPunchHours = "SELECT * FROM `timecard` WHERE timecard_date = '$today_date' ORDER BY `timecard_id` DESC";
        $arrTodayPunchDetails =  $cf->getData($sqlTodayPunchHours);
        if(isset($arrTodayPunchDetails) && count($arrTodayPunchDetails) > 0) {
            $email_string_today_punch .= '<table border="1" cellspacing="0" cellpadding="5" style="font-size:14px; font-family:Arial, Helvetica, sans-serif;">';
            $email_string_today_punch .= '<tr><th style="color:#25378b;">Employee</th><th style="color:#25378b;">Task Name</th><th style="color:#25378b;">Description</th><th style="color:#25378b;">Total Hours</th><th style="color:#25378b;">Date</th></tr>';
            foreach($arrTodayPunchDetails as $data) {
                $email_string_today_punch .= '<tr>
                <td>'.$data['user_name'].'</td>
                <td>'.$data['task_name'].'</td>
                <td>'.$data['task_comment'].'</td>
                <td>'.$data['hours'].'</td>
                <td>'.date(DATE_FORMAT,strtotime($data['timecard_date'])).'</td>
                </tr>';
            }
            $email_string_today_punch .= '</table>';
        }


        if($previousday != ""){
            $email_string_previousday_punch = "";
            $sqlTodayPunchHours = "SELECT * FROM `timecard` WHERE timecard_date = '$previousday' ORDER BY `timecard_id` DESC";
            $arrTodayPunchDetails =  $cf->getData($sqlTodayPunchHours);
            if(isset($arrTodayPunchDetails) && count($arrTodayPunchDetails) > 0) {
                $email_string_previousday_punch .= '<table border="1" cellspacing="0" cellpadding="5" style="font-size:14px; font-family:Arial, Helvetica, sans-serif;">';
                $email_string_previousday_punch .= '<tr><th style="color:#25378b;">Employee</th><th style="color:#25378b;">Task Name</th><th style="color:#25378b;">Description</th><th style="color:#25378b;">Total Hours</th><th style="color:#25378b;">Date</th></tr>';
                foreach($arrTodayPunchDetails as $data) {
                    $email_string_previousday_punch .= '<tr>
                    <td>'.$data['user_name'].'</td>
                    <td>'.$data['task_name'].'</td>
                    <td>'.$data['task_comment'].'</td>
                    <td>'.$data['hours'].'</td>
                    <td>'.date(DATE_FORMAT,strtotime($data['timecard_date'])).'</td>
                    </tr>';
                }
                $email_string_previousday_punch .= '</table>';
            }
        }
        
        

        $email_string_leave = "";
        $sqlLeaves = "SELECT i.item_title,i.item_description,i.published_at,i.published_end_at,CONCAT(u.first_name,' ',u.last_name) as user_name FROM `items` i LEFT JOIN `users` u ON i.user_id = u.id WHERE i.item_type LIKE '%leaves%' AND MONTH(published_at) = MONTH(CURRENT_DATE()) ORDER BY published_at DESC";
        $arrLeavesData =  $cf->getData($sqlLeaves);
        if(isset($arrLeavesData) && count($arrLeavesData) > 0) {
            $email_string_leave .= '<table border="1" cellspacing="0" cellpadding="5" style="font-size:14px; font-family:Arial, Helvetica, sans-serif;width:auto;">';
            $email_string_leave .= '<tr><th style="color:#25378b;">Employee</th><th style="color:#25378b;">Reason</th><th style="color:#25378b;">Notes</th><th style="color:#25378b;">Date</th></tr>';
            foreach($arrLeavesData as $data){
                $bg = " style='background-color:white;'";
                $tomorrow_date = strtotime('+1 day',strtotime(date('Y-m-d')));
                if(strtotime($data['published_at']) == $tomorrow_date){
                    $bg = " style='background-color:red;color:white;'";
                } 
                else if(strtotime($data['published_at']) > strtotime(date('Y-m-d'))){
                    $bg = " style='background-color:green;color:white;'";
                }    
                $email_string_leave .= '<tr '.$bg.'>
                    <td>'.$data['user_name'].'</td>
                    <td>'.$data['item_title'].'</td>
                    <td>'.$data['item_description'].'</td>
                    <td>'.date(DATE_FORMAT,strtotime($data['published_at'])).' - '.date(DATE_FORMAT,strtotime($data['published_end_at'])).'</td>
                </tr>';
            }
            $email_string_leave .= '</table>';
        }
        
        $email_string3 = "";
        $sqlQuery = "SELECT item_section_id,section_title FROM `item_section` WHERE item_type = 'projects' AND display_status = 'Y' AND deleted_status = 'N'";
        $arrProject =  $cf->getData($sqlQuery);
        if(isset($arrProject) && count($arrProject) > 0) {
            $email_string3 .= '<table border="1" cellspacing="0" cellpadding="5" style="font-size:14px; font-family:Arial, Helvetica, sans-serif;">';
            $email_string3 .= '<tr><th style="color:#25378b;">Project</th><th style="color:#25378b;">Employee</th><th style="color:#25378b;">Task Name</th><th style="color:#25378b;">Status</th><th style="color:#25378b;">Priority</th></tr>';
            foreach($arrProject as $project){
                $project_id = $project['item_section_id'];
                $project_name = $project['section_title'];
                $sqlQuery = "SELECT t.*,u.first_name as user_name,t.project_id,iss.section_title as project_name FROM `task` t LEFT JOIN `users` u ON u.id = t.assign_to LEFT JOIN `item_section` iss ON iss.item_section_id = t.project_id WHERE t.project_id = '$project_id' AND  task_status NOT IN ('Done','T','Cancelled') AND t.deleted_status = 'N'";
                //$sqlQuery = "SELECT t.*,u.first_name as user_name,t.project_id,iss.section_title as project_name FROM `task` t LEFT JOIN `users` u ON u.id = t.assign_to LEFT JOIN `item_section` iss ON iss.item_section_id = t.project_id WHERE t.project_id = '$project_id' AND  task_status != 'Done'";
                //echo $sqlQuery;exit;
                $arrProjectData =  $cf->getData($sqlQuery);
                if(isset($arrProjectData) && count($arrProjectData) > 0) {
                    foreach($arrProjectData as $data){
                        $email_string3 .= '<tr><td>'.$project_name.'</td><td>'.$data['user_name'].'</td><td>'.$data['task_name'].'</td><td>'.$data['task_status'].'</td><td>'.$data['task_priority'].'</td></tr>';
                        //$arrResponse[$project_id][] = array('user_name' => $arrData['user_name'],'project_name' => $arrData['project_name'],'project_id' => $project_id,'task_name' => $arrData['task_name'],'task_description' => $arrData['task_description'],'task_status' => $arrData['task_status'],'task_priority' => $arrData['task_priority']);
                    }
                }
            }
            $email_string3 .= '</table>';
        }

        // Visitors by city start //
        $current_month_visitor_by_city = "SELECT DISTINCT(city),COUNT(city) as total_visitors,country FROM `logs` WHERE MONTH(created_date) = MONTH(CURRENT_DATE()) AND YEAR(created_date) = YEAR(CURRENT_DATE()) GROUP BY city";
        $arrVisitorByCity =  $cf->getData($current_month_visitor_by_city);
        $month_city_visitor_data .= '<table border="1" cellspacing="0" cellpadding="5" style="font-size:14px; font-family:Arial, Helvetica, sans-serif;">';
        $month_city_visitor_data .= '<tr><th style="color:#25378b;">Country</th><th style="color:#25378b;">City</th><th style="color:#25378b;">Total Visitors</th></tr>';
        if(isset($arrVisitorByCity) && count($arrVisitorByCity) > 0) {
            foreach($arrVisitorByCity as $data){
                $month_city_visitor_data .= '<tr>
                <td>'.$data['country'].'</td>
                <td>'.$data['city'].'</td>
                <td>'.$data['total_visitors'].'</td>
                </tr>';
            }
        } else {
                $month_city_visitor_data .= '<tr><td colspan="3">No Visitor for this month</td></tr>';
        }
        $month_city_visitor_data .= '</table>';
        // Visitors by city end //


        // Visitors by country start //
        $current_month_visitor_by_city = "SELECT DISTINCT(country),COUNT(country) as total_visitors FROM `logs` WHERE MONTH(created_date) = MONTH(CURRENT_DATE()) AND YEAR(created_date) = YEAR(CURRENT_DATE()) GROUP BY country";
        $arrVisitorByCity =  $cf->getData($current_month_visitor_by_city);
        $month_country_visitor_data .= '<table border="1" cellspacing="0" cellpadding="5" style="font-size:14px; font-family:Arial, Helvetica, sans-serif;width:100%;">';
        $month_country_visitor_data .= '<tr><th style="color:#25378b;">Country</th><th style="color:#25378b;">Total Visitors</th></tr>';
        if(isset($arrVisitorByCity) && count($arrVisitorByCity) > 0) {
            foreach($arrVisitorByCity as $data){
                $month_country_visitor_data .= '<tr>
                <td>'.$data['country'].'</td>
                <td>'.$data['total_visitors'].'</td>
                </tr>';
            }
        } else {
                $month_country_visitor_data .= '<tr><td colspan="3">No Visitor for this month</td></tr>';
        }
        $month_country_visitor_data .= '</table>';
        // Visitors by country end //



        // Check Client Website Status Start //
        $website_status_sql = "SELECT * FROM `website_registration` WHERE display_status = 'Y' AND deleted_status = 'N'";
        $arrWebsite =  $cf->getData($website_status_sql);
        $website_status .= '<table border="1" cellspacing="0" cellpadding="5" style="font-size:14px; font-family:Arial, Helvetica, sans-serif;width:100%;">';
        $website_status .= '<tr><th style="color:#25378b;">Website URL</th><th style="color:#25378b;">Website Name</th><th style="color:#25378b;">Expiry Date</th><th style="color:#25378b;">Client Name</th><th style="color:#25378b;">Email</th><th style="color:#25378b;">Contact</th><th style="color:#25378b;">Status</th></tr>';
        if(isset($arrWebsite) && count($arrWebsite) > 0) {
            foreach($arrWebsite as $data){
                $live_status = "Offline";
                $bg_live_status = "style='background-color:#FF0000;color:#FFFFFF'";
                if($socket =@ fsockopen($data['website_url'], 80, $errno, $errstr, 30)) {
                    $live_status = 'Online';
                    $bg_live_status = "";
                    fclose($socket);
                }
                $website_status .= '<tr '.$bg_live_status.'>
                <td>'.$data['website_url'].'</td>
                <td>'.$data['website_name'].'</td>
                <td>'.$data['expired_date'].'</td>
                <td>'.$data['client_name'].'</td>
                <td>'.$data['client_email'].'</td>
                <td>'.$data['client_contact'].'</td>
                <td>'.$live_status.'</td>
                </tr>';
            }
        } else {
                $website_status .= '<tr><td colspan="3">No Website Found</td></tr>';
        }
        $website_status .= '</table>';
        // Check Client Website Status End //

        

        //echo $email_string2;exit;
        $company_email = COMPANY_EMAIL;
        $emailBody = $cf->readTemplateFile($theme_path."email/daily_cron_email.php");
        require_once $theme_path.'email_fix_keywords.php';
        $subject = "Daily Punch Report - ".FRONT_APPLICATION_NAME;
        $emailBody = str_replace("#username#", "Administrator", $emailBody);
        $emailBody = str_replace("#punch_data#",$email_string,$emailBody);
        $emailBody = str_replace("#punch_data_yesterday#",$email_string2,$emailBody);
        $emailBody = str_replace("#email_string_previousday_punch#",$email_string_previousday_punch,$emailBody);
        $emailBody = str_replace("#email_string_today_punch#",$email_string_today_punch,$emailBody);
        $emailBody = str_replace("#month_city_visitor_data#",$month_city_visitor_data,$emailBody);
        $emailBody = str_replace("#month_country_visitor_data#",$month_country_visitor_data,$emailBody);
        $emailBody = str_replace("#pending_task#",$email_string3,$emailBody);
        $emailBody = str_replace("#employee_on_leave#",$email_string_leave,$emailBody);
        $emailBody = str_replace("#website_status#",$website_status,$emailBody);

        

        $emailBody = str_replace("#email#", $company_email, $emailBody);
        $emailBody = str_replace("#subject#", $subject, $emailBody);
        //echo $emailBody;exit;
        $email_response = $cf->sentEmail($company_email,$subject,$emailBody);
        $success = 1;
        $error = 0;
        $message = "Your password has been successfully reset. You will redirect to login screen in few seconds...";
    }

    function overtimeCalculations() {
        global $cf,$conn;

        // Over time query start //
        $sqlQuery = "SELECT timecard_id,user_name,user_id,SUM(hours) as total_hours,timecard_date FROM timecard WHERE YEAR(timecard_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND MONTH(timecard_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)  AND is_weekend = 'N' GROUP BY timecard_date HAVING SUM(hours) > 8.5 ORDER BY timecard_date ASC";
        $arrData = $cf->getData($sqlQuery);
        if(isset($arrData) && count($arrData) > 0) {
            foreach($arrData as $data) {
                $user_id = $data['user_id'];
                $name = $data['user_name'];
                $month = date('m',strtotime($data['timecard_date']));
                $year = date('Y',strtotime($data['timecard_date']));
                $ot_day = date('l',strtotime($data['timecard_date']));
                $total_hours = ($data['total_hours'] - 8.5);
                $ot_date = $data['timecard_date'];

                $sqlQuery = "SELECT count(*) as total FROM `timecard_ot` WHERE `user_id` = '$user_id' AND `ot_date` = '$ot_date'";
                $arrData = $cf->getOneData($sqlQuery);
                //print_r($arrData);exit;
                if(isset($arrData['total']) && $arrData['total'] <= 0) {
                    $sqlInsert = "INSERT INTO `timecard_ot` SET 
                    `user_id` = '$user_id',
                    `name` = '$name',
                    `month` = '$month',
                    `year` = '$year',
                    `ot_day` = '$ot_day',
                    `ot_type` = 'OT',
                    `total_hours` = '$total_hours',
                    `ot_date` = '$ot_date'";
                    $stmt = $conn->prepare($sqlInsert); 
                    $stmt->execute();
                }
                else {
                    $sqlUpdate = "UPDATE `timecard_ot` SET `total_hours` = '$total_hours',`ot_date` = '$ot_date' WHERE `total_hours` = '$total_hours' AND `ot_date` = '$ot_date'";
                    $stmt = $conn->prepare($sqlUpdate); 
                    $stmt->execute();
                }
            }
        }
        // Over time query end //

        // Lower time query start //
        $sqlQuery = "SELECT timecard_id,user_name,user_id,SUM(hours) as total_hours,timecard_date FROM timecard WHERE YEAR(timecard_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND MONTH(timecard_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) AND is_weekend = 'N' GROUP BY timecard_date HAVING SUM(hours) < 7.5 ORDER BY timecard_date ASC";
        $arrData = $cf->getData($sqlQuery);
        if(isset($arrData) && count($arrData) > 0) {
            foreach($arrData as $data) {
                $user_id = $data['user_id'];
                $name = $data['user_name'];
                $month = date('m',strtotime($data['timecard_date']));
                $year = date('Y',strtotime($data['timecard_date']));
                $ot_day = date('l',strtotime($data['timecard_date']));
                $total_hours = (8.5 - $data['total_hours']);
                $ot_date = $data['timecard_date'];

                $sqlQuery = "SELECT count(*) as total FROM `timecard_ot` WHERE `user_id` = '$user_id' AND `ot_date` = '$ot_date'";
                $arrData = $cf->getOneData($sqlQuery);
                //print_r($arrData);exit;
                if(isset($arrData['total']) && $arrData['total'] <= 0) {
                    $sqlInsert = "INSERT INTO `timecard_ot` SET 
                    `user_id` = '$user_id',
                    `name` = '$name',
                    `month` = '$month',
                    `year` = '$year',
                    `ot_day` = '$ot_day',
                    `ot_type` = 'LT',
                    `total_hours` = '$total_hours',
                    `ot_date` = '$ot_date'";
                    $stmt = $conn->prepare($sqlInsert); 
                    $stmt->execute();
                }
                else {
                    $sqlUpdate = "UPDATE `timecard_ot` SET `total_hours` = '$total_hours',`ot_date` = '$ot_date' WHERE `total_hours` = '$total_hours' AND `ot_date` = '$ot_date'";
                    $stmt = $conn->prepare($sqlUpdate); 
                    $stmt->execute();
                }   
            }
        }
        // Lower time query over //


        // Weekend query start //
        $sqlQuery = "SELECT timecard_id,user_name,user_id,SUM(hours) as total_hours,timecard_date FROM timecard WHERE YEAR(timecard_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND MONTH(timecard_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) AND is_weekend = 'Y' GROUP BY timecard_date ORDER BY timecard_date ASC";
        $arrData = $cf->getData($sqlQuery);
        if(isset($arrData) && count($arrData) > 0) {
            foreach($arrData as $data) {
                $user_id = $data['user_id'];
                $name = $data['user_name'];
                $month = date('m',strtotime($data['timecard_date']));
                $year = date('Y',strtotime($data['timecard_date']));
                $ot_day = date('l',strtotime($data['timecard_date']));
                $total_hours = $data['total_hours'];
                $ot_date = $data['timecard_date'];

                $sqlQuery = "SELECT count(*) as total FROM `timecard_ot` WHERE `user_id` = '$user_id' AND `ot_date` = '$ot_date'";
                $arrData = $cf->getOneData($sqlQuery);
                //print_r($arrData);exit;
                if(isset($arrData['total']) && $arrData['total'] <= 0) {
                    $sqlInsert = "INSERT INTO `timecard_ot` SET 
                    `user_id` = '$user_id',
                    `name` = '$name',
                    `month` = '$month',
                    `year` = '$year',
                    `ot_day` = '$ot_day',
                    `ot_type` = 'WE',
                    `total_hours` = '$total_hours',
                    `ot_date` = '$ot_date'";
                    $stmt = $conn->prepare($sqlInsert); 
                    $stmt->execute();
                }
                else {
                    $sqlUpdate = "UPDATE `timecard_ot` SET `total_hours` = '$total_hours',`ot_date` = '$ot_date' WHERE `total_hours` = '$total_hours' AND `ot_date` = '$ot_date'";
                    $stmt = $conn->prepare($sqlUpdate); 
                    $stmt->execute();
                }   
            }
        }
        // Weekend time query over //



    }
}
?>