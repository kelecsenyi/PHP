<div class="col-sm-4 col-md-4 col-lg-4 mb-3">
  <div class="card-deck">
    <div class="card border-secondary">
      <img src="<?= $row['pimage']?>" class="card-img-top">
      <h5 class="text-light bg-info text-center"><?= $row['pname']?></h5>
      <div class="card-body">
        <h5 class="card-title text-dark"><?= $row['pprice']?>Ft</h5>              
        <p class="pb-1">            
          Jellemzők:<br>
          <?= $row['pdetails']?>
        </p>
      </div>
      <div class="card-footer">
        <p class="raktar">Raktáron: <?= $row['pquantity']?></p>
        <a href="#" class="btn btn-success"><i class="fas fa-cart-plus"></i> Kosárba</a>
      </div>
    </div>
  </div>
</div>
