<?php 
require_once 'includes/database.php';
require_once 'includes/head.php';

$drivers = mysqli_query($db,"SELECT * FROM driver WHERE status='Pending'");

?>

<?php if(isset($_SESSION['success'])): echo $_SESSION['success'];unset($_SESSION['success']); endif;?> 
<?php if(isset($_SESSION['error'])): echo $_SESSION['error'];unset($_SESSION['error']); endif;?> 


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-danger h3">Driver Management</div>
            <div class="card-body p-3">
                <div class="table-responsive">
                <table class="table table-hover" id="blockUsersTable">
                    <thead>
                        <tr>
                            <th>User name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>License</th>
                            <th>City</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(!empty($drivers)):
                            foreach($drivers as $list):
                        ?>
                        <tr>
                            <td><?= $list['fullname']; ?></td>
                            <td><?= $list['mobile']; ?></td>
                            <td><?= $list['email']; ?></td>
                            <td><?= $list['license']; ?></td>
                            <td><?= $list['city']; ?></td>
                            <td><a href="driverCode.php?action=status&id=<?= $list['id']; ?>" onclick="return confirm('Do you really want to accept him as a driver?');" class="btn btn-inverse-info">Pending</a></td>
                            <td>
                                <a onclick="return confirm('Are you sure to delete?');" href="driverCode.php?action=delete&id=<?= $list['id']; ?>" class="btn btn-inverse-danger">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/foot.php'; ?>