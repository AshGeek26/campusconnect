<?php
session_start();
session_destroy();
setcookie('remember_token', '', time() - 3600, '/');
header("Location: ../views/login.php");
?>