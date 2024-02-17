<?php
if(!session_id())
{
    session_start();
}
require_once 'includes/database.php';

$profile = $_REQUEST;

if($profile['id'] > 0)
{
    $userName = trim($profile['username']);
    $email = trim($profile['email']);
    $mobile = trim($profile['mobile']);
    $address = trim($profile['address']);
    if($profile['recoveryQuestionOption'] != '')
    {
        $recoveryQuestionOption = trim($profile['recoveryQuestionOption']);
    }
    else
    {
        $recoveryQuestionOption = null;
    }
    
    if($profile['recoveryAnswer'] != '')
    {
        $recoveryAnswer = trim($profile['recoveryAnswer']);
    }
    else
    {
        $recoveryAnswer = null;
    }

    $image = $_FILES['profileImage'];
    $id = trim($profile['id']);

    if($image['size'] > 0)
    {
        $image = uploadImage($image);
        $_SESSION['profileImage'] = $image;
        $sql = "UPDATE admin SET username='$userName',email='$email',mobile='$mobile',address='$address',recoveryQuestionOption='$recoveryQuestionOption',recoveryAnswer='$recoveryAnswer',image='$image' WHERE id='$id'";

        if($image)
        {
            $result = mysqli_query($db,$sql);
            if(mysqli_affected_rows($db) > 0)
            {
                $_SESSION['success'] = '<div class="alert alert-success">Success! Profile updated successfully.</div>';
                $_SESSION['adminName'] = $userName;
                $_SESSION['adminEmail'] = $email;
                header('location:profile.php');
            }
            else
            {
                $_SESSION['error'] = '<div class="alert alert-danger">Error! profile image can not updated.</div>';
                header('location:profile.php');
            }
        }
    }
    else
    {
        $sql = "UPDATE admin SET username='$userName',email='$email',mobile='$mobile',address='$address',recoveryQuestionOption='$recoveryQuestionOption',recoveryAnswer='$recoveryAnswer' WHERE id='$id'";

        $result = mysqli_query($db,$sql);
        if($result)
        {
            $_SESSION['success'] = '<div class="alert alert-success">Success! Profile updated successfully.</div>';
            $_SESSION['adminName'] = $userName;
            $_SESSION['adminEmail'] = $email;
            header('location:profile.php');
        }
        else
        {
            $_SESSION['error'] = '<div class="alert alert-danger">Error! profile can not updated.</div>';
            header('location:profile.php');
        }
    }

    
}

if(isset($profile['loginId']))
{
    $currentPassword = trim($profile['currentPassword']);
    $newPassword = trim($profile['newPassword']);
    $confirmPassword = trim($profile['confirmPassword']);
    $loginId = trim($profile['loginId']);

    if($newPassword === $confirmPassword)
    {
        $sql = "SELECT password FROM admin WHERE password='$currentPassword' AND id='$loginId'";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0)
        {
            $sql = "UPDATE admin SET password='$newPassword' WHERE id='$loginId'";

            $result = mysqli_query($db,$sql);
            if(mysqli_affected_rows($db) > 0)
            {
                $_SESSION['success'] = '<div class="alert alert-success">Success! Password reset successfully. Login with new password that you recently set</div>';
                header('location:changePassword.php');
            }
            else
            {
                $_SESSION['error'] = '<div class="alert alert-danger">Error! password can not updated.</div>';
                header('location:changePassword.php');
            }
        }
        else
        {
            $_SESSION['error'] = '<div class="alert alert-warning">Warning! Current password is wrong. Try with correct one.</div>';
            header('location:changePassword.php');
        }
    }
    else
    {
        $_SESSION['error'] = '<div class="alert alert-warning">Warning! Password are not matched.</div>';
        header('location:changePassword.php'); 
    }

}

function uploadImage($image)
{
    $imageName = $image['name'];
    $splitImage = explode('.',$imageName);
    $ext = strtolower(end($splitImage));
    if(in_array($ext,['jpg','jpeg','png']))
    {
        $newName = hexdec(uniqid()).'.'.$ext;
        $uploadPath = 'uploads/'.$newName;
        if(move_uploaded_file($image['tmp_name'],'../'.$uploadPath))
        {
            return $uploadPath;
        }
    }
    else
    {
        $_SESSION['error'] = '<div class="alert alert-warning">Warning! We accept (jpg,jpeg or png) file only</div>';
        header('location:profile.php');
    }
}

?>