<?php if ($is_print): ?>
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

		<div class="col-4 offset-2 text-right">
			<h2 class="pt-3 pb-0 pl-3 pr-0 text-right">Insentif</h2>
			<h3 class=""><?php echo my($month, true) ?></h3>
		</div>

	</div>

	<hr class="border border-dark border-2 mb-2">
	<?php 
	    $jumCat = count($category)
	 ?>
	<table class="table">
		<thead>
		    <tr>
		        <th style="vertical-align: center" rowspan="2">Employee</th>
		        <th style="vertical-align: center" rowspan="2">Position</th>
		        <th colspan="<?php echo $jumCat ?>">Target To Achieved</th>
		        <th colspan="<?php echo $jumCat + 2 ?>">Achieved Target</th>
		        <th colspan="<?php echo $jumCat * 2 ?>">Incentive</th>
		    </tr>
		    <tr>
		        <?php $cols = 0; foreach ($category as $key => $value): ?>
		            <th><?php echo $value['nama']; $cols++ ?></th>
		        <?php endforeach ?>

		        <?php foreach ($category as $key => $value): ?>
		            <th><?php echo $value['nama']; $cols++ ?></th>
		            <th>%</th>
		        <?php endforeach ?>

		        <?php foreach ($category as $key => $value): ?>
		            <th><?php echo $value['nama']; $cols ++ ?></th>
		            <th>%</th>
		        <?php endforeach ?>

		    </tr>
		</thead>
		<tbody>
			<?php foreach (json_decode($rows->detail) as $key => $value): ?>
				<tr>
					<td><?php echo $value->employee ?> </td>
					<td><?php echo $value->position ?> </td>
					<td><?php echo $value->targetJasa ?> </td>
					<td><?php echo $value->targetSparepart ?> </td>
					<td><?php echo $value->achievedJasaNominal ?> </td>
					<td><?php echo $value->achievedJasaPersen ?> </td>
					<td><?php echo $value->achievedSparepartNominal ?> </td>
					<td><?php echo $value->achievedSparepartPersen ?> </td>
					<td><?php echo $value->insentifJasaNominal ?> </td>
					<td><?php echo $value->insentifJasaPersen ?> </td>
					<td><?php echo $value->insentifSparepartNominal ?> </td>
					<td><?php echo $value->insentifSparepartPersen ?> </td>
				</tr>
			<?php endforeach ?>
		</tbody>
		<tfoot>
			<tr>
				<th class="text-right" colspan="9">Grand Total</th>
				<th>Rp. <?php echo rupiah($rows->jml_insentif) ?></th>
			</tr>
		</tfoot>
	</table>
<?php else: ?>
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body">
					<?php 
					    $jumCat = count($category)
					 ?>
					<table class="table">
						<thead>
						    <tr>
						        <th style="vertical-align: center" rowspan="2">Employee</th>
						        <th style="vertical-align: center" rowspan="2">Position</th>
						        <th colspan="<?php echo $jumCat ?>">Target To Achieved</th>
						        <th colspan="<?php echo $jumCat + 2 ?>">Achieved Target</th>
						        <th colspan="<?php echo $jumCat * 2 ?>">Incentive</th>
						    </tr>
						    <tr>
						        <?php $cols = 0; foreach ($category as $key => $value): ?>
						            <th><?php echo $value['nama']; $cols++ ?></th>
						        <?php endforeach ?>

						        <?php foreach ($category as $key => $value): ?>
						            <th><?php echo $value['nama']; $cols++ ?></th>
						            <th>%</th>
						        <?php endforeach ?>

						        <?php foreach ($category as $key => $value): ?>
						            <th><?php echo $value['nama']; $cols ++ ?></th>
						            <th>%</th>
						        <?php endforeach ?>
						        <th>Print</th>

						    </tr>
						</thead>
						<tbody>
							<?php foreach (json_decode($rows->detail) as $key => $value): ?>
								<tr>
									<td><?php echo $value->employee ?> </td>
									<td><?php echo $value->position ?> </td>
									<td><?php echo $value->targetJasa ?> </td>
									<td><?php echo $value->targetSparepart ?> </td>
									<td><?php echo $value->achievedJasaNominal ?> </td>
									<td><?php echo $value->achievedJasaPersen ?> </td>
									<td><?php echo $value->achievedSparepartNominal ?> </td>
									<td><?php echo $value->achievedSparepartPersen ?> </td>
									<td><?php echo $value->insentifJasaNominal ?> </td>
									<td><?php echo $value->insentifJasaPersen ?> </td>
									<td><?php echo $value->insentifSparepartNominal ?> </td>
									<td><?php echo $value->insentifSparepartPersen ?> </td>
									<td><button id="print-row-insentif" class="btn btn-success"> <i class="fa fa-print"></i></button></td>
								</tr>
							<?php endforeach ?>
						</tbody>
						<tfoot>
							<tr>
								<th class="text-right" colspan="9">Grand Total</th>
								<th id="grandtotal">Rp. <?php echo rupiah($rows->jml_insentif) ?></th>
							</tr>
						</tfoot>
					</table>				
					<div class="row">
						<div class="col text-right">
							<input type="hidden" name="month" value="<?php echo $rows->month ?>">
							<a href="<?php echo base_url('hrd/incentive') ?>" class="btn btn-primary"> <i class="fa fa-arrow-circle-left mr-2"></i>Back</a>
							<a href="<?php echo base_url('hrd/detail-insentif/'.$rows->month.'/'.true) ?>" id="print-insentif" class="btn btn-success"> <i class="fa fa-print mr-2"></i>Print</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php endif ?>
