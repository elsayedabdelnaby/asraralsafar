<script>
    "use strict";
    $(function () {
        let url             = `{{ route('dashboard.merchants.branch-fees.index',['merchant_id'=>$merchant->id,'branch_id'=>$merchantBranch->id]) }}`;
        window.DeliveryFeesTable = initMerchantDeliveryFeesTable(url);

        localStorage.setItem('canUpdateMerchantBranchFee', `{{ Auth()->user()->hasPermission('update-merchant-delivery-fees') }}`);
        localStorage.setItem('canDeleteMerchantBranchFee', `{{ Auth()->user()->hasPermission('delete-merchant-delivery-fees') }}`);

    });

    function initMerchantDeliveryFeesTable(url) {
        return $('#kt_datatable_merchants_fee').DataTable({
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
                    name: 'from',
                    data: 'from'
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
                    name: 'actions',
                    data: 'actions',
                    render: function (data, type, full, meta) {

                        let actions = '';

                        if (localStorage.getItem('canUpdateMerchantBranchFee')) {
                            let editUrl = `{{ route('dashboard.merchants.branch-fees.edit', ['merchant_id'=>$merchant->id,'branch_id'=>$merchantBranch->id,'id']) }}`;
                            editUrl     = editUrl.replace('id', full.id);
                            actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('merchants::dashboard.edit') }}"><i class="la la-edit"></i></a>`;
                        }

                        if (localStorage.getItem('canDeleteMerchantBranchFee')) {
                            let deleteUrl = `{{ route('dashboard.merchants.branch-fees.delete', ['merchant_id'=>$merchant->id,'branch_id'=>$merchantBranch->id,'id']) }}`;
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
            window.DeliveryFeesTable.ajax.reload(function (json) {
            }, false);
        }, 300);
    }
</script>
