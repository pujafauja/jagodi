<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title"><?php echo $static->title ?></h5>

				<form action="<?php echo base_url('customer-care-service/save/'.encode($static->id)) ?>">
					<div id="summernote-editmode">
					    <?php echo $static->content ?>
					</div>
					<button id="summernote-edit" type="button" class="btn btn-primary btn-sm"><i class="mdi mdi-pencil mr-1"></i> Edit</button>
					<button id="summernote-save" type="button" class="btn btn-success btn-sm mt-2" style="display: none;"><i class="mdi mdi-content-save-outline mr-1"></i> Save Changes</button>
				</form>
			</div>
		</div>
	</div>
</div>