<script>
    "use strict";
    $(function() {
        let getOrdersURL = `{{ route('dashboard.sales.orders.index') }}`;
        window.OrdersTable = initOrdersTable(getOrdersURL);

        localStorage.setItem('canUpdateOrderType', `{{ Auth()->user()->hasPermission('update-order') }}`);
        localStorage.setItem('canDeleteOrderType', `{{ Auth()->user()->hasPermission('delete-order') }}`);

    });

    function initOrdersTable(url) {
        return $('#kt_datatable_orders').DataTable({
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
                    name: 'merchant',
                    data: 'merchant'
                },
                {
                    name: 'branch',
                    data: 'branch'
                },
                {
                    name: 'customer',
                    data: 'customer'
                },
                {
                    name: 'delivery',
                    data: 'delivery'
                },
                {
                    name: 'total',
                    data: 'total'
                },
                {
                    name: 'coupon',
                    data: 'coupon'
                },
                {
                    name: 'status',
                    data: 'status'
                },
                {
                    name: 'actions',
                    data: 'actions',
                    render: function(data, type, full, meta) {

                        let actions = '';

                        if (localStorage.getItem('canUpdateOrderType')) {
                            let editUrl = `{{ route('dashboard.sales.orders.edit', ['id']) }}`;
                            editUrl = editUrl.replace('id', full.id);
                            actions +=
                                `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('sales::dashboard.edit') }}"><i class="la la-edit"></i></a>`;
                        }

                        if (localStorage.getItem('canDeleteOrderType')) {
                            let deleteUrl =
                                `{{ route('dashboard.sales.orders.delete', ['id']) }}`;
                            deleteUrl = deleteUrl.replace('id', full.id);
                            actions += `<a href="javascript:;" onClick="deleteRecord('${deleteUrl}', ${full.id}, deleteOrderCallBack)"
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

    function deleteOrderCallBack() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            window.OrdersTable.ajax.reload(function(json) {console.log()}, );
        }, 300);
    }
</script>
