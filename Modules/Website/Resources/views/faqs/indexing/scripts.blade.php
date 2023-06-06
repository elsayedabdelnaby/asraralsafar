<script>
    "use strict";
    $(function() {
        let getFAQsURL = `{{ route('dashboard.website.faqs.index') }}`;
        window.FAQsTable = initFAQsTable(getFAQsURL);
        localStorage.setItem('canUpdateFAQ',
            `{{ Auth()->user()->hasPermission('update-faq') }}`);
        localStorage.setItem('canDeleteFAQ',
            `{{ Auth()->user()->hasPermission('delete-faq') }}`);
    });

    function initFAQsTable(url) {
        return $('#kt_datatable_faqs').DataTable({
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
                    name: 'question',
                    data: 'question'
                },
                {
                    name: 'answer',
                    data: 'answer',
                    render: function(data, type, full, meta) {
                        return full.answer.replace(/(<([^>]+)>)/gi, "").substr(1, 150) + '...';
                    }
                },
                {
                    name: 'category',
                    data: 'category_name',
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
                            `{{ route('dashboard.website.faqs.toggle-status', ['id']) }}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input type="checkbox" class="toggle" ${localStorage.getItem('canUpdateFAQ') ? '' : 'disabled'}
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
                        if (localStorage.getItem('canUpdateFAQ')) {
                            let editUrl =
                                `{{ route('dashboard.website.faqs.edit', ['id']) }}`;
                            editUrl = editUrl.replace('id', full.id);
                            actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('website::dashboard.edit') }}">
                                    <i class="la la-edit"></i>
                                </a>`;
                        }
                        if (localStorage.getItem('canDeleteFAQ')) {
                            let destroyUrl =
                                `{{ route('dashboard.website.faqs.destroy', ['id']) }}`;
                            destroyUrl = destroyUrl.replace('id', full.id);
                            actions +=
                                `<a href="javascript:;" onClick="deleteRecord('${destroyUrl}', ${full.id}, deleteFAQCallBack)"
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

    function deleteFAQCallBack() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            window.FAQsTable.ajax.reload(function(json) {}, false);
        }, 300);
    }
</script>
