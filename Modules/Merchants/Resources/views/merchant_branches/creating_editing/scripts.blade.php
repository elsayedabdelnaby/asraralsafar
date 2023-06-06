<script>
    $(document).ready(function () {
        MerchantBranch.init();
        $('#country_id').on('change', function () {
            getStates($(this).val(), '')
        });
        $('#state_id').on('change', function () {
            getCities($(this).val(), '');
        });


        @if(isset($merchant_managers))
        $('#select_branch_manger').on('change', function () {
            selectBranchManger($(this).val());
        });

        function selectBranchManger(type_of_manager) {
            if (type_of_manager == 'select_from_mangers') {
                $('.select_from_mangers').removeClass('d-none');
                $('.create_new_manger').addClass('d-none');
                $('#branch_manager_name').prop('required', false);
                $('#branch_manager_phone_number').prop('required', false);
                $('#branch_manager_email').prop('required', false);
                $('#branch_manager_password').prop('required', false);
            }
            else {
                $('.select_from_mangers').addClass('d-none');
                $('.create_new_manger').removeClass('d-none');
                $('#branch_manager_name').prop('required', true);
                $('#branch_manager_phone_number').prop('required', true);
                $('#branch_manager_email').prop('required', true);
                $('#branch_manager_password').prop('required', true);
            }
        }

        selectBranchManger('select_from_mangers');
        @endif

        @if(isset($merchant_branch))
        let country_id = '{{$merchant_branch->city->state->country->id}}'
        let state_id   = '{{$merchant_branch->city->state->id}}'
        let city_id    = '{{$merchant_branch->city_id}}'

        getStates(country_id);
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
    var MerchantBranch = function () {
        var demo = function () {
            $('#kt_merchant_branch_manager_repeater').repeater({
                initEmpty: false,

                defaultValues: {
                    'text-input': ''
                },

                show: function () {
                    $(this).slideDown();
                    $('.select2').select2();
                },

                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                },

                isFirstItemUndeletable: true,
            });
        }
        return {
            init: function () {
                demo();
            }
        };
    }();


    function getStates(country_id, selected = '') {
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

    function getCities(state_id, selected = '') {
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

</script>
