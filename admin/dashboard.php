<?php 
require_once 'includes/head.php';
require_once 'includes/database.php';
require_once 'includes/adminMethods.php';
?>


<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
      <i class="mdi mdi-home"></i>
    </span> Dashboard
  </h3>
</div>

<div class="row mb-0">

  <div class="col-md-6 stretch-card">
    <div class="card bg-gradient-primary card-img-holder text-white h-75">
      <div class="card-body">
        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
        <h4 class="font-weight-normal mb-3 h3">Active Cars <i class="mdi mdi-car float-right" style="font-size: 50px;"></i>
        </h4>
        <h1 class="mb-5"><?= availableCars($db); ?></h1>
      </div>
    </div>
  </div>

  <div class="col-md-6 stretch-card">
    <div class="card bg-gradient-info card-img-holder text-white h-75">
      <div class="card-body">
        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
        <h4 class="font-weight-normal mb-3 h3">Blocked Cars <i class="mdi mdi-block-helper float-right" style="font-size: 50px;"></i>
        </h4>
        <h1 class="mb-5"><?= blockCars($db); ?></h1>
      </div>
    </div>
  </div>

  <div class="col-md-6 stretch-card">
    <div class="card bg-gradient-success card-img-holder text-white h-75">
      <div class="card-body">
        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
        <h4 class="font-weight-normal mb-3 h3">Active Users <i class="mdi mdi-account-multiple float-right" style="font-size: 50px;"></i>
        </h4>
        <h2 class="mb-5"><?= activeUsers($db); ?></h2>
      </div>
    </div>
  </div>
  
  <div class="col-md-6 stretch-card">
    <div class="card bg-gradient-danger card-img-holder text-white h-75">
      <div class="card-body">
        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
        <h4 class="font-weight-normal mb-3 h3">Blocked Users <i class="mdi mdi-block-helper float-right" style="font-size: 50px;"></i>
        </h4>
        <h2 class="mb-5"><?= blockUsers($db); ?></h2>
      </div>
    </div>
  </div>
  
</div>



<?php include_once 'includes/foot.php'; ?>