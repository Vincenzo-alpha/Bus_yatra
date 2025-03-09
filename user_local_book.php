<?php
// Start session
session_start();
include("connection.php");

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("location:user_login.php");
    exit();
}


// Initialize variables
$selectedPlace = $_POST['ap_place'] ?? '';
$selectedPlace1 = $_POST['dep_place'] ?? '';
$selectedBusTime = $_POST['bus_time'] ?? '';
$email = $_SESSION['email'] ?? '';
$name = '';
$busNo = '';
$busName = '';
$distanceId = '';
$inFormatDate = '';
$selectDate = '';
$insert = false;
$currentTime = date("H:i:s");

// Fetch customer details
$sql = "SELECT * FROM `customer_bus_access` WHERE `email` = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $name = $row['name'];
}
$stmt->close();

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle the booking form
    if (isset($_POST['booking'])) {
        $ar_place = $selectedPlace;
        $de_place = $selectedPlace1;
        $bus_time = $selectedBusTime;
        $selectDate = $_POST['date'] ?? '';
        $passenger = $_POST['passenger'] ?? '';
        $price = $_POST['price'] ?? '';

        if (!empty($selectDate) && strtotime($selectDate)) {
            $inFormatDate = date("Y-m-d", strtotime($selectDate));
        } else {
            echo "Invalid or empty date!";
        }

        // Fetch distance ID
        $sql3 = "SELECT `distance_id` FROM `bus_place_name` WHERE `ap_name` = ? AND `dis_name` = ?";
        $stmt = $con->prepare($sql3);
        $stmt->bind_param("ss", $selectedPlace, $selectedPlace1);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $distanceId = $row['distance_id'];
        }
        $stmt->close();

        // Fetch bus details
        if (!empty($distanceId) && !empty($selectedBusTime)) {
            $sql4 = "SELECT `bus_no`, `bus_name` FROM `bus` WHERE `distance_id` = ? AND `time` = ?";
            $stmt = $con->prepare($sql4);
            $stmt->bind_param("ss", $distanceId, $selectedBusTime);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                $busNo = $row['bus_no'];
                $busName = $row['bus_name'];
            }
            $stmt->close();
        }

        // Insert booking details
        $_SESSION["name"] = $name;
        $_SESSION["ar_place"] = $ar_place;
        $_SESSION["de_place"] = $de_place;
        $_SESSION["bus_time"] = $bus_time;
        $_SESSION["busName"] = $busName;
        $_SESSION["busNo"] = $busNo;
        $_SESSION["inFormatDate"] = $inFormatDate;
        $_SESSION["passenger"] = $passenger;
        $_SESSION["price"] = $price;

        header("location:PaymentGatway.php");
    }
}

