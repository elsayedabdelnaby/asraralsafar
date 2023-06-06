<script>
    "use strict";
    $(function() {
        let getTermsConditionsURL = `{{ route('dashboard.website.terms-conditions.index') }}`;
        window.termsConditionsTable = initTermsConditionsTable(getTermsConditionsURL);
        localStorage.setItem('canUpdateTermCondition',
            `{{ Auth()->user()->hasPermission('update-term-condition') }}`);
        localStorage.setItem('canDeleteTermCondition',
            `{{ Auth()->user()->hasPermission('delete-term-condition') }}`);
    });

    function initTermsConditionsTable(url) {
        return $('#kt_datatable_terms_conditions').DataTable({
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
                            `{{ route('dashboard.website.terms-conditions.toggle-status', ['id']) }}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input type="checkbox" class="toggle" ${localStorage.getItem('canUpdateTermCondition') ? '' : 'disabled'}
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
                        if (localStorage.getItem('canUpdateTermCondition')) {
                            let editUrl =
                                `{{ route('dashboard.website.terms-conditions.edit', ['id']) }}`;
                            editUrl = editUrl.replace('id', full.id);
                            actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('website::dashboard.edit') }}">
                                    <i class="la la-edit"></i>
                                </a>`;
                        }
                        if (localStorage.getItem('canDeleteTermCondition')) {
                            let destroyUrl =
                                `{{ route('dashboard.website.terms-conditions.destroy', ['id']) }}`;
                            destroyUrl = destroyUrl.replace('id', full.id);
                            actions +=
                                `<a href="javascript:;" onClick="deleteRecord('${destroyUrl}', ${full.id}, deleteTermConditionCallBack)"
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

    function deleteTermConditionCallBack() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            window.termsConditionsTable.ajax.reload(function(json) {}, false);
        }, 300);
    }
</script>
