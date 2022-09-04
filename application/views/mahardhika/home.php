

	<!--====== Banner part start ======-->
	<section class="banner-section">
		<div class="banner-slider" id="bannerSlider">
			<?php
			if ($banner->num_rows() > 0):
				foreach($banner->result() as $b):
			?>
			<div class="single-banner" style="background-image: url(<?php echo base_url('media/banner/'.$b->gambar) ?>);">
				<div class="container">
					<div class="row">
						<div class="col-lg-10">
							<div class="banner-content">
								<span class="promo-text" data-animation="fadeInDown" data-delay="0.8s">
									<?php 
										$field = $this->lang->line('banner-title');
										echo $b->$field
									?>
								</span>
								<h1 data-animation="fadeInUp" data-delay="1s">
									<?php 
										$field = $this->lang->line('banner-slogan');
										echo $b->$field
									?>
								</h1>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php endforeach; endif; ?>
		</div>

	</section>
	<!--====== Banner part end ======-->

	<!--====== About Section start ======-->
	<section class="about-section about-illustration-img section-gap">
		<div class="container">
			<div class="illustration-img">
				<img src="<?php echo base_url('media/about/'.$about->gambar) ?>" alt="Image">
			</div>
			<div class="row no-gutters justify-content-lg-end justify-content-center">
				<div class="col-lg-6 col-md-10">
					<div class="about-text">
						<div class="section-title left-border mb-10">
							<span class="title-tag">About Us</span>
						</div>
						<?php
						$about_lang = $this->lang->line('short-about');
						echo $about->$about_lang;
						?>
						<br>
						<a href="<?php echo base_url('about') ?>" class="main-btn"><?php echo $this->lang->line('read-more') ?></a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--====== About Section end ======-->

	<!--====== Service Part Start ======-->
	<section class="service-section section-gap grey-bg">
		<div class="container">
			<!-- Section Title -->
			<div class="section-title text-center both-border mb-30">
				<span class="title-tag">Company Services</span>
				<h2 class="title"><?php echo $this->lang->line('provide') ?></h2>
			</div>
			<!-- Services Boxes -->
			<div class="row service-boxes justify-content-center">
				<?php
				$service_title_lang = $this->lang->line('service-title');
				$service_desc_lang = $this->lang->line('service-short-desc');

				if($this->data['service']->num_rows() > 0):
					foreach($this->data['service']->result() as $ser): ?>
				<div class="col-lg-4 col-md-6 col-sm-8 col-10 col-tiny-12 wow fadeInLeft" data-wow-duration="1500ms"
					data-wow-delay="400ms">
					<div class="service-box text-center">
						<div class="icon">
							<img src="<?php echo base_url('media/service/'.$ser->icon) ?>" alt="Icon">
						</div>
						<h3><?php echo $ser->$service_title_lang ?></h3>
						<p><?php echo $ser->$service_desc_lang ?></p>
						<a href="<?php echo base_url(create_slug($ser->titleEN)) ?>" class="service-link">
							<i class="fal fa-long-arrow-right"></i>
						</a>
					</div>
				</div>
				<?php endforeach; endif; ?>
			</div>
		</div>
	</section>
	<!--====== Service Part End ======-->

	<!--====== Team Section Start ======-->
	<section class="team-section section-gap">
		<div class="container">
			<!-- Section Title -->
			<div class="section-title mb-40 both-border text-center">
				<span class="title-tag"><?php echo $this->lang->line('meet-team') ?></span>
				<h2 class="title"><?php echo $this->lang->line('exclusive-team') ?></h2>
			</div>

			<!-- Team Boxes -->
			<div class="row team-members" id="teamSliderOne">
				<?php if($team->num_rows() > 0):
					foreach($team->result() as $te): ?>
				<div class="col-lg-3">
					<div class="team-member">
						<div class="member-picture-wrap">
							<div class="member-picture">
								<img src="<?php echo base_url('media/team/'.$te->picture) ?>" alt="<?php echo $te->nama?>">
								<div class="social-icons">
									<a href="<?php echo $te->linkedin ?>" target="_blank">
										<i class="fab fa-linkedin-in"></i>
									</a>
									<a href="<?php echo $te->facebook ?>" target="_blank">
										<i class="fab fa-facebook-f"></i>
									</a>
									<a href="<?php echo $te->twitter ?>" target="_blank">
										<i class="fab fa-twitter"></i>
									</a>
									<a href="<?php echo $te->instagram ?>" target="_blank">
										<i class="fab fa-instagram"></i>
									</a>
								</div>
							</div>
						</div>
						<div class="member-desc">
							<h3 class="name"><a href="<?php echo base_url('about/team/'.encode($te->id)) ?>"><?php echo $te->nama ?></a></h3>
							<span class="pro"><?php echo $te->position ?></span>
						</div>
					</div>
				</div>
				<?php endforeach;
				endif; ?>
			</div>
		</div>
	</section>
	<!--====== Team Section End ======-->

	<!--====== Latest Post Start ======-->
	<section class="latest-post-section shape-style-one section-gap grey-bg">
		<div class="container">
			<div class="row align-items-center justify-content-center">
				<div class="col-lg-6 col-md-8 col-10 col-tiny-12">
					<div class="section-title left-border">
						<span class="title-tag">Important Articles</span>
						<h2 class="title"><?php echo $this->lang->line('sub-article') ?></h2>
					</div>
				</div>
				<div class="col-lg-6 col-md-4 col-10 col-tiny-12">
					<div class="text-md-right mt-30 mt-md-0">
						<a href="#" class="main-btn"><?php echo $this->lang->line('show-articles') ?></a>
					</div>
				</div>
			</div>
			<div class="latest-post-loop row mt-50 justify-content-center">
				<?php if($article->num_rows() > 0): 
					$judulartikel = $this->lang->line('judularticle');
					$isiartikel = $this->lang->line('contentarticle');
					foreach($article->result() as $art):
				?>
				<div class="col-lg-4 col-md-6 col-10 col-tiny-12 wow fadeInLeft" data-wow-duration="1500ms"
					data-wow-delay="400ms">
					<div class="latest-post-box">
						<div class="post-thumb-wrap">
							<div class="post-thumb bg-img-c"
								style="background-image: url(<?php echo base_url('media/article/'.$art->gambar) ?>);">
							</div>
						</div>
						<div class="post-desc">
							<span class="post-date"><i class="far fa-calendar-alt"></i><?php echo tgl($art->created_at) ?></span>
							<h3 class="title">
								<a href="<?php echo base_url(create_slug($art->$judulartikel)) ?>">
									<?php echo $art->$judulartikel ?>
								</a>
							</h3>
							<p>
								<?php echo html_cut($art->$isiartikel, 150) ?>
							</p>
							<a href="<?php echo base_url(create_slug($art->$judulartikel)) ?>" class="post-link">
								<?php echo $this->lang->line('read-more') ?> <i class="far fa-long-arrow-right"></i>
							</a>
						</div>
					</div>
				</div>
				<?php endforeach; endif; ?>
			</div>
		</div>
	</section>
	<!--====== Latest Post Start ======-->