<script>
    $(document).ready(function () {

        KTFormRepeater.init();

        $('select.select2').css('opacity', 1);

        $('body').on('change', '.product_attribute', function () {
            iniAttributeOptions($(this));
        });

        function iniAttributeOptions(element) {
            let product_attribute_id   = element.val();
            let product_attribute_type = element.find(':selected').data('type');
            let getAttributeOptionsUrl = `{{route('dashboard.merchants.products-variant.getAttributeOptions',['merchant_id'=>$merchant->id,'product_id'=>$product->id,'id'])}}`;
            getAttributeOptionsUrl     = getAttributeOptionsUrl.replace('id', product_attribute_id);

            if (product_attribute_type === "select") {
                element.closest('.select_product_attribute').find('.product_type_options').removeClass('d-none');
                element.closest('.select_product_attribute').find('.product_type_value').addClass('mt-15')
                element.closest('.select_product_attribute').find('.attribute_type_selected').val('select');
                let select_attribute_options = element.closest('.select_product_attribute').find('.product_type_options').find('.product_attribute_option');
                $.ajax({
                    url: getAttributeOptionsUrl,
                    type: 'get',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        select_attribute_options.html('');
                        response.data.forEach(function (item) {
                            select_attribute_options.append(`<option value="${item.id}">${item.name}</option>`);
                        });
                    }
                });
            }
            else {
                element.closest('.select_product_attribute').find('.product_type_options').addClass('d-none')
                element.closest('.select_product_attribute').find('.product_type_value').removeClass('mt-15');
                element.closest('.select_product_attribute').find('.attribute_type_selected').val('text');
            }
        }

        $('.product_attribute').each(function(i,element){
             iniAttributeOptions($(this));
        });


        @forelse (isset($product_variant)   ? collect($product_variant->attributes)->toArray() : [] as $variant)
            setTimeout(function (){
                $('.product_attribute_option[data-id="{{$variant['id']}}"]').val({{$variant['product_attribute_option_id']}});
        },2000)
        @endforeach


    });


    var KTFormRepeater = function () {
        var demo = function () {
            $('#kt_variants_repeater').repeater({
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
