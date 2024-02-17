<?php 
require_once 'includes/database.php';
require_once 'includes/head.php';

$contacts = mysqli_query($db,"SELECT * FROM contacts");

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
                            <th>User name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(!empty($contacts)):
                            foreach($contacts as $list):
                        ?>
                        <tr>
                            <td><?= $list['fullName']; ?></td>
                            <td><?= $list['email']; ?></td>
                            <td><?= $list['message']; ?></td>
                            <td>
                                <a onclick="return confirm('Are you sure to delete?');" href="contactsCode.php?id=<?= $list['id']; ?>" class="btn btn-inverse-danger">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/foot.php'; ?>