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
	   
       if($('button[type="submit"]').attr('id') == 'submit-retur' )
	    	$('button[type="submit"]').prop('disabled', false)
    }

    $(document).on('change', '.check-all', function(){
    	if($(this).prop('checked') == true)
    		$('.po-detail tbody tr input[type="checkbox"]').prop('checked', true)
    	else
    		$('.po-detail tbody tr input[type="checkbox"]').prop('checked', false)

    	pengecekkan()
    })

	pengecekkan();

	$(document).on('change', '.po-detail tbody tr input[type="checkbox"]', function(){
		pengecekkan()
	})

	var locations = []

	$.ajax({
		url: base_url + 'sparepart/location-ajax',
		dataType: 'json',
		success: function(l)
		{
			if(l.results > 0)
			{
                $.each(l.data, function(index, value){
                	locations.push({'id': value.id, 'nama': value.nama})
                })
			}
		}
	})

    console.log(locations)

	$(document).on('click', 'button[type="submit"]', function(e){
		e.preventDefault();
		console.log($('#receive').serializeArray())
		$.ajax({
			url: $('form#receive').attr('action'),
			type: 'post',
			data: $('#receive').serializeArray(),
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
                            base_url + 'purchase/print-order/' + result.id + '/1?cetak=1',
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

    $(document).on('click', '#plus-qty, #minus-qty', function(event) {
        event.preventDefault();
        var max = $(this).data('qty')

        var returQty = $(this).closest('div.input-group').find('input')
        var sisa = $(this).closest('tr').find('td').eq(7).find('input#remainder')

        var resultSisa = 0
        var resultRetur = 0

        if ($(this).attr('id') == 'plus-qty') {
            resultRetur = parseInt(returQty.val()) + 1
            resultSisa = parseInt(sisa.val()) - 1
        }else{
            resultRetur = parseInt(returQty.val()) - 1
            resultSisa = parseInt(sisa.val()) + 1
        }

        // console.log('retur ' + resultRetur)
        // console.log('sisa ' + resultSisa)
        // console.log('max ' + max)

        if ( (resultSisa >= 0) && (resultRetur <= max) ) {
            returQty.val(resultRetur)
            sisa.val(resultSisa)
        }

    });

	var exists = [];

	$(document).on('click', '.popup-po', function(e){
		e.preventDefault()

        var Tombol = "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

    	$('.modal-dialog').removeClass('modal-sm');
    	$('.modal-dialog').removeClass('modal-full-width');
    	$('.modal-dialog').addClass('modal-lg');

    	$('#ModalHeader').html('Select Purchase Order');

    	$('#ModalContent').load($(this).attr('href'), {exists: exists});
    	$('#ModalGue').modal('show');
    	$('#ModalFooter').html(Tombol);
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

    function ceksubtotal(row)
    {
        var qty = row.closest('tr').find('td').eq(7).find('input').val()
        var price = row.closest('tr').find('td').eq(8).find('input').val()
            price = toFloat(price)

        var subtotal = qty * price
        row.closest('tr').find('td').eq(10).find('span').autoNumeric('set', subtotal)
        cekgrandtotal()
    }

    function cekgrandtotal() 
    {
        var grandtotal = 0
        $('.subtotal-receive').each(function(index, el) {
            grandtotal += toFloat($(this).text())
        });   

        $('#grandtotal-receive').autoNumeric('set', grandtotal)
    }
    $(document).on('keyup', '.receive-qty', function(e) { ceksubtotal($(this)) })
    $(document).on('keyup', '.receive-price', function(e) { ceksubtotal($(this)) })
    $(document).on('click', '#retrieve-ini', function(e){
        e.preventDefault()

        var id = $(this).data("id")
        var baris = $(this).closest('tr')

        $.ajax({
            url: base_url + 'purchase/po-detail/'+id,
            dataType: 'json',
            beforeSend: function()
            {
                baris.find('#retrieve-ini').html('<i class="fas fa-circle-notch fa-spin mr-1"></i>Retrieving')
                baris.find('#retrieve-ini').prop('disabled', true)
            },
            success: function(responds)
            {
            	exists.push(responds.id)

                $('input[name=supplier]').val(responds.supplier)
                $('.start-purchase-date').val(responds.order_date_default)

                // baris.find('#retrieve-ini').prop('disabled', true)

                baris.addClass('bg-info')
                baris.addClass('text-light')
                baris.find('#retrieve-ini').html('<i class="fas fa-search mr-1"></i>Retrieved')

                $.each(responds.detail, function(index, value){

                    $('.po-detail tbody').prepend('<tr>\
                            <td>\
                                <div class="checkbox checkbox-single checkbox-primary">\
                                    <input type="checkbox" name="sparepartid['+responds.id +']['+ value.id+']" value="'+value.id+'" class="" aria-label="Single checkbox One">\
                                    <label></label>\
                                </div>\
                            </td>\
                            <td>'+value.kode+'</td>\
                            <td>'+value.nama+'</td>\
                            <td>'+value.abc+'</td>\
                            <td>'+responds.no+'<input type="hidden" name="poid['+responds.id +'][]" value="'+value.id+'"></td>\
                            <td>'+responds.order_date+'</td>\
                            <td>'+value.qty+'</td>\
                            <td>\
                                <input type="text" name="qty['+responds.id +']['+ value.id+']" class="form-control receive-qty form-control-sm" value="'+value.qty+'">\
                            </td>\
                            <td>\
                                <div class="input-group input-group-sm">\
                                    <div class="input-group-prepend">\
                                        <span class="input-group-text">Rp</span>\
                                    </div>\
                                    <input type="text" name="price['+responds.id +']['+ value.id+']" class="form-control receive-price form-control-sm autonumber" data-a-sep="." data-a-dec="," data-m-dec="2" value="'+value.price+'">\
                                </div>\
                            </td>\
                            <td>\
                            <select name="locationid['+responds.id +']['+ value.id+']" data-loaded="0" class="form-control form-control-sm">\
                            	<option value=""></option>\
                            </select>\
                            </td>\
                            <td>Rp. <span data-a-sep="." data-a-dec="," data-m-dec="2" class="autonumber subtotal-receive">'+value.qty * value.price+'</span></td>\
                        </tr>')

                })

                $('.po-detail tbody tr td select').each(function(){
                	var select = $(this)

            		if(select.data('loaded') != 1)
            		{
	                	$.each(locations, function(i, loc){
		                	select.append('<option value="'+loc.id+'">'+loc.nama+'</option>')
	                	})
	                	select.data('loaded', 1)
            		}
                })
                cekgrandtotal()
                $('.autonumber').autoNumeric('init')
            }
        })
    })

    $('.clear-supplier').on('click', function(e){
    	e.preventDefault()

    	$('.cari-supplier').val('')
    	$('input[name="supplierid"]').val('')
    })

    $('.retrieve-data').on('click', function(e){
    	e.preventDefault();

    	var startdate  = $('.start-purchase-date').val();
    	var enddate    = $('.end-purchase-date').val();
    	var supplierid = $('input[name="supplierid"]').val();

    	if(!startdate && !enddate && !supplierid)
    	{
    		Swal.fire({
    		    title: "Error!",
    		    html: 'Please fill Purchase Date or Supplier',
    		    type: "error"
    		})

    		return false
    	}

    	$.ajax(
    	{
    		url: base_url + 'purchase/retrieve-order',
    		data: {'startdate' : startdate, 'enddate' : enddate, 'supplierid' : supplierid, 'exists': exists},
    		type: 'post',
    		dataType: 'json',
    		beforeSend: function()
    		{
    			$('.retrieve-data').prop('disabled', true)
    			$('.retrieve-data').html('<i class="fas fa-circle-notch fa-spin mr-1"></i>Retrieving')
    		},
    		success: function(respond)
    		{
    			$('.retrieve-data').prop('disabled', false)
    			$('.retrieve-data').html('<i class="fas fa-search mr-1"></i>Retrieve')

    			if(respond.results == 0)
    				$.NotificationApp.send("Sorry!", "Corresponding data doesn't exists", "top-right", "#bf441d", "error")
    			else
    			{
    				$.NotificationApp.send("Well Done!", respond.results + " record(s) found", "top-right", "#5ba035", "success")

    				$.each(respond.data, function(index, summary){
		            	exists.push(summary.id)

	    				$.each(summary.detail, function(index, value){

	    				    $('.po-detail tbody').prepend('<tr>\
	    				            <td>\
	    				                <div class="checkbox checkbox-single checkbox-primary">\
	    				                    <input type="checkbox" name="sparepartid['+summary.id +'~'+ value.id+']" value="'+value.id+'" class="check-all" aria-label="Single checkbox One">\
	    				                    <label></label>\
	    				                </div>\
	    				            </td>\
	    				            <td>'+value.kode+'</td>\
	    				            <td>'+value.nama+'</td>\
	    				            <td>'+value.abc+'</td>\
	    				            <td>'+summary.no+'<input type="hidden" name="poid['+summary.id +'~'+ value.id+']" value="'+summary.id+'"></td>\
	    				            <td>'+summary.order_date+'</td>\
	    				            <td>'+value.qty+'</td>\
	    				            <td>\
	    				                <input type="text" name="qty['+summary.id +'~'+ value.id+']" class="form-control form-control-sm" value="'+value.qty+'">\
	    				            </td>\
	    				            <td>\
	    				                <div class="input-group input-group-sm">\
	    				                    <div class="input-group-prepend">\
	    				                        <span class="input-group-text">Rp</span>\
	    				                    </div>\
	    				                    <input type="text" name="price['+summary.id +'~'+ value.id+']" class="form-control form-control-sm autonumber" data-a-sep="." data-a-dec="," data-m-dec="2" value="'+value.price+'">\
	    				                </div>\
	    				            </td>\
	    				            <td>\
	    				            <select name="locationid['+summary.id +'~'+ value.id+']" data-loaded="0" class="form-control form-control-sm">\
	    				            	<option value=""></option>\
	    				            </select>\
	    				            </td>\
	    				        </tr>')

	    				})
    				})
				    $('.po-detail tbody tr td select').each(function(){
				    	var select = $(this)

				    	console.log(select.data('loaded'))
			    		if(select.data('loaded') != 1)
			    		{
					    	$.each(locations, function(i, loc){
	    				    	select.append('<option value="'+loc.id+'">'+loc.nama+'</option>')
	    				    })
					    	select.data('loaded', 1)
			    		}
				    	console.log(select.data('loaded'))
				    })

	                $('.autonumber').autoNumeric('init')
    			}
    		}
    	})
    })

    $(document).on('click', '.select-location', function(e){
    	e.preventDefault()

	    var Tombol = "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

		$('.modal-dialog').removeClass('modal-sm');
		$('.modal-dialog').removeClass('modal-full-width');
		$('.modal-dialog').addClass('modal-lg');

		$('#ModalHeader').html('Select Location');

		$('#ModalContent').load($(this).attr('href'));
		$('#ModalGue').modal('show');
		$('#ModalFooter').html(Tombol);
    })

    $(document).on('click', '.pilih-location', function(e){
    	e.preventDefault()

    	var nama = $(this).closest('tr').find('td').eq(0).text();
    	console.log(nama)
    	var id   = $(this).data('id');
    	console.log(id)

    	console.log($(this).closest('div.input-group').find('input.location').length)
    	$(this).closest('div.input-group').find('input.location').val(nama)
    	$(this).closest('div.input-group').find('input[name="locationid[]"]').val(id)

    	// $('#ModalGue').modal('hide');
    })

} )( jQuery );