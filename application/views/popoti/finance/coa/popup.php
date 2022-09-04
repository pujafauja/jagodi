<style type="text/css" href="<?php echo base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css'); ?>"></style>
<style type="text/css" href="<?php echo base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'); ?>"></style>
<style type="text/css" href="<?php echo base_url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'); ?>"></style>
<style type="text/css" href="<?php echo base_url('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css'); ?>"></style>

<link href="<?php echo base_url('assets/libs/jquery-toast-plugin/jquery.toast.min.css') ?>" rel="stylesheet" type="text/css" />

<div class="row">
	<div class="col-12">
		<table class="table table-striped table-sm" id="coa-popup">
			<thead>
				<tr>
					<th>Code</th>
					<th>Account Name</th>
					<th>Select</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if($coa->num_rows()):
					foreach($coa->result() as $c): ?>
						<tr>
							<td><strong><?php echo $c->kode ?></strong></td>
							<td><strong><?php echo $c->nama ?></strong></td>
							<td></td>
						</tr>
						<?php echo nestedPopCOA(ordered_menu(json_decode($c->coa, true))) ?>
					<?php endforeach;
				endif;
				?>
			</tbody>
		</table>
	</div>
</div>

<script src="<?php echo base_url('assets/libs/datatables.net/js/jquery.dataTables.min.js'); ?>" type="text/javascript" charset="utf-8" async defer></script>
<script src="<?php echo base_url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js'); ?>" type="text/javascript" charset="utf-8" async defer></script>
<script src="<?php echo base_url('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js'); ?>" type="text/javascript" charset="utf-8" async defer></script>
<script src="<?php echo base_url('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js'); ?>" type="text/javascript" charset="utf-8" async defer></script>
<script src="<?php echo base_url('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js'); ?>" type="text/javascript" charset="utf-8" async defer></script>
<script src="<?php echo base_url('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js'); ?>" type="text/javascript" charset="utf-8" async defer></script>
<script src="<?php echo base_url('assets/libs/datatables.net-buttons/js/buttons.html5.min.js'); ?>" type="text/javascript" charset="utf-8" async defer></script>
<script src="<?php echo base_url('assets/libs/datatables.net-buttons/js/buttons.flash.min.js'); ?>" type="text/javascript" charset="utf-8" async defer></script>
<script src="<?php echo base_url('assets/libs/datatables.net-buttons/js/buttons.print.min.js'); ?>" type="text/javascript" charset="utf-8" async defer></script>
<script src="<?php echo base_url('assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js'); ?>" type="text/javascript" charset="utf-8" async defer></script>
<script src="<?php echo base_url('assets/libs/datatables.net-select/js/dataTables.select.min.js'); ?>" type="text/javascript" charset="utf-8" async defer></script>
<script src="<?php echo base_url('assets/libs/pdfmake/build/pdfmake.min.js'); ?>" type="text/javascript" charset="utf-8" async defer></script>
<script src="<?php echo base_url('assets/libs/pdfmake/build/vfs_fonts.js'); ?>" type="text/javascript" charset="utf-8" async defer></script>

<script src="<?php echo base_url('assets/libs/jquery-toast-plugin/jquery.toast.min.js') ?>"></script>

<script type="text/javascript" async defer>
	(function ($) {
		$('#coa-popup').DataTable();

		function t() {}
		t.prototype.send = function(t, i, o, e, n, a, s, r) {
		    var c = {
		        heading: t,
		        text: i,
		        position: o,
		        loaderBg: e,
		        icon: n,
		        hideAfter: a = a || 3e3,
		        stack: s = s || 1
		    };
		    r && (c.showHideTransition = r), $.toast().reset("all"), $.toast(c)
		}, $.NotificationApp = new t, $.NotificationApp.Constructor = t

		$(document).on('click', '.select-this', function(e){
		    e.preventDefault()

			$(document).off('click', '.select-this')

		    var button = $(this)

		    $('input#<?php echo $target ?>').val($(this).data('value'))

		    $.ajax({
		    	url: '<?php echo base_url('finance/coa-popup') ?>',
		    	type: 'post',
		    	data: {coaid: $(this).data('id'), source: '<?php echo $target ?>'},
		    	dataType: 'json',
		    	beforeSend: function(b) {
		    		button.html('<i class="fas fa-circle-notch fa-spin mr-1"></i>Saving')
		    		button.prop('disable', true)
		    	},
		    	success: function(s) {
    				$.NotificationApp.send("Well Done!", "Data has been saved", "top-right", "#5ba035", "success")

				    $('#ModalGue').modal('hide')
		    	}
		    })

		})

	}) (jQuery)
</script>