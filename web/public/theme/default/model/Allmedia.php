<?php
class Allmedia {
    public function getList() {
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path;
        $page_no = 1;
        $start = 0;
        $item_alias = "allmedia";
        $item_type = "default";
        $search_text = "";
        $sort_by = "media_id";
        $sort_type = "DESC";
        $page_url = "";
        $records_per_page = $back_end_rpp;
        $search_string = "";
        $columns_list = "media_id,name,display_status,created_at,updated_at";
        $token = "";
        $success = 1;
        $error = 0;
        $status = 200;
        $message = "";
        
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
        $start = ($page_no - 1) * $records_per_page;
        
        if(isset($_REQUEST['search_text']) && $_REQUEST['search_text'] != ''){
            $search_text = $_REQUEST['search_text'];
            $search_string = " AND (`name` LIKE '%" . addslashes($search_text) . "%') ";
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

        $sql = "SELECT * FROM `media` WHERE 1=1 $search_string AND deleted_status = 'N' ORDER BY $sort_by $sort_type LIMIT $start,$records_per_page";
        //echo $sql;exit;
        $arrData = $cf->getData($sql);

        $sqlCount = "SELECT * FROM `media` WHERE 1=1 $search_string AND deleted_status = 'N'";
        $arrDataCount = $cf->getData($sqlCount);
        $totalData = count($arrDataCount);
        
        $string = "";
        if(isset($arrData) && !empty($arrData)){
            foreach($arrData as $data) {
                $edit_url = $url.$item_alias."/form/?id=".$data['media_id'];
                $display_status = '<label class="badge badge-danger">Inactive</label>';
                if($data['display_status'] == 'Y'){
                    $display_status = '<label class="badge badge-success">Active</label>';
                }
                $string .= '<tr>
                <td><input type="checkbox" name="chk[]" value="'.$data['media_id'].'" class="form-control chkbox checkbox"></td>
                <td><a href="'.$edit_url.'">'.$data['name'].'</a></td>';
                $media_url = MEDIA_URL.$data['attachment'];
                $string .='
                <td><a target="_blank" href="'.$media_url.'">'.$data['attachment'].'</a></td>
                <td>'.$display_status.'</td>
                <td>'.date(DATE_FORMAT,strtotime($data['created_at'])).'</td>
                <td>'.date(DATE_FORMAT,strtotime($data['updated_at'])).'</td>
                <td>'.$data['media_id'].'</td>
              </tr>';
            }
        }else {
            $string .= '<tr><td colspan="10" class="text-center">Sorry, No record available</td></tr>';
        }

        $pagination = $cf->getPagination($records_per_page,$page_no,$page_url,$totalData,$item_type);
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
            $sql = "SELECT * FROM `media` WHERE media_id = '$id'";
            return $cf->getOneData($sql);
        }
    }
}
?>