<?php
include("connection.php");

if(!$con){
    die("fail to connection".mysqli_connect_error());
}else{
    // echo "connected";
    $insert = false;
    $isEnter = true;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = $_POST['username'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $age = $_POST['age'] ?? '';
        $email = $_POST['email'] ?? '';
        $gender = $_POST['gender'] ?? '';
        $password = $_POST['password'] ?? '';


        // insert sql
        if($name and $phone and $age and $email and $gender and $password){
        $sql = "INSERT INTO `customer_bus_access` (`name`, `phone`, `age`,`email`, `gender`, `password`) VALUES  ('$name', '$phone', '$age','$email','$gender', '$password')";

        if(mysqli_query($con,$sql)){
            $insert = true;
        }else{
            echo "error: ".mysqli_error($con);
        }

        if($insert == true){
            header("location:user_login.php?msg=success");
        }
        mysqli_close($con);
        $isEnter = true;
    }else{
        $isEnter = false;
    }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/user_register.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Seymour+One&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/footer.css">
    <title>Bus Yatra | Register |</title>
</head>
<body>
    <header><a href="user_page.php">
        <div class="logo">
        <img src="image/bus_logo.png" alt="">
        </div>
        <h1>BUS YATRA</h1></a>
    </header>
    <?PHP
    if(isset($_REQUEST['msg'])){
    $msg = $_REQUEST['msg'];
   echo "<h2 align='center' class='header_msg'>$msg</h2>";
    }
   ?>
    <div class="reg_box">
        <div class="reg_section1">
            <form method="POST" autocomplete="off">
                <h2>Sign Up</h2>
                <p style="color: black;"> If you have an account? <a href="user_login.php">Login</a></p>
                <label for="username">Name</label>
                <input type="text" name="username" placeholder="FULL NAME" class="reg_textbox">

                <label for="phone">Phone</label>
                <input type="integer" name="phone" placeholder="PHONE" class="reg_textbox">

                <label for="age">Age</label>
                <input type="text" name="age" placeholder="AGE" class="reg_textbox">

                <label for="email">Email ID</label>
                <input type="email" name="email" placeholder="EMAIL ID" class="reg_textbox">

                <label for="email">Gender</label>
                <div class="gender">
                <input type="radio" name="gender" value="male">Male
                <input type="radio" name="gender" value="female">Female
                <input type="radio" name="gender" value="other" >Others
                </div>

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="PASSWORD" class="reg_textbox">

                <input type="submit" value="Sign Up" id="reg_btn">
            </form>
        </div>
        <div class="reg_section2">
            <img src="image/user_register_logo.png" alt="">
        </div>
    </div>
    <div style="display: <?php echo ($isEnter ? "none" : "block")?>; color:black;">
        <center>
            <h2>Some Entries is not filled</h2>
        </center>
    </div>
    <footer class="footer">
       <div><center>
        <h3>Services</h3>
            <a href="">Booling</a><br>
            <a href="">Status</a><br>
            <a href="">History</a><br>
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



