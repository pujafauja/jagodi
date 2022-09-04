<div class="row">
    <?php
    if($team->num_rows() > 0):
        foreach($team->result() as $t): ?>
    <div class="col-lg-4">
        <div class="text-center card-box">
            <div class="pt-2 pb-2">
                <img src="<?php echo base_url('media/team/'.$t->picture) ?>" class="rounded-circle img-thumbnail avatar-xl" alt="profile-image">

                <h4 class="mt-3"><a href="extras-profile.html" class="text-dark"><?php echo $t->nama ?></a></h4>
                <p class="text-muted">@<?php echo $t->position ?></p>

                <button type="button" class="btn btn-primary btn-sm waves-effect waves-light edit-team" data-url="<?php echo base_url('about-us/edit-team/'.encode($t->id)) ?>"><i class="fe-edit"></i></button>
                <button type="button" class="btn btn-danger btn-sm waves-effect delete-team" data-url="<?php echo base_url('about-us/delete-team/'.encode($t->id)) ?>"><i class="fe-trash"></i></button>

                <div class="row mt-4">
                    <div class="col-3">
                        <div class="mt-3">
                            <h4>Facebook</h4>
                            <a href="<?php echo $t->facebook ?>" target="_blank"><i class="fe-external-link"></i></a>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="mt-3">
                            <h4>Linkedin</h4>
                            <a href="<?php echo $t->linkedin ?>" target="_blank"><i class="fe-external-link"></i></a>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="mt-3">
                            <h4>Twitter</h4>
                            <a href="<?php echo $t->twitter ?>" target="_blank"><i class="fe-external-link"></i></a>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="mt-3">
                            <h4>Instagram</h4>
                            <a href="<?php echo $t->instagram ?>" target="_blank"><i class="fe-external-link"></i></a>
                        </div>
                    </div>
                </div> <!-- end row-->

            </div> <!-- end .padding -->
        </div> <!-- end card-box-->
    </div> <!-- end col -->
        <?php 
        endforeach;
    endif;
    ?>
</div>
<!-- end row -->