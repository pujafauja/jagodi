

	<!--====== Footer Part Start ======-->
	<footer>
		<div class="container">
			<div class="footer-widget">
				<div class="row">
					<div class="col-lg-4 col-sm-5 order-1">
						<div class="widget site-info-widget">
							<div class="footer-logo">
								<img src="<?php echo base_url() ?>assets/mahardhika/img/logo-dark.png" alt="Finsa">
							</div>
							<p><?php echo $this->data['social']->address ?></p>
						</div>
					</div>
					<!-- <div class="col-lg-8 col-sm-7 order-2">
						<div class="widget newsletter-widget">
							<h4 class="widget-title">Subscribe Our Newsletters</h4>
							<div class="newsletter-form">
								<form action="#">
									<input type="email" placeholder="Enter Your Email">
									<button type="submit" class="main-btn">Subscribe Now</button>
								</form>
							</div>
						</div>
					</div> -->
					<div class="col-lg-3 col-sm-6 order-3">
						<div class="widget nav-widget">
							<h4 class="widget-title">Quick Links</h4>
							<ul>
								<li><a href="<?php echo base_url('about#tab-history') ?>">Company History</a></li>
								<li><a href="<?php echo base_url('article') ?>">Latest Articles</a></li>
								<li><a href="<?php echo base_url('service') ?>">Our Services</a></li>
							</ul>
						</div>
					</div>
					<!-- <div class="col-lg-5 order-lg-4 order-5">
						<div class="row">
							<div class="col-lg-6 col-sm-6">
								<div class="widget nav-widget">
									<h4 class="widget-title">Company</h4>
									<ul>
										<li><a href="#">About Comapny</a></li>
										<li><a href="#">World Wide Clients</a></li>
										<li><a href="#">Happy People’s</a></li>
										<li><a href="#">Winning Awards</a></li>
										<li><a href="#">Company Statics</a></li>
									</ul>
								</div>
							</div>
							<div class="col-lg-6 col-sm-6">
								<div class="widget contact-widget">
									<h4 class="widget-title">Contact Us</h4>
									<p>Untrammelled & nothing preven our being able</p>
									<ul class="contact-infos">
										<li>
											<a href="tel:+0123456789">
												<i class="far fa-phone"></i>
												+012 (345) 6789
											</a>
										</li>
										<li>
											<a href="mailto:support@gmail.com">
												<i class="far fa-envelope-open"></i>
												support@gmail.com
											</a>
										</li>
										<li> <i class="far fa-map-marker-alt"></i> Broklyn Street USA</li>
									</ul>
								</div>
							</div>
						</div>
					</div> -->
					<div class="col-lg-4 col-sm-6 order-lg-5 order-4">
						<div class="widget insta-feed-widget">
							<h4 class="widget-title">Our Social Media</h4>
							<ul class="social-links">
								<li><a href="https://facebook.com/<?php echo $this->data['social']->facebook ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="https://twitter.com/<?php echo $this->data['social']->twitter ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
								<li><a href="https://instagram.com/<?php echo $this->data['social']->instagram ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
								<li><a href="https://linkedin.com/<?php echo $this->data['social']->linkedin ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-copyright">
				<p class="copyright-text">
					<span>@ 2022 <a href="<?php echo base_url() ?>">Mahardhika <?php echo $this->lang->line('slogan') ?></a></span>
					<span>All Right Reserved</span>
				</p>

				<a href="#" class="back-to-top"><i class="far fa-angle-up"></i></a>
			</div>
		</div>

		<!-- Lines -->
		<img src="<?php echo base_url() ?>assets/mahardhika/img/lines/01.png" alt="line-shape" class="line-one" width="10%">
		<img src="<?php echo base_url() ?>assets/mahardhika/img/lines/02.png" alt="line-shape" class="line-two">
	</footer>
	<!--====== Footer Part end ======-->

	<!--====== jquery js ======-->
	<script src="<?php echo base_url() ?>assets/mahardhika/js/vendor/modernizr-3.6.0.min.js"></script>
	<script src="<?php echo base_url() ?>assets/mahardhika/js/vendor/jquery-1.12.4.min.js"></script>
	<!--====== Bootstrap js ======-->
	<script src="<?php echo base_url() ?>assets/mahardhika/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url() ?>assets/mahardhika/js/popper.min.js"></script>
	<!--====== Slick js ======-->
	<script src="<?php echo base_url() ?>assets/mahardhika/js/slick.min.js"></script>
	<!--====== Isotope js ======-->
	<script src="<?php echo base_url() ?>assets/mahardhika/js/isotope.pkgd.min.js"></script>
	<!--====== Magnific Popup js ======-->
	<script src="<?php echo base_url() ?>assets/mahardhika/js/jquery.magnific-popup.min.js"></script>
	<!--====== inview js ======-->
	<script src="<?php echo base_url() ?>assets/mahardhika/js/jquery.inview.min.js"></script>
	<!--====== counterup js ======-->
	<script src="<?php echo base_url() ?>assets/mahardhika/js/jquery.countTo.js"></script>
	<!--====== easy PieChart js ======-->
	<script src="<?php echo base_url() ?>assets/mahardhika/js/jquery.easypiechart.min.js"></script>
	<!--====== Jquery Ui ======-->
	<script src="<?php echo base_url() ?>assets/mahardhika/js/jquery-ui.min.js"></script>
	<!--====== Wow JS ======-->
	<script src="<?php echo base_url() ?>assets/mahardhika/js/wow.min.js"></script>
	<!--====== Main js ======-->
	<script src="<?php echo base_url() ?>assets/mahardhika/js/main.js"></script>

	<!--====== Additional js ======-->
	<?php
	if(count($this->data['jsdepan']) > 0) {
		foreach ($this->data['jsdepan'] as $js) { ?>
			<script type="text/javascript" src="<?php echo $js ?>"></script>
		<?php }
	}
	?>
</body>

</html>