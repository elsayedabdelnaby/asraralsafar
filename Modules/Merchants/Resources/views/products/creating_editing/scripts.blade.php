<script>
    $(document).ready(function () {

        new KTImageInput('image');
        KTFormRepeater.init();

        $('#category_type_id').on('change', function () {
            let category_type_id = $(this).val();
            if (category_type_id == '') {
                return;
            }

            getCategories(category_type_id);
        });

        $('#type').on('change',function (){
            changeProductType($(this).val());
        });

        function getCategories(category_type_id) {
            let categoryTypeIdURL = `{{ route('dashboard.merchants.products.getCategories', ['merchant_id'=>$merchant->id,'category_type_id']) }}`;
            categoryTypeIdURL     = categoryTypeIdURL.replace('category_type_id', category_type_id);
            $.ajax({
                url: categoryTypeIdURL,
                type: 'get',
                cache: false,
                contentType: false,
                processData: false,
                success: function (response, selected) {
                    $('#category_id').html('');
                    response.data.forEach(function (item) {
                        $('#category_id').append(`<option value="${item.id}">${item.name}</option>`)
                    });
                }
            });
        }

        function changeProductType(type){
            if (type == 'simple'){
                $('#simple').removeClass('d-none');
                $('#price').prop('required',true);
            }else{
                $('#simple').addClass('d-none');
                $('#price').prop('required',false);
            }
        }

        changeProductType('simple');

        @if(isset($merchant_product))
            let category_id = '{{collect($merchant_product->categories)->pluck('id')->implode(',')}}';
            getCategories({{$merchant_product->category_type_id}});
            setTimeout(function (){
                $.each(category_id.split(","), function (i, e) {
                    $("#category_id option[value='" + e + "']").prop("selected", true).change();
                });
            },2000);
            changeProductType('{{$merchant_product->type}}');
        @endif
    });


    var KTFormRepeater = function () {
        var demo = function () {
            $('#kt_translation_repeater').repeater({
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
