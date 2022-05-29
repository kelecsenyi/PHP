<?php 
include ('config.php');
include ('configPDO.php');
include ('functions.inc.php');
session_start();

if (isset($_POST['submit']))
{

	  $name = $_POST['name'];
	  $email = $_POST['email'];
	  $phone = $_POST['phone'];
	  $products = $_POST['products'];
	  $grand_total = $_POST['grand_total'];
	  $qty = $_POST['qty'];
	  $postcode = $_POST['postcode'];
	  $pmode = $_POST['pmode'];
	  $city = $_POST['city'];
	  $address = $_POST['address'];
	  $bname = $_POST['bname'];
	  $bpostcode = $_POST['bpostcode'];
	  $bcity = $_POST['bcity'];
	  $baddress = $_POST['baddress'];
	  $taxnumber = $_POST['taxnumber'];
	  $odate= date("Y-m-d h:i:sa");

	  $id = $_SESSION['id'];

	  if (invalidorder($name,$postcode,$bname,$bpostcode) !== false) {
			header("location: checkout.php?error=einvaliduid");
			exit();
		}
	createOrder($conn,$name,$email,$phone,$products,$grand_total,$postcode,$pmode,$city,$address,$bname,$bpostcode,$bcity,$baddress,$taxnumber,$odate,$id,$qty);
	}


if (isset($_POST['currentsubmit']))
{
	
	  $name = $_POST['name'];
	  $email = $_POST['email'];
	  $phone = $_POST['phone'];
	  $products = $_POST['products'];
	  $grand_total = $_POST['grand_total'];
	  $qty = $_POST['qty'];
	  $postcode = $_POST['postcode'];
	  $pmode = $_POST['pmode'];
	  $city = $_POST['city'];
	  $address = $_POST['address'];
	  $bname = $_POST['bname'];
	  $bpostcode = $_POST['bpostcode'];
	  $bcity = $_POST['bcity'];
	  $baddress = $_POST['baddress'];
	  $taxnumber = $_POST['taxnumber'];
	  $odate= date("Y-m-d h:i:sa");

	  $id = $_SESSION['currentuser'];
	if (invalidorder($name,$postcode,$bname,$bpostcode) !== false) 
	{
		header("location: checkout.php?error=einvaliduid");
		exit();
	}
	  currentOrder($conn,$name,$email,$phone,$products,$grand_total,$postcode,$pmode,$city,$address,$bname,$bpostcode,$bcity,$baddress,$taxnumber,$odate,$id,$qty);
}
?>