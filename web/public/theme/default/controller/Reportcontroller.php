<?php
require_once $theme_path.'model/Report.php';
class Reportcontroller {

    public $model;
    public function __construct(){
        $this->model = new Report();
    }

    public function reportitem() {
        global $theme_path,$theme_url,$cf;
        $cf->checkAdminLogin();
        $arrItems = $this->model->reportitem();
        $arrItemtype = $this->model->getItemType();
        $arrItemtitle = $this->model->getItemTitles();
        $arrUsers = $this->model->getItemUsers();
        $arrAdminModules = $this->model->getAdminmodules();
        $arrCreatedDate = $this->model->getCreatedDate();
        $arrDeletedItems = $this->model->getDeletedItems();
        $arrRobots = $this->model->getRobots();
        require $theme_path.'views/reportitem.php';
    }

    public function reportsections() {
        global $theme_path,$theme_url,$cf;
        $cf->checkAdminLogin();
        $arrItems = $this->model->reportsectionitem();
        $arrItemtype = $this->model->getSectionItemType();
        $arrItemtitle = $this->model->getSectionItemTitles();
        $arrUsers = $this->model->getItemSectionUsers();
        // $arrAdminModules = $this->model->getAdminmodules();
        $arrCreatedDate = $this->model->getSectionCreatedDate();
        $arrDeletedItems = $this->model->getSectionDeletedItems();
        // $arrRobots = $this->model->getRobots();
        require $theme_path.'views/reportsections.php';
    }

    

    public function reportactivities() {
        global $theme_path,$theme_url,$cf;
        $cf->checkAdminLogin();
        $arrItems = $this->model->reportactivities();
        $arrDatabaseTables = $this->model->getActivityTables();
        $arrRecordname = $this->model->getActivityRecordname();
        $arrCreatedby = $this->model->getActivityCreatedBy();
        $arrStatusAction = $this->model->getActivityStatusAction();
        $arrAction = $this->model->getActivityAction();
        require $theme_path.'views/reportactivities.php';
    }

    public function reporttimecard() {
        global $theme_path,$theme_url,$cf;
        $cf->checkAdminLogin();
        $arrItems = $this->model->reporttimecard();
        $arrTimecardUsers = $this->model->getTimecardUsers();
        $arrTimecardProjects = $this->model->getTimecardProjects();
        $arrTimecardTask = $this->model->getTimecardTask();
        $arrTimecardDate = $this->model->getTimecardDate();

        require $theme_path.'views/reporttimecard.php';
    }

    public function reportvisitors() {
        global $theme_path,$theme_url,$cf;
        $cf->checkAdminLogin();
        $arrItems = $this->model->reportvisitors();
        $arrCountries = $this->model->getCountries();
        $arrTitle = $this->model->getTitle();
        $arrCities = $this->model->getCity();
        $arrPlatform = $this->model->getPlatform();
        $arrBrowsername = $this->model->getBrowsername();
        require $theme_path.'views/reportvisitors.php';
    }
    
    public function reporttasks() {
        global $theme_path,$theme_url,$cf;
        $cf->checkAdminLogin();
        $arrItems = $this->model->reporttask();
        $arrTaskstatus = $this->model->getTaskStatus();
        $arrTaskpriority = $this->model->getTaskPriority();
        $arrTaskname = $this->model->getTaskName();
        $arrTaskAssignto = $this->model->getAssignto();
        $arrTaskmilestones = $this->model->getMilestones();

        require $theme_path.'views/reporttasks.php';
    }

    public function inventoryreports() {
        global $theme_path,$theme_url,$cf,$url,$back_end_rpp,$page_data,$cf,$back_session_name,$backend_allow_action_dropdown,$backend_allow_apply_button,$backend_allow_addnew_button;
        $cf->checkAdminLogin();
        $arrInventoryFields = $this->model->getInventoryFields();
        $arrCreatedDate = $this->model->getCreatedDateInventories();
        require $theme_path.'views/inventoryreports.php';
    }

    public function inventoriesReportExport() {
        if(isset($_REQUEST['exportfields']) && $_REQUEST['exportfields'] != ''){
            $this->model->inventoriesReportExport();
        }
    }

    public function itemReportExport() {
        if(isset($_REQUEST['exportfields']) && $_REQUEST['exportfields'] != ''){
            $this->model->itemReportExport();
        }
    }

    public function itemSectionReportExport() {
        if(isset($_REQUEST['exportfields']) && $_REQUEST['exportfields'] != ''){
            $this->model->itemSectionReportExport();
        }
    }

    public function taskReportExport() {
        $this->model->taskReportExport();
    }

    public function activityReportExport() {
        $this->model->activityReportExport();
    }

    public function timecardReportExport() {
        $this->model->timecardReportExport();
    }

    public function visitorsReportExport() {
        $this->model->visitorsReportExport();
    }

}
?>