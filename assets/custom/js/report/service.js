( function ( $ ) {

    "use strict";

    var base_url = $('#base_url').val();

    function CustomDataTable(id, url, destroy = false, FormData = null) 
    {
        var Data = 'post='+encodeURI('true')

        var custom = $(id).DataTable({
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "searching": false,
            "oLanguage": {
                "sEmptyTable": "Data Empty", 
                "sLoadingRecords": "Loading ... Please wait !", 
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
                url : url,
                type: "post",
                data: { firstdate: $('.first-date').val(), enddate: $('.end-date').val() },
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
            "destroy": destroy
        })

        if(destroy)
            custom.ajax.reload(null, false)
    }

    CustomDataTable('#RiportSparepart', base_url+"report/service", false, $('.form-filter input'))
    CustomDataTable('#DailyRiport', base_url+"report/performa-teknisi", false, $('.form-filter input'))

    $(document).on('click', '.filter', function(e){
        e.preventDefault()

        CustomDataTable('#RiportSparepart', base_url+"report/service", true, $('.form-filter input'))
        CustomDataTable('#DailyRiport', base_url+"report/performa-teknisi", true, $('.form-filter input'))
    })


    function action(type, params, id)
        {
            var data = ''
            data += params
            if (id == 'pdf-' + type) {
                data += '&pdf=yes'
            }else if(id == 'excel-' + type){
                data += '&excel=yes'
            }
            data += '&type=' + type
            if (id == 'pdf-' + type || id == 'excel-' + type) {
                window.location.href = base_url + 'report/print-item' + '?cetak=1' + data 
            }else{
                window.open(
                       base_url + 'report/print-item' + '?cetak=1' + data,
                            'popUpWindow',
                            'height=700,width=1200,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
            }
        }

        $(document).on('click', '#print-daily-report, #pdf-daily-report, #excel-daily-report', function(event) {
            event.preventDefault();
            var data = ''
            $('#RiportSparepart').find('tbody').find('tr').each(function(index, el) {
                data += '&no[]=' + $(this).find('td').eq(0).text()
                data += '&invoice[]=' + $(this).find('td').eq(1).text()
                data += '&customer[]=' + $(this).find('td').eq(2).text()
                data += '&plat[]=' + $(this).find('td').eq(3).text()
                data += '&unit[]=' + $(this).find('td').eq(4).text()
                data += '&noTelp[]=' + $(this).find('td').eq(5).text()
                data += '&serviceCat[]=' + $(this).find('td').eq(6).text()
                data += '&partsNo[]=' + $(this).find('td').eq(7).text()
                data += '&partsName[]=' + $(this).find('td').eq(8).text()
                data += '&partsQty[]=' + $(this).find('td').eq(9).text()
                data += '&partsPrice[]=' + $(this).find('td').eq(10).text()
                data += '&totalLabor[]=' + $(this).find('td').eq(11).text()
                data += '&totalParts[]=' + $(this).find('td').eq(12).text()
            });
            action('daily-report', data, $(this).attr('id'))
        });

        $(document).on('click', '#print-teknisi, #pdf-teknisi, #excel-teknisi', function(event) {
            event.preventDefault();
            var data = ''
            $('#DailyRiport').find('tbody').find('tr').each(function(index, el) {
                data += '&no[]=' + $(this).find('td').eq(0).text()
                data += '&teknisi[]=' + $(this).find('td').eq(1).text()
                data += '&workingDay[]=' + $(this).find('td').eq(2).text()
                data += '&totalSVC[]=' + $(this).find('td').eq(3).text()
                data += '&serviceAMT[]=' + $(this).find('td').eq(4).text()
                data += '&partAMT[]=' + $(this).find('td').eq(5).text()
                data += '&oilAMT[]=' + $(this).find('td').eq(6).text()
                data += '&grandTotal[]=' + $(this).find('td').eq(7).text()
            });
            action('teknisi', data, $(this).attr('id'))
        });

}) ( jQuery )