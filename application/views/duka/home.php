<main>
    <!-- slider-area-start -->
    <div class="slider-area">
        <div class="swiper-container slider__active">
            <div class="slider-wrapper swiper-wrapper">
                <?php foreach($slider->result() as $slide): ?>
                <div class="single-slider swiper-slide slider-height d-flex align-items-center" data-background="<?php echo base_url('media/sliders/'.$slide->gambar) ?>">
                </div><!-- /single-slider -->
                <?php endforeach ?>
                <div class="main-slider-paginations"></div>
            </div>
        </div>
    </div>
    <!-- slider-area-end -->

    <!-- features__area-start -->
    <section class="features__area pt-20">
        <div class="container">
            <div class="row row-cols-xxl-3 row-cols-xl-3 row-cols-lg-3 row-cols-md-2 row-cols-sm-2 row-cols-1 gx-0">
                <div class="col">
                    <div class="features__item d-flex white-bg">
                        <div class="features__icon mr-20">
                            <i class="fal fa-money-check"></i>
                        </div>
                        <div class="features__content">
                            <h6>PEMBAYARAN AMAN</h6>
                            <p>100% pembayaran yang aman</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="features__item d-flex white-bg">
                        <div class="features__icon mr-20">
                            <i class="fal fa-comments-alt"></i>
                        </div>
                        <div class="features__content">
                            <h6>24/7 HELP CENTER</h6>
                            <p>Dukungan 24/7</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="features__item features__item-last d-flex white-bg">
                        <div class="features__icon mr-20">
                            <i class="fad fa-user-headset"></i>
                        </div>
                        <div class="features__content">
                            <h6>PELAYANAN RAMAH</h6>
                            <p>Pelayanan dijamin menyenangkan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- features__area-end -->

    <!-- banner__area-start -->
    <section class="banner__area pt-20 pb-10">
        <div class="container">
            <div class="row">
                <?php $no = 1; foreach($banner->result() as $bann): ?>
                <?php if($bann->position == 'top' && $no < 4): ?>
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="banner__item p-relative w-img mb-30">
                        <div class="banner__img">
                            <a href="<?php echo $bann->url ?>"><img src="<?php echo base_url('media/banner/md/'.$bann->gambar) ?>" alt=""></a>
                        </div>
                        <div class="banner__content">
                            <a href="<?php echo $bann->url ?>"><h6><?php echo $bann->desc ?></h6></a>
                        </div>
                    </div>
                </div>
                <?php $no++; endif; endforeach; ?>
            </div>
        </div>
    </section>
    <!-- banner__area-end -->

    <!-- topsell__area-start -->
    <section class="topsell__area-2 pt-15">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section__head d-flex justify-content-between mb-10">
                        <div class="section__title">
                            <h5 class="st-titile">Keluaran Terbaru</h5>
                        </div>
                        <div class="product__nav-tab"> 
                            <ul class="nav nav-tabs" id="flast-sell-tab" role="tablist">
                                <?php $no = 1; foreach($newestProducts as $newest): ?>
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link <?php echo $no == 1 ? 'active' : '' ?>" id="<?php echo $newest[0]->catSlug ?>-tab" data-bs-toggle="tab" data-bs-target="#<?php echo $newest[0]->catSlug ?>" type="button" role="tab" aria-controls="<?php echo $newest[0]->catSlug ?>" aria-selected="false"><?php echo $newest[0]->category ?></button>
                                </li>
                                <?php $no++; endforeach; ?>
                              </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="tab-content" id="flast-sell-tabContent">
                        <?php $no = 1; foreach($newestProducts as $newest): ?>
                        <div class="tab-pane fade <?php echo $no == 1 ? 'active show' : '' ?>" id="<?php echo $newest[0]->catSlug ?>" role="tabpanel" aria-labelledby="<?php echo $newest[0]->catSlug ?>-tab">
                            <div class="product-bs-slider-2">
                                <div class="product-slider-2 swiper-container">
                                    <div class="swiper-wrapper">
                                        <?php foreach($newest as $prodNewest): 
                                        $image = json_decode($prodNewest->images);
                                        ?>
                                        <div class="product__item swiper-slide">
                                            <div class="product__thumb fix">
                                                <div class="product-image w-img">
                                                    <a href="<?php echo base_url('produk/'.$prodNewest->slug) ?>">
                                                        <img src="<?php echo base_url('media/products/md/'.$image[0]) ?>" alt="product">
                                                    </a>
                                                </div>
                                                <div class="product__offer">
                                                    <?php
                                                    $harga = $prodNewest->price;
                                                    $totDisc = 0;

                                                    if($diskon[$prodNewest->id]):
                                                        if(count($diskon[$prodNewest->id]) > 0):
                                                            foreach($diskon[$prodNewest->id] as $discounts):
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
                                                    <a href="<?php echo base_url('produk/modal/'.encode($prodNewest->id)) ?>" class="icon-box icon-box-1 view-product-modal">
                                                        <i class="fal fa-eye"></i>
                                                        <i class="fal fa-eye"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product__content mt-5">
                                                <h6><a href="<?php echo base_url('produk/'.$prodNewest->slug) ?>"><?php echo $prodNewest->nama ?></a></h6>
                                                <div class="price">
                                                    <span>Rp <?php echo rupiah($harga < 1 ? 0 : $harga) ?></span>
                                                </div>
                                            </div>
                                            <div class="product__add-cart text-center">
                                                <a href="<?php echo base_url('produk/modal/'.encode($prodNewest->id)) ?>" type="button" class="cart-btn product-modal-sidebar-open-btn d-flex align-items-center justify-content-center w-100 view-product-modal">
                                                Tambah ke Keranjang
                                                </a>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <!-- If we need navigation buttons -->
                                <div class="bs-button bs2-button-prev"><i class="fal fa-chevron-left"></i></div>
                                <div class="bs-button bs2-button-next"><i class="fal fa-chevron-right"></i></div>
                            </div>
                        </div>
                        <?php $no++; endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- topsell__area-end -->

    <!-- banner__area-start -->
    <section class="banner__area banner__area-d pb-50">
        <div class="container">
            <div class="row">
                <?php $no = 1; foreach($banner->result() as $bann): ?>
                <?php if($bann->position == 'center' && $no < 3): ?>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="banner__item p-relative w-img mb-30">
                        <div class="banner__img">
                            <a href="<?php echo $bann->url ?>"><img src="<?php echo base_url('media/banner/md/'.$bann->gambar) ?>" alt=""></a>
                        </div>
                        <div class="banner__content">
                            <h6><a href="<?php echo $bann->url ?>"><?php echo $bann->desc ?></a></h6>
                        </div>
                    </div>
                </div>
                <?php $no++; endif; endforeach; ?>
            </div>
        </div>
    </section>
    <!-- banner__area-end -->

    <!-- featured-start -->
    <section class="featured light-bg pt-55 pb-40">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section__head d-flex justify-content-between mb-30">
                        <div class="section__title">
                            <h5 class="st-titile">Produk Unggulan</h5>
                        </div>
                        <div class="button-wrap">
                            <a href="<?php echo base_url('produk-unggulan') ?>">Lihat semua produk <i class="fal fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-12">
                    <?php if ($featuredProducts->num_rows() > 0): $n = 1; foreach($featuredProducts->result() as $features): if ($n == 1): $image = json_decode($features->images) ?>
                    <div class="single-features-item single-features-item-d b-radius mb-20">
                        <div class="row  g-0 align-items-center">
                            <div class="col-md-6">
                                <div class="features-thum">
                                    <div class="features-product-image w-img">
                                        <a href="<?php echo base_url('produk/'.$features->slug) ?>"><img src="<?php echo base_url('media/products/md/'.$image[0]) ?>" alt=""></a>
                                    </div>
                                    <div class="product__offer">
                                        <?php
                                        $harga = $features->price;
                                        $totDisc = 0;

                                        if($diskon[$features->id]):
                                            if(count($diskon[$features->id]) > 0):
                                                foreach($diskon[$features->id] as $discounts):
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
                                        <a href="<?php echo base_url('produk/modal/'.encode($features->id)) ?>" class="icon-box icon-box-1 view-product-modal">
                                            <i class="fal fa-eye"></i>
                                            <i class="fal fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 px-3">
                                <div class="product__content product__content-d">
                                    <h6><a href="<?php echo base_url('produk/'.$features->slug) ?>"><?php echo $features->nama ?></a></h6>
                                    <div class="price d-price mb-10">
                                        <span>Rp <?php echo rupiah($harga < 1 ? 0 : $harga) ?><!--  <del>$110</del> --></span>
                                    </div>
                                    <div class="features-des mb-25">
                                        <?php echo $features->summary ?>
                                    </div>
                                    <div class="cart-option">
                                        <a href="<?php echo base_url('produk/modal/'.encode($features->id)) ?>" class="cart-btn-2 w-100 mr-10 view-product-modal">Tambah ke Keranjang</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; $n++; endforeach; endif; ?>
                </div>
                <div class="col-xl-6 col-lg-12">
                    <div class="row">
                    <?php if ($featuredProducts->num_rows() > 0): $n = 1; foreach($featuredProducts->result() as $features): if ($n > 1): $image = json_decode($features->images) ?>
                        <div class="col-md-6">
                            <div class="single-features-item b-radius mb-20">
                                <div class="row  g-0 align-items-center">
                                    <div class="col-6">
                                        <div class="features-thum">
                                            <div class="features-product-image w-img">
                                                <a href="<?php echo base_url('produk/'.$features->slug) ?>"><img src="<?php echo base_url('media/products/sm/'.$image[0]) ?>" alt=""></a>
                                            </div>
                                            <div class="product__offer">
                                                <?php
                                                $harga = $features->price;
                                                $totDisc = 0;

                                                if($diskon[$features->id]):
                                                    if(count($diskon[$features->id]) > 0):
                                                        foreach($diskon[$features->id] as $discounts):
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
                                        </div>
                                    </div>
                                    <div class="col-6 px-2">
                                        <div class="product__content product__content-d">
                                            <h6><a href="<?php echo base_url('produk/'.$features->slug) ?>"><?php echo $features->nama ?></a></h6>
                                            <div class="price d-price">
                                                <span>Rp <?php echo rupiah($harga < 1 ? 0 : $harga) ?> <!-- <del>$110</del> --></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; $n++; endforeach; endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- featured-end -->

    <!-- produk-terlari-area-start -->
    <section class="recomand-product-area pt-25">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section__head d-flex justify-content-between mb-10">
                        <div class="section__title">
                            <h5 class="st-titile">Produk Terlaris</h5>
                        </div>
                        <div class="button-wrap">
                            <a href="<?php echo base_url('produk-terlaris') ?>">Lihat semua produk <i class="fal fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-0">
                <div class="product-bs-slider-2">
                    <div class="product-slider-3 swiper-container">
                        <div class="swiper-wrapper">
                            <?php foreach($topSells->result() as $sold): $image = json_decode($sold->images); ?>
                            <div class="product__item mb-20 swiper-slide">
                                <div class="product__thumb fix">
                                    <div class="product-image w-img">
                                        <a href="<?php echo base_url('produk/'.$sold->slug) ?>">
                                            <img src="<?php echo base_url('media/products/md/'.$image[0]) ?>" alt="<?php echo $sold->nama ?>">
                                        </a>
                                    </div>
                                    <div class="product__offer">
                                        <?php
                                        $harga = $sold->price;
                                        $totDisc = 0;

                                        if($diskon[$sold->id]):
                                            if(count($diskon[$sold->id]) > 0):
                                                foreach($diskon[$sold->id] as $discounts):
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
                                        <a href="<?php echo base_url('produk/modal/'.encode($sold->id)) ?>" class="icon-box icon-box-1 view-product-modal">
                                            <i class="fal fa-eye"></i>
                                            <i class="fal fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product__content mt-5">
                                    <h6><a href="<?php echo base_url('produk/'.$sold->slug) ?>"><?php echo $sold->nama ?></a></h6>
                                    <div class="price">
                                        <span>Rp <?php echo rupiah($harga < 1 ? 0 : $harga) ?></span>
                                    </div>
                                </div>
                                <div class="product__add-cart text-center">
                                    <button type="button" class="cart-btn product-modal-sidebar-open-btn d-flex align-items-center justify-content-center w-100 view-product-modal">
                                    Tambah ke Keranjang
                                    </button>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- produk-terlari-area-end -->

    <!-- brand-area-start -->
    <section class="brand-area brand-area-d">
        <div class="container">
            <div class="brand-slider swiper-container pt-50 pb-45">
                <div class="swiper-wrapper">
                    <?php foreach($partners->result() as $partner): ?>
                    <div class="brand-item w-img swiper-slide">
                        <a href="<?php echo $partner->url ?>" target="_blank"><img src="<?php echo base_url('media/partners/'.$partner->logo) ?>" alt="<?php echo $partner->nama ?>"></a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    <!-- brand-area-end -->

    <!-- moveing-text-area-start -->
    <section class="moveing-text-area">
        <div class="container">
            <div class="ovic-running">
                <div class="wrap">
                    <div class="inner">
                        <?php foreach($runningTexts->result() as $runningText): ?>
                        <p class="item"><?php echo $runningText->words ?></p>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- moveing-text-area-end -->

</main>