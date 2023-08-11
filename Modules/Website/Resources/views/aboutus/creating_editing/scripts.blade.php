<script>
    $(document).ready(function() {
        KTFormRepeater.init();
        $('.rtf').summernote();
    });

    var KTFormRepeater = function() {
        var demo = function() {
            $('#kt_about_us_translation_repeater').repeater({
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
