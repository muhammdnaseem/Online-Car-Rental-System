<?php 
require_once 'includes/head.php';
require_once 'includes/database.php';

$id = $_SESSION['loginId'];

?>


<div class="row">
    <div class="col-md-6">
    <?php if(isset($_SESSION['success'])): echo $_SESSION['success'];unset($_SESSION['success']); endif;?> 
<?php if(isset($_SESSION['error'])): echo $_SESSION['error'];unset($_SESSION['error']); endif;?>
        <div class="card">
            <div class="card-header text-info h3">Reset your password</div>
            <form action="profileCode.php" method="POST">
            <div class="card-body p-3">
                <div class="row">
    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="currentPassword" class="form-label">Current Password <span class="text-danger font-weight-bold">*</span></label>
                            <input required type="text" name="currentPassword" id="currentPassword" class="form-control" placeholder="Input current password">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="newPassword" class="form-label">New Password <span class="text-danger font-weight-bold">*</span></label>
                            <input required type="text" name="newPassword" id="newPassword" class="form-control" placeholder="Input new password">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="confirmPassword" class="form-label">Confirm Password <span class="text-danger font-weight-bold">*</span></label>
                            <input required type="text" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Confirm password">
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="card-footer">
                <input type="hidden" name="loginId" value="<?= $id; ?>">
                <input type="submit" value="Update" class="btn btn-inverse-info">
            </div>
            </form>
        </div>
    </div>
</div>

<?php require_once 'includes/foot.php'; ?>