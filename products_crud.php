<?php

include_once 'database.php';

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Create
if (isset($_POST['create'])) {

  $target_dir = "products/";
  $target_file = $target_dir . basename($_FILES['img']['name']);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  //Check existing image file
  if(empty($_FILES['img']['name'])){
    echo "<script>alert('Please choose an image');</script>";
    $uploadOk = 0;
  }
  else{

    // Check if image file is a actal image or fake image
    $check = getimagesize($_FILES['img']['tmp_name']);
    if($check !== false)
      $uploadOk = 1;
    else{
      echo "<script>alert('Selected file is not an image. Please choose a image');</script>";
      $uploadOk = 0;
    } 

    //Check file size
    if($_FILES['img']['size'] > 10000000){
      echo "<script>alert('Selected image size is above 10MB. Please choose another image');</script>";
      $uploadOk = 0;
    }

    //Allow certain formats
    if($imageFileType != "jpg" && $imageFileType != "gif"){
      function function_alert($message) {
      
    // Display the alert box 
    echo "<script>alert('$message');</script>";
}
  
  
// Function call
function_alert("Welcome to Geeks for Geeks");
      
    }
  }

  

  //Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "<script>alert('Sorry, this data won't be saved');</script>";
    header("location: products.php");
  }else{

    if (move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {

      try {

        $stmt = $conn->prepare("INSERT INTO tbl_products_a174366_pt2(fld_product_num,
        fld_product_name, fld_product_price, fld_product_brand, fld_product_condition,
        fld_product_weight, fld_product_quantity, fld_product_image) VALUES(:pid, :name, :price, :brand,
        :cond, :weight, :quantity, :picture)");

      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);
      $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
      $stmt->bindParam(':cond', $cond, PDO::PARAM_STR);
      $stmt->bindParam(':weight', $weight, PDO::PARAM_INT);
      $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
      $stmt->bindParam(':picture', $picture, PDO::PARAM_STR);

         $pid = $_POST['pid'];
      $name = $_POST['name'];
      $price = $_POST['price'];
      $brand =  $_POST['brand'];
      $cond = $_POST['cond'];
      $weight = $_POST['weight'];
      $quantity = $_POST['quantity'];
        $picture = $_FILES['img']['name'];

        $stmt->execute();
        header("location: products.php");
      }

      catch(PDOException $e)
      {
        echo "Error: " . $e->getMessage();
      }
    }
  } 
}

