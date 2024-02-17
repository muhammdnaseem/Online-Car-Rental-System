<?php
session_start();
require_once 'config.php';

function is_email($db,$email)
{
  $sql = "SELECT email FROM driver WHERE email='$email'";
  $result = mysqli_query($db,$sql);
  if(mysqli_num_rows($result) > 0)
  {
    return true;
  }else{
    return false;
  }
}

function is_license($db,$license)
{
  $sql = "SELECT license FROM driver WHERE license='$license'";
  $result = mysqli_query($db,$sql);
  if(mysqli_num_rows($result) > 0)
  {
    return true;
  }else{
    return false;
  }
}

if(isset($_POST['apply']))
{
  $fname=trim($_POST['fullname']);
  $email=trim($_POST['emailid']); 
  $license=trim($_POST['license']); 
  $mobile=trim($_POST['mobileno']);
  $address=trim($_POST['address']);
  $dob=trim($_POST['dob']);
  $city=trim($_POST['city']);
  $country=trim($_POST['country']);
  $applyOn = date('Y-m-d H:i:s a');

 
    if(!is_email($db,$email))
    {
      if(!is_license($db,$license))
      {
        $sql = "INSERT INTO `driver`(`fullname`, `mobile`, `email`,`license`, `dob`, `city`, `country`, `address`,`applyOn`) VALUES('$fname','$mobile','$email','$license','$dob','$city','$country','$address','$applyOn')";

        $result = mysqli_query($db,$sql);

        $lastInsertId = mysqli_insert_id($db);

        if($lastInsertId)
        {
          $_SESSION['success'] = 'Request sent successfull.';
          header('location:../index.php');
        }
        else 
        {
          $_SESSION['error'] = 'Something went wrong. Please try again.';
          header('location:../index.php');
        }
      }
      else 
        {
          $_SESSION['error'] = 'This License Number Is Already Exist.';
          header('location:../index.php');
        }
    }
    else 
      {
        $_SESSION['error'] = 'Sorry! You have already apply with this Email.';
        header('location:../index.php');
      }

}

?>










