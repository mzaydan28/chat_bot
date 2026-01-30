<?php
session_start();
session_destroy();
header('Location: /chatbot/admin/login.php');
exit;
?>