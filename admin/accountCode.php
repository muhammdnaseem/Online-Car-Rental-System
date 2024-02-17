<?php
if(!session_id()){
    session_start();
}

include_once 'includes/database.php';
include_once 'includes/adminMethods.php';

if(!empty($_POST))
{
    if(isset($_POST['loginBtn']))
    {
        $formData = $_REQUEST;

        if(!empty($formData))
        {
            $sql = "SELECT * FROM admin WHERE email='{$formData['email']}'";
            $result = mysqli_query($db,$sql);
            
            if(mysqli_num_rows($result) > 0)
            {
                $loginData = mysqli_fetch_assoc($result);

                if(trim($loginData['password']) == trim(md5($formData['password'])))
                {
                    $_SESSION['loginId'] = $loginData['id'];
                    $_SESSION['userType'] = $loginData['userType'];
                    $_SESSION['adminName'] = $loginData['username'];
                    $_SESSION['adminEmail'] = $loginData['email'];
                    $_SESSION['profileImage'] = $loginData['image'];

                    if(isset($_POST['remember']))
                    {
                        setcookie('email',$loginData['email'],time()+(3600*24));
                        setcookie('password',$formData['password'],time()+(3600*24));
                    }else{
                        setcookie('email','',time()-(3600*24));
                        setcookie('password','',time()-(3600*24));
                    }

                    header('location:dashboard.php');
                }
                else
                {
                    $_SESSION['error'] = '<div class="alert alert-warning">Warning! Password is wrong.</div>';
                    header('location:index.php');
                }
            }
            else
            {
                $_SESSION['error'] = '<div class="alert alert-warning">Warning! Email is wrong.</div>';
                header('location:index.php');
            }
        }
    }


    if(isset($_POST['recoveryBtn']))
    {
        $email = $_POST['email'];
        $recoveryQuestionOption = $_POST['recoveryQuestionOption'];
        $answer = $_POST['answer'];
        $newpassword = $_POST['newpassword'];
        $confirmpassword = $_POST['confirmpassword'];

        if($newpassword != $confirmpassword)
        {
            $_SESSION['error'] = '<div class="alert alert-warning">Warning! New Password And Confirm Password do not match.</div>';
            header('location:forgotPassword.php');
        }
        else
        {
            $sql = "SELECT * FROM admin WHERE email='$email' AND recoveryQuestionOption='$recoveryQuestionOption' AND recoveryAnswer='$answer'";
            $result = mysqli_query($db,$sql);
            if(mysqli_num_rows($result) > 0)
            {
                mysqli_query($db,"UPDATE admin SET password='$newpassword' WHERE email='$email'");
                $_SESSION['success'] = '<div class="alert alert-success">Success! Password changed successfully. Login with new password</div>';

                header('location:index.php');
            }
            else
            {
                $_SESSION['error'] = '<div class="alert alert-warning">Warning! Invalid login details.</div>';
                header('location:forgotPassword.php'); 
            }
        }
    }
}

?>