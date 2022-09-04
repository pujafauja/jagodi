( function( $ ) {
	'use strict'

	const base_url = $('#base_url').val()

	getProvince();

	$(document).on('click', '.buat-pesanan', function(e){
		e.preventDefault()

		const country = 'Indonesia',
					namaDepan = $(`input[name="nama-depan"]`).val(),
					namaBelakang = $(`input[name="nama-belakang"]`).val(),
					namaPerusahaan = $(`input[name="nama-perusahaan"]`).val(),
					alamat = $(`input[name="alamat-rumah"]`).val(),
					alamat2 = $(`input[name="alamat-rumah2"]`).val(),
					kabupaten = $(`input[name="kabupaten-kota"]`).val(),
					provinsi = $(`input[name="provinsi"]`).val(),
					kode = $(`input[name="kode-pos"]`).val(),
					email = $(`input[name="email"]`).val(),
					hp = $(`input[name="hp"]`).val(),
					catatan = $(`textarea[name="catatan"]`).val(),
					pembelianNo = $('.order-no span').text()

		const data = {
			country: country,
			namaDepan: namaDepan,
			namaBelakang: namaBelakang,
			namaPerusahaan: namaPerusahaan,
			alamat: alamat,
			alamat2: alamat2,
			kabupaten: kabupaten,
			provinsi: provinsi,
			kode: kode,
			email: email,
			hp: hp,
			catatan: catatan,
			pembelianNo: pembelianNo
		}

		$.ajax({
			url: `${base_url}checkout`,
			type: 'post',
			dataType: 'json',
			data: data,
			beforeSend: function() {
				$('.buat-pesanan').prop('disabled', true)
				$('.buat-pesanan').html('Buat Pesanan <i class="fas fa-spin fa-spinner ml-10"></i>')
			},
			success: function(res) {
				$('.buat-pesanan').prop('disabled', false)
				$('.buat-pesanan').html('Buat Pesanan')

				if(res.status == 1) {
					Swal.fire({
					    title: "Berhasil!",
					    text: res.pesan,
					    type: "success",
					    showCancelButton: 0,
					    confirmButtonColor: "OK"
					}).then(function(){
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
		})
	})

})(jQuery)