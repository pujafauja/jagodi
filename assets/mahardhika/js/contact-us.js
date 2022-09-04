(function ($) {
	'use strict';

    let base_url = $('#base_url').val()

    $('#contact').on('submit', function(e){
        e.preventDefault()

        let data = $(this).serializeArray()
        let target = $(this).attr('action')

        $.ajax({
            url: target,
            data: data,
            type: 'post',
            dataType: 'json',
            beforeSend: function() {
                $('button[type="submit"]').prop('disabled', true)
                $('button[type="submit"]').html('Sending ...')
            },
            success: function(respond) {
                $('button[type="submit"]').prop('disabled', false)
                if(respond.status === 1) {
                    $('button[type="submit"]').html('Message Sent')
                    $('#respond').html('<div class="alert alert-success">'+respond.pesan+'</div>')
                }
                else {
                    $('button[type="submit"]').html('Message Not Sent')
                    $('#respond').html('<div class="alert alert-danger">'+respond.pesan+'</div>')
                }



                setTimeout(function(){
                    $('button[type="submit"]').html('Send Message')
                }, 3000);
            }
        })
    })
})(jQuery)