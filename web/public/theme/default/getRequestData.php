<?php
$data = json_decode(file_get_contents('php://input'), true);
if (isset($data) && !empty($data)) {
    $_REQUEST = $data;
}
if(isset($_REQUEST['token']) && $_REQUEST['token'] != "") {
    $token = $_REQUEST['token'];
}
header('Content-Type: application/json');
?>