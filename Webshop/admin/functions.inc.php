<?php
	function emptyInputSignup($username,$password,$passwordagain)
	{
		$result;
		if (empty($username)||empty($password)||empty($passwordagain)) {
			$result=true;
		}
		else{
			$result=false;
		}
		return $result;
	}

	function invalidUid($username)
	{
		$result;
		if (!preg_match("/^[a-zA-Z]*$/", $username)) {
			$result=true;
		}
		else{
			$result=false;
		}
		return $result;
	}

	function pwdMatch($password,$passwordagain)
	{
		$result;
		if ($password!==$passwordagain) {
			$result=true;
		}
		else{
			$result=false;
		}
		return $result;
	}

	function userNameTaken($conn,$username)
	{

		$sqlexist = "SELECT id FROM admin WHERE name = ?";
		$stmt = $conn->prepare($sqlexist); 
		$stmt->bind_param("s",$username);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();	  
		  if ($row) 
		  {   
		  	$res=true;
		  }
		  else
		  {
		  	$res=false;
		  }
		  return $res;
	}

	function uidExists($conn,$username)
	{	

		$sqlexist = "SELECT COUNT(id) AS num FROM admin WHERE name = ?";
		$stmte = $conn->prepare($sqlexist); 
		$stmte->bind_param("s",$username);
		$stmte->execute();
		$result = $stmte->get_result();
		$num = $result->fetch_assoc();
		if ($num['num'] > 0) 
		{
			$sql = "SELECT id, password FROM admin WHERE name = '$username'";
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) 
			{		    
			  if ($row = mysqli_fetch_assoc($result)) 
			  {
			  	return $row;
			  }
			  else
			  {
			  	$res=false;
			  	return $res;
			  }
			}
			return $res;
		}
	}

	function createUser($conn,$username,$password)
	{
		$sql = "INSERT INTO admin (name, password) VALUES (?,?)";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt,$sql))
		{
			header("location: signup.php?error=stmtfailed2");
			exit();
		}
		$passwordhashed=password_hash($password, PASSWORD_DEFAULT);
		mysqli_stmt_bind_param($stmt,"ss",$username,$passwordhashed);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		header("location: login.php");
		exit();
	}

	function emptyInputLogin($username,$password)
	{
		$result;
		if (empty($username)||empty($password)) {
			$result=true;
		}
		else{
			$result=false;
		}
		return $result;
	}

 	function loginUser($conn,$username,$password)
 	{
 		$row=uidExists($conn,$username);
 		if ($row==false) {
 			header("location: login.php?error=nouser");
			exit();
 		}
		$passwordh = $row["password"];
		$checkpwd = password_verify($password, $passwordh);
 		
 		if ($checkpwd===false) {
 			header("location: login.php?error=wrongpassword");
 			exit();
 		}
 		elseif ($checkpwd===true) {
 			session_start();
 			$_SESSION["id"]=$row["id"];
 			header("location: index.php");
 			exit();
 		}
 	}
