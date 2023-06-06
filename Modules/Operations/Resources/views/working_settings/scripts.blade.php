<script>
    $(document).ready(function() {
        const mainLogo = new KTImageInput('main_logo');
        const footerLogo = new KTImageInput('footer_logo');
        KTFormRepeater.init();
    });

    var KTFormRepeater = function() {
        var demo = function() {
            $('#kt_website_information_translation_name_repeater').repeater({
                initEmpty: false,

                defaultValues: {
                    'text-input': ''
                },

                show: function() {
                    $(this).slideDown();
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
