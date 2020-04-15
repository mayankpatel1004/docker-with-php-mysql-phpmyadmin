<?php
class Allinventories {
    public function getList() {
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path;
        $page_no = 1;
        $start = 0;
        $item_alias = "allinventories";
        $item_type = "inventory";
        $search_text = "";
        $sort_by = "inventory_id";
        $sort_type = "DESC";
        $page_url = "";
        $records_per_page = $back_end_rpp;
        $search_string = "";
        $columns_list = "item_title,total_item,item_price,item_unit,is_partial,display_status,created_at,updated_at,inventory_id";
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
            $search_string = " AND (`item_title` LIKE '%" . addslashes($search_text) . "%') ";
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
            unset($_SESSION[$back_session_name][$item_alias]['sort_by']);
            $_SESSION[$back_session_name][$item_alias]['sort_by'] = $sort_by."__".$sort_type;
        }

        $sql = "SELECT * FROM `inv_inventories` WHERE 1=1 $search_string AND deleted_status = 'N' ORDER BY $sort_by $sort_type LIMIT $start,$records_per_page";
        //echo $sql;exit;
        $arrData = $cf->getData($sql);

        $sqlCount = "SELECT * FROM `inv_inventories` WHERE 1=1 $search_string AND deleted_status = 'N'";
        $arrDataCount = $cf->getData($sqlCount);
        $totalData = count($arrDataCount);
        //print_r($arrData);exit;
        $string = "";
        if(isset($arrData) && !empty($arrData)){
            foreach($arrData as $data) {
                $edit_url = $url.$item_alias."/form/?id=".$data['inventory_id'];
                $display_status = '<label class="badge badge-danger">Inactive</label>';
                if($data['display_status'] == 'Y'){
                    $display_status = '<label class="badge badge-success">Active</label>';
                }

                $partial_status = $data['is_partial'] == 'Y' ? 'Yes' : 'No';
                $consumable_status = $data['is_consumable'] == 'Y' ? 'Yes' : 'No';
                
                

                $string .= '<tr>
                <td><input type="checkbox" name="chk[]" value="'.$data['inventory_id'].'" class="form-control chkbox checkbox"></td>
                <td><a href="'.$edit_url.'">'.$data['item_title'].'</a></td>';
                $string .='
                <td>'.$data['total_item'].'</td>
                <td>'.$data['item_unit'].'</td>
                <td>'.$data['item_price'].'</td>
                <td>'.$partial_status.'</td>
                <td>'.$data['gst_number'].'</td>
                <td>'.$data['po_number'].'</td>
                <td>'.$consumable_status.'</td>';

                if($data['bill_picture'] == ''){
                    $string .= '<td class="text-center">-</td>';
                } else {
                    $string .= '<td class="text-center"><a  class="text-center" href='.ITEMS_URL.$data['bill_picture'].' target="_blank">View</a></td>';
                }

                if($data['attachment'] == ''){
                    $string .= '<td class="text-center">-</td>';
                } else {
                    $string .= '<td class="text-center"><a  class="text-center" href='.ITEMS_URL.$data['attachment'].' target="_blank">View</a></td>';
                }
                
                $string .= '<td>'.$display_status.'</td>
                <td>'.date(DATE_FORMAT,strtotime($data['updated_at'])).'</td>
              </tr>';
            }
        }else {
            $string .= '<tr><td colspan="13" class="text-center">Sorry, No record available</td></tr>';
        }

        $pagination = $cf->getPagination($records_per_page,$page_no,$page_url,$totalData,$item_type);
        $string .= '<tr><td colspan="13" class="text-right">'.$pagination.'</td></tr>';
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

    public function getDispatchList() {
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path;
        $page_no = 1;
        $start = 0;
        $item_alias = "alldispatches";
        $item_type = "dispatches";
        $search_text = "";
        $sort_by = "dispatched_id";
        $sort_type = "DESC";
        $page_url = "";
        $records_per_page = $back_end_rpp;
        $search_string = "";
        $columns_list = "inventory_id,total_dispatch,partial_dispatch,unit,display_status,created_at,updated_at,dispatched_id";
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
            $search_string = " AND (i.item_title LIKE '%" . addslashes($search_text) . "%') ";
            $_SESSION[$back_session_name][$item_alias]['search_text'] = $search_text;
        }
        if(isset($_REQUEST['sort_type']) && $_REQUEST['sort_type'] != ''){
            $sort_type = $_REQUEST['sort_type'];
        }
        // if(isset($_REQUEST['sort_by']) && $_REQUEST['sort_by'] != ''){
        //     $sort_by = $_REQUEST['sort_by'];
        //     $newstring = substr($_REQUEST['sort_by'], -4);
        //     $sort_by = str_replace("__desc","",$_REQUEST['sort_by']);
        //     if($newstring == '_asc'){
        //         $sort_by = str_replace("__asc","",$_REQUEST['sort_by']);
        //     }
        // }
        if(isset($_REQUEST['url']) && $_REQUEST['url'] != ''){
            $page_url = $_REQUEST['url'].'/';
        }

