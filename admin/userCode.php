<?php 
if(!session_id()){
    session_start();
}
require_once 'includes/database.php';

function getUsers($db)
{
    $sql = "SELECT * FROM users";
    $result = mysqli_query($db,$sql);

    if(mysqli_num_rows($result) > 0)
    {
        return $result;
    }
    else
    {
        return [];
    }
}


?>