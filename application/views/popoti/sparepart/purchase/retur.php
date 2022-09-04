<div class="row">
	<div class="col-lg-12">
		<form action="<?php base_url('stock/retur/'.encode($row->id)) ?>" method="post" id="receive">
			<div class="card">
				<div class="card-body">
					<div class="card-widgets">
                        <button type="submit" class="btn btn-sm btn-primary mr-3" id="submit-retur">
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
	                    			<table class="table table-bordered table-sm po-detail" id="">
	                    				<thead>
	                    					<tr>
	                    						<th>
	                    							No
	                    						</th>
	                    						<th colspan="2">Parts</th>
	                    						<th>ABC</th>
	                    						<th>Location</th>
	                    						<th>Receipt QTY</th>
	                    						<th>Retur Qty</th>
	                    						<th>Remainder</th>
	                    					</tr>
	                    				</thead>
	                    				<tbody>
	                    					<?php if (is_array($row->detail)): ?>
	                    						<?php if (count($row->detail)): ?>
	                    							<?php $no=1;foreach ($row->detail as $key => $value): ?>
	                    								<tr>
								                            <td>
								                                <?php echo 	$no++; ?>
								                            </td>
								                            <td><?php echo $value->kode ?></td>
								                            <td><?php echo $value->nama ?></td>
								                            <td><?php echo $value->detail->abc ?></td>
								                            <td>
	                            	                            <select name="locationid[<?php echo $value->orderid ?>][<?php echo $value->sparepartid ?>]" data-loaded="0" class="form-control form-control-sm">
	                            	                            	<?php foreach ($row->location as $key => $v): ?>
	                            	                            		<?php if ($v->id == $value->locationid): ?>
	                            		                            		<option value="<?php echo $v->id ?>" selected><?php echo $v->nama ?></option>
	                            	                            		<?php endif ?>
	                            	                            	<?php endforeach ?>
	                            	                            </select>
								                            	<input type="hidden" name="poid[<?php echo $value->orderid ?>][]" value="<?php echo $value->sparepartid ?>">
								                            </td>
								                            <td>
								                            	<input type="text" readonly="" name="receive-qty[<?php echo $value->orderid ?>][<?php echo $value->sparepartid ?>]" class="form-control form-control-sm" value="<?php echo $value->qty ?>" id="receive-qty">
								                            </td>
								                            <td>		
								                            	<div class="input-group">
									                                <input type="text" readonly="" name="retur-qty[<?php echo $value->orderid ?>][<?php echo $value->sparepartid ?>]" class="form-control form-control-sm" value="0" id="retur-qty">
																	<div class="input-group-append">
																		<button class="btn btn-sm btn-danger" data-qty="<?php echo $value->qty ?>" id="minus-qty"><i class="fa fa-minus"></i></button>
																		<button class="btn btn-sm btn-success" data-qty="<?php echo $value->qty ?>" id="plus-qty"><i class="fa fa-plus"></i></button>
																	</div>								                            		
								                            	</div>
								                            </td>
								                            <td>
								                            	<input type="text" readonly="" name="remainder[<?php echo $value->orderid ?>][<?php echo $value->sparepartid ?>]" class="form-control form-control-sm" value="<?php echo $value->qty ?>" id="remainder">
								                            </td>

								                        </tr>
	                    							<?php endforeach ?>
	                    						<?php endif ?>
	                    					<?php endif ?>
	                    				</tbody>
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