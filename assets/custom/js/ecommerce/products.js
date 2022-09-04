( function ( $ ) {

  "use strict";

  var base_url = $('#base_url').val();

  const getProductLists = (orderby, search, dataURL = base_url + 'ecommerce/product-lists') => {
    $('#product-lists').load(dataURL, {
      'col-order': orderby,
      'search': search
    })
  }

  $(document).on('click', '.save-product', function(e){
    e.preventDefault()

    let prodID = $('input[name="product-id"]').val(),
        target = ''

    if (prodID != '') {
      target = base_url + 'ecommerce/save-product/' + prodID
    } else {
      target = base_url + 'ecommerce/save-product'
    }

    let formData = new FormData($('#myAwesomeDropzone')[0])

    $('.product-sizes').each(function(index, item){
      formData.append('sizes[]', $(this).val())
    })

    $('.product-stocks').each(function(index, item){
      formData.append('stocks[]', $(this).val())
    })

    formData.append('nama', $('input[name="nama"]').val())
    formData.append('description', $('#product-description').summernote('code'))
    formData.append('summary', $('textarea[name="summary"]').val())
    formData.append('price', $('#product-price').autoNumeric('get'))
    formData.append('comment', $('textarea[name="comment"]').val())
    formData.append('categories[]', $('select[name="categories[]"]').val())
    formData.append('metaTitle', $('input[name="meta-title"]').val())
    formData.append('metaKeywords', $('input[name="meta-keywords"]').val())
    formData.append('metaDescription', $('textarea[name="meta-description"]').val())

    $('.add-titles').each(function(){
      const key = $(this).data('key')

      formData.append($(this).attr('name'), $(this).val())
    })

    $('.add-values').each(function(){
      formData.append($(this).attr('name'), $(this).val())
    })

    $.ajax({
      type:'POST',
      url: target,
      data:formData,
      cache:false,
      contentType: false,
      processData: false,

      dataType: 'json',
      beforeSend: function() {
        $('.save-product').html('<i class="fas fa-spin fa-circle-notch mr-1"></i>Saving ...')
        $('.save-product').prop('disabled', true)
      },
      success: function(res) {
        $('.save-product').html('Save')
        $('.save-product').prop('disabled', false)

        if(res.status === 1) {
          Swal.fire({
              title: "Saved!",
              text: "Your file has been saved.",
              type: "success",
              showCancelButton: 0,
              confirmButtonColor: "OK"
          }).then(function(){
            window.location.href = base_url + 'ecommerce/products'
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

              $('#product-lists').load(base_url + 'ecommerce/product-lists')
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

  $(document).on('click', '.new-row', function(e){
    e.preventDefault()

    $('#size-col').append(`<div class="row">
                        <div class="col-6">
                            <label for="">Size</label>
                            <div class="input-group">
                                <button class="btn btn-danger"><i class="fe-x-circle"></i></button>
                                <input type="text" class="form-control product-sizes" name="sizes[]">
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="">Stock</label>
                            <input type="text" class="form-control product-stocks" name="stocks[]">
                        </div>
                    </div>`)
  })

  let items = new Array()

  $('.add-titles').each(function(e){
    const key = parseInt($(this).data('key'))

    items.push(key)
  })

  $(document).on('click', '.add-new-item', function(e){
    e.preventDefault()

    const lastKey = parseInt(Math.max(...items))

    const totItems = parseInt(lastKey + 1),
          currentRow = $(this).closest('.row')

    items.push(totItems)

    const html = `<div class="form-group row">
                <div class="col-md-6">
                    <label for="">Additional Item <em><small class="text-muted">exp: Color</small></em></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button class="btn btn-danger remove-add-item"><i class="fe-x-circle"></i></button>
                        </div>
                        <input type="text" class="form-control add-titles" data-key="${totItems}" name="addTitles[${totItems}]">
                        <div class="input-group-append">
                            <button class="btn btn-info add-new-item"><i class="fe-plus-circle"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-12">
                            <label for="">Additional Values <em><small class="text-muted">exp: Black; Red</small></em></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-danger remove-add-value"><i class="fe-x-circle"></i></button>
                                </div>
                                <input type="text" class="form-control add-values" name="addValues[${totItems}][]">
                                <div class="input-group-append">
                                    <button class="btn btn-info add-new-value"><i class="fe-plus-circle"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`

    currentRow.after(html)
  })

  $(document).on('click', '.remove-add-item', function(e){
    e.preventDefault()

    const currentRow = $(this).closest('.row'),
          currentKey = currentRow.find('.add-titles').data('key')

    if(items.length > 1) {
      currentRow.remove()

      items = $.grep(items, function(val){
        return val != currentKey
      })
    } else {
      swal.fire({
        type: 'error',
        text: `You can't delete the last row`,
        title: 'Error!'
      })
    }
  })

  $(document).on('click', '.add-new-value', function(e){
    e.preventDefault()

    const currentRow = $(this).closest('.form-group'),
          currentCol = $(this).closest('.col-12'),
          currentKey = currentRow.find('.add-titles').data('key'),
          html = `<div class="col-12">
                            <label for="">Additional Values <em><small class="text-muted">exp: Black; Red</small></em></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-danger remove-add-value"><i class="fe-x-circle"></i></button>
                                </div>
                                <input type="text" class="form-control add-values" name="addValues[${currentKey}][]">
                                <div class="input-group-append">
                                    <button class="btn btn-info add-new-value"><i class="fe-plus-circle"></i></button>
                                </div>
                            </div>
                        </div>`

    currentCol.after(html)
  })

  $(document).on('click', '.remove-add-value', function(e){
    e.preventDefault()

    const currentRow = $(this).closest('.form-group'),
          currentCol = $(this).closest('.col-12'),
          currentKey = currentRow.find('.add-titles').data('key'),
          totCols = $(`input[name="addValues[${currentKey}][]"]`).length

    if (totCols > 1) {
      currentCol.remove()
    } else {
      swal.fire({
        title: 'Error!',
        text: `You can't remove the last row!`,
        type: 'error'
      })
    }
  })

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

  let search = $('#search').val(),
      colorder = $('#status-select').val()

  getProductLists(colorder, search)

  $(document).on('change', '#status-select', function(e){
    e.preventDefault()

    let orderby = $(this).val(),
        search = $('#search').val()

    getProductLists(orderby, search)
  })

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

})(jQuery), 0 < $('[data-plugins="dropify"]').length && $('[data-plugins="dropify"]').dropify({
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