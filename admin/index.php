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

                        <?php if (isset($_SESSION['success'])) : ?>
                        <span><?= $_SESSION['success'];
                    unset($_SESSION['success']); ?></span>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['error'])) : ?>
                        <span><?= $_SESSION['error'];
                    unset($_SESSION['error']); ?></span>
                        <?php endif; ?>

                        <div class="auth-form-light text-left p-5">

                            <h4 class="text-info h3">Login Here</h4>
                            <form action="accountCode.php" method="POST" class="pt-3">
                                <div class="form-group">
                                    <input required type="email" name="email" class="form-control form-control-lg"
                                        placeholder="Input Email Address" value="<?php if(isset($_COOKIE['email'])){ echo $_COOKIE['email']; } ?>">
                                </div>
                                <div class="form-group">
                                    <input required type="password" name="password" class="form-control form-control-lg"
                                        id="exampleInputPassword1" placeholder="Input Password" value="<?php if(isset($_COOKIE['password'])){ echo $_COOKIE['password']; } ?>">
                                </div>
                                <div class="mt-3">
                                    <input type="hidden" name="action" value="AdminLogin">
                                    <input type="submit"
                                        class="btn btn-inverse-info btn-lg font-weight-medium auth-form-btn"
                                        name="loginBtn" value="Login">
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" <?php if(isset($_COOKIE['email'])) { echo 'checked'; } ?> name="remember" class="form-check-input"> Keep me signed in </label>
                                    </div>
                                    <a href="forgotPassword.php" class="auth-link text-black">Forgot password?</a>
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