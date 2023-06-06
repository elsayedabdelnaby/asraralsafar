<script>
    $(document).ready(function() {
        $('#type').on('change', function() {
            if ($(this).val() == 'phone' || $(this).val() == 'whatsapp') {
                $('#value').attr('data-parsley-pattern', `/^[0-9]{5,13}$/`);
                $('#value').attr('data-parsley-pattern-message',
                    `{{ __('website::dashboard.phone_must_be_in_phone_number_formate') }}`);
                $('#value').attr('data-parsley-required-message',
                    `{{ __('website::dashboard.phone_is_required') }}`);
                $('#value').attr('placeholder', `{{ __('website::dashboard.phone') }}`);
            } else if ($(this).val() != '' && $(this).val() != 'phone' && $(this).val() != 'whatsapp') {
                $('#value').attr('data-parsley-pattern',
                    "/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/");
                $('#value').attr('data-parsley-pattern-message',
                    `{{ __('website::dashboard.value_must_be_in_email_format') }}`);
                $('#value').attr('data-parsley-required-message',
                    `{{ __('website::dashboard.email_is_required') }}`);
                $('#value').attr('placeholder', `{{ __('website::dashboard.email') }}`);
            }
        });
    });
</script>
