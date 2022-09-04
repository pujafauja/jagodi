$(document).ready(function() {
	
	"use strict";

	var base_url = $('#base_url').val();

	$(document).on('click', '#new-catalog', function(event) {
	    event.preventDefault();
	    var tombol = "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";
	        tombol += "<button type='button' class='btn btn-primary' id='confirm-catalog'>Confirm</button>";
	    $('.modal-dialog').removeClass('modal-sm');
	    $('.modal-dialog').addClass('modal-xl');
	    $('#ModalHeader').html('New Catalog');
	    $('#ModalContent').load($(this).attr('href'));
	    $('#ModalFooter').html(tombol);
	    $('#ModalGue').modal('show');
	});
	$(document).on('click', '.delete-catalog', function(event) {
		event.preventDefault();
		var id = $(this).data('id')
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
           	    	url: base_url + 'catalog/delete-catalog/' + id,
           	    	type: 'post',
           	    	dataType: 'json',
           	    	success : function(data){
           	    		if (data.status == 1) {
           	    			window.location.href = base_url + 'catalog'
           	    		}else{
           	    			Swal.fire({
           	    				title : 'Errors',
           	    				html : data.pesan,
           	    				type : 'error'
           	    			})
           	    		}
           	    	}
           	    })
           	    
           }else
            {
                Swal.fire({
                    title: "Cancelled",
                    text: "Your imaginary file is safe :)",
                    type: "error"
                })
            }
       })
	});
	$(document).on('click', '#confirm-catalog', function(event) {
		event.preventDefault();
		var formData = new FormData($('#form-catalog')[0])
		$.ajax({
			url: $('#form-catalog').attr('action'),
			type: 'post',
			cache: false,
            data: formData,
            dataType:'json',
            contentType: false,
            processData: false,
			success: function(data){
				if (data.status == 1) {
					swal.fire({
					    title: 'Success',
					    text: data.pesan,
					    type: 'success',
					    confirmButtonColor : '#3085D6',
					    confirmButtonText : 'OK!'
					}).then(function(result){
					    window.location.href = base_url + 'catalog'
					})

				}else{
					Swal.fire({
						title : 'Errors',
						html : data.pesan,
						type : 'error'
					})
				}
			}
		})
		
	});
});
