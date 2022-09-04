( function ( $ ) {

  "use strict";

  var base_url = $('#base_url').val();

  const dataTable = (target, destroy = false) => {
    const table = $('#orders-datatable').DataTable({
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
              $(".orders-datatable-error").html("");
              $("#orders-datatable").append('<tbody class="orders-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
              $("#orders-datatable_processing").css("display","none");
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

  dataTable(base_url+"ecommerce/orders")

})(jQuery)