<?php
class Allvisitors {
    public function getList() {
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path;
        $page_no = 1;
        $start = 0;
        $item_alias = "allvisitors";
        $item_type = "allvisitors";
        $search_text = "";
        $sort_by = "log_id";
        $sort_type = "DESC";
        $page_url = "";
        $records_per_page = $back_end_rpp;
        $search_string = "1=1";
        $columns_list = "log_id,title,ipaddress,country,region_name,city,platform,browsername";
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
            $search_string .= " AND (`title` LIKE '%" . addslashes($search_text) . "%' OR `country` LIKE '%" . addslashes($search_text) . "%') ";
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

        $sql = "SELECT * FROM `logs` WHERE $search_string ORDER BY $sort_by $sort_type LIMIT $start,$records_per_page";
        $arrData = $cf->getData($sql);

        $sqlCount = "SELECT * FROM `logs` WHERE $search_string ";
        $arrDataCount = $cf->getData($sqlCount);
        $totalData = count($arrDataCount);
        ///print_r($item_alias);
        $string = "";
        //$columns_list = "log_id,title,ipaddress,country,region_name,city,platform,browsername";
        if(isset($arrData) && !empty($arrData)){
            foreach($arrData as $data) {
                $edit_url = $url."allactivities/form/?id=".$data['log_id'];
                $string .= '<tr>
                <td>'.$data['log_id'].'</td>
                <td>'.$data['title'].'</td>
                <td>'.$data['ipaddress'].'</td>
                <td>'.$data['country'].'</td>
                <td>'.$data['region_name'].'</td>
                <td>'.$data['city'].'</td>
                <td>'.$data['platform'].'</td>
                <td>'.$data['browsername'].'</td>
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

}
?>