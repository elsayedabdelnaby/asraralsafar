<script>
    $(document).ready(function() {
        MerchantTranslation.init();

        new KTImageInput('merchant_image');

        $(document).on('change', '.title-input', function() {
            $(this).closest('div[data-repeater-item]').find('.slug-input').val($(this).val()
                .toLowerCase().replace(/\s/g, "-"));
        });

        $('.rtf').summernote();
    });


    var MerchantTranslation = function() {
        var demo = function() {
            $('#kt_merchant_info_translation_repeater').repeater({
                initEmpty: false,

                defaultValues: {
                    'text-input': ''
                },

                show: function() {
                    $(this).slideDown();
                    $('.select2').select2();
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
</script>
