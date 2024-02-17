<?php

if(!session_id()){
  session_start();
}

if(!isset($_SESSION['loginId']))
{
  header('location:index.php');
}
require_once 'database.php';

function newBookings($db)
{
  $sql = "SELECT COUNT(*) AS totalNew FROM bookings WHERE bookingStatus='notConfirm'";
  $result = mysqli_query($db,$sql);
  if(mysqli_num_rows($result) > 0)
  {
    $count = mysqli_fetch_assoc($result);
    return $count['totalNew'];
  }
  else
  {
    return 0;
  }
}

$getReserve = mysqli_query($db,"SELECT reserve.reserveStatus,reserve.message,users.fullName FROM reserve JOIN users ON users.id=reserve.userId WHERE reserveStatus='notConfirm'");



function newReserve($db)
{
  $sql = "SELECT COUNT(*) AS totalNew FROM reserve WHERE reserveStatus='notConfirm'";
  $result = mysqli_query($db,$sql);
  if(mysqli_num_rows($result) > 0)
  {
    $count = mysqli_fetch_assoc($result);
    return $count['totalNew'];
  }
  else
  {
    return 0;
  }
}

$getReserve = mysqli_query($db,"SELECT reserve.reserveStatus,reserve.message,users.fullName FROM reserve JOIN users ON users.id=reserve.userId WHERE reserveStatus='notConfirm'");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Car Rent System</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/DataTables/css/datatables.min.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
    <style>
    .choose{
        transition: .3s linear;
    }
    .choose:hover{
        transform: scale(1.1);
    }
