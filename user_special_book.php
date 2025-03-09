<?php
 session_start();
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
    <link rel="stylesheet" href="css/user_booking.css">
    <link rel="stylesheet" href="css/body.css">
    <link rel="stylesheet" href="css/style.css">
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
    <main >
        <div class="form_box">
        <h1 align="center">SPECIAL BOOKING</h1>
        <form action="" method="POST">
            <input type="text" name="name" class="ce" placeholder="NAME">
            <input type="email" name="email" class="ce" placeholder="email">
            <input type="date" name="date" class="ce" placeholder="date">
            <input type="time" name="time" class="ce" placeholder="time">
            <!-- <input type="search" name="search" class="ce" placeholder="search"> -->
            <select name="dep_place" id="" class="ce">
                <option value="1">hgghg</option>
            </select>
            <select name="dep_place" id="" class="ce">
                <option value="1"></option>
            </select>
            <input type="submit" name="booking" value="Proceed" id="btn">

        </form>
    </div>
    <div class="img">
        <img src="user_logo.png" alt="">
    </div>
    </main>
</body>
</html>