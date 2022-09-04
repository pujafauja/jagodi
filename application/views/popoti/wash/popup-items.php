<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') ?>">

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <table id="datatable" class="table dt-responsive nowrap w-100 table-sm">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Price</th>
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
            var dataTable = $('#datatable').DataTable( {
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
                    url : base_url+"wash/ajax-items/<?php echo $categoryid ?>",
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

        $(document).on('click', '.pilih', function(e){
            e.preventDefault()
            var id_barang   = $(this).data('id')
            var nama_barang = $(this).closest('tr').find('td').eq(0).text();
            let harga       = $(this).closest('tr').find('td').eq(1).text();

            $('#tbl-transaction').prepend('<tr data-id="'+id_barang+'">\
                                            <td><a class="delete-item text-danger mr-1"><i class="fas fa-times"></i></a>'+nama_barang+'<input type="hidden" name="kode-barang[]" value="'+id_barang+'"></td>\
                                            <td><span class="autonumber" data-a-sep="." data-a-dec="," data-m-dec="0" data-a-sign="Rp. ">'+harga+'</span><input type="hidden" name="harga_satuan[]" value="'+harga+'"></td>\
                                            <td><input class="form-control autonumber" data-a-sep="." data-a-dec="," data-m-dec="0" type="text" name="jumlah_beli[]" value="1"> </td>\
                                            <td>\
                                                <div class="input-group">\
                                                    <input class="form-control" name="diskon[]">\
                                                    <div class="input-group-append">\
                                                        <span class="input-group-text">%</span>\
                                                    </div>\
                                                </div>\
                                            </td>\
                                            <td class="text-right"><span class="autonumber" data-a-sep="." data-a-dec="," data-m-dec="0" data-a-sign="Rp. ">'+harga+'</span><input type="hidden" name="sub_total[]" value="'+harga+'"></td>\
                                        </tr>');
            $(".autonumber").autoNumeric("init");
            function toFloat(nominal = 0)
            {
                if(nominal == '')
                {
                    nominal = 0;
                    nominal = parseFloat(nominal);
                } else {
                    nominal = nominal.replace(/[.]/g, '');
                    nominal = nominal.replace(/[,]/g, '.');
                    nominal = parseFloat(nominal);
                }

                return nominal;
            }
            function hitungtotal() 
            {
                let total  = 0;
                let diskon = 0;

                $('#tbl-transaction tbody tr').each(function(){
                    let qty      = $(this).find('td').eq(2).find('input').val();
                        qty   = toFloat(qty);
                    let harga    = $(this).find('td').eq(1).find('span').text();
                        harga = harga.replace('Rp. ', '')
                        harga = toFloat(harga);
                    let disc = $(this).find('td').eq(3).find('input').val();

                    let beforediskon = qty * harga;
                    let subtotal = beforediskon - diskon;

                    diskon += (disc / 100) * beforediskon;
                    total  += beforediskon;
                })

                $('#Total').autoNumeric('set', total);
                $('#Discount').autoNumeric('set', diskon);

                let grand = total - diskon;

                $('#grand').autoNumeric('set', grand);

                if(grand > 0)
                    $('.btn-payment').prop('disabled', false);
                else
                    $('.btn-payment').prop('disabled', true);
            }

            hitungtotal();

            $('#ModalGue').modal('hide');
        })



    } )( jQuery );
</script>