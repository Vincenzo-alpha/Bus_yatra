<?php 
include("connection.php");
$bookingId= $_GET['bookingid'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/bookingReceipt.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Seymour+One&display=swap" rel="stylesheet">
  <!-- <link rel="stylesheet" href="../css/body.css"> -->
  <title>Document</title>
</head>
<body>
<?php 
                $data = array();
                    
                        $sql = "SELECT * FROM `bus_booking` WHERE `bookingId`=?";
                        $stmt = $con->prepare($sql);
                        $stmt->bind_param("s", $bookingId);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while($row = mysqli_fetch_assoc($result)){
                            $data[] = $row;
                        }
            ?>
           
  <div id="receipt-container">
  <div class="header">
    <img src="./image/bus_logo.png" alt="" class="logo">
    <h1>BUS YATRA</h1>
    </div>
    <h2>Booking Receipt</h2>
    <h3>Customer Details</h3>
      <table>
        <?php foreach ($data as $row){?>
        <tr>
          <th>Booking ID :</th>
          <td><?php echo $row["bookingId"] ?? 'Data Not Found'?></td>
        </tr>
        <tr>
          <th>Name :</th>
          <td><?php echo $row["name"] ?? 'Data Not Found'?></td>
        </tr>

      </table>
      <!-- bus details -->
      <h3>Bus details</h3>
      <table>
        <tr>
          <th>Bus No :</th>
          <td><?php echo $row["bus_no"] ?? 'Data Not Found'?></td>
        </tr>
        <tr>
          <th>Bus Name :</th>
          <td><?php echo $row["bus_name"] ?? 'Data Not Found'?></td>
        </tr>
        <tr>
          <th>Journey to Start :</th>
          <td style="text-transform:uppercase"><?php echo $row["ar_place"] ?? 'Data Not Found'?></td>
        </tr>        
        <tr>
          <th>Journey to End :</th>
          <td style="text-transform:uppercase"><?php echo $row["de_place"] ?? 'Data Not Found'?></td>
        </tr>
        <tr>
            <th>Booking Date :</th>
            <td><?php echo $row["book_date"] ?? 'Data Not Found'?></td>
        </tr>    
        <?php 
        $data1 = array();
        $distance = '';
            $sql1 = "SELECT `distance` FROM `bus_place_name` WHERE `ap_name`= ? AND `dis_name`= ?";
            $stmt1 = $con->prepare($sql1);
            $stmt1->bind_param("ss", $row['ar_place'],$row['de_place']);
            $stmt1->execute();
            $result1 = $stmt1->get_result();
            if ($result1->num_rows > 0) {
              while ($row1 = $result1->fetch_assoc()) {
                $distance = $row1['distance'];
              }
            }
            $stmt1->close();
        ?>  
        <tr>

            <th>Distance :</th>
            <td><?php echo $distance.'Km' ?? 'Not Data'?></td>
        </tr>        
    </table>
    <!-- Payment -->
    <h3>Booking Details</h3>
    <?php 
        $data1 = array();
        $amount = '';
        $pay_mode = '';
            $sql1 = "SELECT `amount`,`payment_mode` FROM `customer_payment` WHERE `p_id` = (SELECT `p_id` FROM `bus_booking` WHERE `bookingId` =?);";
            $stmt1 = $con->prepare($sql1);
            $stmt1->bind_param("s", $bookingId);
            $stmt1->execute();
            $result1 = $stmt1->get_result();
            if ($result1->num_rows > 0) {
              while ($row1 = $result1->fetch_assoc()) {
                $amount = $row1['amount'];
                $pay_mode = $row1['payment_mode'];
              }
            }
            $stmt1->close();
        ?>
    <table>
        <tr>
            <th>Amount :</th>
            <td><?php echo $amount?></td>
        </tr>
        <tr>
            <th>Passenger :</th>
            <td><?php echo $row["passenger"] ?? 'Data Not Found'?></td>
        </tr>
        <?php }?>
        <tr>
          <th>Mode of payment :</th>
          <td><?php echo $pay_mode?></td>
        </tr>     
        </tr>
      </table>

          <div class="note">
            <center>
              <span><b>Note: </b>This is not need to signature. This is E-booking receipt.</span>
            </center>
          </div>
    </div>

    <div class="download_btn">
      <center>
          <button id="view-button" onclick="viewPdf()">View PDF</button>
          <button id="download-button" onclick="downloadPdf()">Download PDF</button><br>
          <a href="./user_page.php">Go to Home</a>

      </center>
    </div>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  
    <script>
      async function generatePdf() {
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF();
  
        // Hide buttons before capturing the receipt
        document.getElementById('view-button').style.display = 'none';
        document.getElementById('download-button').style.display = 'none';
  
        const receiptContainer = document.getElementById('receipt-container');
        const canvas = await html2canvas(receiptContainer);
        const imgData = canvas.toDataURL('image/png');
  
        // Restore buttons after capturing
        document.getElementById('view-button').style.display = 'inline-block';
        document.getElementById('download-button').style.display = 'inline-block';
  
        const imgWidth = 190; 
        const imgHeight = (canvas.height * imgWidth) / canvas.width;
  
        pdf.addImage(imgData, 'PNG', 10, 10, imgWidth, imgHeight);
        return pdf;
      }
  
      async function viewPdf() {
        const pdf = await generatePdf();
        const pdfBlob = pdf.output('blob');
        const pdfUrl = URL.createObjectURL(pdfBlob);
        window.open(pdfUrl, '_blank'); // Opens in a new tab
      }
  
      async function downloadPdf() {
        const pdf = await generatePdf();
        pdf.save('booking-receipt.pdf');
      }
    </script>
  
  </body>
  </html>

  
  

