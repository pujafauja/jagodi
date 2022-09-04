! function(n) {
    "use strict";

    function e() {
        this.$body = n("body")
    }
    e.prototype.init = function() {
        n("#summernote-edit").on("click", function() {
            n("#summernote-editmode").summernote({
                focus: !0,
                callbacks: {
                    onInit: function(e) {
                        n(e.editor).find(".custom-control-description").addClass("custom-control-label").parent().removeAttr("for")
                    }
                }
            }), n(this).hide(), n("#summernote-save").show()
        }), n("#summernote-save").on("click", function() {
            ! function() {
                const content = n("#summernote-editmode").summernote("code"),
                			action = n('.card .card-body form').attr('action')

                $.ajax({
                		url: action,
                		type: 'post',
                		dataType: 'json',
                		data: {content: content},
                		beforeSend: function() {
                			n('#summernote-save').prop('disabled', true)
                			n('#summernote-save').html('<i class="fas fa-spin fa-circle-notch mr-1">Saving ...</i>')
                		},
                		success: function (res) {
                			n('#summernote-save').prop('disabled', false)
                			n('#summernote-save').html('<i class="mdi mdi-content-save-outline mr-1"></i> Save Changes')

                			if(res.status === 1) {
                				Swal.fire({
                					title: 'Saved!',
                					text: res.pesan,
                					type: 'success'
                				})
                			} else {
                				Swal.fire({
                					title: 'Error!',
                					text: res.pesan,
                					type: 'error'
                				})
                			}
                		}
                	});

                n("#summernote-editmode").summernote("destroy")
            }(), n(this).hide(), n("#summernote-edit").show()
        })
    }, n.Summernote = new e, n.Summernote.Constructor = e
}(window.jQuery),
function() {
    "use strict";
    window.jQuery.Summernote.init()
}();