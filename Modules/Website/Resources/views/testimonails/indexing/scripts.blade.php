<script>
    "use strict";
    $(function() {
        let getTestimonailsURL = `{{ route('dashboard.website.testimonails.index') }}`;
        window.TestimonailsTable = initTestimonailsTable(getTestimonailsURL);
        localStorage.setItem('canUpdateTestimonail',
            `{{ Auth()->user()->hasPermission('update-testimonail') }}`);
        localStorage.setItem('canDeleteTestimonail',
            `{{ Auth()->user()->hasPermission('delete-testimonail') }}`);
    });

    function initTestimonailsTable(url) {
        return $('#kt_datatable_testimonails').DataTable({
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
                    name: 'client_name',
                    data: 'client_name'
                },
                {
                    name: 'testimonail',
                    data: 'testimonail',
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
                            `{{ route('dashboard.website.testimonails.toggle-status', ['id']) }}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input type="checkbox" class="toggle" ${localStorage.getItem('canUpdateTestimonail') ? '' : 'disabled'}
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
                        if (localStorage.getItem('canUpdateTestimonail')) {
                            let editUrl =
                                `{{ route('dashboard.website.testimonails.edit', ['id']) }}`;
                            editUrl = editUrl.replace('id', full.id);
                            actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('website::dashboard.edit') }}">
                                    <i class="la la-edit"></i>
                                </a>`;
                        }
                        if (localStorage.getItem('canDeleteTestimonail')) {
                            let destroyUrl =
                                `{{ route('dashboard.website.testimonails.destroy', ['id']) }}`;
                            destroyUrl = destroyUrl.replace('id', full.id);
                            actions +=
                                `<a href="javascript:;" onClick="deleteRecord('${destroyUrl}', ${full.id}, deleteTestimonailCallBack)"
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

    function deleteTestimonailCallBack() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            window.TestimonailsTable.ajax.reload(function(json) {}, false);
        }, 300);
    }
</script>
