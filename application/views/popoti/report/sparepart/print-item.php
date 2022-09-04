<style type="text/css">
	body{
		background-color: white;
		font-family: arial !important; 	
		font-size: 15px !important;
	}
	th,td{
		border-bottom-color: black !important;
	}
</style>
<div class="mt-2 mx-3">
	<div class="row">
		<div class="col-5 ml-2">
			<div class="row">
				<div class="col border border-dark" style="border-width: 4px !important;">
					<div class="row">
						<div class="col"><h3> <?php echo $company['title'] ?>  </h3><hr style="margin: -3px 0px 3px 0px; width: 85%;border-color: black;border-width: 1px;"></div>
					</div>
					<div class="row">
						<div class="col mb-1 text-left"><?php echo $company['address'].' - '.$company['phone'] ?></div>			
					</div>
				</div>
			</div>
		</div>
		<?php if ($type == 'item'): ?>
			<div class="col-4 offset-2 text-right"><h2 class="p-3">Parts Sales By Item</h2></div>
		<?php elseif($type == 'daily'): ?>
			<div class="col-4 offset-2 text-right"><h2 class="p-3">Parts Daily Stock</h2></div>
		<?php elseif($type == 'recommended'): ?>
			<div class="col-4 offset-2 text-right"><h2 class="p-3">Parts Recommended Order</h2></div>
		<?php else: ?>
			<div class="col-4 offset-2 text-right"><h2 class="p-3"><?php echo $type ?></h2></div>
		<?php endif ?>

	</div>

<hr class="border border-dark border-2 mb-2">
<div class="row mb-2">
	<div class="col-6">
	</div>
</div>



