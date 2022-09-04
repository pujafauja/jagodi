<div class="tab-pane fade  show active" id="FourCol" role="tabpanel" aria-labelledby="FourCol-tab">
    <div class="tp-wrapper">
        <div class="row g-0">
            <?php if($products['totalFiltered'] > 0): ?>
                <?php foreach($products['query']->result() as $product): 
                    $image = json_decode($product->images); ?>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                <div class="product__item product__item-d">
                    <div class="product__thumb fix">
                        <div class="product-image w-img">
                            <a href="<?php echo base_url('produk/'.$product->slug) ?>">
                                <img src="<?php echo base_url('media/products/md/'.$image[0]) ?>" alt="product">
                            </a>
                        </div>
                        <div class="product__offer">
                            <?php
                            $harga = $product->price;
                            $totDisc = 0;

                            if($diskon[$product->id]):
                                if(count($diskon[$product->id]) > 0):
                                    foreach($diskon[$product->id] as $discounts):
                                        foreach($discounts as $typeDisc => $nominal):
                                            if($typeDisc == '%'):
                                                echo '<span class="discount mr-5">-'.$nominal.'%</span>';
                                                $totDisc += ($nominal / 100) * $harga;
                                                $harga -= ($nominal / 100) * $harga;
                                            else:
                                                echo '<span class="discount mr-5">-Rp'.rupiah($nominal).'</span>';
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
                                            echo '<span class="discount mr-5">-'.$nominal.'%</span>';
                                            $totDisc += ($nominal / 100) * $harga;
                                            $harga -= ($nominal / 100) * $harga;
                                        else:
                                            echo '<span class="discount mr-5">-Rp'.rupiah($nominal).'</span>';
                                            $totDisc += $nominal;
                                            $harga -= $nominal;
                                        endif;
                                    endforeach;
                                endforeach;
                            endif;
                            ?>
                        </div>
                        <div class="product-action">
                            <a href="<?php echo base_url('produk/modal/'.encode($product->id)) ?>" class="icon-box icon-box-1 view-product-modal">
                                <i class="fal fa-eye"></i>
                                <i class="fal fa-eye"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product__content-3">
                        <h6><a href="<?php echo base_url('produk/'.$product->slug) ?>"><?php echo $product->nama ?></a></h6>
                        <div class="price mb-10">
                            <span>Rp <?php echo rupiah($harga < 1 ? 0 : $harga) ?></span>
                        </div>
                    </div>
                    <div class="product__add-cart-s text-center">
                        <a href="<?php echo base_url('produk/modal/'.encode($product->id)) ?>" class="cart-btn d-flex mb-10 align-items-center justify-content-center w-100 view-product-modal">
                        Keranjang
                        </a>
                    </div>
                </div>
            </div>
                <?php endforeach; ?>
            <?php else: ?>
            <div class="alert alert-warning text-center"><i class="fas fa-exclamation-triangle mr-10"></i>Tidak ada barang yang dapat ditemukan.</div>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="tab-pane fade" id="FiveCol" role="tabpanel" aria-labelledby="FiveCol-tab">
    <div class="tp-wrapper-2">
        <div class="single-item-pd">
            <?php if($products['totalFiltered'] > 0): ?>
                <?php foreach($products['query']->result() as $product): 
                    $image = json_decode($product->images); ?>
            <div class="row align-items-center">
                <div class="col-xl-9">
                    <div class="single-features-item single-features-item-df b-radius mb-20">
                        <div class="row  g-0 align-items-center">
                            <div class="col-md-4 p-2">
                                <div class="features-thum">
                                    <div class="features-product-image w-img">
                                        <a href="<?php echo base_url('produk/'.$product->slug) ?>"><img src="<?php echo base_url('media/products/md/'.$image[0]) ?>" alt=""></a>
                                    </div>
                                    <div class="product__offer">
                                        <?php
                                        $harga = $product->price;
                                        $totDisc = 0;

                                        if($diskon[$product->id]):
                                            if(count($diskon[$product->id]) > 0):
                                                foreach($diskon[$product->id] as $discounts):
                                                    foreach($discounts as $typeDisc => $nominal):
                                                        if($typeDisc == '%'):
                                                            echo '<span class="discount mr-5">-'.$nominal.'%</span>';
                                                            $totDisc += ($nominal / 100) * $harga;
                                                            $harga -= ($nominal / 100) * $harga;
                                                        else:
                                                            echo '<span class="discount mr-5">-Rp'.rupiah($nominal).'</span>';
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
                                                        echo '<span class="discount mr-5">-'.$nominal.'%</span>';
                                                        $totDisc += ($nominal / 100) * $harga;
                                                        $harga -= ($nominal / 100) * $harga;
                                                    else:
                                                        echo '<span class="discount mr-5">-Rp'.rupiah($nominal).'</span>';
                                                        $totDisc += $nominal;
                                                        $harga -= $nominal;
                                                    endif;
                                                endforeach;
                                            endforeach;
                                        endif;
                                        ?>
                                    </div>
                                    <div class="product-action">
                                        <a href="<?php echo base_url('produk/modal/'.encode($product->id)) ?>" class="icon-box icon-box-1 view-product-modal">
                                            <i class="fal fa-eye"></i>
                                            <i class="fal fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="product__content product__content-d">
                                    <h6><a href="<?php echo base_url('produk/'.$product->slug) ?>"><?php echo $product->nama ?></a></h6>
                                    <div class="features-des">
                                        <?php echo $product->summary ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="product-stock mb-15">
                        <h6>Rp <?php echo rupiah($harga < 1 ? 0 : $harga) ?></h6>
                    </div>
                    <div class="stock-btn ">
                        <button type="button" class="cart-btn d-flex mb-10 align-items-center justify-content-center w-100 view-product-modal">
                        Keranjang
                        </button>
                    </div>
                </div>
            </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="tp-pagination text-center">
    <div class="row">
        <div class="col-xl-12">
            <div class="basic-pagination pt-30 pb-30">
                <nav>
                    <?php paginationDepan($products['totalFiltered'], $itemperpage, 'produk/shop-products', $hlm) ?>
                </nav>
            </div>
        </div>
    </div>
</div>