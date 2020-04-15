<?php
class Dashboard {
    
    public function getTotalUsers() {
        global $cf,$page_data,$url;
        $sql = "SELECT count(*) as total_users FROM `users` WHERE `display_status` = 'Y' AND `deleted_status` = 'N'";
        $arrData = $cf->getOneData($sql);
        return $arrData['total_users'];
    }

    public function getTotalCustomers() {
        global $cf,$page_data,$url;
        $sql = "SELECT count(*) as total_customers FROM `customers` WHERE `display_status` = 'Y' AND `deleted_status` = 'N'";
        $arrData = $cf->getOneData($sql);
        return $arrData['total_customers'];
    }

    public function getTotalSubscribers() {
        global $cf,$page_data,$url;
        $sql = "SELECT count(*) as total_subscribers FROM `subscriber` WHERE `display_status` = 'Y' AND `deleted_status` = 'N'";
        $arrData = $cf->getOneData($sql);
        return $arrData['total_subscribers'];
    }

    public function getTotalRoles() {
        global $cf,$page_data,$url;
        $sql = "SELECT count(*) as total_roles FROM `role` WHERE `display_status` = 'Y' AND `deleted_status` = 'N'";
        $arrData = $cf->getOneData($sql);
        return $arrData['total_roles'];
    }

    public function getRecentActivities() {
        global $cf,$page_data,$url;
        $sql = "SELECT * FROM `activity` ORDER BY `activity_id` DESC LIMIT 0,20";
        return $cf->getData($sql);
    }

    public function getRecentSubscribers() {
        global $cf,$page_data,$url;
        $sql = "SELECT * FROM `subscriber` WHERE `display_status` = 'Y' AND `deleted_status` = 'N' ORDER BY `subscriber_id` DESC LIMIT 0,20";
        return $cf->getData($sql);
    }

    public function getEmployeeTimecard() {
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path;
        $user_id = 0;
        if(isset($_SESSION[$back_session_name]['user_id']) && $_SESSION[$back_session_name]['user_id'] > 0) {
            $user_id = $_SESSION[$back_session_name]['user_id'];
        }
        $sql = "SELECT * FROM `timecard` WHERE `user_id` = '".$user_id."' AND `deleted_status` = 'N' ORDER BY `timecard_date` DESC LIMIT 0,20";
        //echo $sql;exit;
        return $cf->getData($sql);
    }

    public function getEmployeeTask() {
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path;
        $user_id = 0;
        if(isset($_SESSION[$back_session_name]['user_id']) && $_SESSION[$back_session_name]['user_id'] > 0) {
            $user_id = $_SESSION[$back_session_name]['user_id'];
        }
        $sql = "SELECT t.*,iss.section_title as project_name FROM task as t LEFT JOIN item_section as iss ON iss.item_section_id = t.project_id WHERE t.assign_to = '".$user_id."' AND t.task_status != 'DONE' AND t.deleted_status = 'N' ORDER BY t.task_id DESC LIMIT 0,20";
        //echo $sql;exit;
        return $cf->getData($sql);
    }

    public function getPreviousDayPunchingHours() {
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path;
        $today_date = date('Y-m-d');
        $arrEmployeeData = array();
        $sql = "SELECT MAX(timecard_date) as previousday FROM `timecard` WHERE timecard_date < '$today_date' AND deleted_status = 'N'";
        //echo $sql;exit;
        $arrPreviousDate =  $cf->getOneData($sql);
        if(isset($arrPreviousDate['previousday']) && $arrPreviousDate['previousday'] != "") {
            $sqlQuery = "SELECT user_name,SUM(hours) as hours FROM `timecard` WHERE timecard_date = '".$arrPreviousDate['previousday']."' AND deleted_status = 'N' GROUP by user_id ORDER BY `timecard_date` DESC";
            $arrEmployeeData =  $cf->getData($sqlQuery);
        }
        return array('arrEmployeeData' => $arrEmployeeData, 'previousday' => $arrPreviousDate['previousday']);
    }

