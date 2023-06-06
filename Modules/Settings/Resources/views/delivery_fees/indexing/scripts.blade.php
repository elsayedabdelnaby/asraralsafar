<script>
    "use strict";
    $(function() {
        let getDeliveryFeesURL = `{{ route('dashboard.settings.delivery_fees.index') }}`;
        window.deliveryFeesTable = initDeliveryFeesTable(getDeliveryFeesURL);
        localStorage.setItem('canUpdateDeliveryFee',
            `{{ Auth()->user()->hasPermission('update-delivery_fee') }}`);
        localStorage.setItem('canDeleteDeliveryFee',
            `{{ Auth()->user()->hasPermission('delete-delivery_fee') }}`);
    });

    function initDeliveryFeesTable(url) {
        return $('#kt_datatable_delivery_fees').DataTable({
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
                    name: 'from',
                    data: 'from',
                },
                {
                    name: 'to',
                    data: 'to',
                },
                {
                    name: 'fees',
                    data: 'fees',
                },
                {
                    name: 'status',
                    data: 'is_active',
                    render: function(data, type, full) {
                        let toggleURL =
                            `{{ route('dashboard.settings.delivery_fees.toggle-status', ['id']) }}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input type="checkbox" class="toggle" ${localStorage.getItem('canUpdateDeliveryFee') ? '' : 'disabled'}
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
                    render: function(data, type, full) {
                        let actions = '';
                        if (localStorage.getItem('canUpdateDeliveryFee')) {
                            let editUrl =
                                `{{ route('dashboard.settings.delivery_fees.edit', ['id']) }}`;
                            editUrl = editUrl.replace('id', full.id);
                            actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('website::dashboard.edit') }}">
                                    <i class="la la-edit"></i>
                                </a>`;
                        }
                        if (localStorage.getItem('canDeleteDeliveryFee')) {
                            let deleteUrl =
                                `{{ route('dashboard.settings.delivery_fees.delete', ['id']) }}`;
                            deleteUrl = deleteUrl.replace('id', full.id);
                            actions += `<a href="javascript:;" onClick="deleteRecord('${deleteUrl}', ${full.id}, deleteDeliveryFees)"
                                    class="btn btn-sm btn-clean btn-icon" title="{{ __('locations::dashboard.delete') }}">
                                    <i class="la la-trash"></i>
                                </a>`;
                        }
                        return actions;
                    },
                },
            ],
        });
    };

    function deleteDeliveryFees() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            window.deliveryFeesTable.ajax.reload(function(json) {}, false);
        }, 300);
    }
</script>
