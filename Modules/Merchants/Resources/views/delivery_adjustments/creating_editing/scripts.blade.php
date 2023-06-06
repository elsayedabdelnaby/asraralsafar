<script>
    $(document).ready(function () {
        KTFormRepeater.init();

        $('#country_id').on('change', function () {
            getStates($(this).val(), '{{ route('dashboard.locations.states.index', ['country_id']) }}');
        });
        $('#state_id').on('change', function () {
            getCitiesFromTo($(this).val(), '{{ route('dashboard.locations.cities.index', ['country_id','state_id']) }}');
        });
        $('#merchant_id').on('change', function () {
            let merchant_id = $(this).val();

            if (merchant_id == ''){
                return;
            }

            getProducts(merchant_id);
        });
        $('#type').on('change', function () {
            prepareDeliveryAdjustmentsSections($(this).val());
        });

        function prepareDeliveryAdjustmentsSections(type) {
            $('.cities_section').addClass('d-none');
            $('.products_section').addClass('d-none');
            $('.merchants_section').addClass('d-none');
            $(`.cities_section select`).prop('required', false);
            $(`.products_section select`).prop('required', false);
            $(`.merchants_section select`).prop('required', false);
            $(`.${type}_section`).removeClass('d-none');
            $(`.${type}_section select`).prop('required', true);
        }

        prepareDeliveryAdjustmentsSections($('#type').val());

        function getProducts(merchant_id) {
            let getMerchantProductsUrl = `{{route('dashboard.merchants.products.getMerchantProducts',['merchant_id'])}}`;
            getMerchantProductsUrl     = getMerchantProductsUrl.replace('merchant_id', merchant_id);
            $('#products_ids').html('');
            $.ajax({
                    url: getMerchantProductsUrl,
                    type: 'get',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response, selected) {
                        response.data.forEach(function (item) {
                            $('#products_ids').append(`<option value="${item.id}">${item.name}</option>`)
                        });
                    }
                }
            );
        }

        function getCitiesFromTo(state_id) {
            let getCitiesURL = `<?php echo e(route('dashboard.locations.cities.index', ['country_id', 'state_id'])); ?>`;
            getCitiesURL     = getCitiesURL.replace('country_id', $('#country_id').val());
            getCitiesURL     = getCitiesURL.replace('state_id', state_id);
            $.ajax({
                    url: getCitiesURL,
                    type: 'get',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        $('#city_from').html(`<option> <?php echo e(__('merchants::dashboard.select_city')); ?> </option>`);
                        $('#city_to').html(`<option> <?php echo e(__('merchants::dashboard.select_city')); ?> </option>`);
                        response.data.forEach(function (item) {
                            $('#city_from').append(`<option value="${item.id}">${item.name}</option>`);
                            $('#city_to').append(`<option value="${item.id}">${item.name}</option>`);
                        });
                    }
                }
            );
        }


        @if(isset($delivery_adjustments))
            $('#type').val('{{$delivery_adjustments->type}}').change();
            @if($delivery_adjustments->type == 'cities')
                let country_id = '{{$delivery_adjustments->applying->first()->cityFrom->state->country_id}}';
                let state_id = '{{$delivery_adjustments->applying->first()->cityFrom->state_id}}'
                let city_from = '{{$delivery_adjustments->applying->first()->from_city_id}}';
                let city_to = '{{$delivery_adjustments->applying->first()->to_city_id}}';
                setTimeout(function (){
                    $('#country_id').val(country_id).change();
                },1000);
                setTimeout(function () {
                    $('#state_id').val(state_id).change();
                },2000);
                setTimeout(function () {
                    console.log(city_from,city_to);
                    $('#city_from').val(city_from).change();
                    $('#city_to').val(city_to).change();
                }, 3000);
            @elseif($delivery_adjustments->type == 'products')
                $('#merchant_id').val('{{$delivery_adjustments->applying->first()->MerchantProduct()}}').change();
                setTimeout(function () {
                    let products_ids = '{{collect($delivery_adjustments->applying)->pluck('product_id')->implode(',')}}';
                    $.each(products_ids.split(","), function (i, e) {
                        $("#products_ids option[value='" + e + "']").prop("selected", true).change();
                    });
                }, 3000)
            @elseif($delivery_adjustments->type == 'merchants')
                setTimeout(function () {
                    let products_ids = '{{collect($delivery_adjustments->applying)->pluck('merchants_id')->implode(',')}}';
                    $.each(products_ids.split(","), function (i, e) {
                        $("#merchant_ids option[value='" + e + "']").prop("selected", true).change();
                    });
                }, 3000)
            @endif
        @endif



    });

    var KTFormRepeater = function () {
        var demo = function () {
            $('#kt_repeater').repeater({
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
</script>
