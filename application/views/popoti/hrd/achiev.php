<div class="row">
	<div class="col">
		<div class="card-box">
			<div class="card-body">
				<div class="d-inline mb-2">
					<a href="<?php echo site_url() ?>hrd/add_achiev" id="TambahAc" class="btn btn-primary waves-effect waves-light ml-3"><i class="mdi mdi-plus-circle mr-1"></i> Add Achievment</a>
				</div>
				<p></p>
				<table class="table">
					<thead>
						<tr>
							<th>Achievment</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($achiev as $key => $value): ?>
							<tr>
								<td><?php echo $value['nominal'] ?>%</td>
								<td>
									<div class="btn-group">
										<a href="<?php echo base_url() ?>hrd/add_achiev/<?php echo $value['id'] ?>" id="EditAc" class="btn btn-info waves-effect waves-light"><i class="fas fa-pen-square mr-1"></i>Edit</a>
										<a href="<?php echo base_url() ?>hrd/delete_achiev/<?php echo $value['id'] ?>" id="DeleteAc" class="btn btn-danger waves-effect waves-light"><i class="fas fa-trash-alt mr-1"></i>Delete</a>
									</div>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>