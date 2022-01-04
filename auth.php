<?php
require_once 'database.php';

try{
	$db = new PDO("mysql:host={$servername}; dbname={$dbname}", $username, $password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
	$e->getMessage();
}

session_start();

if(isset($_SESSION['admin_role']) OR isset($_SESSION['staff_role'])){
		header("location: login.php");
	}	

if(isset($_REQUEST['login'])){
	$email = $_REQUEST['email'];
	$password = $_REQUEST['password'];
	$role = $_REQUEST['userlevel'];

	if(empty($email)){
		$errorMsg = "Please enter email";
	}
	// else if(empty($password)){
	// 	$errorMsg = "Please enter password";
	// }
	else if(empty($role)){
		$errorMsg = "Please choose a role";
	}else if($email AND $password AND $role){


		try{
			$stmt = $db->prepare("SELECT fld_staff_fname, fld_staff_email, fld_staff_password, fld_staff_level FROM tbl_staffs_a174366_pt2 WHERE fld_staff_email=:email AND fld_staff_password=:password AND fld_staff_level=:role");
			$stmt->bindParam(":email",$email);
			$stmt->bindParam(":password",$password);
			$stmt->bindParam(":role",$role);
			$stmt->execute();

			while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
				$dbname = $row['fld_staff_fname'];
				$dbemail = $row['fld_staff_email'];
				$dbpassword = $row['fld_staff_password'];
				$dbrole = $row['fld_staff_level'];
			}
			if($email!=null AND $password!=null AND $role!=null){
				if($stmt->rowCount() > 0){
					if($email==$dbemail AND $password==$dbpassword AND $role==$dbrole){
						switch ($dbrole) {
							case 'admin':
								$_SESSION['admin_login'] = $email;
								$_SESSION['admin_fname'] = $dbname;
								$_SESSION['admin_role'] = "Admin";
								header("location: index.php");
								break;

							case 'staff':
								$_SESSION['staff_login'] = $email;
								$_SESSION['staff_fname'] = $dbname;
								$_SESSION['staff_role'] = "Staff";
								header("location: index.php");
								break;
							
							default:
								$errorMsg = "Wrong email or password or role";

						}
					}else{
						$errorMsg = "Wrong email or password or role";
					}
				}else{
					echo "<script>alert('Wrong email or password or role');</script>";
					// $errorMsg = "Wrong email or password or role";
				}
			}else{
				$errorMsg = "Wrong email or password or role";
			}
		}catch(PDOException $e){
			$e->getMessage();
		}
	}else{
		$errorMsg = "Email or password or role doesn't exist";
	}
}
?>