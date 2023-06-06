<script>
    $(function() {
        let getSubCateogriesURL = `{{ route('dashboard.settings.subcategories.index', 'category_id') }}`;
        getSubCateogriesURL = getSubCateogriesURL.replace('category_id', `{{ $category_id }}`);
        window.subCategoriesTable = initCateogriesTable(getSubCateogriesURL);
        localStorage.setItem('canUpdateCategory',
            `{{ Auth()->user()->hasPermission('update-category') }}`);
        localStorage.setItem('canDeleteCategory',
            `{{ Auth()->user()->hasPermission('delete-category') }}`);
    });

    function initCateogriesTable(url) {
        return $('#kt_datatable_subcategories').DataTable({
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
                    data: 'name',
                },
                {
                    name: 'type',
                    data: 'type',
                },
                {
                    name: 'slug',
                    data: 'slug',
                },
                {
                    name: 'subcategories',
                    data: 'subcategories',
                    render: function(data, type, full, meta) {
                        return `<a href="${full.subcategories}">{{ __('settings::dashboard.subcategories') }}</a>`;
                    }
                },
                {
                    name: 'is_active_in_mobile',
                    data: 'is_active_in_mobile',
                    render: function(data, type, full, meta) {
                        let toggleURL =
                            `{{ route('dashboard.settings.categories.toggle-status', ['id']) }}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input type="checkbox" class="toggle" ${localStorage.getItem('canUpdateCategory') ? '' : 'disabled'}
                                            ${full.is_active_in_mobile ? 'checked' : ''} name="is_active_in_mobile"
                                            data-name="is_active_in_mobile" data-id="${full.id}" data-toggle-url="${toggleURL}" />
                                        <span></span>
                                    </label>
                                </span>`;
                    },
                },
                {
                    name: 'is_active_in_website',
                    data: 'is_active_in_website',
                    render: function(data, type, full, meta) {
                        let toggleURL =
                            `{{ route('dashboard.settings.categories.toggle-status', ['id']) }}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input type="checkbox" class="toggle" ${localStorage.getItem('canUpdateCategory') ? '' : 'disabled'}
                                            ${full.is_active_in_website ? 'checked' : ''} name="is_active_in_website"
                                            data-name="is_active_in_website" data-id="${full.id}" data-toggle-url="${toggleURL}" />
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
                        if (localStorage.getItem('canUpdateCategory')) {
                            let editUrl =
                                `{{ route('dashboard.settings.subcategories.edit', ['category_id', 'id']) }}`;
                            editUrl = editUrl.replace('category_id', full.parent_id);
                            editUrl = editUrl.replace('id', full.id);
                            actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('website::dashboard.edit') }}">
                                    <i class="la la-edit"></i>
                                </a>`;
                        }
                        if (localStorage.getItem('canDeleteCategory')) {
                            let deleteUrl =
                                `{{ route('dashboard.settings.categories.delete', ['id']) }}`;
                            deleteUrl = deleteUrl.replace('id', full.id);
                            actions +=
                                `<a href="javascript:;" onClick="deleteCategory(${full.id}, '${deleteUrl}')" data-id="` +
                                full.id + `" class="btn btn-sm btn-clean btn-icon" title="{{ __('settings::dashboard.delete') }}">
                                    <i class="la la-trash"></i>
                                </a>`;
                        }
                        return actions;
                    },
                },
            ],
        });
    };

    function deleteCategory(categoryId, deleteUrl) {
        $.ajax({
            type: 'GET',
            url: deleteUrl,
            dataType: 'json',
            data: {
                "id": categoryId
            },
            success: function(response) {
                $('#delete-category').find('.modal-content').html(response.html);
                $('#delete-category').modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError) {

            }
        });
    }
</script>
