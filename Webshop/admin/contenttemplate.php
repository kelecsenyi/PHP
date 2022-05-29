<?php
include('../configPDO.php');
include('dbh.inc.php');
if(isset($_POST['action']) && isset($_POST['action']) == 'order')
{
  $sql = "SELECT * FROM orders";
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
                <div class="OrderId">Azonosító: '.$row['id'].'</div>
                <div class="Items">Összeg: '.$row['amountpaid'].' Ft</div>
                <div class="date">Dátum: '.$row['odate'].'</div>
              </div>
            </div>
            <div class="content" id="hide">
              <div class="orderdata">
                <div class="row">
                  <div class="col-sm-3 col-md-4">
                    <h4>Számlázási adatok</h4>
                    <p>
                      <b>'.$row['bname'].'</b>
                      <br>
                      '.$row['bpostcode'].'
                      <br>
                      '.$row['bcity'].'
                      '.$row['baddress'].'
                      <br>
                      '.$row['taxnumber'].'
                      <br>
                    </p>
                  </div>
                  <div class="col-sm-3 col-md-4">
                    <h4>Szállítási adatok</h4>
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
                      '.$row['phone'].'
                      <br>
                    </p>
                  </div>
                  <div class="col-sm-3 col-md-4">
                    <h4>fizetési mód</h4>
                    <p>
                      <b>'.$row['pmode'].'</b>
                      <br>
                    </p>
                  </div>
                </div>
              </div>
              <div class="basket">
                <div class="table-responsive mt-2">
                  <table class="table table-bordered table-striped text-center">
                    <thead>
                      <tr>
                        <td colspan="7">
                          <h4 class="text-center text-info m-0">Rendelt termékek</h4>
                        </td>
                      </tr>
                      <tr>
                        <th>Megnevezés</th>
                        <th>Mennyiség</th>
                        <th>Végösszeg</th>
                    </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>'.$row['products'].'</td>
                        <td><i></i>'.$row['qty'].'</td>
                      </tr>                 
                      <tr>
                        <td colspan="2"><b>Teljes összeg:</b></td>
                        <td><p>'.$row['amountpaid'].' Ft</p></td>
                      </tr>
                    </tbody>
                  </table>
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