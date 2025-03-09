<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/userpage.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading Page</title>
    <body>
    <div id="loading_screen">
    <div class="bg_logo">
        <video src="image/bg.mp4" autoplay muted loop></video>
        <img src="image/front_logo.png" alt="">
    </div>
    </div>
    
    <script>
        // Redirect to the main page after a delay
        setTimeout(() => {
            window.location.href = 'user_page.php';
        }, 4500); // 1000ms = 1 seconds
    </script>
</head>
</body>
</html>
