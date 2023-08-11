<script>
    "use strict";
    $(function() {
        let getPartnersURL = `{{ route('dashboard.website.partners.index') }}`;
        window.PartnersTable = initPartnersTable(getPartnersURL);
        localStorage.setItem('canUpdatePartner',
            `{{ Auth()->user()->hasPermission('update-partner') }}`);
        localStorage.setItem('canDeletePartner',
            `{{ Auth()->user()->hasPermission('delete-partner') }}`);
    });

    function initPartnersTable(url) {
        return $('#kt_datatable_partners').DataTable({
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
                    name: 'logo',
                    data: 'logo',
                    render: function(data, type, full, meta) {
                        return `<img src="${full.logo_url}" alt="logo" width="100" heigh="100">`;
                    }
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
                            `{{ route('dashboard.website.partners.toggle-status', ['id']) }}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input type="checkbox" class="toggle" ${localStorage.getItem('canUpdatePartner') ? '' : 'disabled'}
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
                        if (localStorage.getItem('canUpdatePartner')) {
                            let editUrl =
                                `{{ route('dashboard.website.partners.edit', ['id']) }}`;
                            editUrl = editUrl.replace('id', full.id);
                            actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('website::dashboard.edit') }}">
                                    <i class="la la-edit"></i>
                                </a>`;
                        }
                        if (localStorage.getItem('canDeletePartner')) {
                            let destroyUrl =
                                `{{ route('dashboard.website.partners.destroy', ['id']) }}`;
                            destroyUrl = destroyUrl.replace('id', full.id);
                            actions +=
                                `<a href="javascript:;" onClick="deleteRecord('${destroyUrl}', ${full.id}, deletePartnerCallBack)"
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

    function deletePartnerCallBack() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            window.PartnersTable.ajax.reload(function(json) {}, false);
        }, 300);
    }
</script>