// Fetch unique arrival places
$sql1 = "SELECT DISTINCT TRIM(LOWER(`ap_name`)) AS `ap_name` FROM `bus_place_name`";
$result = $con->query($sql1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Yatra | Local Booking |</title>
    <link rel="stylesheet" href="./css/body.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Seymour+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="css/footer.css">
    <!-- <link rel="stylesheet" href="css/paymentgateway.css"> -->
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
    <main class="main_div">
        <div class="form_box">
            <h1 align="center">LOCAL BOOKING</h1>
            <form action="" method="POST">

                <!-- Arrival Dropdown -->
                <label for="ap_place" class="label">ARRIVAL</label>
                <select name="ap_place" id="ap_place" class="ce" style="text-transform:uppercase" onchange="this.form.submit()">
                    <option value="">Select Arrival Place</option>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row1 = $result->fetch_assoc()) {
                            $isSelected = $row1['ap_name'] === $selectedPlace ? 'selected' : '';
                            echo '<option value="' . htmlspecialchars($row1['ap_name']) . '" ' . $isSelected . '>' . htmlspecialchars($row1['ap_name']) . '</option>';
                        }
                    } else {
                        echo '<option value="">No Data</option>';
                    }
                    ?>
                </select>

                <!-- Departure Dropdown -->
                <label for="dep_place" class="label">DEPARTURE</label>
                <select name="dep_place" id="dep_place" class="ce" style="text-transform:uppercase" onchange="this.form.submit()">
                    <option value="">Select Departure Place</option>
                    <?php
                    if (!empty($selectedPlace)) {
                        $sql2 = "SELECT DISTINCT TRIM(LOWER(`dis_name`)) AS `dis_name` FROM `bus_place_name` WHERE `ap_name` = ?";
                        $stmt = $con->prepare($sql2);
                        $stmt->bind_param("s", $selectedPlace);
                        $stmt->execute();
                        $result2 = $stmt->get_result();
                        if ($result2->num_rows > 0) {
                            while ($row2 = $result2->fetch_assoc()) {
                                $isSelected1 = $row2['dis_name'] === $selectedPlace1 ? 'selected' : '';
                                echo '<option value="' . htmlspecialchars($row2['dis_name']) . '" ' . $isSelected1 . '>' . htmlspecialchars($row2['dis_name']) . '</option>';
                            }
                        } else {
                            echo '<option value="">No Data</option>';
                        }
                        $stmt->close();
                    }
                    ?>
                </select>

                <!-- Bus timing -->
                <label for="bus_time" class="label">BUS TIME</label>
                <select name="bus_time" id="bus_time" class="ce" onchange="this.form.submit()">
                    <option value="">Select Bus Time</option>
                    <?php
                    if (!empty($selectedPlace) && !empty($selectedPlace1)) {
                        $sql3 = "SELECT `time` FROM `bus` WHERE `distance_id` = (SELECT `distance_id` FROM `bus_place_name` WHERE `ap_name` = ? AND `dis_name` = ?)";
                        $stmt = $con->prepare($sql3);
                        $stmt->bind_param("ss", $selectedPlace, $selectedPlace1);
                        $stmt->execute();
                        $result3 = $stmt->get_result();
                        if ($result3->num_rows > 0) {
                            while ($row3 = $result3->fetch_assoc()) {
                                if(date("y-m-d")> $selectDate or $currentTime < $row['time']){
                                $isSelected2 = $row3['time'] === $selectedBusTime ? 'selected' : '';
                                echo '<option value="' . htmlspecialchars($row3['time']) . '" ' . $isSelected2 . '>' . htmlspecialchars($row3['time']) . '</option>';
                            }
                        }
                        } else {
                            echo '<option value="">No Data</option>';
                        }
                        $stmt->close();
                    }
                    ?>
                </select>

                   <!-- Booking Date -->
                   <label for="book_date" class="label">BOOKING DATE</label>
                <?php
                $intCurrent = strtotime($currentTime);
                $intBusTime = strtotime($selectedBusTime);
                    if($intCurrent > $intBusTime){ 
                     

                        $today = date("Y-m-d", strtotime("+1 day"));
                    }else{

                        $today = date("Y-m-d");
                    }
                    echo '<input type="date" name="date" id="calendar" min="' . $today . '" value="' . $selectDate . '" class="ce" required/>';
                    // echo var_dump($today);

                ?>

                <label for="passenger" class="label">PASSENGERS</label>
                <select name="passenger" id="passenger" class="ce">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>

                <?php 
                if (!empty($selectedPlace) && !empty($selectedPlace1)) {
                    $sql4 = "SELECT `price` FROM `bus_place_name` WHERE `ap_name` = ? AND `dis_name` = ?";
                    $stmt = $con->prepare($sql4);
                    $stmt->bind_param("ss", $selectedPlace, $selectedPlace1);
                    $stmt->execute();
                    $result4 = $stmt->get_result();
                    if ($result4->num_rows > 0) {
                        while ($row4 = $result4->fetch_assoc()) {
                            $price = $row4['price'];
                            $_SESSION["price"] = $price;
                        }
                    } else {
                        echo '<option value="">No Data</option>';
                    }
                    $stmt->close();
                }
                ?>

                <label for="price" class="label">AMOUNT(PER PERSON)</label>
                <input type="text" name="price" value="<?php echo htmlspecialchars($price ?? ''); ?>" class="ce" disabled><br>
                <br>

                <input type="submit" name="booking" value="Proceed" id="btn">
            </form>
        </div>
        
    </main>

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
    <script src="./script/script.js"></script>
</body>
</html>

<?php
$con->close();
?>