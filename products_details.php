<!DOCTYPE html>
<?php
  include_once 'database.php';
  session_start();
if(!isset($_SESSION['admin_role']) AND !isset($_SESSION['staff_role'])){
  header("location: login.php");
}
?>

<html>
<head>
 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Kai Cannaries Trading Sdn Bhd : Products Details</title>
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
 
<?php include_once 'nav_bar.php'; ?>
    <?php
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM tbl_products_a174366_pt2 WHERE fld_product_num = :pid");
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $pid = $_GET['pid'];
      $stmt->execute();
      $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
      }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    ?>
    
<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 well well-sm text-center">
      <?php if ($readrow['fld_product_image'] == "" ) {
        echo "No image";
      }
      else { ?>
      <img src="products/<?php echo $readrow['fld_product_image'] ?>" class="img-responsive">
      <?php } ?>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-4">
      <div class="panel panel-default">
      <div class="panel-heading"><strong>Product Details</strong></div>
      <div class="panel-body">
          Below are specifications of the product.
      </div>
      <table class="table">
        <tr>
          <td class="col-xs-4 col-sm-4 col-md-4"><strong>Product ID</strong></td>
          <td><?php echo $readrow['fld_product_num'] ?></td>
        </tr>
        <tr>
          <td><strong>Name</strong></td>
          <td><?php echo $readrow['fld_product_name'] ?></td>
        </tr>
        <tr>
          <td><strong>Price</strong></td>
          <td>RM <?php echo $readrow['fld_product_price'] ?></td>
        </tr>
        <tr>
          <td><strong>Brand</strong></td>
          <td><?php echo $readrow['fld_product_brand'] ?></td>
        </tr>
        <tr>
          <td><strong>Labelled</strong></td>
          <td><?php echo $readrow['fld_product_condition'] ?></td>
        </tr>
        <tr>
          <td><strong>Net Weight</strong></td>
          <td><?php echo $readrow['fld_product_weight'] ?></td>
        </tr>
        <tr>
          <td><strong>Quantity</strong></td>
          <td><?php echo $readrow['fld_product_quantity'] ?></td>
        </tr>
      </table>
      </div>
    </div>
  </div>
</div>
 
    <style type="text/css">
  .bottom-footer{
    position: absolute;
    bottom: 0;
      background-color: #0d1a26;
      color: #f2f2f2;
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
    }
    </style>

<footer class="page-footer font-small bottom-footer">
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">
      © 2021 Copyright:
      <a style="color: #EDF0DA;" target="_blank" href="http://lrgs.ftsm.ukm.my/users/a174366/"> Khairul Amirin.</a> 
      Faculty of Information Science & Technology. UKM.
    </div>
    <!-- Copyright -->
</footer>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>