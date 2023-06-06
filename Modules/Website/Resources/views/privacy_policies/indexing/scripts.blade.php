<script>
    "use strict";
    $(function() {
        let getPrivacyPoliciesURL = `{{ route('dashboard.website.privacy-policies.index') }}`;
        window.privacyPolicyTable = initPrivacyPoliciesTable(getPrivacyPoliciesURL);
        localStorage.setItem('canUpdatePrivacyPolicy',
            `{{ Auth()->user()->hasPermission('update-privacy-policy') }}`);
        localStorage.setItem('canDeletePrivacyPolicy',
            `{{ Auth()->user()->hasPermission('delete-privacy-policy') }}`);
    });

    function initPrivacyPoliciesTable(url) {
        return $('#kt_datatable_privacy_policies').DataTable({
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
                    name: 'title',
                    data: 'title'
                },
                {
                    name: 'description',
                    data: 'description',
                    render: function(data, type, full, meta) {
                        return full.description.replace(/(<([^>]+)>)/gi, "").substr(1, 150) + '...';
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
                            `{{ route('dashboard.website.privacy-policies.toggle-status', ['id']) }}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input type="checkbox" class="toggle" ${localStorage.getItem('canUpdatePrivacyPolicy') ? '' : 'disabled'}
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
                        if (localStorage.getItem('canUpdatePrivacyPolicy')) {
                            let editUrl =
                                `{{ route('dashboard.website.privacy-policies.edit', ['id']) }}`;
                            editUrl = editUrl.replace('id', full.id);
                            actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('website::dashboard.edit') }}">
                                    <i class="la la-edit"></i>
                                </a>`;
                        }
                        if (localStorage.getItem('canDeletePrivacyPolicy')) {
                            let destroyUrl =
                                `{{ route('dashboard.website.privacy-policies.destroy', ['id']) }}`;
                            destroyUrl = destroyUrl.replace('id', full.id);
                            actions +=
                                `<a href="javascript:;" onClick="deleteRecord('${destroyUrl}', ${full.id}, deletePrivacyPolicyCallBack)"
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

    function deletePrivacyPolicyCallBack() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            window.privacyPolicyTable.ajax.reload(function(json) {}, false);
        }, 300);
    }
</script>
