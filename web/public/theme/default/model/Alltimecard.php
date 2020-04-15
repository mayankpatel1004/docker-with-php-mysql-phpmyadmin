<?php
class Alltimecard {

    public function getAssignees() {
        $all_users = array();
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path;
        $sqlUsers = "SELECT * FROM `users` WHERE `display_status` = 'Y' AND `blocked` = 'N' AND `deleted_status` = 'N' ORDER BY id ASC";
        $arrData = $cf->getData($sqlUsers);
        if(isset($arrData) && !empty($arrData)) {
            foreach($arrData as $data){
                $all_users[$data['id']] = $data['first_name'].' '.$data['last_name'];
            }
        }
        return $all_users;
    }

    public function getProjects() {
        $all_projects = array();
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path;
        $sqProjects = "SELECT * FROM `item_section` WHERE `item_type` IN ('projects') AND `deleted_status` = 'N' ORDER BY item_section_id DESC";
        $arrProjects = $cf->getData($sqProjects);
        if(isset($arrProjects) && !empty($arrProjects)) {
            foreach($arrProjects as $data){
                if($data['item_type'] == 'projects'){
                    $all_projects[$data['item_section_id']] = $data['section_title'];
                }       
            }
        }
        return $all_projects;
    }

    public function getList() {
        //print_r($_REQUEST);exit;
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path;
        $page_no = 1;
        $start = 0;
        $item_alias = "alltimecard";
        $item_type = "alltimecard";
        $search_text = "";
        $sort_by = "timecard_id";
        $sort_type = "DESC";
        $page_url = "";
        $projectid = "";
        $assigneeid = "";
        $token = "";
        $success = 1;
        $error = 0;
        $status = 200;
        $message = "";

        //print_r($_SESSION[$back_session_name]['role_id']);exit;

        $records_per_page = $back_end_rpp;
        $search_string = "";
        $columns_list = "timecard_id,user_name,task_name,created_at,updated_at";
        
        if(isset($page_data['item_alias']) && $page_data['item_alias'] != ''){
            $item_alias = $page_data['item_alias'];
        }

        if(isset($page_data['item_type']) && $page_data['item_type'] != ''){
            $item_type = $page_data['item_type'];
        }

        if(isset($_REQUEST['records_per_page']) && $_REQUEST['records_per_page'] > 0){
            $records_per_page = $_REQUEST['records_per_page'];
            $_SESSION[$back_session_name][$item_alias]['records_per_page'] = $records_per_page;
        }
        if(isset($_REQUEST['page_no']) && $_REQUEST['page_no'] > 0){
            $page_no = $_REQUEST['page_no'];
            $_SESSION[$back_session_name][$item_alias]['page_no'] = $page_no;
        }

        if(isset($_REQUEST['user_id']) && $_REQUEST['user_id'] > 0){
            $user_id = $_REQUEST['user_id'];
            $_SESSION[$back_session_name][$item_alias]['user_id'] = $user_id;
            $search_string .= " AND  user_id = '".$assigneeid."' ";
        }

        $start = ($page_no - 1) * $records_per_page;

        if(isset($_REQUEST['search_text']) && $_REQUEST['search_text'] != ''){
            $search_text = $_REQUEST['search_text'];

            $search_text = strtr($search_text, '/', '-');
            //echo date('Y-m-d', strtotime($date1));
            $dateformat = date('Y-m-d',strtotime($search_text));
            if($dateformat != '1970-01-01'){
                $search_text = $dateformat;
            }
            
            $search_string = " AND (CONCAT_WS(`task_name`,`task_comment`,`timecard_date`,`user_name`) LIKE'%" . addslashes($search_text) . "%') ";
            $_SESSION[$back_session_name][$item_alias]['search_text'] = $search_text;
        }

        if(isset($_SESSION[$back_session_name]['role_id']) && $_SESSION[$back_session_name]['role_id'] > 2) {
            $search_string .= " AND `user_id` = '".$_SESSION[$back_session_name]['user_id']."'";
        }

        // if(isset($_REQUEST['sort_type']) && $_REQUEST['sort_type'] != ''){
        //     $sort_type = $_REQUEST['sort_type'];
        // }
        // if(isset($_REQUEST['sort_by']) && $_REQUEST['sort_by'] != ''){
        //     $sort_by = $_REQUEST['sort_by'];
        //     $newstring = substr($_REQUEST['sort_by'], -4);
        //     $sort_by = str_replace("__desc","",$_REQUEST['sort_by']);
        //     if($newstring == '_asc'){
        //         $sort_by = str_replace("__asc","",$_REQUEST['sort_by']);
        //     }
        // }
        if(isset($_REQUEST['url']) && $_REQUEST['url'] != ''){
            $page_url = $_REQUEST['url'];
        }
        
        if($sort_by != '' && $sort_type != ''){
            //echo $sort_by."--------------".$sort_type;exit;
            $_SESSION[$back_session_name][$item_alias]['sort_by'] = $sort_by."__".$sort_type;
        }

        $sql = "SELECT * FROM timecard WHERE 1=1 $search_string AND deleted_status = 'N' ORDER BY $sort_by $sort_type LIMIT $start,$records_per_page";
        //echo $sql;exit;
        $arrData = $cf->getData($sql);
        
        $sqlCount = "SELECT * FROM timecard WHERE 1=1 $search_string AND deleted_status = 'N' ";
        $arrDataCount = $cf->getData($sqlCount);
        $totalData = count($arrDataCount);
        //print_r($arrData);exit;
        
        $string = "";
        if(isset($arrData) && !empty($arrData)){
            foreach($arrData as $data) {
                
                $edit_url = $url.$item_alias."/form/?id=".$data['timecard_id'];
                $timecard_date = date('Y-m-d',strtotime($data['timecard_date']));
                
                $string .= '<tr>
                <td><input type="checkbox" name="chk[]" value="'.$data['timecard_id'].'" class="form-control chkbox checkbox"></td>
                <td><a class="text-primary" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal-'.$data['timecard_id'].'">'.$data['task_name'].'</a>
                  <div class="modal fade" id="exampleModal-'.$data['timecard_id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-'.$data['timecard_id'].'" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel-'.$data['timecard_id'].'">'.$data['task_name'].'</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <label class="text-primary">Comments</label>
                            <input type="hidden" id="task_name_'.$data['timecard_id'].'" value="'.$data['task_name'].'" />
                          <textarea class="form-control" id="task_comment_'.$data['timecard_id'].'">'.$data['task_comment'].'</textarea>
                          <br /> 
                          <label class="text-primary">Date</label>
                          <input type="date" class="form-control" id="timecard_date_'.$data['timecard_id'].'" value="'.$timecard_date.'" />
                          <br />
                          <label class="text-primary">Hours</label>
                          <input type="number" class="form-control" id="hours_'.$data['timecard_id'].'" value="'.$data['hours'].'" />
                        </div>
                        <div class="text-danger text-center" id="timecard_error_'.$data['timecard_id'].'"></div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-success" onclick=fnUpdateTimecard('.$data['timecard_id'].');>Update</button>
                          <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
                <td style="width:25%;"><label>'.$data['task_comment'].'</label></td>
                <td><label>'.$data['hours'].'</label></td>
                <td>'.date(DATE_FORMAT,strtotime($data['timecard_date'])).'</td>
                <td>'.$data['user_name'].'</td>
                <td>'.$data['timecard_id'].'</td>
              </tr>';
            }
            $string .= '<tr><td colspan="8" align="right">Showing '.($start+1).' to '.($records_per_page * $page_no).' .Total Records '.count($arrDataCount).'</td></tr>';
        }else {
            $string .= '<tr><td colspan="10" class="text-center">Sorry, No record available</td></tr>';
        }
        //echo $records_per_page."=".$page_no."=".$page_url."=".$totalData."=".$item_alias;exit;
        $pagination = $cf->getPagination($records_per_page,$page_no,$page_url,$totalData,$item_alias);
        $string .= '<tr><td colspan="10" class="text-right">'.$pagination.'</td></tr>';
        //echo $string;exit;
        if(isset($_REQUEST['device']) && $_REQUEST['device'] == 'Nonweb'){
            $total_pages = 1;
            if(isset($totalData) && $totalData > 0) {
                if($totalData > $records_per_page) {
                    $total_pages = ceil($totalData / $records_per_page);
                    $message = "Data Successfully Retrieved !!!";
                }
            }
            require_once($theme_path.'getRequestData.php');
            $arrData = array(
                'token' => $token,
                'success' => $success,
                'error' => $error,
                'status' => $status,
                'message' => $message,
                'total_pages' => $total_pages,
                'values' => $arrData
            );
        }else {
            $arrData = array('data' => $string);
        }
        //print_r($arrData);exit;
        echo json_encode($arrData);exit;
    }

