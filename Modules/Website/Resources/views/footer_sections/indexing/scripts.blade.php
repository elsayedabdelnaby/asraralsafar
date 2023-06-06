<script>
    "use strict";
    $(function() {
        let getFooterSectionsURL =
            `{{ route('dashboard.website.footer-sections.index') }}`;
        window.footerSectionsTable = initFooterSectionsTable(getFooterSectionsURL);
        localStorage.setItem('canUpdateFooterSection',
            `{{ Auth()->user()->hasPermission('update-footer-section') }}`);
        localStorage.setItem('canDeleteFooterSection',
            `{{ Auth()->user()->hasPermission('delete-footer-section') }}`);
    });

    function initFooterSectionsTable(url) {
        return $('#kt_datatable_footer_sections').DataTable({
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
                            `{{ route('dashboard.website.footer-sections.toggle-status', ['id']) }}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input type="checkbox" class="toggle" ${localStorage.getItem('canUpdateFooterSection') ? '' : 'disabled'}
                                            ${full.is_active ? 'checked' : ''} name="is_active"
                                            data-name="is_active" data-id="${full.id}" data-toggle-url="${toggleURL}" />
                                        <span></span>
                                    </label>
                                </span>`;
                    },
                },
                {
                    name: 'links',
                    data: 'links',
                    render: function(data, type, full, meta) {
                        return `<a href="${full.links}">{{ __('website::dashboard.links') }}</a>`;
                    }
                },
                {
                    name: 'actions',
                    data: 'actions',
                    render: function(data, type, full, meta) {
                        let actions = '';
                        if (localStorage.getItem('canUpdateFooterSection')) {
                            let editUrl =
                                `{{ route('dashboard.website.footer-sections.edit', ['id']) }}`;
                            editUrl = editUrl.replace('id', full.id);
                            actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('website::dashboard.edit') }}">
                                    <i class="la la-edit"></i>
                                </a>`;
                        }
                        if (localStorage.getItem('canDeleteFooterSection')) {
                            let destroyUrl =
                                `{{ route('dashboard.website.footer-sections.destroy', ['id']) }}`;
                            destroyUrl = destroyUrl.replace('id', full.id);
                            actions +=
                                `<a href="javascript:;" onClick="deleteRecord('${destroyUrl}', ${full.id}, deleteFooterSectionCallBack)"
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

    function deleteFooterSectionCallBack() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            window.footerSectionsTable.ajax.reload(function(json) {}, false);
        }, 300);
    }
</script>
