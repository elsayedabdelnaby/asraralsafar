<script>
    "use strict";
    $(function() {
        let getMetaPagesURL = `{{ route('dashboard.website.meta-pages.index') }}`;
        window.metaPagesTable = initMetaPagesTable(getMetaPagesURL);
        localStorage.setItem('canUpdateMetaPage',
            `{{ Auth()->user()->hasPermission('update-meta-page') }}`);
        localStorage.setItem('canDeleteMetaPage',
            `{{ Auth()->user()->hasPermission('delete-meta-page') }}`);
    });

    function initMetaPagesTable(url) {
        return $('#kt_datatable_meta_pages').DataTable({
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
                    name: 'page',
                    data: 'page',
                },
                {
                    name: 'title',
                    data: 'title'
                },
                {
                    name: 'description',
                    data: 'description'
                },
                {
                    name: 'actions',
                    data: 'Actions',
                    render: function(data, type, full, meta) {
                        let actions = '';
                        if (localStorage.getItem('canUpdateMetaPage')) {
                            let editUrl =
                                `{{ route('dashboard.website.meta-pages.edit', ['id']) }}`;
                            editUrl = editUrl.replace('id', full.id);
                            actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('website::dashboard.edit') }}">
                                    <i class="la la-edit"></i>
                                </a>`;
                        }
                        if (localStorage.getItem('canDeleteMetaPage')) {
                            let destroyUrl =
                                `{{ route('dashboard.website.meta-pages.destroy', ['id']) }}`;
                            destroyUrl = destroyUrl.replace('id', full.id);
                            actions +=
                                `<a href="javascript:;" onClick="deleteRecord('${destroyUrl}', ${full.id}, deleteMetaPageCallBack)"
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

    function deleteMetaPageCallBack() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            window.metaPagesTable.ajax.reload(function(json) {}, false);
        }, 300);
    }
</script>
