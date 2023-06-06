<script>
    "use strict";
    $(function() {
        let treeview = {
            resetBtnToggle: function() {
                $(".js-treeview")
                    .find(".level-add")
                    .find("span")
                    .removeClass()
                    .addClass("fa fa-plus");
                $(".js-treeview")
                    .find(".level-add")
                    .siblings()
                    .removeClass("in");
            },
        };

        // Selected Level
        $(".js-treeview").on("click", ".level-title", function() {
            let isSelected = $(this).closest("[data-level]").hasClass("selected");
            !isSelected && $(this).closest(".js-treeview").find("[data-level]").removeClass("selected");
            $(this).closest("[data-level]").toggleClass("selected");
        });

        $(document).on("click", ".delete-role", function() {
            const roleId = $(this).data('id');
            const deleteURL = $(this).data('delete-url');
            const usersCount = $(this).data('users-count');
            if ($(this).data('users-count')) {
                Swal.fire({
                    title: '{{ __('dashboard.can_not_delete') }}',
                    text: '{{ __('usersmanagement::dashboard.it_has') }} ' +
                        usersCount +
                        '{{ __('usersmanagement::dashboard.users') . __('usersmanagement::dashboard.plz_change_the_roles_of_these_users_and_back_to_delete_it') }}',
                    icon: 'info',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: '{{ __('dashboard.ok') }}'
                });
            } else {
                deleteRecord(deleteURL, roleId, refreshRolesPage);
            }
        });
    });

    function refreshRolesPage() {
        window.location.href =
            '{{ route('dashboard.users-management.roles.index') }}';
    }
</script>
