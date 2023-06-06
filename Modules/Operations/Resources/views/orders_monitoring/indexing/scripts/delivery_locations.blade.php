<script>
    $(document).ready(function () {


        $('body').on('click', '.delivery_location', function () {
            let getDeliveryLocationUtl = `{{route('dashboard.operations.orders-monitoring.getDeliveryLocation',['id'])}}`;
            getDeliveryLocationUtl     = getDeliveryLocationUtl.replace('id', $(this).data('id'));
            $.ajax({
                    url: getDeliveryLocationUtl,
                    type: 'get',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.status != 'success') {
                            return;
                        }
                        Object.entries(response.data).forEach(entry => {const [key, value] = entry;
                            $('#'+key).text(value);
                        });
                        initMap(response.data.latitude,response.data.longitude,response.data.address);
                        $('#deliveryLocationModal').modal('show');
                    }

                }
            );


        });


        function initMap(lat, lng, title) {
            let latLng = {lat: parseInt(lat), lng: parseInt(lng)};
            let map    = new google.maps.Map(document.getElementById("map"), {
                center: latLng,
                zoom: 8,
            });
            new google.maps.Marker({
                position: latLng,
                map: map,
                title: title,
                draggable: false,
            });
        }
    });
</script>
