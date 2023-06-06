<script>
    $(document).ready(function () {
        KTFormRepeater.init();
        KTAttributeOptionsRepeater.init();
        $('.hide_all_options_default').hide();

        $('#attribute-options').find(':input').each(function () {
            $(this).removeAttr('required');
        });

        $('#type').on('change', function () {
            if ($(this).val() == 'Text') {
                $('#attribute-options').addClass('d-none');
                $('#attribute-options').find(':input').each(function () {
                    $(this).removeAttr('required');
                });
            }
            else if ($(this).val() == 'Select') {
                $('#attribute-options').removeClass('d-none');
                $('#attribute-options').find(':input').each(function () {
                    $(this).attr('required', 'required');
                });
                $('#option_is_active').each(function () {
                    $(this).removeAttr('required')
                });
            }
        });


        @if(isset($product_attribute_options))
        $('#type').change().trigger();
        @endif

    });

    var KTFormRepeater = function () {
        var demo = function () {
            $('#kt_product_attribute_translation_repeater').repeater({
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

    var KTAttributeOptionsRepeater = function () {
        var demo = function () {
            $('#attribute-options').repeater({
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
                repeaters: [{
                    // (Required)
                    // Specify the jQuery selector for this nested repeater
                    selector: '.inner-repeater',
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
                }]
            });
        }

        return {
            init: function () {
                demo();
            }
        };
    }();
</script>
