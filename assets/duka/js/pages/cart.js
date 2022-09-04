( function( $ ) {

	'use strict'

	const base_url = $('#base_url').val()

	const initCart = () => {
		$.ajax({
			url: `${base_url}init-cart`,
			type: 'post',
			data: {},
			dataType: 'json',
			success: function (res) {
				let products = ''

        $.each(res.items, function(index, value){
        	const image = JSON.parse(value.images)

        	products += `<div class="cart__item d-flex justify-content-between align-items-center">
                              <div class="cart__inner d-flex">
                                  <div class="cart__thumb">
                                      <a href="${base_url}produk/${value.slug}">
                                          <img src="${base_url}media/products/sm/${image[0]}" alt="">
                                      </a>
                                  </div>
                                  <div class="cart__details">
                                      <h6><a href="${base_url}produk/${value.slug}">${value.nama}</a></h6>
                                      <div class="cart__price">
                                          <span>Rp ${value.subtotal}</span>
                                      </div>
                                  </div>
                              </div>
                              <div class="cart__del">
                                  <a href="#"><i class="fal fa-times"></i></a>
                              </div>
                          </div>`
        })

				$('span.count').html(res.totalItems)
				$('span.cart__grandtotal').html(res.subtotal)
				$('li .cart__title span').html(`(${res.totalItems}) Barang dalam keranjang`)
				$('.cart__mini li:nth-child(2)').html(products)
				$('.cart__sub-total').html(res.subtotal)
			}
		});
	}

	$('.currency').autoNumeric('init', {
		aSep: '.',
		aDec: ',',
		mDec: 0,
		aSign: 'Rp '
	})

	const hitungSubtotal = (row) => {
		const qty = row.closest('tr').find('.product__quantity').val(),
					price = row.closest('tr').find('.product-price .currency').autoNumeric('get'),
					discount = row.closest('tr').find('.product-discount .currency').autoNumeric('get'),
					harga = (price - discount) < 1 ? 0 : price - discount,
					subtotal = qty * price,
					prodID = row.closest('tr').find('.product-name').data('product')

		$.ajax({
			url: `${base_url}produk/update-cart`,
			data: {
				product: prodID,
				qty: qty,
				price: price,
				discount: discount,
				subtotal: subtotal
			},
			type: 'post',
			dataType: 'json',
			success: function(res){
				if(res.status != '1') {
					$.toast({
				    heading: 'Error',
				    text: res.pesan,
				    icon: 'error',
				    showHideTransition: 'slide',
					})
				} else {
					initCart()
				}
			}
		})

		row.closest('tr').find('.product-subtotal .currency').autoNumeric('set', qty * harga)

		hitungTotal()
	}

	const hitungTotal = () => {
		let total = 0;

		$('.product-subtotal .currency').each(function(){
			total += parseFloat($(this).autoNumeric('get'))
		})

		$('.total').autoNumeric('set', total)
	}

	$(document).on('click', '.remove-product', function(e){
		e.preventDefault()

		const row = $(this).closest('tr'),
					prodID = row.find('.product-name').data('product')

		Swal.fire({
		  title: "Apakah Anda yakin?",
		  text: "Data yang sudah dihapus tidak bisa dikembalikan!",
		  type: "warning",
		  showCancelButton: !0,
		  confirmButtonColor: "#3085d6",
		  cancelButtonColor: "#d33",
		  confirmButtonText: "Oke, Hapus saja!"
		}).then(function(t) {
      if(t.dismiss !== Swal.DismissReason.cancel)
      {
				$.ajax({
					url: `${base_url}carts/delete-product/${prodID}`,
					type: 'get',
					data: {},
					dataType: 'json',
					success: function (res) {
						if(res.status === 1) {
							row.remove()
							initCart()
						} else {
							$.toast({
								heading: 'Error',
								text: res.pesan,
								icon: 'error',
								showHideTransition: 'slide'
							})
						}
					}
				});
			}
		})
	})

	$(document).on('change, keyup', '.product__quantity', function(e){
		e.preventDefault()
		hitungSubtotal($(this))
	})

	$(document).on('click', '.qtybutton', function(e){
		e.preventDefault()
		hitungSubtotal($(this))
	})

})(jQuery)