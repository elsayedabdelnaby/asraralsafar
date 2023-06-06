<script>
    $(document).ready(function () {
        KTFormRepeater.init();
        var imageProfile = new KTImageInput('image');
        $('.rtf').summernote();

        $('input[type=checkbox]').on('change', function () {
            if ($(this).is(':checked')) {
                $('#' + $(this).data('invisible-row-id')).removeClass('invisible');
            }
            else {
                $('#' + $(this).data('invisible-row-id')).addClass('invisible');
                $('#' + $(this).data('invisible-row-id')).find('input').val(0);
            }
        });

        $(document).on('change', '.name-input', function () {
            $(this).closest('div[data-repeater-item]').find('.slug-input').val($(this).val()
                .toLowerCase().replace(/\s/g, "-"));
        });
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
