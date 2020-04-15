<?php
class Report {
    
    public function reportitem() {
        global $cf,$page_data,$url;
        $sql = "DESC items";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function reportactivities() {
        global $cf,$page_data,$url;
        $sql = "DESC activity";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function reporttimecard() {
        global $cf,$page_data,$url;
        $sql = "DESC timecard";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function reportvisitors() {
        global $cf,$page_data,$url;
        $sql = "DESC logs";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function reporttask() {
        global $cf,$page_data,$url;
        $sql = "DESC task";
        $arrData = $cf->getData($sql);
        return $arrData;
    }


    // For Visitors Report Start //
    public function getCountries() {
        global $cf,$page_data,$url;
        $sql = "SELECT DISTINCT(country) FROM `logs` ORDER BY `logs`.`log_id` DESC";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function getTitle() {
        global $cf,$page_data,$url;
        $sql = "SELECT DISTINCT(title) FROM `logs` ORDER BY `logs`.`log_id` DESC";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function getCity() {
        global $cf,$page_data,$url;
        $sql = "SELECT DISTINCT(city) FROM `logs` ORDER BY `logs`.`log_id` DESC";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function getPlatform() {
        global $cf,$page_data,$url;
        $sql = "SELECT DISTINCT(platform) FROM `logs` ORDER BY `logs`.`log_id` DESC";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function getBrowsername() {
        global $cf,$page_data,$url;
        $sql = "SELECT DISTINCT(browsername) FROM `logs` ORDER BY `logs`.`log_id` DESC";
        $arrData = $cf->getData($sql);
        return $arrData;
    }
    // For Visitors Report Over //


    
    // For Items Report Start //
    public function getItemType() {
        global $cf,$page_data,$url;
        $sql = "SELECT DISTINCT(item_type) FROM `items` WHERE deleted_status = 'N' AND admin_module = 'N' ORDER BY `items`.`item_id` DESC";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function getItemTitles() {
        global $cf,$page_data,$url;
        $sql = "SELECT * FROM `items` WHERE deleted_status = 'N' AND admin_module = 'N' ORDER BY `items`.`item_id` DESC";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function getItemUsers() {
        global $cf,$page_data,$url;
        $sql = "SELECT DISTINCT(i.user_id),CONCAT(u.first_name,' ',u.last_name) as user_name FROM `items` i LEFT JOIN `users` u ON u.id = i.user_id WHERE i.user_id > 0 AND i.deleted_status = 'N' AND i.admin_module = 'N' ORDER BY i.item_id DESC";
        //echo $sql;exit;
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function getAdminmodules() {
        global $cf,$page_data,$url;
        $sql = "SELECT item_id,item_title FROM `items` WHERE deleted_status = 'N' AND admin_module = 'Y' ORDER BY `items`.`item_id` DESC";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function getCreatedDate() {
        global $cf,$page_data,$url;
        $sql = "SELECT DISTINCT(DATE_FORMAT(created_at, '%Y-%m-%d')) as created_at FROM `items` WHERE deleted_status = 'N' ORDER BY `items`.`item_id` DESC";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function getDeletedItems() {
        global $cf,$page_data,$url;
        $sql = "SELECT item_id,item_title FROM `items` WHERE deleted_status = 'Y' ORDER BY `items`.`item_id` DESC";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function getRobots() {
        global $cf,$page_data,$url;
        $sql = "SELECT DISTINCT(robots) FROM `items` WHERE  deleted_status = 'N' ORDER BY `items`.`item_id` DESC";
        $arrData = $cf->getData($sql);
        return $arrData;
    }
    // For Items Report Over //


    // For Activities Report Start //
    public function getActivityTables() {
        global $cf,$page_data,$url;
        $sql = "SELECT DISTINCT(table_name) FROM `activity` ORDER BY `activity_id` DESC";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function getActivityRecordname() {
        global $cf,$page_data,$url;
        $sql = "SELECT DISTINCT(record_name) FROM `activity` ORDER BY `activity_id` DESC";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function getActivityCreatedBy() {
        global $cf,$page_data,$url;
        $sql = "SELECT DISTINCT(created_by_name) FROM `activity` ORDER BY `activity_id` DESC";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function getActivityStatusAction() {
        global $cf,$page_data,$url;
        $sql = "SELECT DISTINCT(status_action) FROM `activity` ORDER BY `activity_id` DESC";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function getActivityAction() {
        global $cf,$page_data,$url;
        $sql = "SELECT DISTINCT(action) FROM `activity` ORDER BY `activity_id` DESC";
        $arrData = $cf->getData($sql);
        return $arrData;
    }
    // For Activities Report Over //


    // For Timecard Report Start //
    public function getTimecardUsers() {
        global $cf,$page_data,$url;
        $sql = "SELECT DISTINCT(user_name) FROM `timecard` ORDER BY `timecard_id` DESC";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function getTimecardProjects() {
        global $cf,$page_data,$url;
        $sql = "SELECT DISTINCT(t.project_id),i.section_title as project_name FROM `timecard` t LEFT JOIN `item_section` i ON t.project_id = i.item_section_id ORDER BY t.timecard_id DESC";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function getTimecardTask() {
        global $cf,$page_data,$url;
        $sql = "SELECT DISTINCT(task_id),task_name FROM `timecard` ORDER BY `timecard_id` DESC";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function getTimecardDate() {
        global $cf,$page_data,$url;
        $sql = "SELECT DISTINCT(timecard_date) FROM `timecard` ORDER BY `timecard_id` DESC";
        $arrData = $cf->getData($sql);
        return $arrData;
    }
    // For Timecard Report Over //


    // For Task Report Start //
    public function getTaskStatus() {
        global $cf,$page_data,$url;
        $sql = "SELECT DISTINCT(task_status) FROM `task` ORDER BY `task_id` DESC";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function getTaskPriority() {
        global $cf,$page_data,$url;
        $sql = "SELECT DISTINCT(task_priority) FROM `task` ORDER BY `task_id` DESC";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function getInventoryFields() {
        global $cf,$page_data,$url;
        $sql = "DESC inv_inventories";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function getCreatedDateInventories() {
        global $cf,$page_data,$url;
        $sql = "SELECT DISTINCT(DATE_FORMAT(created_at, '%Y-%m-%d')) as created_at FROM `inv_inventories` WHERE deleted_status = 'N'";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function getTaskName() {
        global $cf,$page_data,$url;
        $sql = "SELECT DISTINCT(task_name) FROM `task` ORDER BY `task_id` DESC";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function getAssignto() {
        global $cf,$page_data,$url;
        $sql = "SELECT DISTINCT(t.assign_to),CONCAT(u.first_name,' ',u.last_name) as `user_name` FROM `task` t LEFT JOIN `users` u ON t.assign_to = u.id ORDER BY t.task_id DESC";
        $arrData = $cf->getData($sql);
        return $arrData;
    }


    public function getMilestones() {
        global $cf,$page_data,$url;
        $sql = "SELECT DISTINCT(milestone) FROM `task` ORDER BY `task_id` DESC";
        $arrData = $cf->getData($sql);
        return $arrData;
    }
    // For Task Report End //


    public function itemReportExport() {
        global $theme_path,$theme_url,$cf;
        $where_string = "";
        require $theme_path.'/PHPExcel.php';
        $table = 'items';
        
        if((isset($_REQUEST['start_date']) && $_REQUEST['start_date'] != "") && isset($_REQUEST['end_date']) && $_REQUEST['end_date'] != ""){
            $start_date = $_REQUEST['start_date'].' 00:00:00';
            $end_date = $_REQUEST['end_date'].' 23:59:59';
            $where_string .= " AND (created_at BETWEEN '$start_date' AND '$end_date') ";
        }
        if(isset($_REQUEST['item_type']) && $_REQUEST['item_type'] != "") {
            $where_string .= " AND item_type = '".$_REQUEST['item_type']."'";
        }
        if(isset($_REQUEST['item_title']) && $_REQUEST['item_title'] != "") {
            $where_string .= " AND item_title = '".$_REQUEST['item_title']."'";
        }
        if(isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != "") {
            $where_string .= " AND user_id = '".$_REQUEST['user_id']."'";
        }
        if(isset($_REQUEST['admin_module']) && $_REQUEST['admin_module'] != "") {
            $where_string .= " AND admin_module = '".$_REQUEST['admin_module']."'";
        }
        if(isset($_REQUEST['robots']) && $_REQUEST['robots'] != "") {
            $where_string .= " AND robots = '".$_REQUEST['robots']."'";
        }
        if(isset($_REQUEST['created_at']) && $_REQUEST['created_at'] != "") {
            $start_date = $_REQUEST['created_at'].' 00:00:00';
            $end_date = $_REQUEST['created_at'].' 23:59:59';
            $where_string .= " AND (created_at BETWEEN '$start_date' AND '$end_date') ";
        }
        if(isset($_REQUEST['deleted_status']) && $_REQUEST['deleted_status'] != "") {
            $where_string .= " AND item_id = '".$_REQUEST['deleted_status']."'";
        }
        //echo $where_string;exit;
        require $theme_path.'model/Report_Export_Pre.php';
    }

    public function taskReportExport() {
        global $theme_path,$theme_url,$cf;
        $where_string = "";
        require $theme_path.'/PHPExcel.php';
        $table = 'task';
        
        if((isset($_REQUEST['start_date']) && $_REQUEST['start_date'] != "") && isset($_REQUEST['end_date']) && $_REQUEST['end_date'] != ""){
            $start_date = $_REQUEST['start_date'].' 00:00:00';
            $end_date = $_REQUEST['end_date'].' 23:59:59';
            $where_string .= " AND (created_at BETWEEN '$start_date' AND '$end_date') ";
        }
        if(isset($_REQUEST['task_status']) && $_REQUEST['task_status'] != "") {
            $where_string .= " AND task_status = '".$_REQUEST['task_status']."'";
        }
        if(isset($_REQUEST['task_priority']) && $_REQUEST['task_priority'] != "") {
            $where_string .= " AND task_priority = '".$_REQUEST['task_priority']."'";
        }
        if(isset($_REQUEST['task_name']) && $_REQUEST['task_name'] != "") {
            $where_string .= " AND task_name = '".$_REQUEST['task_name']."'";
        }
        if(isset($_REQUEST['assign_to']) && $_REQUEST['assign_to'] != "") {
            $where_string .= " AND assign_to = '".$_REQUEST['assign_to']."'";
        }
        if(isset($_REQUEST['milestone']) && $_REQUEST['milestone'] != "") {
            $where_string .= " AND milestone = '".$_REQUEST['milestone']."'";
        }
        //echo $where_string;exit;
        require $theme_path.'model/Report_Export_Pre.php';
    }

    public function activityReportExport() {
        //print_r($_REQUEST);exit;
        global $theme_path,$theme_url,$cf;
        $where_string = "";
        require $theme_path.'/PHPExcel.php';
        $table = 'activity';
        
        if((isset($_REQUEST['start_date']) && $_REQUEST['start_date'] != "") && isset($_REQUEST['end_date']) && $_REQUEST['end_date'] != ""){
            $start_date = $_REQUEST['start_date'].' 00:00:00';
            $end_date = $_REQUEST['end_date'].' 23:59:59';
            $where_string .= " AND (created_at BETWEEN '$start_date' AND '$end_date') ";
        }
        if(isset($_REQUEST['table_name']) && $_REQUEST['table_name'] != "") {
            $where_string .= " AND table_name = '".$_REQUEST['table_name']."'";
        }
        if(isset($_REQUEST['record_name']) && $_REQUEST['record_name'] != "") {
            $where_string .= " AND record_name = '".$_REQUEST['record_name']."'";
        }
        if(isset($_REQUEST['created_by']) && $_REQUEST['created_by'] != "") {
            $where_string .= " AND created_by_name = '".$_REQUEST['created_by']."'";
        }
        if(isset($_REQUEST['status_action']) && $_REQUEST['status_action'] != "") {
            $where_string .= " AND status_action = '".$_REQUEST['status_action']."'";
        }
        if(isset($_REQUEST['action']) && $_REQUEST['action'] != "") {
            $where_string .= " AND `action` = '".$_REQUEST['action']."'";
        }
        if(isset($_REQUEST['created_at']) && $_REQUEST['created_at'] != "") {
            $start_date = $_REQUEST['created_at'].' 00:00:00';
            $end_date = $_REQUEST['created_at'].' 23:59:59';
            $where_string .= " AND (created_at BETWEEN '$start_date' AND '$end_date') ";
        }
        //echo $where_string;exit;
        require $theme_path.'model/Report_Export_Pre.php';
    }

    public function timecardReportExport() {
        global $theme_path,$theme_url,$cf;
        $where_string = "";
        require $theme_path.'/PHPExcel.php';
        $table = 'timecard';
        
        if((isset($_REQUEST['start_date']) && $_REQUEST['start_date'] != "") && isset($_REQUEST['end_date']) && $_REQUEST['end_date'] != ""){
            $start_date = $_REQUEST['start_date'].' 00:00:00';
            $end_date = $_REQUEST['end_date'].' 23:59:59';
            $where_string .= " AND (created_at BETWEEN '$start_date' AND '$end_date') ";
        }
        if(isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != "") {
            $where_string .= " AND user_name = '".$_REQUEST['user_id']."'";
        }
        if(isset($_REQUEST['project_id']) && $_REQUEST['project_id'] != "") {
            $where_string .= " AND project_id = '".$_REQUEST['project_id']."'";
        }
        if(isset($_REQUEST['task_id']) && $_REQUEST['task_id'] != "") {
            $where_string .= " AND task_id = '".$_REQUEST['task_id']."'";
        }
        if(isset($_REQUEST['timecard_date']) && $_REQUEST['timecard_date'] != "") {
            $where_string .= " AND timecard_date = '".$_REQUEST['timecard_date']."'";
        }
        //echo $where_string;exit;
        require $theme_path.'model/Report_Export_Pre.php';
    }

    public function visitorsReportExport() {
        global $theme_path,$theme_url,$cf;
        $where_string = "";
        require $theme_path.'/PHPExcel.php';
        $table = 'logs';
        
        if((isset($_REQUEST['start_date']) && $_REQUEST['start_date'] != "") && isset($_REQUEST['end_date']) && $_REQUEST['end_date'] != ""){
            $start_date = $_REQUEST['start_date'].' 00:00:00';
            $end_date = $_REQUEST['end_date'].' 23:59:59';
            $where_string .= " AND (created_at BETWEEN '$start_date' AND '$end_date') ";
        }
        if(isset($_REQUEST['title']) && $_REQUEST['title'] != "") {
            $where_string .= " AND title = '".$_REQUEST['title']."'";
        }
        if(isset($_REQUEST['country']) && $_REQUEST['country'] != "") {
            $where_string .= " AND country = '".$_REQUEST['country']."'";
        }
        if(isset($_REQUEST['city']) && $_REQUEST['city'] != "") {
            $where_string .= " AND city = '".$_REQUEST['city']."'";
        }
        if(isset($_REQUEST['platform']) && $_REQUEST['platform'] != "") {
            $where_string .= " AND platform = '".$_REQUEST['platform']."'";
        }
        if(isset($_REQUEST['browsername']) && $_REQUEST['browsername'] != "") {
            $where_string .= " AND browsername = '".$_REQUEST['browsername']."'";
        }
        //echo $where_string;exit;
        require $theme_path.'model/Report_Export_Pre.php';
    }

    // Section Report Menu Start //
    
    public function reportsectionitem() {
        global $cf,$page_data,$url;
        $sql = "DESC item_section";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function getSectionItemType() {
        global $cf,$page_data,$url;
        $sql = "SELECT DISTINCT(item_type) FROM `item_section` WHERE deleted_status = 'N'  ORDER BY `item_section`.`item_section_id` DESC";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function getSectionItemTitles() {
        global $cf,$page_data,$url;
        $sql = "SELECT * FROM `item_section` WHERE deleted_status = 'N' ORDER BY `item_section`.`item_section_id` DESC";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function getItemSectionUsers() {
        global $cf,$page_data,$url;
        $sql = "SELECT DISTINCT(i.user_id),CONCAT(u.first_name,' ',u.last_name) as user_name FROM `item_section` i LEFT JOIN `users` u ON u.id = i.user_id WHERE i.user_id > 0 AND i.deleted_status = 'N' ORDER BY i.item_section_id DESC";
        //echo $sql;exit;
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function getSectionCreatedDate() {
        global $cf,$page_data,$url;
        $sql = "SELECT DISTINCT(DATE_FORMAT(created_at, '%Y-%m-%d')) as created_at FROM `item_section` WHERE deleted_status = 'N' ORDER BY `item_section`.`item_section_id` DESC";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function getSectionDeletedItems() {
        global $cf,$page_data,$url;
        $sql = "SELECT item_section_id,section_title FROM `item_section` WHERE deleted_status = 'Y' ORDER BY `item_section`.`item_section_id` DESC";
        $arrData = $cf->getData($sql);
        return $arrData;
    }

    public function itemSectionReportExport() {
        global $theme_path,$theme_url,$cf;
        $where_string = "";
        require $theme_path.'/PHPExcel.php';
        $table = 'item_section';
        
        if((isset($_REQUEST['start_date']) && $_REQUEST['start_date'] != "") && isset($_REQUEST['end_date']) && $_REQUEST['end_date'] != ""){
            $start_date = $_REQUEST['start_date'].' 00:00:00';
            $end_date = $_REQUEST['end_date'].' 23:59:59';
            $where_string .= " AND (created_at BETWEEN '$start_date' AND '$end_date') ";
        }
        if(isset($_REQUEST['item_type']) && $_REQUEST['item_type'] != "") {
            $where_string .= " AND item_type = '".$_REQUEST['item_type']."'";
        }
        if(isset($_REQUEST['section_title']) && $_REQUEST['section_title'] != "") {
            $where_string .= " AND section_title = '".$_REQUEST['section_title']."'";
        }
        if(isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != "") {
            $where_string .= " AND user_id = '".$_REQUEST['user_id']."'";
        }
        if(isset($_REQUEST['created_at']) && $_REQUEST['created_at'] != "") {
            $start_date = $_REQUEST['created_at'].' 00:00:00';
            $end_date = $_REQUEST['created_at'].' 23:59:59';
            $where_string .= " AND (created_at BETWEEN '$start_date' AND '$end_date') ";
        }
        if(isset($_REQUEST['deleted_status']) && $_REQUEST['deleted_status'] != "") {
            $where_string .= " AND item_section_id = '".$_REQUEST['deleted_status']."'";
        }
        //echo $where_string;exit;
        require $theme_path.'model/Report_Export_Pre.php';
    }

    // Section Report Menu Over //





    public function inventoriesReportExport() {
        global $theme_path,$theme_url,$cf;
        $where_string = "";
        require $theme_path.'/PHPExcel.php';
        $table = 'inv_inventories';
        
        if((isset($_REQUEST['start_date']) && $_REQUEST['start_date'] != "") && isset($_REQUEST['end_date']) && $_REQUEST['end_date'] != ""){
            $start_date = $_REQUEST['start_date'].' 00:00:00';
            $end_date = $_REQUEST['end_date'].' 23:59:59';
            $where_string .= " AND (created_at BETWEEN '$start_date' AND '$end_date') ";
        }
        if(isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != "") {
            $where_string .= " AND user_id = '".$_REQUEST['user_id']."'";
        }
        if(isset($_REQUEST['created_at']) && $_REQUEST['created_at'] != "") {
            $start_date = $_REQUEST['created_at'].' 00:00:00';
            $end_date = $_REQUEST['created_at'].' 23:59:59';
            $where_string .= " AND (created_at BETWEEN '$start_date' AND '$end_date') ";
        }
        if(isset($_REQUEST['deleted_status']) && $_REQUEST['deleted_status'] != "") {
            $where_string .= " AND inventory_id = '".$_REQUEST['deleted_status']."'";
        }
        //echo $where_string;exit;
        require $theme_path.'model/InventoryReport_Export_Pre.php';
    }


}
?>