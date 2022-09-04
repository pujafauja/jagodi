<form action="<?php echo site_url('banner/save-banner') ?>" method="post" class="new-banner" enctype="multipart/form-data">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="card-widgets">
						<a data-toggle="collapse" href="#cardCollpase1" role="button" aria-expanded="true" aria-controls="cardCollpase1"><i class="mdi mdi-plus"></i></a>
					</div>
					<h4 class="card-title">Add New Banner</h4>

					<div id="cardCollpase1" class="collapse">
						<div class="row">
							<div class="col-md-6">
								<form action="/" method="post" id="myAwesomeDropzone" enctype="multipart/form-data">
								    <input name="gambar" type="file" data-plugins="dropify" data-height="250" data-allowed-file-extensions="png jpg jpeg" data-max-file-size="3M" />
								</form>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="">Description <span class="text-danger">*</span></label>
									<textarea name="desc" id="" cols="30" rows="2" class="form-control"></textarea>
								</div>
								<div class="form-group">
									<label for="">Position <span class="text-danger">*</span></label>
									<select name="position" id="" class="form-control">
										<option value="">-- Select Position --</option>
										<option value="top">TOP</option>
										<option value="center">CENTER</option>
									</select>
								</div>
								<div class="form-group">
									<label for="">URL <span class="text-danger">*</span></label>
									<input type="text" name="url" class="form-control">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12 text-center">
								<button type="submit" class="btn btn-primary save-banner">Save</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

<div id="banner-lists"></div>