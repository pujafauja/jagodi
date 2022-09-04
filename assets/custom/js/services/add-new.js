( function ( $ ) {

    "use strict";

    var base_url = $('#base_url').val();
    
    $(".summernote").summernote({
        placeholder:"Write something...",
        height:230,
    })

    $('.publish-services').on('click', (e) => {
        e.preventDefault()

        let data = $('#contextual').serializeArray(),
            formData = new FormData($('#myAwesomeDropzone')[0])
        
        data.forEach(p => {
            formData.append(p.name, p.value)
        });

        formData.append('content-en', $('#content-en').summernote('code'))
        formData.append('content-ina', $('#content-ina').summernote('code'))

        $.ajax({
            url: base_url + 'services/save',
            type: 'POST',
            cache: false,
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            beforeSend: () => {
                $('.publish-services').prop('disabled', true)
                $('.publish-services').html('<i class="fas fa-spinner mr-1"></i>Publishing ...')
            },
            success: (result) => {
                if(result.status === true) {
                    Swal.fire({
                        title: "Success!",
                        html: result.pesan,
                        type: "success"
                    })

                    window.location.href = base_url + 'services'
                } else {
                    Swal.fire({
                        title: "Error!",
                        html: result.pesan,
                        type: "error"
                    })
                }
                $('.publish-services').prop('disabled', false)
                $('.publish-services').html('<i class="fe-upload-cloud mr-1"></i>Publish')
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
        fileSize: "The file size is too big (3M max)."
    }
});