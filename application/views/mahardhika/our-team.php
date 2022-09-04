<section class="service-section shape-style-one section-gap grey-bg">
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
                        <h3 class="name"><a href="team-details.html"><?php echo $te->nama ?></a></h3>
                        <span class="pro"><?php echo $te->position ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach;
            endif; ?>
        </div>
    </div>
</section>