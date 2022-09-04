! function(p) {
    "use strict";

    function t() {}
    t.prototype.send = function(t, i, o, e, n, a, s, r) {
        var c = {
            heading: t,
            text: i,
            position: o,
            loaderBg: e,
            icon: n,
            hideAfter: a = a || 3e3,
            stack: s = s || 1
        };
        r && (c.showHideTransition = r), console.log(c), p.toast().reset("all"), p.toast(c)
    }, p.NotificationApp = new t, p.NotificationApp.Constructor = t
}(window.jQuery),
( function ( $ ) {

  "use strict";

  var base_url = $('#base_url').val();

  const getFeaturedLists = (orderby, search, dataURL = base_url + 'ecommerce/featured-lists') => {
    $('#featured-lists').html('<i class="fas fa-spin fa-circle-notch mr-1"></i>Loading, please wait ...')

    $('#featured-lists').load(dataURL, {
      'col-order': orderby,
      'search': search
    })
  }

  let search = $('#search-products').val(),
      colorder = $('#product-status-select').val()

  getFeaturedLists(colorder, search)

  $(document).on('click', '.page-link', function(e){
    e.preventDefault()

    let target = $(this).attr('href'),
        orderby = $('#product-status-select').val(),
        search = $('#search-products').val()

    getFeaturedLists(orderby, search, target)
  })

  $(document).on('keyup', '#search-products', function(e){
    e.preventDefault()

    let search = $(this).val(),
        orderby = $('#product-status-select').val()

    getFeaturedLists(orderby, search)
  })

  $(document).on('change', '#product-status-select', function(e){
    e.preventDefault()

    let orderby = $(this).val(),
        search = $('#search-products').val()

    getFeaturedLists(orderby, search)
  })

  $(document).on('click', '.delete-product', function(e){
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

              let search = $('#search-products').val(),
                  colorder = $('#product-status-select').val()

              getFeaturedLists(colorder, search)
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

  $(document).on('click', '.new-featured', async function(e){
    e.preventDefault()

    var Tombol = "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

    $('.modal-dialog').removeClass('modal-sm');
    $('.modal-dialog').removeClass('modal-lg');
    $('.modal-dialog').addClass('modal-full-width');

    $('#ModalHeader').html('Add Featured Products');

    await $('#ModalContent').load($(this).attr('href'), function(){
      const getProductLists = (orderby, search, dataURL = base_url + 'ecommerce/product-modal-lists') => {
        $('#product-lists').html('<i class="fas fa-spin fa-circle-notch mr-1"></i>Loading, please wait ...')

        $('#product-lists').load(dataURL, {
          'wheres': "AND id NOT IN (SELECT productid FROM featured)",
          'col-order': orderby,
          'search': search
        })
      }

      let search = $('#search').val(),
          colorder = $('#status-select').val()

      getProductLists(colorder, search)

      $(document).on('click', '.page-link', function(e){
        e.preventDefault()

        let target = $(this).attr('href'),
            orderby = $('#status-select').val(),
            search = $('#search').val()

        getProductLists(orderby, search, target)
      })

      $(document).on('keyup', '#search', function(e){
        e.preventDefault()

        let search = $(this).val(),
            orderby = $('#status-select').val()

        getProductLists(orderby, search)
      })

      $(document).on('change', '#status-select', function(e){
        e.preventDefault()

        let orderby = $(this).val(),
            search = $('#search').val()

        getProductLists(orderby, search)
      })

      $(document).on('click', '.add-this', function(e){
        e.preventDefault()

        let ini = $(this),
            id = ini.data('id')

        $.ajax({
          url: base_url + 'ecommerce/add-new-featured',
          type: 'post',
          dataType: 'json',
          data: { id: id },
          beforeSend: function(){
            ini.prop('disabled', true)
            ini.html('<i class="fas fa-spin fa-circle-notch"></i>')
          },
          success: function(res){

            if(res.status === 1) {
              ini.html('<i class="fe-check-circle"></i>')
              $.NotificationApp.send("Well Done!", res.pesan, "top-right", "#5ba035", "success")

              let search = $('#search-products').val(),
                  colorder = $('#product-status-select').val()

              getFeaturedLists(colorder, search)
            } else {
              ini.html('<i class="fa fa-check"></i>')
              ini.prop('disabled', false)
              $.NotificationApp.send("Oh snap!", res.pesan, "top-right", "#bf441d", "error")
            }
          }

        })
      })
    })

    $('#ModalGue').modal('show');
    $('#ModalFooter').html(Tombol);
  })

})(jQuery)