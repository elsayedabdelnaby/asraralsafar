<script>
    $(document).ready(function() {
        KTFormRepeater.init();
        $('.rtf').summernote();
        var imageProfile = new KTImageInput('image');
    });

    $(document).on('change', '.title-input', function() {
        $(this).closest('div[data-repeater-item]').find('.slug-input').val($(this).val()
            .toLowerCase().replace(/\s/g, "-"));
    });

    var KTFormRepeater = function() {
        var demo = function() {
            $('#kt_service_translation_repeater').repeater({
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
</script>
