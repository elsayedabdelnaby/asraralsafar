<script>
    "use strict";
    $(function () {
        let url = `{{ route('dashboard.merchants.additions-products.index',['merchant_id'=>$merchant->id]) }}`;
        window.WorkingHoursTable = initMerchantWorkingHoursTable(url);

        localStorage.setItem('canUpdateMerchantAdditionsProducts', `{{ Auth()->user()->hasPermission('update-merchant-additions-product') }}`);
        localStorage.setItem('canDeleteMerchantAdditionsProducts', `{{ Auth()->user()->hasPermission('delete-merchant-additions-product') }}`);

    });

    function initMerchantWorkingHoursTable(url) {
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
                    name: 'price',
                    data: 'price'
                },
                {
                    name: 'discount_price',
                    data: 'discount_price',
                },
                {
                    name: 'status',
                    data: 'is_active',
                    render: function (data, type, full, meta) {
                        let toggleURL = `{{ route('dashboard.merchants.additions-products.toggle-status', ['merchant_id'=>$merchant->id,'id']) }}`;
                        toggleURL     = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input
                                            ${localStorage.getItem('canUpdateMerchantAdditionsProducts') ? '' : 'disabled'}
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

                        if (localStorage.getItem('canUpdateMerchantAdditionsProducts')) {
                            let editUrl = `{{ route('dashboard.merchants.additions-products.edit', ['merchant_id'=>$merchant->id,'id']) }}`;
                            editUrl     = editUrl.replace('id', full.id);
                            actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('merchants::dashboard.edit') }}"><i class="la la-edit"></i></a>`;
                        }

                        if (localStorage.getItem('canDeleteMerchantAdditionsProducts')) {
                            let deleteUrl = `{{ route('dashboard.merchants.additions-products.delete', ['merchant_id'=>$merchant->id,'id']) }}`;
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
            window.WorkingHoursTable.ajax.reload(function (json) {
            }, false);
        }, 300);
    }
</script>
