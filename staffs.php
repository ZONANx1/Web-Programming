<?php
  include_once 'staffs_crud.php';
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
  <title>Kai Cannaries Trading Sdn Bhd : Staffs</title>
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
        <h2><b>Create New Staff</b></h2>
      </div>
    <form action="staffs.php" method="post" class="form-horizontal">

  <div class="form-group">
          <label for="staffid" class="col-sm-3 control-label">ID</label>
          <div class="col-sm-9">
      <input name="sid" type="text"  class="form-control" id="staffid" placeholder="Staff ID" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_num']; else echo $num; ?>"  readonly required>
    </div>
        </div>
        
      <div class="form-group">
          <label for="firstname" class="col-sm-3 control-label">First Name</label>
          <div class="col-sm-9">
     <input name="fname" type="text"  class="form-control" id="firstname" placeholder="First Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_fname']; ?>" required> 
</div>
        </div>

        <div class="form-group">
          <label for="lastname" class="col-sm-3 control-label">Last Name</label>
          <div class="col-sm-9">
      <input name="lname" type="text"  class="form-control" id="lastname" placeholder="Last Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_lname']; ?>" required> 
      <div class="form-group">
        </div>
        </div> 

          <label for="staffgender" class="col-sm-3 control-label">Gender</label>
          <div class="col-sm-9">
          <div class="radio">
            <label>
     <input name="gender" type="radio" id="staffgender" value="Male" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_gender']=="Male") echo "checked"; ?> required> Male
       </label>
          </div>
          <div class="radio">
            <label>
      <input name="gender" type="radio" id="staffgender" value="Female" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_gender']=="Female") echo "checked"; ?>> Female 
      </label>
    </div>
            </div>
          </div>
    <div class="form-group">
          <label for="phonenumber" class="col-sm-3 control-label">Phone Number</label>
          <div class="col-sm-9">
      <input name="phone" type="text" class="form-control" id="phonenumber" placeholder="Phone Number E.g.(+6012-3456789)" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_phone']; ?>" pattern="([+][6][0][0-9]{2})-([0-9]{7})" required> 
      </div>
          </div>
   <div class="form-group">
          <label for="staffemail" class="col-sm-3 control-label">Email</label>
          <div class="col-sm-9">
     <input name="email" type="text" class="form-control" id="staffemail" placeholder="Email" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_email']; ?>" pattern=".+@gmail.com" required> 
      </div>
          </div>

          <div class="form-group">
          <label for="stafflevel" class="col-sm-3 control-label">Staff Level</label>
          <div class="col-sm-9">
          <div class="radio">
            <label>
     <input name="role"  type="radio" value="admin" id="stafflevel" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_level']=="admin") echo "checked"; ?> required> Admin
       </label>
          </div>
          <div class="radio">
            <label>
      <input name="role"  type="radio" value="staff" id="stafflevel" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_level']=="staff") echo "checked"; ?>> Normal Staff
      </label>
    </div>
  </div>
</div>

<div class="form-group">
          <label for="password" class="col-sm-3 control-label">Password</label>
          <div class="col-sm-9">
     <input name="password" type="password" class="form-control" id="password" placeholder="Password"  value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_password']; ?>" required>
      </div>
    </div>

        <?php
          if(isset($_SESSION['admin_role'])){
            ?>

       <!-- UPDATE, CREATE AND CLEAR BUTTON -->
       <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
      <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldsid" value="<?php echo $editrow['fld_staff_num']; ?>">
    <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
          <?php } else { ?>
          <button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
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
                    Normal staff cannot create, update or delete any staff information. Only staff at admin level can make the change.
                  </div>
                </div>
              </div>
            </div>

          <?php } ?>
      </form>
    </div>
  </div>
</div>
    <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2><b>Staffs List</b></h2>
      </div>
      <table class="table table-striped table-bordered">
        <tr>
           <th>Staff ID</th>
          <th>First Name</th>
          <th>Last name</th>
          <th>Gender</th>
          <th>Phone Number</th>
          <th>Email</th>
          
          <?php 
            if (isset($_SESSION['admin_role'])) {
              echo "<th>Staff Level</th>";
              echo "<th>Password</th>";
              echo "<th></th>";
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
          $stmt = $conn->prepare("select * from tbl_staffs_a174366_pt2 LIMIT $start_from, $per_page");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) { ?>
      <tr>
        <td><?php echo $readrow['fld_staff_num']; ?></td>
        <td><?php echo $readrow['fld_staff_fname']; ?></td>
        <td><?php echo $readrow['fld_staff_lname']; ?></td>
        <td><?php echo $readrow['fld_staff_gender']; ?></td>
        <td><?php echo $readrow['fld_staff_phone']; ?></td>
        <td><?php echo $readrow['fld_staff_email']; ?></td>

        <?php
              if(isset($_SESSION['admin_role'])){
                ?>
                <td><?php echo ucwords($readrow['fld_staff_level']); ?></td>
                <td><?php echo ucwords($readrow['fld_staff_password']); ?></td>
                
        <td>
           <a href="staffs.php?edit=<?php echo $readrow['fld_staff_num']; ?>" class="btn btn-success btn-xs" role="button"> Edit </a>
          <a href="staffs.php?delete=<?php echo $readrow['fld_staff_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
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
            $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a174366_pt2");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $total_records = count($result);
          }
          catch(PDOException $e){
                echo "Error: " . $e->getMessage();
          }
          $total_pages = ceil($total_records/$per_page);
          ?>
          <?php if ($page==1) { ?>
            <li class="disabled"><span aria-hidden="true">«</span></li>
          <?php } else { ?>
            <li><a href="staffs.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"staffs.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"staffs.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="staffs.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
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
      var staffID = document.getElementById("staffid").value;
      var staffPhone = document.getElementById("phonenumber").value;
      var staffGender = document.querySelector("input[name='gender']:checked");
      var staffName = document.getElementById("stafffirstname").value;
      var staffName2 = document.getElementById("stafflastname").value;
      
      var staffEmail = document.getElementById("email").value;
      var staffPass = document.getElementById("password").value;
      var level = document.querySelector("input[name='role']:checked");
      var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

      var firstletter = staffID.slice(0, 1);
      var lastword = staffID.slice(1, staffID.length);
      var dashphone = staffPhone.slice(3, 4);

      var errorMsg="-WARNING-\n\n";
        // console.log(lastword);
        // console.log(firstletter);
        // console.log(staffPhone + dashphone);
        // if(firstletter !== 'S'){
        //  alert('Please use capital "S" letter for staff ID');
        //  return false;
        // }
        if(staffName == ""){
          errorMsg += '-Please enter staff first name-\n';
        }
        if(staffName2 == ""){
          errorMsg += '-Please enter staff last name-\n';
        }
        if(staffEmail == ""){
          errorMsg += '-Please enter staff email-\n';
        }else if(!(validRegex.test(staffEmail))){
          errorMsg += '-Please use gmail account-\n';
        }
        if(staffPass == ""){
          errorMsg += '-Please enter staff password-\n';
        }
        if(staffGender == null){
          errorMsg += '-Please choose a gender-\n';
        }
        
        if(staffPhone.length > 11 || staffPhone.length == 0){
          errorMsg += '-Please enter staff phone number-\n';
        }
        else if(dashphone !== '-'){
          errorMsg +='-Please enter the correct phone number with dash-\n';
        }
        if(level == null){
          errorMsg +='-Please choose staff level-\n';
        }

        if(errorMsg !== "-WARNING-\n\n"){
          alert(errorMsg);
          return false
        }
        return true;
      }
    </script>
</html>