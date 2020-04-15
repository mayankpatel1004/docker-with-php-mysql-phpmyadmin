<?php
global $theme_path;
$message = $ex->getMessage();
ini_set("log_errors", TRUE); 
$log_file = $theme_path.'logs/'.time().".log"; 
error_log($message, 3, $log_file);
$success = 0;
$error = 1;
?>