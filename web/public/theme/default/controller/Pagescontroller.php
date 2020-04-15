<?php
require_once $theme_path.'model/Allitems.php';
class Pagescontroller {

    public $model;
    public function __construct(){
        $this->model = new Allitems();
    }

    public function index() {
        global $theme_path,$theme_url,$cf;
        require $theme_path.'views/pages.php';
    }
    public function blogList() {
        global $theme_path,$theme_url,$cf;
        require $theme_path.'views/blogs.php';
    }

    public function privacyPolicy() {
        global $theme_path,$theme_url,$cf;
        require $theme_path.'views/privacy-policy.php';
    }

    public function termsConditions() {
        global $theme_path,$theme_url,$cf;
        require $theme_path.'views/terms-conditions.php';
    }
    

    public function getData() {
        global $cf,$page_data,$url,$back_end_rpp,$front_session_name,$theme_path;
        //echo "<pre>";print_r($page_data);exit;
        //print_r($_REQUEST);exit;
        $page_no = 1;
        $start = 0;
        $item_alias = "blogs";
        $item_type = "blogs";
        $search_text = "";
        $sort_by = "item_id";
        $sort_type = "DESC";
        $page_url = $url."blogs/getData/?page_no=";
        $records_per_page = $back_end_rpp;
        $category = "";
        $category_value = '';
        $search_string = "";
        $total_pages = 1;
        $category_options_string = "<option value=''>Select Category</option>";

        $columns_list = "id,item_title,item_alias,display_order,display_status,created_at,updated_at";
        if(isset($page_data['item_alias']) && $page_data['item_alias'] != ''){
            $item_alias = $page_data['item_alias'];
        }
        if(isset($page_data['item_type']) && $page_data['item_type'] != ''){
            $item_type = $page_data['item_type'];
        }

        if(isset($_REQUEST['records_per_page']) && $_REQUEST['records_per_page'] > 0){
            $records_per_page = $_REQUEST['records_per_page'];
        }
        if(isset($_REQUEST['page_no']) && $_REQUEST['page_no'] > 0){
            $page_no = $_REQUEST['page_no'];
        }

        if(isset($_REQUEST['search_text']) && $_REQUEST['search_text'] != ''){
            $search_text = $_REQUEST['search_text'];
            $search_string = " AND (CONCAT_WS(`item_title`,`item_alias`,`item_description`,`item_shortdescription`) LIKE'%" . addslashes($search_text) . "%') ";
            $_SESSION[$front_session_name][$item_alias]['search_text'] = $search_text;
        }

        if(isset($_REQUEST['category']) && $_REQUEST['category'] != ''){
            $category_value = $_REQUEST['category'];
            $category = " AND `item_category` LIKE '%" . addslashes($category_value) . "%' ";
        }

        //if($page_no == 1) {
            $sqlOptions = "SELECT * FROM `item_section` WHERE `item_alias` = 'blog_category'";
            $arrOptionsData = $cf->getData($sqlOptions);
            if(isset($arrOptionsData) && $arrOptionsData != false) {
                
                foreach($arrOptionsData as $options){
                    $selected = '';
                    if($category_value == $options['section_alias']) {
                        $selected = "selected='selected'";
                    }
                    $category_options_string .= '<option value="'.$options['section_alias'].'" '.$selected.'>'.$options['section_title'].'</option>';
                }
            }
        //}

        $start = ($page_no - 1) * $records_per_page;
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
        
        if($sort_by != '' && $sort_type != ''){
            $_SESSION[$front_session_name][$item_alias]['sort_by'] = $sort_by."__".$sort_type;
        }

        $sql = "SELECT * FROM `items` WHERE `item_type` = '$item_type' $search_string $category AND admin_module = 'N' AND `deleted_status` = 'N' ORDER BY $sort_by $sort_type LIMIT $start,$records_per_page";
        //echo $sql;exit;
        $arrData = $cf->getData($sql);

        $sqlCount = "SELECT * FROM `items` WHERE `item_type` = '$item_type' $search_string $category AND admin_module = 'N' AND `deleted_status` = 'N'";
        $arrDataCount = $cf->getData($sqlCount);
        $totalData = count($arrDataCount);
        
        
        $string = "";
        if(isset($arrData) && !empty($arrData)){
            $string .= "<div class='row'>";
            foreach($arrData as $data) {
                $alias = $data['item_alias'];
                $description = substr(strip_tags($data['item_description']),0,400)."<br /><br /><a href='".$url.$alias."' class='btn btn-primary'>Read More</a>";
                $string .= '<div class="col-12 results '.$data['item_id'].'">
                <div class="pt-4 border-bottom">
                  <a class="d-block h4" href="'.$url.$data['item_alias'].'">'.$data['item_title'].'</a>
                  <p class="page-description mt-1 text-primary">By : Administrator on '.date('D F d, Y',strtotime($data['created_at'])).'</p>
                  <p class="page-description mt-1 text-muted">'.$description.'</p>
                  
                  <br />
                </div>
              </div>';
            }
            $string .= '</div>';
            $string .= '<br /><div class="row"><div class="col-md-8">Showing '.($start+1).' to '.($records_per_page * $page_no).' .Total Records '.count($arrDataCount).'</div><div class="col-md-4"><select name="pagination" id="pagination" class="form-control text-right"><option value="">Go to Page</option></select></div></div>';
        } else {
            $string .= '<div class="row"><div class="col-md-12 text-center">Sorry, No record available</div></div>';
        }

        //$pagination = $cf->getPagination($records_per_page,$page_no,$page_url,$totalData,'blogs');
        //$string .= '<tr><td colspan="10" class="text-right">'.$pagination.'</td></tr>';
        if(isset($totalData) && $totalData > 1 && (ceil($totalData / $records_per_page) > 1)) {
            $total_pages = ceil($totalData / $records_per_page);
        }

        
        if(isset($_REQUEST['device']) && $_REQUEST['device'] == 'Nonweb'){
            require_once($theme_path.'getRequestData.php');
            $arrData = array('data' => $arrData,'total_pages' => $total_pages,'categories' => $category_options_string,'page_no' => $page_no);
        } else {
            $arrData = array('data' => $string,'total_pages' => $total_pages,'categories' => $category_options_string,'page_no' => $page_no);
        }
        //echo "<pre>";print_r($arrData);exit;
        echo json_encode($arrData);exit;
    }
}
?>