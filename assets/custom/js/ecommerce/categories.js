( function ( $ ) {

    "use strict";

    var base_url = $('#base_url').val();

    $('.category-form').on('submit', function(e){
        e.preventDefault()

        let name = $(this).find('input[name="name"]').val()

        let ini = $(this)

        $.ajax({
            url: ini.attr('action'),
            type: 'post',
            dataType: 'json',
            data: ini.serializeArray(),
            beforeSend: function() {
                ini.find('button[type="submit"]').prop('disabled', true)
            },
            success: function() {
                window.location.href = base_url + 'ecommerce/categories'
            }
        })
    })

    $(document).on('click', '.edit-category', function(e){
        e.preventDefault()

        let id = $(this).closest('.dd-item').data('id')

        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SaveCategory'>Save</button>";
        Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('.modal-dialog').removeClass('modal-lg')
        $('.modal-dialog').removeClass('modal-full-width')

        $('.modal-dialog').addClass('modal-sm')

        $('#ModalHeader').html('Edit Category')

        $('#ModalContent').load($(this).attr('href'))

        $('#ModalGue').modal('show')

        $('#ModalFooter').html(Tombol)
    })

    $(document).on('click', '#SaveCategory', function(e){
        e.preventDefault()

        $.ajax({
            url: $('#edit-category').attr('action'),
            type: 'post',
            dataType: 'json',
            data: $('#edit-category').serializeArray(),
            beforeSend: function() {
                $('#SaveCategory').prop('disabled', true)
            },
            success: function(result) {
                $('#SaveCategory').prop('disabled', false)

                if (result.status === 1) {
                    window.location.href = base_url + 'ecommerce/categories'
                } else {
                    Swal.fire({
                        title: 'Ooopss!',
                        html: result.pesan,
                        type: 'error'
                    })
                }
            }
        })
    })

    $(document).on('click', '.delete-category', function(e){
        e.preventDefault()

        var target = $(this).attr('href');
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
                    dataType: 'json',
                    success: function(s){
                        if(s.status == 1) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                type: "success",
                                showCancelButton: 0,
                                confirmButtonColor: "OK"
                            }).then(function(){
                              window.location.href = base_url + 'ecommerce/categories'
                            })
                        } else {
                            Swal.fire({
                                title: "Sorry!",
                                html: s.pesan,
                                type: "error"
                            })
                        }
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

})( jQuery )