<?php
if(!session_id()){
    session_start();
}
require_once 'includes/database.php';
$data = $_GET;
if(!empty($data['action']))
{
    if($data['action'] == 'status')
    {
        $id = $data['id'];
        $sql = "UPDATE driver SET status='accepted' WHERE id='$id'";
        if(mysqli_query($db,$sql))
        {
            $_SESSION['success'] = '<div class="alert alert-success">Success! Driver status changed successfully.</div>';
            header('location:manageDriver.php');
        }
        else
        {
            $_SESSION['error'] = '<div class="alert alert-danger">Error! Driver status couldnot changed.</div>';
            header('location:manageDriver.php');
        }
    }

    if($data['action'] == 'delete')
    {
        $id = $data['id'];
        $sql = "DELETE FROM driver WHERE id='$id'";
        if(mysqli_query($db,$sql))
        {
            $_SESSION['success'] = '<div class="alert alert-success">Success! Driver Deleted successfully.</div>';
            header('location:manageDriver.php');
        }
        else
        {
            $_SESSION['error'] = '<div class="alert alert-danger">Error! Driver couldnot deleted.</div>';
            header('location:manageDriver.php');
        }
    }
}
?>