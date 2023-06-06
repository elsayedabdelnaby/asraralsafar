<script>
    $(document).ready(function () {
        initMap();

        function initMap() {
            let latLng = {
                lat: {{old('latitude',$merchant_branch->latitude ??  '30.033333')}},
                lng: {{old('longitude',$merchant_branch->longitude ?? '31.233334')}}
            };
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
                $("#latitude").val(currentLatitude);
                $("#longitude").val(currentLongitude);
            });

        }


        $('#country_id').on('change', function () {
            getStates($(this).val(),'{{ route('dashboard.locations.states.index', ['country_id']) }}');
        });
        $('#state_id').on('change', function () {
            getCities($(this).val(),'{{ route('dashboard.locations.cities.index', ['country_id','state_id']) }}');
        });

        @if(isset($customer_address))
        let country_id = '{{$customer_address->city->state->country->id}}'
        let state_id   = '{{$customer_address->city->state->id}}'
        let city_id    = '{{$customer_address->city_id}}'

        setTimeout(function () {
            $('#country_id').val(country_id).trigger('change')
        }, 1000);

        setTimeout(function () {
            $('#state_id').val(state_id).trigger('change');
        }, 2000)

        setTimeout(function () {
            $('#city_id').val(city_id).trigger('change');
        }, 3000)


        @endif




    });
</script>
