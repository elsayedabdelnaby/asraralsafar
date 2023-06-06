<script>
    "use strict";
    $(function() {
        let getUsersURL = `{{ route('dashboard.users-management.users.index') }}`;
        let usersTable = initUsersTable(getUsersURL);
        localStorage.setItem('canUpdateUser', `{{ Auth()->user()->hasPermission('update-user') }}`);
        localStorage.setItem('canDeleteUser', `{{ Auth()->user()->hasPermission('delete-user') }}`);
    });

    function initUsersTable(url) {
        return $('#kt_datatable_users').DataTable({
            responsive: true,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: {
                url: url,
                type: 'get',
                data: {
                    // parameters for custom backend script demo
                    columnsDef: []
                },
            },
            columns: [{
                    name: 'id',
                    data: 'id'
                },
                {
                    name: 'name',
                    data: 'name'
                },
                {
                    name: 'email',
                    data: 'email'
                },
                {
                    name: 'role',
                    data: 'role_name'
                },
                {
                    name: 'status',
                    data: 'is_active',
                    render: function(data, type, full, meta) {
                        let toggleURL =
                            `{{ route('dashboard.users-management.users.toggle-status', ['id']) }}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input type="checkbox" class="toggle" ${localStorage.getItem('canUpdateUser') ? '' : 'disabled'}
                                            ${full.is_active ? 'checked' : ''} name="is_active"
                                            data-name="is_active" data-id="${full.id}" data-toggle-url="${toggleURL}" />
                                        <span></span>
                                    </label>
                                </span>`;
                    },
                },
                {
                    name: 'actions',
                    data: 'Actions',
                    render: function(data, type, full, meta) {
                        let actions = '';
                        if (localStorage.getItem('canUpdateUser')) {
                            let editUrl =
                                `{{ route('dashboard.users-management.users.edit', ['id']) }}`;
                            editUrl = editUrl.replace('id', full.id);
                            actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('usersmanagement::dashboard.edit') }}">
                                    <i class="la la-edit"></i>
                                </a>`;
                            let editPasswordURL =
                                `{{ route('dashboard.users-management.users.edit-password', ['id']) }}`;
                            editPasswordURL = editPasswordURL.replace('id', full.id);
                            actions += `<a href="javascript:;" data-url="${editPasswordURL}" onclick="openModal('editPassword', '${editPasswordURL}', ${full.id})"
                            class="btn btn-sm btn-clean btn-icon edit-password" title="{{ __('usersmanagement::dashboard.edit_password') }}">
                                    <i class="la la-eye"></i>
                                </a>`;
                        }
                        if (localStorage.getItem('canDeleteUser')) {
                            if (full.id != 1) {
                                let deleteUrl =
                                    `{{ route('dashboard.users-management.users.delete', ['id']) }}`;
                                deleteUrl = deleteUrl.replace('id', full.id);
                                actions +=
                                    `<a href="javascript:;" onClick="showDeleteForm(${full.id}, '${deleteUrl}', 'deleteUser')" data-id="` +
                                    full.id + `" class="btn btn-sm btn-clean btn-icon" title="{{ __('usersmanagement::dashboard.delete') }}">
                                    <i class="la la-trash"></i>
                                </a>`;
                            }
                        }
                        return actions;
                    },
                },
            ],
        });
    };
</script>
