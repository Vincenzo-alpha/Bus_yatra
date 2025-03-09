<?php
session_start();
include("connection.php");
$iserror = false;
if(!$con){
    die("fail to connect". mysqli_connect_error());

}else{
    // echo "connectedS";S

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        // $sql = "SELECT * INTO user_access WHERE name='$username' && password='$password'";
       $query = "SELECT * FROM `customer_bus_access` where `customer_bus_access`.`email`='$username' AND`customer_bus_access`.`password` = '$password'";
        $data = mysqli_query($con,$query);
        $ispresence = mysqli_num_rows($data);
            if($ispresence == 1){
                echo 'login';
                $_SESSION['email'] = $username;
                $access_acc = $_SESSION['email'];
                header('location:index.php');
            }else{
                header("location:user_login.php?msg=INVALID USERNAME AND PASSWORD");
            }
      
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/user_login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Seymour+One&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/footer.css">
    <title>Bus Yatra | Login |</title>
</head>
<body>
    <header><a href="user_page.php">
        <div class="logo">
            <img src="image/bus_logo.png" alt="">
        </div>
        <h1>BUS YATRA</h1></a>
    </header>
        <?php
if(isset($_REQUEST['msg']))
   echo $_REQUEST['msg'];
?>
    <div class="login_box">
        <div class="login_section1">
            <form action="" method="POST" autocomplete="off ">
                <h2>Login</h2>
                <p style="color: black;">Doesn't have a accound? <a href="user_register.php">Sign Up</a></p>
                <label for="username">Email ID</label>
                <input type="email" name="username" placeholder="USERNAME" class="login_textbox">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="PASSWORD" class="login_textbox">
                <input type="submit" name="login" value="Login" id="login_btn">
            </form>
        </div>
        <div class="login_section2">
            <img src="image/user_logo.png" alt="">
        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
</body>
</html>