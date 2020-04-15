<?php
class Customeraccount {

    public function getDashboardDetails() {
        
    }

    public function getList() {
        //print_r($_REQUEST);exit;
        global $cf,$page_data,$url,$back_end_rpp,$back_session_name,$theme_path,$front_session_name;
        $page_no = 1;
        $start = 0;
        $item_alias = "pages";
        $item_type = "blogs";
        $search_text = "";
        $sort_by = "item_id";
        $sort_type = "DESC";
        $page_url = "";
        $records_per_page = $back_end_rpp;
        $customer_id = $_SESSION[$front_session_name]['customer_id'];
        $search_string = "";
        $search_string .= " AND `guest_item` = 'Y' AND `user_id` = '$customer_id'";
        $columns_list = "id,item_title,item_alias,display_order,display_status,created_at,updated_at";
        if(isset($page_data['item_alias']) && $page_data['item_alias'] != ''){
            $item_alias = $page_data['item_alias'];
        }
        
        if(isset($_REQUEST['records_per_page']) && $_REQUEST['records_per_page'] > 0){
            $records_per_page = $_REQUEST['records_per_page'];
        }
        if(isset($_REQUEST['page_no']) && $_REQUEST['page_no'] > 0){
            $page_no = $_REQUEST['page_no'];
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

        $sql = "SELECT * FROM `items` WHERE `item_type` = '$item_type' $search_string AND admin_module = 'N' AND `deleted_status` = 'N' ORDER BY $sort_by $sort_type LIMIT $start,$records_per_page";
        //echo $sql;exit;
        $arrData = $cf->getData($sql);

        $sqlCount = "SELECT * FROM `items` WHERE `item_type` = '$item_type' $search_string AND admin_module = 'N' AND `deleted_status` = 'N'";
        $arrDataCount = $cf->getData($sqlCount);
        $totalData = count($arrDataCount);
        
        $string = "";
        if(isset($arrData) && !empty($arrData)){
            foreach($arrData as $data) {
                $edit_url = $url.$item_alias."/form/?id=".$data['item_id'];
                $status = '<label class="badge badge-danger">Inactive</label>';
                if($data['display_status'] == 'Y'){
                    $status = '<label class="badge badge-success">Active</label>';
                }
                $string .= '<tr>
                <td><a href="'.$edit_url.'">'.$data['item_title'].'</a></td>';
                $string .='
                <td>'.$data['item_alias'].'</td>
                <td>'.$status.'</td>
                <td>'.date(DATE_FORMAT,strtotime($data['created_at'])).'</td>
                <td>'.date(DATE_FORMAT,strtotime($data['updated_at'])).'</td>
                <td>'.$data['item_id'].'</td>
              </tr>';
            }
            $string .= '<tr><td colspan="8" align="right">Showing '.$start.' to '.$records_per_page.' .Total Records '.count($arrDataCount).'</td></tr>';
        }else {
            $string .= '<tr><td colspan="10" class="text-center">Sorry, No record available</td></tr>';
        }

        $pagination = $cf->getPagination($records_per_page,$page_no,$page_url.'?page_no='.$page_no,$totalData,$item_alias);
        $string .= '<tr><td colspan="10" class="text-right">'.$pagination.'</td></tr>';
        

        if(isset($_REQUEST['device']) && $_REQUEST['device'] == 'Nonweb'){
            require_once($theme_path.'getRequestData.php');
            $arrData = array('data' => $arrData,'total_pages' => '10');
        }else {
            $arrData = array('data' => $string);
        }

        echo json_encode($arrData);exit;
    }
    
    public function getOnedata($id) {
        global $cf,$page_data,$url;
        if($id > 0){
            $sql = "SELECT * FROM `items` WHERE item_id = '$id'";
            return $cf->getOneData($sql);
        }
    }

    public function myorders($customer_id) {
        global $cf,$page_data,$url;
        $arrData = array();
        if($customer_id > 0){
            $sql = "SELECT * FROM `ec_order` WHERE customer_id = '$customer_id' ORDER BY order_id DESC LIMIT 0,20";
            $arrData = $cf->getData($sql);
        }
        return $arrData;
    }

    public function myinvoice($order_id) {
        global $cf,$page_data,$url;
        $primary_key = 0;
        $arrOrderData = array();
        $arrOrderProductData = array();
        if($order_id > 0){
            $sql = "SELECT * FROM `ec_order` WHERE order_id_unique = '$order_id'";
            $arrOrderData = $cf->getOneData($sql);
            if(isset($arrOrderData['order_id']) && $arrOrderData['order_id'] > 0) {
                $primary_key = $arrOrderData['order_id'];
            }

            $sqlOrderProducts = "SELECT * FROM `ec_order_products` WHERE order_id = '$primary_key'";
            $arrOrderProductData = $cf->getData($sqlOrderProducts);
        }
        return array(
            'arrOrderData' => $arrOrderData,
            'arrOrderProductData' => $arrOrderProductData
        );
    }
}
?>