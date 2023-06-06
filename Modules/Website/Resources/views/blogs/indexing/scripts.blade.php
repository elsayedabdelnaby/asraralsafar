<script>
    "use strict";
    $(function() {
        let getBlogsURL = `{{ route('dashboard.website.blogs.index') }}`;
        window.BlogsTable = initBlogsTable(getBlogsURL);
        localStorage.setItem('canUpdateBlog',
            `{{ Auth()->user()->hasPermission('update-blog') }}`);
        localStorage.setItem('canDeleteBlog',
            `{{ Auth()->user()->hasPermission('delete-blog') }}`);
    });

    function initBlogsTable(url) {
        return $('#kt_datatable_blogs').DataTable({
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
                    name: 'short_description',
                    data: 'short_description'
                },
                {
                    name: 'category',
                    data: 'category_name',
                },
                {
                    name: 'likes_number',
                    data: 'likes_number'
                },
                {
                    name: 'sharings_number',
                    data: 'sharings_number'
                },
                {
                    name: 'views_number',
                    data: 'views_number'
                },
                {
                    name: 'status',
                    data: 'is_active',
                    render: function(data, type, full, meta) {
                        let toggleURL =
                            `{{ route('dashboard.website.blogs.toggle-status', ['id']) }}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input type="checkbox" class="toggle" ${localStorage.getItem('canUpdateBlog') ? '' : 'disabled'}
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
                        if (localStorage.getItem('canUpdateBlog')) {
                            let editUrl =
                                `{{ route('dashboard.website.blogs.edit', ['id']) }}`;
                            editUrl = editUrl.replace('id', full.id);
                            actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('website::dashboard.edit') }}">
                                    <i class="la la-edit"></i>
                                </a>`;
                        }
                        if (localStorage.getItem('canDeleteBlog')) {
                            let destroyUrl =
                                `{{ route('dashboard.website.blogs.destroy', ['id']) }}`;
                            destroyUrl = destroyUrl.replace('id', full.id);
                            actions +=
                                `<a href="javascript:;" onClick="deleteRecord('${destroyUrl}', ${full.id}, deleteBlogCallBack)"
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

    function deleteBlogCallBack() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            window.BlogsTable.ajax.reload(function(json) {}, false);
        }, 300);
    }
</script>
