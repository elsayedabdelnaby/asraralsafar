<script>
    "use strict";
    $(function () {
        let getCustomersURL = `{{ route('dashboard.sales.order-status.index') }}`;
        window.table        = initCustomersTable(getCustomersURL);

        localStorage.setItem('canUpdateOrderStatus', `{{ Auth()->user()->hasPermission('update-order-status') }}`);
        localStorage.setItem('canDeleteOrderStatus', `{{ Auth()->user()->hasPermission('delete-order-status') }}`);


        window.table.on('row-reorder', function (e, diff, edit) {
            let path     = "{{route('dashboard.sales.order-status.update-reorder')}}";
            let formData = new FormData();
            for (let i = 0, ien = diff.length; i < ien; i++) {
                let rowData = table.row(diff[i].node).data();
                formData.append(rowData.id, diff[i].newPosition + 1);
            }
            console.log(formData);
            $.ajax({
                url: path,
                type: 'post',
                cache: false,
                data:formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    deleteCustomerCallBack();
                }
            });


        });


    });

    function initCustomersTable(url) {
        return $('#kt_datatable').DataTable({
            responsive: true,
            searchDelay: 500,
            processing: true,
            rowReorder: {
                dataSrc: 'readingOrder',
            },
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
                    name: 'color',
                    data: 'color'
                },
                {
                    name: 'color_code',
                    data: 'color_code',
                    render: function (data, type, full, meta) {
                        return `<span style="padding:15px; background-color:${full.color_code} "></span>`;
                    }
                },
                {
                    name: 'status',
                    data: 'is_active',
                    render: function (data, type, full, meta) {
                        let toggleURL = `{{ route('dashboard.sales.order-status.toggle-status', ['id']) }}`;
                        toggleURL     = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input
                                            ${localStorage.getItem('canUpdateOrderStatus') ? '' : 'disabled'}
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

                        if (localStorage.getItem('canUpdateOrderStatus')) {
                            let editUrl = `{{ route('dashboard.sales.order-status.edit', ['id']) }}`;
                            editUrl     = editUrl.replace('id', full.id);
                            actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('sales::dashboard.edit') }}"><i class="la la-edit"></i></a>`;
                        }

                        if (localStorage.getItem('canDeleteOrderStatus')) {
                            let deleteUrl =
                                    `{{ route('dashboard.sales.order-status.delete', ['id']) }}`;
                            deleteUrl     = deleteUrl.replace('id', full.id);
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
        setTimeout(function () {
            window.table.ajax.reload(function (json) {
            }, false);
        }, 300);
    }
</script>
