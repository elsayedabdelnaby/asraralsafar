<script>
    "use strict";
    $(function() {
        let getFooterLinksURL =
            `{{ route('dashboard.website.footer-links.index', ['footer_section_id' => $footer_section_id]) }}`;
        window.footerLinksTable = initFooterLinksTable(getFooterLinksURL);
        localStorage.setItem('canUpdateFooterLink',
            `{{ Auth()->user()->hasPermission('update-footer-link') }}`);
        localStorage.setItem('canDeleteFooterLink',
            `{{ Auth()->user()->hasPermission('delete-footer-link') }}`);
    });

    function initFooterLinksTable(url) {
        return $('#kt_datatable_footer_links').DataTable({
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
                    name: 'type',
                    data: 'type'
                },
                {
                    name: 'link',
                    data: 'link',
                    render: function(data, type, full, meta) {
                        return `<a href="${full.link}">{{ __('website::dashboard.link') }}</a>`;
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
                            `{{ route('dashboard.website.footer-links.toggle-status', ['id' => 'id', 'footer_section_id' => $footer_section_id]) }}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input type="checkbox" class="toggle" ${localStorage.getItem('canUpdateFooterLink') ? '' : 'disabled'}
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
                        if (localStorage.getItem('canUpdateFooterLink')) {
                            let editUrl =
                                `{{ route('dashboard.website.footer-links.edit', ['id' => 'id', 'footer_section_id' => $footer_section_id]) }}`;
                            editUrl = editUrl.replace('id', full.id);
                            actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('website::dashboard.edit') }}">
                                    <i class="la la-edit"></i>
                                </a>`;
                        }
                        if (localStorage.getItem('canDeleteFooterLink')) {
                            let destroyUrl =
                                `{{ route('dashboard.website.footer-links.destroy', ['id']) }}`;
                            destroyUrl = destroyUrl.replace('id', full.id);
                            actions +=
                                `<a href="javascript:;" onClick="deleteRecord('${destroyUrl}', ${full.id}, deleteFooterLinkCallBack)"
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

    function deleteFooterLinkCallBack() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            window.footerLinksTable.ajax.reload(function(json) {}, false);
        }, 300);
    }
</script>
