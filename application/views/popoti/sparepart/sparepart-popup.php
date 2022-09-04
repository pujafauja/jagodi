                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <table id="popup-datatable" class="table dt-responsive nowrap w-100 table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Code</th>
                                                    <th>Part Name</th>
                                                    <th>Price</th>
                                                    <th class='no-sort'>Options</th>
                                                </tr>
                                            </thead>
                                        </table>

                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
                        <!-- end row-->

                        <script type="text/javascript">
                            $(document).ready(function(){
                                var tabel = $('#popup-datatable').DataTable(
                                {
                                    "serverSide": true,
                                    "stateSave" : false,
                                    "bAutoWidth": true,
                                    "oLanguage": {
                                        "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                                        "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page",
                                        "sLoadingRecords": "Please wait ...", 
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
                                    "sPaginationType": "simple_numbers", 
                                    "iDisplayLength": 10,
                                    "aLengthMenu": [[10, 20, 50, 100, 150], [10, 20, 50, 100, 150]],
                                    "ajax":{
                                        url : '<?php echo base_url('sparepart/popup-json') ?>',
                                        data: {exists: '<?php echo json_encode($retrieved); ?>'},
                                        type: "post",
                                        error: function(){ 
                                            $(".popup-datatable-error").html("");
                                            $("#popup-datatable").append('<tbody class="popup-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                                            $("#popup-datatable_processing").css("display","none");
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
                                }
                                );
                            })
                        </script>