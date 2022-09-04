<form action="<?php echo base_url('service/import') ?>" id="Import" class="form-inline" method="post" enctype="multipart/form-data">

	<div class="input-group">

		<label class="input-group-btn">

			<span class="btn btn-secondary waves-effect waves-light">

				Browse

				<input type="file" name="file" id="media" class="d-none">

			</span>

		</label>

		<input type="text" id="filename" class="form-control" readonly="">

	</div>

	<div class="btn-group">

		<button id="init-import" class="btn btn-primary" disabled=""><i class="mdi mdi-progress-download mr-1"></i> Import</button>

		<a href="<?php echo base_url() ?>" target="_blank" class="btn btn-primary" disabled=""><i class="mdi mdi-file-download mr-1"></i> Download Template</a>

		<button class="btn btn-danger waves-effect waves-light" type="button" id="reset"><i class="mdi mdi-cancel mr-1"></i></button>

	</div>

	<div class="form-group">

		<div class="col-md-12">

			<em class="text-muted">Please download template and follow the instructions. Upload file <strong>.xlsx</strong> only</em>

		</div>

	</div>

</form>

<div class="row mt-3">

	<div class="col-md-12">

		<div class="progress mb-0 d-none">

	        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</div>

	    </div>		

	</div>

</div>

<div class="row mt-3">

	<div class="col-md-12">

		<div id="responseImport"></div>
		<div id="response"></div>

	</div>

</div>