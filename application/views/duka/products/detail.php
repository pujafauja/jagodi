<input type="hidden" id="produk-id" value="<?php echo encode($detail->id) ?>">

<!-- breadcrumb__area-start -->
<section class="breadcrumb__area box-plr-75">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="breadcrumb__wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Home</a></li>
                          <li class="breadcrumb-item"><a href="<?php echo base_url('produk') ?>">Produk</a></li>
                          <li class="breadcrumb-item active" aria-current="page"><?php echo $detail->nama ?></li>
                        </ol>
                      </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb__area-end -->

<!-- product-details-start -->
<div class="product-details mb-20">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="product__details-nav d-sm-flex align-items-start">
                    <ul class="nav nav-tabs flex-sm-column justify-content-between" id="productThumbTab" role="tablist">
                        <?php $i = 1; foreach(json_decode($detail->images) as $images): ?>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link <?php echo $i == 1 ? 'active' : '' ?>" id="thumb<?php echo $i ?>-tab" data-bs-toggle="tab" data-bs-target="#thumb<?php echo $i ?>" type="button" role="tab" aria-controls="thumb<?php echo $i ?>" aria-selected="<?php echo $i == 1 ? 'true' : 'false' ?>">
                              <img src="<?php echo base_url('media/products/sm/'.$images) ?>" alt="">
                          </button>
                        </li>
                        <?php $i++; endforeach; ?>
                    </ul>
                    <div class="product__details-thumb">
                        <div class="tab-content" id="productThumbContent">
                            <?php $i = 1; foreach(json_decode($detail->images) as $images): ?>
                            <div class="tab-pane fade <?php echo $i == 1 ? 'show active' : '' ?>" id="thumb<?php echo $i ?>" role="tabpanel" aria-labelledby="thumb<?php echo $i ?>-tab">
                                <div class="product__details-nav-thumb w-img">
                                    <img src="<?php echo base_url('media/products/lg/'.$images) ?>" alt="">
                                </div>
                            </div>
                            <?php $i++; endforeach; ?>
                          </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="product__details-content">
                    <h6><?php echo $detail->nama ?></h6>
                    <div class="price mb-10">
                        <?php
                        $harga = $detail->price;
                        $totDisc = 0;

                        if($diskon[$detail->id]):
                            if(count($diskon[$detail->id]) > 0):
                                foreach($diskon[$detail->id] as $discounts):
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
                            <?php echo $totDisc > 0 ? '<small><del class="text-danger font-weight-semibold">'.rupiah($detail->price).'</del></small>' : '' ?>
                        </span>
                    </div>
                    <div class="features-des mb-20 mt-10">
                        <?php
                        $addItems = json_decode($detail->addItems);

                        foreach($addItems as $addItem => $addValues):
                          if(count($addValues) > 1): ?>
                            <div class="row">
                              <div class="col-12">
                                <label class="">Pilih <?php echo $addItem ?></label>
                                <select name="addItems[<?php echo addItem ?>]" id="" class="form-control w-100">
                                  <?php foreach($addValues as $addValue): ?>
                                    <option value="<?php echo $addValue ?>"><?php echo $addValue ?></option>
                                  <?php endforeach; ?>
                                </select>
                              </div>
                            </div>
                          <?php endif;
                        endforeach;
                        ?>
                    </div>
                    <div class="product-stock mb-20">
                        <div class="row">
                          <div class="col-md-6 col-12">
                            <label class="">Pilih Ukuran</label>
                            <select name="size" id="" class="form-control w-100">
                              <?php foreach(json_decode($detail->sizes) as $sizes): ?>
                              <option value="<?php echo $sizes ?>"><?php echo $sizes ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="col-md-6 col-12">
                            <label class="w-100">Stok:</label>
                            <strong><label class="w-100 mt-5" id="stok-produk"></label></strong>
                          </div>
                        </div>
                    </div>
                    <div class="cart-option mb-15">
                        <div class="product-quantity mr-20">
                            <div class="cart-plus-minus p-relative"><input type="text" value="1" name="qty" class="qty"><div class="dec qtybutton">-</div><div class="inc qtybutton">+</div></div>
                        </div>
                        <a href="" class="cart-btn add-to-cart" data-product="<?php echo encode($detail->id) ?>" data-price="<?php echo $detail->price ?>">Tambah ke keranjang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- product-details-end -->

<!-- product-details-des-start -->
<div class="product-details-des mt-40 mb-60">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="product__details-des-tab">
                    <ul class="nav nav-tabs" id="productDesTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="des-tab" data-bs-toggle="tab" data-bs-target="#des" type="button" role="tab" aria-controls="des" aria-selected="true">Deskripsi </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="aditional-tab" data-bs-toggle="tab" data-bs-target="#aditional" type="button" role="tab" aria-controls="aditional" aria-selected="false">Informasi Tambahan</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-content" id="prodductDesTaContent">
            <div class="tab-pane fade active show" id="des" role="tabpanel" aria-labelledby="des-tab">
                <div class="product__details-des-wrapper">
                    <?php echo $detail->description ?>
                </div>
            </div>
            <div class="tab-pane fade" id="aditional" role="tabpanel" aria-labelledby="aditional-tab">
                <div class="product__desc-info">
                    <ul>
                        <?php foreach(json_decode($detail->addItems) as $addItem => $addValues): ?>
                        <li>
                            <h6><?php echo $addItem ?></h6>
                            <span><?php echo implode(', ', $addValues) ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                 </div>
            </div>
        </div>
    </div>
</div>
<!-- product-details-des-end -->