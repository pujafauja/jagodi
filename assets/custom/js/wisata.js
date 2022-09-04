( function ( $ ) {
    "use strict";

    var base_url = $('#base_url').val();

	$('.update-status').on('change', function(e){
		var switchInput = $(this);
		var status = switchInput.val();
		var newstat = '';
		var id = switchInput.data('id');

		if(status == 0)
			newstat = 1;
		else
			newstat = 0;

		$.ajax({
			url: base_url + '/wisata/setstatus',
			type: 'post',
			data: {id: id, newstat: newstat},
			success: function(s) {
				switchInput.val(newstat);
			}
		})
	})
} )( jQuery );