        if($sort_by != '' && $sort_type != ''){
            unset($_SESSION[$back_session_name][$item_alias]['sort_by']);
            $_SESSION[$back_session_name][$item_alias]['sort_by'] = $sort_by."__".$sort_type;
        }

        $sql = "SELECT d.*,i.item_title FROM `inv_dispatched` d LEFT JOIN `inv_inventories` i ON i.inventory_id = d.inventory_id WHERE 1=1 $search_string AND d.deleted_status = 'N' ORDER BY $sort_by $sort_type LIMIT $start,$records_per_page";
        //echo $sql;exit;
        $arrData = $cf->getData($sql);

        $sqlCount = "SELECT d.*,i.item_title FROM `inv_dispatched` d LEFT JOIN `inv_inventories` i ON i.inventory_id = d.inventory_id $search_string AND d.deleted_status = 'N'";
        $arrDataCount = $cf->getData($sqlCount);
        $totalData = count($arrDataCount);
        //print_r($arrData);exit;
        $string = "";
        if(isset($arrData) && !empty($arrData)){
            foreach($arrData as $data) {
                $edit_url = $url.$item_alias."/form/?id=".$data['dispatched_id'];
                $display_status = '<label class="badge badge-danger">Inactive</label>';
                if($data['display_status'] == 'Y'){
                    $display_status = '<label class="badge badge-success">Active</label>';
                }
                $string .= '<tr>
                <td><input type="checkbox" name="chk[]" value="'.$data['dispatched_id'].'" class="form-control chkbox checkbox"></td>
                <td><a href="'.$edit_url.'">'.$data['item_title'].'</a></td>';
                $string .='
                <td>'.$data['total_dispatch'].'</td>
                <td>'.$data['partial_dispatch'].'</td>
                <td>'.$data['unit'].'</td>
                <td>'.$display_status.'</td>
                <td>'.date(DATE_FORMAT,strtotime($data['created_at'])).'</td>
                <td>'.date(DATE_FORMAT,strtotime($data['updated_at'])).'</td>
                <td>'.$data['dispatched_id'].'</td>
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
            $sql = "SELECT * FROM `inv_inventories` WHERE inventory_id = '$id'";
            return $cf->getOneData($sql);
        }
    }

    public function getListActivities() {
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path;
        $page_no = 1;
        $start = 0;
        $item_alias = "inventoryactivities";
        $item_type = "inventoryactivities";
        $search_text = "";
        $sort_by = "inventories_activities_id";
        $sort_type = "DESC";
        $page_url = "";
        $records_per_page = $back_end_rpp;
        $search_string = "";
        $columns_list = "item_title,operation,item_price,total_items,item_size,is_partial,item_unit,attachment,po_number,bill_picture,description,created_by_name,created_at";
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
            $search_string = " AND (`item_title` LIKE '%" . addslashes($search_text) . "%') ";
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
            unset($_SESSION[$back_session_name][$item_alias]['sort_by']);
            $_SESSION[$back_session_name][$item_alias]['sort_by'] = $sort_by."__".$sort_type;
        }

        $sql = "SELECT * FROM `inv_inventories_activities` WHERE 1=1 $search_string ORDER BY $sort_by $sort_type LIMIT $start,$records_per_page";
        //echo $sql;exit;
        $arrData = $cf->getData($sql);

        $sqlCount = "SELECT * FROM `inv_inventories_activities` WHERE 1=1 $search_string";
        $arrDataCount = $cf->getData($sqlCount);
        $totalData = count($arrDataCount);
        //print_r($arrData);exit;
        $string = "";
        if(isset($arrData) && !empty($arrData)){
            foreach($arrData as $data) {


                $edit_url = $url.$item_alias."/form/?id=".$data['inventory_id'];
                $display_status = '<label class="badge badge-danger">Inactive</label>';
                if($data['display_status'] == 'Y'){
                    $display_status = '<label class="badge badge-success">Active</label>';
                }

                $partial_status = $data['is_partial'] == 'Y' ? 'Yes' : 'No';
                $consumable_status = $data['is_consumable'] == 'Y' ? 'Yes' : 'No';
                $item_size = $data['total_item_size'] > 0 ? $data['total_item_size'] : $data['item_size'];
                
                $string .= '<tr>
                <td><input type="checkbox" name="chk[]" value="'.$data['inventory_id'].'" class="form-control chkbox checkbox"></td>
                <td>'.$data['item_title'].'</td>';
                $string .='
                <td>'.$data['operation'].'</td>
                <td>'.$data['item_price'].'</td>
                <td>'.$data['total_items'].'</td>
                <td>'.$item_size.'</td>
                <td>'.$data['item_unit'].'</td>
                <td>'.$partial_status.'</td>';

                if($data['attachment'] == ''){
                    $string .= '<td class="text-center">-</td>';
                } else {
                    $string .= '<td class="text-center"><a  class="text-center" href='.ITEMS_URL.$data['attachment'].' target="_blank">View</a></td>';
                }

                $string .= '
                <td>'.$data['po_number'].'</td>
                ';

                if($data['bill_picture'] == ''){
                    $string .= '<td class="text-center">-</td>';
                } else {
                    $string .= '<td class="text-center"><a  class="text-center" href='.ITEMS_URL.$data['bill_picture'].' target="_blank">View</a></td>';
                }

                $string .= '<td>'.$data['description'].'</td>
                <td>'.$data['created_by_name'].'</td>
                <td>'.date(DATE_FORMAT,strtotime($data['created_at'])).'</td>
              </tr>';
            }
        }else {
            $string .= '<tr><td colspan="14" class="text-center">Sorry, No record available</td></tr>';
        }

