<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') ?>">

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <table id="plats-datatable" class="table dt-responsive nowrap w-100 table-sm">
                    <thead>
                        <tr>
                            <th>No Plat</th>
                            <th>Unit</th>
                            <th>Merk</th>
                            <th>Jenis</th>
                            <th>Kategori</th>
                            <th class='no-sort'>Choose</th>
                        </tr>
                    </thead>
                </table>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->

<script type="text/javascript" src="<?php echo base_url('assets/libs/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/libs/datatables.net-buttons/js/buttons.flash.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/libs/datatables.net-buttons/js/buttons.print.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/libs/datatables.net-select/js/dataTables.select.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/libs/pdfmake/build/pdfmake.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/libs/pdfmake/build/vfs_fonts.js') ?>"></script>

<script type="text/javascript">
    ( function ( $ ) {

        "use strict";
        var base_url = $('#base_url').val();

        if( $.isFunction($.fn.DataTable) )
        {
            var dataTable = $('#plats-datatable').DataTable( {
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
                    url : base_url+"customer/all-plats-json",
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

        $(document).on('click', '.choose', function(e){
            var plat     = $(this).closest('tr').find('td').eq(0).text();
            var unit     = $(this).closest('tr').find('td').eq(1).text();
            var merk     = $(this).closest('tr').find('td').eq(2).text();
            var jenis    = $(this).closest('tr').find('td').eq(3).text();
            var kategori = $(this).closest('tr').find('td').eq(4).text();
            
            $('input[name="no-plat"]').val(plat);
            $('input[name="vehicleid"]').val($(this).data('id'));
            $('input[name="unit"]').val(unit);
            $('input[name="merk"]').val(merk);
            $('input[name="jenis"]').val(jenis);
            $('input[name="kategori"]').val(kategori);
            $('input[name="category_id"]').val($(this).data('cat'));
            $('input[name="merkid"]').val($(this).data('merk'));
            $('input[name="jenisid"]').val($(this).data('jenis'));
            $('input[name="unit-id"]').val($(this).data('unit'));

            $('#ModalGue').modal('hide');
        })



    } )( jQuery );
</script>