<script>
    "use strict";
    $(function() {
        let getAboutUsURL = `{{ route('dashboard.website.about-us.index') }}`;
        window.AboutUsTable = initAboutUsTable(getAboutUsURL);
        localStorage.setItem('canUpdateAboutUs',
            `{{ Auth()->user()->hasPermission('update-about-us') }}`);
        localStorage.setItem('canDeleteAboutUs',
            `{{ Auth()->user()->hasPermission('delete-about-us') }}`);
    });

    function initAboutUsTable(url) {
        return $('#kt_datatable_about_us').DataTable({
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
                            `{{ route('dashboard.website.about-us.toggle-status', ['id']) }}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input type="checkbox" class="toggle" ${localStorage.getItem('canUpdateAboutUs') ? '' : 'disabled'}
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
                        if (localStorage.getItem('canUpdateAboutUs')) {
                            let editUrl =
                                `{{ route('dashboard.website.about-us.edit', ['id']) }}`;
                            editUrl = editUrl.replace('id', full.id);
                            actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('website::dashboard.edit') }}">
                                    <i class="la la-edit"></i>
                                </a>`;
                        }
                        if (localStorage.getItem('canDeleteAboutUs')) {
                            let destroyUrl =
                                `{{ route('dashboard.website.about-us.destroy', ['id']) }}`;
                            destroyUrl = destroyUrl.replace('id', full.id);
                            actions +=
                                `<a href="javascript:;" onClick="deleteRecord('${destroyUrl}', ${full.id}, deleteAboutUsCallBack)"
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

    function deleteAboutUsCallBack() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            window.AboutUsTable.ajax.reload(function(json) {}, false);
        }, 300);
    }
</script>
