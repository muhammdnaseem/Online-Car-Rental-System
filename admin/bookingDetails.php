<?php 
require_once 'includes/database.php';
require_once 'includes/head.php';
require_once 'bookingCode.php';

$data = $_REQUEST;

if(!empty($data['action']))
{
    if($data['action'] == 'confirm' || $data['action'] == 'cancel')
    {
        changeOrderStatus($db,$data['action'],$data['id']);
    }
}


$result = array();
$fromDate = '';
$toDate = '';
$id = '';

if(!empty($data))
{
    $id = $_GET['id'];
    $bookingDetails = getBookings($db,$id);
    $result = mysqli_fetch_assoc($bookingDetails);
    // echo '<pre>';
    // print_r($result);
    // exit;
    $fromDate = date_create($result['fromDate']);
    $toDate = date_create($result['toDate']);
    $totalDays =  date_diff($fromDate,$toDate);

    // echo $result['toDate'];
}

?>

<h3 class='page-title mb-3'>
     <span class='page-title-icon bg-gradient-primary text-white me-2'>
        <a href='newBookings.php' class='text-light'><i class='mdi mdi-arrow-left-bold'></i></a>
    </span>Booking Details
</h3>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-danger h3">Booking Details</div>
            <div class="card-body p-3">
                <h2 class="card-title text-info text-center">#123132 Booking Details</h2>
        <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th colspan="4" class="text-center">
                                <h4>User Details</h4>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Booking No</th>
                            <td><?= $result['bookingNumber']; ?></td>
                            <th scope="row">Name</th>
                            <td><?= $result['fullName']; ?></td>
                        </tr>
                         <tr>
                            <th scope="row">Email</th>
                            <td><?= $result['email'] ?></td>
                            <th scope="row">Contact</th>
                            <td><?= $result['contactNo'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Address</th>
                            <td><?= $result['address'] ?></td>
                            <th scope="row">City</th>
                            <td><?= $result['city'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Country</th>
                            <td colspan="3"><?= $result['country'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-center">
                                <h4>Booking Details</h4>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Vehicle Name</th>
                            <td><?= $result['car'] ?></td>
                            <th scope="row">Booking Date</th>
                            <td><?= $result['bookingDate'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">From Date</th>
                            <td><?= date('d/m/Y',strtotime($result['fromDate'])) ?></td>
                            <th scope="row">To Date</th>
                            <td><?= date('d/m/Y',strtotime($result['toDate'])) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Total Days</th>
                            <td><?= $totalDays->days; ?></td>
                            <th scope="row">Rent Per Day</th>
                            <td><?= $result['pricePerDay'] ?></td>
                        </tr>
                        <tr>
                            <th class="text-center" colspan="3">
                                <h5>Grand Total</h5>
                            </th>
                            <td><?= $result['pricePerDay'] * $totalDays->days; ?></td>
                        </tr>
                       <tr>
                            <th scope="row">Booking Status</th>
                            <td>
                                <?php if($result['bookingStatus'] == 'notConfirm'): ?>
                                    <span class="badge badge-info">Not Comfirmed Yet</span>
                                <?php endif; ?>

                                <?php if($result['bookingStatus'] == 'confirm'): ?>
                                    <span class="badge badge-success">Comfirmed</span>
                                <?php endif; ?>
                                
                                <?php if($result['bookingStatus'] == 'cancel'): ?>
                                    <span class="badge badge-danger">Cancelled</span>
                                <?php endif; ?>

                            </td>
                            <th scope="row">Last Updation Date</th>
                            <td><?php if(empty($result['lastUpdationDate'])){ echo "Not set"; }else{ echo $result['lastUpdationDate']; } ?></td>
                        </tr>
                        <?php if($result['bookingStatus'] == 'notConfirm'): ?>
                        <tr>
                            <td colspan="4" class="text-center">
                                <a href="bookingDetails.php?action=confirm&id=<?= $id; ?>" class="btn btn-inverse-primary btn-lg">Confirm</a>
                                <a href="bookingDetails.php?action=cancel&id=<?= $id; ?>" class="btn btn-inverse-danger btn-lg">Cancel</a>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/foot.php'; ?>