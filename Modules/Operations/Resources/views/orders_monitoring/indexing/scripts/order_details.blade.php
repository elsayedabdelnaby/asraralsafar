<script>
    $(document).ready(function () {
        $('body').on('click', '.order_details', function () {
            getOrderDetails($(this).data('id'));
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

    function getOrderDetails(order_id) {
        let getOrderDetails = `{{route('dashboard.operations.orders-monitoring.getOrderDetails',['id'])}}`;
        getOrderDetails     = getOrderDetails.replace('id', order_id);
        $.ajax({
            url: getOrderDetails,
            type: 'get',
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status != 'success') {
                    return;
                }
                Object.entries(response.data).forEach(entry => {
                    const [key, value] = entry;
                    $('#' + key).text(value);
                });
                $('#order_product_body').html('');
                $.each(response.data.order_products, function (key, item) {
                    $('#order_product_body').append(`
                                <tr>
                                    <td>${key + 1}</td>
                                    <td>${item.name}</td>
                                    <td>${item.price}</td>
                                    <td>${item.quantity}</td>
                                </tr>
                            `);
                });
                $('#orderDetailsModal').modal('show');
            }

        });
    }


</script>
