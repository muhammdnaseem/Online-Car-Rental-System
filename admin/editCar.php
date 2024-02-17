<?php
require_once 'includes/database.php';
require_once 'registerCarCode.php';
require_once 'includes/head.php';

$url = $_REQUEST;
$carId = $url['id'];
$vehicleDetails = mysqli_fetch_assoc(getVehicles($db, $carId));

$carBrands = mysqli_query($db, "SELECT * FROM brands WHERE status='unblock'");
?>



<?php if (isset($_SESSION['success'])) : echo $_SESSION['success'];
unset($_SESSION['success']);
endif; ?>
<?php if (isset($_SESSION['error'])) : echo $_SESSION['error'];
unset($_SESSION['error']);
endif; ?>

<h3 class='page-title mb-3'>
     <span class='page-title-icon bg-gradient-primary text-white me-2'>
        <a href='manageCars.php' class='text-light'><i class='mdi mdi-arrow-left-bold'></i></a>
    </span>Update Car
</h3>

<div class="row">
    <div class="col-md-12  col-sm-10">
        <form action="registerCarCode.php" method="POST">
            <div class="card">
                <div class="card-header text-danger font-weight-bold">Update Car Details</div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="brandId" class="form-label">Update Car Brand <span class="text-danger font-weight-bold">*</span></label>
                                <select name="brandId" id="brandId" class="form-control">
                                    <option value="">Select</option>
                                    <?php
                                    foreach ($carBrands as $brand) :
                                    ?>
                                        <option <?php if ($vehicleDetails['brandName'] == $brand['brand_name']) : echo 'selected';
                                                endif; ?> value="<?= $brand['id']; ?>"><?= $brand['brand_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="carName" class="form-label">Update Car Title <span class="text-danger font-weight-bold">*</span></label>
                                <input required type="text" name="carName" id="carName" class="form-control" placeholder="Input car name" value="<?= $vehicleDetails['carName']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="pricePerDay" class="form-label">Update Price Per Day(in PKR) <span class="text-danger font-weight-bold">*</span></label>
                                <input required type="number" min="1" name="pricePerDay" id="pricePerDay" class="form-control" placeholder="Input price" value="<?= $vehicleDetails['pricePerDay']; ?>">

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="makeYear" class="form-label">Update Make Year <span class="text-danger font-weight-bold">*</span></label>
                                <input required type="number" min="1" name="makeYear" id="makeYear" class="form-control" placeholder="Input model" value="<?= $vehicleDetails['makeYear']; ?>">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="seatCapacity" class="form-label">Update Seating Capacity <span class="text-danger font-weight-bold">*</span></label>
                                <input required type="number" min="1" name="seatCapacity" id="seatCapacity" class="form-control" placeholder="Input capacity" value="<?= $vehicleDetails['seatCapacity']; ?>">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fuelType" class="form-label">Update Select Fuel Type <span class="text-danger font-weight-bold">*</span></label>
                                <select name="fuelType" id="fuelType" class="form-control">
                                    <option value="">Select</option>
                                    <option <?php if ($vehicleDetails['fuelType'] == 'petrol') {
                                                echo 'selected';
                                            } ?> value="petrol">Petrol</option>
                                    <option <?php if ($vehicleDetails['fuelType'] == 'deisel') {
                                                echo 'selected';
                                            } ?> value="deisel">Deisel</option>
                                    <option <?php if ($vehicleDetails['fuelType'] == 'hybird') {
                                                echo 'selected';
                                            } ?> value="hybird">Hybird</option>
                                    <option <?php if ($vehicleDetails['fuelType'] == 'cng') {
                                                echo 'selected';
                                            } ?> value="cng">CNG</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <!-- Images Area -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Update Car Image One <span class="text-danger font-weight-bold">*</span></label>
                                <img class="vehicleImages" src="../<?= $vehicleDetails['imageOne'] ?>" alt="">
                                <a href="updateImage.php?page=editCar&action=changeImage&updateImage=imageOne&id=<?= $vehicleDetails['id']; ?>" class="btn btn-inverse-info choose" style="margin-left:12px;">Change Image</a>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Update Car Image Two <span class="text-danger font-weight-bold">*</span></label>
                                <img class="vehicleImages" src="../<?= $vehicleDetails['imageTwo'] ?>" alt="">
                                <a href="updateImage.php?page=editCar&action=changeImage&updateImage=imageTwo&id=<?= $vehicleDetails['id']; ?>" class="btn btn-inverse-info choose" style="margin-left:12px;">Change Image</a>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Update Car Image Three <span class="text-danger font-weight-bold">*</span></label>
                                <img class="vehicleImages" src="../<?= $vehicleDetails['imageThree'] ?>" alt="">
                                <a href="updateImage.php?page=editCar&action=changeImage&updateImage=imageThree&id=<?= $vehicleDetails['id']; ?>" class="btn btn-inverse-info choose" style="margin-left:12px;">Change Image</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Update Car Image Four <span class="text-danger font-weight-bold">*</span></label>
                                <img class="vehicleImages" src="../<?= $vehicleDetails['imageFour'] ?>" alt="">
                                <a href="updateImage.php?page=editCar&action=changeImage&updateImage=imageFour&id=<?= $vehicleDetails['id']; ?>" class="btn btn-inverse-info choose" style="margin-left:12px;">Change Image</a>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Update Car Image Five <span class="text-danger font-weight-bold">*</span></label>
                                <img class="vehicleImages" src="../<?= $vehicleDetails['imageFive'] ?>" alt="">
                                <a href="updateImage.php?page=editCar&action=changeImage&updateImage=imageFive&id=<?= $vehicleDetails['id']; ?>" class="btn btn-inverse-info choose" style="margin-left:12px;">Change Image</a>
                            </div>
                        </div>
                    </div>
                    <!-- Images Area End -->

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="carDesc" class="form-label">Update Car Description <span class="text-danger font-weight-bold">*</span></label>
                                <textarea required name="carDesc" id="carDesc" class="form-control" placeholder="Input car description"><?= $vehicleDetails['carDesc'] ?></textarea>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header text-danger font-weight-bold">Update Accessories</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="checkbox" name="airConditioner" id="airConditioner" <?php if($vehicleDetails['airConditioner'] == 'on'){ echo 'checked';} ?> >
                                <label for="airConditioner" class="form-label">Air Conditioner</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="checkbox" name="powerLockDoor" id="powerLockDoor" <?php if($vehicleDetails['powerLockDoor'] == 'on'){ echo 'checked';} ?>>
                                <label for="powerLockDoor" class="form-label">Power Lock Door</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="checkbox" name="ABS" id="ABS" <?php if($vehicleDetails['ABS'] == 'on'){ echo 'checked';} ?>>
                                <label for="ABS" class="form-label">Anti Breaking System</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="checkbox" name="breakAssist" id="breakAssist" <?php if($vehicleDetails['breakAssist'] == 'on'){ echo 'checked';} ?>>
                                <label for="breakAssist" class="form-label">Break Assist</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="checkbox" name="powerSteering" id="powerSteering" <?php if($vehicleDetails['powerSteering'] == 'on'){ echo 'checked';} ?> >
                                <label for="powerSteering" class="form-label">Power Steering</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="checkbox" name="driverAirbag" id="driverAirbag" <?php if($vehicleDetails['driverAirbag'] == 'on'){ echo 'checked';} ?> >
                                <label for="driverAirbag" class="form-label">Driver Airbag</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="checkbox" name="passengerAirbag" id="passengerAirbag" <?php if($vehicleDetails['passengerAirbag'] == 'on'){ echo 'checked';} ?> >
                                <label for="passengerAirbag" class="form-label">Passenger Airbag</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="checkbox" name="powerWindow" id="powerWindow" <?php if($vehicleDetails['powerWindow'] == 'on'){ echo 'checked';} ?> >
                                <label for="powerWindow" class="form-label">Power Windows</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="checkbox" name="cdPlayer" id="cdPlayer" <?php if($vehicleDetails['cdPlayer'] == 'on'){ echo 'checked';} ?> >
                                <label for="cdPlayer" class="form-label">CD Player</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="checkbox" name="centralLocking" id="centralLocking" <?php if($vehicleDetails['centralLocking'] == 'on'){ echo 'checked';} ?> >
                                <label for="centralLocking" class="form-label">Central Locking</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="checkbox" name="crashSensor" id="crashSensor" <?php if($vehicleDetails['crashSensor'] == 'on'){ echo 'checked';} ?> >
                                <label for="crashSensor" class="form-label">Crash Sensor</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="checkbox" name="leatherSeats" id="leatherSeats" <?php if($vehicleDetails['leatherSeats'] == 'on'){ echo 'checked';} ?> >
                                <label for="leatherSeats" class="form-label">Leather Seats</label>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col">
                            <input type="hidden" name="page" value="editCar">
                            <input type="hidden" name="action" value="updateCar">
                            <input type="hidden" name="id" value="<?= $vehicleDetails['id']; ?>">
                            <a href="manageCars.php" class="btn btn-inverse-primary">Cancel</a>
                            <input type="submit" value="Update" class="btn btn-inverse-info">
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- card End -->
    </div>
</div>

<?php require_once 'includes/foot.php'; ?>