        $pagination = $cf->getPagination($records_per_page,$page_no,$page_url,$totalData,$item_type);
        $string .= '<tr><td colspan="14" class="text-right">'.$pagination.'</td></tr>';
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


    public function getDispatchReturnList() {
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path;
        $page_no = 1;
        $start = 0;
        $item_alias = "allreturnitems";
        $item_type = "inventory";
        $search_text = "";
        $sort_by = "dispatched_id";
        $sort_type = "DESC";
        $page_url = "";
        $records_per_page = $back_end_rpp;
        $search_string = "";
        $columns_list = "dispatched_id,inventory_id,item_size,total_items,is_partial,item_unit,taken_by_name,created_by_name";
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
            $search_string = " AND (`d.taken_by_name` LIKE '%" . addslashes($search_text) . "%') ";
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
            unset($_SESSION[$back_session_name][$item_alias]['sort_by']);
            $_SESSION[$back_session_name][$item_alias]['sort_by'] = $sort_by."__".$sort_type;
        }

        $sql = "SELECT d.*,i.item_title FROM `inv_dispatched` as d LEFT JOIN `inv_inventories` i ON i.inventory_id = d.inventory_id WHERE 1=1 $search_string AND d.deleted_status = 'N' ORDER BY $sort_by $sort_type LIMIT $start,$records_per_page";
        //echo $sql;exit;
        $arrData = $cf->getData($sql);

        $sqlCount = "SELECT d.*,i.item_title FROM `inv_dispatched` as d LEFT JOIN `inv_inventories` i ON i.inventory_id = d.inventory_id WHERE 1=1 $search_string AND d.deleted_status = 'N'";
        $arrDataCount = $cf->getData($sqlCount);
        $totalData = count($arrDataCount);
        //print_r($arrData);exit;
        $string = "";
        if(isset($arrData) && !empty($arrData)){
            foreach($arrData as $data) {
                $edit_url = $url.$item_alias."/form/?id=".$data['dispatched_id'];
                $partial_status = $data['is_partial'] == 'Y' ? 'Yes' : 'No';
                $string .= '<tr>
                <td><input type="checkbox" name="chk[]" value="'.$data['dispatched_id'].'" class="form-control chkbox checkbox"></td>
                <td><a href="'.$edit_url.'">'.$data['item_title'].'</a></td>';

                if($partial_status == 'N') {
                    $string .= '<td><select name="total_size" class="form-control" onChange="return updateDispatch(this.value,'.$data['dispatched_id'].','.$data['inventory_id'].',\'total_items\')">';
                    $string .= '<option value="">Size</option>';
                    for($i=1;$i<=$data['total_items'];$i++){
                        $string .= '<option value="'.$i.'">'.$i.'</option>';
                    }
                    $string .= '</select></td>';
                } else {
                    $string .='<td>'.$data['total_items'].'</td>';
                }
                
                if($data['item_size'] > 0){
                    $string .= '<td><select name="total_size" class="form-control" onChange="return updateDispatch(this.value,'.$data['dispatched_id'].','.$data['inventory_id'].',\'item_size\')">';
                    $string .= '<option value="">Size</option>';
                    for($i=1;$i<=$data['item_size'];$i++){
                        $string .= '<option value="'.$i.'">'.$i.'</option>';
                    }
                    $string .= '</select></td>';
                } else {
                    $string .='<td>'.$data['item_size'].'</td>';
                }
                
                $string .='<td>'.$data['item_unit'].'</td>
                <td>'.$partial_status.'</td>
                <td>'.$data['taken_by_name'].'</td>
                <td>'.$data['created_by_name'].'</td>
                <td>'.date(DATE_FORMAT,strtotime($data['updated_at'])).'</td>
              </tr>';
            }
        }else {
            $string .= '<tr><td colspan="13" class="text-center">Sorry, No record available</td></tr>';
        }

        $pagination = $cf->getPagination($records_per_page,$page_no,$page_url,$totalData,$item_type);
        $string .= '<tr><td colspan="13" class="text-right">'.$pagination.'</td></tr>';
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