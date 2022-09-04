( function ($) {

	'use strict'

	var base_url = $('#base_url').val()

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

	$(document).on('click', '.submit-memo', function(e){
		e.preventDefault()

		var tombol = $(this)

		var FormData = $('.card-body').find('input, select, textarea').serialize()

		$.ajax({
			url:      base_url + 'utilities/memorandum',
			type:     'post',
			dataType: 'json',
			data:     FormData,			
			beforeSend: function(b) {
				tombol.prop('disabled', true)
				tombol.html('<i class="fas fa-circle-notch fa-spin mr-1"></i>Saving')
			},
			success: function (result) {
				tombol.prop('disabled', false)
				tombol.html('<i class="mdi mdi-check mr-1"></i>Save')
				if(result.status == 1) {
					Swal.fire({
						title: 'Success',
						text: result.pesan,
						type: 'success'
					}).then(function(r){
						window.location.href = base_url + 'utilities/memorandum'
					})
				} else {
					Swal.fire({
						title: 'Oooppsss!',
						html: result.pesan,
						type: 'error'
					})
				}
			}
		});
	})

}) (jQuery)