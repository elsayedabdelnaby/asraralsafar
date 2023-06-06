<script>
    var mainCurrencyName = `{{ $mainCurrencyName }}`;
    var isMainCurrency = `{{ $isMainCurrency }}`;
    $(document).ready(function() {
        KTFormRepeater.init();
        $('#is_main').on('change', function(e) {
            if ($(this).is(':checked')) {
                warningMessage = "{{ __('settings::dashboard.are_you_sure_to_change_it') }}!";
                Swal.fire({
                    title: mainCurrencyName + ' ' +
                        '{{ __('settings::dashboard.is_main_currency') }}',
                    text: warningMessage,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{ __('settings::dashboard.yes_change_it') }}'
                }).then((result) => {
                    if (!result.isConfirmed) {
                        $(this).prop('checked', false);
                    }
                });
            } else {
                if (isMainCurrency) {
                    warningMessage =
                        "{{ __('settings::dashboard.can_not_change_it_until_select_another_one') }}!";
                    Swal.fire({
                        title: mainCurrencyName + ' ' +
                            '{{ __('settings::dashboard.is_main_currency') }}',
                        text: warningMessage,
                        icon: 'warning',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: '{{ __('settings::dashboard.ok') }}'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).prop('checked', true);
                        }
                    });
                }
                $(this).prop('checked', false);
            }
        });
    });

    var KTFormRepeater = function() {
        var demo = function() {
            $('#kt_currency_translation_repeater').repeater({
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
