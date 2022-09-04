<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-5">

                    <div class="tab-content pt-0">
                        <?php $productno = 1; 
                        foreach(json_decode($detail->images) as $image): ?>
                        <div class="tab-pane <?php echo $productno == 1 ? 'active show' : '' ?>" id="<?php echo 'product-'.$productno.'-item' ?>">
                            <img src="<?php echo base_url('media/products/lg/'.$image) ?>" alt="" class="img-fluid mx-auto d-block rounded">
                        </div>
                        <?php $productno++; endforeach; ?>
                    </div>

                    <ul class="nav nav-pills nav-justified">
                        <?php $productno = 1; 
                        foreach(json_decode($detail->images) as $image): ?>
                        <li class="nav-item">
                            <a href="#<?php echo 'product-'.$productno.'-item' ?>" data-toggle="tab" aria-expanded="false" class="nav-link product-thumb <?php echo $productno == 1 ? 'active show' : '' ?>">
                                <img src="<?php echo base_url('media/products/sm/'.$image) ?>" alt="" class="img-fluid mx-auto d-block rounded">
                            </a>
                        </li>
                        <?php $productno++; endforeach; ?>
                    </ul>
                </div> <!-- end col -->
                <div class="col-lg-7">
                    <div class="pl-xl-3 mt-3 mt-xl-0">
                        <h4 class="mb-3"><?php echo $detail->nama ?></h4>
                        <p class="text-muted float-left mr-3 text-warning">
                            <span class="far fa-star"></span>
                            <span class="far fa-star"></span>
                            <span class="far fa-star"></span>
                            <span class="far fa-star"></span>
                            <span class="far fa-star"></span>
                        </p>
                        <p class="mb-4"><a href="" class="text-muted">( 36 Customer Reviews )</a></p>
                        
                        <?php
                        $harga = $detail->price;
                        $totDisc = 0;

                        if($diskon[$detail->id]):
                            if(count($diskon[$detail->id]) > 0):
                                foreach($diskon[$detail->id] as $discounts):
                                    foreach($discounts as $typeDisc => $nominal):
                                        if($typeDisc == '%'):
                                            echo '<h6 class="text-danger text-uppercase">'.$nominal.' % off</h6>';
                                            $totDisc += ($nominal / 100) * $harga;
                                            $harga -= ($nominal / 100) * $harga;
                                        else:
                                            echo '<h6 class="text-danger text-uppercase">'.rupiah($nominal).' IDR off</h6>';
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
                                        echo '<h6 class="text-danger text-uppercase">'.$nominal.' % off</h6>';
                                        $totDisc += ($nominal / 100) * $harga;
                                        $harga -= ($nominal / 100) * $harga;
                                    else:
                                        echo '<h6 class="text-danger text-uppercase">'.rupiah($nominal).' IDR off</h6>';
                                        $totDisc += $nominal;
                                        $harga -= $nominal;
                                    endif;
                                endforeach;
                            endforeach;
                        endif;
                        ?>
                        <!-- <h6 class="text-danger text-uppercase">20 % Off</h6> -->
                        <!-- <h4 class="mb-4">Price : <span class="text-muted mr-2"><del>$80 USD</del></span> <b>$64 USD</b></h4> -->
                        <?php if($totDisc > 0): ?>
                            <h4 class="mb-4">Price : <span class="text-muted mr-2"><del><?php echo 'Rp ' . rupiah($detail->price) ?></del></span> <b><?php echo rupiah($harga < 1 ? 0 : $harga) ?> IDR</b></h4>
                        <?php else: ?>
                            <h4 class="mb-4">Price : <b><?php echo rupiah($harga) ?> IDR</b></h4>
                        <?php endif; ?>
                        <p class="text-muted mb-4"><?php echo $detail->description ?></p>

                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- end card-->
    </div> <!-- end col-->
</div>
<!-- end row-->