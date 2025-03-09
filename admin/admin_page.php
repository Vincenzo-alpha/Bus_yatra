<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="css/body.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Seymour+One&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/user_login.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/admin_page.css">
<title>Document</title>
</head>
<body>
    <header>
        <div class="header">
            <img src="image/bus_logo.png" alt="" class="logo">
            <h2>BUS YATRA</h2>
        </div>
    
    </header>
    <button onclick="nav_toggle()" id="nav_btn"><i class="fa-solid fa-bars" id="menu_opt_btn"></i></button>

    <div id="navigation">
   <div class="menu_nav">
       <a href="" class="nav_opt">HOME</a>
       <div class="menu">

       <input type="button" onclick=toggle() class="nav_opt" id="menu" value="MENU">
       <div id="left_ind">
        <i class="fa-solid fa-angle-down" id="arrow"></i>
       </div>
    </div>

    <div class="menu_opt" id="menu_op">
        <ul>
<li class="list"><a href="" class="">STATUS</a></li>
<li class="list"><a href="" class="">BUS MANAGE</a></li>
<li class="list"><a href="" class="">STATE MANAGE</a></li>
<li class="list"><a href="" class="">BOOKING MANAGE</a></li>            
        
        
    </ul>
    </div>
    <a href="" class="nav_opt">LOGOUT</a>
</div> 
</div>
<main>
    <div class="admin">
        <h2 align="center">WELCOME TO ADMINITRATION</h2>
        <table >
            <tr id="name">
                <th>
                    NAME:
                </th>
                <td>
                    <!-- admin name in database -->
                </td>
            </tr>
            <tr id="level">
                <th>
                    ACCESS LEVEL:
                </th>
                <td>
                    <!-- database -->
                </td>

            </tr>

            <tr id="gender">
                <th>
                    GENDER:
                </th>
                <td>
                    <!-- database -->
                </td>

            </tr>
            <tr id="position">
                <th>POSITION:</th>
                <td>
                    <!-- database -->
                </td>
            </tr>
        </table>
    </div>
</main>

<script src="script/script.js"></script>    
</body>