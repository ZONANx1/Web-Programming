<?php
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
  <title>Kai Cannaries Trading Sdn Bhd : Home</title>
  <!-- Bootstrap -->
  <link rel="icon" href="img/foodcanned2.ico" type="image/icon type">
  <link href="css/bootstrap.min.css" rel="stylesheet">
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    

</head>
<body background="img/background.gif">
 
  <?php include_once 'nav_bar.php'; ?>
 
    <center>
      <img src="img/foodcanned.png">
      </center>
    <!-- <div class="txt-menu">
      <h1>Welcome to <br>Unique Gift Shop!!</h1>
      <blockquote><p>“Someone I loved once gave me a box full of darkness. It took me years to understand that this too, was a gift.”
      ― Mary Oliver</p><p>“Everyone has a gift for something, even if it is the gift of being a good friend.”
      ― Marian Anderson</p></blockquote>
    </div>
    <div class="image-menu">
      <img src="giftlogo.png">
    </div> -->
  
 
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