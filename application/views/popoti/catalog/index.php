<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-3">						
						<a href="<?php echo base_url('catalog/new-catalog') ?>" type="button" id="new-catalog" class="btn btn-primary mb-5"><i class="fa fa-plus-square mr-2"></i>Add New</a>
					</div>
					<div class="col-md-3 offset-md-6">
						Search : 
						<form method="get" action="">
							<div class="input-group">
								<input type="text" name="search" value="<?php echo (isset($_GET['search'])) ? $_GET['search'] : '' ?>" class="form-control" id="search">
								<div class="input-group-append">
									<button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
								</div>							
							</div>
						</form>
					</div>
				</div>
				<div class="row">

					<?php foreach ($rows as $key => $value): ?>
						
						<div class="col-3">
							<div class="card">
								<img class="card-img-top" src="<?php echo base_url('upload/files/'.json_decode($value->detail_picture, true)[0]['foto-1']) ?>" alt="Card image cap">
								<div class="card-body">
									<h4 class="card-title">
										<div class="justify-content-between">
											<a href="<?php echo base_url('catalog/detail/'.encode($value->id)) ?>"><?php echo $value->nama ?></a>
											<i class="fa fa-times text-danger delete-catalog" data-id="<?php echo encode($value->id) ?>" style="cursor: pointer;"></i>
										</div>
									</h4>
								</div>
							</div>
						</div>

					<?php endforeach ?>

				</div>

				<div class="row">
					<div class="col text-center">
						<?php if ($pagination): ?>
							<?php echo $pagination ?>
						<?php endif ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>