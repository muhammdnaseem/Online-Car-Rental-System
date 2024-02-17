<?php
require_once 'config.php';

function is_email($db,$email)
{
  $sql = "SELECT email FROM users WHERE email='$email'";
  $result = mysqli_query($db,$sql);
  if(mysqli_num_rows($result) > 0)
  {
    return true;
  }else{
    return false;
  }
}

function is_cnic($db,$cnic)
{
  $sql = "SELECT cnic FROM users WHERE cnic='$cnic'";
  $result = mysqli_query($db,$sql);
  if(mysqli_num_rows($result) > 0)
  {
    return true;
  }else{
    return false;
  }
}

if(isset($_POST['signup']))
{
  $fname=trim($_POST['fullname']);
  $email=trim($_POST['emailid']); 
  $mobile=trim($_POST['mobileno']);
  $address=trim($_POST['address']);
  $cnic=trim($_POST['cnic']);
  $dob=trim($_POST['dob']);
  $city=trim($_POST['city']);
  $country=trim($_POST['country']);
  $password = md5(trim($_POST['password']));
  $cpassword = md5(trim($_POST['cpassword']));
  $regDate = date('Y-m-d');

  if($password != $cpassword)
  {
    echo "<script>alert('Password & Confirm Password Does Not Matched ');</script>";
  }
  else
  {
    if(!is_email($db,$email))
    {
      if(!is_cnic($db,$cnic))
      {
        $sql="INSERT INTO users(fullName,email,cnic,dob,password,contactNo,address,city,country,regDate) VALUES('$fname','$email','$cnic','$dob','$password','$mobile','$address','$city','$country','$regDate')";

        $result = mysqli_query($db,$sql);

        $lastInsertId = mysqli_insert_id($db);

        if($lastInsertId)
        {
        echo "<script>alert('Registration successfull. Now you can login');</script>";
        }
        else 
        {
        echo "<script>alert('Something went wrong. Please try again');</script>";
        }
      }
      else 
      {
      echo "<script>alert('CNIC Number Already Exist');</script>";
      }
    }
    else 
      {
      echo "<script>alert('Email already registered try another one');</script>";
      }
  }

}

?>








<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sign Up</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
         <div class="modal-body" >
         <div class="row">
          <div class="signup_wrap">
            <div class="col-md-12 col-sm-6">
              <form  method="post" name="signup" onSubmit="return valid();">
                <div class="form-group">
                  <input type="text" class="form-control" name="fullname" placeholder="Full Name" required="required">
                </div>
                      <div class="form-group">
                  <input type="text" class="form-control" name="mobileno" placeholder="Mobile Number" maxlength="10" required="required">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="emailid" id="emailid" placeholder="Email Address" required="required"> 
                </div>
                <div class="form-group">
                  <input type="text" minlength="13" maxlength="13" class="form-control" name="cnic" placeholder="CNIC Number" required="required">
                </div>
                <div class="form-group">
                  <input type="date" class="form-control" name="dob" placeholder="Date Of Birth" required="required">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="city" placeholder="City name" required="required">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="country" placeholder="Country name" required="required">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password" required="required">
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="mobileno" placeholder="Address" required="required"></textarea>
                </div>
                <div class="form-group checkbox">
                  <input type="checkbox" id="terms_agree" required="required" checked="">
                  <label for="terms_agree">I Agree with <a href="#conditionsModal" data-toggle="modal">Terms and Conditions</a></label>
                </div>
                <div class="form-group">
                  <input type="submit" value="Sign Up" name="signup" id="submit" class="btn btn-block" style="background-color: #49a3ff;">
                </div>
              </form>
            </div>
            
          </div>
        </div>
      </div>
      <div class="modal-footer ">
         <p>Already got an account? <a href="#loginform" data-toggle="modal" data-dismiss="modal">Login Here</a></p>
      </div>
    </div>
  </div>
</div>



<!-- 
<div id="signupform" class="modal fade">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Sign up</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
         <div class="row">
          <div class="signup_wrap">
            <div class="col-md-12 col-sm-6">
              <form  method="post" name="signup" onSubmit="return valid();">
                <div class="form-group">
                  <input type="text" class="form-control" name="fullname" placeholder="Full Name" required="required">
                </div>
                      <div class="form-group">
                  <input type="text" class="form-control" name="mobileno" placeholder="Mobile Number" maxlength="10" required="required">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="emailid" id="emailid" placeholder="Email Address" required="required"> 
                </div>
                <div class="form-group">
                  <input type="text" minlength="13" maxlength="13" class="form-control" name="cnic" placeholder="CNIC Number" required="required">
                </div>
                <div class="form-group">
                  <input type="date" class="form-control" name="dob" placeholder="Date Of Birth" required="required">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="city" placeholder="City name" required="required">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="country" placeholder="Country name" required="required">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password" required="required">
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="mobileno" placeholder="Address" required="required"></textarea>
                </div>
                <div class="form-group checkbox">
                  <input type="checkbox" id="terms_agree" required="required" checked="">
                  <label for="terms_agree">I Agree with <a href="#conditionsModal" data-toggle="modal">Terms and Conditions</a></label>
                </div>
                <div class="form-group">
                  <input type="submit" value="Sign Up" name="signup" id="submit" class="btn btn-block" style="background-color: #49a3ff;">
                </div>
              </form>
            </div>
            
          </div>
        </div>
      </div>
      <div class="modal-footer ">
         <p>Already got an account? <a href="#loginform" data-toggle="modal" data-dismiss="modal">Login Here</a></p>
      </div>
   
    </div>

  </div>

</div>
 -->
