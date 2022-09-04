( function ( $ ) {

  "use strict";

  var base_url = $('#base_url').val();

  if( $.isFunction($.fn.DataTable) )
  {
      var dataTable = $('#discounts-datatable').DataTable( {
          "serverSide": true,
          "stateSave" : false,
          "bAutoWidth": true,
          "aaSorting": [[ 0, "asc" ]],
          "columnDefs": [ 
              {
                  "targets": 'no-sort',
                  "orderable": false,
              }
          ],
          "sPaginationType": "simple_numbers", 
          "iDisplayLength": 10,
          "aLengthMenu": [[10, 20, 50, 100, 150], [10, 20, 50, 100, 150]],
          "ajax":{
              url : base_url+"ecommerce/retrieve-discounts",
              type: "post",
              error: function(){ 
                  $(".discounts-datatable-error").html("");
                  $("#discounts-datatable").append('<tbody class="discounts-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                  $("#discounts-datatable_processing").css("display","none");
              }
          },
          language: {
              paginate: {
                  previous: "<i class='mdi mdi-chevron-left'>",
                  next: "<i class='mdi mdi-chevron-right'>"
              }
          },
          drawCallback: function() {
              $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
          }
      } );
  }

  $(document).on('submit', '.add-new', function(e){
    e.preventDefault()

    let formData = $(this).serializeArray()

    $.ajax({
      url: $(this).attr('action'),
      type: 'post',
      data: formData,
      dataType: 'json',
      beforeSend: function() {
        $('.save-product').prop('disabled', true)
        $('.save-product').html('<i class="fas fa-spin fa-circle-notch mr-1"></i>Saving ...')
      },
      success: function(res) {
        $('.save-product').prop('disabled', false)
        $('.save-product').html('Save')

        if(res.status == '1') {
          Swal.fire({
              title: "Saved!",
              text: "Your file has been saved.",
              type: "success",
              showCancelButton: 0,
              confirmButtonColor: "OK"
          }).then(function(){
            window.location.href = base_url + 'ecommerce/discounts'
          })
        } else {
          Swal.fire({
              title: "Error!",
              html: res.pesan,
              type: "error",
          })
        }
      }
    })
  })

  const discType = (val) => {
    const prodCat = $('#discount-category'),
          allProd = $('#discount-product'),
          fewProd = $('#discount-few-products')

    if (val === 'all') {
      $('#product-detail tbody tr').each(function(){
        $(this).remove()
      })

      allProd.removeClass('d-none')
      prodCat.addClass('d-none')
      fewProd.addClass('d-none')
    } else if (val === 'product') {
      allProd.addClass('d-none')
      prodCat.addClass('d-none')
      fewProd.removeClass('d-none')
    } else {
      $('#product-detail tbody tr').each(function(){
        $(this).remove()
      })

      allProd.addClass('d-none')
      prodCat.removeClass('d-none')
      fewProd.addClass('d-none')
    }
  }

  const disctype = $('#discount-type').val()
  discType(disctype)

  $(document).on('change', '#discount-type', function(){
    const val = $(this).val()

    discType(val)
  })

  $(document).on('click', '.product-modal', async function(e){
    e.preventDefault()

    var Tombol = "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

    $('.modal-dialog').removeClass('modal-sm');
    $('.modal-dialog').removeClass('modal-lg');
    $('.modal-dialog').addClass('modal-full-width');

    $('#ModalHeader').html('Select Product');

    await $('#ModalContent').load($(this).attr('href'), function(){
      const getProductLists = (orderby, search, dataURL = base_url + 'ecommerce/product-modal-lists') => {
        $('#product-lists').html('<i class="fas fa-spin fa-circle-notch mr-1"></i>Loading, please wait ...')

        let insertedItems = []

        $('input[name="products[]"]').each(function(){
          insertedItems.push($(this).val())
        })

        $('#product-lists').load(dataURL, {
          'insertedItems': insertedItems,
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
            id     = ini.data('id'),
            gambar = ini.closest('.product-box').find('.bg-light img').attr('src'),
            nama   = ini.closest('.product-box').find('.product-info div div.col h5.sp-line-1').text(),
            res    = `<tr>
                          <td width="50px">
                              <a href="" class="remove-item"><i class="fe-x-circle text-danger"></i></a>
                              <input id="product-id" type="hidden" name="products[]" value="${id}">
                          </td>
                          <td class="table-user">
                              <img src="${gambar}" class="mr-2 rounded-circle" alt="">
                              <span class="font-weight-semibold">${nama}</span>
                          </td>
                      </tr>`

        let exists = 0

        $('#product-detail tbody tr').each(function(){
          let productID = $(this).find('input').val()

          if (productID == id)
            exists = 1
        })

        if (exists == 0)
          $('#product-detail tbody').append(res)

        $('#ModalGue').modal('hide')
      })
    })

    $('#ModalGue').modal('show');
    $('#ModalFooter').html(Tombol);
  })

  $(document).on('click', '.remove-item', function(e){
    e.preventDefault()

    const row = $(this).closest('tr')

    row.remove();
  })

})(jQuery);