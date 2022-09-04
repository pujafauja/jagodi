( function ( $ ) {
	"use strict"

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

        	products += `<div class="cart__item d-flex justify-content-between align-items-center" data-product="${value.productid}">
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
                                  <a href="" class="delete-cart"><i class="fal fa-times"></i></a>
                              </div>
                          </div>`
        })

				$('span.count').html(res.totalItems)
				$('span.cart__grandtotal').html(res.subtotal)
				$('li .cart__title span').html(`(${res.totalItems}) Barang dalam keranjang`)
				$('.cart__mini li:nth-child(2)').html(products)
				$('.cart__sub-total').html(res.subtotal)

				if(res.totalItems > 0) {
					$('.wc-checkout').show()
				} else {
					$('.wc-checkout').hide()
				}
			}
		});
	}

	initCart()

	const register = () => {
		const data = $('#register').serializeArray(),
					button = $('.register-btn'),
					buttonText = button.html()

		$.ajax({
			url: `${base_url}home/register`,
			type: 'post',
			data: data,
			beforeSend: function() {
				button.prop('disabled', true)
				button.html('<i class="fas fa-spin fa-circle-notch mr-3"></i>Sedang Menyimpan')
			},
			success: function (res) {
				button.prop('disabled', false)
				button.html(buttonText)

				if(res.status === 1) {
					Swal.fire({
						title: 'Berhasil',
						text: res.pesan,
						type: 'success',
            showCancelButton: 0,
            confirmButtonColor: "OK"
					}).then(function(t) {
            window.location.href = base_url + 'account'
					})
				} else {
					Swal.fire({
						title: 'Error',
						html: res.pesan,
						type: 'error'
					})
				}
			}
		});
	}

	$(document).on('click', '.register-btn', function(e){
		e.preventDefault()

		register()
	})

	$(document).on('submit', '#register', function(e){
		e.preventDefault()

		register()
	})

	const login = () => {
		const data = $('#login').serializeArray(),
					button = $('.login-btn'),
					buttonText = button.html()

		$.ajax({
			url: `${base_url}home/login`,
			type: 'post',
			data: data,
			dataType: 'json',
			beforeSend: function() {
				button.prop('disabled', true)
				button.html('<i class="fas fa-spin fa-circle-notch mr-3"></i>Logging in')
			},
			success: function (res) {
				button.prop('disabled', false)
				button.html(buttonText)

				if(res.status === 1) {
					Swal.fire({
						title: 'Berhasil',
						html: res.pesan,
						type: 'success',
            showCancelButton: 0,
            confirmButtonColor: "OK"
					}).then(function(t) {
            window.location.href = base_url
					})
				} else {
					Swal.fire({
						title: 'Error',
						html: res.pesan,
						type: 'error'
					})
				}
			}
		});
	}

	$(document).on('click', '.login-btn', function(e){
		e.preventDefault()

		login()
	})

	$(document).on('submit', '#login', function(e){
		e.preventDefault()

		login()
	})

	const getStock = (prodID, size) => {
		$('#stok-produk').html('<i class="fas fa-spin fa-circle-notch"></i>')

		$.ajax({
			url: `${base_url}produk/get-stok/${prodID}/${size}`,
			success: function(res) {
				$('#stok-produk').html(res)

				if (!res || isNaN(res) || res <= 0) {
					$('.add-to-cart').prop('disabled', true)
				} else {
					$('.add-to-cart').prop('disabled', false)					
				}
			}
		})
	}

	$(document).on('click', '.add-to-cart', function(e){
		e.preventDefault()

		const prodID = $(this).data('product'),
					price = $(this).data('price'),
					size = $('select[name="size"]').val(),
					qty = $('.qty').val(),
					button = $(this),
					buttonText = button.text()

		let addItems = []

		const pushToAry = (name, val) => {
		   var obj = {};
		   obj[name] = val;
		   addItems.push(obj);
		}

		if ($('.additional-items').length > 0) {
			$('.additional-items').each(function(){
				pushToAry($(this).attr('name'), $(this).val())
			})
		}

		let prodData = {
			product: prodID,
			size: size,
			qty: qty,
			addItems: addItems
		}

		$.ajax({
			url: `${base_url}produk/add-to-cart`,
			data: prodData,
			dataType: 'json',
			type: 'post',
			beforeSend: function(){
				button.prop('disabled', true)
				button.html('Loading ...')
			},
			success: function(res){
				button.prop('disabled', false)
				button.html(buttonText)

				let icon = 'success',
						heading = 'Berhasil'

				if (res.status != 1) {
					icon    = 'error'
					heading = 'Error'
				}

				initCart()

				$.toast({
			    heading: heading,
			    html: res.pesan,
			    icon: icon,
			    showHideTransition: 'slide',
				})
			}
		})
	})

	$(document).on('click', '.view-product-modal', function(e) {
		e.preventDefault()

		const href = $(this).attr('href')

		$('#CustomModal').modal('show')
		$('#ModalContent').load(`${href}`, function(){
			$(".cart-plus-minus").append('<div class="dec qtybutton">-</div><div class="inc qtybutton">+</div>');
			$(".qtybutton").on("click", function () {
				var $button = $(this);
				var oldValue = $button.parent().find("input").val();
				if ($button.text() == "+") {
					var newVal = parseFloat(oldValue) + 1;
				} else {
					// Don't allow decrementing below zero
					if (oldValue > 0) {
						var newVal = parseFloat(oldValue) - 1;
					} else {
						newVal = 0;
					}
				}
				$button.parent().find("input").val(newVal);
			});

			const size = $('select[name="size"]').val(),
						prodID = $('#produk-id').val()

			getStock(prodID, size)

			$(document).on('change', 'select[name="size"]', function(e){
				e.preventDefault()

				const size = $(this).val(),
							prodID = $('#produk-id').val()

				getStock(prodID, size)
			})
		})
	})

	$(document).on('click', '.delete-cart', function(e){
		e.preventDefault()

		const row = $(this).closest('.cart__item'),
					prodID = row.data('product')

					console.log(prodID)

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

	const size = $('select[name="size"]').val(),
				prodID = $('#produk-id').val()

	if(size && prodID)
		getStock(prodID, size)

	$(document).on('change', 'select[name="size"]', function(e){
		e.preventDefault()

		const size = $(this).val(),
					prodID = $('#produk-id').val()

		getStock(prodID, size)
	})

	$('#CustomModal').on('hidden.bs.modal', function(){
		$('#ModalContent').html('')
	})
})( jQuery )