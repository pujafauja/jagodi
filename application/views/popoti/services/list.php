<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-12">
                        <div class="text-md-end mt-3 mt-md-0">
                            <a href="<?php echo base_url('services/new') ?>" class="btn btn-danger waves-effect waves-light me-1"><i class="mdi mdi-plus-circle me-1"></i> Add New</a>
                        </div>
                    </div><!-- end col-->
                </div> <!-- end row -->
            </div>
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row -->        

<div class="row">
    <?php
    if($data->num_rows() > 0):
        foreach($data->result() as $b): ?>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $b->titleEN?></h5>
                        <h6 class="card-subtitle"><?php echo $b->descEN ?></h6>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $b->titleINA ?></h5>
                        <h6 class="card-subtitle"><?php echo $b->descINA ?></h6>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <img class="img-fluid" src="<?php echo base_url('media/service/'.$b->gambar) ?>" alt="Card image cap">
                        </div>
                        <div class="col-6">
                            <img class="img-fluid" src="<?php echo base_url('media/service/'.$b->icon) ?>" alt="Card image cap">
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <div class="btn-group">
                            <a href="<?php echo base_url('services/edit/'.encode($b->id)) ?>" class="btn btn-primary"><i class="fe-edit"></i></a>
                            <a href="<?php echo base_url('services/delete/'.encode($b->id)) ?>" class="btn btn-danger"><i class="fe-trash"></i></a>
                        </div>
                    </div>
                </div> <!-- end card -->
            </div><!-- end col -->
        <?php endforeach;
    endif;
    ?>
</div>
<!-- end row -->
<!-- end row -->