( function ( $ ) {

    "use strict";

    var base_url = $('#base_url').val();

    const lat = parseFloat($('#lat').val()) || -6.903363
    const lon = parseFloat($('#lon').val()) || 107.6081381

    const myLatlng = { lat: lat, lng: lon };
    const map = new google.maps.Map(document.getElementById("gmaps-basic"), {
        zoom: 10,
        center: myLatlng,
    });

    var markersArray = [];

    const clearOverlays = () => {
        for (var i = 0; i < markersArray.length; i++ ) {
            markersArray[i].setMap(null);
        }
    }
    
    const placeMarker = (location) => {
        clearOverlays()
        var marker = new google.maps.Marker({
            position: location,
            map: map,
            draggable: true,
            title: 'Drag me!'
        })
        markersArray.push(marker)
        map.panTo(location)
    }

    placeMarker(myLatlng)

    // Configure the click listener.
    map.addListener("click", function(mapsMouseEvent) {
        // create marker
        placeMarker(mapsMouseEvent.latLng)
        const latLng = mapsMouseEvent.latLng.toJSON()

        $('#lat').val(latLng.lat)
        $('#lon').val(latLng.lng)
        
    });

    $('.publish-contact').on('click', function(e) {
        e.preventDefault()

        let formData = new FormData($('#myAwesomeDropzone')[0])

        formData.append('contact-en', $('#contact-en').summernote('code'))
        formData.append('contact-ina', $('#contact-ina').summernote('code'))
        formData.append('lat', $('#lat').val())
        formData.append('lon', $('#lon').val())

        $.ajax({
            url: base_url + 'contact-us/save',
            type: 'POST',
            cache: false,
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            beforeSend: () => {
                $('.publish-contact').prop('disabled', true)
                $('.publish-contact').html('<i class="fas fa-spinner mr-1"></i>Publishing ...')
            },
            success: (result) => {
                if(result.status === true) {
                    Swal.fire({
                        title: "Success!",
                        html: result.pesan,
                        type: "success"
                    })
                } else {
                    Swal.fire({
                        title: "Error!",
                        html: result.pesan,
                        type: "error"
                    })
                }
                $('.publish-contact').prop('disabled', false)
                $('.publish-contact').html('<i class="fe-upload-cloud mr-1"></i>Publish')
            }
        })
    })
}) ( jQuery )