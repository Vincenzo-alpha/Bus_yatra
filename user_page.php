<!-- user page -->
<?php
 $islogin =false;
 session_start();

if(isset($_SESSION['email'])){
    $islogin = true;
    // if(isset($_SESSION['reload_detected'])){
    //     $islogin = false;
    //     session_destroy();
    //     header("location:index.php");
    //     exit;
    // }
    // $_SESSION['reload_detected'] = true;

}else{
    
    //header("location:login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Yatra | Home |</title>
    <link rel="stylesheet" href="css/userpage.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="css/footer.css">
    <!-- <link rel="stylesheet" href="testcss.css"> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Seymour+One&display=swap" rel="stylesheet">
</head>
<body>
    <div  class="bg">
        <video src="image/bg1.mp4" autoplay muted loop></video>
    </div>
    <header>
        <div class="heading1">
            <div class="logo">
                <img src="image/bus_logo.png" alt="">
            </div>
            <h2 class="seymour-one-regular">BUS YATRA</h2>
        </div>
        
        <nav class="manu">
                <a href="#">ABOUT</a>
                <a href="#">HELP & SUPPORT</a>
                <a href="#">ADMINISTRATION</a>
            </nav>
            <button id="syb_icon"><i class="fa-solid fa-bars" ></i></button>
            
            <?php echo '<a href="' .($islogin?'user_logout.php':'user_login.php').'">'?>
                <div class="login_sec">
              <?php  echo ($islogin?'Logout':'Login');?>
                <i class="fa-solid fa-user" id="login"></i>
                <i class="fa-solid fa-angle-up" id="up_angle"></i>
            </div></a>
            
    </header>

    <main id="main-content">
    <div class="img_sec">   
       

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="./image/bus1.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="./image/bus2.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="./image/bus3.jpg" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>


        <div class="opt_box">
        <a href="busStatus.php">
            <div class="opt" id="status"><p>STATUS</p>
            <div class="information"><p >check you status</p></div></div>
        </a>
            <a href="user_book_opt.php">
                <div class="opt" id="booking"><p>BOOKING</p>
                    <div class="information"><p >Booking for buses</p></div></div>
        </a>
            <a  href="busCancel.php ">
                <div class="opt" id="cencel"><p>CENCELLATION</p>
                    <div class="information"><p >Cencel your ticket</p></div></div>
        </a>
            <a href="route.php">
                <div class="opt" id="route"><p>ROUTES</H2>
                <div class="information"><p >Find your route</p></div></div>
        </a>
    </div>

    <div class="box2">
    </div>
    </main>


    <footer class="footer">
       <div><center>
        <h3>Services</h3>
            <a href="./user_book_opt.php">Booking</a><br>
            <a href="busStatus.php">Status</a><br>
            <a href="busCancel.php">Cancellation Booking</a><br>
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