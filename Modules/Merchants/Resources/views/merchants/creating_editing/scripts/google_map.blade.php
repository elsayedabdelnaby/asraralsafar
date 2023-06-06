<script>

    $(document).ready(function () {
        initMap();
        function initMap() {
            var latLng = {lat: {{old('branch_latitude',$merchant_branch->latitude ??  '30.033333')}}, lng: {{old('branch_longitude',$merchant_branch->longitude ?? '31.233334')}} };
            let map    = new google.maps.Map(document.getElementById("map"), {
                center: latLng,
                zoom: 8,
            });
            let marker = new google.maps.Marker({
                position: latLng,
                map: map,
                title: '',
                draggable: true,
            });

            google.maps.event.addListener(marker, 'dragend', function (marker) {
                var latLng       = marker.latLng;
                currentLatitude  = latLng.lat();
                currentLongitude = latLng.lng();
                $("#branch_latitude").val(currentLatitude);
                $("#branch_longitude").val(currentLongitude);
            });

        }
    });
</script>
