<?php
require_once 'includes/database.php';
require_once 'coAdminCode.php';
require_once 'includes/head.php';

?>

<h3 class='page-title mb-3'>
     <span class='page-title-icon bg-gradient-primary text-white me-2'>
        <a href='registerUser.php' class='text-light'><i class='mdi mdi-arrow-left-bold'></i></a>
    </span>Co Admin
</h3>

<div class="row">
    <div class="col-md-6">
    <?php if (isset($_SESSION['success'])) : echo $_SESSION['success'];
    unset($_SESSION['success']);
endif; ?>
<?php if (isset($_SESSION['error'])) : echo $_SESSION['error'];
    unset($_SESSION['error']);
endif; ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header text-danger">Add Co-Admin</div>
            <form action="coAdminCode.php" method="POST" enctype="multipart/form-data">
                <div class="card-body p-3">
                    <div class="row mb-4">
                        <div class="col-md-4">

                            <div class="form-group">
                                <label class="form-label ml-3 mb-2">Profile Image</label>
                                <input type="file" class="file-upload-default" name="profileImage">
                                <div class="input-group col-xs-12">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse logoBtn" type="button">
                                            <img src="../uploads/avatar/avatar.png" alt="no-image" class="logoImage">
                                        </button>
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="companyName" class="form-label">User Name <span class="text-danger font-weight-bold">*</span></label>
                                <input required type="text" name="username" id="username" class="form-control" placeholder="User name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="form-label">Email <span class="text-danger font-weight-bold">*</span></label>
                                <input required type="email" name="email" id="email" class="form-control" placeholder="Email address">
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="mobile" class="form-label">Mobile Number <span class="text-danger font-weight-bold">*</span></label>
                                <input required type="number" name="mobile" id="mobile" min="1" class="form-control" placeholder="Mobile number">
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="address" class="form-label">Address</label>
                                <textarea name="address" id="address" class="form-control" placeholder="Address"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password" class="form-label">Password <span class="text-danger font-weight-bold">*</span></label>
                                <input required type="text" name="password" id="password" min="1" class="form-control" placeholder="Password">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="repeatPassword" class="form-label">Repeat Password <span class="text-danger font-weight-bold">*</span></label>
                                <input required type="text" name="repeatPassword" id="repeatPassword" min="1" class="form-control" placeholder="Repeat password">
                            </div>
                        </div>

                    </div>

                </div>
                <div class="card-footer">
                    <input type="hidden" name="userType" value="coAdmin">
                    <input type="submit" value="Add" class="btn btn-inverse-info">
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once 'includes/foot.php'; ?>