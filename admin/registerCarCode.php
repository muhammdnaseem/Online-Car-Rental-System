<?php
    require_once 'includes/database.php';
    if(!session_id()){
        session_start();
    }
    $carData = $_REQUEST;
    
    if(!empty($carData))
    {
        if(trim($carData['page']) == 'registerCar')
        {
            if(trim($carData['action']) == 'addCar')
            {
                
                $brandId = trim($carData['brandId']);
                $carName = trim($carData['carName']);
                $pricePerDay = trim($carData['pricePerDay']);
                $makeYear = trim($carData['makeYear']);
                $seatCapacity = trim($carData['seatCapacity']);
                $fuelType = trim($carData['fuelType']);
                $imageOne = $_FILES['imageOne'];
                $imageTwo = $_FILES['imageTwo'];
                $imageThree = $_FILES['imageThree'];
                $imageFour = $_FILES['imageFour'];
                $imageFive = $_FILES['imageFive'];
                $carDesc = trim($carData['carDesc']);
                
                // echo "<pre>";
                // print_r($carData);
                // print_r($imageOne);
                // die();
                $imageOne = uploadImage($imageOne);
                $imageTwo = uploadImage($imageTwo);
                $imageThree = uploadImage($imageThree);
                $imageFour = uploadImage($imageFour);
                $imageFive = uploadImage($imageFive);

                if(!empty(trim($carData['airConditioner']))){
                    $airConditioner = 'on';
                }else
                {
                    $airConditioner = 'off';
                }
                if(!empty(trim($carData['powerLockDoor']))){
                    $powerLockDoor = 'on';
                }else
                {
                    $powerLockDoor = 'off';
                }
                if(!empty(trim($carData['ABS']))){
                    $ABS = 'on';
                }else
                {
                    $ABS = 'off';
                }
                if(!empty(trim($carData['breakAssist']))){
                    $breakAssist = 'on';
                }else
                {
                    $breakAssist = 'off';
                }
                if(!empty(trim($carData['powerSteering']))){
                    $powerSteering = 'on';
                }else
                {
                    $powerSteering = 'off';
                }
                if(!empty(trim($carData['driverAirbag']))){
                    $driverAirbag = 'on';
                }else
                {
                    $driverAirbag = 'off';
                }
                if(!empty(trim($carData['passengerAirbag']))){
                    $passengerAirbag = 'on';
                }else
                {
                    $passengerAirbag = 'off';
                }

                if(!empty(trim($carData['powerWindow']))){
                    $powerWindow = 'on';
                }else
                {
                    $powerWindow = 'off';
                }

                if(!empty(trim($carData['cdPlayer']))){
                    $cdPlayer = 'on';
                }else
                {
                    $cdPlayer = 'off';
                }

                if(!empty(trim($carData['centralLocking']))){
                    $centralLocking = 'on';
                }else
                {
                    $centralLocking = 'off';
                }

                if(!empty(trim($carData['crashSensor']))){
                    $crashSensor = 'on';
                }else
                {
                    $crashSensor = 'off';
                }

                if(!empty(trim($carData['leatherSeats']))){
                    $leatherSeats = 'on';
                }else
                {
                    $leatherSeats = 'off';
                }


                $data = [
                    'brandId' => $brandId,
                    'carName' => $carName,
                    'pricePerDay' => $pricePerDay,
                    'makeYear' => $makeYear,
                    'seatCapacity' => $seatCapacity,
                    'fuelType' => $fuelType,
                    'imageOne' => $imageOne,
                    'imageTwo' => $imageTwo,
                    'imageThree' => $imageThree,
                    'imageFour' => $imageFour,
                    'imageFive' => $imageFive,
                    'carDesc' => $carDesc,
                    'airConditioner' => $airConditioner,
                    'powerLockDoor' => $powerLockDoor,
                    'ABS' => $ABS,
                    'breakAssist' => $breakAssist,
                    'powerSteering' => $powerSteering,
                    'driverAirbag' => $driverAirbag,
                    'passengerAirbag' => $passengerAirbag,
                    'powerWindow' => $powerWindow,
                    'cdPlayer' => $cdPlayer,
                    'centralLocking' => $centralLocking,
                    'crashSensor' => $crashSensor,
                    'leatherSeats' => $leatherSeats,
                    'registrationDate' => date('Y/m/d')
                ];

                $columns = implode(',',array_keys($data));
                $values = implode("','",$data);

                $sql = "INSERT INTO registeredcars ($columns) VALUES ('$values')";
                if(mysqli_query($db,$sql))
                {
                    $_SESSION['success'] = '<div class="alert alert-success">Success! Car added successfully.</div>';
                    header('location:registerCar.php');
                }
                else
                {
                    $_SESSION['error'] = '<div class="alert alert-danger">Error! Car added successfully.</div>';
                    header('location:registerCar.php');
                }


            }

            if(trim($carData['action']) == 'deleteRow')
            {
                $id = $_GET['id'];
                $sql = "DELETE FROM registeredcars WHERE id='$id'";
                if(mysqli_query($db,$sql))
                {
                    $_SESSION['success'] = '<div class="alert alert-success">Success! Vehicle deleted successfully.</div>';
                    header('location:manageCars.php');
                }
                else
                {
                    $_SESSION['error'] = '<div class="alert alert-danger">Error! Brand can not deleted.</div>';
                    header('location:manageCars.php');
                }                
            }

            if(isset($_GET['type']) && $_GET['type'] == 'status')
            {
                if(!empty($_GET['action']))
                {
                    $id = $_GET['id'];
                    $next_status = 'block';
                    $action =$_GET['action'];

                    if($action == 'block')
                    {
                        $next_status = 'unblock';
                    }
                    $sql = "UPDATE registeredcars SET carStatus='$next_status' WHERE id='$id'";
                    $result = mysqli_query($db,$sql);
            
                    if($result)
                    {
                        $_SESSION['success'] = '<div class="alert alert-success">Success! Status updated to '.$next_status.' successfully.</div>';
                        header('location:manageCars.php');
                    }
                    else
                    {
                        $_SESSION['error'] = '<div class="alert alert-danger">Error! Status can not update.</div>';
                        header('location:manageCars.php');
                    }
                }
            }
        }

        if(trim($carData['page']) == 'editCar')
        {
            if(trim($carData['action']) == 'updateCar')
            {
                $id = trim($carData['id']);
                $brandId = trim($carData['brandId']);
                $carName = trim($carData['carName']);
                $pricePerDay = trim($carData['pricePerDay']);
                $makeYear = trim($carData['makeYear']);
                $seatCapacity = trim($carData['seatCapacity']);
                $fuelType = trim($carData['fuelType']);
                $carDesc = trim($carData['carDesc']);
                

                if(!empty(trim($carData['airConditioner']))){
                    $airConditioner = 'on';
                }else
                {
                    $airConditioner = 'off';
                }
                if(!empty(trim($carData['powerLockDoor']))){
                    $powerLockDoor = 'on';
                }else
                {
                    $powerLockDoor = 'off';
                }
                if(!empty(trim($carData['ABS']))){
                    $ABS = 'on';
                }else
                {
                    $ABS = 'off';
                }
                if(!empty(trim($carData['breakAssist']))){
                    $breakAssist = 'on';
                }else
                {
                    $breakAssist = 'off';
                }
                if(!empty(trim($carData['powerSteering']))){
                    $powerSteering = 'on';
                }else
                {
                    $powerSteering = 'off';
                }
                if(!empty(trim($carData['driverAirbag']))){
                    $driverAirbag = 'on';
                }else
                {
                    $driverAirbag = 'off';
                }
                if(!empty(trim($carData['passengerAirbag']))){
                    $passengerAirbag = 'on';
                }else
                {
                    $passengerAirbag = 'off';
                }

                if(!empty(trim($carData['powerWindow']))){
                    $powerWindow = 'on';
                }else
                {
                    $powerWindow = 'off';
                }

                if(!empty(trim($carData['cdPlayer']))){
                    $cdPlayer = 'on';
                }else
                {
                    $cdPlayer = 'off';
                }

                if(!empty(trim($carData['centralLocking']))){
                    $centralLocking = 'on';
                }else
                {
                    $centralLocking = 'off';
                }

                if(!empty(trim($carData['crashSensor']))){
                    $crashSensor = 'on';
                }else
                {
                    $crashSensor = 'off';
                }

                if(!empty(trim($carData['leatherSeats']))){
                    $leatherSeats = 'on';
                }else
                {
                    $leatherSeats = 'off';
                }

                $data = [
                    'brandId' => $brandId,
                    'carName' => $carName,
                    'pricePerDay' => $pricePerDay,
                    'makeYear' => $makeYear,
                    'seatCapacity' => $seatCapacity,
                    'fuelType' => $fuelType,
                    'carDesc' => $carDesc,
                    'airConditioner' => $airConditioner,
                    'powerLockDoor' => $powerLockDoor,
                    'ABS' => $ABS,
                    'breakAssist' => $breakAssist,
                    'powerSteering' => $powerSteering,
                    'driverAirbag' => $driverAirbag,
                    'passengerAirbag' => $passengerAirbag,
                    'powerWindow' => $powerWindow,
                    'cdPlayer' => $cdPlayer,
                    'centralLocking' => $centralLocking,
                    'crashSensor' => $crashSensor,
                    'leatherSeats' => $leatherSeats,
                    'updationDate' => date('Y/m/d')
                ];
                
                $args = array();
                foreach($data as $key => $value){
                    $args[] = "$key = '$value'";
                }

                $keyValue = implode(',',$args);

                $sql = "UPDATE registeredcars SET {$keyValue} WHERE id='$id'";
                if(mysqli_query($db,$sql))
                {
                    $_SESSION['success'] = '<div class="alert alert-success">Success! Vehicle updated successfully.</div>';
                    header('location:manageCars.php');
                }
                else
                {
                    $_SESSION['error'] = '<div class="alert alert-danger">Error! Vehicle not updated.</div>';
                    header('location:editCar.php?page=editCar&action=getRow&id='.$id);
                }


            }
        }
    }

    function getVehicles($db,$id=null)
    {
        $sql = "SELECT registeredcars.*,brands.brand_name as brandName FROM registeredcars INNER JOIN brands ON brands.id=registeredcars.brandId ";
        if($id!=null)
        {
            $sql .= "WHERE registeredcars.id='$id'";
        }
        if(mysqli_num_rows($result=mysqli_query($db,$sql)) > 0)
        {
            return $result;
        }
        else
        {
            return [];
        }
    }



    function uploadImage($image)
    {
        $imageName = $image['name'];
        $splitImage = explode('.',$imageName);
        $ext = strtolower(end($splitImage));
        if(in_array($ext,['jpg','jpeg','png']))
        {
            $newName = hexdec(uniqid()).'.'.$ext;
            $uploadPath = 'uploads/'.$newName;
            if(move_uploaded_file($image['tmp_name'],'../'.$uploadPath))
            {
                return $uploadPath;
            }
        }
        else
        {
            $_SESSION['error'] = '<div class="alert alert-warning">Warning! We accept (jpg,jpeg or png) file only</div>';
            header('location:registerCar.php');
        }
    }

?>