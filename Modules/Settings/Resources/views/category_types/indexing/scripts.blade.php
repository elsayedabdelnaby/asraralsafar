<script>
    "use strict";
    $(function() {
        let getCategoryTypesURL = `{{ route('dashboard.settings.category-types.index') }}`;
        window.categoryTypesTable = initCategoryTypesTable(getCategoryTypesURL);
        localStorage.setItem('canUpdateCategoryType',
            `{{ Auth()->user()->hasPermission('update-category-type') }}`);
        localStorage.setItem('canDeleteCategoryType',
            `{{ Auth()->user()->hasPermission('delete-category-type') }}`);
    });

    function initCategoryTypesTable(url) {
        return $('#kt_datatable_category_types').DataTable({
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
                    name: 'status',
                    data: 'is_active',
                    render: function(data, type, full, meta) {
                        let toggleURL =
                            `{{ route('dashboard.settings.category-types.toggle-status', ['id']) }}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input type="checkbox" class="toggle" ${localStorage.getItem('canUpdateCategoryType') ? '' : 'disabled'}
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
                        if (full.id > 4) {
                            if (localStorage.getItem('canUpdateCategoryType')) {
                                let editUrl =
                                    `{{ route('dashboard.settings.category-types.edit', ['id']) }}`;
                                editUrl = editUrl.replace('id', full.id);
                                actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('website::dashboard.edit') }}">
                                    <i class="la la-edit"></i>
                                </a>`;
                            }
                            if (localStorage.getItem('canDeleteCategoryType')) {
                                let deleteUrl =
                                    `{{ route('dashboard.settings.category-types.delete', ['id']) }}`;
                                deleteUrl = deleteUrl.replace('id', full.id);
                                actions +=
                                    `<a href="javascript:;" onClick="deleteCategoryType(${full.id}, '${deleteUrl}')" data-id="` +
                                    full.id + `" class="btn btn-sm btn-clean btn-icon" title="{{ __('settings::dashboard.delete') }}">
                                    <i class="la la-trash"></i>
                                </a>`;
                            }
                        }
                        return actions;
                    },
                },
            ],
        });
    };

    function deleteCategoryType(categoryTypeId, deleteUrl) {
        $.ajax({
            type: 'GET',
            url: deleteUrl,
            dataType: 'json',
            data: {
                "id": categoryTypeId
            },
            success: function(response) {
                $('#delete-category-type').find('.modal-content').html(response.html);
                $('#delete-category-type').modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError) {

            }
        });
    }
</script>
