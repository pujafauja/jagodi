<div class="row">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Your Vision & Mission</h4>
                <p class="card-subtitle mb-3">English Version</p>
                <!-- <div class="form-group">
                    <label for="" class="form-label">Title</label>
                    <input type="text" class="form-control" value="">
                </div> -->
                <div class="form-group">
                    <div class="summernote" id="visimisi-en"><?php echo $data->visimisiEN ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Your Vision & Mission</h4>
                <p class="card-subtitle mb-3">Versi Indonesia</p>
                <!-- <div class="form-group">
                    <label for="" class="form-label">Judul</label>
                    <input type="text" class="form-control" value="">
                </div> -->
                <div class="form-group">
                    <div class="summernote" id="visimisi-ina"><?php echo $data->visimisiINA ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="card">
            <div class="card-body">
                <button class="btn btn-primary btn-block publish-visimisi"><i class="fe-upload-cloud mr-1"></i>Publish</button>
            </div>
        </div>
    </div>
</div>