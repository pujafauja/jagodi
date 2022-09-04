( function ( $ ) {
	'use strict'

	const base_url = $('#base_url').val()

	const getUrlVars = () =>
	{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
      hash = hashes[i].split('=');
      vars.push(hash[0]);
      vars[hash[0]] = hash[1];
    }
    return vars;
	}

	const uriSegment = window.location.href.substring(window.location.href.lastIndexOf('/') + 1)

	const initShop = (target = `${base_url}produk/shop-products`) => {
		$('#productGridTabContent').html(`<div class="alert alert-info text-center"><i class="fas fa-spin fa-spinner mr-10"></i>Sedang mengambil data ...</div>`)

		let kategoriid = new Array(),
			sizes      = new Array()

		const perPage = $('#perPage').val()

		$(`input[name="cat-item"]:checked`).each(function(){
			kategoriid.push($(this).val())
		})

		$(`input[name="choose-item"]:checked`).each(function(){
			sizes.push($(this).val())
		})

		$('#productGridTabContent').load(target, {
			kategoriid: kategoriid,
			sizes: sizes,
			perPage: perPage,
			s: getUrlVars().s,
			kategori: getUrlVars().kategori,
			segment: uriSegment
		})
	}

	initShop()

	$(document).on('click', `input[name="cat-item"]`, function(e){
		initShop()
	})

	$(document).on('click', `input[name="choose-item"]`, function(e){
		initShop()
	})

	$(document).on('change', '#perPage', function(){
		initShop()
	})

	$(document).on('click', '.basic-pagination nav ul li a', function(e){
		e.preventDefault()

		initShop()
	})

})( jQuery )