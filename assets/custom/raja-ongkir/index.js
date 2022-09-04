// (function ( $ ) {
// 	'use strict'

	const accountType = 'starter',
				apiKey = 'd9cd23a499e45d6526f2337f6e1dc137',
				uri = `https://api.rajaongkir.com/${accountType}`

	const getProvince = (provID = false) => {
		$.ajax({
			url: `${uri}/province`,
			type: 'get',
			dataType: 'json',
			data: {
				key: apiKey
			},
			crossDomain: true,
			xhrFields: {
				'withCredentials': true // tell the client to send the cookies if any for the requested domain
			},
			// jsonp: 'rajaongkir'
			success: function(res) {
				respond = JSON.stringify(res)
				console.log(res, respond)
			}
		})
	}
// })( jQuery )