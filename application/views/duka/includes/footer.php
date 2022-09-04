<!-- shop modal start -->
<div class="modal fade" id="CustomModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered product__modal" role="document">
        <div class="modal-content">
            <div class="product__modal-wrapper p-relative">
                <div class="product__modal-close p-absolute">
                    <button data-bs-dismiss="modal"><i class="fal fa-times"></i></button>
                </div>
                <div id="ModalContent"></div>
            </div>
        </div>
    </div>
</div>
<!-- shop modal end -->

<!-- footer-start -->
    <footer>
        <div class="fotter-area d-dark-bg">
            <div class="footer__top pt-80 pb-15">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-7 order-last-md">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                    <div class="cta-item cta-item-d mb-30">
                                        <h5 class="cta-title">Ikuti Kami</h5>
                                        <p>Ikuti sosial media kami agar Anda mendapatkan informasi terbaru dari kami.</p>
                                        <div class="cta-social">
                                            <div class="social-icon">
                                                <?php if($this->data['general']->facebook): ?>
                                                <a href="<?php echo 'https://facebook.com/'.$this->data['general']->facebook ?>" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
                                                <?php endif; ?>
                                                <?php if($this->data['general']->twitter): ?>
                                                <a href="<?php echo 'https://twitter.com/'.$this->data['general']->twitter ?>" target="_blank" class="twitter"><i class="fab fa-twitter"></i></a>
                                                <?php endif; ?>
                                                <?php if($this->data['general']->linkedin): ?>
                                                <a href="<?php echo 'https://linkedin.com/in/'.$this->data['general']->linkedin ?>" target="_blank" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
                                                <?php endif; ?>
                                                <?php if($this->data['general']->instagram): ?>
                                                <a href="<?php echo 'https://instagram.com/'.$this->data['general']->instagram ?>" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                    <div class="footer__widget">
                                        <div class="footer__widget-title">
                                            <h4>Customer Care</h4>
                                        </div>
                                        <div class="footer__widget-content">
                                            <div class="footer__link">
                                                <ul>
                                                    <li><a href="<?php echo base_url('cara-memesan') ?>">Cara Memesan</a></li>
                                                    <li><a href="<?php echo base_url('metode-pembayaran') ?>">Metode Pembayaran</a></li>
                                                    <li><a href="<?php echo base_url('masalah-dengan-pesanan') ?>">Masalah dengan Pemesanan</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-5 order-first-md">
                            <div class="footer__top-left">
                                <div class="row">
                                    
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="footer__widget">
                                            <div class="footer__widget-title">
                                                <h4>Customer Service</h4>
                                            </div>
                                            <div class="footer__widget-content">
                                                <div class="footer__link">
                                                    <ul>
                                                        <li><a href="<?php echo base_url('pusat-bantuan') ?>">Pusat Bantuan</a></li>
                                                        <li><a href="<?php echo base_url('kontak') ?>">Contact Us</a></li>
                                                        <li><a href="<?php echo base_url('syarat-dan-ketentuan') ?>">Syarat & Ketentuan</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="footer__widget">
                                            <div class="footer__widget-title mb-20">
                                                <h4>Tentang Toko Kami</h4>
                                            </div>
                                            <div class="footer__widget-content">
                                                <p class="footer-text mb-35">
                                                    Our mission statement is to provide the absolute best customer experience available in the Electronic industry without exception.
                                                </p>
                                                <div class="footer__hotline d-flex align-items-center mb-10">
                                                    <div class="icon mr-15">
                                                        <i class="fal fa-headset"></i>
                                                    </div>
                                                    <div class="text">
                                                        <h4>Ada Pertanyaan? Call us 24/7!</h4>
                                                        <span><a href="<?php echo 'http://wa.me/'.$this->data['general']->hpWa ?>" target="_blank">+<?php echo $this->data['general']->hpWa ?></a></span>
                                                    </div>
                                                </div>
                                                <div class="footer__info">
                                                    <ul>
                                                        <li>
                                                            <span>
                                                                Add: <?php echo $this->data['general']->address ?>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__bottom">
                <div class="container">
                    <div class="footer__bottom-content pt-55 pb-45">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="copy-right-area text-center">
                                    <p>Copyright © <span>Jagodi.</span> All Rights Reserved.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer-end -->

      <!-- JS here -->
      <script src="<?php echo base_url('assets/duka/js/vendor/jquery.js')?>"></script>

      <?php
      if(count($this->data['jsdepan']) > 0):
        foreach($this->data['jsdepan'] as $jsdepan): ?>
          <script src="<?php echo $jsdepan ?>"></script>
        <?php endforeach;
      endif ?>
      
      <script src="<?php echo base_url('assets/duka/js/vendor/jquery.toast.min.js') ?>"></script>
      <script src="<?php echo base_url('assets/duka/js/vendor/waypoints.js')?>"></script>
      <script src="<?php echo base_url('assets/duka/js/bootstrap-bundle.js')?>"></script>
      <script src="<?php echo base_url('assets/duka/js/meanmenu.js')?>"></script>
      <script src="<?php echo base_url('assets/duka/js/swiper-bundle.js')?>"></script>
      <script src="<?php echo base_url('assets/duka/js/tweenmax.js')?>"></script>
      <script src="<?php echo base_url('assets/duka/js/owl-carousel.js')?>"></script>
      <script src="<?php echo base_url('assets/duka/js/magnific-popup.js')?>"></script>
      <script src="<?php echo base_url('assets/duka/js/parallax.js')?>"></script>
      <script src="<?php echo base_url('assets/duka/js/backtotop.js')?>"></script>
      <script src="<?php echo base_url('assets/duka/js/nice-select.js')?>"></script>
      <script src="<?php echo base_url('assets/duka/js/countdown.min.js')?>"></script>
      <script src="<?php echo base_url('assets/duka/js/counterup.js')?>"></script>
      <script src="<?php echo base_url('assets/duka/js/wow.js')?>"></script>
      <script src="<?php echo base_url('assets/duka/js/isotope-pkgd.js')?>"></script>
      <script src="<?php echo base_url('assets/duka/js/imagesloaded-pkgd.js')?>"></script>
      <script src="<?php echo base_url('assets/duka/js/ajax-form.js')?>"></script>
      <script src="<?php echo base_url('assets/duka/js/main.js')?>"></script>
   </body>
</html>
