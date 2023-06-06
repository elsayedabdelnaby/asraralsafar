<script>
    $(document).ready(function () {
        $('.show-hide-password-btn').click(function () {
            if ($(this).parents('.input-group').find('input.password-input').attr('type') ===
                'password') {
                $(this).parents('.input-group').find('input.password-input').attr('type', 'text');
                $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
            }
            else {
                $(this).parents('.input-group').find('input.password-input').attr('type', 'password');
                $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        new KTImageInput('image_profile');

        $('#country_id').on('change', function () {
            getStates($(this).val(), '')
        });

        $('#state_id').on('change', function () {
            getCities($(this).val(), '');
        });

        function getStates(country_id) {
            let getStatesURL = `{{ route('dashboard.locations.states.index', ['country_id']) }}`;
            getStatesURL     = getStatesURL.replace('country_id', country_id);
            $.ajax({
                    url: getStatesURL,
                    type: 'get',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response, selected) {
                        $('#state_id').html(`<option> {{__('merchants::dashboard.select_state')}} </option>`);
                        response.data.forEach(function (item) {
                            $('#state_id').append(`<option value="${item.id}">${item.name}</option>`)
                        });
                    }
                }
            );
        }

        function getCities(state_id) {
            let getCitiesURL = `{{ route('dashboard.locations.cities.index', ['country_id','state_id']) }}`;
            getCitiesURL     = getCitiesURL.replace('country_id', $('#country_id').val());
            getCitiesURL     = getCitiesURL.replace('state_id', state_id);
            $.ajax({
                    url: getCitiesURL,
                    type: 'get',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        $('#city_id').html(`<option> {{__('merchants::dashboard.select_city')}} </option>`);
                        response.data.forEach(function (item) {
                            $('#city_id').append(`<option value="${item.id}">${item.name}</option>`)
                        });
                    }
                }
            );
        }

        @if(isset($deliveryGuy))
        let country_id = '{{ $deliveryGuy->deliveryGuyCities->first()->city()->first()->state->country_id }}';
        let state_id   = '{{ $deliveryGuy->deliveryGuyCities->first()->city()->first()->state->id }}';


        getStates(country_id);
        setTimeout(function () {
            $('#country_id').val(country_id).trigger('change')
        }, 1000);
        setTimeout(function () {
            $('#state_id').val(state_id).trigger('change');
        }, 1500);

        setTimeout(function () {
            @foreach(collect($deliveryGuy->deliveryGuyCities)->pluck('city_id')->toArray() as $city_id)
                $("#city_id option[value='" + {{$city_id}} + "']").prop("selected", true).change();
            @endforeach
        },2000);

        @endif

    });
</script>
