<?php
 //session_start();
 //include("connection.php");
 include("user_local_book.php");
 $islogin =false;


if(isset($_SESSION['email'])){
    $islogin = true;

}else{
    header("location:user_login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p><?php  echo $selectedPlace1;?></p>
</body>
</html>

<!-- if (isset($_POST['booking'])) {
        $ar_place = $selectedPlace;
        $de_place = $selectedPlace1;
        $bus_time = $selectedBusTime;
        $selectDate = $_POST['date'] ?? '';
        $passenger = $_POST['passenger'] ?? '';

        if (!empty($selectDate) && strtotime($selectDate)) {
            $inFormatDate = date("Y-m-d", strtotime($selectDate));
        } else {
            echo "Invalid or empty date!";
        }
    } -->