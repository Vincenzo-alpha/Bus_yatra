<?php
// Start session
// session_start();
include("connection.php");

// Check if user is logged in
// if (!isset($_SESSION['email'])) {
//     header("location:user_login.php");
//     exit();
// }
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if(isset($_POST['SearchRoute'])){

// $stateName = $_POST['stateName'] ?? '';
$from = $_POST['from'] ?? '';
$to = $_POST['de'] ?? '';
// $stateId = '';
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/body.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Seymour+One&display=swap" rel="stylesheet">
    <title>Bus Yatra | Routes |</title>
</head>
<body>
    <header>
    <a href="./user_page.php">

<div class="header">
    <img src="/code/working_project/project2/image/bus_logo.png" alt="" class="logo">
    <h2>BUS YATRA</h2>
</div>
</a>
        </header>
        <main class="main_div">
            <div class="searchPlace">
               <center>
                   <h1><i><u>Search the Route</u></i></h1>
               </center> 
                <form action="" method="post">
                    <center>
                    <table style="width: 100%">
                        <tr>
                        <th><label for="from" class="inputLabel">From</label></th>
                        <td><input type="search" name="from" class="inputSearch" id="input1" list="option" value="<?php echo $from ?? '';?>">
                        <datalist id="option">
                            <!-- <option value="kharagpur">kharagpur</option> -->
                            <?php 
                                $sql = "SELECT `ap_name` FROM `bus_place_name`";
                                $stmt = $con -> prepare($sql);
                                $stmt -> execute();
                                $result = $stmt-> get_result();
                                while($row = $result->fetch_assoc()){
                                    echo '<option value="' . htmlspecialchars($row['ap_name']) . '">' . htmlspecialchars($row['ap_name']) . '</option>';
                                }
                                $stmt-> close();
                            ?>
                        </datalist>
                        </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center;">
                                <button type="button"  id="middleButton" onclick="switchText()"><i class="fa-solid fa-arrow-right-arrow-left fa-rotate-270 fa-xl" style="color: #B197FC;"></i></button>
                            </td>
                        </tr>
                        <tr>
                        <th><label for="de" class="inputLabel">To</label></th>
                        <td><input type="search" name="de" class="inputSearch" id="input2" list="option"  value="<?php echo $to?? ''; ?>">
                            <datalist id="option">
                                <?php 
                                $sql = "SELECT `dis_name` FROM `bus_place_name`";
                                $stmt = $con -> prepare($sql);
                                // $stmt -> bind_param("s",$stateId);
                                $stmt -> execute();
                                $result = $stmt-> get_result();
                                while($row = $result->fetch_assoc()){
                                    echo '<option value="' . htmlspecialchars($row['dis_name']) . '">' . htmlspecialchars($row['dis_name']) . '</option>';
                                }
                                $stmt->close();
                                
                            ?>
                            </datalist>
                            </td>
                        </tr>
                    </table>
                    <input type="submit" name="SearchRoute" id="btn">
                </center>
                </form>
            </div>
        </main>
            <div class="statusBooking">
            <?php 
                        $data = array();
                        if (!empty($from) && !empty($to)) {
                        $sql = "SELECT * FROM `bus` JOIN `bus_place_name` ON `bus`.`distance_id` = `bus_place_name`.`distance_id` WHERE `bus`.`distance_id` = ( SELECT `distance_id` FROM `bus_place_name` WHERE `ap_name` = ? AND `dis_name` = ?)";
                        $stmt = $con->prepare($sql);
                        //  echo $to.' and '.$from;
                        $stmt->bind_param("ss",$from,$to);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while($row = $result->fetch_assoc()){
                            $data[] = $row;
                        }
                        $stmt ->close();
                    }
                        ?>
            <center>
                <table>
                    <tr>
                        <th>From</th>
                        <th>To</th>
                        <th>Distance</th>
                        <th>Bus Name</th>
                        <th>Bus Number</th>
                        <th>Bus Arrival</th>
                        <th>Last Stop</th>
                        <th>Time</th>
                        <th>Bus Type</th>
                        <th>price</th>
                    </tr>

                    <?php
                    if (!empty($data)) {
                    foreach ($data as $row) {
                ?>
                   <tr>
                    <td><?php echo htmlspecialchars($from); ?></td>
                    <td><?php echo htmlspecialchars($to); ?></td>
                    <td><?php echo htmlspecialchars($row['distance']); ?></td>
                    <td><?php echo htmlspecialchars($row['bus_name'] ?? 'no data'); ?></td>
                    <td><?php echo htmlspecialchars($row['bus_no']); ?></td>
                    <td><?php echo htmlspecialchars($row['start_place']); ?></td>
                    <td><?php echo htmlspecialchars($row['stop_place']); ?></td>
                    <td><?php echo htmlspecialchars($row['time']); ?></td>
                    <td><?php echo htmlspecialchars($row['bus_type']); ?></td>
                    <td><?php echo htmlspecialchars($row['price']); ?></td>
                </tr>
                <?php 
                    }
                } else {
                    echo '<tr><td colspan="10" style="text-align: center;">No data found</td></tr>';
                }
                ?>
                </table>
            </center>
        </div>
        <footer class="footer">
            <div><center>
                <h3>Services</h3>
                <a href="./user_book_opt.php">Booking</a><br>  
                <a href="./busStatus.php">Status</a><br>
                <a href="./busCancel.php">Cancellation</a><br>
                <a href="./user_page.php">Home</a>
            </center></div>
            <div>
                <center>
                    <h3>About</h3>
                    <p>PH-9998887771</p>
                    <p>BusYatra@gmail.com</p>
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
        <script>
            function switchText(){
                var input1 = document.getElementById("input1");
                var input2 = document.getElementById("input2");
                var temp = input1.value;
                input1.value = input2.value;
                input2.value = temp;
            }
        </script>
</body>
</html>