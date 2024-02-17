<?php
include_once 'brandsCode.php';
include_once 'includes/head.php';
include_once 'includes/database.php';

$brandData = $_REQUEST;
$result = [];

if (!empty($brandData['page'])) {
    if ($brandData['page'] == 'editBrand' && $brandData['action'] == 'getBrand') {
        $id     = $brandData['id'];
        $result = getBrandRow($db, $id);
    }
}

?>

<div class="page-header">

    <?php if (isset($_SESSION['success'])) : echo $_SESSION['success'];
        unset($_SESSION['success']);
    elseif(isset($_SESSION['error'])) : echo $_SESSION['error'];
    unset($_SESSION['error']);

        else : echo "
     <h3 class='page-title'>
     <span class='page-title-icon bg-gradient-primary text-white me-2'>
        <a href='brands.php' class='text-light'><i class='mdi mdi-arrow-left-bold'></i></a>
    </span>Update Brand</h3>";
    endif; ?>

</div>

<div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-content">
                <div class="card-header h5 text-info">
                    Update Brand
                </div>
                <form action="brandsCode.php" method="POST">
                    <div class="card-body p-3 pb-0">
                        <div class="form-group">
                            <label for="" class="form-label">Update Brand Name</label>
                            <input type="text" name="brandName" id="brandName" class="form-control" placeholder="Input brand name" value="<?= $result['brand_name']; ?>" required />
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="hidden" name="page" value="brands">
                        <input type="hidden" name="action" value="updateBrand">
                        <input type="hidden" name="id" value="<?= $result['id']; ?>">
                        <input type="submit" class="btn btn-inverse-primary form-control" value="Update" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once 'includes/foot.php'; ?>