#------------------------ Add product functions -------------------------------
 	function emptyInput($brand,$name,$details,$price,$image,$quantity,$pcode)
 	{
 		$result;
		if (empty($brand) || empty($name) || empty($details)|| empty($price)|| empty($image) || empty($quantity) || empty($pcode)) 
		{
			$result=true;
		}
		else
		{
			$result=false;
		}
		return $result;
 	}
 	function idTaken($conn,$pcode)
 	{	
 		$sql = "SELECT * FROM products WHERE pcode = ?";
		$stmt = $conn->prepare($sql); 
		$stmt->bind_param("s", $pcode);
		$stmt->execute();
		$result = $stmt->get_result(); 
		$row = $result->fetch_assoc();
		  if ($row) 
		  {   
		  	$res=true;
		  }
		  else
		  {
		  	$res=false;
		  }
		  return $res;
 	}

 	function imageTaken($conn,$image)
 	{
 		$sql = "SELECT * FROM products WHERE pimage = (?)";
		$stmt = $conn->prepare($sql); 
		$stmt->bind_param("s", $image);
		$stmt->execute();
		$result = $stmt->get_result();
		$product = $result->fetch_assoc();	  
		  if ($product) 
		  {   
		  	$res=true;
		  }
		  else
		  {
		  	$res=false;
		  }
		  return $res;
 	}

 	function createProduct($conn,$brand,$name,$details,$price,$image,$quantity,$pcode)
 	{
 		$sql = "INSERT INTO products (pbrand,pname,pdetails,pprice,pimage,pquantity,pcode) VALUES (?,?,?,?,?,?,?)";
 		$stmt = $conn->prepare($sql);
		$stmt->bind_param("sssisis",$brand,$name,$details,$price,$image,$quantity,$pcode);
		if ($stmt->execute())
		{
			header("location: product.php?succes=succesadd");
		}
		else
		{
			header("location: product.php?error=fail");
		}
 	}
#------------------------ Update product functions -------------------------------

 	function updateProduct($conn,$brand,$name,$details,$price,$image,$quantity,$pcode)
 	{	
 		$sqlexist = "SELECT COUNT(pname) AS num FROM products WHERE pcode = ?";
		$stmte = $conn->prepare($sqlexist); 
		$stmte->bind_param("s",$pcode);
		$stmte->execute();
		$result = $stmte->get_result();
		$num = $result->fetch_assoc();

 		if ($num['num'] > 0) {
 			mysqli_stmt_close($stmte);
	 		$sql = "UPDATE products SET pbrand = ?,pname = ?,pdetails = ?,pprice = ?,pimage = ?,pquantity = ? WHERE pcode = ?";
	 		$stmt = $conn->prepare($sql);
	 		$stmt->bind_param("sssisis",$brand,$name,$details,$price,$image,$quantity,$pcode);
	 		if ($stmt->execute()) {
	 			header("location: update.php?succes=succesupdate");
	 			exit();
	 		}
	 		else
	 		{
	 			header("location: update.php?error=fail");
	 			exit();
	 		}
		}
		else
		{
			header("location: update.php?error=fail");
			exit();
		}
		mysqli_stmt_close($stmt);	
		
 	}

 	function deleteProduct($conn,$pcode)
 	{
 		$sqlexist = "SELECT pname FROM products WHERE pcode = (?)";
		$stmte = $conn->prepare($sqlexist); 
		$stmte->bind_param("s",$pcode);

		if ($stmte->execute() && $pcode!=="0") {
			mysqli_stmt_close($stmte);
			$sql = "DELETE FROM products WHERE pcode = ?";
		 	$stmt = $conn->prepare($sql);
			$stmt->bind_param("s",$pcode);
			if ($stmt->execute())
			{
				header("location: update.php?succes=succesupdate");
				exit();
			}
			else
			{
				header("location: update.php?error=fail");
				exit();
			}
		}
		else
		{
			header("location: update.php?error=fail");
			exit();
		}
		mysqli_stmt_close($stmt);
 	}

 	function upimageTaken($conn,$image,$pcode)
 	{	
 		$res=false;
 		$sql = "SELECT pimage FROM products";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$result = $stmt->get_result();
		foreach($result as $row)
		{	  
		  if ($row['pimage']==$image) 
		  {   
		  	$res=true;
		  }
		}
		mysqli_stmt_close($stmt);

		$sqlexist = "SELECT pimage FROM products WHERE pcode = (?)";
		$stmte = $conn->prepare($sqlexist); 
		$stmte->bind_param("s",$pcode);
		$stmte->execute();
		$result = $stmte->get_result();
		foreach($result as $row)
		{	  
		  if ($row['pimage']==$image) 
		  {   
		  	$res=false;
		  }
		}
		mysqli_stmt_close($stmte);
		return $res;
 	}
?>
