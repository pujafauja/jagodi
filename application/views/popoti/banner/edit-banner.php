<form action="<?php echo site_url('banner/save-banner/'.encode($banner->id)) ?>" method="post" class="edit-banner" enctype="multipart/form-data">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Edit Banner</h4>

					<div class="row">
						<div class="col-md-6">
							<form action="/" method="post" id="myAwesomeDropzone" enctype="multipart/form-data">
							    <input name="gambar" type="file" data-plugins="dropify" data-height="250" data-allowed-file-extensions="png jpg jpeg" data-max-file-size="3M" <?php echo ($banner->gambar) ? 'data-default-file="'.base_url('media/banner/md/'.$banner->gambar).'"' : '' ?> />
							</form>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="">Description <span class="text-danger">*</span></label>
								<textarea name="desc" id="" cols="30" rows="2" class="form-control"><?php echo $banner->desc ?></textarea>
							</div>
							<div class="form-group">
								<label for="">Position <span class="text-danger">*</span></label>
								<select name="position" id="" class="form-control">
									<option value="">-- Select Position --</option>
									<option value="top" <?php echo $banner->position == 'top' ? 'selected=""' : '' ?>>TOP</option>
									<option value="center" <?php echo $banner->position == 'center' ? 'selected=""' : '' ?>>CENTER</option>
								</select>
							</div>
							<div class="form-group">
								<label for="">URL <span class="text-danger">*</span></label>
								<input type="text" name="url" class="form-control" value="<?php echo $banner->url ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 text-center">
							<button type="submit" class="btn btn-primary simpan-banner">Save</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>