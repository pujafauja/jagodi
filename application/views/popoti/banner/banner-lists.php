
<div class="row">
	<?php foreach($banner->result() as $b): ?>
	<div class="col-lg-3">
	    <div class="card">
	        <img src="<?php echo base_url('media/banner/md/'.$b->gambar) ?>" alt="" class="w-100 img-fluid card-img-top">
	        <div class="card-body">
	            <p class="mb-0"><?php echo $b->desc ?></p>
	        </div>
	        <div class="card-body">
	        	<p class="mb-0"><mark>Position:</mark><em class="text-uppercase"><?php echo $b->position ?></em></p>
	        	<p class="mb-0"><mark>URL:</mark><a href="<?php echo $b->url ?>" target="_blank"><em><?php echo $b->url ?></em></a></p>
	        </div>
	        <div class="card-body border-top">
	        	<a href="<?php echo base_url('banner/edit-banner/'.encode($b->id)) ?>" class="card-link edit-banner">Edit</a>
	        	<a href="<?php echo base_url('banner/delete-banner/'.encode($b->id)) ?>" class="card-link delete-banner">Delete</a>
	        </div>
	    </div>
	</div>
	<?php endforeach; ?>
</div>