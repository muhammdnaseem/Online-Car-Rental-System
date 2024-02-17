<?php 
require_once 'brandsCode.php';
require_once 'includes/database.php';

$brands = getBrands($db);
// print_r(mysqli_fetch_assoc($brands));exit;
require_once 'includes/head.php';
?>

    
<?php if(isset($_SESSION['success'])): echo $_SESSION['success'];unset($_SESSION['success']); endif;?> 
<?php if(isset($_SESSION['error'])): echo $_SESSION['error'];unset($_SESSION['error']); endif;?> 

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header" style="height: 60px;">
                <!-- Add Brand Form -->
                <span class="bg-danger" style="height: 10px;">
                    <form action="brandsCode.php" method="POST">
                        <div class="form-group">
                            <div class="input-group">
                            <span class="input-group-append">
                                <input type="submit" class="btn btn-inverse-info py-2 px-3" value="Save"/>
                            </span>
                                <input required type="text" name="brandName" id="brandName" class="form-control" placeholder="Input brand name"/>
                            </div>
                        </div>
                        <input type="hidden" name="page" value="brands">
                        <input type="hidden" name="action" value="addBrand">

                    </form>
                </span>
                <!-- Add Brand Form End -->
            </div>
            <div class="card-body p-3">
                
                <table class="table table-hover" id="brandsTable">
                    <thead>
                        <?php if($_SESSION['userType'] === 'admin'): ?>
                        <tr>
                            <th>Brand Title</th>
                            <th>Creation Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <?php else: ?>
                            <tr>
                            <th>Brand Title</th>
                            <th>Creation Date</th>
                            </tr>
                        <?php endif; ?>
                    </thead>
                    <tbody>
                    <?php foreach($brands as $brand): ?>
                        <tr>
                            <td><?= $brand['brand_name'] ?></td>
                            <td><?= $brand['creation_date'] ?></td>
                            <?php if($_SESSION['userType'] === 'admin'): ?>
                            <td>
                                <?php if($brand['status'] === 'block'): ?>
                                    <a href="brandsCode.php?type=status&page=brands&action=block&id=<?= $brand['id']; ?>" class="btn btn-inverse-danger btn-sm">Block</a>
                                <?php else: ?>
                                    <a href="brandsCode.php?type=status&page=brands&action=unblock&id=<?= $brand['id']; ?>" class="btn btn-inverse-success btn-sm">Unblock</a>
                                <?php endif; ?>
                            </td>
                            <?php endif; ?>
                            <?php if($_SESSION['userType'] === 'admin'): ?>
                            <td>
                                <a href="editBrand.php?page=editBrand&action=getBrand&id=<?= $brand['id']; ?>" class="btn btn-inverse-primary btn-sm">Edit</a>
                                
                                <a href="brandsCode.php?page=brands&action=deleteBrand&id=<?= $brand['id']; ?>" class="btn btn-inverse-danger btn-sm" onclick="return confirm('Are you sure to delete?')">Delete</a>
                            </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- row close -->
<?php include_once 'includes/foot.php'; ?>