

<div class="row">
    <?php
    if($products['totalFiltered'] > 0):
    foreach($products['query']->result() as $pro): ?>
    <div class="col-md-3 col-xl-2">
        <div class="card-box product-box">

            <div class="product-action">
                <a href="<?php echo base_url('ecommerce/delete-featured/'.encode($pro->featuredID)) ?>" class="btn btn-danger btn-xs waves-effect waves-light delete-product"><i class="mdi mdi-close"></i></a>
            </div>

            <div class="bg-light">
                <?php $gambar = json_decode($pro->images) ?>
                <img src="<?php echo base_url('media/products/md/'.$gambar[0]) ?>" alt="product-pic" class="img-fluid" />
            </div>

            <div class="product-info">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="font-16 mt-0 sp-line-1"><a href="<?php echo base_url('ecommerce/product-detail/'.encode($pro->id)) ?>" class="text-dark"><?php echo $pro->nama ?></a> </h5>
                        <div class="text-warning mb-2 font-13">
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>                            
                        </div>
                        <?php
                        $stocks = 0;
                        foreach(json_decode($pro->stocks) as $stok):
                            $stocks += $stok;
                        endforeach;
                        ?>
                        <h5 class="m-0"> <span class="text-muted"> Stocks : <?php echo rupiah($stocks) ?> pcs</span></h5>
                    </div>
                    <div class="col-auto">
                        <div class="product-price-tag">
                            <?php
                            $harga = $pro->price;

                            if($diskon[$pro->id]):
                                if(count($diskon[$pro->id]) > 0):
                                    foreach($diskon[$pro->id] as $discounts):
                                        foreach($discounts as $typeDisc => $nominal):
                                            if($typeDisc == '%'):
                                                $harga -= ($nominal / 100) * $harga;
                                            else:
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
                                            $harga -= ($nominal / 100) * $harga;
                                        else:
                                            $harga -= $nominal;
                                        endif;
                                    endforeach;
                                endforeach;
                            endif;
                            ?>
                            Rp <?php echo price($harga < 1 ? 0 : $harga) ?>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div> <!-- end product info-->
        </div> <!-- end card-box-->
    </div> <!-- end col-->
    <?php 
    endforeach;
    endif; ?>
</div>
<!-- end row-->

<div class="row">
    <div class="col-12">
        <?php customPagination($products['totalFiltered'], $itemperpage, 'ecommerce/product-lists', $hlm) ?>
    </div> <!-- end col-->
</div>
<!-- end row-->