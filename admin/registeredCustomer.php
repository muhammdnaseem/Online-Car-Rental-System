<?php 
require_once 'includes/database.php';
require_once 'userCode.php';
require_once 'includes/head.php';

$users = getUsers($db);

?>

<?php if(isset($_SESSION['success'])): echo $_SESSION['success'];unset($_SESSION['success']); endif;?> 
<?php if(isset($_SESSION['error'])): echo $_SESSION['error'];unset($_SESSION['error']); endif;?> 


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-danger h3">Registered Customers</div>
            <div class="card-body p-3">
                <table class="table table-hover" id="blockUsersTable">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>User name</th>
                            <th>Email</th>
                            <th>Cnic</th>
                            <th>DOB</th>
                            <th>Mobile</th>
                            <th>Country</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(!empty($users)):
                            foreach($users as $user):
                                if($user['status'] === 'unblock'):
                        ?>
                        <tr>
                            <td><img src="../<?= $user['userImage']; ?>" alt="No Image Set" style="width:60px;height:60px;"></td>
                            <td><?= $user['fullName']; ?></td>
                            <td><?= $user['email']; ?></td>
                            <td><?= $user['cnic']; ?></td>
                            <td><?= date('d/m/Y',strtotime($user['dob'])); ?></td>
                            <td><?= $user['contactNo']; ?></td>
                            <td><?= $user['country']; ?></td> 
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

<?php require_once 'includes/foot.php'; ?>