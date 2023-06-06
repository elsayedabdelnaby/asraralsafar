<script>
    "use strict";
    $(function () {
        let url = `{{ route('dashboard.merchants.working-hours.index',['merchant_id'=>$merchant->id]) }}`;
        window.WorkingHoursTable = initMerchantWorkingHoursTable(url);

        localStorage.setItem('canUpdateMerchantWorkingHours', `{{ Auth()->user()->hasPermission('update-merchant-working-hours') }}`);
        localStorage.setItem('canDeleteMerchantWorkingHours', `{{ Auth()->user()->hasPermission('delete-merchant-working-hours') }}`);

    });

    function initMerchantWorkingHoursTable(url) {
        return $('#kt_datatable_merchants_working_hours').DataTable({
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
                    name: 'day',
                    data: 'day'
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
                    name: 'status',
                    data: 'is_active',
                    render: function (data, type, full, meta) {
                        let toggleURL = `{{ route('dashboard.merchants.working-hours.toggle-status', ['merchant_id'=>$merchant->id,'id']) }}`;
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

                        if (localStorage.getItem('canUpdateMerchantWorkingHours')) {
                            let editUrl = `{{ route('dashboard.merchants.working-hours.edit', ['merchant_id'=>$merchant->id,'id']) }}`;
                            editUrl     = editUrl.replace('id', full.id);
                            actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('merchants::dashboard.edit') }}"><i class="la la-edit"></i></a>`;
                        }

                        if (localStorage.getItem('canDeleteMerchantWorkingHours')) {
                            let deleteUrl = `{{ route('dashboard.merchants.working-hours.delete', ['merchant_id'=>$merchant->id,'id']) }}`;
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
