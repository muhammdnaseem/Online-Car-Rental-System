<?php
if(!session_id()){
    session_start();
}
require_once 'includes/database.php';

$formData = $_REQUEST;

if(!empty($formData))
{
    if(isset($formData['userType']) && $formData['userType'] === 'coAdmin')
    {
        $userType = trim($formData['userType']);
        $userName = trim($formData['username']);
        $email = trim($formData['email']);
        $mobile = trim($formData['mobile']);
        $address = trim($formData['address']);
        $password = md5(trim($formData['password']));
        $repeatPassword = md5(trim($formData['repeatPassword']));
        $image = $_FILES['profileImage'];

        $sql = "SELECT * FROM admin WHERE email='$email'";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) == 0)
        {
            if($password === $repeatPassword)
            {
                if($image['size'] > 0)
                {
                    $image = uploadImage($image);
                    $sql = "INSERT INTO admin(userType, username, email, password, mobile, address, image) VALUES ('$userType','$userName','$email','$password','$mobile','$address','$image')";
                }
                else
                {
                    $sql = "INSERT INTO admin(userType, username, email, password, mobile, address) VALUES ('$userType','$userName','$email','$password','$mobile','$address')";
                }
    
                $result = mysqli_query($db,$sql);
                if(mysqli_affected_rows($db) > 0)
                {
                    $_SESSION['success'] = '<div class="alert alert-success">Success! Co Admin added successfully.</div>';
                    header('location:addCoAdmin.php');
                }
                else
                {
                    $_SESSION['error'] = '<div class="alert alert-danger">Error! Co admin could not added.</div>';
                    header('location:addCoAdmin.php');
                }
            }
            else
            {
                $_SESSION['error'] = '<div class="alert alert-warning">Warning! Password does not matched.</div>';
                header('location:addCoAdmin.php');
            }
        }
        else
        {
            $_SESSION['error'] = '<div class="alert alert-warning">Warning! Co admin with the same email address is already exist.</div>';
            header('location:addCoAdmin.php');
        }

    }

    if($formData['action'] === 'block' || $formData['action'] === 'unblock')
    {
        $id = $_GET['id'];
        $action = $_GET['action'];

        $sql = "UPDATE admin SET status='$action' WHERE id=$id";
        
        mysqli_query($db,$sql);
        if(mysqli_affected_rows($db) > 0)
        {
            $_SESSION['success'] = '<div class="alert alert-success">Success! Co admin has been '.$action.' successfully.</div>';
            header('location:registerUser.php');
        }
        else
        {
            $_SESSION['error'] = '<div class="alert alert-danger">Error! can not blocked try again.</div>';
            header('location:registerUser.php');
        }

    }

    if($formData['action'] === 'delete')
    {
        $id = $_GET['id'];
        $sql = "DELETE FROM admin WHERE id=$id";
        mysqli_query($db,$sql);
        if(mysqli_affected_rows($db) > 0)
        {
            $_SESSION['success'] = '<div class="alert alert-success">Success! Co admin has been deleted successfully.</div>';
            header('location:registerUser.php');
        }
        else
        {
            $_SESSION['error'] = '<div class="alert alert-danger">Error! can not deleted try again.</div>';
            header('location:registerUser.php');
        }
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

function getCoAdmin($db)
{
    $sql = "SELECT * FROM admin WHERE userType='coAdmin'";
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