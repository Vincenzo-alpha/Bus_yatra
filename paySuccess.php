<?php
$islogin =false;
session_start();
include("connection.php");
if(isset($_SESSION['email'])){
   $islogin = true;
   if(isset($_SESSION['reload_detected'])){
       $islogin = false;
       session_destroy();
       header("location:index.php");
       exit;
   }
   $_SESSION['reload_detected'] = true;

}else{
   
   header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAYMENT | DONE |</title>
    <link rel="stylesheet" href="./css/paymentgateway.css">
    <link rel="stylesheet" href="./css/body.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Seymour+One&display=swap" rel="stylesheet">    
</head>
<body>
<header>
      <div class="header">
          <img src="image/bus_logo.png" alt="" class="logo">
          <h2>BUS YATRA</h2>
      </div>
      
      </header>
    <?php 
    $name=$_SESSION["name"];
    $email=$_SESSION["email"];
    $ar_place=$_SESSION["ar_place"];
    $de_place=$_SESSION["de_place"];
    $bus_time=$_SESSION["bus_time"];
    $busName=$_SESSION["busName"];
    $busNo=$_SESSION["busNo"];
    $inFormatDate=$_SESSION["inFormatDate"];
    $passenger=$_SESSION["passenger"];
    $price=$_SESSION["price"];
    $hashedToken=$_SESSION["token"];
    $insert = false;

    // Create unique booking id


    $sql = "SELECT `p_id` FROM `customer_payment` WHERE `pay_tokan_id`= ?" ;

        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $hashedToken);
        $stmt->execute();
        $result = $stmt->get_result();
        $uniqueId = time() . rand(1000, 9999);
        if ($row = $result->fetch_assoc()) {
            $p_id = $row['p_id'];
            $sql_book = "INSERT INTO `bus_booking` (`bookingId`, `name`, `email`, `ar_place`, `de_place`, `bus_time`, `bus_name`, `bus_no`, `book_date`, `p_id`, `passenger`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $con->prepare($sql_book);
            $stmt->bind_param("sssssssssss", $uniqueId, $name, $email, $ar_place, $de_place, $bus_time, $busName, $busNo, $inFormatDate, $p_id, $passenger);
            if ($stmt->execute()) {
            $insert = true;
            } else {
            echo "Error: " . $stmt->error;
            }
           
        }
        
        $stmt->close();
    

    ?>
    <div class="pay-content">
        <h1><?php echo($insert?"Thankyou for service":"Something is wrong!")?></h1>
        <p style="color: black;"><?php echo $uniqueId?> is your Booking Number </p>
        <a href="./user_page.php">Go back Home</a>
        <a href="BookingReceipt.php?bookingid=<?php echo $uniqueId;?>">View</a>

    </div>
    <footer class="footer">
        <div><center>
            <h3>Services</h3>
            <a href="">Booking</a><br>
            <a href="">Status</a><br>
            <a href="">History</a><br>
            <a href="user_book_opt.php">Home</a>
        </center></div>
        <div>
            <center>
                <h3>About</h3>
                <p>PH-9998887771</p>
                <p>test@gmail.com</p>
                <a href="">Help & Support</a> 
            </center>
        </div> 
        <div>
            <center>
                <h3>Admin</h3>
                <a href="">Administration</a>
            </center>
        </div>
        <div class="Copyright">
            <center>Copyright@2024 Bus_Yatra</center>
        </div>
    </footer>
</body>
</html>