<?php
class Allusers {
    public function getList() {
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path;
        $page_no = 1;
        $start = 0;
        $item_alias = "allusers";
        $item_type = "users";
        $search_text = "";
        $sort_by = "id";
        $sort_type = "DESC";
        $page_url = "";
        $records_per_page = $back_end_rpp;
        $search_string = "";
        $columns_list = "id,first_name,last_name,email,display_status,created_at";
        $token = "";
        $success = 1;
        $error = 0;
        $status = 200;
        $message = "";

        if(isset($_REQUEST['item_alias']) && $_REQUEST['item_alias'] != ''){
            $item_alias = $_REQUEST['item_alias'];
        }
        if(isset($_REQUEST['item_type']) && $_REQUEST['item_type'] != ''){
            $item_type = $_REQUEST['item_type'];
        }
        
        if(isset($_REQUEST['records_per_page']) && $_REQUEST['records_per_page'] > 0){
            $records_per_page = $_REQUEST['records_per_page'];
            $_SESSION[$back_session_name][$item_alias]['records_per_page'] = $records_per_page;
        }
        if(isset($_REQUEST['page_no']) && $_REQUEST['page_no'] > 0){
            $page_no = $_REQUEST['page_no'];
            $_SESSION[$back_session_name][$item_alias]['page_no'] = $page_no;
        }
        $start = ($page_no - 1) * $records_per_page;
        
        if(isset($_REQUEST['search_text']) && $_REQUEST['search_text'] != ''){
            $search_text = $_REQUEST['search_text'];
            $search_string = " AND (u.first_name LIKE '%" . addslashes($search_text) . "%' OR u.email LIKE '%" . addslashes($search_text) . "%' OR r.role_title LIKE '%" . addslashes($search_text) . "%') ";
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

        $sql = "SELECT u.*,r.role_title FROM `users` u LEFT JOIN role r on r.role_id = u.role_id WHERE u.item_type = '$item_type' $search_string AND u.deleted_status = 'N' ORDER BY $sort_by $sort_type LIMIT $start,$records_per_page";
        //echo $sql;exit;
        $arrData = $cf->getData($sql);

        $sqlCount = "SELECT u.*,r.role_title FROM `users` u LEFT JOIN role r on r.role_id = u.role_id WHERE u.item_type = '$item_type' $search_string AND u.deleted_status = 'N'";
        $arrDataCount = $cf->getData($sqlCount);
        $totalData = count($arrDataCount);
        
        $string = "";
        if(isset($arrData) && !empty($arrData)){
            foreach($arrData as $data) {
                //$edit_url = $url.$item_alias."/form/?id=".$data['id'];
                $edit_url = $url."allusers/form/?id=".$data['id'];
                $display_status = '<label class="badge badge-danger">Inactive</label>';
                if($data['display_status'] == 'Y'){
                    $display_status = '<label class="badge badge-success">Active</label>';
                }

                if($data['role_id'] == '1' || $data['role_id'] == '2'){
                    $role_class = "badge badge-light";
                }
                else if($data['role_id'] == '3'){
                    $role_class = "badge badge-info";
                }
                else {
                    $role_class = "badge badge-primary";
                }

                $string .= '<tr>
                <td><input type="checkbox" name="chk[]" value="'.$data['id'].'" class="form-control chkbox checkbox"></td>
                <td><a href="'.$edit_url.'">'.$data['first_name'].'</a></td>';
                $string .='
                <td>'.$data['last_name'].'</td>
                <td>'.$data['email'].'</td>
                <td><span class="'.$role_class.'">'.$data['role_title'].'</span></td>
                <td>'.$display_status.'</td>
                <td>'.date(DATE_FORMAT,strtotime($data['created_at'])).'</td>
                <td>'.$data['id'].'</td>
              </tr>';
            }
        }else {
            $string .= '<tr><td colspan="10" class="text-center">Sorry, No record available</td></tr>';
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
        echo json_encode($arrData);exit;
    }

    public function getOnedata($id) {
        global $cf,$page_data,$url;
        if($id > 0){
            $sql = "SELECT * FROM `users` WHERE id = '$id'";
            return $cf->getOneData($sql);
        }
    }

    public function checkEmailaddressExists($email) {
        $response = "";
        global $cf,$page_data,$url;
        $sql = "SELECT count(*) as total FROM `users` WHERE email = '$email'";
        $arrData = $cf->getOneData($sql);
        if(isset($arrData['total']) && $arrData['total'] > 0) {
            $response = "Already Exists";
        }
        return $response;
    }
}
?>