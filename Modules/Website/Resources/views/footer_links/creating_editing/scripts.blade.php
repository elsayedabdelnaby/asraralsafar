<script>
    $(document).ready(function() {
        KTFormRepeater.init();

        if ($('#type').val() == 'internal') {
            $('#url').removeAttr('data-parsley-pattern');
            $('#url').removeAttr('data-parsley-pattern-message');
        }

        $('#type').on('change', function() {
            if ($(this).val() == 'external') {
                $('#url').attr('data-parsley-pattern',
                    "https?:\\/\\/(www\\.)?[-a-zA-Z0-9@:%._\\+~#=]{1,256}\\.[a-zA-Z0-9()]{1,6}\\b([-a-zA-Z0-9()!@:%_\\+.~#?&\\/\\/=]*)|www\\.?[-a-zA-Z0-9@:%._\\+~#=]{1,256}\\.[a-zA-Z0-9()]{1,6}\\b([-a-zA-Z0-9()!@:%_\\+.~#?&\\/\\/=]*)"
                );
                $('#url').attr('data-parsley-pattern-message',
                    `{{ __('website::dashboard.url_must_be_in_url_format') }}`);
            } else if ($(this).val() == 'internal') {
                $('#url').removeAttr('data-parsley-pattern');
                $('#url').removeAttr('data-parsley-pattern-message');
            }
        });
    });

    var KTFormRepeater = function() {
        var demo = function() {
            $('#kt_footer_link_translation_repeater').repeater({
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
