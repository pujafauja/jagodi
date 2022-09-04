<div class="row">
	<div class="col-lg-12">
		<form action="<?php base_url('purchase/recommended/'.encode($purchase->id)) ?>" method="post" id="recommended-order">
			<div class="card">
				<div class="card-body">
					<div class="card-widgets">
                        <a data-toggle="collapse" href="#header" role="button" aria-expanded="false" aria-controls="header"><i class="mdi mdi-minus"></i></a>
					</div>
					<a data-toggle="collapse" href="#header" role="button" aria-expanded="false" aria-controls="header">
					    <h5 class="card-title mb-0">
					        <i class="mdi mdi-card-bulleted-settings mr-1"></i>
					        <span class="d-none d-sm-inline">Header</span>
					    </h5>
					</a>
                    <div id="header" class="collapse pt-3 show">
                    	<div class="row">
                    		<div class="col-md-6">
                    			<div class="form-group row">
                    				<label for="" class="col-md-3">Purchase No. <span class="text-danger">*</span></label>
                    				<div class="col-md-9">
                						<input type="text" readonly name="no" value="<?php echo ($purchase->no) ? $purchase->no : getNoFormat('PO') ?>" class="form-control">
                    				</div>
                    			</div>
                    			<div class="form-group row">
                    				<label for="" class="col-md-3">Supplier <span class="text-danger">*</span></label>
                    				<div class="col-md-9">
                    					<div class="input-group">
                    						<div class="input-group-prepend">
                    							<a href="<?php echo base_url('sparepart/supplier-popup') ?>" class="btn btn-primary popup-supplier"><i class="fas fa-search"></i></a>
                    						</div>
                    						<input type="text" name="supplier" value="<?php echo $purchase->supplier ?>" class="form-control cari-supplier">
	                    					<input type="hidden" name="supplierid" value="<?php echo $purchase->supplierid ?>" class="form-control">
	                    				</div>
                    				</div>
                    			</div>
                    			<div class="form-group row">
                    				<label for="" class="col-md-3">Delivery Plan Date <span class="text-danger">*</span></label>
                    				<div class="col-md-9">
                    					<div class="input-group">
                    						<input type="text" name="date-plan" value="<?php echo $purchase->delivery_plan ?>" class="form-control basic-datepicker">
                    						<div class="input-group-append">
                    							<span class="input-group-text"><i class="fas fa-calendar"></i></span>
                    						</div>
                    					</div>
                    				</div>
                    			</div>                    			
                    		</div>
                    		<div class="col-md-6">
                    			<div class="form-group row">
                    				<label for="" class="col-md-3">ABC Category</label>
                    				<div class="col-md-9">
                    					<div class="input-group">
	                    					<select name="abcid" id="" class="form-control">
	                    						<option value=""></option>
	                    						<?php
	                    						if($abc->num_rows() > 0):
	                    							foreach($abc->result() as $abc_cat): ?>
	                    								<?php if ($purchase->abcid): ?>
	                    									<?php if ($purchase->abcid == $abc_cat->id): ?>
				                    								<option value="<?php echo $abc_cat->id ?>" selected ><?php echo $abc_cat->code ?></option>
			                    								<?php else: ?>
				                    								<option value="<?php echo $abc_cat->id ?>" ><?php echo $abc_cat->code ?></option>
	                    									<?php endif ?>
	                    									<?php else: ?>
			                    								<option value="<?php echo $abc_cat->id ?>" ><?php echo $abc_cat->code ?></option>
	                    								<?php endif ?>
	                    							<?php endforeach;
	                    						endif;
	                    						?>
	                    					</select>
	                    					<div class="input-group-append">
	                    						<a href="javascript:void(0)" class="btn btn-primary retrieve-data">
	                    							<i class="fas fa-search mr-1"></i>
	                    							Retrieve
	                    						</a>
	                    					</div>
	                    				</div>
                    				</div>
                    			</div>
                    			<div class="form-group row">
                    				<label for="" class="col-md-3">Memo</label>
                    				<div class="col-md-9">
                    					<input type="text" name="memo" value="<?php echo $purchase->memo ?>" class="form-control">
                    				</div>
                    			</div>
                    		</div>
                    	</div>
                    </div>
				</div>
			</div>

			<div class="card">
				<div class="card-body">
					<div class="card-widgets">
                        <button type="submit" class="btn btn-sm btn-primary mr-3" disabled="" data-back="<?php echo base_url('purchase/recommended') ?>">
                        	<i class="mdi mdi-check mr-1"></i>
                        	Confirm
                        </button>
                        <a data-toggle="collapse" href="#detail" role="button" aria-expanded="false" aria-controls="detail"><i class="mdi mdi-minus"></i></a>
					</div>
					<a data-toggle="collapse" href="#detail" role="button" aria-expanded="false" aria-controls="detail">
					    <h5 class="card-title mb-0">
					        <i class="mdi mdi-clipboard-list mr-1"></i>
					        <span class="d-none d-sm-inline">Detail</span>
					    </h5>
					</a>
                    <div id="detail" class="collapse pt-4 show">
                    	<div class="row">
                    		<div class="col-lg-12">
                    			<div class="table-responsive">
	                    			<table class="table table-bordered table-sm po-detail" id="inline-editable">
	                    				<thead>
	                    					<tr>
	                    						<th>
	                    							<div class="checkbox checkbox-single checkbox-primary">
		                    							<input type="checkbox" name="" class="check-all" aria-label="Single checkbox One">
		                    							<label for=""></label>
		                    						</div>
	                    						</th>
	                    						<th colspan="2">Parts</th>
	                    						<th>Price</th>
	                    						<th>ABC</th>
	                    						<th>Average Demand</th>
	                    						<th>Future Stock</th>
	                    						<th>ROQ</th>
	                    						<th>Regular QTY</th>
	                    						<th>Subtotal</th>
	                    					</tr>
	                    				</thead>
	                    				<tbody>
	                    					<?php $grand = 0; if (count($purchase->detail)): 
	                    							foreach ($purchase->detail as $key => $value):
	                    								if($value->total <= $value->lower):
								    						$average = $value->average;
								    						$total   = $value->total;
								    						$total   = intval($total);
								    						$roq   = $value->roq;
								    						$roq   = floatval($roq);

								    						if($value->average == null)
								    							$average = 0;

															$average = intval($average);

															$future = $total + $average;
															$ROQ = $roq * $average;
															$ROQ = intval($ROQ);
	                    						?>
		                    						<tr>
			                    						<td>
						    								<div class="checkbox checkbox-single checkbox-primary">
						            							<input type="checkbox" name="sparepartid[]" value="<?php echo $value->id ?>" class="" aria-label="Single checkbox One">
						            							<label></label>
						            						</div>
						    							</td>
						    							<td><?php echo $value->kode ?></td>
						    							<td><?php echo $value->nama ?></td>
						    							<td>Rp. <span class="autonumber" data-a-sep="." data-a-dec="," data-m-dec="0"><?php echo $value->price ?></span><input type="hidden" name="price[]" value="<?php echo $value->price ?>"></td>
						    							<td><?php echo $value->abc_code ?></td>
						    							<td><?php echo $average ?></td>
						    							<td><?php echo $future ?></td>
						    							<td><?php echo $ROQ ?></td>
						    							<td><?php echo $value->qty ?></td>
						    							<td>
						    								Rp. <span data-a-sep="." data-a-dec="," data-m-dec="0" class="subtotal autonumber"><?php echo $hasil = $value->qty * intval($value->price); $grand += $hasil; ?></td>
						    								</span>
					    							</tr>
	                    					<?php 
	                    					endif;
	                    						endforeach;
	                    							endif; ?>
	                    				</tbody>
	                    				<tfoot>
	                    					<tr>
	                    						<td colspan="9" class="text-right"><h4>Grandtotal:</h4></td>
	                    						<td><h4 class="autonumber po-grandtotal" data-a-sep="." data-a-dec="," data-m-dec="0" data-a-sign="Rp "><?php echo $grand ?></h4></td>
	                    					</tr>
	                    				</tfoot>
	                    			</table>
	                    		</div>
                    		</div>
                    	</div>
                    </div>
				</div>
			</div>
		</form>
	</div>
</div>