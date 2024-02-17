<?php 
require_once 'includes/database.php';
require_once 'includes/head.php';
require_once 'reserveCode.php';

$data = $_REQUEST;

if(!empty($data['action']))
{
    if($data['action'] == 'confirm' || $data['action'] == 'cancel')
    {
        changeReserveStatus($db,$data['action'],$data['id']);
    }
}


$result = array();
$fromLocation = '';
$toLocation = '';
$id = '';

if(!empty($data))
{
    $id = $_GET['id'];
    $reserveDetails = getReserve($db,$id);
    $result = mysqli_fetch_assoc($reserveDetails);
    // echo '<pre>';
    // print_r($result);
    // exit;
   

    // echo $result['toDate'];
}

?>

<h3 class='page-title mb-3'>
     <span class='page-title-icon bg-gradient-primary text-white me-2'>
        <a href='newReserve.php' class='text-light'><i class='mdi mdi-arrow-left-bold'></i></a>
    </span>Reserving Details
</h3>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-danger h3">Reserving Details</div>
            <div class="card-body p-3">
                <h2 class="card-title text-info text-center">#<?= $result['reserveNumber']; ?> Reserving Details</h2>
        <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Reserving No</th>
                            <td><?= $result['reserveNumber']; ?></td>
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
                            <th scope="row">Reserve Date</th>
                            <td><?= $result['reserveDate'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">From Location</th>
                            <td><?= $result['fromLocation'] ?></td>
                            <th scope="row">To Location</th>
                            <td><?= $result['toLocation'] ?></td>
                        </tr>
                        
                        
                       <tr>
                            <th scope="row">Reserve Status</th>
                            <td>
                                <?php if($result['reserveStatus'] == 'notConfirm'): ?>
                                    <span class="badge badge-info">Not Comfirmed Yet</span>
                                <?php endif; ?>

                                <?php if($result['reserveStatus'] == 'confirm'): ?>
                                    <span class="badge badge-success">Comfirmed</span>
                                <?php endif; ?>
                                
                                <?php if($result['reserveStatus'] == 'cancel'): ?>
                                    <span class="badge badge-danger">Cancelled</span>
                                <?php endif; ?>

                            </td>
                            <th scope="row">Last Updation Date</th>
                            <td><?php if(empty($result['lastUpdationDate'])){ echo "Not set"; }else{ echo $result['lastUpdationDate']; } ?></td>
                        </tr>
                        <?php if($result['reserveStatus'] == 'notConfirm'): ?>
                        <tr>
                            <td colspan="4" class="text-center">
                                <a href="reserveDetails.php?action=confirm&id=<?= $id; ?>" class="btn btn-inverse-primary btn-lg">Confirm</a>
                                <a href="reserveDetails.php?action=cancel&id=<?= $id; ?>" class="btn btn-inverse-danger btn-lg">Cancel</a>
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