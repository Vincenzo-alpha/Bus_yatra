<?php
// Start session
session_start();
include("connection.php");
$isLogin = true;
$track = $_POST['bookingID'] ?? '';
$currentDate = strtotime(date("y-m-d"));

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("location:user_login.php");
    $isLogin = false;
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bus Yatra | Status |</title>
  <!-- <link rel="stylesheet" href="test2.css"> -->
  <link rel="stylesheet" href="./css/body.css">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/footer.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Seymour+One&display=swap" rel="stylesheet">
</head>
<body>
  <header>
  <a href="./user_page.php">

<div class="header">
    <img src="./image/bus_logo.png" alt="" class="logo">
    <h2>BUS YATRA</h2>
</div>
</a>
      </header>
      <button onclick="nav_toggle()" id="nav_btn"><i class="fa-solid fa-bars"></i></button>

    <div id="navigation">
        <div class="menu_nav">
            <a href="" class="nav_opt">HOME</a>
            <div class="menu">
                <input type="button" onclick="toggle()" class="nav_opt" id="menu" value="MENU">
                <div id="left_ind">
                    <i class="fa-solid fa-angle-down" id="arrow"></i>
                </div>
            </div>

            <div class="menu_opt" id="menu_op">
                <ul>
                    <li class="list"><a href="" class="">STATUS</a></li>
                    <li class="list"><a href="" class="">booking</a></li>
                    <li class="list"><a href="" class="">n/a</a></li>
                    <li class="list"><a href="" class="">n/a</a></li>            
                </ul>
            </div>

            <a href="" class="nav_opt">ABOUT</a>
            <a href="" class="nav_opt">LOGOUT</a>
        </div> 
    </div>

    <main >
        <h1 style="text-align: center;"><u><i>Status</i></u></h1>
            <?php 

                        $sql = "SELECT * FROM `bus_booking` WHERE `email`=?";
                        $stmt = $con->prepare($sql);
                        $stmt->bind_param("s", $_SESSION['email']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while($row = mysqli_fetch_assoc($result)){
                            $data[] = $row;
                        }

            ?>

        <div class="statusBooking">
          <table>
              <tr>
                  <th>Booking ID</th>
                  <th>Name</th>
                  <th>From</th>
                  <th>To</th>
                  <th>Bus name</th>
                  <th>Bus time</th>
                  <th>Booking date</th>
                  <th>Passenger</th>
                  <th>Status</th>
                  <?php if($isLogin){?>
                  <th>Download Receipt</th>
                  <?php }?>
                  
                </tr>
                <?php 
                $isActive = false;
                foreach ($data as $row){
                    $b_id = $row["bookingId"];
                    $bookingDate =  strtotime($row["book_date"]);
                    if($_SESSION['email'] == $row['email']){
                        $isSameEmail = true;
                    }
            ?>
            <tr>
              <td><?php echo $row["bookingId"] ?? 'Data Not Found'?></td>
              <td style="text-transform:uppercase"><?php echo $row["name"] ?? 'Data Not Found'?></td>
              <td style="text-transform:uppercase"><?php echo $row["ar_place"] ?? 'Data Not Found'?></td>
              <td style="text-transform:uppercase"><?php echo $row["de_place"] ?? 'Data Not Found'?></td>
              <td><?php echo $row["bus_name"] ?? 'Data Not Found'?></td>
              <td><?php echo $row["bus_time"] ?? 'Data Not Found'?></td>
              <td><?php echo $row["book_date"] ?? 'Data Not Found'?></td>
              <td><?php echo $row["passenger"] ?? 'Data Not Found'?></td>
              <?php if($bookingDate < $currentDate){
                  $isActive = false;
            }else{
                $isActive = true;
              }?>
              <td><?php echo ($isActive ? "Active" : "Inactive");?></td>
              <?php if($isActive){?>
              <td><a style="color: blue;" href="BookingReceipt.php?bookingid=<?php echo $b_id;?>">View</a></td>
              <?php }else{?>
                <td>Expired</td>
                <?php }?>

            </tr>
            <?php }?>

          </table>

        </div>

    </main>

      <footer class="footer">
        <div><center>
            <h3>Services</h3>
            <a href="./user_book_opt.php">Booking</a><br>
            <a href="./busCancel.php">Cancellation</a><br>
            <a href="">Route</a><br>
            <a href="./user_page.php">Home</a>
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
    <script src="../script/script.js"></script>
</body>
</html>
</body>
</html>