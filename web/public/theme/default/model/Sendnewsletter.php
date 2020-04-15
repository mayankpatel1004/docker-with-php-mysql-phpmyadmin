<?php
class Sendnewsletter {
    public function getList() {
        global $cf,$page_data,$url;     
        $arrParentData = array();
        $parent_sql = "SELECT DISTINCT(item_type) FROM `subscriber` ORDER BY display_order ASC";
        $arrParentData = $cf->getData($parent_sql);
        return $arrParentData;
    }

    public function getGroupEmail($group_name) {
        global $cf,$page_data,$url;     
        $arrParentData = array();
        $option_string = "";
        $parent_sql = "SELECT first_name,email_address,country,state,city,cellphone1 FROM `subscriber` WHERE item_type = '$group_name' ORDER BY display_order ASC";
        $arrParentData = $cf->getData($parent_sql);
        if(isset($arrParentData) && count($arrParentData) > 0) {
            $option_string .= "<option value=''>Select Option</option>";
            foreach($arrParentData as $data) {
                $string = "";
                if($data['country'] != "") {
                    $string = ' - '.$data['city'].' '.$data['state'].', '.$data['country']." ".$data['cellphone1'];
                }
                $option_string .= "<option value='".$data['email_address']."'>".$data['first_name'].' '.$data['email_address'].$string."</option>";
            }
        }
        echo $option_string;exit;
    }
}
?>