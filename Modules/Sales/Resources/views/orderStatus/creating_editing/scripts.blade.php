<script>
    $(document).ready(function() {
        $('.show-hide-password-btn').click(function() {
            if ($(this).parents('.input-group').find('input.password-input').attr('type') ===
                'password') {
                $(this).parents('.input-group').find('input.password-input').attr('type', 'text');
                $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                $(this).parents('.input-group').find('input.password-input').attr('type', 'password');
                $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        var imageProfile = new KTImageInput('image_profile');
    });
</script>
