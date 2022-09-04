<style>
	.body{
		background-color: white !important;
	}
</style>

<div class="mt-2 mx-3">
	<div class="row">
	<div class="col-5 ml-2">
		<div class="row">
			<div class="col border border-dark" style="border-width: 4px !important;">
				<div class="row">
					<div class="col"><h3> <?php echo $data->company['title'] ?>  </h3><hr style="margin: -3px 0px 3px 0px; width: 85%;border-color: black;border-width: 1px;"></div>
				</div>
				<div class="row">
					<div class="col mb-1 text-left"><?php echo $data->company['address'].' - '.$data->company['phone'] ?></div>			
				</div>
			</div>
		</div>
	</div>
	<div class="col-4 offset-2 text-right"><h2 class="p-3">Surat Jalan Mutasi</h2></div>
</div>

<div class="row">
	<div class="col-6 offset-6">
		<table cellpadding="6">
			<tr>
				<td>Tanggal</td>
				<td>:</td>
				<td><?php echo tgl($data->tangal) ?></td>
			</tr>
			<tr>
				<td>No</td>
				<td>:</td>
				<td><?php echo $data->no ?></td>
			</tr>
		</table>
	</div>
</div>

<div class="row">
	<div class="col">
		<table class="table">
			<thead>
				<tr>
					<th>Kode</th>
					<th>Sparepart</th>
					<th>Current Location</th>
					<th>Current Qty</th>
					<th>New Location</th>
					<th>New Qty</th>
					<th>#</th>
				</tr>
			</thead>
			<tbody>
				<?php for($i = 0; $i < count($data->detail->kode); $i++):  ?>
					<tr>
						<td><?php echo $data->detail->kode[$i] ?> </td>
						<td><?php echo $data->detail->sparepart[$i] ?> </td>
						<td><?php echo $data->detail->currentLocation[$i] ?> </td>
						<td><?php echo $data->detail->currentQty[$i] ?> </td>
						<td><?php echo sql_get_var('tb_location', 'nama', ['id' => $data->detail->newLocation[$i]]) ?> </td>
						<td><?php echo $data->detail->newQty[$i] ?> </td>
						<td><i class="fa fa-check text-success"></i></td>
					</tr>
				<?php endfor ?>
			</tbody>
		</table>
	</div>
</div>

<div class="row">
	<div class="col">
		<table class="table table-sm table-borderless">
			<thead>
				<tr align="center">
					<th>Dibuat Oleh,</th>
					<th>Diterima Oleh,</th>
				</tr>
			</thead>
			<tbody>
				<tr align="center">
					<td class="pt-4">( Gudang )</td>
					<td class="pt-4">( <?php echo $data->nama ?> )</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

<script src="<?php echo base_url() ?>assets/libs/flot-charts/jquery.js"></script>
<script src="<?php echo base_url() ?>assets/libs/autonumeric/autoNumeric-min.js"></script>
<script>
	$(document).ready(function($) {
		function toFloat(nominal = 0)
	    {
	        if(nominal == '')
	        {
	            nominal = 0;
	            nominal = parseFloat(nominal);
	        } else {
	            nominal = nominal.replace(/[.]/g, '');
	            nominal = nominal.replace(/[,]/g, '.');
	            nominal = parseFloat(nominal);
	        }

	        return nominal;
	    }
	    var total = 0
	    $('.jum').each(function(index, el) {
	    	total += toFloat($(this).text())
	    });

	    $('#jumtotal').text(total)
	    $('.autonumber').autoNumeric('init')
	});
</script>