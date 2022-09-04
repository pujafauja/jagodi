( function ( $ ) {

    "use strict";

    var base_url = $('#base_url').val();

    if( $.isFunction($.fn.DataTable) )
    {
        var dataTable = $('#my-datatable').DataTable( {
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"employee/tambah-employee' class='btn btn-danger waves-effect waves-light ml-3' id='Tambah'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
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
            "sPaginationType": "simple_numbers", 
            "iDisplayLength": 10,
            "aLengthMenu": [[10, 20, 50, 100, 150], [10, 20, 50, 100, 150]],
            "ajax":{
                url : base_url+"employee/employee-json",
                type: "post",
                error: function(){ 
                    $(".my-datatable-error").html("");
                    $("#my-datatable").append('<tbody class="my-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#my-datatable_processing").css("display","none");
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

    if( $.isFunction($.fn.bootstrapWizard) )
    {
        $("#rootwizard").bootstrapWizard({
            onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index+1;
                var $percent = ($current/$total) * 100;
                $('#rootwizard').find('.bar').css({width:$percent+'%'});
            
                // If it's the last tab then hide the last button and show the finish instead
                if($current >= $total) {
                    $('#rootwizard').find('.list-inline-item.next').hide();
                    $('#rootwizard').find('.list-inline-item.finish').show();
                    $('#rootwizard').find('.list-inline-item.finish').removeClass('disabled');
                } else {
                    $('#rootwizard').find('.list-inline-item.next').show();
                    $('#rootwizard').find('.list-inline-item.finish').hide();
                }
            },
            onTabClick: function(tab, navigation, index) {
                return false;
            },
            onNext: function(t, r, a) {
                if(a == 2)
                {
                    var formData = new FormData($('#access-sallary')[0]),
                        personal = $('#personal').serializeArray();

                    personal.forEach(function(p){
                        formData.append(p.name, p.value);
                    });

                    $.ajax({
                        url: $('#personal').attr('action'),
                        type: "POST",
                        cache: false,
                        data: formData,
                        dataType:'json',
                        contentType: false,
                        processData: false,
                        xhr : function() {
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener('progress', function(e){
                                if(e.lengthComputable){
                                    $('#response').html('\
                                        <div class="progress mt-2 mb-2 progress-xl">\
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>\
                                        </div>\
                                        <div class="text-center">\
                                            <p class="w-75 mb-2 mx-auto">\
                                                Uploading pictures and saving. Please wait ...\
                                            </p>\
                                        </div>\
                                    ');

                                    var percent = Math.round((e.loaded / e.total) * 100);                      

                                    $('.progress-bar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
                                }
                            });
                            return xhr;
                        },
                        success: function(json){
                            // console.log(json)
                            $('#response .progress, #response .text-center').fadeOut();
                            if(json.status === 1){ 
                                $('#response').html('\
                                    <div class="text-center">\
                                        <h2 class="mt-0"><i class="mdi mdi-check-all"></i></h2>\
                                        <h3 class="mt-0">Employee Added !</h3>\
                                        <p class="w-75 mb-2 mx-auto">\
                                            Your employee has been added to the system\
                                        </p>\
                                    </div>\
                                ');
                            }
                            else {
                                $('#response').html(json.pesan);
                            }
                        }
                    });
                }

                var o = $($(t).data("targetForm"));
                if (o && (o.addClass("was-validated"), !1 === o[0].checkValidity()))
                {
                    return event.preventDefault(), event.stopPropagation(), !1
                }
            }
        })

        $('#personal, #access-sallary').on('submit', function(e){
            e.preventDefault();

            $("#rootwizard").bootstrapWizard('next');
        })
    }

    $(document).on('change', 'select[name="hasAccess"]', function(){
        var hasAccess = $(this).val();

        if(hasAccess === '1')
        {
            $('#hasAccess').removeClass('d-none');
            $('#hasAccess').find('input[name="password"]').prop('disabled', false);
        }
        else
        {
            $('#hasAccess').addClass('d-none');
            $('#hasAccess').find('input[name="password"]').prop('disabled', true);
        }
    })

} )( jQuery );

! function() {

    "use strict";

}(), 0 < $('[data-plugins="dropify"]').length && $('[data-plugins="dropify"]').dropify({
    messages: {
        default: "Drag and drop a file here or click",
        replace: "Drag and drop or click to replace",
        remove: "Remove",
        error: "Ooops, something wrong appended."
    },
    error: {
        fileSize: "The file size is too big (1M max)."
    }
});



