<?php
  include_once 'database.php';
?>
 <?php
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT * FROM tbl_orders_a174366_pt2, tbl_staffs_a174366_pt2,
        tbl_customers_a174366_pt2, tbl_orders_details_a174366_pt2 WHERE
        tbl_orders_a174366_pt2.fld_staff_num = tbl_staffs_a174366_pt2.fld_staff_num AND
        tbl_orders_a174366_pt2.fld_customer_num = tbl_customers_a174366_pt2.fld_customer_num AND
        tbl_orders_a174366_pt2.fld_order_num = tbl_orders_details_a174366_pt2.fld_order_num AND
        tbl_orders_a174366_pt2.fld_order_num = :oid");
      $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
      $oid = $_GET['oid'];
      $stmt->execute();
      $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
      }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Invoice</title>
  <!-- Bootstrap -->
    <link rel="icon" href="img/foodcanned2.ico" type="image/icon type">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body style="background-color: #e0e0eb;">
  


  <div class="row">
<div class="col-xs-6 text-center">
  <br>
    <img src="img/foodcanned.png" width="40%" height="30%">
</div>
<div class="col-xs-6 text-right">
  <h1><b>INVOICE</b></h1>
  <h5><b>Order: <?php echo $readrow['fld_order_num'] ?></b></h5>
  <h5><b>Date: <?php echo $readrow['fld_order_date'] ?></b></h5>
</div>
</div>
<hr>
<div class="row">
  <div class="col-xs-5">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4><b>From: Kai Cannaries Trading Sdn Bhd</b></h4>
      </div>
      <div class="panel-body">
        <p>
        No 100 Jalan Perindustrian Batu Caves <br>
        Taman Sunway <br>
        68100 <br>
        Batu Caves <br>
        </p>
      </div>
    </div>
  </div>
    <div class="col-xs-5 col-xs-offset-2 text-right">
        <div class="panel panel-default">
            <div class="panel-heading">
             <h4><b>To : <?php echo $readrow['fld_customer_fname']." ".$readrow['fld_customer_lname'] ?></b></h4>
            </div>
            <div class="panel-body">
        <p>
        Fakulti Teknologi dan Sains Maklumat <br>
        Universiti Kebangsaan Malaysia <br>
        43600 UKM, Bangi   <br>
        Selangor <br>
        </p>
            </div>
        </div>
    </div>
</div>

    <table class="table table-bordered">
  <tr>
    <th>No</th>
    <th>Product</th>
    <th class="text-right">Quantity</th>
    <th class="text-right">Price(RM)/Unit</th>
    <th class="text-right">Total(RM)</th>
  </tr>
      <?php
      $grandtotal = 0;
      $counter = 1;
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_orders_details_a174366_pt2,
            tbl_products_a174366_pt2 where 
            tbl_orders_details_a174366_pt2.fld_product_num = tbl_products_a174366_pt2.fld_product_num AND
            fld_order_num = :oid");
        $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
          $oid = $_GET['oid'];
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $detailrow) {
      ?>
      <tr>
        <td><?php echo $counter; ?></td>
        <td><?php echo $detailrow['fld_product_name']; ?></td>
        <td><?php echo $detailrow['fld_order_detail_quantity']; ?></td>
        <td><?php echo $detailrow['fld_product_price']; ?></td>
        <td><?php echo $detailrow['fld_product_price']*$detailrow['fld_order_detail_quantity']; ?></td>
      
      </tr>
       <?php
        $grandtotal = $grandtotal + $detailrow['fld_product_price']*$detailrow['fld_order_detail_quantity'];
        $counter++;
      } // while
      $conn = null;
      ?>
      <tr>
        <td colspan="4" align="right">Grand Total</td>
           <td><?php echo $grandtotal ?></td>
      </tr>
    </table>

   <div class="row">
  <div class="col-xs-5">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4><b>Bank Details</b></h4>
      </div>
      <div class="panel-body">
        <p>Khairul Amirin</p>
        <p>Bank Islam Malaysia Berhad (BIMB)</p>
        <p>SWIFT : </p>
        <p>Account Number : </p>
        <p>IBAN : </p>
      </div>
    </div>
    </div>
  <div class="col-xs-7">
    <div class="span7">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4><b>Contact Details</b></h4>
        </div>
        <div class="panel-body">
          <p> Staff: <?php echo $readrow['fld_staff_fname']." ".$readrow['fld_staff_lname'] ?> </p>
          <p> Email: <?php echo $readrow['fld_staff_email'] ?> </p>
          <p><br></p>
          <p><br></p>
          <p>Computer-generated invoice. No signature is required.</p>
        </div>
      </div>
    </div>
  </div>
</div>
 
 

</body>
</html>