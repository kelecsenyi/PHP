<?php
include('configPDO.php');
if(isset($_POST["action"]))
{
	$query = "SELECT * FROM products WHERE pquantity > '0'
	";
	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	 {
	  $query .= "
	   AND pprice BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
	  ";
	 }
	
	 if(isset($_POST["brand"]))
	 {
	  $brand_filter = implode("','", $_POST["brand"]);
	  $query .= "
	   AND pbrand IN('".$brand_filter."')
	  ";
	 }
	$statement = $db->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
	$output = '';
	if ($total_row > 0) {
		foreach ($result as $row) {
			$output .= '
			
			<div class="col-sm-4 col-md-4 col-lg-4 mb-3">
			<form action="action.php" method="POST" name="form-submit">
			  <div class="card-deck">
			    <div class="card border-secondary">
			      <img src="'. $row['pimage'] .'" class="card-img-top">
			      <h5 class="text-light bg-info text-center">'. $row['pname'] .'</h5>
			      <div class="card-body">
			        <h5 class="card-title text-dark">'. $row['pprice'] .'Ft</h5>              
			        <p class="pb-1">            
			          Jellemzők:<br>
			          '. $row['pdetails'] .'
			        </p>
			      </div>
			      <div class="card-footer">
			        <p class="raktar">Raktáron: '. $row['pquantity'].'</p>
			     	<input type="hidden" name="pid" value="'.$row['ID'].'">
	                <input type="hidden" name="pname" value="'.$row['pname'].'">
	                <input type="hidden" name="pprice" value="'.$row['pprice'].'">
	                <input type="hidden" name="pimage" value="'.$row['pimage'].'">
	                <input type="hidden" name="pcode" value="'.$row['pcode'].'">
			        <button onclick="filter_cart()"; class="btn btn-success addItemBtn"><i class="fas fa-cart-plus"></i> Kosárba</button>
			      </div>
			    </div>
			  </div>
			</div>
			</form>
			';
		}
	}
	else
	{
		$output='<h3>Nincs ilyen találat!</3>';
	}
	echo $output;
}
?>