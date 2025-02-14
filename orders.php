<?php
include_once 'orders_crud.php';
session_start();
if(!isset($_SESSION['admin_role']) AND !isset($_SESSION['staff_role'])){
  header("location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Kai Cannaries Trading Sdn Bhd : Orders</title>
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
 
<div class="container-fluid">
 
 <div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="page-header">
        <h2><b>Create New Order</b></h2>
      </div>
    <form action="orders.php" method="post" class="form-horizontal" onsubmit="return checkValidation()">
       <div class="form-group">
          <label for="orderid" class="col-sm-3 control-label">Order ID</label>
          <div class="col-sm-9">
     <input name="oid" type="text" class="form-control" id="orderid" placeholder="Order ID" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['fld_order_num']; ?>">
     </div>
        </div>
      <div class="form-group">
          <label for="orderd" class="col-sm-3 control-label">Order Date</label>
          <div class="col-sm-9">
      <input name="orderdate" type="text" class="form-control" id="orderd" placeholder="Order Date" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['fld_order_date']; ?>"> 
    </div>
  </div>
   <div class="form-group">
          <label for="staff" class="col-sm-3 control-label">Staff</label>
          <div class="col-sm-9">
      <td><select name="sid" class="form-control" id="staff" >
         <option value="" disable selected>Please Select</option>
        <?php
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a174366_pt2");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $staffrow) {
      ?>
        <?php if((isset($_GET['edit'])) && ($editrow['fld_staff_num']==$staffrow['fld_staff_num'])) { ?>
           <option value="<?php echo $staffrow['fld_staff_num']; ?>" selected><?php echo $staffrow['fld_staff_fname']." ".$staffrow['fld_staff_lname'];?></option>
        <?php } else { ?>
          <option value="<?php echo $staffrow['fld_staff_num']; ?>"><?php echo $staffrow['fld_staff_fname']." ".$staffrow['fld_staff_lname'];?></option>
        <?php } ?>
      <?php
      } // while
      $conn = null;
      ?> 
      </select> </td>
    </div>
  </div>
   <div class="form-group">
          <label for="customer" class="col-sm-3 control-label">Customer</label>
          <div class="col-sm-9">
      <td><select name="cid" class="form-control" id="customer" >
         <option value="" selected>Please Select</option>
         <?php
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_customers_a174366_pt2");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $custrow) {
      ?>
        <?php if((isset($_GET['edit'])) && ($editrow['fld_customer_num']==$custrow['fld_customer_num'])) { ?>
          <option value="<?php echo $custrow['fld_customer_num']; ?>" selected><?php echo $custrow['fld_customer_fname']." ".$custrow['fld_customer_lname']?></option>
        <?php } else { ?>
          <option value="<?php echo $custrow['fld_customer_num']; ?>"><?php echo $custrow['fld_customer_fname']." ".$custrow['fld_customer_lname']?></option>
        <?php } ?>
      <?php
      } // while
      $conn = null;
      ?> 
      </select> </td>
       </div>
        </div>
        <div class="form-group">

    <!-- UPDATE, CREATE AND CLEAR BUTTON -->
    <div class="col-sm-offset-3 col-sm-9">
      <?php if (isset($_GET['edit'])) { ?>
      <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
          <?php } else { ?>
          <button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
          <?php } ?>
      <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
     </div>
      </div>

      <!-- ROLE MESSAGES -->

            <?php
              if (isset($_SESSION['staff_role'])) {
            ?>

            <div class="accordion">
              <div class="card">
                <div class="card-header" id="headingMsg">
                  <h5 class="mb-0">
                    <button type="reset" class="btn btn-warning" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Important Message for Normal Staff
                    </button>
                  </h5>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingMsg" data-parent="#accordion">
                  <div class="card-body">
                    Normal staff cannot update or delete any order information. Only staff at admin level can make the change.
                  </div>
                </div>
              </div>
            </div>

            <?php
              }
            ?>
    </form>
    </div>
  </div>
    <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2><b>Order List</b></h2>
      </div>
      <table class="table table-striped table-bordered">
        <tr>
         <th>Order ID</th>
         <th>Order Date</th>
         <th>Staff</th>
         <th>Customer</th>
         <th></th>   
      </tr>
    <?php
    // Read
      $per_page = 5;
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;
      $start_from = ($page-1) * $per_page;

      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tbl_orders_a174366_pt2, tbl_staffs_a174366_pt2, tbl_customers_a174366_pt2 WHERE ";
        $sql = $sql."tbl_orders_a174366_pt2.fld_staff_num = tbl_staffs_a174366_pt2.fld_staff_num and ";
         $sql = $sql."tbl_orders_a174366_pt2.fld_customer_num = tbl_customers_a174366_pt2.fld_customer_num LIMIT {$start_from}, {$per_page}";
         $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $orderrow) {
      ?>
      <tr>
        <td><?php echo $orderrow['fld_order_num']; ?></td>
        <td><?php echo $orderrow['fld_order_date']; ?></td>
        <td><?php echo $orderrow['fld_staff_fname']." ".$orderrow['fld_staff_lname'] ?></td>
        <td><?php echo $orderrow['fld_customer_fname']." ".$orderrow['fld_customer_lname'] ?></td>

         <?php
            if (isset($_SESSION['admin_role'])) {
         ?>

        <td>
          <a href="orders_details.php?oid=<?php echo $orderrow['fld_order_num']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
          <a href="orders.php?edit=<?php echo $orderrow['fld_order_num']; ?>" class="btn btn-success btn-xs" role="button"> Edit </a>
          <a href="orders.php?delete=<?php echo $orderrow['fld_order_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
        </td>
      <?php
                  }else{
                ?>
                <td>
                  <a href="orders_details.php?oid=<?php echo $orderrow['fld_order_num']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
                </td>
                <?php
                  }
                ?>
              </tr>
            <?php } ?>
    </table>
     </div>
  </div>
  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <nav>
          <ul class="pagination">
          <?php
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM tbl_orders_a174366_pt2");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $total_records = count($result);
          }
          catch(PDOException $e){
                echo "Error: " . $e->getMessage();
          }
          $total_pages = ceil($total_records / $per_page);
          ?>
          <?php if ($page==1) { ?>
            <li class="disabled"><span aria-hidden="true">«</span></li>
          <?php } else { ?>
            <li><a href="orders.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"orders.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"orders.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="orders.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
</div>
</div>

   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

 <?php include_once 'footer.php';?>
 
</body>
<script type="text/javascript">
      function checkValidation(){
        var staff = document.getElementById("staff").value;
        var cust = document.getElementById("customer").value;

        errorMsg = "-WARNING-\n\n";

        if(staff == ""){
          errorMsg += '-Please choose a staff-\n';
        }
        if(cust == ""){
          errorMsg += '-Please choose a customer-';
        }

        if(errorMsg !== "-WARNING-\n\n"){
          alert(errorMsg);
          return false;
        }

        return true;
      }
    </script>
</html>