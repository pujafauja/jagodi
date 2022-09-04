<div class="row">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Your Company History</h4>
                <p class="card-subtitle mb-3">English Version</p>
                <!-- <div class="form-group">
                    <label for="" class="form-label">Title</label>
                    <input type="text" class="form-control" value="">
                </div> -->
                <div class="form-group">
                    <div class="summernote" id="history-en"><?php echo $data->historyEN ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Your Company History</h4>
                <p class="card-subtitle mb-3">Versi Indonesia</p>
                <!-- <div class="form-group">
                    <label for="" class="form-label">Judul</label>
                    <input type="text" class="form-control" value="">
                </div> -->
                <div class="form-group">
                    <div class="summernote" id="history-ina"><?php echo $data->historyINA ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="card">
            <div class="card-body">
                <button class="btn btn-primary btn-block publish-history"><i class="fe-upload-cloud mr-1"></i>Publish</button>
            </div>
        </div>
    </div>
</div>