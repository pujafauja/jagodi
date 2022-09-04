<!DOCTYPE html>
<html lang="en">

<head>
	<!--====== Required meta tags ======-->
	<meta charset="utf-8" />
	<meta http-equiv="x-ua-compatible" content="ie=edge" />
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<!--====== Title ======-->
	<title> Mahardhika - Riset & Konsultan </title>
	<!--====== Favicon Icon ======-->
	<link rel="shortcut icon" href="<?php echo base_url() ?>assets/mahardhika/img/favicon.png" type="img/png" />
	<!--====== Animate Css ======-->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/mahardhika/css/animate.min.css">
	<!--====== Bootstrap css ======-->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/mahardhika/css/bootstrap.min.css" />
	<!--====== Fontawesome css ======-->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/mahardhika/css/font-awesome.min.css" />
	<!--====== Flaticon css ======-->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/mahardhika/css/flaticon.css" />
	<!--====== Magnific Popup css ======-->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/mahardhika/css/magnific-popup.css" />
	<!--====== Slick  css ======-->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/mahardhika/css/slick.css" />
	<!--====== Jquery ui ======-->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/mahardhika/css/jquery-ui.min.css" />
	<!--====== Style css ======-->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/mahardhika/css/style.css" />
	<!--====== Custom css ======-->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/mahardhika/css/custom.css" />
</head>

<body>
	<!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
	<![endif]-->

	<!--====== Preloader ======-->
	<div id="preloader">
		<div class="loader-cubes">
			<div class="loader-cube1 loader-cube"></div>
			<div class="loader-cube2 loader-cube"></div>
			<div class="loader-cube4 loader-cube"></div>
			<div class="loader-cube3 loader-cube"></div>
		</div>
	</div>

	<!--====== Header part start ======-->
	<header class="sticky-header">
		<input type="hidden" id="base_url" value="<?php echo base_url() ?>" />
		<!-- Header Menu  -->
		<div class="header-nav">
			<div class="container-fluid container-1600">
				<div class="nav-container">
					<!-- Site Logo -->
					<div class="site-logo">
						<a href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>assets/mahardhika/img/logo-dark.png" alt="Logo" height=""></a>
					</div>

					<!-- Main Menu -->
					<div class="nav-menu d-lg-flex align-items-center">

						<!-- Navbar Close Icon -->
						<div class="navbar-close">
							<div class="cross-wrap"><span></span><span></span></div>
						</div>

						<!-- Mneu Items -->
						<div class="menu-items">
							<ul>
								<li class="">
									<a href="<?php echo base_url() ?>"><?php echo $this->lang->line('menu')['home'] ?></a>
								</li>
								<li class="">
									<a href="<?php echo base_url('about') ?>"><?php echo $this->lang->line('menu')['about'] ?></a>
									<!-- <ul class="submenu">
										<li><a href="<?php echo base_url('about') ?>"><?php echo $this->lang->line('menu')['about'] ?></a></li>
									</ul> -->
								</li>
								<li class="">
									<a href="<?php echo base_url('service') ?>"><?php echo $this->lang->line('menu')['service'] ?></a>
								</li>
								<li class="">
									<a href="<?php echo base_url('article') ?>"><?php echo $this->lang->line('menu')['article'] ?></a>
								</li>
								<li><a href="<?php echo base_url('contact') ?>"><?php echo $this->lang->line('menu')['contact'] ?></a></li>
								<li class="has-submemu">
									<?php
										$language = $this->session->userdata('language');
										if(!$language || $language == 'EN'):
											$language = 'english';
										elseif($language == 'INA'):
											$language = 'indonesia';
										endif;
									?>
									<a href="#"><img src="<?php echo base_url('media/flag/'.$language.'.png') ?>" width="30px" ></a>
									<ul class="submenu">
										<li>
											<?php
												if($language == 'english'):
													$changeLanguage = 'INA';
													$flag = 'indonesia.png';
												else:
													$changeLanguage = 'EN';
													$flag = 'english.png';
												endif;
											?>
											<a href="<?php echo base_url($changeLanguage) ?>"><img src="<?php echo base_url('media/flag/'.$flag) ?>" width="30px" /></a>
										</li>
									</ul>
								</li>
							</ul>
						</div>
						<!-- Pushed Item -->
						<div class="nav-pushed-item"></div>
					</div>

					<!-- Navbar Extra  -->
					<div class="navbar-extra d-lg-block d-flex align-items-center">
						<!-- Navbtn -->
						<div class="navbar-btn nav-push-item">
							<a class="main-btn main-btn-3" href="<?php echo base_url('contact') ?>"><?php echo $this->lang->line('konsultasi') ?></a>
						</div>
						<!-- Navbar Toggler -->
						<div class="navbar-toggler">
							<span></span><span></span><span></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!--====== Header part end ======-->