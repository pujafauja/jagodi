( function ( $ ) {
  "use strict"

  let base_url = $('#base_url').val()

  const getData = ( URl = base_url + 'banner/banner-lists' ) => {
    $('#banner-lists').html('<i class="fas fa-spin fa-circle-notch mr-1"></i>Loading, please wait ...')

    $('#banner-lists').load(URl)
  }

  getData()

  $(document).on('submit', '.new-banner', function(e){
    e.preventDefault()

    let formData = new FormData(this),
        target = $(this).attr('action')

    $.ajax({
      url: target,
      data: formData,
      type: 'post',
      dataType: 'json',
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function() {
        $('.save-banner').prop('disabled', true)
        $('.save-banner').html('<i class="fas fa-spin fa-circle-notch mr-1"></i>Saving, please wait')
      },
      success: function(res) {
        $('.save-banner').prop('disabled', false)
        $('.save-banner').html('Save')

        if(res.status === 1) {
          Swal.fire({
            title: "Saved!",
            text: "Your file has been saved.",
            type: "success",
          })

          $('select[name="position"]').val('')
          $('textarea[name="desc"]').val('')
          $('.dropify-clear').trigger('click')

          getData()
        }
        else {
          Swal.fire({
            title: "Error!",
            html: res.pesan,
            type: "error",
          })
        }
      }
    })
  })

  $(document).on('submit', '.edit-banner', function(e){
    e.preventDefault()

    let formData = new FormData(this),
        target = $(this).attr('action')

    $.ajax({
      url: target,
      data: formData,
      type: 'post',
      dataType: 'json',
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function() {
        $('.simpan-banner').prop('disabled', true)
        $('.simpan-banner').html('<i class="fas fa-spin fa-circle-notch mr-1"></i>Saving, please wait')
      },
      success: function(res) {
        $('.simpan-banner').prop('disabled', false)
        $('.simpan-banner').html('Save')

        if(res.status === 1) {
          Swal.fire({
            title: "Saved!",
            text: "Your file has been saved.",
            type: "success",
            showCancelButton: 0,
            confirmButtonColor: "OK"
          }).then(function(){
            window.location.href = base_url + 'banner'
          })
        }
        else {
          Swal.fire({
            title: "Error!",
            html: res.pesan,
            type: "error",
          })
        }
      }
    })
  })

  $(document).on('click', '.delete-banner', function(e){
    e.preventDefault()

    const target = $(this).attr('href')

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
                type: "success"
              })

              getData()
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

} )( jQuery ), 0 < $('[data-plugins="dropify"]').length && $('[data-plugins="dropify"]').dropify({
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