<script>
    "use strict";
    $(function() {
        let getAvatarsURL = `{{ route('dashboard.users-management.avatars.index') }}`;
        window.AvatarsTable = initAvatarsTable(getAvatarsURL);
        localStorage.setItem('canUpdateAvatar',
            `{{ Auth()->user()->hasPermission('update-avatar') }}`);
        localStorage.setItem('canDeleteAvatar',
            `{{ Auth()->user()->hasPermission('delete-avatar') }}`);
    });

    function initAvatarsTable(url) {
        return $('#kt_datatable_avatars').DataTable({
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
                    name: 'image',
                    data: 'avatar_url',
                    render: function(data, type, full, meta) {
                        return `<img src="${full.avatar_url}" alt="avatar" width="100" height="100">`;
                    }
                },
                {
                    name: 'status',
                    data: 'is_active',
                    render: function(data, type, full, meta) {
                        let toggleURL =
                            `{{ route('dashboard.users-management.avatars.toggle-status', ['id']) }}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input type="checkbox" class="toggle" ${localStorage.getItem('canUpdateAvatar') ? '' : 'disabled'}
                                            ${full.is_active ? 'checked' : ''} name="is_active"
                                            data-name="is_active" data-id="${full.id}" data-toggle-url="${toggleURL}" />
                                        <span></span>
                                    </label>
                                </span>`;
                    },
                },
                {
                    name: 'actions',
                    data: 'actions',
                    render: function(data, type, full, meta) {
                        let actions = '';
                        if (localStorage.getItem('canUpdateAvatar')) {
                            let editUrl =
                                `{{ route('dashboard.users-management.avatars.edit', ['id']) }}`;
                            editUrl = editUrl.replace('id', full.id);
                            actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('website::dashboard.edit') }}">
                                    <i class="la la-edit"></i>
                                </a>`;
                        }
                        if (localStorage.getItem('canDeleteAvatar')) {
                            let destroyUrl =
                                `{{ route('dashboard.users-management.avatars.destroy', ['id']) }}`;
                            destroyUrl = destroyUrl.replace('id', full.id);
                            actions +=
                                `<a href="javascript:;" onClick="deleteRecord('${destroyUrl}', ${full.id}, deleteAvatarCallBack)"
                                    class="btn btn-sm btn-clean btn-icon" title="{{ __('website::dashboard.delete') }}">
                                    <i class="la la-trash"></i>
                                </a>`;
                        }
                        return actions;
                    },
                },
            ],
        });
    };

    function deleteAvatarCallBack() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            window.AvatarsTable.ajax.reload(function(json) {}, false);
        }, 300);
    }
</script>
