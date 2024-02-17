<?php 
// DB credentials.
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','rent_car');
// Establish database connection.
$db = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
?>