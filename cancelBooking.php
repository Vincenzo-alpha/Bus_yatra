<?php
// Start session
session_start();
include("connection.php");
$isLogin = true;
$bookingId= $_GET['bookingid'];
// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("location:user_login.php");
    $isLogin = false;
    exit();
}
?>

<?php 
    // Handle the cancellation form
        if (isset($_POST['ComCancelBtn'])) { 
            $msg = 'not work';
            $sql = "DELETE FROM `bus_booking` WHERE `bookingId` = ?";
            $stmt = $con -> prepare($sql);
            $stmt -> bind_param("s",$bookingId);
            $stmt -> execute();
            $result = $stmt->get_result();
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div>
    <form action="./user_page.php" method="post">
        <table>
            <tr>
                <th>Booking Id: </th>
                <td><input type="text" name= "bookingId" value="<?php echo $bookingId;?>" disabled></td>
            </tr>
            <tr>
                <th>Bank Account No.:</th>
                <td><input type="text" name= "bankAcc"></td>
            </tr>
        </table>
        <input type="submit" name="ComCancelBtn" value="Comfirm">
    </form>
</div>
</body>
</html>