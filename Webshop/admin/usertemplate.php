<?php
include('../configPDO.php');
include('dbh.inc.php');

if(isset($_POST['action']) && isset($_POST['action']) == 'user')
{
  $sql = "SELECT * FROM user";
  $statement = $db->prepare($sql);
  $statement->execute();
  $result = $statement->fetchAll(); 
  $output = '';

  foreach ($result as $row) 
  {
  $output .= '
        <section class="mb-2">
                    <div class="title">
                      <div class="row">
                        <div class="OrderId">'.$row['id'].'</div>
                        <div class="Items"> '.$row['name'].'</div>
                      </div>
                    </div>
                    <div class="content" id="hide">
                      <div class="orderdata">
                        <div class="row">
                          <div class="col-sm-3 col-md-4">
                            <h4>Számlázási adatai</h4>
                            <p>
                              <b>'.$row['billname'].'</b>
                              <br>
                              '.$row['billpostcode'].'
                              <br>
                              '.$row['billcity'].'
                              '.$row['billaddress'].'
                              <br>
                              '.$row['taxcode'].'
                              <br>
                            </p>
                          </div>
                          <div class="col-sm-3 col-md-4">
                            <h4>Szállítási adatai</h4>
                            <p>
                              <b>'.$row['name'].'</b>
                              <br>
                              '.$row['postcode'].'
                              <br>
                              '.$row['city'].'
                              '.$row['address'].'
                              <br>
                              '.$row['email'].'
                              <br>   
                              '.$row['mobil'].'
                              <br>
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
        </section>
        ';
  }
}
else
{
  $output ='<h3>Nincs megjeleníthető találat!</3>';
}
 echo $output;
?>