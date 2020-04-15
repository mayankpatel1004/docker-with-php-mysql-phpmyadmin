<?php
class Allitems {
    public function getList() {
        //print_r($_REQUEST);exit;
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path;
        $page_no = 1;
        $start = 0;
        $item_alias = "pages";
        $item_type = "pages";
        $search_text = "";
        $sort_by = "item_id";
        $sort_type = "DESC";
        $page_url = "";
        $records_per_page = $back_end_rpp;
        $search_string = "";
        $role_id = 0;
        $token = "";
        $success = 1;
        $error = 0;
        $status = 200;
        $message = "";

        $columns_list = "id,item_title,item_alias,display_order,display_status,created_at,updated_at";
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
            $search_string .= " AND (CONCAT_WS(`item_title`,`item_alias`,`item_description`,`item_shortdescription`) LIKE'%" . addslashes($search_text) . "%') ";
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

        if(isset($_SESSION[$back_session_name]['role_id']) && $_SESSION[$back_session_name]['role_id'] > 2){
            $search_string .= " AND user_id = '".$_SESSION[$back_session_name]['user_id']."'";
        }

        $sql = "SELECT * FROM `items` WHERE `item_type` = '$item_type' $search_string AND admin_module = 'N' AND `deleted_status` = 'N' ORDER BY $sort_by $sort_type LIMIT $start,$records_per_page";
        //echo $sql;
        $arrData = $cf->getData($sql);
        
        $sqlCount = "SELECT * FROM `items` WHERE `item_type` = '$item_type' $search_string AND admin_module = 'N' AND `deleted_status` = 'N'";
        $arrDataCount = $cf->getData($sqlCount);
        $totalData = count($arrDataCount);
        
        $string = "";
        if(isset($arrData) && !empty($arrData)){
            foreach($arrData as $data) {
                $iconcolor = "green";
                $href_title = "";
                $edit_url = $url.$item_alias."/form/?id=".$data['item_id'];
                $display_status = '<label class="badge badge-danger">Inactive</label>';
                if($data['display_status'] == 'Y'){
                    $display_status = '<label class="badge badge-success">Active</label>';
                }

                if($data['meta_title_length'] > 60) {
                    $iconcolor = "red";
                }
                $href_title = "Title Length = ".$data['meta_title_length']." , Desc Length = ".$data['meta_description_length']. ". Usually Title=70 Characters and Description should be 160 Characters";

                $string .= '<tr>
                <td><input type="checkbox" name="chk[]" value="'.$data['item_id'].'" class="form-control chkbox checkbox"></td>
                <td><a href="'.$edit_url.'" title="'.$href_title.'">'.$data['item_title'].'&nbsp;&nbsp;&nbsp;<span style="color:'.$iconcolor.'">*</span>'.'</a></td>';
                $string .='<td>'.$data['item_alias'].'</td>
                <td>'.$display_status.'</td>
                <td>'.date(DATE_FORMAT,strtotime($data['created_at'])).'</td>
                <td>'.date(DATE_FORMAT,strtotime($data['updated_at'])).'</td>
                <td>'.$data['item_id'].'</td>
              </tr>';
            }
            $string .= '<tr><td colspan="8" align="right">Showing '.($start+1).' to '.($records_per_page * $page_no).' .Total Records '.count($arrDataCount).'</td></tr>';
        } else {
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
        //print_r($arrData);exit;
        echo json_encode($arrData);exit;
    }

    public function getOnedata($id) {
        global $cf,$page_data,$url;
        if($id > 0){
            $sql = "SELECT * FROM `items` WHERE item_id = '$id'";
            return $cf->getOneData($sql);
        }
    }

    public function getAllgallerydata($id) {
        global $cf,$page_data,$url;
        if($id > 0){
            $sql = "SELECT * FROM `item_meta` WHERE item_id = '$id' AND display_status = 'Y' AND deleted_status = 'N'";
            return $cf->getData($sql);
        }
    }
}
?>