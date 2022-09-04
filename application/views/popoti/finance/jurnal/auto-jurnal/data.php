<div class="card">
	<div class="card-body">
		<ul class="nav nav-tabs nav-bordered">
		    <li class="nav-item">
		        <a href="#sparepart" data-toggle="tab" aria-expanded="true" class="nav-link active">Sparepart</a>
		    </li>
		    <li class="nav-item">
		        <a href="#service" data-toggle="tab" aria-expanded="false" class="nav-link">Service</a>
		    </li>
		</ul>
	</div>
</div>

<div class="card">
	<div class="card-body">
		<div class="tab-content">
			
			<div class="tab-pane show active" id="sparepart">
				<table class="table table-striped table-sm">
					<thead>
						<tr>
							<th>Items</th>
							<th>Expenses</th>
							<th>Supplies</th>
							<th>HPP</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if($sparepartCat->num_rows()):
							foreach($sparepartCat->result() as $cat): 
								$expense = $this->global_model->_get('pp_auto_jurnal a', ['source' => 'expense-'.encode($cat->id)], [], [], 'CONCAT(\'[\', b.kode, \'] \', b.nama) coa', [['tb_coa b', 'a.coaid = b.id', 'left']]);
								$supply = $this->global_model->_get('pp_auto_jurnal a', ['source' => 'supply-'.encode($cat->id)], [], [], 'CONCAT(\'[\', b.kode, \'] \', b.nama) coa', [['tb_coa b', 'a.coaid = b.id', 'left']]);
								$hpp = $this->global_model->_get('pp_auto_jurnal a', ['source' => 'hpp-'.encode($cat->id)], [], [], 'CONCAT(\'[\', b.kode, \'] \', b.nama) coa', [['tb_coa b', 'a.coaid = b.id', 'left']]);
								?>
								<tr>
									<td><?php echo $cat->nama ?></td>
									<td>
										<div class="input-group input-group-sm">
											<input type="text" name="" class="form-control form-control-sm" disabled="" id="expense-<?php echo encode($cat->id); ?>" value="<?php echo ($expense->num_rows()) ? $expense->row()->coa : '' ?>">
											<div class="input-group-append">
												<a href="<?php echo base_url('finance/coa-popup') ?>" class="btn btn-primary popup-coa">
													<i class="fas fa-search"></i>
												</a>
											</div>
										</div>
									</td>
									<td>
										<div class="input-group input-group-sm">
											<input type="text" name="" class="form-control form-control-sm" disabled="" id="supply-<?php echo encode($cat->id); ?>" value="<?php echo ($supply->num_rows()) ? $supply->row()->coa : '' ?>">
											<div class="input-group-append">
												<a href="<?php echo base_url('finance/coa-popup') ?>" class="btn btn-primary popup-coa">
													<i class="fas fa-search"></i>
												</a>
											</div>
										</div>
									</td>
									<td>
										<div class="input-group input-group-sm">
											<input type="text" name="" class="form-control form-control-sm" disabled="" id="hpp-<?php echo encode($cat->id); ?>" value="<?php echo ($hpp->num_rows()) ? $hpp->row()->coa : '' ?>">
											<div class="input-group-append">
												<a href="<?php echo base_url('finance/coa-popup') ?>" class="btn btn-primary popup-coa">
													<i class="fas fa-search"></i>
												</a>
											</div>
										</div>
									</td>
								</tr>
							<?php endforeach;
						endif;
						?>
					</tbody>
				</table>
			</div>

			<div class="tab-pane" id="service">
				<table class="table table-striped table-sm">
					<thead>
						<tr>
							<th>Items</th>
							<th>Account</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<?php
							$wo = $this->global_model->_get('pp_auto_jurnal a', ['source' => 'wo'], [], [], 'CONCAT(\'[\', b.kode, \'] \', b.nama) coa', [['tb_coa b', 'a.coaid = b.id', 'left']]);
							?>
							<td>Work Order</td>
							<td>
								<div class="input-group input-group-sm">
									<input type="text" name="" class="form-control form-control-sm" disabled="" id="wo" value="<?php echo ($wo->num_rows()) ? $wo->row()->coa : '' ?>">
									<div class="input-group-append">
										<a href="<?php echo base_url('finance/coa-popup') ?>" class="btn btn-primary popup-coa"><i class="fas fa-search mr-1"></i></a>
									</div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

		</div>
	</div>
</div>