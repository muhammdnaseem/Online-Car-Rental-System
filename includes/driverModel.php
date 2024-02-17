

<div class="modal fade" id="driverModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Want To Become A Driver?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form action="includes/driver.php" method="post" name="driver">
        <div class="modal-body">
          <div class="row">
            <div class="signup_wrap">
              <div class="col-md-12 col-sm-6">
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
                    <input type="text" class="form-control" name="license" id="license" placeholder="License Number" required="required" minlength="13" maxlength="13">
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
                    <textarea class="form-control" name="address" placeholder="Address" required="required"></textarea>
                  </div>


              </div>

            </div>
          </div>
        </div>
        <div class="modal-footer ">
          <div class="form-group">
            <input type="submit" value="Apply" name="apply" id="submit" class="btn btn-block" style="background-color: #49a3ff;">
          </div>
        </div>
      </form>
      
    </div>
  </div>
</div>




<!-- 

<div id="driverModal" class="modal fade">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Want To Become A Driver?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="includes/driver.php" method="post" name="driver">
        <div class="modal-body">
          <div class="row">
            <div class="signup_wrap">
              <div class="col-md-12 col-sm-6">
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
                    <input type="text" class="form-control" name="license" id="license" placeholder="License Number" required="required" minlength="13" maxlength="13">
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
                    <textarea class="form-control" name="address" placeholder="Address" required="required"></textarea>
                  </div>


              </div>

            </div>
          </div>
        </div>
        <div class="modal-footer ">
          <div class="form-group">
            <input type="submit" value="Apply" name="apply" id="submit" class="btn btn-block" style="background-color: #49a3ff;">
          </div>
        </div>
      </form>
   
      </div>
   
    </div>

  </div> -->