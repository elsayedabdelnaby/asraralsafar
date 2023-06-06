<script>
    "use strict";
    $(function() {
        let getProfilesURL = `{{ route('dashboard.users-management.profiles.index') }}`;
        let profilesTable = initProfilesTable(getProfilesURL);
    });

    function initProfilesTable(url) {
        return $('#kt_datatable_profiles').DataTable({
            responsive: true,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: {
                url: url,
                type: 'get',
                data: {
                    // parameters for custom backend script demo
                    columnsDef: [],
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
                    name: 'status',
                    data: 'is_active',
                    render: function(data, type, full, meta) {
                        var status = {
                            1: {
                                'title': `{{ __('usersmanagement::dashboard.active') }}`,
                                'class': ' label-light-success'
                            },
                            0: {
                                'title': '{{ __('usersmanagement::dashboard.not_active') }}',
                                'class': ' label-light-danger'
                            },
                        };
                        if (typeof status[data] === 'undefined') {
                            return data;
                        }
                        return '<span class="label label-lg font-weight-bold' + status[data]
                            .class + ' label-inline">' +
                            status[data].title + '</span>';
                    },
                },
                {
                    name: 'actions',
                    data: 'Actions',
                    render: function(data, type, full, meta) {
                        let actions = '';
                        @if (Auth()->user()->hasPermission('view-profile'))
                            let viewUrl =
                                `{{ route('dashboard.users-management.profiles.show', ['id']) }}`;
                            viewUrl = viewUrl.replace('id', full.id);
                            actions += `<a href="${viewUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('usersmanagement::dashboard.edit') }}">
                                    <i class="la la-eye"></i>
                                </a>`;
                        @endif
                        @if (Auth()->user()->hasPermission('update-profile'))
                            if (full.id != 1) {
                                let editUrl =
                                    `{{ route('dashboard.users-management.profiles.edit', ['id']) }}`;
                                editUrl = editUrl.replace('id', full.id);
                                actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('usersmanagement::dashboard.edit') }}">
                                    <i class="la la-edit"></i>
                                </a>`;
                            }
                        @endif
                        @if (Auth()->user()->hasPermission('delete-profile'))
                            if (full.id != 1) {
                                let deleteUrl =
                                    `{{ route('dashboard.users-management.profiles.delete', ['id']) }}`;
                                deleteUrl = deleteUrl.replace('id', full.id);
                                actions +=
                                    `<a href="javascript:;" onClick="deleteProfile(${full.id}, '${deleteUrl}')" data-id="` +
                                    full.id + `" class="btn btn-sm btn-clean btn-icon" title="{{ __('usersmanagement::dashboard.delete') }}">
                                    <i class="la la-trash"></i>
                                </a>`;
                            }
                        @endif
                        return actions;
                    },
                },
            ],
        });
    };

    function deleteProfile(profileId, deleteUrl) {
        $.ajax({
            type: 'GET',
            url: deleteUrl,
            dataType: 'json',
            data: {
                "id": profileId
            },
            success: function(response) {
                $('#deleteProfile').find('.modal-content').html(response.html);
                $('#deleteProfile').modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError) {

            }
        });
    }
</script>
