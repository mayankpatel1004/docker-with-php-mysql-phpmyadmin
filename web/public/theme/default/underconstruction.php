<?php

if(isset($_REQUEST['uc']) && $_REQUEST['uc'] == "No") {
    $sql = "UPDATE `site_config` SET `config_value` = 'No' WHERE `site_config`.`config_name` = 'SITE_CONSTRUCTION'";
    $stmt = $conn->prepare($sql); 
    $stmt->execute();
    setConfigdata();
  }

  function setConfigdata() {
    global $back_session_name,$conn,$theme_path,$url,$cf;
    $sql = "SELECT * FROM `site_config` WHERE `display_status` = 'Y' AND `deleted_status` = 'N'";
    $arrData = $cf->getData($sql);
    
    $write = "";
    $write .= "<?php";
    $write .= "\r\n";
    foreach($arrData as $key=>$value) {
        $key = $value['config_name'];
        $value = $value['config_value'];
        $write .= "define('".$key."','".addslashes($value)."');";
        $write .="\r\n";
    }
    $write .= "?>";
    file_put_contents($theme_path."generated_files/configdata.php",$write);
  
    $sitemapType = "SELECT DISTINCT(item_type) FROM `items` WHERE admin_module = 'N' AND display_status = 'Y' AND deleted_status = 'N'";
    $arrType = $cf->getData($sitemapType);
    if(isset($arrType) && !empty($arrType)) {
        $return = "";
        $arrParent = [];
        foreach($arrType as $type) {
            $type = $type['item_type'];   
            $sqlSitemap = "SELECT item_id,item_title,item_type,item_alias FROM `items` WHERE `html_sitemap` = 'Y' AND `item_type` = '$type' AND `admin_module` = 'N' AND `display_status` = 'Y' AND `deleted_status` = 'N' ORDER BY `html_sitemap_order` ASC,`item_id` DESC";
            $arrData = $cf->getData($sqlSitemap);
            if(isset($arrData) && !empty($arrData)){
                foreach($arrData as $key=>$value) {
                    $arrParent[$type][] = array('title' => $value['item_title'],'alias' => $value['item_alias']);
                }
            }
        }
    }
    file_put_contents($theme_path."generated_files/sitemapdata.php",serialize($arrParent));
  }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Site Under Construction</title>
</head>
<body>
    <img style="text-align:center;width:100%;margin:auto;" src="<?php echo $theme_url;?>images/maintenance.png" alt="Under Construction" />
</body>
</html>
