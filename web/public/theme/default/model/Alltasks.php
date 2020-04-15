<?php
class Alltasks {

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
        $item_alias = "alltasks";
        $search_string = "";
        $item_type = "tasks";
        $search_text = "";
        $sort_by = "task_id";
        $sort_type = "DESC";
        $page_url = "";
        $projectid = "";
        $assigneeid = "";
        $task_status = "";
        $token = "";
        $success = 1;
        $error = 0;
        $status = 200;
        $message = "";
        
        $search_string .= " AND task_status != 'Done' ";
        $records_per_page = $back_end_rpp;
        
        $columns_list = "id,task_name,task_status,created_at,updated_at";
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

        if(isset($_REQUEST['task_status']) && $_REQUEST['task_status'] != ''){
            $task_status = $_REQUEST['task_status'];
            $_SESSION[$back_session_name][$item_alias]['task_status'] = $task_status;
            $search_string .= " AND  task_status = '".$task_status."' ";
        }

        if(isset($_REQUEST['page_no']) && $_REQUEST['page_no'] > 0){
            $page_no = $_REQUEST['page_no'];
            $_SESSION[$back_session_name][$item_alias]['page_no'] = $page_no;
        }

        if(isset($_REQUEST['assigneeid']) && $_REQUEST['assigneeid'] > 0){
            $assigneeid = $_REQUEST['assigneeid'];
            $_SESSION[$back_session_name][$item_alias]['assigneeid'] = $assigneeid;
            $search_string .= " AND  assign_to = '".$assigneeid."' ";
        }

        if(isset($_REQUEST['projectid']) && $_REQUEST['projectid'] > 0){
            $projectid = $_REQUEST['projectid'];
            $_SESSION[$back_session_name][$item_alias]['projectid'] = $projectid;
            $search_string .= " AND  project_id = '".$projectid."' ";
        }

        if(isset($_SESSION[$back_session_name]['role_id']) && $_SESSION[$back_session_name]['role_id'] == 4){
            $arrProjects = explode(",",$_SESSION[$back_session_name]['projects']);
            //print_r($arrProjects);exit;
            $project_string = "";
            if(isset($arrProjects) && count($arrProjects) > 0) {
                foreach($arrProjects as $project){
                    $project_string .= "'".$project."',";
                }
                $project_string = substr($project_string, 0, -1);
            }
            $search_string .= " AND  project_id IN (".$project_string.") ";
        }
        
        $start = ($page_no - 1) * $records_per_page;

        if(isset($_REQUEST['search_text']) && $_REQUEST['search_text'] != ''){
            $search_text = $_REQUEST['search_text'];
            $search_string .= " AND (CONCAT_WS(t.task_name,t.task_description,t.task_status,t.task_priority,iss.section_title) LIKE'%" . addslashes($search_text) . "%') ";
            $_SESSION[$back_session_name][$item_alias]['search_text'] = $search_text;
        }
        if(isset($_REQUEST['sort_type']) && $_REQUEST['sort_type'] != ''){
            $sort_type = $_REQUEST['sort_type'];
        }
        if(isset($_REQUEST['sort_by']) && $_REQUEST['sort_by'] != ''){
            $sort_by = $_REQUEST['sort_by'];
            $newstring = substr($_REQUEST['sort_by'], -4);
            $sort_by = str_replace("__desc","",$_REQUEST['sort_by']);
            if($newstring == '_asc'){
                $sort_by = str_replace("__asc","",$_REQUEST['sort_by']);
            }
        }
        if(isset($_REQUEST['url']) && $_REQUEST['url'] != ''){
            $page_url = $_REQUEST['url'].'/';
        }
        
        if($sort_by != '' && $sort_type != ''){
            $_SESSION[$back_session_name][$item_alias]['sort_by'] = $sort_by."__".$sort_type;
        }

        $sqlUsers = "SELECT first_name,last_name,id as user_id FROM users WHERE role_id = '3' AND display_status = 'Y' AND deleted_status = 'N'";
        $arrUsersData = $cf->getData($sqlUsers);
        //print_r($arrUsersData);exit;

        $sql = "SELECT t.*,CONCAT(u.first_name,' ',u.last_name) as assigned_to,iss.section_title as project_name FROM task as t LEFT JOIN users as u ON u.id = t.assign_to LEFT JOIN item_section iss ON t.project_id = iss.item_section_id WHERE 1=1 $search_string AND t.deleted_status = 'N' ORDER BY $sort_by $sort_type LIMIT $start,$records_per_page";
        //echo $sql;exit;
        $arrData = $cf->getData($sql);
        
