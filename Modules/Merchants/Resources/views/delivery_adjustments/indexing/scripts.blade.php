<script>
    "use strict";
    $(function () {
        let url                  = `{{ route('dashboard.merchants.delivery-adjustments.index') }}`;
        window.Table = initTable(url);

        localStorage.setItem('canUpdateMerchantDeliveryAdjustments', `{{ Auth()->user()->hasPermission('update-merchant-delivery-adjustment') }}`);
        localStorage.setItem('canDeleteMerchantDeliveryAdjustments', `{{ Auth()->user()->hasPermission('delete-merchant-delivery-adjustment') }}`);

    });

    function initTable(url) {
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
            columns: [
                {
                    name: 'id',
                    data: 'id'
                },
                {
                    name: 'name',
                    data: 'name'
                },
                {
                    name: 'start_date',
                    data: 'start_date'
                },
                {
                    name: 'start_time',
                    data: 'start_time'
                },
                {
                    name: 'end_date',
                    data: 'end_date'
                },
                {
                    name: 'end_time',
                    data: 'end_time'
                },
                {
                    name: 'minimum_order_value',
                    data: 'minimum_order_value'
                },
                {
                    name: 'maximum_order_value',
                    data: 'maximum_order_value'
                },
                {
                    name: 'minimum_shipping_cost_value',
                    data: 'minimum_shipping_cost_value'
                },
                {
                    name: 'maximum_shipping_cost_value',
                    data: 'maximum_shipping_cost_value'
                },
                {
                    name: 'type',
                    data: 'type'
                },
                {
                    name: 'value_type',
                    data: 'value_type'
                },
                {
                    name: 'value',
                    data: 'value'
                },
                {
                    name: 'apply_on_cash_on_delivery',
                    data: 'apply_on_cash_on_delivery',
                    render: function (data, type, full, meta) {
                        let toggleURL = `{{ route('dashboard.merchants.delivery-adjustments.toggle-apply-on-cash',['id']) }}`;
                        toggleURL     = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input
                                            ${localStorage.getItem('canUpdateMerchantDeliveryAdjustments') ? '' : 'disabled'}
                                            type="checkbox" class="toggle"  ${full.apply_on_cash_on_delivery ? 'checked' : ''}
                                            name="apply_on_cash_on_delivery"
                                            data-name="apply_on_cash_on_delivery"
                                            data-id="${full.id}" data-toggle-url="${toggleURL}" />
                                        <span></span>
                                    </label>
                                </span>`;
                    },
                },
                {
                    name: 'apply_on_pay_from_wallet',
                    data: 'apply_on_pay_from_wallet',
                    render: function (data, type, full, meta) {
                        let toggleURL = `{{ route('dashboard.merchants.delivery-adjustments.toggle-apply-on-wallet',['id']) }}`;
                        toggleURL     = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input
                                            ${localStorage.getItem('canUpdateMerchantDeliveryAdjustments') ? '' : 'disabled'}
                                            type="checkbox" class="toggle"  ${full.apply_on_pay_from_wallet ? 'checked' : ''}
                                            name="apply_on_pay_from_wallet"
                                            data-name="apply_on_pay_from_wallet"
                                            data-id="${full.id}" data-toggle-url="${toggleURL}" />
                                        <span></span>
                                    </label>
                                </span>`;
                    },
                },
                {
                    name: 'status',
                    data: 'is_active',
                    render: function (data, type, full, meta) {
                        let toggleURL = `{{ route('dashboard.merchants.delivery-adjustments.toggle-status',['id']) }}`;
                        toggleURL     = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input
                                            ${localStorage.getItem('canUpdateMerchantWorkingHours') ? '' : 'disabled'}
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
                    render: function (data, type, full, meta) {

                        let actions = '';

                        if (localStorage.getItem('canUpdateMerchantDeliveryAdjustments')) {
                            let editUrl = `{{ route('dashboard.merchants.delivery-adjustments.edit',['id']) }}`;
                            editUrl     = editUrl.replace('id', full.id);
                            actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('merchants::dashboard.edit') }}"><i class="la la-edit"></i></a>`;
                        }

                        if (localStorage.getItem('canDeleteMerchantDeliveryAdjustments')) {
                            let deleteUrl = `{{ route('dashboard.merchants.delivery-adjustments.delete',['id']) }}`;
                            deleteUrl     = deleteUrl.replace('id', full.id);
                            actions += `<a href="javascript:;" onClick="deleteRecord('${deleteUrl}', ${full.id}, deleteAvatarCallBack)"
                                    class="btn btn-sm btn-clean btn-icon" title="{{ __('merchants::dashboard.delete') }}">
                                    <i class="la la-trash"></i>
                                </a>`;
                        }

                        return actions;
                    },
                },
            ],
        });
    };

    function deleteAvatarCallBack() {
        // Reload datatable with delay to clear cache
        setTimeout(function () {
            window.Table.ajax.reload(function (json) {
            }, false);
        }, 300);
    }
</script>
