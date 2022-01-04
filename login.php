<?php require_once 'auth.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="icon" href="img/foodcanned2.ico" type="image/icon type">
  <title>Login - Kai Trading Sdn Bhd</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  #wrapper-form{

     margin-top: 10px;
     margin-right: auto; /* 1 */
     margin-left: auto; /* 1 */
     max-width:800px; /* 2 */
     padding-right: 10px; /* 3 */
     padding-left: 10px;

    }
  .modal-header, h4, .close {

      
      color:white !important;
      text-align: center;
      font-size: 30px;
  }
  .modal-footer {
    width: 100%;
      background-color: #f9f9f9;
  }

  .button {
  background-color: Transparent; /* Green */
  border: none;
  color: white;
  padding: 12px 30px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}

    

  </style>
</head>
<body background="img/background.gif">

    
      <!-- Modal content-->
      <div id="wrapper-form">
      <div class="modal-content" >
        <div class="modal-header" style="padding:0px 0px;">
          

          <h4><span class="glyphicon glyphicon-lock"></span>Login</h4>
        </div>

        <div class="modal-body" style="padding:40px 50px;">
         <form  onsubmit="return validateForm();" method="post">
            <div class="form-group">
              <label for="email"><span class="glyphicon glyphicon-user"></span>Email Address</label>
            </div>
              <div class="form-group">
              <input type="email" id="email" name="email" class="form-control" id="usrname"aria-describedby="emailHelp" placeholder="Enter your email here..." autocomplete="off" required="">
              <small id="emailHelp" class="form-text text-muted">E.g. example@gmail.com</small>
            </div>

            <div class="form-group">
              <label for="password"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
            </div>
               <div class="form-group">
              <input type="password" name="password" id="password" class="form-control" placeholder="Enter password here..." aria-describedby="passwordHelp" required="">
              <small id="passwordHelp" class="form-text text-muted">Must more than 6 character</small>
            </div>

            <div class="form-group">
              <label>Staff level</label>
              <div class="form-check">
              <input type="radio" name="userlevel" class="form-check-input" value="admin" id="radio-btn" required="">
              <label class="form-check-label" for="radio-btn">Admin</label>
              </div>
              <div class="form-check">
              <input type="radio" name="userlevel" class="form-check-input" value="staff" id="radio-btn">
              <label class="form-check-label" for="radio-btn">Normal Staff</label>
               </div>
           </div>

            
            <center>
              <button type="submit" name="login" class="button" style="width: 25%"  ><span class="glyphicon glyphicon-off"></span> Login</button>
              <button type="reset" name="reset" class="button" style="width: 25%;">Clear</button>

            </center>

           
            
          </form>
        
          
               
      </div>
  </div>
  
</body>
   
   
<script type="text/javascript">
  function validateForm() {
    var username = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var level = document.querySelector("input[name='userlevel']:checked");

    var errorMsg = "";

    if (username == "") {
      errorMsg += '-Please insert your email first-\n';
    }
    if (password.length == 0) {
      errorMsg += '-Please enter your password first-\n';
    }else if(password.length < 6){
      errorMsg += '-Please enter more than 6 character-\n';
    }
    if(level == null){
      errorMsg +='-Please choose staff level-\n';
    }

    if(errorMsg == ""){
      <?php 
      if($errorMsg!= null){ 
        echo "errorMsg += '-".$errorMsg."-';";
      }
      ?>
    }


    if(errorMsg!==""){
      alert(errorMsg);
      return false;
    }

    return true;
  }



</script>
</html>