        $sqlCount = "SELECT t.*,CONCAT(u.first_name,' ',u.last_name) as assigned_to,iss.section_title as project_name FROM task as t LEFT JOIN users as u ON u.id = t.assign_to LEFT JOIN item_section iss ON t.project_id = iss.item_section_id WHERE 1=1 $search_string AND t.deleted_status = 'N'";
        $arrDataCount = $cf->getData($sqlCount);
        $totalData = count($arrDataCount);
        
        $string = "";
        if(isset($arrData) && !empty($arrData)){
            foreach($arrData as $data) {
                $edit_url = $url.$item_alias."/form/?id=".$data['task_id'];
                $view_url = $url.$item_alias."/view/?id=".$data['task_id'];

                $display_status = 'badge badge-success';
                if($data['task_status'] == 'To Do'){
                    $display_status = 'badge badge-dark';
                } else if($data['task_status'] == 'In Progress'){
                    $display_status = 'badge badge-primary';
                } else if($data['task_status'] == 'Hold'){
                    $display_status = 'badge badge-warning';
                } else if($data['task_status'] == 'QA Review'){
                    $display_status = 'badge badge-info';
                } else if($data['task_status'] == 'Done'){
                    $display_status = 'badge badge-success';
                } else if($data['task_status'] == 'Cancelled'){
                    $display_status = 'badge badge-secondary';
                } else if($data['task_status'] == 'Not Possible'){
                    $display_status = 'badge badge-danger';
                } else if($data['task_status'] == 'Bug'){
                    $display_status = 'badge badge-danger';
                } else if($data['task_status'] == 'Client Review'){
                    $display_status = 'badge badge-success';
                }


                $priority = '';
                // if($data['task_priority'] == 'Normal'){
                //     $priority = 'badge badge-info';
                // } else if($data['task_priority'] == 'Higher'){
                //     $priority = 'badge badge-warning';
                // } else if($data['task_priority'] == 'Trival'){
                //     $priority = 'badge badge-success';
                // } else if($data['task_priority'] == 'Blocker'){
                //     $priority = 'badge badge-danger';
                // }

                $arrPriority = array('' => 'Select Option','Normal' => 'Normal','Higher' => 'Higher','Trival' => 'Trival','Blocker' => 'Blocker');
                $arrTaskstatus = array('' => 'Select Option','To Do' => 'To Do','In Progress' => 'In Progress','Hold' => 'Hold','QA Review' => 'QA Review','Cancelled' => 'Cancelled','Bug' => 'Bug','Client Review' => 'Client Review','Not Possible' => 'Not Possible','Done' => 'Done');

                $taskname = $data['task_name'];
                $string .= '<tr>
                <td><input type="checkbox" name="chk[]" value="'.$data['task_id'].'" class="form-control chkbox checkbox"></td>
                <td><a href="'.$edit_url.'">'.$taskname.'</a></td>
                <td>'.$data['project_name'].'</td>';
                $string .='
                <td><label class="'.$priority.'">
                <select name="task_priority" class="form-control" id="task_priority" onChange=fnUpdateStatus(this.value,'.$data['task_id'].',"'.base64_encode($taskname).'",'.$data['assign_to'].')>';
                foreach($arrPriority as $key => $value){
                    $selected = "";
                    if($data['task_priority'] == $key){
                        $selected = "selected='selected'";
                    }
                    $string .= '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
                }
                $string .='
                </select></label></td>';
                if(isset($arrUsersData) && count($arrUsersData) > 0){   
                    $option = "";
                    foreach($arrUsersData as $users){
                        $selected = "";
                        if($users['user_id'] == $data['assign_to']){
                            $selected = "selected='selected'";
                        }
                        $option .= '<option value="'.$users['user_id'].'" '.$selected.'>'.$users['first_name'].' '.$users['last_name'].'</option>';
                    }
                }

                if(isset($arrTaskstatus) && count($arrTaskstatus) > 0) {
                    $optionStatus = "";
                    foreach($arrTaskstatus as $key => $value){
                        $selected = "";
                        if($data['task_status'] == $key){
                            $selected = "selected='selected'";
                        }
                        $optionStatus .= '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
                    }   
                }

                $string .= '<td><select name="task_status" class="form-control" id="task_status" onChange=fnUpdateTaskStatus(this.value,'.$data['task_id'].',"'.base64_encode($taskname).'")>';
                $string .= $optionStatus;
                $string .='</select></td>';
                $string .='<td><select name="assign_to" class="form-control" onChange=fnUpdateAssignee(this.value,'.$data['task_id'].',"'.base64_encode($taskname).'")>'.$option.'</select></td>
                <td>'.date(DATE_FORMAT,strtotime($data['created_at'])).'</td>
                <td><a href="'.$view_url.'">Add Timecard</a></td>
                <td>'.$data['task_id'].'</td>
              </tr>';
            }
            $string .= '<tr><td colspan="12" align="right">Showing '.($start+1).' to '.($records_per_page * $page_no).' .Total Records '.count($arrDataCount).'</td></tr>';
        }else {
            $string .= '<tr><td colspan="12" class="text-center">Sorry, No record available</td></tr>';
        }

