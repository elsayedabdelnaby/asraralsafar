<script>
    "use strict";
    $(function () {
        let getUsersURL      = `{{ route('dashboard.merchants.index') }}`;
        window.MerchantTable = initTable(getUsersURL);

        localStorage.setItem('canUpdateMerchant', `{{ Auth()->user()->hasPermission('update-merchant') }}`);
        localStorage.setItem('canDeleteMerchant', `{{ Auth()->user()->hasPermission('delete-merchant') }}`);

    });

    function initTable(url) {
        return $('#kt_datatable_merchants').DataTable({
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
                    name: 'merchants_branches',
                    data: 'merchants_branches',
                    render: function (data, type, full, meta) {
                        let url = `{{ route('dashboard.merchants.branches.index', ['id']) }}`;
                        url     = url.replace('id', full.id);
                        return `<a href="${url}">  {{__('merchants::dashboard.branches')}} </a>`
                    }
                },
                {
                    name: 'merchants_coupons',
                    data: 'merchants_coupons',
                    render: function (data, type, full, meta) {
                        let url = `{{route('dashboard.merchants.coupons.index',['id'])}}`;
                        url     = url.replace('id', full.id);
                        return `<a href="${url}"> {{__('merchants::dashboard.coupons')}} </a>`;
                    }
                },
                {
                    name: 'merchants_working_hours',
                    data: 'merchants_working_hours',
                    render: function (data, type, full, meta) {
                        let url = `{{route('dashboard.merchants.working-hours.index',['id'])}}`;
                        url     = url.replace('id', full.id);
                        return `<a href="${url}"> {{__('merchants::dashboard.working_hours')}} </a>`;
                    }
                },
                {
                    name: 'merchants_social',
                    data: 'merchants_social',
                    render: function (data, type, full, meta) {
                        let url = `{{ route('dashboard.merchants.social.index', ['id']) }}`;
                        url     = url.replace('id', full.id);
                        return `<a href="${url}"> {{__('merchants::dashboard.social')}} </a>`;
                    }
                },
                {
                    name: 'reviews',
                    data: 'reviews',
                    render: function (data, type, full, meta) {
                        return `<a href="#"> {{__('merchants::dashboard.reviews')}} </a>`;
                    }
                },
                {
                    name: 'additions_products',
                    data: 'additions_products',
                    render: function (data, type, full, meta) {
                        let url=`{{route('dashboard.merchants.additions-products.index',['id'])}}`;
                            url=url.replace('id',full.id);
                        return `<a href="${url}"> {{__('merchants::dashboard.additions_products')}} </a>`;
                    }
                },
                {
                    name: 'delivery_fees',
                    data: 'delivery_fees',
                    render: function (data, type, full, meta) {
                      let url = `{{ route('dashboard.merchants.merchant-fees.index', ['id']) }}`;
                        url     = url.replace('id', full.id);
                        return `<a href="${url}"> {{__('merchants::dashboard.delivery_fees')}} </a>`;
                    }
                },
                {
                    name: 'products',
                    data: 'products',
                    render: function (data, type, full, meta) {
                      let url = `{{ route('dashboard.merchants.products.index', ['id']) }}`;
                        url     = url.replace('id', full.id);
                        return `<a href="${url}"> {{__('merchants::dashboard.products')}} </a>`;
                    }
                },
                {
                    name: 'hot_line',
                    data: 'hot_line',
                },
                {
                    name: 'has_branches',
                    data: 'has_branches',
                    render: function (data, type, full, meta) {
                        let toggleURL = `{{ route('dashboard.merchants.toggle-has-branches', ['id']) }}`;
                        toggleURL     = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input
                                            ${localStorage.getItem('canUpdateMerchant') ? '' : 'disabled'}
                                            type="checkbox" class="toggle"  ${full.has_branches ? 'checked' : ''}
                                            name="has_branches"
                                            data-name="has_branches"
                                            data-id="${full.id}" data-toggle-url="${toggleURL}" />
                                        <span></span>
                                    </label>
                                </span>`;
                    },
                },
                {
                    name: 'working_status',
                    data: 'working_status',
                    render: function (data, type, full, meta) {
                        let toggleURL = `{{ route('dashboard.merchants.toggle-working-status', ['id']) }}`;
                        toggleURL     = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input
                                            ${localStorage.getItem('canUpdateMerchant') ? '' : 'disabled'}
                                            type="checkbox" class="toggle"  ${full.working_status ? 'checked' : ''}
                                            name="working_status"
                                            data-name="working_status"
                                            data-id="${full.id}" data-toggle-url="${toggleURL}" />
                                        <span></span>
                                    </label>
                                </span>`;
                    },
                },
                {
                    name: 'minimum_delivery_charges',
                    data: 'minimum_delivery_charges',
                },
                {
                    name: 'order_minimum_amount',
                    data: 'order_minimum_amount',
                },
                {
                    name: 'reviews_count',
                    data: 'reviews_count',
                },
                {
                    name: 'average_delivery_time',
                    data: 'average_delivery_time',
                },
                {
                    name: 'maximum_distance',
                    data: 'maximum_distance',
                },
                {
                    name: 'status',
                    data: 'is_active',
                    render: function (data, type, full, meta) {
                        let toggleURL = `{{ route('dashboard.merchants.toggle-status', ['id']) }}`;
                        toggleURL     = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input
                                            ${localStorage.getItem('canUpdateMerchant') ? '' : 'disabled'}
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

                        if (localStorage.getItem('canUpdateMerchant')) {
                            let editUrl = `{{ route('dashboard.merchants.edit', ['id']) }}`;
                            editUrl     = editUrl.replace('id', full.id);
                            actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('merchants::dashboard.edit') }}"><i class="la la-edit"></i></a>`;
                        }

                        if (localStorage.getItem('canDeleteMerchant')) {
                            let deleteUrl = `{{ route('dashboard.merchants.delete', ['id']) }}`;
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
            window.MerchantTable.ajax.reload(function (json) {
            }, false);
        }, 300);
    }
</script>
