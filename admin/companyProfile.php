<?php 
require_once 'includes/head.php';
require_once 'includes/database.php';
$sql = "SELECT * FROM companyprofile";
$result = mysqli_query($db,$sql);
$profile = mysqli_fetch_assoc($result);
?>
<?php if(isset($_SESSION['success'])): echo $_SESSION['success'];unset($_SESSION['success']); endif;?> 
<?php if(isset($_SESSION['error'])): echo $_SESSION['error'];unset($_SESSION['error']); endif;?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-info h3">Company Profile</div>
            <form action="companyProfileCode.php" method="POST" enctype="multipart/form-data">
            <div class="card-body p-3">
                <div class="row mb-4">
                    <div class="col-md-4">

                        <div class="form-group">
                            <label class="form-label ml-3 mb-2">Company Logo</label>
                            <input type="file" class="file-upload-default" name="companyLogo">
                            <div class="input-group col-xs-12">
                                <span class="input-group-append">
                                    <button class="file-upload-browse logoBtn" type="button">
                                        <img src="<?php echo '../'.$profile['companyLogo']; ?>" alt="" class="logoImage">
                                    </button>
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyName" class="form-label">Company Name <span class="text-danger font-weight-bold">*</span></label>
                            <input required type="text" name="companyName" id="companyName" class="form-control" placeholder="Input company name" value="<?= $profile['companyName']; ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="compnayRegNo" class="form-label">Company Reg No <span class="text-danger font-weight-bold">*</span></label>
                            <input required type="text" name="regNo" id="regNo" class="form-control" placeholder="Input company registration number" value="<?= $profile['regNo']; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="physicalAddress" class="form-label">Physical Address <span class="text-danger font-weight-bold">*</span></label>
                            <textarea required name="companyAddress" id="companyAddress" class="form-control" placeholder="Input physical address"><?= $profile['companyAddress']; ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyEmail" class="form-label">Company Email <span class="text-danger font-weight-bold">*</span></label>
                            <input required type="email" name="companyEmail" id="companyEmail" class="form-control" placeholder="Input company email address" value="<?= $profile['companyEmail']; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="country" class="form-label">Country <span class="text-danger font-weight-bold">*</span></label>
                            <input required type="text" name="country" id="country" class="form-control" placeholder="Input country name" value="<?= $profile['country']; ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contactNo" class="form-label">Contact Number <span class="text-danger font-weight-bold">*</span></label>
                            <input required type="number" name="companyphone" id="companyphone" class="form-control" placeholder="Input company contact number" value="<?= $profile['companyphone']; ?>">
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