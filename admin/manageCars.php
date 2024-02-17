<?php 
require_once 'registerCarCode.php';
$vehicles = getVehicles($db);

require_once 'includes/head.php';

if (isset($_SESSION['success'])) : echo $_SESSION['success'];
unset($_SESSION['success']);
endif;

if (isset($_SESSION['error'])) : echo $_SESSION['error'];
unset($_SESSION['error']);
endif; 

?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Manage Cars</div>
            <div class="card-body p-3">
                <div class="table-responsive">
            <table class="table table-hover" id="manageCarsTable">
                <thead>
                    <tr>
                        <th>Vehicle Title</th>
                        <th>Brand</th>
                        <th>Price per day</th>
                        <th>Fuel Type</th>
                        <th>Model Year</th>
                        <th>Status</th>
                        <?php if($_SESSION['userType'] === 'admin'): ?>
                        <th>Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($vehicles as $vehicle): ?>
                    <tr>
                        <td><?= $vehicle['carName']; ?></td>
                        <td><?= $vehicle['brandName']; ?></td>
                        <td><?= $vehicle['pricePerDay']; ?></td>
                        <td><?= $vehicle['fuelType']; ?></td>
                        <td><?= $vehicle['makeYear']; ?></td>
                        <td>
                            <?php if($vehicle['carStatus'] === 'block'): ?>
                                <a href="registerCarCode.php?type=status&page=registerCar&action=block&id=<?= $vehicle['id']; ?>" class="btn btn-inverse-danger btn-sm">Block</a>
                            <?php else: ?>
                                <a href="registerCarCode.php?type=status&page=registerCar&action=unblock&id=<?= $vehicle['id']; ?>" class="btn btn-inverse-success btn-sm">Unblock</a>
                            <?php endif; ?>
                        </td>
                        <?php if($_SESSION['userType'] === 'admin'): ?>
                        <td>
                            <a href="editCar.php?page=editCar&action=getRow&id=<?= $vehicle['id']; ?>" class="btn btn-inverse-primary btn-sm">Edit</a>
                            <a href="registerCarCode.php?page=registerCar&action=deleteRow&id=<?= $vehicle['id']; ?>" class="btn btn-inverse-danger btn-sm" onclick="return confirm('Are you sure to delete it?')">Delete</a>
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
</div>

<?php require_once 'includes/foot.php'; ?>