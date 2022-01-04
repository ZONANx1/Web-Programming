<?php
  include_once 'customers_crud.php';
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
  <title>Kai Cannaries Trading Sdn Bhd : Customers</title>
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
        <h2><b>Insert New Customer</b></h2>
      </div>
    <form action="customers.php" method="post"  class="form-horizontal">

<div class="form-group">
          <label for="customerid" class="col-sm-3 control-label">Customer ID</label>
          <div class="col-sm-9">
      <input name="cid" type="text" class="form-control" id="customerid" placeholder="Customer ID" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_num']; else echo $num;?>" readonly required>
      </div>
        </div>

      <div class="form-group">
          <label for="firstname" class="col-sm-3 control-label">First Name</label>
          <div class="col-sm-9">
     <input name="fname" type="text" class="form-control" id="firstname" placeholder="First Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_fname']; ?>" required>
    </div>
        </div>

      <div class="form-group">
          <label for="lastname" class="col-sm-3 control-label">Last Name</label>
          <div class="col-sm-9">
      <input name="lname" type="text" class="form-control" id="lastname" placeholder="Last Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_lname']; ?>" required> 
    </div>
        </div>  

        <div class="form-group" >
          <label for="customersex" class="col-sm-3 control-label">Gender</label>
          <div class="col-sm-9">
          <div class="radio">
            <label>
      <input name="gender" type="radio" id="customersex" value="Male" <?php if(isset($_GET['edit'])) if($editrow['fld_customer_gender']=="Male") echo "checked"; ?> required> Male
      </label>
          </div>
          <div class="radio">
            <label>
      <input name="gender" type="radio" id="customersex" value="Female" <?php if(isset($_GET['edit'])) if($editrow['fld_customer_gender']=="Female") echo "checked"; ?> > Female 
      </label>
            </div>
          </div>
</div>
          <div class="form-group">
          <label for="phonenumber" class="col-sm-3 control-label">Phone Number</label>
          <div class="col-sm-9">
      <input name="phone" type="text" class="form-control" id="phonenumber" placeholder="Phone Number E.g.(+6012-3456789)" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_phone']; ?>" pattern="([+][6][0][0-9]{2})-([0-9]{7})" required> 
       </div>
        </div>

      <?php
          if(isset($_SESSION['admin_role'])){
            ?> 

    <!-- UPDATE, CREATE AND CLEAR BUTTON -->
    <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
      <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldcid" value="<?php echo $editrow['fld_customer_num']; ?>">

      <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true" onclick="return checkValidation();"></span> Update</button>
          <?php } else { ?>
          <button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true" onclick="return checkValidation();"></span> Create</button>
          <?php } ?>
          <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
     </div>
      </div>

      <?php
          }else{
            ?>

            <!-- ROLE MESSAGES -->
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
                    Normal staff cannot create, update or delete any customer information. Only staff at admin level can make the change.
                  </div>
                </div>
              </div>
            </div>

          <?php } ?>
      </form>
    </div>
  </div>
    
  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2><b>Customers List</b></h2>
      </div>
      <table class="table table-striped table-bordered">

        <tr>
          <th>Customer ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Gender</th>
          <th>Phone Number</th>
          
          <?php
            if(isset($_SESSION['admin_role'])){
              echo '<th></th>';
            }
            ?>
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
          $stmt = $conn->prepare("select * from tbl_customers_a174366_pt2 LIMIT $start_from, $per_page");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?>
      <tr>
        <td><?php echo $readrow['fld_customer_num']; ?></td>
        <td><?php echo $readrow['fld_customer_fname']; ?></td>
        <td><?php echo $readrow['fld_customer_lname']; ?></td>
        <td><?php echo $readrow['fld_customer_gender']; ?></td>
        <td><?php echo $readrow['fld_customer_phone']; ?></td>

        <?php
              if (isset($_SESSION['admin_role'])) {
                ?>
        <td>
          <a href="customers.php?edit=<?php echo $readrow['fld_customer_num']; ?>" class="btn btn-success btn-xs" role="button"> Edit </a>
          <a href="customers.php?delete=<?php echo $readrow['fld_customer_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
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
            $stmt = $conn->prepare("SELECT * FROM tbl_customers_a174366_pt2");
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
            <li><a href="customers.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"customers.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"customers.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="customers.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
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
      var custID = document.getElementById("customerid").value;
      var custPhone = document.getElementById("phonenumber").value;
      var custGender = document.querySelector("input[name='gender']:checked");
      var custName = document.getElementById("firstname").value;
      var custName2 = document.getElementById("lastname").value;

      var firstletter = custID.slice(0, 1);
      var lastword = custID.slice(1, custID.length);
      var dashphone = custPhone.slice(3, 4);

        // console.log(lastword);
        // console.log(firstletter);

        var errorMsg="-WARNING-\n\n";
        // if(firstletter !== 'C'){
        //  errorMsg +='Please use capital "C" letter for customer ID\n';
        // }
        if(custName == ""){
          errorMsg += '-Please enter customer first name-\n';
        }
        if(custName2 == ""){
          errorMsg += '-Please enter customer last name-\n';
        }
        if(custGender == null){
          errorMsg +='-Please choose a gender-\n';
        }
        if(custPhone.length > 11 || custPhone.length == 0){
          errorMsg +='-Please enter customer phone number-\n';
        }
        else if(dashphone !== '-'){
          errorMsg +='-Please enter the correct phone number with dash-\n';
        }

        if(errorMsg !== "-WARNING-\n\n"){
          alert(errorMsg);
          return false;
        }
        return true;
      }
    </script>
</html>