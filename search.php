 <?php
include_once 'products_crud.php';
session_start();
if(!isset($_SESSION['admin_role']) AND !isset($_SESSION['staff_role'])){
  header("location: login.php");
}
?>
<style type="text/css">
 .button {
  background-color: #0d1a26; /* Green */
  border: none;
  color: white;
  padding: 12px 30px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
</style>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Kai Cannaries Trading Sdn Bhd : Search Product</title>
<!-- Bootstrap -->
<link rel="icon" href="img/foodcanned2.ico" type="image/icon type">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>

<body style="background-color: #e0e0eb;">

 <?php include_once 'nav_bar.php'; ?>

<?php
	require 'database.php';
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	if(!$conn){
		die("Error: Failed to coonect to database!");
	}

	?>
<script>
		function check_validate(){
  var keyword = document.getElementById('searchkeywords');
 if (keyword.value == "") {
    alert("Please insert your search product"); 
     keyword.focus();
       return false;
  // show a pop up box says "Please insert your MyCard number"
  // put cursor inside the MyCard textbox
}
}
</script>
<form action="search.php" method="post" >
	  
       <section class="text-center">
        <div class="row py-lg-1">
          <div class="container mb-5 content">
            <div class="col-lg-12 col-md-12 mx-auto">
              <h1 class="text-white">Search Product</h1>
              <hr>
              <p class="text-muted fw-normal">Search product by either product name, brand, labelled or all three.</p>
            </div>

            <form action="search.php" method="post" class="row g-2 needs-validation" novalidate>
              <div class="col-md-12">
                <input type="text" style="text-align:center" class="form-control form-control-lg" name="keyword" placeholder="Chicken or Meat, Prego or M-Shrooms, Non-Halal" required>
              </div>
              &nbsp
              <div class="mt-4">
                <button class="button" type="submit" name="search" id="is_search" onclick="return check_validate()"><span class="glyphicon glyphicon-search"></span>Search</button>
              </div>
            </form>
          </div>
        </div>
      </section>
</form>

	<div class="row justify-content-md-center" style="margin-right: 0">
		<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
			<div class="pb-2 mt-4 mb-2 border-bottom">
				<h2>Products List</h2>
			</div>
			<table class="table table-striped table-hover align-middle mt-4">
				<tr class="table-dark">
					<th>Product ID</th>
					<th>Product Name</th>
					<th>Price</th>
					<th>Brand</th>
					<th>Labelled</th>
					<th>Net Weight</th>
					<th>In-Stock Quantity</th>
					<th></th>
				</tr>

				<?php

					if(!empty($_POST))
                 {
					$aKeyword = explode(" ", $_POST['keyword']);
					$q = "SELECT * FROM `tbl_products_a174366_pt2` WHERE `fld_product_name` LIKE '%". $aKeyword[0] ."%' OR `fld_product_brand` LIKE '%". $aKeyword[0] ."%' OR `fld_product_condition` LIKE '%". $aKeyword[0] ."%'";

					for ($i=1; $i < count($aKeyword) ; $i++) { 
						if(!empty($aKeyword[$i])){
							$q .= " OR `fld_product_name` LIKE '%" . $aKeyword[$i] . "%' OR `fld_product_brand` LIKE '%" . $aKeyword[$i] . "%' OR `fld_product_condition` LIKE '%" . $aKeyword[$i] . "%'";
						}
					}

					$query = $conn->prepare($q);
					$query->execute();
					$countRow = $query->rowCount();

					if($countRow > 0){
					while ($row = $query->fetch()) {

				?>
				<tr>
					 <td><?php echo $row['fld_product_num']; ?></td>
         <td><?php echo $row['fld_product_name']; ?></td>
        <td><?php echo $row['fld_product_price']; ?></td>
        <td><?php echo $row['fld_product_brand']; ?></td>
        <td><?php echo $row['fld_product_condition']; ?></td>
        <td><?php echo $row['fld_product_weight']; ?></td>
        <td><?php echo $row['fld_product_quantity']; ?></td>
					<td>
							<a href="products_details.php?pid=<?php echo $row['fld_product_num']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
						</td>
				</tr>
				<?php
					}
				}else{
					// echo $countRow;
				?>
				
			</table>

				<p>No results found...</p>
				<?php
				}
			}
				?>
		
		</div>
	</div>


	  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>



    

</body>
</html>


