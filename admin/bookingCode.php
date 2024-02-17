<?php
if(!session_id())
{
    session_start();
}

function changeOrderStatus($db,$action,$id)
{
    $sql = "UPDATE bookings SET bookingStatus='$action' WHERE id='$id'";
    if(mysqli_query($db,$sql))
    {
        $_SESSION['success'] = '<div class="alert alert-success">Success! Booking <span class="text-Capitalize text-danger">'.$action.'</span> Successfully.</div>';
        return true;
    }
    else
    {
        $_SESSION['error'] = '<div class="alert alert-danger">Error! booking for vehicle </div>';
        return false;
    }

}


function getBookings($db,$id=null)
{
    $sql = "SELECT bookings.*,bookings.id as bookingId,users.*,users.fullName as username,registeredcars.*,registeredcars.carName as car FROM bookings INNER JOIN users ON users.id=bookings.userId INNER JOIN registeredcars ON registeredcars.id=bookings.vehicleId ";
    if($id != null)
    {
        $sql .= "WHERE bookings.id='$id'";
    }

    // echo $sql;
    $result = mysqli_query($db,$sql);
    // echo '<pre>';
    // print_r($result);
    // exit;
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