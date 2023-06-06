<script>
    $(document).ready(function () {

        var imageProfile = new KTImageInput('image');
        $('.rtf').summernote();

        $(document).on('change', '.name-input', function () {
            $(this).closest('div[data-repeater-item]').find('.slug-input').val($(this).val()
                .toLowerCase().replace(/\s/g, "-"));
        });
    });

</script>
