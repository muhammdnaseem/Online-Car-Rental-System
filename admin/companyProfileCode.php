<?php
if(!session_id())
{
  session_start();
}
require_once 'includes/database.php';

$profile = $_POST;

if(!empty($profile) && !empty($profile['id']))
{
    $companyName = trim($profile['companyName']);
    $regNo = trim($profile['regNo']);
    $companyEmail = trim($profile['companyEmail']);
    $companyphone = trim($profile['companyphone']);
    $country = trim($profile['country']);
    $companyAddress = trim($profile['companyAddress']);
    $companyLogo = $_FILES['companyLogo'];
    $id = trim($profile['id']);

    if($companyLogo['size'] > 0)
    {
        $image = uploadImage($companyLogo);
        $sql = "UPDATE companyprofile SET companyName='$companyName',regNo='$regNo',companyEmail='$companyEmail',companyphone='$companyphone',country='$country',companyAddress='$companyAddress',companyLogo='$image' WHERE id='$id'";

        if($image)
        {
            $result = mysqli_query($db,$sql);
            if(mysqli_affected_rows($db) > 0)
            {
                $_SESSION['success'] = '<div class="alert alert-success">Success! Company profile updated successfully.</div>';
                header('location:companyProfile.php');
            }
            else
            {
                $_SESSION['error'] = '<div class="alert alert-danger">Error! Company profile can not updated.</div>';
                header('location:companyProfile.php');
            }
        }
    }
    else
    {
        $sql = "UPDATE companyprofile SET companyName='$companyName',regNo='$regNo',companyEmail='$companyEmail',companyphone='$companyphone',country='$country',companyAddress='$companyAddress' WHERE id='$id'";

        $result = mysqli_query($db,$sql);
        if($result)
        {
            $_SESSION['success'] = '<div class="alert alert-success">Success! Company profile updated successfully.</div>';
            header('location:companyProfile.php');
        }
        else
        {
            $_SESSION['error'] = '<div class="alert alert-danger">Error! Company profile can not updated.</div>';
            header('location:companyProfile.php');
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
        header('location:companyProfile.php');
    }
}

?>