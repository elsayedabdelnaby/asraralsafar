<script>
    "use strict";
    $(function() {
        let getServicesURL = `{{ route('dashboard.website.services.index') }}`;
        window.ServicesTable = initServicesTable(getServicesURL);
        localStorage.setItem('canUpdateService',
            `{{ Auth()->user()->hasPermission('update-service') }}`);
        localStorage.setItem('canDeleteService',
            `{{ Auth()->user()->hasPermission('delete-service') }}`);
    });

    function initServicesTable(url) {
        return $('#kt_datatable_services').DataTable({
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
                    name: 'display_order',
                    data: 'display_order'
                },
                {
                    name: 'status',
                    data: 'is_active',
                    render: function(data, type, full, meta) {
                        let toggleURL =
                            `{{ route('dashboard.website.services.toggle-status', ['id']) }}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input type="checkbox" class="toggle" ${localStorage.getItem('canUpdateService') ? '' : 'disabled'}
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
                        if (localStorage.getItem('canUpdateService')) {
                            let editUrl =
                                `{{ route('dashboard.website.services.edit', ['id']) }}`;
                            editUrl = editUrl.replace('id', full.id);
                            actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('website::dashboard.edit') }}">
                                    <i class="la la-edit"></i>
                                </a>`;
                        }
                        if (localStorage.getItem('canDeleteService')) {
                            let destroyUrl =
                                `{{ route('dashboard.website.services.destroy', ['id']) }}`;
                            destroyUrl = destroyUrl.replace('id', full.id);
                            actions +=
                                `<a href="javascript:;" onClick="deleteRecord('${destroyUrl}', ${full.id}, deleteServiceCallBack)"
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

    function deleteServiceCallBack() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            window.ServicesTable.ajax.reload(function(json) {}, false);
        }, 300);
    }
</script>
