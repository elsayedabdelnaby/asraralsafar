<script>
    "use strict";
    $(function () {
        let getUsersURL = `{{ isset($merchant) ? route('dashboard.merchants.coupons.index', ['merchant_id'=>$merchant->id]) : route('dashboard.merchants.coupons.index-global')}}`;
        window.SocialTable = initTable(getUsersURL);

        localStorage.setItem('canUpdateCoupon', `{{ Auth()->user()->hasPermission('update-merchant-coupon') }}`);
        localStorage.setItem('canDeleteCoupon', `{{ Auth()->user()->hasPermission('delete-merchant-coupon') }}`);

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
                @if(isset($merchant))
                {
                    name: 'merchant_name',
                    data: 'merchant_name'
                },
                @endif
                {
                    name: 'code',
                    data: 'code'
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
                    name: 'start_date',
                    data: 'start_date'
                },
                {
                    name: 'end_date',
                    data: 'end_date'
                },
                {
                    name: 'limited_usage',
                    data: 'limited_usage'
                },
                {
                    name: 'user_max_usage',
                    data: 'user_max_usage'
                },
                {
                    name: 'min_order',
                    data: 'min_order'
                },
                {
                    name: 'max_order',
                    data: 'max_order'
                },
                {
                    name: 'min_shipping',
                    data: 'min_shipping'
                },
                {
                    name: 'max_shipping',
                    data: 'max_shipping'
                },
                {
                    name: 'status',
                    data: 'status'
                },

                {
                    name: 'one_time',
                    data: 'one_time',
                    render: function (data, type, full, meta) {
                        let toggleURL =
                            `{{ isset($merchant) ? route('dashboard.merchants.coupons.toggle-status', ['merchant_id'=>$merchant->id , 'id']) : route('dashboard.merchants.coupons.toggle-status-global', ['id'])}}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input type="checkbox" class="toggle" ${localStorage.getItem('canUpdateCoupon') ? '' : 'disabled'}
                                            ${full.one_time ? 'checked' : ''} name="one_time"
                                            data-name="one_time" data-id="${full.id}" data-toggle-url="${toggleURL}" />
                                        <span></span>
                                    </label>
                                </span>`;
                    },
                },
                {
                    name: 'first_order',
                    data: 'first_order',
                    render: function (data, type, full, meta) {
                        let toggleURL =
                            `{{ isset($merchant) ? route('dashboard.merchants.coupons.toggle-status', ['merchant_id'=>$merchant->id , 'id']) : route('dashboard.merchants.coupons.toggle-status-global', ['id'])}}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input type="checkbox" class="toggle" ${localStorage.getItem('canUpdateCoupon') ? '' : 'disabled'}
                                            ${full.first_order ? 'checked' : ''} name="first_order"
                                            data-name="first_order" data-id="${full.id}" data-toggle-url="${toggleURL}" />
                                        <span></span>
                                    </label>
                                </span>`;
                    },
                },
                {
                    name: 'apply_on_cash',
                    data: 'apply_on_cash',
                    render: function (data, type, full, meta) {
                        let toggleURL =
                            `{{ isset($merchant) ? route('dashboard.merchants.coupons.toggle-status', ['merchant_id'=>$merchant->id , 'id']) : route('dashboard.merchants.coupons.toggle-status-global', ['id'])}}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input type="checkbox" class="toggle" ${localStorage.getItem('canUpdateCoupon') ? '' : 'disabled'}
                                            ${full.apply_on_cash ? 'checked' : ''} name="apply_on_cash"
                                            data-name="apply_on_cash" data-id="${full.id}" data-toggle-url="${toggleURL}" />
                                        <span></span>
                                    </label>
                                </span>`;
                    },
                },
                {
                    name: 'apply_on_card',
                    data: 'apply_on_card',
                    render: function (data, type, full, meta) {
                        let toggleURL =
                            `{{ isset($merchant) ? route('dashboard.merchants.coupons.toggle-status', ['merchant_id'=>$merchant->id , 'id']) : route('dashboard.merchants.coupons.toggle-status-global', ['id'])}}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input type="checkbox" class="toggle" ${localStorage.getItem('canUpdateCoupon') ? '' : 'disabled'}
                                            ${full.apply_on_card ? 'checked' : ''} name="apply_on_card"
                                            data-name="apply_on_card" data-id="${full.id}" data-toggle-url="${toggleURL}" />
                                        <span></span>
                                    </label>
                                </span>`;
                    },
                },
                {
                    name: 'is_active',
                    data: 'is_active',
                    render: function (data, type, full, meta) {
                        let toggleURL =
                            `{{ isset($merchant) ? route('dashboard.merchants.coupons.toggle-status', ['merchant_id'=>$merchant->id , 'id']) : route('dashboard.merchants.coupons.toggle-status-global', ['id'])}}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input
                                            ${localStorage.getItem('canUpdateCoupon') ? '' : 'disabled'}
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

                        if (localStorage.getItem('canUpdateCoupon')) {
                            let editUrl =
                                `{{ isset($merchant) ? route('dashboard.merchants.coupons.edit', ['merchant_id'=>$merchant->id , 'id']) : route('dashboard.merchants.coupons.edit-global', ['id'])}}`;
                            editUrl = editUrl.replace('id', full.id);
                            actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('merchants::dashboard.edit') }}"><i class="la la-edit"></i></a>`;
                            console.log(actions);

                        }

                        if (localStorage.getItem('canDeleteCoupon')) {
                            let deleteUrl =
                                `{{ isset($merchant) ? route('dashboard.merchants.coupons.delete', ['merchant_id'=>$merchant->id , 'id']) : route('dashboard.merchants.coupons.delete-global', ['id'])}}`;
                            deleteUrl = deleteUrl.replace('id', full.id);
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
            window.SocialTable.ajax.reload(function (json) {
            }, false);
        }, 300);
    }
</script>
