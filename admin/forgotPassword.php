<?php
if (!session_id()) {
  session_start();
}

if (isset($_SESSION['loginId'])) {
  header('location:dashboard.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Login</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">

                        
                        <?php if (isset($_SESSION['error'])) : ?>
                        <span><?= $_SESSION['error'];
                    unset($_SESSION['error']); ?></span>
                        <?php endif; ?>

                        <div class="auth-form-light text-left p-5">
                            
                            <h4 class="text-info h3">Login Details</h4>
                            <form action="accountCode.php" method="POST" class="pt-3">
                                <div class="form-group">
                                    <input required type="email" name="email" class="form-control form-control-lg"
                                        placeholder="Input Email Address">
                                </div>
                                <div class="form-group">
                            <label for="recoveryQuestionOption" class="form-label">Select Recovery Question <span class="text-danger font-weight-bold">*</span></label>
                            <select name="recoveryQuestionOption" id="recoveryQuestionOption" class="form-control">
                                <option value="">Select</option>
                                <option value="1">Your favourite place?</option>
                                <option value="2">Your favourite teacher name?</option>
                                <option value="3">Your favourite movie name?</option>
                            </select>
                            </div>
                            <div class="form-group">
                                    <input required type="text" name="answer" class="form-control form-control-lg"
                                        placeholder="Input Answer">
                                </div>

                                <div class="form-group">
                                    <input required type="text" name="newpassword" class="form-control form-control-lg"
                                        placeholder="Input new password">
                                </div>

                                <div class="form-group">
                                    <input required type="text" name="confirmpassword" class="form-control form-control-lg"
                                        placeholder="Input confirm password">
                                </div>

                                <div class="mt-3 d-flex justify-content-between align-items-center">
                                    <input type="submit"
                                        class="btn btn-inverse-info btn-lg font-weight-medium auth-form-btn"
                                        name="recoveryBtn" value="Recover">
                                        <br>
                                        <br>
                                        <a href="index.php" class="auth-link text-black">back to login?</a>
                                </div>
                                

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
</body>

</html>