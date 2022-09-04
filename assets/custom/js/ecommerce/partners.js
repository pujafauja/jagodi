( function ( $ ) {

  "use strict";

  var base_url = $('#base_url').val();

  const dataTable = (target, destroy = false) => {
    const table = $('#partners-datatable').DataTable({
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
          url : target,
          type: "post",
          error: function(){ 
              $(".partners-datatable-error").html("");
              $("#partners-datatable").append('<tbody class="partners-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
              $("#partners-datatable_processing").css("display","none");
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
      },
      destroy: destroy
    })

    if (destroy === true)
      table.ajax.reload(null, false)
  }

  dataTable(base_url+"ecommerce/retrieve-partners")

  $(document).on('click', '.new-partner', function(e){
    e.preventDefault()

    $('.modal-dialog').removeClass('modal-sm');
    $('.modal-dialog').removeClass('modal-full-width');
    $('.modal-dialog').addClass('modal-lg');

    $('#ModalHeader').html('Add Partner');

    $('#ModalContent').load($(this).attr('href'), function(){
      $('[data-plugins="dropify"]').length && $('[data-plugins="dropify"]').dropify({
        messages: {
          default: "Drag and drop a file here or click",
          replace: "Drag and drop or click to replace",
          remove: "Remove",
          error: "Ooops, something wrong appended."
        },
        error: {
          fileSize: "The file size is too big (3M max)."
        }
      })
    })

    $('#ModalGue').modal('show');
  })

  $(document).on('submit', '.add-new', function(e){
    e.preventDefault()

    let formData = new FormData(this),
        target = $(this).attr('action')

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
          })

          dataTable(base_url+"ecommerce/retrieve-partners", true)

          $('#ModalGue').modal('hide')
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

  $(document).on('click', '#Editpartner', function(e){
    e.preventDefault()

    $('.modal-dialog').removeClass('modal-sm');
    $('.modal-dialog').removeClass('modal-full-width');
    $('.modal-dialog').addClass('modal-lg');

    $('#ModalHeader').html('Edit Partner');

    $('#ModalContent').load($(this).attr('href'), function(){
      $('[data-plugins="dropify"]').length && $('[data-plugins="dropify"]').dropify({
        messages: {
          default: "Drag and drop a file here or click",
          replace: "Drag and drop or click to replace",
          remove: "Remove",
          error: "Ooops, something wrong appended."
        },
        error: {
          fileSize: "The file size is too big (3M max)."
        }
      })
    })

    $('#ModalGue').modal('show');
  })

})(jQuery)