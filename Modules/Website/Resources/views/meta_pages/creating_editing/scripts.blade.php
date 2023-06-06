<script>
    $(document).ready(function() {
        KTFormRepeater.init();
        var imageProfile = new KTImageInput('image');
    });

    var KTFormRepeater = function() {
        var demo = function() {
            $('#kt_meta_page_translation_repeater').repeater({
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
