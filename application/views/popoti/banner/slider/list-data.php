<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Website Slider</h4>
				<p class="sub-header">Add and delete images for your website</p>

				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                    	<?php $n = 0; foreach($slider->result() as $slide): ?>
                        <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $n ?>" class="<?php echo $n == 0 ? 'active' : '' ?>"></li>
	                    <?php $n++; endforeach; ?>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                    	<?php $n = 0; foreach($slider->result() as $slide): ?>
                        <div class="carousel-item <?php echo $n == 0 ? 'active' : '' ?>">
                        	<div class="product-action" style="position: absolute; top: 0; right: 0; z-index: 2;">
                        	    <a href="<?php echo base_url('banner/delete-slider/'.encode($slide->id)) ?>" class="btn btn-lg btn-danger btn-xs waves-effect waves-light delete-slider"><i class="mdi mdi-close"></i></a>
                        	</div>
                            <img class="d-block img-fluid w-100" src="<?php echo base_url('media/sliders/md/'.$slide->gambar) ?>" alt="">
                        </div>
	                    <?php $n++; endforeach; ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Add New Slides</h4>
				<p class="sub-header">Drop your images in this box for add new slide</p>

				<form action="<?php echo base_url('banner/save-slider') ?>" method="post" class="dropzone" id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews" data-upload-preview-template="#uploadPreviewTemplate">
                    <div class="fallback">
                        <input name="file[]" type="file" multiple />
                    </div>

                    <div class="dz-message needsclick">
                        <i class="h1 text-muted dripicons-cloud-upload"></i>
                        <h3>Drop files here or click to upload.</h3>
                        <!-- <span class="text-muted font-13">(This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)</span> -->
                    </div>
                </form>

                <!-- Preview -->
                <div class="dropzone-previews mt-3" id="file-previews"></div>

    			<!-- file preview template -->
                <div class="d-none" id="uploadPreviewTemplate">
                    <div class="card mt-1 mb-0 shadow-none border">
                        <div class="p-2">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <img data-dz-thumbnail src="#" class="avatar-sm rounded bg-light" alt="">
                                </div>
                                <div class="col pl-0">
                                    <a href="javascript:void(0);" class="text-muted font-weight-bold" data-dz-name></a>
                                    <p class="mb-0" data-dz-size></p>
                                </div>
                                <div class="col-auto">
                                    <!-- Button -->
                                    <a href="" class="btn btn-link btn-lg text-muted" data-dz-remove>
                                        <i class="dripicons-cross"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>