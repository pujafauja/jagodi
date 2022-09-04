<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<table class="table text-center dt-responsive nowrap w-100">
					<thead>
						<tr>
							<th style="vertical-align: middle;" rowspan="2">Date</th>
							<th style="vertical-align: middle;" rowspan="2">Location</th>
							<th style="vertical-align: middle;" rowspan="2">Current Stock</th>
							<th style="vertical-align: middle;" rowspan="2">Actual Stock</th>
							<th class="text-center" colspan="2">Lost Stock</th>
							<th style="vertical-align: middle;" rowspan="2">Action</th>
						</tr>
						<tr>
							<th>Total Qty</th>
							<th>Total Amount</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($this->stock_model->getgapnow() as $key => $value): ?>
							<tr>
								<td><?php echo tgl($value->tanggal, 0) ?></td>
								<td><?php echo $value->location ?></td>
								<td><?php echo $value->currentQty ?></td>
								<td><?php echo $value->newQty ?></td>
								<td><?php echo $value->margin ?></td>
								<td><?php echo rupiah($value->total) ?></td>
								<td>
									<a href="<?php echo base_url() ?>stock/bayar-gap/<?php echo encode($value->locationid) ?>" data-location="<?php echo encode($value->locationid) ?>" data-bil="<?php echo $value->total ?>" class="btn btn-success" id="bayar-gap"><i class="fa fa-money mr-2"></i>Charge</a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>