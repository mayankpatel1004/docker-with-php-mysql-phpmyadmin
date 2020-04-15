<?php
global $back_session_name,$conn,$theme_path,$url,$theme_url;
require_once($theme_path."generated_files/configdata.php");
$emailBody = str_replace("#sitename#", FRONT_APPLICATION_NAME, $emailBody);
$emailBody = str_replace("#companyname#", COMPANY_NAME, $emailBody);
$emailBody = str_replace("#companyaddress#", COMPANY_ADDRESS1, $emailBody);
$emailBody = str_replace("#companyaddress2#", COMPANY_ADDRESS2, $emailBody);
$emailBody = str_replace("#companycity#", COMPANY_CITY, $emailBody);
$emailBody = str_replace("#companystate#", COMPANY_STATE, $emailBody);
$emailBody = str_replace("#companycountry#", COMPANY_COUNTRY, $emailBody);
$emailBody = str_replace("#companyzipcode#", COMPANY_ZIPCODE, $emailBody);
$emailBody = str_replace("#companycontact#", COMPANY_CONTACT_NUMBER, $emailBody);
$emailBody = str_replace("#companywebsite#", COMPANY_WEBSITE, $emailBody);
$emailBody = str_replace("#companyemail#", COMPANY_EMAIL, $emailBody);
$emailBody = str_replace("#logo_url#",$theme_url.'images/logo.png',$emailBody);
?>