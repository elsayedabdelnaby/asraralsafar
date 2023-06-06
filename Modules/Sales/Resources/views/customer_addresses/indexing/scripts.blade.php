<script>
    "use strict";
    $(function() {
        let getAddressesURL = `{{ route('dashboard.sales.customer-addresses.index', $customer_id) }}`;
        window.AddressesTable = initAddressesTable(getAddressesURL);
        localStorage.setItem('canUpdateAddress',`{{ Auth()->user()->hasPermission('update-customer-address') }}`);
        localStorage.setItem('canDeleteAddress',`{{ Auth()->user()->hasPermission('delete-customer-address') }}`);
    });

    function initAddressesTable(url) {
        return $('#kt_datatable_addresses').DataTable({
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
                    name: 'city',
                    data: 'city'
                },
                {
                    name: 'phone_number',
                    data: 'phone_number'
                },
                {
                    name: 'address',
                    data: 'address'
                },
                {
                    name: 'build_no',
                    data: 'build_no'
                },
                {
                    name: 'floor_no',
                    data: 'floor_no'
                },
                {
                    name: 'apartment_no',
                    data: 'apartment_no'
                },
                {
                    name: 'is_default',
                    data: 'is_default',
                    render: function(data, type, full, meta) {
                        let toggleURL =`{{ route('dashboard.sales.customer-addresses.toggle-status', ['customer_id'=>$customer->id,'id']) }}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input
                                            ${localStorage.getItem('canUpdateAddress') ? '' : 'disabled'}
                                            type="checkbox" class="toggle"  ${full.is_default ? 'checked disabled' : ''}
                                            name="is_default"
                                            data-name="is_default"
                                            data-id="${full.id}" data-toggle-url="${toggleURL}"
                                            onclick="deleteAddressCallBack()"
                                        />
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

                        if (localStorage.getItem('canUpdateAddress')) {
                            let editUrl =`{{ route('dashboard.sales.customer-addresses.edit', ['customer_id'=>$customer->id, 'id']) }}`;
                            editUrl = editUrl.replace('id', full.id);
                            actions +=`<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('sales::dashboard.edit') }}"><i class="la la-edit"></i></a>`;
                        }

                        if (localStorage.getItem('canDeleteAddress') &&  full.is_default !== 1) {
                            let deleteUrl =`{{ route('dashboard.sales.customer-addresses.destroy', ['customer_id'=>$customer->id,'id']) }}`;
                            deleteUrl = deleteUrl.replace('id', full.id);

                            actions += `<a href="javascript:;" onClick="deleteRecord('${deleteUrl}', ${full.id}, deleteAddressCallBack)"
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

    function deleteAddressCallBack() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            window.AddressesTable.ajax.reload(function(json) {}, false);
        }, 300);
    }
</script>
