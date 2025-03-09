<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/body.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Seymour+One&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/user_login.css">
    <title>Document</title>
</head>
<body>
    <header>
        <div class="header">
            <img src="image/bus_logo.png" alt="" class="logo">
            <h2>BUS YATRA</h2>
        </div>
    </header>
    <div class="login_box">
        <div class="login_section1">
            <form action="" method="POST" autocomplete="off ">
                <h2>Admin Login</h2>
                <p>doesn't have a accound? <a href="user_register.php">Sign Up</a></p>
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
    <h1></h1>
</body>
</html>