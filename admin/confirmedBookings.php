<?php 
require_once 'includes/head.php';
require_once 'includes/database.php';
require_once 'bookingCode.php';

$newBookings = getBookings($db);

?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-danger h3">Confirmed Booking</div>
            <div class="card-body p-3">
                <div class="table-responsive">
                <table class="table table-hover" id="confirmBookingTable">
                    <thead>
                        <tr>
                            <th>Booking#</th>
                            <th>Name</th>
                            <th>Vehicle</th>
                            <th>Driver</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Status</th>
                            <th>Booking Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        foreach($newBookings as $booking):
                            if($booking['bookingStatus'] == 'confirm'):
                        ?>
                        <tr>
                            <td><?= $booking['bookingNumber']; ?></td>
                            <td><?= $booking['username']; ?></td>
                            <td><?= $booking['car']; ?></td>
                            <td><?= $booking['driver']; ?></td>
                            <td><?= $booking['fromDate']; ?></td>
                            <td><?= $booking['toDate']; ?></td>
                            <td><span class="badge badge-success badge-pill">Confirmed</span></td>
                            <td><?= date('d-m-Y H:i:s a',strtotime($booking['bookingDate'])); ?></td>
                            <td><a href="bookingDetails.php?id=<?= $booking['bookingId']; ?>" class="btn btn-inverse-info btn-sm">View</a></td>
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