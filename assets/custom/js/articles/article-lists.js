( function ( $ ) {

    "use strict";

    let base_url = $('#base_url').val();

    $('.inbox-rightbar').html('<i class="fas fa-spin fa-circle-notch mr-1"></i>Please wait ...')
    
    $('.inbox-rightbar').load(base_url + 'articles/article-list')

    $('.list-group-item').on('click', function(e){
        e.preventDefault()

        $('.inbox-rightbar').html('<i class="fas fa-spin fa-circle-notch mr-1"></i>Please wait ...')
        
        $('.inbox-rightbar').load(base_url + 'articles/article-list')
    })

    $(document).on('click', '.hapus-article', function(e){
        e.preventDefault()

        var target = $(this).data('target');

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then(function(t) {
            if(t.dismiss !== Swal.DismissReason.cancel)
            {
                $.ajax({

                    url: target,

                    success: function(s){
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            type: "success"
                        }).then(function(result){
                            if (result.value) {
                                $('.inbox-rightbar').html('<i class="fas fa-spin fa-circle-notch mr-1"></i>Please wait ...')
                                
                                $('.inbox-rightbar').load(base_url + 'articles/article-list')
                            }
                        })
                    }
                })
            }
            else
            {
                Swal.fire({
                    title: "Cancelled",
                    text: "Your imaginary file is safe :)",
                    type: "error"
                })
            }
        })
    })
        
})(jQuery)