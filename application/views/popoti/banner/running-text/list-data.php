<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-box">
				<h4 class="card-title">Add New Running Text</h4>
				<p class="sub-header">Create running text as attractive as possible to attract buyers</p>

				<form action="<?php echo base_url('banner/save-running-text') ?>" id="running-text-form" method="post">
					<div class="form-group">
						<label for="">Running text</label>
						<div class="input-group">
							<input type="text" class="form-control" name="words">
							<div class="input-group-append">
								<button type="submit" class="btn btn-primary save-running-text"><i class="fe-save mr-1"></i>Save</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div id="running-text-lists"></div>