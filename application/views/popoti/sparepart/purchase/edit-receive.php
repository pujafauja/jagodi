<div class="row">
	<div class="col-lg-12">
		<form action="<?php base_url('stock/receive/'.encode($row->id)) ?>" method="post" id="receive">
			<div class="card">
				<div class="card-body">
					<div class="card-widgets">
                        <button type="button" class="btn btn-sm btn-primary mr-3 retrieve-data">
                        	<i class="fas fa-search mr-1"></i>
                        	Retrieve
                        </button>
                        <a data-toggle="collapse" href="#header" role="button" aria-expanded="false" aria-controls="header"><i class="mdi mdi-minus"></i></a>
					</div>
					<a data-toggle="collapse" href="#header" role="button" aria-expanded="false" aria-controls="header">
					    <h5 class="card-title mb-0">
					        <i class="mdi mdi-card-bulleted-settings mr-1"></i>
					        <span class="d-none d-sm-inline">Header</span>
					    </h5>
					</a>
                    <div id="header" class="collapse pt-4 show">
                    	<div class="row">
                    		<div class="col-md-6">
                    			<div class="form-group row">
                    				<label for="" class="col-md-3">Receipt No. <span class="text-danger">*</span></label>
                    				<div class="col-md-9">
                    					<input type="text" name="no" value="<?php echo $row->no ?>" class="form-control">
                    				</div>
                    			</div>
                    			<div class="form-group row">
                    				<label for="" class="col-md-3">Receipt Date. <span class="text-danger">*</span></label>
                    				<div class="col-md-9">
                    					<div class="input-group">
	                    					<input type="text" name="tanggal" value="<?php echo $row->tanggal ?>" class="form-control basic-datepicker">
	                    					<div class="input-group-append">
	                    						<span class="input-group-text"><i class="fas fa-calendar"></i></span>
	                    					</div>
	                    				</div>
                    				</div>
                    			</div>
                    		</div>
                    		<div class="col-md-6">
                    			<div class="form-group row">
                    				<label for="" class="col-md-3">Purchase Order No.</label>
                    				<div class="col-md-9">
            							<a href="<?php echo base_url('purchase/popup-po?direct-retrieve=1') ?>" class="btn btn-sm btn-primary popup-po"><i class="fas fa-search mr-1"></i>Find & Retrieve</a>
                    				</div>
                    			</div>
                    			<div class="form-group row">
                    				<label for="" class="col-md-3">Due Date</label>
                    				<div class="col-md-9">
                    					<div class="input-group">
                    						<input type="text" value="<?php echo $row->due_date ?>" name="due_date" class="form-control basic-datepicker end-purchase-date">
                    					</div>
                    				</div>
                    			</div>
                    			<div class="form-group row">
                    				<label for="" class="col-md-3">Supllier</label>
                    				<div class="col-md-9">
                    					<div class="input-group">
                    						<input type="text" name="supplier" value="<?php echo sql_get_var('tb_supplier', 'nama', ['id' => $row->detail[0]->detail->supplierid]) ?>" class="form-control cari-supplier" disabled="">
	                    					<input type="hidden" name="supplierid" value="<?php echo $row->detail[0]->detail->supplierid ?>" readonly class="form-control">
	                    				</div>
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
                        <button type="submit" class="btn btn-sm btn-primary mr-3" disabled="">
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
	                    							<div class="checkbox checkbox-single checkbox-primary">
		                    							<input type="checkbox" name="" class="check-all" aria-label="Single checkbox One">
		                    							<label for=""></label>
		                    						</div>
	                    						</th>
	                    						<th colspan="2">Parts</th>
	                    						<th>ABC</th>
	                    						<th>Purchase Order No.</th>
	                    						<th>Order Date</th>
	                    						<th>Order QTY</th>
	                    						<th>Receipt QTY</th>
	                    						<th>Receipt Price</th>
	                    						<th>Register Location</th>
	                    						<th>Subtotal</th>
	                    					</tr>
	                    				</thead>
	                    				<tbody>
	                    					<?php if (is_array($row->detail)): ?>
	                    						<?php if (count($row->detail)): ?>
	                    							<?php $grandtotal = 0; foreach ($row->detail as $key => $value): ?>
	                    								<tr>
								                            <td>
								                                <div class="checkbox checkbox-single checkbox-primary">
								                                    <input type="checkbox" name="sparepartid[<?php echo $value->orderid ?>][<?php echo $value->sparepartid ?>]" value="<?php echo $value->sparepartid ?>" class="" aria-label="Single checkbox One">
								                                    <label></label>
								                                </div>
								                            </td>
								                            <td><?php echo $value->kode ?></td>
								                            <td><?php echo $value->nama ?></td>
								                            <td><?php echo $value->detail->abc ?></td>
								                            <td><?php echo $value->detail->no ?> <input type="hidden" name="poid[<?php echo $value->orderid ?>][]" value="<?php echo $value->sparepartid ?>"></td>
								                            <td><?php echo date('d-m-Y', strtotime($value->detail->order_date)) ?> </td>
								                            <td><?php echo $value->detail->detail->qty ?></td>
								                            <td>		
								                                <input type="text" name="qty[<?php echo $value->orderid ?>][<?php echo $value->sparepartid ?>]" class="form-control form-control-sm" value="<?php echo $value->qty ?>">
								                            </td>
								                            <td>
								                                <div class="input-group input-group-sm">
								                                    <div class="input-group-prepend">
								                                        <span class="input-group-text">Rp</span>
								                                    </div>
								                                    <input type="text" name="price[<?php echo $value->orderid ?>][<?php echo $value->sparepartid ?>]" class="form-control form-control-sm autonumber" data-a-sep="." data-a-dec="," data-m-dec="2" value="<?php echo $value->price ?>">
								                                </div>
								                            </td>
								                            <td>
								                            <select name="locationid[<?php echo $value->orderid ?>][<?php echo $value->sparepartid ?>]" data-loaded="0" class="form-control form-control-sm">
								                            	<option value=""></option>
								                            	<?php foreach ($row->location as $key => $v): ?>
								                            		<?php if ($v->id == $value->locationid): ?>
									                            		<option value="<?php echo $v->id ?>" selected><?php echo $v->nama ?></option>
								                            		<?php else: ?>							                            			
									                            		<option value="<?php echo $v->id ?>"><?php echo $v->nama ?></option>
								                            		<?php endif ?>
								                            	<?php endforeach ?>
								                            </select>
								                            </td>
								                            <?php $Subtotal = $value->qty * toFloat($value->price); $grandtotal += $Subtotal ?>
								                            <td>Rp. <span data-a-sep="." data-a-dec="," data-m-dec="2" class="autonumber subtotal-receive"><?php echo $Subtotal ?></span></td>
								                        </tr>
	                    							<?php endforeach ?>
	                    						<?php endif ?>
	                    					<?php endif ?>
	                    				</tbody>
	                    				<tfoot>
	                    				    <tr>
	                    				        <th class="text-right" style="vertical-align: middle;" colspan="10"><h4>Grand Total</h4></th>
	                    				        <th><h4 data-a-sep="." data-a-dec="," data-m-dec="0" class="autonumber align-middle" id="grandtotal-receive" data-a-sign="Rp "><?php echo $grandtotal ?></h4></th>
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