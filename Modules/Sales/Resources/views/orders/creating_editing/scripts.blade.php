<script>
    $(document).ready(function() {
        KTFormRepeater.init();
        $('.rtf').summernote();

        $('input[type=checkbox]').on('change', function() {
            if ($(this).is(':checked')) {
                $('#' + $(this).data('invisible-row-id')).removeClass('invisible');
            } else {
                $('#' + $(this).data('invisible-row-id')).addClass('invisible');
                $('#' + $(this).data('invisible-row-id')).find('input').val(0);
            }
        });

        $(document).on('change', '.name-input', function() {
            $(this).closest('div[data-repeater-item]').find('.slug-input').val($(this).val()
                .toLowerCase().replace(/\s/g, "-"));
        });

        $('#customer_id').on('change', function () {
            getAddresses($(this).val(), '')
        });
        $('#merchant_id').on('change', function () {
            getBranches($(this).val(), '');
        });
        $('#address_id').on('change', function () {
            getDeliveries($(this).val(), '');
        });


    });

    var KTFormRepeater = function() {
        var demo = function() {
            $('#kt_product_repeater').repeater({
                initEmpty: false,

                defaultValues: {
                    'text-input': ''
                },

                show: function() {
                    $(this).slideDown();
                    $('.select2').select2();
                    $('.rtf').summernote();
                },

                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                },

                isFirstItemUndeletable: true,
            });
        }

        return {
            init: function() {
                demo();
            }
        };
    }();

    function getAddresses(customer_id, selected = '') {
        let getAddressURL = `{{ route('dashboard.sales.orders.customer-address', ['customer_id']) }}`;
        getAddressURL     = getAddressURL.replace('customer_id', customer_id);
        $.ajax({
                url: getAddressURL,
                type: 'get',
                cache: false,
                contentType: false,
                processData: false,
                success: function (response, selected) {
                    $('#address_id').html(`<option> {{__('sales::dashboard.select_address')}} </option>`);
                    response.data.forEach(function (item) {
                        $('#address_id').append(
                            `<option value="${item.id}">${item.address}</option>`
                        )
                    });
                }
            }
        );
    }

    function getBranches(merchant_id, selected = '') {
        let getAddressURL = `{{ route('dashboard.sales.orders.merchant-branch', ['merchant_id']) }}`;
        getAddressURL     = getAddressURL.replace('merchant_id', merchant_id);
        $.ajax({
                url: getAddressURL,
                type: 'get',
                cache: false,
                contentType: false,
                processData: false,
                success: function (response, selected) {
                    $('#branch_id').html(`<option> {{__('sales::dashboard.select_branch')}} </option>`);
                    response.data.forEach(function (item) {
                        $('#branch_id').append(
                            `<option value="${item.id}">${item.name}</option>`
                        )
                    });
                }
            }
        );
    }

    function getDeliveries(address_id, selected = '') {
        let getDeliveryURL = `{{ route('dashboard.sales.orders.address-delivery', ['address_id']) }}`;
        getDeliveryURL     = getDeliveryURL.replace('address_id', address_id);
        $.ajax({
                url: getDeliveryURL,
                type: 'get',
                cache: false,
                contentType: false,
                processData: false,
                success: function (response, selected) {
                    $('#delivery_id').html(`<option> {{__('sales::dashboard.select_delivery')}} </option>`);
                    response.data.forEach(function (item) {
                        $('#delivery_id').append(
                            `<option value="${item[0].id}">${item[0].name}</option>`
                        )
                    });
                }
            }
        );
    }
</script>
