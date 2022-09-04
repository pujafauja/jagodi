<style type="text/css">
	body{
		background-color: white;
		font-family: 'Lucida Console' !important; 	
		font-size: 24 !important;
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

	<div class="col-4 offset-2 text-right">
		<h2 class="pt-3 pb-0 pl-3 pr-0 text-right">Rekapitulasi <?php echo ($is_bpjs) ? 'BPJS' : 'Gaji' ?></h2>
		<h3 class=""><?php echo my($month, true) ?></h3>
	</div>

</div>

<hr class="border border-dark border-2 mb-2">



<div class="row">
	<div class="col">
		<div class="table-responsive">
			<?php if ($is_bpjs): ?>
					<table class="table text-center">
					    <thead>
					        <tr>
					            <th style="vertical-align: middle;" valign="center" rowspan="2">Name</th>
					            <th style="vertical-align: middle;" valign="center" rowspan="2">Position</th>
					            <th colspan="6">Health BPJS</th>
					            <th colspan="6">Employment BPJS</th>
					        </tr>
					        <tr>
					            <th>Employee</th>
					            <th>%</th>
					            <th>Company</th>
					            <th>%</th>
					            <th>Total</th>
					            <th>%</th>

					            <th>Employee</th>
					            <th>%</th>
					            <th>Company</th>
					            <th>%</th>
					            <th>Total</th>
					            <th>%</th>

					        </tr>
					    </thead>
					    <tbody>
					        <?php  
					            $totalKesKaryawan = 0;
					            $totalKesPerusahaan = 0;
					            $totalNakerKaryawan = 0;
					            $totalNakerPerusahaan = 0;
					        ?>
					        <?php foreach ($salary['rows'] as $key => $value): ?>
					            <?php  
					                $totalKesKaryawan += $value->kes_karyawan;
					                $totalKesPerusahaan += $value->kes_perusahaan;
					                $totalNakerKaryawan += $value->naker_karyawan;
					                $totalNakerPerusahaan += $value->naker_perusahaan;
					            ?>
					            <tr>
					                <td><?php echo $value->employee ?></td>
					                <td><?php echo $value->position ?></td>

					                <td><?php echo 'Rp. '.rupiah($value->kes_karyawan) ?></td>
					                <td><?php echo ($value->kes_karyawan / $value->kes_total) * 100 ?>%</td>
					                <td><?php echo 'Rp. '.rupiah($value->kes_perusahaan) ?></td>
					                <td><?php echo ($value->kes_perusahaan / $value->kes_total) * 100 ?>%</td>
					                <td><?php echo 'Rp. '.rupiah($value->kes_total) ?></td>
					                <td><?php echo $value->kes_persen ?>%</td>

					                <td><?php echo 'Rp. '.rupiah($value->naker_karyawan) ?></td>
					                <td><?php echo ($value->naker_karyawan / $value->gaji_bruto) * 100 ?>%</td>
					                <td><?php echo 'Rp. '.rupiah($value->naker_perusahaan) ?></td>
					                <td><?php echo ($value->naker_perusahaan / $value->gaji_bruto) * 100 ?>%</td>
					                <td><?php echo 'Rp. '.rupiah($value->naker_total) ?></td>
					                <td><?php echo $value->naker_persen ?>%</td>


					            </tr>
					        <?php endforeach ?>
					    </tbody>
					    <tfoot>
					    	<tr>
					    		<th colspan="2"></th>
					    		<th colspan="4">Total Bpjs Kesehatan Karyawan</th>
					    		<th colspan="2"><?php echo 'Rp. '.rupiah($totalKesKaryawan) ?></th>
					    		<th colspan="4">Total Bpjs Ketenagakerjaan Karyawan</th>
					    		<th colspan="2"><?php echo 'Rp. '.rupiah($totalNakerKaryawan) ?></th>
					    	</tr>
					    	<tr>
					    		<th colspan="2"></th>
					    		<th colspan="4">Total Bpjs Kesehatan Perusahaan</th>
					    		<th colspan="2"><?php echo 'Rp. '.rupiah($totalKesPerusahaan) ?></th>
					    		<th colspan="4">Total Bpjs Ketenagakerjaan Perusahaan</th>
					    		<th colspan="2"><?php echo 'Rp. '.rupiah($totalNakerPerusahaan) ?></th>
					    	</tr>
					    </tfoot>
					</table>
			<?php else: ?>
			    <?php if ($salary): ?> 
			        <table class="text-center table table-bordered table-sm">
			            <thead>
			                <tr class="border-bottom">
			                    <th style="vertical-align: middle;" class="boder " rowspan="2">Name</th>
			                    <th style="vertical-align: middle;" class="boder " rowspan="2">Position</th>
			                    <th style="vertical-align: middle;" class="boder border-right" rowspan="2">Attendance</th>
			                    <th class="text-center border-right"  colspan="5">Salary Parameters</th>
			                    <th class="text-center border-right" colspan="5">Calculate Pay</th>
			                </tr>
			                <tr class="border-bottom">
			                    <th style="vertical-align: middle;" >Basic Salary</th>
			                    <th style="vertical-align: middle;" >Meal Allowance</th>
			                    <th style="vertical-align: middle;" >Allowance</th>
			                    <th style="vertical-align: middle;" >Transportation</th>
			                    <th style="vertical-align: middle;"  class="border-right">Another</th>
			                    <th style="vertical-align: middle;" >Gross Salary</th>

			                    <th style="vertical-align: middle;" >Heath BPJS</th>
			                    <th style="vertical-align: middle;" >Employment BPJS</th>
			                    <th style="vertical-align: middle;" >Potongan</th>
			                    <th style="vertical-align: middle;"  class="border-right">Subtotal</th>
			                </tr>
			            </thead>
			            <tbody>
			                <?php $kotor = 0; $bersih = 0; foreach ($salary['rows'] as $key => $value): ?>
			                    <tr>
			                    	<?php $kotor += $value->gaji_bruto; $bersih += $value->subtotal ?>
			                        <input type="hidden" class="id" name="id[]" value="<?php echo $value->id ?>">
			                        <input type="hidden" class="subtotal" name="subtotal[]" value="<?php echo $value->subtotal ?>">
			                        <td><?php echo $value->employee ?></td>
			                        <td><?php echo $value->position ?></td>
			                        <td class="border-right"><?php echo $value->hadir ?></td>
			                        <td><?php echo 'Rp. '.rupiah($value->pokok) ?></td>
			                        <td><?php echo 'Rp. '.rupiah($value->makan) ?></td>
			                        <td><?php echo 'Rp. '.rupiah($value->transport) ?></td>
			                        <td><?php echo 'Rp. '.rupiah($value->tunjangan) ?></td>
			                        <td class="border-right"><?php echo 'Rp. '.rupiah($value->another) ?></td>
			                        <td><?php echo 'Rp. '.rupiah($value->gaji_bruto) ?></td>

			                        <td><?php echo 'Rp. '.rupiah($value->kes_karyawan) ?></td>

			                        <td><?php echo 'Rp. '.rupiah($value->naker_karyawan) ?></td>

			                        <td><?php echo 'Rp. '.rupiah($value->amount) ?></td>
			                        <td class="border-right"><?php echo 'Rp. '.rupiah($value->subtotal) ?></td>
			                    </tr>
			                <?php endforeach ?>
			            </tbody>
			            <tfoot>
			            	<tr>
				            	<th class="text-right" colspan="12">Total Biaya Gaji</th>
				            	<th>Rp. <?php echo rupiah($kotor) ?></th>	            		
			            	</tr>
			            	<tr>
				            	<th class="text-right" colspan="12">Total Gaji Setelah Potongan</th>
				            	<th>Rp. <?php echo rupiah($bersih) ?></th>	            		
			            	</tr>
			            </tfoot>
			        </table>
			    <?php endif ?>

			<?php endif ?>

		</div>
	</div>
</div>

<div class="row">
	<div class="col">
		<table class="" cellpadding="7">
			<thead>
				<tr align="center">
					<th>Dicek Oleh,</th>
				</tr>
			</thead>
			<tbody>
				<tr align="center">
					<td class="pt-4">( <?php echo sql_get_var('tb_employee', 'nama', ['id' => $this->session->userdata('user')]) ?> )</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
