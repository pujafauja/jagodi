(function ($) {
	'use strict';

    let base_url = $('#base_url').val()

    $('#article-content').html('<div><i class="fas fa-spin fa-circle-notch mr-1"></i>Please wait ...</div>')

    $('#article-content').load(base_url + 'article/load-article/1', {
        additionalFilter: $('input[name="additional-filter"]').val()
    })

    $(document).on('click', '.handle-pagination', function(e){
        e.preventDefault()

        let DestinationPage = $(this).data('page')

        $('#article-content').load(base_url + 'article/load-article/' + DestinationPage, {
            additionalFilter: $('input[name="additional-filter"]').val()
        })
    })
})(jQuery)