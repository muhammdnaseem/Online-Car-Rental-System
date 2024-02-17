<?php

    function availableCars($db)
    {
        $sql = "SELECT COUNT(*) as totalCars FROM registeredcars WHERE carStatus='unblock'";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0)
        {
            $result = mysqli_fetch_assoc($result);
            return $result['totalCars'];
        }
        else
        {
            return 0;
        }
    }
    
    function blockCars($db)
    {
        $sql = "SELECT COUNT(*) as totalCars FROM registeredcars WHERE carStatus='block'";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0)
        {
            $result = mysqli_fetch_assoc($result);
            return $result['totalCars'];
        }
        else
        {
            return 0;
        }
    }
    
    function activeUsers($db)
    {
        $sql = "SELECT COUNT(*) as totalUsers FROM users WHERE status='unblock'";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0)
        {
            $result = mysqli_fetch_assoc($result);
            return $result['totalUsers'];
        }
        else
        {
            return 0;
        }
    }
    
    function blockUsers($db)
    {
        $sql = "SELECT COUNT(*) as totalUsers FROM users WHERE status='block'";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0)
        {
            $result = mysqli_fetch_assoc($result);
            return $result['totalUsers'];
        }
        else
        {
            return 0;
        }
    }

?>