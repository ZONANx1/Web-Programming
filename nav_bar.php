<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

<style>

.navbar {
    
    background-color:  #0d1a26;
  }

  .fontlink {
    color: #f2f2f2;
    font-weight: 400;
  }

</style>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
      <a class="navbar-brand p-0 me-2" href="index.php" aria-label="foodcanned">
          <h4 class="fw-bolder" style="margin-top: 0.05rem; font-family: Arial, Helvetica, sans-serif;"><b><font color="#f2f2f2">Food Canned</font></b></h4>
        </a>
    </div>
 
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <li><a href="index.php"><font color="#f2f2f2">Home</font></a></li>
    </ul>
      
     
        <ul class="nav navbar-nav">
      <li><a href="products.php"><font color="#f2f2f2">Add Products</font></a></li>
    </ul>

    <ul class="nav navbar-nav">
      <li><a href="search.php"><font color="#f2f2f2">Search Products</font></a></li>
    </ul>

         <ul class="nav navbar-nav">
      <li><a href="staffs.php"><font color="#f2f2f2">Staff</font></a></li>
    </ul>

    <ul class="nav navbar-nav">
      <li><a href="customers.php"><font color="#f2f2f2">Customer</font></a></li>
    </ul>

     <ul class="nav navbar-nav">
      <li><a href="orders.php"><font color="#f2f2f2">Orders</font></a></li>
    </ul>

    <ul class="nav navbar-nav navbar-right">
      
    <?php

        if(isset($_SESSION['staff_role'])){
          $role = $_SESSION['staff_role'];
          $name = $_SESSION['staff_fname'];
        }else{
          $role = $_SESSION['admin_role'];
          $name = $_SESSION['admin_fname'];
        }
        
        echo '<li class="nav-item">';
        echo '<a class="nav-link fontlink" href="">'.$role.' | '.$name.'</a>';
        echo '</li>';
        
        ?>

     <li class="nav-item">
          <a class="nav-link active fontlink" aria-current="page" href="logout.php"> <span class="glyphicon glyphicon-log-out"><font color="#f2f2f2"> Logout</font></a>
        </li>

      </ul>
    
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>