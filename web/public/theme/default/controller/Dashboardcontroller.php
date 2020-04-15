<?php
require_once $theme_path.'model/Dashboard.php';
class Dashboardcontroller {

    public $model;
    public function __construct(){
        $this->model = new Dashboard();
    }
    
    public function index() {
        global $cf;
        $cf->checkAdminLogin();
        $cf->checkSchedular();
        global $theme_path,$theme_url,$back_session_name;
        if($_SESSION[$back_session_name]['role_id'] == 1 || $_SESSION[$back_session_name]['role_id'] == 2){
            $arrPreviousdayData = $this->model->getPreviousDayPunchingHours();
            $arrPreviousMonthHoursByMonth = $this->model->getLastmonthHoursbyEmployee();
            $arrPrviousMonthTotalWorkingHours = $this->model->getLastmonthTotalWorkingHours();
            $arrPrviousMonthTotalWeekendWorkingHours = $this->model->getLastmonthWeekendHoursbyEmployee();
            $PreviousDay = $arrPreviousdayData['previousday'];
            $LastdatePunchReport = $arrPreviousdayData['arrEmployeeData'];
            $todayPunchReport = $this->model->getTodayPunchingHours();
            $pendingTasks = $this->model->getAllPendingTasks();
            //$recentLoginLogs = $this->model->getRecentLoginLogs();
            //$recentActivityLogs = $this->model->getRecentActivitiesLogs();
            $cityVisitors = $this->model->currentMonthVisitorsByCity();
            $countryVisitors = $this->model->currentMonthVisitorsByCountry();
            require $theme_path.'views/dashboard.php';
        }
        else if($_SESSION[$back_session_name]['role_id'] == 4){
            $arrClientProjects = $this->model->getClientProjects($_SESSION[$back_session_name]['user_id']);
            $arrProjects = array();
            $strProjects = "";
            if(isset($arrClientProjects) && count($arrClientProjects) > 0) {
                foreach($arrClientProjects as $project){
                    $arrProjects[] = $project['item_section_id'];
                }
            }
            if(!empty($arrProjects)){
                $strProjects = implode(',',$arrProjects);
            }
            if($strProjects != ''){
                $_SESSION[$back_session_name]['projects'] = $strProjects;
            }
            $arrGetHoursByProject = $this->model->getHoursByProject();
            $employeeProjectHours = $this->model->getHoursByEmployeeForProjects();
            $employeeInprogressTask = $this->model->getInprogressTaskByProject();
            
            require $theme_path.'views/dashboardclient.php';
        }
        else {
            $arrSubscribers = $this->model->getRecentSubscribers();
            $arrTimecard = $this->model->getEmployeeTimecard();
            $arrEmployeeTasks = $this->model->getEmployeeTask();
            
            require $theme_path.'views/dashboardemployee.php';
        }
    }

    public function adminapiData(){
        global $theme_path,$theme_url,$back_session_name;
        require_once($theme_path.'getRequestData.php');
        $arrPreviousdayData = $this->model->getPreviousDayPunchingHours();
        $PreviousDay = $arrPreviousdayData['previousday'];
        $LastdatePunchReport = $arrPreviousdayData['arrEmployeeData'];
        $todayPunchReport = $this->model->getTodayPunchingHours();
        $pendingTasks = $this->model->getAllPendingTasks();
        $cityVisitors = $this->model->currentMonthVisitorsByCity();
        $countryVisitors = $this->model->currentMonthVisitorsByCountry();
        $arrData = array(
            'arrPreviousdayData' => $arrPreviousdayData,
            'PreviousDay' => $PreviousDay,
            'LastdatePunchReport' => $LastdatePunchReport,
            'todayPunchReport' => $todayPunchReport,
            'pendingTasks' => $pendingTasks,
            'cityVisitors' => $cityVisitors,
            'countryVisitors' => $countryVisitors
        );
        echo json_encode($arrData);exit;
    }

    public function employeeapiData(){
        global $theme_path,$theme_url,$back_session_name;
        require_once($theme_path.'getRequestData.php');
        $arrSubscribers = $this->model->getRecentSubscribers();
        $arrTimecard = $this->model->getEmployeeTimecard();
        $arrEmployeeTasks = $this->model->getEmployeeTask();
        $arrData = array(
            'arrSubscribers' => $arrSubscribers,
            'arrTimecard' => $arrTimecard,
            'arrEmployeeTasks' => $arrEmployeeTasks
        );
        //print_r($arrData);
        echo json_encode($arrData);exit;
    }

    public function clientapiData(){
        global $theme_path,$theme_url,$back_session_name;
        require_once($theme_path.'getRequestData.php');
        $user_id = 0;
        if(isset($_SESSION[$back_session_name]['user_id']) && $_SESSION[$back_session_name]['user_id'] > 0) {
            $user_id = $_SESSION[$back_session_name]['user_id'];
        }
        if(isset($_REQUEST['user_id']) && $_REQUEST['user_id'] > 0) {
            $user_id = $_REQUEST['user_id'];
        }
        $arrClientProjects = $this->model->getClientProjects($user_id);
        $arrProjects = array();
        $strProjects = "";
        if(isset($arrClientProjects) && count($arrClientProjects) > 0) {
            foreach($arrClientProjects as $project){
                $arrProjects[] = $project['item_section_id'];
            }
        }
        if(!empty($arrProjects)){
            $strProjects = implode(',',$arrProjects);
        }
        $arrGetHoursByProject = $this->model->getHoursByProject($strProjects);
        $employeeProjectHours = $this->model->getHoursByEmployeeForProjects($strProjects);
        $employeeInprogressTask = $this->model->getInprogressTaskByProject($strProjects);
        $arrData = array(
            'arrClientProjects' => $arrClientProjects,
            'arrProjects' => $arrProjects,
            'arrGetHoursByProject' => $arrGetHoursByProject,
            'employeeProjectHours' => $employeeProjectHours,
            'employeeInprogressTask' => $employeeInprogressTask
        );
        //print_r($arrData);
        echo json_encode($arrData);exit;
    }
}
?>