//Update
if (isset($_POST['update'])) {

  $temp_image = basename($_FILES['img']['name']);

  if ($temp_image == "") {

    try {

      $stmt = $conn->prepare("UPDATE tbl_products_a174366_pt2 SET fld_product_num = :pid,
        fld_product_name = :name, fld_product_price = :price, fld_product_brand = :brand,
        fld_product_condition = :cond, fld_product_weight = :weight, fld_product_quantity = :quantity
        WHERE fld_product_num = :oldpid");

         $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);
      $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
      $stmt->bindParam(':cond', $cond, PDO::PARAM_STR);
      $stmt->bindParam(':weight', $weight, PDO::PARAM_INT);
      $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
      $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR);

      $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $brand =  $_POST['brand'];
    $cond = $_POST['cond'];
    $weight = $_POST['weight'];
    $quantity = $_POST['quantity'];
    $oldpid = $_POST['oldpid'];

      $stmt->execute();

      header("Location: products.php");
    }

    catch(PDOException $e)
    {
      echo "Error: " . $e->getMessage();
    }
  }else{

    $target_dir = "products/";
    $target_file = $target_dir . basename($_FILES['img']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  // Check if image file is a actal image or fake image
    $check = getimagesize($_FILES['img']['tmp_name']);
    if($check !== false)
      $uploadOk = 1;
    else{
      echo "<script>alert('Selected file is not an image. Please choose a image');</script>";
      $uploadOk = 0;
    } 

  //Check file size
    if($_FILES['img']['size'] > 10000000){
      echo "<script>alert('Selected image size is above 10MB. Please choose another image');</script>";
      $uploadOk = 0;
    }

  //Allow certain formats
    if($imageFileType != "jpg" && $imageFileType != "gif"){
      echo "<script>alert('Only image file JPG and GIF type are accepted. Please choose another image');</script>";
      $uploadOk = 0;
    }

  //Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "<script>alert('Something went wrong. Please refresh this page');</script>";
    }else{

      if (move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {

        try {
          //SELECT AND UNLINK IMAGE FILE
          $stmt = $conn->prepare("SELECT fld_product_image FROM tbl_products_a174366_pt2 WHERE fld_product_num = :pid");

          $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
          $pid = $_POST['pid'];
          $stmt->execute();
          $result = $stmt->fetch();

          $path = 'products/'.$result['fld_product_image'];
          unlink($path);

          $stmt = $conn->prepare("UPDATE tbl_products_a174366_pt2 SET fld_product_num = :pid,
        fld_product_name = :name, fld_product_price = :price, fld_product_brand = :brand,
        fld_product_condition = :cond, fld_product_weight = :weight, fld_product_quantity = :quantity, fld_product_image =:picture 
            WHERE fld_product_num = :oldpid");

         $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
         $stmt->bindParam(':name', $name, PDO::PARAM_STR);
          $stmt->bindParam(':price', $price, PDO::PARAM_INT);
          $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
          $stmt->bindParam(':cond', $cond, PDO::PARAM_STR);
          $stmt->bindParam(':weight', $weight, PDO::PARAM_INT);
          $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
          $stmt->bindParam(':picture', $picture, PDO::PARAM_STR);
          $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR);

         $pid = $_POST['pid'];
         $name = $_POST['name'];
         $price = $_POST['price'];
         $brand =  $_POST['brand'];
         $cond = $_POST['cond'];
         $weight = $_POST['weight'];
         $quantity = $_POST['quantity'];
          $picture = $_FILES['img']['name'];
          $oldpid = $_POST['oldpid'];

          $stmt->execute();
          header("location: products.php");
        }

        catch(PDOException $e)
        {
          echo "Error: " . $e->getMessage();
        }
      }
    } 
  }
}

//Delete
if (isset($_GET['delete'])) {

  try {
    // SELECT WHICH IMAGE FILE TO DELETE
    $stmt = $conn->prepare("SELECT fld_product_image FROM tbl_products_a174366_pt2 WHERE fld_product_num = :pid");

    $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
    $pid = $_GET['delete'];
    $stmt->execute();
    $result = $stmt->fetch();

    $path = 'products/'.$result['fld_product_image'];

    //DELETE IMAGE FILE AND OTHERS DATA
    $stmt = $conn->prepare("DELETE FROM tbl_products_a174366_pt2 WHERE fld_product_num = :pid");
  
    $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
    $pid = $_GET['delete'];

    if($path !== 'products/nophoto.png'){
      unlink($path);
    }
    $stmt->execute();
    
    header("Location: products.php");
  }
  
  catch(PDOException $e)
  {
    echo "Error: " . $e->getMessage();
  }
}

//Edit
if (isset($_GET['edit'])) {

  try {

    $stmt = $conn->prepare("SELECT * FROM tbl_products_a174366_pt2 WHERE fld_product_num = :pid");
    
    $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
    
    $pid = $_GET['edit'];
    
    $stmt->execute();
    
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
  }
  
  catch(PDOException $e)
  {
    echo "Error: " . $e->getMessage();
  }
}

$num = $conn->query("SELECT MAX(fld_product_num) AS pid FROM tbl_products_a174366_pt2")->fetch()['pid'];

if($num){
  $num = ltrim($num, 'P')+1;
  $num = 'P'.str_pad($num, 3, "0", STR_PAD_LEFT);
}else{
  $num = 'P'.str_pad(1,3,"0",STR_PAD_LEFT);
}

$conn = null;
?>