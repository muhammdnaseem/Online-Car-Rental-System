<?php 
require_once 'includes/database.php';
require_once 'brandsCode.php';
require_once 'includes/head.php';

$carBrands = getBrands($db);

?>
<?php if(isset($_SESSION['success'])): echo $_SESSION['success'];unset($_SESSION['success']); endif;?> 
<?php if(isset($_SESSION['error'])): echo $_SESSION['error'];unset($_SESSION['error']); endif;?> 


<div class="row">
    <div class="col-md-12  col-sm-10">
        <form action="registerCarCode.php" method="POST" enctype="multipart/form-data">
        <div class="card">
            <div class="card-header h4 text-danger font-weight-bold">Register New Car</div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="brandId" class="form-label">Car Brand <span class="text-danger font-weight-bold">*</span></label>
                                <select name="brandId" id="brandId" class="form-control" required>
                                    <option value="">Select</option>
                                    <?php 
                                        foreach($carBrands as $brand):
                                            if($brand['status'] != 'block'):
                                    ?>
                                        <option value="<?= $brand['id']; ?>"><?= $brand['brand_name']; ?></option>
                                    <?php endif; endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="carName" class="form-label">Car Title <span class="text-danger font-weight-bold">*</span></label>
                                <input required type="text" name="carName" id="carName" class="form-control" placeholder="Input car name">
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="pricePerDay" class="form-label">Price Per Day(in PKR) <span class="text-danger font-weight-bold">*</span></label>
                                <input required type="number" min="1" name="pricePerDay" id="pricePerDay" class="form-control" placeholder="Input price">

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="makeYear" class="form-label">Make Year <span class="text-danger font-weight-bold">*</span></label>
                                <input required type="number" min="1" name="makeYear" id="makeYear" class="form-control" placeholder="Input model">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="seatCapacity" class="form-label">Seating Capacity <span class="text-danger font-weight-bold">*</span></label>
                                <input required type="number" min="1" name="seatCapacity" id="seatCapacity" class="form-control" placeholder="Input capacity">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fuelType" class="form-label">Select Fuel Type <span class="text-danger font-weight-bold">*</span></label>
                                <select name="fuelType" id="fuelType" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="petrol">Petrol</option>
                                    <option value="deisel">Deisel</option>
                                    <option value="hybird">Hybird</option>
                                    <option value="cng">CNG</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Car Image One <span class="text-danger font-weight-bold">*</span></label>
                                <input required type="file" name="imageOne" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input required type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-inverse-primary py-2" type="button">Upload</button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Car Image Two <span class="text-danger font-weight-bold">*</span></label>
                                <input required type="file" name="imageTwo" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input required type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-inverse-primary py-2" type="button">Upload</button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Car Image Three <span class="text-danger font-weight-bold">*</span></label>
                                <input required type="file" name="imageThree" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input required type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-inverse-primary py-2" type="button">Upload</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Car Image Four <span class="text-danger font-weight-bold">*</span></label>
                                <input required type="file" name="imageFour" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input required type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-inverse-primary py-2" type="button">Upload</button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Car Image Five <span class="text-danger font-weight-bold">*</span></label>
                                <input required type="file" name="imageFive" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input required type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-inverse-primary py-2" type="button">Upload</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="carDesc" class="form-label">Car Description <span class="text-danger font-weight-bold">*</span></label>
                                <textarea required name="carDesc" id="carDesc" class="form-control" placeholder="Input car description" max="120"></textarea>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header text-danger font-weight-bold h4">Accessories</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="checkbox" name="airConditioner" id="airConditioner"> 
                                <label for="airConditioner" class="form-label">Air Conditioner</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="checkbox" name="powerLockDoor" id="powerLockDoor"> 
                                <label for="powerLockDoor" class="form-label">Power Lock Door</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="checkbox" name="ABS" id="ABS"> 
                                <label for="ABS" class="form-label">Anti Breaking System</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="checkbox" name="breakAssist" id="breakAssist"> 
                                <label for="breakAssist" class="form-label">Break Assist</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="checkbox" name="powerSteering" id="powerSteering"> 
                                <label for="powerSteering" class="form-label">Power Steering</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="checkbox" name="driverAirbag" id="driverAirbag"> 
                                <label for="driverAirbag" class="form-label">Driver Airbag</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="checkbox" name="passengerAirbag" id="passengerAirbag"> 
                                <label for="passengerAirbag" class="form-label">Passenger Airbag</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="checkbox" name="powerWindow" id="powerWindow"> 
                                <label for="powerWindow" class="form-label">Power Windows</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="checkbox" name="cdPlayer" id="cdPlayer"> 
                                <label for="cdPlayer" class="form-label">CD Player</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="checkbox" name="centralLocking" id="centralLocking"> 
                                <label for="centralLocking" class="form-label">Central Locking</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="checkbox" name="crashSensor" id="crashSensor"> 
                                <label for="crashSensor" class="form-label">Crash Sensor</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="checkbox" name="leatherSeats" id="leatherSeats"> 
                                <label for="leatherSeats" class="form-label">Leather Seats</label>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col d-flex justify-content-end">
                        <input type="hidden" name="page" value="registerCar">
                        <input type="hidden" name="action" value="addCar">
                        <input type="submit" value="Save" class="btn btn-inverse-info ml-auto">
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- card End -->
    </div>
</div>

<?php require_once 'includes/foot.php'; ?>