<?php 
require_once 'includes/database.php';
require_once 'imageUpdateCode.php';
require_once 'includes/head.php';

$data = $_GET;
// print_r($data);
// exit;
$imageOne = '';
$updateImage = '';
if(!empty($data))
{
    $id = $_GET['id'];
    $page = $_GET['page'];
    $action = $_GET['action'];
    $updateImage = $_GET['updateImage'];

    if($page == 'editCar')
    {
        if($action == 'changeImage')
        {
           $imageOne = getImage($db,$updateImage,$id);
        }
    }
}
?>

<div class="row">
    <div class="col-md-6">
        <div class="d-flex flex-column">
        <label for="">Current Image One</label>
        <img class="vehicleImages" src="../<?= $imageOne; ?>" alt="">
        <br>
            <form action="imageUpdateCode.php" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label>Update Car Image Two <span class="text-danger font-weight-bold">*</span></label>
                    <input type="file" name="<?= $updateImage; ?>" class="file-upload-default">
                    <div class="input-group col-md-8">
                        <input type="text" placeholder="Upload Image" class="form-control">
                        <span class="input-group-append">
                            <button class="file-upload-browse btn btn-inverse-primary py-2" type="button">Upload</button>
                        </span>

                    </div>
                </div>

                <input type="hidden" name="id" value="<?= $id; ?>">
                <input type="hidden" name="action" value="<?= $updateImage; ?>">
                <input type="submit" value="Update" class="btn btn-inverse-success">
            </form>
        </div>
    </div>
</div>

<?php require_once 'includes/foot.php'; ?>