</style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        
        <div class="navbar-menu-wrapper d-flex align-items-stretch w-100">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>

          <!-- Search area -->
          <!-- <div class="search-field d-none d-md-block">
            <form class="d-flex align-items-center h-100" action="#">
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
              </div>
            </form>
          </div> -->
    
          <ul class="navbar-nav navbar-nav-right w-50 d-flex justify-content-end">

          <li class="nav-item d-none d-lg-block full-screen-link">
              <a class="nav-link">
                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
              </a>
            </li>


          <li class="nav-item dropdown" style="position:relative;">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                <i class="mdi mdi-bell-outline"></i>
                <span class="badge badge-danger badge-pill" style="margin-top:-15px;"><?= newReserve($db); ?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown" style="position:absolute;width:300px;">
                <h6 class="p-3 mb-0">Notifications</h6>
                <div class="dropdown-divider"></div>
                <?php foreach($getReserve as $alertInfo): ?>
                  <a href="newReserve.php" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                      <i class="mdi mdi-calendar"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1"><?= $alertInfo['fullName']; ?></h6>
                    <p class="text-gray ellipsis mb-0"> <?= $alertInfo['message']; ?> </p>
                  </div>
                </a>
                <?php endforeach; ?>
                <div class="dropdown-divider"></div>
                <h6 class="p-3 mb-0 text-center"><a href="newReserve.php"> See all Reserves</a></h6>
                <h6 class="p-3 mb-0 text-center"><a href="newBookings.php"> See all Bookings</a></h6>
                
              </div>
            </li>


            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="../<?= $_SESSION['profileImage']; ?>" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black"><?= $_SESSION['adminName']; ?></p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="profile.php">
                  <i class="mdi mdi-cached me-2 text-success"></i> Profile Settings </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="changePassword.php">
                  <i class="mdi mdi-cached me-2 text-success"></i> Change Password </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                  <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
              </div>
            </li>


            
            
          </ul>

          
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <?php if($_SESSION['userType'] === 'admin'): ?>  
        <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="profile.php" class="nav-link">
                <div class="nav-profile-image">
                  <img src="../<?= $_SESSION['profileImage']; ?>" alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2 text-capitalize">
                    <?= $_SESSION['adminName']; ?>
                  </span>
                </div>
                <i class="mdi mdi-account-box menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="brands.php">
                <span class="menu-title">Brand Management</span>
                <i class="mdi mdi-apps menu-icon"></i>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Car Management</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-car menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="registerCar.php">Register Car</a></li>
                  <li class="nav-item"> <a class="nav-link" href="manageCars.php">Manage Car</a></li>
                </ul>
              </div>
            </li>
            
            
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#booking" aria-expanded="false" aria-controls="booking">
                <span class="menu-title">Car Bookings</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-car-connected menu-icon"></i>
              </a>
              <div class="collapse" id="booking">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="newBookings.php">New</a></li>
                  <li class="nav-item"> <a class="nav-link" href="confirmedBookings.php">Confirmed</a></li>
                  <li class="nav-item"> <a class="nav-link" href="cancelledBookings.php">Cancel</a></li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#reserve" aria-expanded="false" aria-controls="reserve">
                <span class="menu-title">Car Reserves</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-car-connected menu-icon"></i>
              </a>
              <div class="collapse" id="reserve">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="newReserve.php">New</a></li>
                  <li class="nav-item"> <a class="nav-link" href="confirmedReserve.php">Confirmed</a></li>
                  <li class="nav-item"> <a class="nav-link" href="cancelledReserve.php">Cancel</a></li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#drivermanage" aria-expanded="false" aria-controls="drivermanage">
                <span class="menu-title">Driver Management</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-multiple menu-icon"></i>
              </a>
              <div class="collapse" id="drivermanage">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> 
                    <a class="nav-link" href="manageDriver.php">New Requests</a>
                  </li>
                  <li class="nav-item"> 
                    <a class="nav-link" href="registeredDrivers.php">Registered Drivers</a>
                  </li>
                  <!-- <li class="nav-item"> 
                    <a class="nav-link" href="">Manage Permissions</a>
                  </li> -->
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#usermanage" aria-expanded="false" aria-controls="usermanage">
                <span class="menu-title">Users Management</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-multiple menu-icon"></i>
              </a>
              <div class="collapse" id="usermanage">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> 
                    <a class="nav-link" href="registerUser.php">Add Co-Admin</a>
                  </li>
                  <li class="nav-item"> 
                    <a class="nav-link" href="registeredCustomer.php">Registered Customers</a>
                  </li>
                  <!-- <li class="nav-item"> 
                    <a class="nav-link" href="">Manage Permissions</a>
                  </li> -->
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="companyProfile.php">
                <span class="menu-title">Company Profile</span>
                <i class="mdi mdi-sale menu-icon"></i>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="contacts.php">
                <span class="menu-title">Contacts Management</span>
                <i class="mdi mdi-contact-mail menu-icon"></i>
              </a>
            </li>

            




          </ul>
          <?php else: ?>
            <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="profile.php" class="nav-link">
                <div class="nav-profile-image">
                  <img src="../<?= $_SESSION['profileImage']; ?>" alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2 text-capitalize">
                    <?= $_SESSION['adminName']; ?>
                  </span>
                </div>
                <i class="mdi mdi-account-box menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="brands.php">
                <span class="menu-title">Brand Management</span>
                <i class="mdi mdi-apps menu-icon"></i>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Car Management</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-car menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="registerCar.php">Register Car</a></li>
                  <li class="nav-item"> <a class="nav-link" href="manageCars.php">Manage Car</a></li>
                </ul>
              </div>
            </li>
            
            
            
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#booking" aria-expanded="false" aria-controls="booking">
                <span class="menu-title">Car Bookings</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-car-connected menu-icon"></i>
              </a>
              <div class="collapse" id="booking">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="newBookings.php">New</a></li>
                  <li class="nav-item"> <a class="nav-link" href="confirmedBookings.php">Confirmed</a></li>
                  <li class="nav-item"> <a class="nav-link" href="cancelledBookings.php">Cancel</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contacts.php">
                <span class="menu-title">Contacts Management</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>

          </ul>
          <?php endif; ?>
        
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">