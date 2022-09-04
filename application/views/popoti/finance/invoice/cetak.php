<style type="text/css">
	body{
		background-color: white;
		font-family: monospace !important; 	
		font-size: 24 !important;
		padding: 15px;
	}
	th,td{
		border-bottom-color: black !important;
	}

	@media print {
	  #print {
	    display: none;
	  }
	}
</style>

<div class="row">
	<div class="col-6">
		<div class="row">
			<div class="col border border-dark" style="border-width: 4px !important;">
				<div class="row">
					<div class="col"><h3 style="font-family: monospace;"> <?php echo $company->title ?>  </h3><hr style="margin: -3px 0px 3px 0px; width: 85%;border-color: black;border-width: 1px;"></div>
				</div>
				<div class="row">
					<div class="col mb-1 text-left"><?php echo $company->address.' - '.$company->phone ?></div>			
				</div>
			</div>
		</div>
	</div>
	<div class="col-6 text-right"><h3 style="font-family: monospace;" class="p-3"><?php echo ($payment->type == 'in') ? 'KWITANSI PEMBAYARAN' : 'BUKTI PENGELUARAN KAS' ?></h3></div>
</div>
<div class="row mt-3">
	<div class="col-4"><?php echo ($payment->type == 'in') ? 'Sudah terima dari' : 'Dibayarkan kepada' ?></div>
	<div class="col-8">: <?php echo ($payment->type == 'in') ? $payment->customer : $payment->supplier ?></div>
	<div class="col-4">Banyaknya uang</div>
	<div class="col-8">: <?php echo terbilang($payment->pembayaran) ?></div>
	<div class="col-4">Untuk pembayaran</div>
	<div class="col-8">: Pembayaran Invoice No. <?php echo $payment->no ?></div>
</div>
<div class="row mt-3">
	<div class="col-7 border border-dark text-center">
		PEMBAYARAN DENGAN CHEQUE/BILYET GIRO DIANGGAP SAH, SETELAH CHEQUE/BILYET GIRO TERSEBUT DAPAT DIUANGKAN
	</div>
	<div class="col-5 text-center">
		Garut, <?php echo tanggalindo(date('Y-m-d')) ?>
	</div>
</div>
<div class="row mt-2">
	<div class="col-7 border border-dark text-center">
		<h3 style="font-family: monospace;">Rp. <?php echo rupiah($payment->pembayaran, 2) ?></h3>
	</div>
	<div class="col-5 text-center mt-3">
		<?php echo $payment->user ?>
	</div>
</div>
<div class="row mt-5">
	<div class="col-12 text-center">
		<button type="button" id="print" class="btn btn-primary" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
	</div>
</div>