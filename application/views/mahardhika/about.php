
    <!--====== About Section start ======-->
    <section class="about-section advanced-tab grey-bg about-illustration-img py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <img src="<?php echo base_url('media/about/'.$about->gambar) ?>" alt="Image" class="col-12">
                </div>
                <div class="col-md-8">
                    <div class="about-text text-justify">
                        <div class="section-title left-border mb-4">
                            <span class="title-tag">About Us</span>
                        </div>
                        <?php
						echo $aboutText;
						?>
                    </div>

                    <!-- Tabs Buttons -->
                    <div class="tab-buttons mt-5">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="active" id="nav-mission" data-toggle="tab" href="#tab-mission" role="tab">Our Mission & Vision</a>
                            <a id="nav-history" data-toggle="tab" href="#tab-history" role="tab">Company History</a>
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="tab-mission" role="tabpanel">
                                <div class="tab-text-block">
                                    <div class="row align-items-center justify-content-center">
                                        <div class="col-12">
                                            <div class="block-text">
                                                <?php echo $visimisi ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-history" role="tabpanel">
                                <div class="tab-text-block right-image">
                                    <div class="row align-items-center justify-content-center">
                                        <div class="col-12order-2 order-lg-1">
                                            <div class="block-text">
                                                <?php echo $history ?>
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
    </section>
    <!--====== About Section end ======-->

    <section class="service-section section-gap">
    <div class="container">
        <!-- Section Title -->
        <div class="section-title mb-40 both-border text-center">
            <span class="title-tag"><?php echo $this->lang->line('meet-team') ?></span>
            <h2 class="title"><?php echo $this->lang->line('exclusive-team') ?></h2>
        </div>

        <!-- Team Boxes -->
        <div class="row team-members" id="">
            <?php if($team->num_rows() > 0):
                foreach($team->result() as $te): ?>
            <div class="col-lg-2">
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