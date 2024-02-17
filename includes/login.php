<?php
if(!session_id()){
  session_start();
}
require_once 'config.php';

if(isset($_POST['login']))
{
  $email=$_POST['email'];
  $password=md5($_POST['password']);

  $sql ="SELECT id,email,password,fullName FROM users WHERE email='$email' AND password='$password'";
  
  $results=mysqli_query($db,$sql);

  if(mysqli_num_rows($results) > 0)
  {
    $data = mysqli_fetch_assoc($results);

    $_SESSION['email']=$data['email'];
    $_SESSION['fname']=$data['fullName'];
    $_SESSION['userId']=$data['id'];
    $currentpage=$_SERVER['REQUEST_URI'];
    echo "<script type='text/javascript'> document.location = '$currentpage'; </script>";
  } else{

    echo "<script>alert('Invalid Details');</script>";

  }

}

?>


<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="height: auto;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
         <div class="row">
          <div class="login_wrap">
            <div class="col-md-12 col-sm-6">
              <form method="post">
                <div class="form-group">
                  <input type="email" class="form-control" name="email" placeholder="Email address*">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password*">
                </div>
                <div class="form-group checkbox">
                  <input type="checkbox" id="remember">
               
                </div>
                <div class="form-group">
                  <input type="submit" name="login" value="Login" class="btn btn-block" style="background-color: #49a3ff;">
                </div>
              </form>
            </div>
           
          </div>
        </div>
      </div>
      <div class="modal-footer ">
        <p>Don't have an account? <a href="#signupform" data-toggle="modal" data-dismiss="modal" style="color: #49a3ff;">Signup Here</a></p>&nbsp;
        <p><a href="#forgotpassword" data-toggle="modal" data-dismiss="modal" style="color: #49a3ff;">Forgot Password ?</a></p>
      </div>
    </div>
  </div>
</div>

<!-- 
<div id="loginform" class="modal fade">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
         <div class="row">
          <div class="login_wrap">
            <div class="col-md-12 col-sm-6">
              <form method="post">
                <div class="form-group">
                  <input type="email" class="form-control" name="email" placeholder="Email address*">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password*">
                </div>
                <div class="form-group checkbox">
                  <input type="checkbox" id="remember">
               
                </div>
                <div class="form-group">
                  <input type="submit" name="login" value="Login" class="btn btn-block" style="background-color: #49a3ff;">
                </div>
              </form>
            </div>
           
          </div>
        </div>
      </div>
      <div class="modal-footer ">
        <p>Don't have an account? <a href="#signupform" data-toggle="modal" data-dismiss="modal" style="color: #49a3ff;">Signup Here</a></p>&nbsp;
        <p><a href="#forgotpassword" data-toggle="modal" data-dismiss="modal" style="color: #49a3ff;">Forgot Password ?</a></p>
      </div>

    </div>
   
  </div>

</div> -->
<!--   end modal -->