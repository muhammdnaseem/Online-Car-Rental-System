<?php
include_once 'includes/database.php';
if(!session_id()){
    session_start();
}
$page = null;
$action = null;
if(!empty($_REQUEST))
{
    $page = $_REQUEST['page'];
    $action = $_REQUEST['action'];
}

if($page == 'brands')
{
    if($action == 'addBrand')
    {
        $brand = trim($_REQUEST['brandName']);
        $creation = date('Y/m/d');

        $sql = "INSERT INTO brands (brand_name,creation_date) VALUES('$brand','$creation')";
       
        if(!empty($brand))
        {
            if(mysqli_num_rows(mysqli_query($db,"SELECT brand_name FROM brands WHERE brand_name='$brand'")) > 0)
            {
                $_SESSION['error'] = '<div class="alert alert-danger">Warning! Brand name already available into database.</div>';
                header('location:brands.php');
            }
            else
            {
                if(mysqli_query($db,$sql))
                {
                    $_SESSION['success'] = '<div class="alert alert-success">Success! New brand added into database successfully.</div>';
                    header('location:brands.php');
                }
                else
                {
                    $_SESSION['error'] = '<div class="alert alert-danger">Error! Error while adding new brand data into database.</div>';
                    header('location:brands.php');
                }
            }
        }
        else
        {
            $_SESSION['error'] = '<div class="alert alert-danger">Warning! Please fill brand name field .</div>';
            header('location:brands.php');
        }
    }

    if(isset($_GET['type']) && $_GET['type'] == 'status')
    {
        if(!empty($action))
        {
            $id = $_GET['id'];
            $next_status = 'block';
            if($action == 'block')
            {
                $next_status = 'unblock';
            }
            $sql = "UPDATE brands SET status='$next_status' WHERE id='$id'";
            $result = mysqli_query($db,$sql);
    
            if($result)
            {
                $_SESSION['success'] = '<div class="alert alert-success">Success! Status updated to '.$next_status.' successfully.</div>';
                header('location:brands.php');
            }
            else
            {
                $_SESSION['error'] = '<div class="alert alert-danger">Error! Status can not update.</div>';
                header('location:brands.php');
            }
        }
    }

    if($action == 'updateBrand')
    {
        $id = $_POST['id'];
        $brandName = trim($_POST['brandName']);
        $updationDate = date('Y/m/d');
        $sql = "UPDATE brands SET brand_name='$brandName',updation_date='$updationDate' WHERE id='$id'";

        if(!empty($brandName))
        {
            mysqli_query($db,$sql);
            if(mysqli_affected_rows($db) > 0)
            {
                $_SESSION['success'] = '<div class="alert alert-success">Success! Brand updated successfully.</div>';
                header('location:brands.php');
            }
            else
            {
                $_SESSION['error'] = '<div class="alert alert-danger">Error! Brand can not updated.</div>';
                header('location:brands.php');
            }
        }
        else
        {
            $_SESSION['error'] = '<div class="alert alert-danger">Warning! Brand field must be filled.</div>';
            header('location:editBrand.php?page=editBrand&action=getBrand&id='.$id);
        }
    }

    if($action == 'deleteBrand')
    {
        $id = $_GET['id'];
        $sql = "DELETE FROM brands WHERE id='$id'";
        if(mysqli_query($db,$sql))
        {
            $_SESSION['success'] = '<div class="alert alert-success">Success! Brand deleted successfully.</div>';
            header('location:brands.php');
        }
        else
        {
            $_SESSION['error'] = '<div class="alert alert-danger">Error! Brand can not deleted.</div>';
            header('location:brands.php');
        }
    }
}


function getBrands($db)
{

    $sql = "SELECT * FROM brands";
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

function getBrandRow($db,$id)
{
    $sql = "SELECT * FROM brands WHERE id='$id'";
    $result = mysqli_query($db,$sql);
    if(mysqli_num_rows($result) > 0)
    {
        return mysqli_fetch_assoc($result);
    }
    else
    {
        return $result = [];
    }
}
?>