<div class="row">
	<?php if($words->num_rows() > 0): foreach($words->result() as $word): ?>
	<div class="col-md-3">
		<div class="card">
			<div class="card-body">
				<p><?php echo $word->words ?></p>
				<a href="<?php echo base_url('banner/edit-running-text/'.encode($word->id)) ?>" class="card-link text-custom edit-running-text">Edit</a>
				<a href="<?php echo base_url('banner/delete-running-text/'.encode($word->id)) ?>" class="card-link text-custom delete-running-text">Delete</a>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
	<?php else: ?>
	<div class="col-12">
		<div class="alert alert-warning" role="alert">
	        <i class="mdi mdi-alert-outline mr-2"></i> Data is Empty!
	    </div>
    </div>
	<?php endif; ?>
</div>