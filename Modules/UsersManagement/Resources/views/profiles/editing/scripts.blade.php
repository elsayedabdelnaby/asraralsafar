<script>
    // Class definition
    var KTFormRepeater = function() {

        // Private functions
        var demo = function() {
            $('#kt_profile_translation_name_repeater').repeater({
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
            // public functions
            init: function() {
                demo();
            }
        };
    }();

    jQuery(document).ready(function() {
        KTFormRepeater.init();
    });
</script>
