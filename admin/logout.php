<?php

session_start();
unset($_SESSION['loginId']);
unset($_SESSION['adminName']);
unset($_SESSION['adminEmail']);
unset($_SESSION['profileImage']);
unset($_SESSION['success']);
unset($_SESSION['error']);
header('location:index.php');
die();

?>