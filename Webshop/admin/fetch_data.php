<?php 
include('dbh.inc.php');
include('../configPDO.php');

if (isset($_POST["query"])) {
	$search = mysqli_real_escape_string($conn, $_POST["query"]);
    $query = "SELECT * FROM products WHERE pcode LIKE '%".$search."%'";
	$statement = $db->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
	$output = '';
	if ($total_row > 0){
		foreach ($result as $row) {
		}
			$output .= '
             <label for="brand"><b>Termék típusa</b></label>
             <select name="brands" class="custom-select">
                <option value="'.$row['pbrand'].'">'.$row['pbrand'].'</option>
                <option value="FFP2">FFP2 maszk</option>
                <option value="teljesálarc">Teljesálarc</option>
                <option value="szövetmaszk">Szövet maszk</option>
                <option value="orvosi maszk">Orvosi maszk</option>
             </select>

			<label for="name"><b>Termék neve</b></label>
            <input class="form-control" placeholder="Termék neve" type="text" name="name" value="'.$row['pname'].'">
              
            <label for="details"><b>Termék leírása</b></label>
            <input class="form-control" placeholder="Termék leírása" type="text" name="details" value="'.$row['pdetails'].'">

            <label for="price"><b>Ár</b></label>
            <input class="form-control" placeholder="Ár" maxlength="10" type="number" min="0" max="9999999999" name="price" value="'.$row['pprice'].'"> 

            <label for="image"><b>Kép elérési útvonala</b></label>
            <input class="form-control" placeholder="Kép elérési útvonala" type="text" name="image" value="'.$row['pimage'].'" >

            <label for="quantity"><b>Mennyiség</b></label>
            <input class="form-control" placeholder="Mennyiség" maxlength="6" min="0" max="999999" type="number" name="quantity" value="'.$row['pquantity'].'">
            <button type="save" name="updatebutton" class="btn btn-primary mt-2">Mentés</button>
              ';
	}
	else
	{
		header('location: update?error=fail');
	}
	echo $output;
}
?>