<div class="row">
    <div class="col-md-10" id="add-services">
        <div class="card">
            <div class="card-body">
                <form id="contextual" method="post" class="col-12">
                    <input type="hidden" value="<?php echo encode($data->id) ?>" name="id" />
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="card-title">English Version</h4>
                            <div class="mb-3">
                                <label for="" class="form-label">Title</label>
                                <input type="text" name="title-en" class="form-control" value="<?php echo $data->titleEN ?>">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Short Description</label>
                                <textarea name="desc-en" class="form-control"><?php echo $data->descEN ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Content</label>
                                <div class="summernote" id="content-en"><?php echo $data->contentEN ?></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4 class="card-title">Versi Indonesia</h4>
                            <div class="mb-3">
                                <label for="" class="form-label">Judul</label>
                                <input type="text" name="title-ina" class="form-control" value="<?php echo $data->titleINA ?>">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Short Description</label>
                                <textarea name="desc-ina" class="form-control"><?php echo $data->descINA ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Content</label>
                                <div class="summernote" id="content-ina"><?php echo $data->contentINA ?></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="/" method="post" id="myAwesomeDropzone" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Service Picture</label>
                                <input name="gambar" type="file" data-plugins="dropify" data-height="150" <?php echo ($data->gambar) ? 'data-default-file="'.base_url('media/service/'.$data->gambar).'"' : '' ?> data-allowed-file-extensions="png jpg jpeg" data-max-file-size="3M" />
                            </div>
                            <div class="form-group">
                                <label for="">Service Icon</label>
                                <input name="icon" type="file" data-plugins="dropify" data-height="150" <?php echo ($data->icon) ? 'data-default-file="'.base_url('media/service/'.$data->icon).'"' : '' ?> data-allowed-file-extensions="png" data-max-file-size="3M" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <button class="btn btn-block btn-primary publish-services"><i class="fe-upload-cloud mr-1"></i>Publish</button>
                <a href="<?php echo base_url('services') ?>" class="btn btn-block btn-danger"><i class="fe-x mr-1"></i>Cancel</a>
            </div>
        </div>
    </div>
</div>