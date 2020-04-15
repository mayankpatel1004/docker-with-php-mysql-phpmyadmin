<?php
class Siteconfiguration {
    public function getList() {
        global $cf,$page_data,$url;     
        $arrParent = array();
        $arrChilds = array();

        $parent_sql = "SELECT * FROM `site_config_parent` WHERE deleted_status = 'N' ORDER BY display_order ASC";
        $arrParentData = $cf->getData($parent_sql);
        if(isset($arrParentData) && !empty($arrParentData)) {
            foreach($arrParentData as $parent){
                //$arrParent[$parent['site_config_parent_id']] = 
                $child_sql = "SELECT * FROM `site_config` WHERE site_config_parent_id = '".$parent['site_config_parent_id']."' AND deleted_status = 'N' ORDER BY display_order ASC";
                $arrChildData = $cf->getData($child_sql);
                if(isset($arrChildData) && !empty($arrChildData)) {
                    foreach($arrChildData as $child) {
                        $arrChilds[$parent['site_config_parent_id']][] = $child;
                    }
                }
            }
        }
        return array(
            'arrParentData' => $arrParentData,
            'arrChildData' => $arrChilds,
        );
    }
}
?>