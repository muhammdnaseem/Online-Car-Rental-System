<?php 
require_once 'includes/database.php';
require_once 'coAdminCode.php';
require_once 'includes/head.php';

$coAdmins = getCoAdmin($db);

?>

<?php if(isset($_SESSION['success'])): echo $_SESSION['success'];unset($_SESSION['success']); endif;?> 
<?php if(isset($_SESSION['error'])): echo $_SESSION['error'];unset($_SESSION['error']); endif;?> 


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-danger h3 d-flex justify-content-between">
                <span>Manage Co-Admin</span>
                <span><a href="registerUser.php" class="btn btn-inverse-info btn-sm">Back</a></span>
            </div>
            <div class="card-body p-3">
                <div class="table-responsive">
                <table class="table table-hover" id="regUsersTable">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>User name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(!empty($coAdmins)):
                            foreach($coAdmins as $coAdmin):
                                if($coAdmin['status'] === 'block'):
                        ?>
                        <tr>
                            <td><img src="../<?= $coAdmin['image']; ?>" alt="No-image" style="width:60px;height:60px;"></td>
                            <td><?= $coAdmin['username']; ?></td>
                            <td><?= $coAdmin['email']; ?></td>
                            <td><?= $coAdmin['mobile']; ?></td>
                            <td><?= $coAdmin['address']; ?></td>
                            <td>
                                <a href="coAdminCode.php?action=unblock&id=<?= $coAdmin['id']; ?>" class="btn btn-inverse-primary btn-sm">Restore</a>
                            </td>
                            
                        </tr>
                        <?php endif; endforeach; else: ?>
                            <td colspan="8" class="text-danger font-weight-bold">USER NOT AVAILABLE</td>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/foot.php'; ?>