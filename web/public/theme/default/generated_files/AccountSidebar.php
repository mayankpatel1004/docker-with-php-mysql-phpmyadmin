<?php
$arrAccount = array();
$arrAccount['customerdashboard'] = 'Dashboard';
$arrAccount['customerprofile'] = 'Profile';
$arrAccount['customerpasswordchange'] = 'Change Password';
if(GUEST_POST == 'Y'){
    $arrAccount['guestpost'] = "Your Post";
}
if(MY_ORDERS == 'Y') {
    $arrAccount['myorders'] = "My Orders";
}
?>