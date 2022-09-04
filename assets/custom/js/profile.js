( function ( $ ) {

    "use strict";

    var base_url = $('#base_url').val();

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $(input).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $(':file').on('change', function(e){
        e.preventDefault();

        $('.progress-bar').attr('aria-valuenow', 0).css('width', 0 + '%').text(0 + '%');

        var input = this;

        var avatar = this.files[0];

        var form = new FormData();
        form.append('avatar', avatar);

        console.log($('#upload-avatar').attr('action'));

        $.ajax({
            // Your server script to process the upload
            url: $('#upload-avatar').attr('action'),
            type: 'POST',
            dataType: 'JSON',

            // Form data
            data: form,

            // Tell jQuery not to process data or worry about content-type
            // You *must* include these options!
            cache: false,
            contentType: false,
            processData: false,

            // Custom XMLHttpRequest
            xhr : function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function(e){
                    if(e.lengthComputable){                        
                        var percent = Math.round((e.loaded / e.total) * 100);

                        $('.progress').removeClass('d-none');

                        $('.progress-bar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
                    }
                });
                return xhr;
            },
            success: function(r){
                if(r.status == 1) {
                    Swal.fire({
                        title: "Updated!",
                        text: "Your avatar has been changed",
                        type: "success"
                    })
                    window.location.href = base_url + 'user/profile';
                } else {
                    Swal.fire({
                        title: "Ooopss!",
                        html: r.pesan,
                        type: "error"
                    })
                }

                $('.progress').addClass('d-none');
                $('.progress-bar').attr('aria-valuenow', 0).css('width', 0 + '%').text(0 + '%');
            }
        })
    })

    $('#form-profile').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: 'post',
            dataType: 'json',
            beforeSend: function()
            {
                $('#save-profile').html('<i class="fas fa-spinner fa-spin"></i> Saving');
                $('#save-profile').prop('disabled', true);
            },
            success: function(s)
            {
                $('#save-profile').prop('disabled', false);
                $('#save-profile').html('<i class="mdi mdi-content-save"></i> Save');

                if(s.status === 1)
                {
                    Swal.fire({
                        title: "Updated!",
                        text: "Your data has been updated. Your account will change after you refresh this page.",
                        type: "success"
                    })
                }
                else if(s.status === '0')
                {
                    Swal.fire({
                        title: "Error!",
                        text: s.pesan,
                        type: "success"
                    })
                }
                else
                {
                    $('#response').html(s.pesan);
                }
            }
        })
    })

} )( jQuery );