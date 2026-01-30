<?php
session_start();
session_destroy();
header('Location: ' . dirname(dirname($_SERVER['SCRIPT_NAME'])) . '/admin/login.php');
exit;
?>