( function ( $ ) {

    "use strict";

    var base_url = $('#base_url').val();

    $('#form-team').on('submit', (e) => {
        e.preventDefault()

        let data = new FormData($('#form-team')[0])

        $.ajax({
            url: base_url + 'about-us/save-team',
            type: 'POST',
            cache: false,
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            beforeSend: () => {
                $('.publish-team').prop('disabled', true)
                $('.publish-team').html('<i class="fas fa-spinner mr-1"></i>Publishing ...')
            },
            success: (result) => {                
                if(result.status === true) {
                    Swal.fire({
                        title: "Success!",
                        html: result.pesan,
                        type: "success"
                    })

                    $('input[name="id"]').val('')
                    $('input[name="nama"]').val('')
                    $('input[name="position"]').val('')
                    $('input[name="facebook"]').val('')
                    $('input[name="twitter"]').val('')
                    $('input[name="instagram"]').val('')
                    $('input[name="linkedin"]').val('')
                    $('textarea[name="bio"]').val('')
                    $('textarea[name="bioINA"]').val('')

                    $('#add-team').modal('hide')

                    $('.team-members').html('<h4><i class="fas fa-spin fa-circle-notch mr-1 text-primary"></i>Please wait ...</h4>')

                    $('.team-members').load(base_url + 'about-us/team-member')
                } else {
                    Swal.fire({
                        title: "Error!",
                        html: result.pesan,
                        type: "error"
                    })
                }
                $('.publish-team').prop('disabled', false)
                $('.publish-team').html('<i class="fe-upload-cloud mr-1"></i>Publish')
            }
        })
    })

    $(document).on('click', '.edit-team', function(e) {
        e.preventDefault()

        $.ajax({
            url: $(this).data('url'),
            dataType: 'json',
            beforeSend: () => {
                $(this).prop('disabled', true)
                $(this).html('<i class="fas fa-spin fa-circle-notch"></i>')
            },
            success: (result) => {
                if(result.status === true) {
                    $('.dropify-preview').css('display', 'block')
                    $('.dropify-clear').css('display', 'block')
                    $('input[name="picture"]').attr('data-default-file', base_url + 'media/team/' + result.picture)
                    $('.dropify-render').html('<img src="'+base_url + 'media/team/' + result.picture+'" style="max-height: 150px;">')
                    $('input[name="id"]').val(result.id)
                    $('input[name="nama"]').val(result.nama)
                    $('input[name="position"]').val(result.position)
                    $('input[name="facebook"]').val(result.facebook)
                    $('input[name="twitter"]').val(result.twitter)
                    $('input[name="instagram"]').val(result.instagram)
                    $('input[name="linkedin"]').val(result.linkedin)
                    $('textarea[name="bio"]').val(result.bio)
                    $('textarea[name="bioINA"]').val(result.bioINA)

                    $('#add-team').modal('show')
                }
                
                $(this).prop('disabled', false)
                $(this).html('<i class="fe-edit"></i>')
            }
        })
    })

    $('#add-team').on('hidden.bs.modal', () => {
        $('.dropify-preview').css('display', 'none')
        $('.dropify-clear').css('display', 'none')
        $('input[name="picture"]').attr('data-default-file', '')
        $('.dropify-render').html('')

        $('input[name="id"]').val('')
        $('input[name="nama"]').val('')
        $('input[name="position"]').val('')
        $('input[name="facebook"]').val('')
        $('input[name="twitter"]').val('')
        $('input[name="instagram"]').val('')
        $('input[name="linkedin"]').val('')
        $('textarea[name="bio"]').val('')
        $('textarea[name="bioINA"]').val('')
    })

    $('.team-members').html('<h4><i class="fas fa-spin fa-circle-notch mr-1 text-primary"></i>Please wait ...</h4>')

    $('.team-members').load(base_url + 'about-us/team-member')

    $(document).on('click', '.delete-team', function(e) {
        let target = $(this).data('url')
        
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then(function(t) {
            if(t.dismiss !== Swal.DismissReason.cancel) {
                $.ajax({
                    url: target,
                    dataType: 'json',
                    success: function(s){
                        if(s.status == true) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                type: "success"
                            })

                            $('.team-members').html('<h4><i class="fas fa-spin fa-circle-notch mr-1 text-primary"></i>Please wait ...</h4>')
                        
                            $('.team-members').load(base_url + 'about-us/team-member')
    
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

}) ( jQuery ), 0 < $('[data-plugins="dropify"]').length && $('[data-plugins="dropify"]').dropify({
    messages: {
        default: "Drag and drop a file here or click",
        replace: "Drag and drop or click to replace",
        remove: "Remove",
        error: "Ooops, something wrong appended."
    },
    error: {
        fileSize: "The file size is too big (1M max)."
    }
});