    public function getTodayPunchingHours() {
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path;
        $today_date = date('Y-m-d');
        $arrEmployeeData = array();
        $sqlQuery = "SELECT user_name,SUM(hours) as hours FROM `timecard` WHERE timecard_date = '".$today_date."' AND deleted_status = 'N' GROUP by user_id ORDER BY `timecard_date` DESC";
        $arrEmployeeData =  $cf->getData($sqlQuery);
        return $arrEmployeeData;
    }

    public function getAllPendingTasks() {
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path;
        $arrPendingData = array();
        $sqlQuery = "SELECT t.task_id,t.task_description,t.task_name,CONCAT(u.first_name,' ',u.last_name) as user_name,iss.section_title as project_name,t.task_status,t.task_priority FROM task as t LEFT JOIN users u ON u.id = t.assign_to LEFT JOIN item_section iss ON iss.item_section_id = t.project_id WHERE t.deleted_status = 'N' AND t.task_status NOT IN ('Hold','Cancelled','Client Review','Not Possible','DONE')";
        $arrPendingData =  $cf->getData($sqlQuery);
        return $arrPendingData;
    }

    public function getRecentLoginLogs() {
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path;
        $arrRecentLogin = array();
        $sqlQuery = "SELECT log_id,user_name,platform,browser_name,created_at FROM `login_logs` ORDER BY `log_id` DESC LIMIT 0,20";
        $arrRecentLogin =  $cf->getData($sqlQuery);
        return $arrRecentLogin;
    }

    public function getRecentActivitiesLogs() {
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path;
        $arrRecentActivitiesData = array();
        $sqlQuery = "SELECT record_name,table_name,action,created_by_name,created_at FROM `activity` ORDER BY `activity_id` DESC LIMIT 0,20";
        $arrRecentActivitiesData =  $cf->getData($sqlQuery);
        return $arrRecentActivitiesData;
    }

    public function currentMonthVisitorsByCity() {
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path;
        $arrResponse = array();
        $sqlQuery = "SELECT DISTINCT(city),COUNT(city) as total_visitors FROM `logs` WHERE MONTH(created_date) = MONTH(CURRENT_DATE()) AND YEAR(created_date) = YEAR(CURRENT_DATE()) GROUP BY city";
        $arrResponse =  $cf->getData($sqlQuery);
        return $arrResponse;
    }

    public function currentMonthVisitorsByCountry() {
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path;
        $arrResponse = array();
        $sqlQuery = "SELECT DISTINCT(country),COUNT(country) as total_visitors FROM `logs` WHERE MONTH(created_date) = MONTH(CURRENT_DATE()) AND YEAR(created_date) = YEAR(CURRENT_DATE()) GROUP BY country";
        $arrResponse =  $cf->getData($sqlQuery);
        return $arrResponse;
    }

    public function getClientProjects($user_id = 0) {
        
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path;
        $arrResponse = array();
        
        $sqlQuery = "SELECT item_section_id,section_title,description,user_id FROM `item_section` WHERE user_id = '$user_id' AND item_type = 'projects' AND display_status = 'Y' AND deleted_status = 'N' ORDER BY `user_id` DESC";
        $arrResponse =  $cf->getData($sqlQuery);
        return $arrResponse;
    }

    public function getHoursByProject($project_id = '') {
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path;
        $arrResponse = array();
        $project_id = 0;
        
        if(isset($_SESSION[$back_session_name]['projects']) && $_SESSION[$back_session_name]['projects'] != "") {
            $project_id = $_SESSION[$back_session_name]['projects'];
        }

        $arrProject = explode(",",$project_id);
        if(isset($arrProject) && count($arrProject) > 0) {
            foreach($arrProject as $key => $project_id){
                $sqlQuery = "SELECT SUM(t.hours) as total_hours,iss.section_title as project_name FROM `timecard` as t LEFT JOIN `item_section` iss ON t.project_id = iss.item_section_id WHERE t.project_id IN ($project_id) AND t.deleted_status = 'N' ORDER BY t.project_id  ASC";
                $arrData =  $cf->getOneData($sqlQuery);
                $arrResponse[] = array('hours' => $arrData['total_hours'],'project_id' => $project_id,'project_name' => $arrData['project_name']);
            }
        }
        return $arrResponse;
    }

