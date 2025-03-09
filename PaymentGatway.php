<?php
$islogin =false;
session_start();
include("connection.php");
if(isset($_SESSION['email'])){
   $islogin = true;
   
}else{
   
   header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Options</title>
    <link rel="stylesheet" href="./css/paymentgateway.css">
</head>
<body>
    <?php 
        $name=$_SESSION["name"];
        $email=$_SESSION["email"];
        $ar_place=$_SESSION["ar_place"];
        $de_place=$_SESSION["de_place"];
        $bus_time=$_SESSION["bus_time"];
        $busName=$_SESSION["busName"];
        $busNo=$_SESSION["busNo"];
        $inFormatDate=$_SESSION["inFormatDate"];
        $passenger=$_SESSION["passenger"];
        $price=$_SESSION["price"];

        $total_amount = $price * $passenger;

        $token = bin2hex(random_bytes(16)); // Generate a token
        $hashedToken = hash_hmac('sha256', $token, 'your-secret-key'); // Hash it with a secret key
        $_SESSION["token"] = $hashedToken;

    ?>
    <form action="" method="POST" class="pay-content">
        <h3>Select Payment Mode:</h3>
        <label> Pay Amount<br>
            <input type="input" name="Pay-amount"  value="<?php echo $total_amount; ?>" disabled>
        </label><br>
        <label>
            <input type="radio" name="payment_mode" value="Net Banking"> Net Banking
        </label><br>
        
        <label>
            <input type="radio" name="payment_mode" value="Credit Card"> Credit Card
        </label><br>
        <label>
            <input type="radio" name="payment_mode" value="Debit Card"> Debit Card
        </label><br>


        <div id="Net Banking" class="content" style="display: none;">
        <label>
            UPI
            <input type="text" name="UPI" placeholder="UPI"> 
        </label><br><br>
        </div>
        <div id="Credit Card" class="content" style="display: none;">
            <label>
            Credit Card Number:
            <input type="text" name="Enter your Credit Card Number"> 
        </label><br>
        <label>
            Credit Card CVV:
            <input type="text" name="Enter your CVV"> 
        </label><br> 
        </div>
        <div id="Debit Card" class="content" style="display: none;">
        <label>
            Debit Card Number:
            <input type="text" name="Enter your Debit Card Number"> 
        </label><br>
        <label>
            Debit Card CVV:
            <input type="text" name="Enter your CVV"> 
        </label><br> 
        </div>
        <button type="submit" name="pay-now">Pay Now</button>
    </form>
    <script>
        document.querySelectorAll('input[name="payment_mode"]').forEach((radio) => {
    radio.addEventListener("change", (event) => {
      const value = event.target.value;
      // Hide all divs
      document.querySelectorAll(".content").forEach((div) => {
        div.style.display = "none";
      });
  
      // Show the selected div
      const selectedDiv = document.getElementById(value);
      if (selectedDiv) {
        selectedDiv.style.display = "block";
      }
    });
  });
  
    </script>
<?php 
        
        $sql = "SELECT `id` FROM `customer_bus_access` WHERE `email`= ?" ;
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $customerId = $row['id'];
        }
        
        $stmt->close();

        $insert = false; 
 if (($_SERVER["REQUEST_METHOD"] == "POST")) {
            // Handle the payment form
    if (isset($_POST['pay-now'])) { 
        $payment_mode = $_POST['payment_mode'];
        $sql_book = "INSERT INTO `customer_payment` (`pay_tokan_id`,`customer_id`,`amount`,`payment_mode`) 
        VALUES (?, ?, ?, ?)";
        $stmt = $con->prepare($sql_book);
        $stmt->bind_param("ssss", $hashedToken, $customerId, $total_amount, $payment_mode);
        if ($stmt->execute()) {
        $insert = true;
        } else {
        echo "Error: " . $stmt->error;
        $insert = false;
        }
        $stmt->close();

        if($insert){
            header("location:paySuccess.php");
        }

    }
}
    ?>

</body>
</html>