        $pagination = $cf->getPagination($records_per_page,$page_no,$page_url,$totalData,$item_alias);
        $string .= '<tr><td colspan="10" class="text-right">'.$pagination.'</td></tr>';
        

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
            $sql = "SELECT * FROM `task` WHERE task_id = '$id'";
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

    public function deleteTimecard($timecard_id,$action,$task_name,$device) {
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
            `task_id` = '$timecard_id',
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
        if(isset($device) && $device == 'Nonweb') {
            $response = array("success" => 1,"error" => 0,'message' => "Record successfully deleted",'values' => array());
            echo json_encode($response);exit;
        }
    }

    public function getAlltimecard($task_id) {
        global $cf,$page_data,$url,$back_session_name;
        $arrData = array();
        $role_id = 0;
        $user_id = 0;
        if(isset($_SESSION[$back_session_name]['role_id']) && $_SESSION[$back_session_name]['role_id'] > 0){
            $role_id = $_SESSION[$back_session_name]['role_id'];
            $user_id = $_SESSION[$back_session_name]['user_id'];
        }
        if($task_id > 0){
            if($role_id > 2) {
                $sql = "SELECT * FROM `timecard` WHERE task_id = '$task_id' AND user_id = '$user_id' AND deleted_status = 'N' ORDER BY timecard_id DESC";
            } else {
                $sql = "SELECT * FROM `timecard` WHERE task_id = '$task_id' AND deleted_status = 'N' ORDER BY timecard_id DESC";
            }
            $arrData = $cf->getData($sql);
        }
        return $arrData;
    }

    public function getAlltaskcomments($task_id) {
        global $cf,$page_data,$url,$back_session_name;
        $arrData = array();
        $role_id = 0;
        $user_id = 0;
        if(isset($_SESSION[$back_session_name]['role_id']) && $_SESSION[$back_session_name]['role_id'] > 0){
            $role_id = $_SESSION[$back_session_name]['role_id'];
            $user_id = $_SESSION[$back_session_name]['user_id'];
        }
        if($task_id > 0){
            if($role_id > 2) {
                $sql = "SELECT * FROM `task_comments` WHERE task_id = '$task_id' AND commented_by = '$user_id' AND deleted_status = 'N' ORDER BY task_comment_id DESC";
            } else {
                $sql = "SELECT * FROM `task_comments` WHERE task_id = '$task_id' AND deleted_status = 'N' ORDER BY task_comment_id DESC";
            }
            //echo $sql;
            $arrData = $cf->getData($sql);
        }
        return $arrData;
    }

    public function deleteTaskcomment($task_comment_id,$action,$task_name,$device = '') {
        global $cf,$page_data,$url,$theme_path,$conn;
        $table_name = "task_comments";
        $action = "TaskComment Deleted";
        require_once($theme_path.'controller/convertApiDataToRequest.php');
        if($task_comment_id > 0){
            $sql = "UPDATE $table_name SET `deleted_status` = 'Y' WHERE task_comment_id = '$task_comment_id'";
            try {
                $stmt = $conn->prepare($sql); 
                $stmt->execute();
            } catch (PDOException $ex) {
                include $theme_path.'controller/logError.php';
            }

            $activity = "INSERT INTO `activity` SET
            `action` = '$action',
            `status_action` = 'Active',
            `table_name` = '$table_name',
            `record_id` = '$task_comment_id',
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
            `task_id` = '$task_comment_id',
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

        if(isset($device) && $device == 'Nonweb') {
            $response = array("success" => 1,"error" => 0,'message' => "Comment successfully deleted",'values' => array());
            echo json_encode($response);exit;
        }
    }

}
?>