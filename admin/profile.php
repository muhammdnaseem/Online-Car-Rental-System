<?php 
require_once 'includes/head.php';
require_once 'includes/database.php';

$id = $_SESSION['loginId'];

$sql = "SELECT * FROM admin WHERE status='unblock' AND id='$id'";
$result = mysqli_query($db,$sql);
$profile = mysqli_fetch_assoc($result);

?>
<?php if(isset($_SESSION['success'])): echo $_SESSION['success'];unset($_SESSION['success']); endif;?> 
<?php if(isset($_SESSION['error'])): echo $_SESSION['error'];unset($_SESSION['error']); endif;?>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header text-info h3">Profile Details</div>
            <form action="profileCode.php" method="POST" enctype="multipart/form-data">
            <div class="card-body p-3">
                <div class="row mb-4">
                    <div class="col-md-4">

                        <div class="form-group">
                            <label class="form-label ml-3 mb-2">Profile Image</label>
                            <input type="file" class="file-upload-default" name="profileImage">
                            <div class="input-group col-xs-12">
                                <span class="input-group-append">
                                    <button class="file-upload-browse logoBtn" type="button">
                                        <img src="<?php echo '../'.$profile['image']; ?>" alt="" class="logoImage">
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
                            <input required type="text" name="username" id="username" class="form-control" placeholder="Input company name" value="<?= $profile['username']; ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" class="form-label">Email <span class="text-danger font-weight-bold">*</span></label>
                            <input required type="email" name="email" id="email" class="form-control" placeholder="Input company email address" value="<?= $profile['email']; ?>">
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="mobile" class="form-label">Contact Number <span class="text-danger font-weight-bold">*</span></label>
                            <input required type="number" min="1" name="mobile" id="mobile" class="form-control" placeholder="Input company contact number" value="<?= $profile['mobile']; ?>">
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" id="address" class="form-control"><?= $profile['address'] ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="recoveryQuestionOption" class="form-label">Select Recovery Question <span class="text-danger font-weight-bold">*</span></label>
                            <select name="recoveryQuestionOption" id="recoveryQuestionOption" class="form-control">
                                <option value="">Select</option>
                                <option <?php if($profile['recoveryQuestionOption'] == 1): echo "selected class='text-dark'"; endif; ?> value="1">Your favourite place?</option>
                                <option <?php if($profile['recoveryQuestionOption'] == 2): echo "selected class='text-dark'"; endif; ?> value="2">Your favourite teacher name?</option>
                                <option <?php if($profile['recoveryQuestionOption'] == 3): echo "selected class='text-dark'"; endif; ?> value="3">Your favourite movie name?</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="recoveryAnswer" class="form-label">Your Answer</label>
                            <input type="text" name="recoveryAnswer" id="recoveryAnswer" class="form-control" placeholder="Input your recovery question answer here" value="<?= $profile['recoveryAnswer']; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <input type="hidden" name="id" value="<?= $profile['id']; ?>">
                <input type="submit" value="Update" class="btn btn-inverse-info">
            </div>
            </form>
        </div>
    </div>
</div>

<?php require_once 'includes/foot.php'; ?>