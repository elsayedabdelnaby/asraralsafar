<script>
    "use strict";
    $(function() {
        let getProductAttributesURL = `{{ route('dashboard.products.product-attributes.index') }}`;
        window.ProductAttributesTable = initProductAttributesTable(getProductAttributesURL);
        localStorage.setItem('canUpdateProductAttributeType',`{{ Auth()->user()->hasPermission('update-product-attribute') }}`);
    });

    function initProductAttributesTable(url) {
        return $('#kt_datatable_product_attributes').DataTable({
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
                    data: 'input_type'
                },
                {
                    name: 'status',
                    data: 'is_active',
                    render: function(data, type, full, meta) {
                        let toggleURL =
                            `{{ route('dashboard.products.product-attributes.toggle-status', ['id']) }}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input
                                            ${localStorage.getItem('canUpdateProductAttributeType') ? '' : 'disabled'}
                                            type="checkbox" class="toggle"  ${full.is_active ? 'checked' : ''}
                                            name="is_active"
                                            data-name="is_active"
                                            data-id="${full.id}" data-toggle-url="${toggleURL}" />
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

                        if (localStorage.getItem('canUpdateProductAttributeType')) {
                            let editUrl =
                                `{{ route('dashboard.products.product-attributes.edit', ['id']) }}`;
                            editUrl = editUrl.replace('id', full.id);
                            actions +=
                                `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('locations::dashboard.edit') }}"><i class="la la-edit"></i></a>`;
                        }

                        return actions;
                    },
                },
            ],
        });
    };

    function deleteProductAttributeCallBack() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            window.ProductAttributesTable.ajax.reload(function(json) {}, false);
        }, 300);
    }
</script>
