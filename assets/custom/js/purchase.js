( function ( $ ) {

    "use strict";

    var base_url = $('#base_url').val();

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

    var retrieved = [];

    $(document).on('click', '.popup-supplier', function(e){
        e.preventDefault();

        var Tombol = "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

    	$('.modal-dialog').removeClass('modal-sm');
    	$('.modal-dialog').removeClass('modal-full-width');
    	$('.modal-dialog').addClass('modal-lg');

    	$('#ModalHeader').html('Select Supplier');

    	$('#ModalContent').load($(this).attr('href'));
    	$('#ModalGue').modal('show');
    	$('#ModalFooter').html(Tombol);
    })

    $(document).on('click', '.popup-item', function(e){
        e.preventDefault();

        var Tombol = "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

    	$('.modal-dialog').removeClass('modal-sm');
    	$('.modal-dialog').removeClass('modal-full-width');
    	$('.modal-dialog').addClass('modal-lg');

    	$('#ModalHeader').html('Select Sparepart');

    	$('#ModalContent').load($(this).attr('href'), {exists: retrieved});
    	$('#ModalGue').modal('show');
    	$('#ModalFooter').html(Tombol);
    })

    $('.cari-supplier').autocomplete({

        serviceUrl: base_url+"sparepart/supplier-autocomplete",
        showNoSuggestionNotice: 'Supplier tidak ditemukan!',
        onSelect: function(suggestion) {
            $('input[name="supplierid"]').val(suggestion.data);
            $('input[name="supplier"]').val(suggestion.value);
        },
        select: function(event, ui) {
            return true;
        }
    });

    function cekGrandTotalNonRecomm()
    {
    	var total = 0
    	$('.subtotal').each(function(index, el) {
    		total += toFloat($(this).text())
    	});
		$('.autonumber').autoNumeric('init')

    	$('#grandtotal').autoNumeric('set', total)
    }

    $(document).on('keyup', '.qty', function(event) {
    	event.preventDefault();
    	var row = $(this).closest('tr').find('td')
    	var price = row.eq(3).find('input').val()
    	var qty = toFloat($(this).val())
    	var result = price * qty
		$('.autonumber').autoNumeric('init')
    	row.eq(5).find('span.subtotal').autoNumeric('set', result)
    	cekGrandTotalNonRecomm()
    });

    $(document).on('click', '#choose', function(e){
    	e.preventDefault()

    	let barangid = $(this).data('id')
    	let kode = $(this).closest('tr').find('td').eq(0).text()
    	let nama = $(this).closest('tr').find('td').eq(1).text()
    	let price = $(this).closest('tr').find('td').eq(2).text()
    		price = toFloat(price)

		$('.po-detail tbody').append('<tr>\
				<td>\
					<div class="checkbox checkbox-single checkbox-primary">\
						<input type="checkbox" name="sparepartid['+barangid+']" value="'+barangid+'" class="" aria-label="Single checkbox One">\
						<label></label>\
					</div>\
				</td>\
				<td>'+kode+'</td>\
				<td>'+nama+'</td>\
				<td>Rp. <span data-a-sep="." data-a-dec="," data-m-dec="0" class="autonumber">'+price+'</span><input type="hidden" class="price" name="price['+barangid+']" value="'+price+'"></td>\
				<td>\
					<input type="text" class="form-control qty form-control-sm" data-a-sep="." data-a-dec="," data-m-dec="0" name="qty['+barangid+']" value="1">\
				</td>\
				<td>\
					Rp. <span data-a-sep="." data-a-dec="," data-m-dec="0" class="subtotal autonumber">'+price+'</span>\
				</td>\
			</tr>')

		$('.autonumber').autoNumeric('init')
		cekGrandTotalNonRecomm()
		retrieved.push(barangid)

		$(this).closest('tr').addClass('bg-warning')
		$(this).closest('tr').find('td').eq(2).find('a').prop('disabled', true)
		$(this).closest('tr').find('td').eq(2).find('a').text('Choosen')
		$(this).closest('tr').find('td').eq(2).find('a').removeClass('btn-info')
		$(this).closest('tr').find('td').eq(2).find('a').addClass('btn-danger')
    })

    $(document).on('change', 'select[name="abcid"]', function(){
    	$('.po-detail tbody tr').each(function(){
    		$(this).remove();
    	})
    })

    $(document).on('change', '.check-all', function(){
    	if($(this).prop('checked') == true)
    		$('.po-detail tbody tr input[type="checkbox"]').prop('checked', true)
    	else
    		$('.po-detail tbody tr input[type="checkbox"]').prop('checked', false)

    	pengecekkan()
    })

    function pengecekkan() {
		let totalCheckbox = $('.po-detail tbody tr input[type="checkbox"]').length
		let jmlChecked = 0

	    $('.po-detail tbody tr input[type="checkbox"]').each(function(){
	    	if($(this).prop('checked') == true)		    	
	    		jmlChecked += 1
	    })

	    if(jmlChecked == totalCheckbox && totalCheckbox > 0)
	    	$('.check-all').prop('checked', true)
	    else
	    	$('.check-all').prop('checked', false)


	    if(jmlChecked > 0)
	    	$('button[type="submit"]').prop('disabled', false)
	    else
	    	$('button[type="submit"]').prop('disabled', true)
	}

	pengecekkan();

	$(document).on('change', '.po-detail tbody tr input[type="checkbox"]', function(){
		pengecekkan()
	})

	$(document).on('click', 'button[type="submit"]', function(e){
		e.preventDefault();

		var back = $(this).data('back')

		$.ajax({
			url: $('#recommended-order').attr('action'),
			type: 'post',
			data: $('#recommended-order').serialize(),
			dataType: 'json',
			beforeSend: function()
			{
				$('input[type="submit"]').prop('disabled', true)
				$('input[type="submit"]').html('<i class="fas fa-circle-notch fa-spin mr-1"></i> Submitting')
			},
			success: function(result)
			{
				$('input[type="submit"]').prop('disabled', false)
				$('input[type="submit"]').html('<i class="mdi mdi-check mr-1"></i> Confirm')

				if(result.status == 1)
				{
					Swal.fire({
					    title: "Success!",
					    html: result.pesan,
					    type: "success"
					}).then(function(t) {
						window.open(
						    base_url + 'purchase/print-order/' + result.id + '?cetak=1',
						    'popUpWindow',
						    'height=567,width=793,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
                        window.location.href = base_url + 'stock/receive-summary';
		            })
				} else {
					Swal.fire({
					    title: "Error!",
					    html: result.pesan,
					    type: "error"
					})	
				}
			}
		})
	})

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

	function grandtotal()
	{
		let grandtotal = 0

		$('.po-detail tbody tr').each(function(){
			var sub = $(this).find('td').eq(9).text()
				sub = sub.replace('Rp ', '')
				sub = toFloat(sub)

			grandtotal += sub
		})

		$('.po-grandtotal').autoNumeric('set', grandtotal)
	}

	$(document).on('change', 'input[name="qty[]"]', function(){
		var qty   = $(this).val()
		var baris = $(this).closest('tr')
		var harga = baris.find('input[name="price[]"]').val()

		var subtotal = qty * harga

		baris.find('td').eq(9).html('<span class="autonumber" data-a-sep="." data-a-dec="," data-m-dec="0" data-a-sign="Rp ">' + subtotal + '</span>')
		$('.autonumber').autoNumeric('init')

		grandtotal()
	})

    $("#inline-editable").Tabledit({
        url: $('#recommended-order').attr('action'),
        inputClass: "form-control form-control-sm",
        editButton: !1,
        deleteButton: !1,
        columns: {
            identifier: [1, "id"],
            editable: [
                [8, "qty[]"],
            ]
        },
        onSuccess(data, textStatus, jqXHR) {
            $('input[name="qty[]"]').prop('disabled', false)
        },
    })

    $(document).on('click', '.retrieve-data', function(e){
    	let abcid = $('select[name="abcid"]').val();
    	$('.po-detail tbody tr').each(function(){
    		$(this).remove();
    	})

    	pengecekkan()

    	$.ajax({
    		url: base_url + 'sparepart/retrieve-abc-data/'+abcid,
    		dataType: 'json',
    		beforeSend: function(s)
    		{
    			$('.retrieve-data').prop('disabled', true);
    			$('.retrieve-data').html('<i class="fas fa-circle-notch fa-spin mr-1"></i> Retrieving')
    		},
    		success: function(result)
    		{
    			$('.retrieve-data').prop('disabled', false);
    			$('.retrieve-data').html('<i class="fas fa-search mr-1"></i>Retrieve')
    			if(result.status == 0)
    				$.NotificationApp.send("Sorry!", "Corresponding data doesn't exists", "top-right", "#bf441d", "error")
    			else
    			{
    				$.NotificationApp.send("Well Done!", result.found + " record(s) found", "top-right", "#5ba035", "success")

    				$.each(result.data, function(index, value){
    					if(value.total <= value.lower) {
    						let average = value.average
    						let total   = value.total
    							total   = parseInt(total)
    						let roq   = value.roq
    							roq   = parseFloat(roq)

    						if(value.average == null)
    							average = 0

							average = parseInt(average)

							let future = total + average
							let ROQ = roq * average
								ROQ = parseInt(ROQ)

	    					$('.po-detail tbody').append('<tr>\
	    							<td>\
	    								<div class="checkbox checkbox-single checkbox-primary">\
	            							<input type="checkbox" name="sparepartid[]" value="'+value.id+'" class="" aria-label="Single checkbox One">\
	            							<label></label>\
	            						</div>\
	    							</td>\
	    							<td>'+value.kode+'</td>\
	    							<td>'+value.nama+'</td>\
	    							<td>Rp. <span class="autonumber" data-a-sep="." data-a-dec="," data-m-dec="0">'+value.harga+'</span><input type="hidden" name="price[]" value="'+value.harga+'"></td>\
	    							<td>'+value.abc_code+'</td>\
	    							<td>'+average+'</td>\
	    							<td>'+future+'</td>\
	    							<td>'+ROQ+'</td>\
	    							<td>0</td>\
	    							<td>0</td>\
	    						</tr>')
	    				}
    				})

    				$("#inline-editable").Tabledit({
    					url: $('#recommended-order').attr('action'),
			            inputClass: "form-control form-control-sm",
			            editButton: !1,
			            deleteButton: !1,
			            columns: {
							identifier: [1, "id"],
			                editable: [
			                    [8, "qty[]"],
			                ]
			            },
		                onSuccess(data, textStatus, jqXHR) {
		                	$('input[name="qty[]"]').prop('disabled', false)
		                },
			        })
    				$('.autonumber').autoNumeric('init');
    			}
    		},
    	})
    })

} )( jQuery );