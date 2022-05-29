<?php
session_start();
include('configPDO.php');
if(isset($_POST['action']) && isset($_POST['action']) == 'update')
{
	$sql = "SELECT * FROM user WHERE id = '".$_SESSION["id"]."'";
	$statement = $db->prepare($sql);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';

	foreach ($result as $row) {
	$output .= '
	<div class="form-group">
              <h5>Kapcsolattartó adatai</h5>
              <hr class="mb-3">
              <label for="name"><b>Név</b></label>
              <input class="form-control" placeholder="Név" type="text" name="name" value="'. $row['name'].'" required>

              <label for="email"><b>Email</b></label>
              <input class="form-control" placeholder="Email" type="email" name="email" value="'. $row['email'].'" required> 

              <label for="mobile"><b>Mobil</b></label>
              <input class="form-control" placeholder="Mobil" type="tel" name="mobil" maxlength="15" value="'. $row['mobil'].'" required>
            </div>

            <div class="form-group">
              <h5>Szállítási adatok</h5>
              <hr class="mb-3">

              <label for="postcode"><b>Irányítószám</b></label>
              <input class="form-control" placeholder="Irányítószám" type="text" name="postcode" maxlength="4" value="'. $row['postcode'].'" required>

              <label for="city"><b>Város</b></label>
              <input class="form-control" placeholder="Város" type="text" name="city" value="'. $row['city'].'" required>

              <label for="address"><b>utca, házszám</b></label>
              <input class="form-control" placeholder="utca, házszám" type="text" name="address" value="'. $row['address'].'" required>
            </div>
            
            <div class="form-group">
                <h5>Számlázási adatok</h5>
                <hr class="mb-3">
                <label for="szamname"><b>Számlázási név</b></label>
                <input class="form-control" placeholder="Számlázási név" type="text" name="szamname" value="'. $row['billname'].'" required>

                <label for="szampostcode"><b>Irányítószám</b></label>
                <input class="form-control" placeholder="Irányítószám" type="text" name="szampostcode" maxlength="4" value="'. $row['billpostcode'].'" required>

                <label for="city"><b>Város</b></label>
                <input class="form-control" placeholder="Város" type="text" name="szamcity" value="'. $row['billcity'].'" required>

                <label for="address"><b>utca, házszám</b></label>
                <input class="form-control" placeholder="utca, házszám" type="text" name="szamaddress" value="'. $row['billaddress'].'" required>

                <label for="taxnumber"><b>Adószám</b></label>
                <input class="form-control" placeholder="Adószám" type="text" name="taxnumber" value="'. $row['taxcode'].'" required>

                <hr class="mb-3">
                <button type="submit" name="savebutton" onclick="DataUpdate()" class="btn btn-primary">Mentés</button>
            </div>
	';
	}
	
	echo $output;
}
?>