<?php

require_once 'includes/database.php';

$data = $_POST;
// print_r($_POST);


if(!empty($data))
{
    $action = trim($_POST['action']);

    if(!empty($action))
    {
        $id = $_POST['id'];
        $image= $_FILES[$action];
        // echo '<pre>';
        // print_r($image);
        // exit;
        $image = uploadImage($image,$id);
        $sql = "UPDATE registeredcars SET $action='$image' WHERE id='$id'";
       
        if(mysqli_query($db,$sql))
        {
            $_SESSION['success'] = '<div class="alert alert-success">Success! Image updated successfully.</div>';
            header('location:editCar.php?page=editCar&action=getRow&id='.$id);
        }
        else
        {
            $_SESSION['error'] = '<div class="alert alert-danger">Error! Image not updated.</div>';
            header('location:editCar.php?page=editCar&action=getRow&id='.$id);
        }
    }
}




function getImage($db,$imageNo,$id)
{
    $sql = "SELECT $imageNo FROM registeredcars WHERE id='$id'";
    $result=mysqli_query($db,$sql);

    if(mysqli_num_rows($result) > 0)
    {
        $image = mysqli_fetch_assoc($result);
        return $image[$imageNo];
    }
    else
    {
        return [];
    }
}

function uploadImage($image,$id)
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
            header('location:editCar.php?page=editCar&action=getRow&id='.$id);
        }
    }

?>