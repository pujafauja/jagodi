<div class="row">
    <!-- Right Sidebar -->
    <div class="col-12">
        <div class="card-box">
            <!-- Left sidebar -->
            <div class="inbox-leftbar">

                <a href="<?php echo base_url('articles/post-article') ?>" class="btn btn-danger btn-block waves-effect waves-light">Post New Article</a>

                <h6 class="mt-4">Categories</h6>

                <div class="list-group b-0 mail-list">
                    <?php if($categories->num_rows() > 0): 
                        foreach($categories->result() as $cat): ?>
                    <a href="<?php echo base_url('articles/article-list/index/1/'.$cat->id) ?>" class="list-group-item border-0"><span class="mdi mdi-circle text-info mr-2"></span><?php echo $cat->name ?></a>
                    <?php endforeach; endif; ?>
                </div>

            </div>
            <!-- End Left sidebar -->

            <div class="inbox-rightbar">

            </div> 
            <!-- end inbox-rightbar-->

            <div class="clearfix"></div>
        </div> <!-- end card-box -->

    </div> <!-- end Col -->
</div><!-- End row -->