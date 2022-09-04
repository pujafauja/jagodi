<?php 

$bioTeam = $this->lang->line('team-bio');

?>
<!--====== Member Details Start ======-->
<section class="member-details-wrapper section-gap-top grey-bg pb-5 col-12">
    <div class="container">
        <div class="row">
            <div class="member-picture-wrap col-4">
                <div class="member-picture">
                    <img src="<?php echo base_url('media/team/'.$team->picture) ?>" alt="<?php echo $team->nama ?>">
                </div>
            </div>
            <div class="member-desc bg-white col-8">
                <h3 class="name"><?php echo $team->nama ?></h3>
                <span class="pro"><?php echo $team->position ?></span>
                <p><?php echo $team->$bioTeam ?></p>
            </div>
        </div>
    </div>
</section>
<!--====== Member Details End ======-->