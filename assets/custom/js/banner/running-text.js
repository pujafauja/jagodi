( function ( $ ) {

    "use strict";

    var base_url = $('#base_url').val();

    const getRunningText = (dataURL = base_url + 'banner/running-text-lists') => {
      $('#running-text-lists').html('<i class="fas fa-spin fa-circle-notch mr-1"></i>Loading, please wait ...')

      $('#running-text-lists').load(dataURL)
    }

    getRunningText()

    $(document).on('submit', '#running-text-form', function(e){
        e.preventDefault()

        let formData = $(this).serializeArray()

        $.ajax({
            url: $(this).attr('action'),
            type: 'post',
            data: formData,
            dataType: 'json',
            beforeSend: function() {
                $('.save-running-text').html('<i class="fas fa-spin fa-circle-notch mr-1"></i>Saving')
                $('.save-running-text').prop('disabled', true)
            },
            success: function (res) {
                $('.save-running-text').html('<i class="fe-save mr-1"></i>Save')
                $('.save-running-text').prop('disabled', false)

                if(res.status === 1) {
                    Swal.fire({
                      title: "Saved!",
                      text: "Your file has been saved.",
                      type: "success"
                    })

                    $('input[name="words"]').val('')

                    getRunningText()
                } else {
                  Swal.fire({
                      title: "Error!",
                      html: res.pesan,
                      type: "error",
                  })
                }
            }
        });
    })

})(jQuery)