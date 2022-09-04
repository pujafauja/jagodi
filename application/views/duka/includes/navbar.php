    <header class="header d-blue-bg">
        <div class="header-mid">
            <div class="container">
                <div class="heade-mid-inner">
                    <div class="row align-items-center">
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6">
                            <div class="header__info">
                                <div class="logo">
                                    <a href="<?php echo base_url() ?>" class="logo-image"><img src="<?php echo base_url() ?>assets/logos/logo-light.png" alt="logo"></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 d-none d-lg-block">
                            <div class="header__search">
                                <form action="<?php echo base_url('produk/search') ?>">
                                    <div class="header__search-box">
                                        <input class="search-input" type="text" placeholder="Saya sedang mencari..." name="s" value="<?php echo $_GET['s'] ?>">
                                        <button class="button" type="submit"><i class="far fa-search"></i></button>
                                    </div>
                                    <div class="header__search-cat">
                                        <select name="kategori">
                                            <option value="all">Semua Kategori</option>
                                            <?php foreach($this->data['categories']->result() as $cats): ?>
                                            <option value="<?php echo encode($cats->id) ?>"><?php echo $cats->nama ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                            <div class="header-action">
                                <div class="block-userlink">
                                    <a class="icon-link" href="<?php echo base_url('account') ?>">
                                    <i class="flaticon-user"></i>
                                    <span class="text">
                                        <?php if($this->session->userdata('customerid')): ?>
                                        <span class="sub">Login sebagai </span>
                                        <?php echo $this->data['customer-data']->username ?>
                                        <?php else: ?>
                                        <span class="sub">Login</span>
                                        Akun Saya
                                        <?php endif; ?>
                                    </span>
                                    </a>
                                </div>
                                <div class="block-cart action">
                                    <a class="icon-link" href="<?php echo base_url('cart') ?>">
                                        <i class="flaticon-shopping-bag"></i>
                                        <span class="count">
                                        </span>
                                        <span class="text">
                                            <span class="sub">Keranjang Anda:</span>
                                            <span class="cart__grandtotal"></span>
                                        </span>
                                    </a>
                                    <?php if($this->data['keranjang']): ?>
                                    <div class="cart">
                                        <div class="cart__mini">
                                            <ul>
                                                <li>
                                                  <div class="cart__title">
                                                    <h4>Keranjang Anda</h4>
                                                    <span>(<?php echo $this->data['keranjang']->num_rows > 0 ? $this->data['keranjang']->num_rows() : 0 ?> Barang dalam keranjang)</span>
                                                  </div>
                                                </li>
                                                <li>
                                                </li>
                                                <li>
                                                  <div class="cart__sub d-flex justify-content-between align-items-center">
                                                    <h6>Subtotal</h6>
                                                    <span class="cart__sub-total"></span>
                                                  </div>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url('carts') ?>" class="wc-cart mb-10">View cart</a>
                                                    <a href="<?php echo base_url('checkout') ?>" class="wc-checkout">Checkout</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header__bottom">
            <div class="container">
                <div class="row g-0 align-items-center">
                    <div class="col-lg-3">                        
                        <div class="cat__menu-wrapper side-border d-none d-lg-block">
                            <div class="cat-toggle">
                                <button type="button" class="cat-toggle-btn cat-toggle-btn-1"><i class="fal fa-bars"></i> Pilih Kategori</button>
                                <div class="cat__menu">
                                    <nav id="mobile-menu" style="display: block;">
                                        <?php echo nestedSelectCat(ordered_menu($this->data['categories']->result_array())) ?>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-4">
                      <div class="header__bottom-left d-flex d-xl-block align-items-center">
                        <div class="side-menu d-lg-none mr-20">
                          <button type="button" class="side-menu-btn offcanvas-toggle-btn"><i class="fas fa-bars"></i> MENU</button>
                        </div>
                        <div class="main-menu d-none d-lg-block">
                            <nav>
                                <ul>
                                    <li>
                                        <a href="<?php echo base_url() ?>" class="">Home</a>
                                    </li>
                                    <li><a href="<?php echo base_url('about') ?>">Tentang Kami</a></li>
                                    <li><a href="<?php echo base_url('kontak') ?>">Kontak Kami</a></li>
                                    <!-- <li><a href="<?php echo base_url('blog') ?>">Blog</a></li> -->
                                </ul>
                            </nav>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-8">
                        <div class="shopeing-text text-sm-end">
                            <?php $noWA = sql_get_var('pp_settings', 'hpWa', ['id' => '1']); ?>
                            <p class="">Butuh Bantuan? <a href="http://wa.me/<?php echo $noWA ?>?text=Halo Jagodi, boleh minta informasinya?    ref: <?php echo current_url() ?>" target="_blank">+<?php echo $noWA ?></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->

    <!-- offcanvas area start -->
    <div class="offcanvas__area">
        <div class="offcanvas__wrapper">
        <div class="offcanvas__close">
            <button class="offcanvas__close-btn" id="offcanvas__close-btn">
                <i class="fal fa-times"></i>
            </button>
        </div>
        <div class="offcanvas__content">
            <div class="offcanvas__logo mb-40">
                <a href="<?php echo base_url() ?>">
                    <img src="<?php echo base_url() ?>assets/logos/logo-dark.png" alt="logo">
                </a>
            </div>
            <div class="offcanvas__search mb-25">
                <form action="#">
                    <input type="text" placeholder="What are you searching for?">
                    <button type="submit" ><i class="far fa-search"></i></button>
                </form>
            </div>
            <div class="mobile-menu fix"></div>
            <div class="offcanvas__action">

            </div>
        </div>
        </div>
    </div>
    <!-- offcanvas area end -->      
    <div class="body-overlay"></div>
    <!-- offcanvas area end -->