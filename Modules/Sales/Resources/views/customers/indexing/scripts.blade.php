<script>
    "use strict";
    $(function() {
        let getCustomersURL = `{{ route('dashboard.sales.customers.index') }}`;
        window.CustomersTable = initCustomersTable(getCustomersURL);

        localStorage.setItem('canUpdateCustomerType', `{{ Auth()->user()->hasPermission('update-customer') }}`);
        localStorage.setItem('canDeleteCustomerType', `{{ Auth()->user()->hasPermission('delete-customer') }}`);

    });

    function initCustomersTable(url) {
        return $('#kt_datatable_customers').DataTable({
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
                    name: 'phone',
                    data: 'phone_number'
                },
                {
                    name: 'addresses',
                    data: 'addresses',
                    render: function(data, type, full, meta) {
                        let customerAddressesURL =
                            `{{ route('dashboard.sales.customer-addresses.index', ['customer_id']) }}`
                        customerAddressesURL = customerAddressesURL.replace('customer_id', full.id);
                        return `<a href="${customerAddressesURL}"> {{ __('sales::dashboard.addresses') }} </a>`
                    }
                },
                {
                    name: 'status',
                    data: 'is_active',
                    render: function(data, type, full, meta) {
                        let toggleURL =
                            `{{ route('dashboard.sales.customers.toggle-status', ['customer_id']) }}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input
                                            ${localStorage.getItem('canUpdateCustomerType') ? '' : 'disabled'}
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

                        if (localStorage.getItem('canUpdateCustomerType')) {
                            let editUrl = `{{ route('dashboard.sales.customers.edit', ['id']) }}`;
                            editUrl = editUrl.replace('id', full.id);
                            actions +=
                                `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('sales::dashboard.edit') }}"><i class="la la-edit"></i></a>`;
                        }

                        if (localStorage.getItem('canDeleteCustomerType')) {
                            let deleteUrl =
                                `{{ route('dashboard.sales.customers.destroy', ['id']) }}`;
                            deleteUrl = deleteUrl.replace('id', full.id);
                            actions += `<a href="javascript:;" onClick="deleteRecord('${deleteUrl}', ${full.id}, deleteCustomerCallBack)"
                                    class="btn btn-sm btn-clean btn-icon" title="{{ __('sales::dashboard.delete') }}">
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
            window.CustomersTable.ajax.reload(function(json) {}, false);
        }, 300);
    }
</script>
