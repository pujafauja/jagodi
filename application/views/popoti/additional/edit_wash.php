					 
<form action="<?php echo base_url('Wash/index/'.encode($id)) ?>" data-type="edit" method="POST">
	

<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
						    <label for="">Mobile Phone <span class="text-danger">*</span></label>
						    <div class="input-group">
						        <div class="input-group-append">
						            <button type="button" id="customers" href="<?php echo base_url('customer/customers') ?>" class="btn btn-primary"><i class="fa fa-search"></i></button>
						        </div>
						        <input type="text"  required="" class="form-control" value="<?php echo $row->data_vehicle->no ?>" name="no-hp" id="no">
						        <input type="hidden" value="<?php echo $row->data_vehicle->customer_id ?>" name="customerid">
						        <div class="input-group-append">
						            <button class="btn btn-danger" type="button" id="reesetcustomer"><i class="fa fa-times"></i></button>
						        </div>
						    </div>
						</div>
						<div class="form-group">
						    <label for="">Customer Name <span class="text-danger">*</span></label>
						    <input type="text" required="" class="form-control" value="<?php echo $row->data_vehicle->nama ?>" name="cust-nama">
						</div>
						<input type="hidden" name="iscustomer" value="false">
						<input type="hidden" name="isvehicle" value="false">
						<div class="form-group">
						    <label for="">District, Subdisctrict, City, Province <span class="text-danger">*</span></label>
						    <input type="text" required="" class="form-control" value="<?php echo $row->data_vehicle->alamat ?>" name="district">
						    <input type="hidden" value="<?php echo $row->data_vehicle->desa_id ?>" name="district-id">
						</div>
						
						<p>Last Come :  <span id="last_service"><?php echo $row->data_vehicle->last_service ?></span> </p>
						<p>Total Come : <span id="total_come"><?php echo $row->data_vehicle->total_come ?></span> </p>


					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>No. Nota <span class="text-danger">*</span></label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<i class="fas fa-receipt"></i>
									</span>
								</div>
								<input type="text" name="nomor_nota" id="nomor_nota" value="<?php echo $row->nota; ?>" readonly="" class="form-control">
								<input type='hidden' name='userid' id="userid" class='form-control' id='userid' value="<?php echo $this->session->userdata('user') ?>">
							</div>
						</div>
						<div class="form-group">
						    <label for="">No Plat <span class="text-danger">*</span></label>
						    <div class="input-group">
						        <div class="input-group-prepend">
						            <button type="button" id="plats" href="<?php echo base_url('customer/plats') ?>" class="btn btn-primary"><i class="fa fa-search"></i></button>
						        </div>
						        <input type="text" required="" name="no-plat" class="form-control" value="<?php echo $row->data_vehicle->plat ?>" id="no-plat">
						        <div class="input-group-append">
						            <button class="btn btn-danger" type="button" id="resetvehicle"><i class="fa fa-times"></i></button>
						        </div>
					            <input type="hidden" value="<?php echo $row->data_vehicle->id ?>" name="vehicleid">
						    </div>
						</div>
						<div class="form-group">
						    <label for="">Unit <span class="text-danger">*</span></label>
						    <div class="input-group">
						        <div class="input-group-append">
						            <button type="button" id="units" href="<?php echo base_url('customer/unit2') ?>" class="btn btn-primary"><i class="fa fa-search"></i></button>
						        </div>
						        <input type="text" required="" class="form-control" value="<?php echo $row->data_vehicle->unit ?>" id="unit" name="unit">
						        <input type="hidden" value="<?php echo $row->data_vehicle->unitid ?>" name="unit-id">
						    </div>
						</div>
						<div class="form-group">
						    <label for="">Washer <span class="text-danger">*</span></label>
						    <div class="input-group">
						        <div class="input-group-append">
						            <button type="button" id="washer" href="<?php echo base_url('wash/washer') ?>" class="btn btn-primary"><i class="fa fa-search"></i></button>
						        </div>
						        <input type="text" value="<?php echo sql_get_var('tb_employee', 'nama', ['id' => $row->washerid]) ?>" required="" class="form-control" name="washer" readonly="">
						        <input type="hidden" name="washerid" value="<?php echo $row->washerid ?>">
						    </div>
						</div>

					</div>


					<div class="col-md-4">
						<div class="form-group">
							<label>Date Time <span class="text-danger">*</span></label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<i class="fas fa-calendar"></i>
									</span>
								</div>
								<input type='text' name='tanggal' id="tanggal" class='form-control' id='tanggal' value="<?php echo $row->tanggal; ?>" readonly="">
							</div>
						</div>
						<div class="form-group">
						    <label for="">Merk</label>
						    <input type="text" required="" class="form-control" id="merk" value="<?php echo $row->data_vehicle->merk ?>" name="merk" disabled="">
						</div>
						<div class="form-group">
						    <label for="">Jenis</label>
						    <input type="text" required="" class="form-control" id="jenis" value="<?php echo $row->data_vehicle->jenis ?>" name="jenis" disabled="">
						    <input type="hidden" value="<?php echo $row->data_vehicle->merkid ?>" name="merkid">
						    <input type="hidden" value="<?php echo $row->data_vehicle->jenisid ?>" name="jenisid">
						</div>
						<div class="form-group">
						    <label for="">Kategori</label>
						    <input type="text" required="" class="form-control" id="kategori" value="<?php echo $row->data_vehicle->cat ?>" name="kategori" disabled="">
						    <input type="hidden" value="<?php echo $row->data_vehicle->catid ?>" id="categoryid" name="category_id">
						</div>
					</div>
				</div>

				<div class="row text-right">
					<div class="col-12">
						<button class="btn btn-success mt-3 mb-3" id="new-transaction"><i class="fe-plus-square"></i> New Transaction (F4)</button>						
						<!-- <button class="btn btn-warning mt-3 mb-3" id="suspend"><i class="fe-pause"></i> Suspend (F6)</button> -->
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">&nbsp;</div>
					<div class="col-md-6">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<a class="btn btn-primary popup-item" href="<?php echo base_url('wash/items') ?>"><i class="fas fa-search"></i></a>
							</div>
							<input type="text" name="" class="form-control" placeholder="Type something or click button on side (F9)" id="find-item">
						</div>
					</div>
				</div>

				<table class="table table-striped table-ordered table-sm" id="tbl-transaction">
					<thead>
						<tr>
							<th width="30%">Name</th>
							<th width="20%">Price</th>
							<th width="10%">QTY</th>
							<th width="20%">Discount</th>
							<th width="20%">Subtotal</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach (json_decode($row->detail) as $key => $value): ?>
							<tr data-id="<?php echo $value->washid ?>">
	                            <td>
	                            	<a class="delete-item text-danger mr-1"><i class="fas fa-times"></i></a><?php echo sql_get_var('tb_retail_prices', 'nama', ['id' => $value->washid ]) ?>
	                            	<input type="hidden" name="kode-barang[]" value="<?php echo $value->washid ?>">
	                            </td>
	                            <td>
	                            	<span class="autonumber" data-a-sep="." data-a-dec="," data-m-dec="0" data-a-sign="Rp. "><?php echo $value->harga ?></span>
	                            	<input type="hidden" name="harga_satuan[]" value="<?php echo $value->harga ?>">
	                            </td>
	                            <td>
	                            	<input class="form-control autonumber" data-a-sep="." data-a-dec="," data-m-dec="0" type="text" name="jumlah_beli[]" value="<?php echo $value->qty ?>"> 
	                            </td>
	                            <td>
	                                <div class="input-group">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text">Rp</span>
	                                    </div>
	                                    <input class="form-control autonumber" data-a-sep="." data-a-dec="," data-m-dec="0" value="<?php echo $value->diskon ?>" name="diskon[]">
	                                </div>
	                            </td>
	                            <td class="text-right">
	                            	<span class="autonumber" data-a-sep="." data-a-dec="," data-m-dec="0" data-a-sign="Rp. "><?php echo $value->subtotal ?></span>
	                            	<input type="hidden" name="sub_total[]" value="<?php echo $value->subtotal ?>">
	                            </td>
	                        </tr>
						<?php endforeach ?>
					</tbody>
				</table>
				<div id="box-total">
					<div class="row">
						<div class="col-md-8">
							<div class="row">
								<div class="col-sm-6 text-right">Total:</div>
								<div class="col-sm-6 text-right">Rp <span class="autonumber" id="Total" data-a-sep="." data-a-dec="," data-m-dec="0"><?php echo $row->grandtotal + $row->discount ?></span></div>
							</div>
							<div class="row border-bottom">
								<div class="col-sm-6 text-right">Discount:</div>
								<div class="col-sm-6 text-right text-danger">Rp <span class="autonumber" id="Discount" data-a-sep="." data-a-dec="," data-m-dec="0"><?php echo $row->discount ?></span></div>
							</div>
							<div class="row">
								<div class="col-sm-6 text-right"><h4>Grandtotal</h4></div>
								<div class="col-sm-6 text-right"><h4>Rp <span id="grand" class="autonumber" data-a-sep="." data-a-dec="," data-m-dec="0"><?php echo $row->grandtotal ?></span></h4></div>
							</div>

						</div>
						<div class="col-md-4">
							<button class="btn btn-payment btn-blue" disabled="">
								<i class="fe-credit-card"></i> <br> Save (Enter)
							</button>
						
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

</div>

<style type="text/css">
	.btn-payment {
		width: 100%;
		height: 82px;
	}
	.btn-payment i {
		font-size: xx-large;
	}

</style>