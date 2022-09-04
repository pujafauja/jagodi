! function(t) {
    "use strict";

    let base_url = t('#base_url').val()

    t(document).on('click', '.delete-slider', function(e) {
        e.preventDefault()

        let target = $(this).attr('href')

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

                  window.location.href = base_url + 'banner/slider'
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

    function e() {
        this.$body = t("body")
    }
    e.prototype.init = function() {
        Dropzone.autoDiscover = !1, t('[data-plugin="dropzone"]').each(function() {
            var e = t(this).attr("action"),
                o = t(this).data("previewsContainer"),
                i = {
                    url: e
                };
            o && (i.previewsContainer = o);
            var r = t(this).data("uploadPreviewTemplate");
            r && (i.previewTemplate = t(r).html());
            t(this).dropzone(i)
        })
    }, t.FileUpload = new e, t.FileUpload.Constructor = e
}(window.jQuery),
function($) {
    "use strict";
    window.jQuery.FileUpload.init()
}()