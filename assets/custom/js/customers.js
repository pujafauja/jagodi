( function ( $ ) {

    "use strict";
    var base_url = $('#base_url').val();

    if( $.isFunction($.fn.DataTable) )
    {
        var dataTable = $('#customers-datatable').DataTable( {
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                // "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"customer/tambah-unit' class='btn btn-danger waves-effect waves-light ml-3' id='TambahUnit'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
                // "sInfoFiltered": "(difilter dari _MAX_ total data)", 
                // "sZeroRecords": "Pencarian tidak ditemukan", 
                // "sEmptyTable": "Data kosong", 
                // "sLoadingRecords": "Harap Tunggu...", 
                "oPaginate": {
                    "sPrevious": "Prev",
                    "sNext": "Next"
                }
            },
            "aaSorting": [[ 0, "asc" ]],
            "columnDefs": [ 
                {
                    "targets": 'no-sort',
                    "orderable": false,
                }
            ],
            "sPaginationUnit": "simple_numbers", 
            "iDisplayLength": 10,
            "aLengthMenu": [[10, 20, 50, 100, 150], [10, 20, 50, 100, 150]],
            "ajax":{
                url : base_url+"customer/all-customers-json",
                type: "post",
                error: function(){ 
                    $(".unit-datatable-error").html("");
                    $("#unit-datatable").append('<tbody class="unit-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#unit-datatable_processing").css("display","none");
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

    $(document).on('click', '.choose-customer', function(e){
        var nama = $(this).closest('tr').find('td').eq(0).text();
        $('input[name="cust-nama"]').val(nama);
    })



} )( jQuery );