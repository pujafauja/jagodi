<div class="row">
	<div class="col-12">
		<form action="<?php echo base_url() ?>service/new-retail" id="form-retail" method="post">
			<div class="card-box">
				<div class="card-body">
					<div class="row">
	                    <div class="col-12">
                            <div class="form-group">
                                <label for="">Mobile Phone <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <button type="button" id="customers" href="<?php echo base_url('customer/customers') ?>" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                    </div>
                                    <input type="hidden" name="hassave" value="<?php echo $data['user']['id'] ?>">
                                    
                                    <input type="text" required="" value="<?php echo $data['user']['no_hp'] ?>" class="form-control" name="no-hp" id="no">
                                    <input type="hidden" name="customerid" value="<?php echo $data['user']['customer_id'] ?>">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" id="reesetcustomer"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Customer Name <span class="text-danger">*</span></label>
                                <input type="text" required="" class="form-control" name="cust-nama" value="<?php echo $data['user']['customer'] ?>">
                            </div>
                            <input type="hidden" name="iscustomer" value="false">
                            <input type="hidden" name="isvehicle" value="false">
                            <div class="form-group">
                                <label for="">District, Subdisctrict, City, Province <span class="text-danger">*</span></label>
                                <input type="text" required="" class="form-control" name="district" value="<?php echo $data['user']['district'] ?>">
                                <input type="hidden" name="district-id" value="<?php echo $data['user']['desa_id'] ?>">
                            </div>
                            <p>Last Service :  <span id="last_service"><?php echo date('d-m-Y H:s:i', strtotime($data['user']['last_service'])) ?></span> </p>
                            <p>Come To Dealer : <span id="total_come"><?php echo $data['user']['total_come'] ?></span> </p>
                        </div> <!-- end col -->
	                </div> <!-- end row -->   
				</div>
			</div>
			<div class="card-box">
				<div class="card-body">
	                <div class="form-group">
	                    <label for="technician">Parts Detail</label>
	                    <div class="input-group">
	                        <div class="input-group-append">
	                            <button type="button" id="btn-parts" href="<?php echo base_url('service/show-parts') ?>" class="btn btn-primary"><i class="fa fa-search"></i></button>
	                        </div>
	                        <input type="text" name="parts" class="form-control" id="parts">
	                    </div>

	                </div>
	                <table class="table">
	                    <thead>
	                        <tr>
                                <th>Kode Barang</th>
                                <th>Parts</th>
                                <th>Het</th>
                                <th>Qty</th>
                                <th>Disc</th>
                                <th>On Hand Qty</th>
                                <th>Picking Qty</th>
                                <th>Selling Price</th>
                            </tr>
	                    </thead>
	                    <tbody id="spk-parts"> 
	                    	<?php if (isset($data['part']) && is_array($data['part'])): ?>
                                    <?php foreach ($data['part'] as $key => $pt): ?>
                                        <tr data-parent="<?php echo $pt->sparepart_id ?>">
                                            <td><i class="mr-2 fa fa-times closerowpaket text-danger"></i> <?php echo $pt->kode ?></td>
                                            <td><?php echo $pt->nama ?></td>
                                            <td>
                                                <?php echo nestedPrice($pt->sparepart_id, $pt->het) ?>
                                            </td>
                                            <td>
                                                <input type="text" style="width: 60px;" <?php echo ($pt->pickingqty) ? 'readonly=""' : '' ?>  class="part-qty form-control form-control-sm" value="<?php echo $pt->qty ?>"  name="part-qty[<?php echo $pt->sparepart_id ?>]">
                                                <input type="hidden" value="<?php echo $pt->sparepart_id ?>" name="parts_id[]">
                                            </td>
                                            <td>
                                                <input type="text" style="width: 120px;" class="part-disc autonumber form-control form-control-sm" value="<?php echo $pt->disc ?>" name="part-disc[<?php echo $pt->sparepart_id ?>]">
                                            </td>
                                                <td>
                                                <?php echo $pt->onhandqty ?>
                                            </td>
                                            <td>
                                            <?php $qty = ($pt->pickingqty) ? $pt->pickingqty : $pt->qty;
                                                  $selling = ( ($qty * intval($pt->het)) - intval($pt->disc) ); ?>
                                                <?php echo $pt->pickingqty; ?>
                                                <input type="hidden" name="pickingqty[<?php echo $pt->sparepart_id ?>]" value="<?php echo $pt->pickingqty ?>">
                                            </td>

                                            <td>Rp. <span data-a-sep='.' data-a-dec="," data-m-dec="0" class="sellingpricepart autonumber" id="sellingpricepart[<?php echo $pt->sparepart_id ?>]"><?php echo $selling ?></span></td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php endif ?>
	                    </tbody>
	                </table>
					<div class="text-right">
                        <a href="<?php echo base_url('service/summary') ?>" class="btn btn-secondary"><i class="fa fa-arrow-left mr-2"></i>Back</a>
                        <button id="confirmretail" class="btn btn-primay" data-status="0" type="submit">Confirm</button>
						<button id="confirmretail" class="btn btn-success" data-status="1" <?php echo ($pt->pickingqty != '0') ? '' : 'disabled=""'; ?> type="submit">Finish</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>