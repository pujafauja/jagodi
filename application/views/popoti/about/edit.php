<div class="row">
    <div class="col-lg-10">
        <div class="card-group">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">English Version</h4>
                    <!-- <div class="form-group">
                        <label for="" class="form-label">Title</label>
                        <input type="text" class="form-control" value="">
                    </div> -->
                    <div class="form-group">
                        <label for="">Short Description</label>
                        <div class="summernote" id="short-about-en"><?php echo $data->shortAboutEN ?></div>
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <div class="summernote" id="about-en"><?php echo $data->aboutEN ?></div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Versi Indonesia</h4>
                    <!-- <div class="form-group">
                        <label for="" class="form-label">Judul</label>
                        <input type="text" class="form-control" value="">
                    </div> -->
                    <div class="form-group">
                        <label for="">Short Description</label>
                        <div class="summernote" id="short-about-ina"><?php echo $data->shortAboutINA ?></div>
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <div class="summernote" id="about-ina"><?php echo $data->aboutINA ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">About picture</h4>
                <form action="/" method="post" id="myAwesomeDropzone" enctype="multipart/form-data">
                    <input name="gambar" type="file" data-plugins="dropify" data-height="150" <?php echo ($data->gambar) ? 'data-default-file="'.base_url('media/about/'.$data->gambar).'"' : '' ?> data-allowed-file-extensions="png jpg jpeg" data-max-file-size="3M" />
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <button class="btn btn-primary btn-block publish-about"><i class="fe-upload-cloud mr-1"></i>Publish</button>
            </div>
        </div>
    </div>
</div>