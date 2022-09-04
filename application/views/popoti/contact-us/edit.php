<div class="row">
    <div class="col-lg-8">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Contact Message</h4>
                        <p class="card-subtitle mb-3">English Version</p>
                        <!-- <div class="form-group">
                            <label for="" class="form-label">Title</label>
                            <input type="text" class="form-control" value="">
                        </div> -->
                        <div class="form-group">
                            <div class="summernote" id="contact-en"><?php echo $data->contactEN ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Contact Message</h4>
                        <p class="card-subtitle mb-3">Versi Indonesia</p>
                        <!-- <div class="form-group">
                            <label for="" class="form-label">Judul</label>
                            <input type="text" class="form-control" value="">
                        </div> -->
                        <div class="form-group">
                            <div class="summernote" id="contact-ina"><?php echo $data->contactINA ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <h4 class="header-title mb-3">Your Company Address</h4>
                    <input type="hidden" id="lat" value="<?php echo $data->lat ?>">
                    <input type="hidden" id="lon" value="<?php echo $data->lon ?>">

                    <div id="gmaps-basic" class="gmaps" data-lat="<?php echo $data->lat ?>" data-lon="<?php echo $data->lon ?>"></div>
                </div> <!-- end card-box-->
            </div> <!-- end col-->
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Contact Picture</h4>
                <form action="/" method="post" id="myAwesomeDropzone" enctype="multipart/form-data">
                    <input name="gambar" type="file" data-plugins="dropify" data-height="300" <?php echo ($data->gambar_contact) ? 'data-default-file="'.base_url('media/contact/'.$data->gambar_contact).'"' : '' ?> data-allowed-file-extensions="png jpg jpeg" data-max-file-size="3M" />
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <button class="btn btn-primary btn-block publish-contact"><i class="fe-upload-cloud mr-1"></i>Publish</button>
            </div>
        </div>
    </div>
</div>