    public function getOnedata($id) {
        global $cf,$page_data,$url;
        if($id > 0){
            $sql = "SELECT * FROM `timecard` WHERE timecard_id = '$id'";
            return $cf->getOneData($sql);
        }
    }

    public function getOneTimecard($timecard_id) {
        global $cf,$page_data,$url;
        if($timecard_id > 0){
            $sql = "SELECT * FROM `timecard` WHERE timecard_id = '$timecard_id'";
            return $cf->getOneData($sql);
        }
    }

    public function deleteTimecard($timecard_id,$action,$task_name) {
        global $cf,$page_data,$url,$theme_path,$conn;
        $table_name = "timecard";
        $action = "Timecard Deleted";
        require_once($theme_path.'controller/convertApiDataToRequest.php');
        if($timecard_id > 0){
            $sql = "UPDATE $table_name SET `deleted_status` = 'Y' WHERE timecard_id = '$timecard_id'";
            try {
                $stmt = $conn->prepare($sql); 
                $stmt->execute();
            } catch (PDOException $ex) {
                include $theme_path.'controller/logError.php';
            }

            $activity = "INSERT INTO `activity` SET
            `action` = '$action',
            `table_name` = '$table_name',
            `record_id` = '$timecard_id',
            `record_name` = '".$task_name."',
            `created_by` = $login_id,
            `created_by_name` = '$login_name',
            `created_at` = NOW(),
            `updated_at` = NOW()";
            try {
                $stmt = $conn->prepare($activity); 
                $stmt->execute();
            } catch (PDOException $ex) {
                include $theme_path.'controller/logError.php';
            }

            $activity = "INSERT INTO `task_activity` SET
            `timecard_id` = '$timecard_id',
            `task_name` = '".$task_name."',
            `task_action` = '$action',
            `created_by` = $login_id,
            `created_by_name` = '$login_name',
            `created_at` = NOW(),
            `updated_at` = NOW()";
            try {
                $stmt = $conn->prepare($activity); 
                $stmt->execute();
                $success = 1;
                $error = 0;
            } catch (PDOException $ex) {
                include $theme_path.'controller/logError.php';
            }

        }
    }

    public function getAlltimecard($timecard_id) {
        global $cf,$page_data,$url,$back_session_name;
        $arrData = array();
        $role_id = 0;
        $user_id = 0;
        if(isset($_SESSION[$back_session_name]['role_id']) && $_SESSION[$back_session_name]['role_id'] > 0){
            $role_id = $_SESSION[$back_session_name]['role_id'];
            $user_id = $_SESSION[$back_session_name]['user_id'];
        }
        if($timecard_id > 0){
            if($role_id > 2) {
                $sql = "SELECT * FROM `timecard` WHERE timecard_id = '$timecard_id' AND user_id = '$user_id' AND deleted_status = 'N' ORDER BY timecard_id DESC";
            } else {
                $sql = "SELECT * FROM `timecard` WHERE timecard_id = '$timecard_id' AND deleted_status = 'N' ORDER BY timecard_id DESC";
            }
            $arrData = $cf->getData($sql);
        }
        return $arrData;
    }
}
?>