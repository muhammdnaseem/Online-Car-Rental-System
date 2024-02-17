<?php 
require_once 'includes/head.php';
require_once 'includes/database.php';
require_once 'reserveCode.php';

$newReserve = getReserve($db);

?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-danger h3">Cancelled Reserves</div>
            <div class="card-body p-3">
                <div class="table-responsive">
                <table class="table table-hover" id="cancelBookingTable">
                    <thead>
                        <tr>
                            <th>Reserve#</th>
                            <th>Name</th>
                            <th>Vehicle</th>
                
                            <th>From Location</th>
                            <th>To Location</th>
                            <th>Status</th>
                            <th>Booking Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        foreach($newReserve as $reserve):
                            if($reserve['reserveStatus'] == 'cancel'):
                        ?>
                        <tr>
                            <td><?= $reserve['reserveNumber']; ?></td>
                            <td><?= $reserve['username']; ?></td>
                            <td><?= $reserve['car']; ?></td>
                        
                            <td><?= $reserve['fromLocation'] . ' ' . $reserve['selectfromlocation']; ?></td>
                            <td><?= $reserve['toLocation'] . ' ' . $reserve['selecttolocation']; ?></td>
                            <td><span class="badge badge-danger badge-pill">Cancelled</span></td>
                            <td><?= date('d-m-Y H:i:s a',strtotime($reserve['reserveDate'])); ?></td>
                            <td><a href="reserveDetails.php?id=<?= $reserve['reserveId']; ?>" class="btn btn-inverse-info btn-sm">View</a></td>
                        </tr>
                        <?php endif; endforeach; ?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/foot.php'; ?>