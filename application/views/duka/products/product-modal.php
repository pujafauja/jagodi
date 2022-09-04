<div class="product__modal-inner">
  <input type="hidden" id="produk-id" value="<?php echo encode($detailProduk->id) ?>">
  <div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
      <div class="product__modal-box">
        <div class="tab-content" id="modalTabContent">
          <?php $n = 1; foreach(json_decode($detailProduk->images) as $image): ?>
          <div class="tab-pane fade <?php echo $n == 1 ? 'show active' : '' ?>" id="nav<?php echo $n ?>" role="tabpanel" aria-labelledby="nav<?php echo $n ?>-tab">
            <div class="product__modal-img w-img">
              <img src="<?php echo base_url('media/products/lg/'.$image) ?>" alt="">
            </div>
          </div>
          <?php $n++; endforeach; ?>
        </div>
        <ul class="nav nav-tabs" id="modalTab" role="tablist">
          <?php $n = 1; foreach(json_decode($detailProduk->images) as $image): ?>
          <li class="nav-item" role="presentation">
            <button class="nav-link <?php echo $n == 1 ? 'active' : '' ?>" id="nav<?php echo $n ?>-tab" data-bs-toggle="tab" data-bs-target="#nav<?php echo $n ?>" type="button" role="tab" aria-controls="nav<?php echo $n ?>" aria-selected="true">
              <img src="<?php echo base_url('media/products/sm/'.$image) ?>" alt="">
            </button>
          </li>
          <?php $n++; endforeach; ?>
        </ul>
      </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
      <div class="product__modal-content">
        <h4><a href="<?php echo base_url('produk/'.$detailProduk->slug) ?>"><?php echo $detailProduk->nama ?></a></h4>
        <div class="product__review d-sm-flex">
          <div class="rating rating__shop mb-10 mr-30">
            <ul>
            </ul>
          </div>
          <div class="product__add-review mb-15">
          </div>
        </div>
        <div class="product__price">
          <?php
          $harga = $detailProduk->price;
          $totDisc = 0;

          if($diskon[$detailProduk->id]):
              if(count($diskon[$detailProduk->id]) > 0):
                  foreach($diskon[$detailProduk->id] as $discounts):
                      foreach($discounts as $typeDisc => $nominal):
                          if($typeDisc == '%'):
                              $totDisc += ($nominal / 100) * $harga;
                              $harga -= ($nominal / 100) * $harga;
                          else:
                              $totDisc += $nominal;
                              $harga -= $nominal;
                          endif;
                      endforeach;
                  endforeach;
              endif;
          endif;

          if($diskon['all']):
              foreach($diskon['all'] as $discountsall):
                  foreach($discountsall as $typeDisc => $nominal):
                      if($typeDisc == '%'):
                          $totDisc += ($nominal / 100) * $harga;
                          $harga -= ($nominal / 100) * $harga;
                      else:
                          $totDisc += $nominal;
                          $harga -= $nominal;
                      endif;
                  endforeach;
              endforeach;
          endif;
          ?>
          <span>
            Rp <?php echo rupiah($harga < 1 ? 0 : $harga) ?>
            <?php echo $totDisc > 0 ? '<small><del class="text-danger font-weight-bold">'.rupiah($detailProduk->price).'</del></small> ' : '' ?>
          </span>
        </div>
        <div class="product__modal-des mt-20 mb-15">
          <?php echo $detailProduk->description ?>
        </div>
        <div class="product__stock mb-20">
          <?php
          $addItems = json_decode($detailProduk->addItems);

          foreach($addItems as $addItem => $addValues):
            if(count($addValues) > 1): ?>
              <div class="row mr-10">
                <div class="col-12">
                  <span class="">Pilih <?php echo $addItem ?></span>
                  <select name="<?php echo $addItem ?>" id="" class="form-control additional-items">
                    <?php foreach($addValues as $addValue): ?>
                      <option value="<?php echo $addValue ?>"><?php echo $addValue ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            <?php endif;
          endforeach;
          ?>
          <div class="row mr-10">
            <div class="col-md-6 col-12">
              <span class="">Pilih Ukuran</span>
              <select name="size" id="" class="form-control">
                <?php foreach(json_decode($detailProduk->sizes) as $sizes): ?>
                <option value="<?php echo $sizes ?>"><?php echo $sizes ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-6 col-12">
              <span class="w-100">Stok:</span>
              <span class="w-100" id="stok-produk"></span>
            </div>
          </div>
        </div>
        <div class="product__modal-form">
          <form action="#">
            <div class="pro-quan-area d-lg-flex align-items-center">
              <div class="product-quantity mr-20 mb-25">
                <div class="cart-plus-minus p-relative"><input type="text" name="qty" class="qty" value="1" /></div>
              </div>
              <div class="pro-cart-btn mb-25">
                <button class="cart-btn add-to-cart" type="submit" id="" data-product="<?php echo encode($detailProduk->id) ?>" data-price="<?php echo $detailProduk->price ?>">Keranjang</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>