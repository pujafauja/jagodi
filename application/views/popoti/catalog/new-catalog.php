    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') ?>">

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <select name="cat" id="" class="form-control">
                            <option value="all">All</option>
                            <?php foreach($category as $row): ?>
                                <option value="<?php echo $row->id ?>"><?php echo $row->nama ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <table id="customers-datatable" class="table dt-responsive nowrap w-100 table-sm">
                    <thead>
                        <tr>
                            <th>Sparepart</th>
                            <th>Stock</th>
                            <th>Price</th>
                            <th class='no-sort'>Choose</th>
                        </tr>
                    </thead>
                </table>

                <form action="<?php echo base_url() ?>catalog/new-catalog" enctype="multipart/form-data" id="form-catalog" method="post">

                    <input type="hidden" name="cateogryid">

                    <div class="row mt-3">
                        <div class="col">
                            <div class="form-group row mb-3">
                                <label>Upload Foto <span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <input name="foto-1" type="file" class="form-control" />                                                
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label>Upload Foto <span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <input name="foto-2" type="file" class="form-control" />                                                
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label>Upload Foto <span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <input name="foto-3" type="file" class="form-control" />                                                
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
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
                    url : base_url+"service/show-parts-json",
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
        $(document).on('change', 'select[name=cat]', function(event) {
            event.preventDefault();
            var val = $(this).val()
            if (val == 'all') {
                    var dataTable = $('#customers-datatable').DataTable({
                        "ajax":
                            {
                                url : base_url+'service/show-parts-json',
                                type: "post",
                                error: function(){ 
                                    $(".my-datatable-error").html("");
                                    $("#my-datatable").append('<tbody class="my-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                                    $("#my-datatable_processing").css("display","none");
                                }
                            },
                        "destroy": true
                    }).ajax.reload();
            }else{
                var dataTable = $('#customers-datatable').DataTable({
                    "ajax":
                        {
                            url : base_url+'service/show-parts-json/'+val,
                            type: "post",
                            error: function(){ 
                                $(".my-datatable-error").html("");
                                $("#my-datatable").append('<tbody class="my-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                                $("#my-datatable_processing").css("display","none");
                            }
                        },
                    "destroy": true
                }).ajax.reload();
            }
        });
        var is_choose = false
        $(document).on('click', '.choosePart', function(event) {
            event.preventDefault();
            if (!is_choose) {
                is_choose = true
                $(this).closest('tr').addClass('table-primary')
                $('input[name=cateogryid]').val($(this).data('id'))
            }else{
                $(this).closest('tbody').find('tr').each(function(index, el) {
                    if ($(this).hasClass('table-primary')) {
                        $(this).removeClass('table-primary')
                    }
                });

                $(this).closest('tr').addClass('table-primary')
                $('input[name=cateogryid]').val($(this).data('id'))

            }
        });
    } )( jQuery );



</script>