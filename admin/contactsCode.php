<?php
if(!session_id()){
    session_start();
}
require_once 'includes/database.php';
if(isset($_GET['id']) && !empty($_GET['id']))
{
    $id = $_GET['id'];
    
    if(mysqli_query($db,"DELETE FROM contacts WHERE id={$id}"))
    {
        $_SESSION['success'] = '<div class="alert alert-success">Success! Contact Details Deleted successfully.</div>';
        header('location:contacts.php');
    }
    else
    {
        $_SESSION['error'] = '<div class="alert alert-danger">Error! Contact Not Deleted.</div>';
        header('location:contacts.php');
    }
}

?>