    public function getHoursByEmployeeForProjects($project_id = '') {
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path;
        $arrResponse = array();
        $project_id = 0;
        
        if(isset($_SESSION[$back_session_name]['projects']) && $_SESSION[$back_session_name]['projects'] != "") {
            $project_id = $_SESSION[$back_session_name]['projects'];
        }
        $arrProject = explode(",",$project_id);
        if(isset($arrProject) && count($arrProject) > 0) {
            foreach($arrProject as $key => $project_id){
                $sqlQuery = "SELECT SUM(t.hours) as total_hours,u.first_name as user_name,t.project_id,iss.section_title as project_name FROM `timecard` t LEFT JOIN `users` u ON u.id = t.user_id LEFT JOIN `item_section` iss ON iss.item_section_id = t.project_id WHERE t.project_id = '$project_id' GROUP BY t.user_id";
                $arrProjectData =  $cf->getData($sqlQuery);
                if(isset($arrProjectData) && count($arrProjectData) > 0) {
                    foreach($arrProjectData as $arrData){
                        $arrResponse[$project_id][] = array('hours' => $arrData['total_hours'],'project_id' => $project_id,'user_name' => $arrData['user_name'],'project_name' => $arrData['project_name']);
                    }
                }
            }
        }
        return $arrResponse;
    }

    public function getInprogressTaskByProject($project_id = '') {
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path;
        $arrResponse = array();
        $project_id = 0;
        
        if(isset($_SESSION[$back_session_name]['projects']) && $_SESSION[$back_session_name]['projects'] != "") {
            $project_id = $_SESSION[$back_session_name]['projects'];
        }
        $arrProject = explode(",",$project_id);
        if(isset($arrProject) && count($arrProject) > 0) {
            foreach($arrProject as $key => $project_id){
                $sqlQuery = "SELECT t.*,u.first_name as user_name,t.project_id,iss.section_title as project_name FROM `task` t LEFT JOIN `users` u ON u.id = t.assign_to LEFT JOIN `item_section` iss ON iss.item_section_id = t.project_id WHERE t.project_id = '$project_id' AND  task_status != 'Done'";
                //echo $sqlQuery;exit;
                $arrProjectData =  $cf->getData($sqlQuery);
                if(isset($arrProjectData) && count($arrProjectData) > 0) {
                    foreach($arrProjectData as $arrData){
                        $arrResponse[$project_id][] = array('user_name' => $arrData['user_name'],'project_name' => $arrData['project_name'],'project_id' => $project_id,'task_name' => $arrData['task_name'],'task_description' => $arrData['task_description'],'task_status' => $arrData['task_status'],'task_priority' => $arrData['task_priority']);
                    }
                }
            }
        }
        return $arrResponse;
    }

    public function getLastmonthHoursbyEmployee() {
        global $cf;
        $sqlQuery = "SELECT user_name,SUM(hours) as total_hours FROM timecard WHERE `is_weekend` = 'N' AND YEAR(timecard_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND MONTH(timecard_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) GROUP BY user_id";
        return $cf->getData($sqlQuery);
    }

    public function getLastmonthWeekendHoursbyEmployee() {
        global $cf;
        $sqlQuery = "SELECT user_name,SUM(hours) as total_hours FROM timecard WHERE `is_weekend` = 'Y' AND YEAR(timecard_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND MONTH(timecard_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) GROUP BY user_id";
        return $cf->getData($sqlQuery);
    }

    public function getLastmonthTotalWorkingHours() {
        global $cf;
        $sqlQuery = "SELECT COUNT(DISTINCT(timecard_date)) as total_working_days FROM `timecard` WHERE `is_weekend` = 'N' AND  YEAR(timecard_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND MONTH(timecard_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)";
        return $cf->getOneData($sqlQuery);
    }
}
?>