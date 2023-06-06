<script>
    "use strict";
    $(function () {
        let getOrdersURL   = `{{ route('dashboard.operations.orders-monitoring.index') }}`;
        window.OrdersTable = initOrdersTable(getOrdersURL);
        $('#select_order_status_id').css('opacity', 1);

        $('body').on('click', '.edit_status', function () {
            let order_id = $(this).data('id');

            let getOrderDetails = `{{route('dashboard.operations.orders-monitoring.getOrderDetails',['id'])}}`;
            getOrderDetails     = getOrderDetails.replace('id', order_id);
            $.ajax({
                url: getOrderDetails,
                type: 'get',
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.status != 'success') {
                        return;
                    }
                    $('#select_order_status_id').val(response.data.order_status_id).change();
                    $('#order_id_change_status').val(response.data.id)
                    $('#orderEditStatusModal').modal('show');
                }
            });


        });

        $('body').on('click', '#submitUpdateOrderStatus', function () {
            let path     = '{{route('dashboard.operations.orders-monitoring.updateOrderStatus')}}'
            let formData = new FormData();
            formData.append('order_id', $('#order_id_change_status').val());
            formData.append('status_id', $('#select_order_status_id').val());
            $.ajax({
                url: path,
                type: 'post',
                cache: false,
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.status == 'success') {
                        Swal.fire({
                            title: '{{__('operations::dashboard.order_status_change_successfully')}}',
                            text: response.message,
                            icon: 'success',
                        });
                        $('#orderEditStatusModal').modal('hide');
                    }
                }
            });
        });

        $('body').on('click', '.assign_delivery', function () {
            let order_id = $(this).data('id');
            let path     = '{{route('dashboard.operations.orders-monitoring.getDeliveryGuys',['id'])}}'
            path         = path.replace('id', order_id);
            $.ajax({
                url: path,
                type: 'get',
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#delivery_guy').html('');
                    $('#deliveryOrderId').val(order_id);
                    response.data.forEach(function (item) {
                        $('#delivery_guy').append(`<option value="${item.id}">${item.name}</option>`)
                    });
                    $('#orderAssignDeliveryModal').modal('show');
                    deleteOrderCallBack();
                }
            });
        });

        $('body').on('click', '#submitAssignDelivery', function () {
            let deliveryGuy = $('#delivery_guy').val();
            let orderId     = $('#deliveryOrderId').val();
            let path        = '{{route('dashboard.operations.orders-monitoring.assignDelivery')}}';
            let formData    = new FormData();
            formData.append('delivery_id', deliveryGuy);
            formData.append('order_id', orderId);
            $.ajax({
                url: path,
                type: 'post',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (response) {
                    Swal.fire({
                        title: '{{__('operations::dashboard.order_assign_delivery_successfully')}}',
                        text: response.message,
                        icon: 'success',
                    });
                    $('#orderAssignDeliveryModal').modal('hide');
                }
            });


        });


    });

    function showToastNotificationMessage(message, order_id) {
        toastr.options         = {
            "closeButton": true,
            "timeOut": "0",
            "extendedTimeOut": "0"
        };
        toastr.options.onclick = function () {
            getOrderDetails(order_id);
        };
        toastr.success(message);
    }

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
            columns: [
                {
                    name: 'id',
                    data: 'id'
                },
                {
                    name: 'total',
                    data: 'total'
                },
                {
                    name: 'payment_method',
                    data: 'payment_method',
                    render: function (data, type, full, meta) {
                        if (full.payment_method === 'cash_on_delivery') {
                            return `{{__('operations::dashboard.cash_on_delivery')}}`
                        }
                        else {
                            return `{{__('operations.dashboard.wallet')}}`
                        }
                    }
                },
                {
                    name: 'order_status',
                    data: 'order_status'
                },
                {
                    name: 'branch_name',
                    data: 'branch_name'
                },
                {
                    name: 'merchant_name',
                    data: 'merchant_name'
                },
                {
                    name: 'customer_name',
                    data: 'customer_name'
                },
                {
                    name: 'delivery_name',
                    data: 'delivery_name'
                },
                {
                    name: 'delivery_location',
                    data: 'delivery_location',
                    render: function (data, type, full, meta) {
                        return `<span data-id="${full.id}" class="delivery_location btn btn-success">Delivery Location </span>`;
                    }
                },
                {
                    name: 'order_details',
                    data: 'order_details',
                    render: function (data, type, full, meta) {
                        return `<span data-id="${full.id}" class="order_details btn btn-primary">Order Details</span>`;
                    }
                },
                {
                    name: 'actions',
                    data: 'actions',
                    render: function (data, type, full, meta) {

                        let renderActions = `<span data-id="${full.id}" class="edit_status btn btn-danger">{{__('operations::dashboard.edit_status')}}</span>`;

                        if (full.delivery_id == null) {
                            renderActions += `<span data-id="${full.id}" class="m-1 assign_delivery btn btn-success">{{__('operations::dashboard.assign_delivery')}}</span>`;
                        }

                        return renderActions;
                    },
                },
            ],
            createdRow: function (full, data) {
                $(full).css('background-color', data.order_status_color);
            },
            fnRowCallback: function (nRow, full) {
                nRow.setAttribute('id', 'order_row_id_' + full.id);
            }
        });
    };

    function deleteOrderCallBack() {
        // Reload datatable with delay to clear cache
        setTimeout(function () {
            window.OrdersTable.ajax.reload(function (json) {
            });
        }, 300);
    }
</script>
