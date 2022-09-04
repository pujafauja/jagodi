( function ( $ ) {

    "use strict";

    var base_url = $('#base_url').val();

    $('.publish-about').on('click', (e) => {
        e.preventDefault()

        let shortAboutEN = $('#short-about-en').summernote('code')
        let shortAboutINA = $('#short-about-ina').summernote('code')
        let aboutEN = $('#about-en').summernote('code')
        let aboutINA = $('#about-ina').summernote('code')

        let formData = new FormData($('#myAwesomeDropzone')[0])

        formData.append('short-about-en', shortAboutEN)
        formData.append('short-about-ina', shortAboutINA)
        formData.append('about-en', aboutEN)
        formData.append('about-ina', aboutINA)

        $.ajax({
            url: base_url + 'about-us/save',
            type: 'POST',
            cache: false,
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            beforeSend: () => {
                $('.publish-about').prop('disabled', true)
                $('.publish-about').html('<i class="fas fa-spinner mr-1"></i>Publishing ...')
            },
            success: (result) => {
                if(result.status === true) {
                    Swal.fire({
                        title: "Success!",
                        html: result.pesan,
                        type: "success"
                    })
                } else {
                    Swal.fire({
                        title: "Error!",
                        html: result.pesan,
                        type: "error"
                    })
                }
                $('.publish-about').prop('disabled', false)
                $('.publish-about').html('<i class="fe-upload-cloud mr-1"></i>Publish')
            }
        })
    })

    $('.publish-visimisi').on('click', (e) => {
        e.preventDefault()

        let visimisiEN = $('#visimisi-en').summernote('code')
        let visimisiINA = $('#visimisi-ina').summernote('code')

        let data = {
            'visimisi-en': visimisiEN,
            'visimisi-ina': visimisiINA
        }

        $.ajax({
            url: base_url + 'about-us/save-visi-misi',
            type: 'POST',
            data: data,
            dataType: 'json',
            beforeSend: function() {
                $('.publish-visimisi').prop('disabled', true)
                $('.publish-visimisi').html('<i class="fas fa-spinner mr-1"></i>Publishing ...')
            },
            success: function(result) {
                if(result.status === true) {
                    Swal.fire({
                        title: "Success!",
                        html: result.pesan,
                        type: "success"
                    })
                } else {
                    Swal.fire({
                        title: "Error!",
                        html: result.pesan,
                        type: "error"
                    })
                }
                $('.publish-visimisi').prop('disabled', false)
                $('.publish-visimisi').html('<i class="fe-upload-cloud mr-1"></i>Publish')
            }
        })
    })

    $('.publish-history').on('click', (e) => {
        e.preventDefault()

        let historyEN = $('#history-en').summernote('code')
        let historyINA = $('#history-ina').summernote('code')

        let data = {
            'history-en': historyEN,
            'history-ina': historyINA
        }

        $.ajax({
            url: base_url + 'about-us/save-history',
            type: 'POST',
            data: data,
            dataType: 'json',
            beforeSend: function() {
                $('.publish-history').prop('disabled', true)
                $('.publish-history').html('<i class="fas fa-spinner mr-1"></i>Publishing ...')
            },
            success: function(result) {
                if(result.status === true) {
                    Swal.fire({
                        title: "Success!",
                        html: result.pesan,
                        type: "success"
                    })
                } else {
                    Swal.fire({
                        title: "Error!",
                        html: result.pesan,
                        type: "error"
                    })
                }
                $('.publish-history').prop('disabled', false)
                $('.publish-history').html('<i class="fe-upload-cloud mr-1"></i>Publish')
            }
        })
    })
}) ( jQuery )