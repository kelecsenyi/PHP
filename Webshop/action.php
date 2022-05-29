<?php
	include('config.php');
	include('configPDO.php');
	session_start();

#-----------termék kosárba rakása-------------
	if (isset($_POST['pid'])) 
	{
	  $pid = $_POST['pid'];
	  $pname = $_POST['pname'];
	  $pprice = $_POST['pprice'];
	  $pimage = $_POST['pimage'];
	  $pcode = $_POST['pcode'];
	  $pqty = 1;
	  $total_price = $pprice * $pqty;

	    	if (isset($_SESSION['id'])) 
	    	{
	    		$userid = $_SESSION['id'];

	    		$stmt = $conn->prepare('SELECT product_code FROM cart WHERE product_code=? AND userid = ?');
				$stmt->bind_param('si',$pcode, $userid);
				$stmt->execute();
				$res = $stmt->get_result();
				$r = $res->fetch_assoc();
				$code = $r['product_code'];

				if (!$code)
				{
		    		$query = $conn->prepare('INSERT INTO cart (product_name,product_price,product_image,qty,total_price,product_code,userid) VALUES (?,?,?,?,?,?,?)');
			    	$query->bind_param('sisiisi',$pname,$pprice,$pimage,$pqty,$total_price,$pcode,$userid);
			    	$query->execute();
			    	header('location: vasarlas.php?succes=cartadd');
		    	}
		    	else
		    	{
		    		header('location: vasarlas.php?notsucces=alreadyadd');
	    			exit();
		    	}
	    	}
	    	else
	    	{	
	    		$currentuser = $_SESSION['currentuser'];
	    		$stmt = $conn->prepare('SELECT product_code FROM cart WHERE product_code=? AND currentuser = ?');
				$stmt->bind_param('si',$pcode, $currentuser);
				$stmt->execute();
				$res = $stmt->get_result();
				$r = $res->fetch_assoc();
				$code = $r['product_code'];

	    		if (!$code) 
	    		{
	    			$query = $conn->prepare('INSERT INTO cart (product_name,product_price,product_image,qty,total_price,product_code,currentuser) VALUES (?,?,?,?,?,?,?)');
			    	$query->bind_param('sisiisi',$pname,$pprice,$pimage,$pqty,$total_price,$pcode,$currentuser);
			    	$query->execute();
			    	header('location: vasarlas.php?succes=cartadd');
	    		}
	    		else
		    	{
		    		header('location: vasarlas.php?notsucces=alreadyadd');
	    			exit();
		    	}
	    	}	  
	}

#-----------Kosárban lévő termékek száma-------------
	if (isset($_POST['action']) && isset($_POST['action']) == 'cart_item') {
	
		if (isset($_SESSION["id"])) 
		{
			$sql = "SELECT COUNT(id) AS num FROM cart WHERE userid = ?";
			$stmte = $conn->prepare($sql); 
			$stmte->bind_param('i',$_SESSION["id"]);
			$stmte->execute();
			$result = $stmte->get_result();
			$num = $result->fetch_assoc();
			$output = '';
			if ($num['num'] > 0) {

				$output .= '<span id="cart-item" class="text-danger bg-light">'. $num['num'] .'</span>';
				
			}
			else
			{
				$output .= '<span id="cart-item" class="text-danger bg-light">0</span>';
			}
		}
		else
		{
			$currentuser = $_SESSION['currentuser'];
			$sql = "SELECT COUNT(id) AS num FROM cart WHERE currentuser = ?";
			$stmte = $conn->prepare($sql); 
			$stmte->bind_param('i',$currentuser);
			$stmte->execute();
			$result = $stmte->get_result();
			$num = $result->fetch_assoc();
			$output = '';
			if ($num['num'] > 0) {

				$output .= '<span id="cart-item" class="text-danger bg-light">'. $num['num'] .'</span>';
				
			}
			else
			{
				$output .= '<span id="cart-item" class="text-danger bg-light">0</span>';
			}
		}
		
		$_SESSION['cart']=$num['num'];
		echo $output;
	}

#-----------Kosár törlése-------------
	if (isset($_GET['remove'])) {
	  $id = $_GET['userid'];
	  $currentuser = $_GET['currentuser'];
	  $productid = $_GET['remove'];

	  $stmt = $conn->prepare('DELETE FROM cart WHERE (userid=? AND product_code = ?) OR (currentuser = ? AND product_code = ?)');
	  $stmt->bind_param('iiii',$id,$productid,$currentuser,$productid);
	  $stmt->execute();

	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'A termék sikeresen eltávolítva!';
	  header('location:cart.php');
	}

	if (isset($_GET['clear'])) {
	  $userid = $_GET['userid'];
	  $stmt = $conn->prepare('DELETE FROM cart WHERE userid = ?');
	  $stmt->bind_param('i',$userid);
	  $stmt->execute();
	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'Minden termék kikerült a kosarából!';
	  header('location:cart.php');
	}

	if (isset($_GET['clear'])) {
	  $userid = $_GET['userid'];
	  $stmt = $conn->prepare('DELETE FROM cart WHERE currentuser = ?');
	  $stmt->bind_param('i',$userid);
	  $stmt->execute();
	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'Minden termék kikerült a kosarából!';
	  header('location:cart.php');
	}

#-----------Kosár frissítése-------------
	if (isset($_POST['qty'])) {
		$qty = $_POST['qty'];
		$pid = $_POST['pid'];
		$pprice = $_POST['pprice'];
		$tprice = $qty * $pprice;

	  if (isset($_SESSION['id'])) {
	  	  $id= $_SESSION['id'];
		  $stmt = $conn->prepare('UPDATE cart SET qty = ?,total_price = ? WHERE id = ? AND userid = ?');
		  $stmt->bind_param('iiii',$qty,$tprice,$pid,$id);
		  $stmt->execute();
		}
		elseif (isset($_SESSION['currentuser'])) {
		  $currentuser= $_SESSION['currentuser'];
		  $stmt = $conn->prepare('UPDATE cart SET qty = ?,total_price = ? WHERE  id = ? AND currentuser = ?');
		  $stmt->bind_param('iiii',$qty,$tprice,$pid,$currentuser);
		  $stmt->execute();
		}
	}

?>