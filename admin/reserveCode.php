<?php
if(!session_id())
{
    session_start();
}

function changeReserveStatus($db,$action,$id)
{
    $sql = "UPDATE reserve SET reserveStatus='$action' WHERE id='$id'";
    if(mysqli_query($db,$sql))
    {
        $_SESSION['success'] = '<div class="alert alert-success">Success! reserve <span class="text-Capitalize text-danger">'.$action.'</span> Successfully.</div>';
        return true;
    }
    else
    {
        $_SESSION['error'] = '<div class="alert alert-danger">Error! reserve for vehicle </div>';
        return false;
    }

}



function getReserve($db, $id=null)
{
    $sql = "SELECT reserve.*, reserve.id as reserveId, users.*, users.fullName as username, registeredcars.*, registeredcars.carName as car FROM reserve INNER JOIN users ON users.id = reserve.userId INNER JOIN registeredcars ON registeredcars.id = reserve.vehicleId";
    
    if ($id !== null)
    {
        $sql .= " WHERE reserve.id='$id'";
    }
    
    // echo $sql;
    $result = mysqli_query($db, $sql);
    
    if (mysqli_num_rows($result) > 0)
    {
        return $result;
    }
    else
    {
        return [];
    }
}


?>