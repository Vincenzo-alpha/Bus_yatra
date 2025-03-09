<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading Screen Example</title>
    <style>
        /* Style for the loading screen */
        #loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        /* Style for the spinner */
        .spinner {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Loading Screen -->
    <div id="loading-screen">
        <div class="spinner"></div>
    </div>

    <!-- Main Content -->
    <div id="main-content" style="display: none;">
        <?php
        // Simulate a delay to show the loading screen
        sleep(3);
        ?>
        <h1>Welcome to the Main Page</h1>
        <p>This is the main content of the page.</p>
    </div>

    <script>
        // JavaScript to hide the loading screen and show the main content
        window.addEventListener("load", function() {
            document.getElementById("loading-screen").style.display = "none";
            document.getElementById("main-content").style.display = "block";
        });
    </script>
</body>
</html>