<div class="row">
	<div class="col">
		<?php if ($type == 'item'): ?>
			<table class="w-100" cellpadding="4">
				<thead>
						<tr class="border-top border-bottom border-dark">
						     <th>No</th>
						     <th>Part Code</th>
						     <th>Part Name</th>
						     <th>Part Category</th>
						     <th>ABC Categori</th>
						     <th>Sales Qty </th>
						     <th>Sales Amount </th>
						     <th>Last Stock</th>
						     <th>Ratio</th>
						 </tr>
				</thead>
				<tbody>
					<?php if ($rows): ?>					
						<?php $no = 1; foreach ($rows as $key => $value): ?>
							<tr>
								<td><?php echo $no++ ?> </td>
								<td><?php echo $value['partCode'] ?> </td>
								<td><?php echo $value['partName'] ?> </td>
								<td><?php echo $value['partCat'] ?> </td>
								<td><?php echo $value['abcCat'] ?> </td>
								<td><?php echo $value['salesQty'] ?> </td>
								<td><?php echo $value['salesAmount'] ?> </td>
								<td><?php echo $value['lastStock'] ?> </td>
								<td><?php echo $value['ratio'] ?> </td>
							</tr>
						<?php endforeach ?>
					<?php else: ?>
						<tr>
							<td colspan="9" class="text-center">Data Is Empty</td>
						</tr>
					<?php endif ?>
				</tbody>
			</table>
		<?php elseif($type == 'daily'): ?>
			<table class="w-100" cellpadding="4">
				<thead>
						<tr class="border-top border-bottom border-dark">
						     <th>No</th>
						     <th>Kode Part</th>
						     <th>Sparepart Name</th>
						     <th>Sparepart Category</th>
						     <th>Location </th>
						     <th>Qty</th>
						 </tr>
				</thead>
				<tbody>
					<?php if ($rows): ?>
						<?php $no = 1; foreach ($rows as $key => $value): ?>
							<tr>
								<td><?php echo $no++ ?> </td>
								<td><?php echo $value['partCode'] ?> </td>
								<td><?php echo $value['partName'] ?> </td>
								<td><?php echo $value['partCat'] ?> </td>
								<td><?php echo $value['partLoc'] ?> </td>
								<td><?php echo $value['partQty'] ?> </td>
							</tr>
						<?php endforeach ?>
					<?php else: ?>
						<tr>
							<td colspan="9" class="text-center">Data Is Empty</td>
						</tr>
					<?php endif ?>
				</tbody>
			</table>
		<?php elseif($type == 'recommended'): ?>
			<table class="w-100" cellpadding="4">
				<thead>
						<tr class="border-top border-bottom border-dark">
						     <th>No</th>
						     <th>Kode Part</th>
						     <th>Sparepart Name</th>
						     <th>Sparepart Category</th>
						     <th>ABC Cat </th>
						     <th>Recomd Order</th>
						 </tr>
				</thead>
				<tbody>
					<?php if ($rows): ?>
						<?php $no = 1; foreach ($rows as $key => $value): ?>
							<tr>
								<td><?php echo $no++ ?> </td>
								<td><?php echo $value['partCode'] ?> </td>
								<td><?php echo $value['partName'] ?> </td>
								<td><?php echo $value['partCat'] ?> </td>
								<td><?php echo $value['abcCat'] ?> </td>
								<td><?php echo $value['recomd'] ?> </td>
							</tr>
						<?php endforeach ?>
					<?php else: ?>
						<tr>
							<td colspan="9" class="text-center">Data Is Empty</td>
						</tr>
					<?php endif ?>
				</tbody>
			</table>
			<?php elseif($type == 'join'): ?>
				<table class="w-100" cellpadding="4">
					<thead>
							<tr class="border-top border-bottom border-dark">
	                             <th>No</th>
	                             <th>Employee Name</th>
	                             <th>Position</th>
	                             <th>Registered Day</th>
	                             <th>Status</th>
	                         </tr>
					</thead>
					<tbody>
						<?php if ($rows): ?>
							<?php $no = 1; foreach ($rows as $key => $value): ?>
								<tr>
									<td><?php echo $no++ ?> </td>
									<td><?php echo $value['name'] ?> </td>
									<td><?php echo $value['position'] ?> </td>
									<td><?php echo $value['date'] ?> </td>
									<td><?php echo $value['status'] ?> </td>
								</tr>
							<?php endforeach ?>
						<?php else: ?>
							<tr>
								<td colspan="9" class="text-center">Data Is Empty</td>
							</tr>
						<?php endif ?>
					</tbody>
				</table>
				<?php elseif($type == 'thr'): ?>
					<table class="w-100" cellpadding="4">
						<thead>
								<tr class="border-top border-bottom border-dark">
		                             <th>No</th>
		                             <th>Periode</th>
		                             <th>Total</th>
		                             <th>Status</th>
		                         </tr>
						</thead>
						<tbody>
							<?php if ($rows): ?>
								<?php $no = 1; foreach ($rows as $key => $value): ?>
									<tr>
										<td><?php echo $no++ ?> </td>
										<td><?php echo $value['year'] ?> </td>
										<td><?php echo $value['total'] ?> </td>
										<td><?php echo $value['status'] ?> </td>
									</tr>
								<?php endforeach ?>
							<?php else: ?>
								<tr>
									<td colspan="9" class="text-center">Data Is Empty</td>
								</tr>
							<?php endif ?>
						</tbody>
					</table>
					<?php elseif($type == 'payroll'): ?>
						<table class="w-100" cellpadding="4">
							<thead>
									<tr class="border-top border-bottom border-dark">
			                             <th>No</th>
	                                     <th class="no-sort">Periode</th>
	                                     <th class="no-sort">Total Fee</th>
	                                     <th class="no-sort">Potongan</th>
	                                     <th class="no-sort">THP</th>
	                                     <th class="no-sort">Status</th>
	                                     <th class="no-sort">BPJS</th>
	                                     <th class="no-sort">Status</th>
			                         </tr>
							</thead>
							<tbody>
								<?php if ($rows): ?>
									<?php $no = 1; foreach ($rows as $key => $value): ?>
										<tr>
											<td><?php echo $no++ ?> </td>
											<td><?php echo $value['month'] ?> </td>
											<td><?php echo $value['fee'] ?> </td>
											<td><?php echo $value['potongan'] ?> </td>
											<td><?php echo $value['thp'] ?> </td>
											<td><?php echo $value['statusThp'] ?> </td>
											<td><?php echo $value['bpjs'] ?> </td>
											<td><?php echo $value['statusBpjs'] ?> </td>
										</tr>
									<?php endforeach ?>
								<?php else: ?>
									<tr>
										<td colspan="9" class="text-center">Data Is Empty</td>
									</tr>
								<?php endif ?>
							</tbody>
						</table>
						<?php elseif($type == 'insentif'): ?>
						<table class="w-100" cellpadding="4">
							<thead>
									<tr class="border-top border-bottom border-dark">
			                             <th>No</th>
                                         <th>Periode</th>
                                         <th>Total Insentif</th>
                                         <th>Status</th>
                                         <th>Total Reward</th>
                                         <th>Status</th>
			                         </tr>
							</thead>
							<tbody>
								<?php if ($rows): ?>
									<?php $no = 1; foreach ($rows as $key => $value): ?>
										<tr>
											<td><?php echo $no++ ?> </td>
											<td><?php echo $value['month'] ?> </td>
											<td><?php echo $value['total'] ?> </td>
											<td><?php echo $value['statusTotal'] ?> </td>
											<td><?php echo $value['reward'] ?> </td>
											<td><?php echo $value['statusReward'] ?> </td>
										</tr>
									<?php endforeach ?>
								<?php else: ?>
									<tr>
										<td colspan="9" class="text-center">Data Is Empty</td>
									</tr>
								<?php endif ?>
							</tbody>
						</table>
						<?php elseif($type == 'daily-report'): ?>
						<table class="w-100" cellpadding="4">
							<thead>
									<tr class="border-top border-bottom border-dark">    
									    <th valign="middle" rowspan="2">No</th>
									    <th rowspan="2">Invoice No</th>
									    <th class="no-sort" colspan="4">Customer Information</th>
									    <th class="" rowspan="2">Service Category</th>
									    <th class="no-sort" rowspan="2">Parts No</th>
									    <th class="no-sort" rowspan="2">Parts Name</th>
									    <th class="no-sort" rowspan="2">Parts Qty</th>
									    <th class="no-sort" rowspan="2">Parts Price</th>
									    <th class="no-sort" rowspan="2">Total Labor</th>
									    <th class="no-sort" rowspan="2">Total Parts</th>
									    <th class="no-sort" rowspan="2">Total Amount</th>
									    <th class="no-sort" rowspan="2">Technician</th>
									    <th class="no-sort" rowspan="2">Invoice By</th>
									    <!-- <th rowspan="2">last updated</th>
									    <th rowspan="2" class='no-sort'>Options</th> -->

									</tr>           
									<tr>
									    <th class="">Name</th>
									    <th class="no-sort">No Plat</th>
									    <th class="no-sort">Unit</th>
									    <th class="no-sort">No Telp</th>
									</tr>
							</thead>
							<tbody>
								<?php if ($rows): ?>
									<?php $no = 1; foreach ($rows as $key => $value): ?>
										<tr>
											<td><?php echo $no++ ?> </td>
											<td><?php echo $value['invoice'] ?> </td>
											<td><?php echo $value['customer'] ?> </td>
											<td><?php echo $value['plat'] ?> </td>
											<td><?php echo $value['unit'] ?> </td>
											<td><?php echo $value['noTelp'] ?> </td>
											<td><?php echo $value['serviceCat'] ?> </td>
											<td><?php echo $value['partsNo'] ?> </td>
											<td><?php echo $value['partsName'] ?> </td>
											<td><?php echo $value['partsQty'] ?> </td>
											<td><?php echo $value['partsPrice'] ?> </td>
											<td><?php echo $value['totalLabor'] ?> </td>
											<td><?php echo $value['totalParts'] ?> </td>
										</tr>
									<?php endforeach ?>
								<?php else: ?>
									<tr>
										<td colspan="9" class="text-center">Data Is Empty</td>
									</tr>
								<?php endif ?>
							</tbody>
						</table>
						<?php elseif($type == 'teknisi'): ?>
						<table class="w-100" cellpadding="4">
							<thead>
									<tr class="border-top border-bottom border-dark">
			                             <th>No</th>
			                             <th>Technician Name</th>
			                             <th>Working day</th>
			                             <th>Total SVC  Qty</th>
			                             <th>Service AMT</th>
			                             <th>Part AMT</th>
			                             <th>OIL AMT</th>
			                             <th>Grand Total</th>
			                         </tr>
							</thead>
							<tbody>
								<?php if ($rows): ?>
									<?php $no = 1; foreach ($rows as $key => $value): ?>
										<tr>
											<td><?php echo $no++ ?> </td>
											<td><?php echo $value['teknisi'] ?> </td>
											<td><?php echo $value['workingDay'] ?> </td>
											<td><?php echo $value['totalSVC'] ?> </td>
											<td><?php echo $value['serviceAMT'] ?> </td>
											<td><?php echo $value['partAMT'] ?> </td>
											<td><?php echo $value['oilAMT'] ?> </td>
											<td><?php echo $value['grandTotal'] ?> </td>
										</tr>
									<?php endforeach ?>
								<?php else: ?>
									<tr>
										<td colspan="9" class="text-center">Data Is Empty</td>
									</tr>
								<?php endif ?>
							</tbody>
						</table>
		<?php endif ?>

		<div class="row">
			<div class="col">
				<div class="row">
					<div class="col-2 offset-10">
						Garut, <?php echo date('d-m-Y') ?>
					</div>
				</div>

				<div class="row">
					<div class="col-3 text-center font-italic">
					</div>
					<div class="col-7 offset-2 text-right font-weight-bold">
						<?php echo $company['title'] ?> <br>
						<span class="small" style="font-weight: normal;font-style: italic;">This payslip is printed by the system, officially without having to stamp and sign</span>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>