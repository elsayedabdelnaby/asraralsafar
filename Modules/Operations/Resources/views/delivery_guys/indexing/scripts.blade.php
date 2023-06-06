<script>
    "use strict";
    $(function() {
        let getDeliveryGuysURL = `{{ route('dashboard.operations.delivery-guys.index') }}`;
        window.DeliveryGuysTable = initDeliveryGuysTable(getDeliveryGuysURL);
        localStorage.setItem('canUpdateDeliveryGuy', `{{ Auth()->user()->hasPermission('update-delivery-guys') }}`);
        localStorage.setItem('canDeleteDeliveryGuy', `{{ Auth()->user()->hasPermission('delete-delivery-guys') }}`);
    });

    function initDeliveryGuysTable(url) {
        return $('#kt_datatable').DataTable({
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
                    name: 'email',
                    data: 'email'
                },
                {
                    name: 'phone_number',
                    data: 'phone_number'
                },
                {
                    name: 'status',
                    data: 'is_active',
                    render: function(data, type, full, meta) {
                        let toggleURL =
                            `{{ route('dashboard.operations.delivery-guys.toggle-status', ['id']) }}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input
                                            ${localStorage.getItem('canUpdateDeliveryGuy') ? '' : 'disabled'}
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

                        if (localStorage.getItem('canUpdateDeliveryGuy')) {
                            let editUrl = `{{ route('dashboard.operations.delivery-guys.edit', ['id']) }}`;
                            editUrl = editUrl.replace('id', full.id);
                            actions +=
                                `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('operations::dashboard.edit') }}"><i class="la la-edit"></i></a>`;
                        }

                        if (localStorage.getItem('canDeleteDeliveryGuy')) {
                            let deleteUrl =
                                `{{ route('dashboard.operations.delivery-guys.delete', ['id']) }}`;
                            deleteUrl = deleteUrl.replace('id', full.id);
                            actions += `<a href="javascript:;" onClick="deleteRecord('${deleteUrl}', ${full.id}, deleteCustomerCallBack)"
                                    class="btn btn-sm btn-clean btn-icon" title="{{ __('operations::dashboard.delete') }}">
                                    <i class="la la-trash"></i>
                                </a>`;
                        }

                        return actions;
                    },
                },
            ],
        });
    };

    function deleteCustomerCallBack() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            window.DeliveryGuysTable.ajax.reload(function(json) {}, false);
        }, 300);
    }
</script>
