<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Yatra | Booking Mode |</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/../css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Seymour+One&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/code/working_project/project2/css/user_booking.css">
<link rel="stylesheet" href="/code/working_project/project2/css/body.css">
    <link rel="stylesheet" href="/code/working_project/project2/css/style.css">
    <link rel="stylesheet" href="/code/working_project/project2/css/footer.css">
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

        <button onclick="nav_toggle()" id="nav_btn"><i class="fa-solid fa-bars" id="menu_opt_btn"></i></button>

    <div id="navigation">
   <div class="menu_nav">
       <a href="user_page.php" class="nav_opt">HOME</a>
       <div class="menu">

       <input type="button" onclick=toggle() class="nav_opt" id="menu" value="MENU">
       <div id="left_ind">
        <i class="fa-solid fa-angle-down" id="arrow"></i>
       </div>
    </div>

    <div class="menu_opt" id="menu_op">
        <ul>
<li class="list"><a href="busStatus.php" class="">STATUS</a></li>
<li class="list"><a href="user_book_opt.php" class="">booking</a></li>
<li class="list"><a href="busCancel.php" class="">Cancellation</a></li>
<li class="list"><a href="/code/working_project/project2/user_page.php" class="">Home</a></li>            
        
        
    </ul>
    </div>

    <a href="" class="nav_opt">ABOUT</a>
    <a href="user_logout.php" class="nav_opt">LOGOUT</a>
</div> 
</div>
        <main >
            <div class="form_box">
            <h1 align="center">BOOKING TYPE</h1>
            <div class="book_opt">
                <a href="./user_local_book.php"><button class="opt_btn">Local Booking</button></a>
                <a href="./user_special_book.php"><button class="opt_btn">Special Booking</button></a>

            </div>

        </div>
        <div class="img">
            <img src="/code/working_project/project2/image/user_logo.png" alt="">
        </div>
        </main>
        <footer class="footer">
       <div><center>
        <h3>Services</h3>
            <a href="./user_page.php">Home</a><br>
            <a href="./busStatus.php">Status</a><br>
            <a href="./busCancel.php">Cancellation</a><br>
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
        <script src="script/script.js"></script>
</body>
</html>