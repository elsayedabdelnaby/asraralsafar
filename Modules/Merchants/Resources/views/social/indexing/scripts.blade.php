<script>
    "use strict";
    $(function () {
        let getUsersURL    = `{{ route('dashboard.merchants.social.index',['merchant_id'=>$merchant->id]) }}`;
        window.SocialTable = initTable(getUsersURL);

        localStorage.setItem('canUpdateSocial', `{{ Auth()->user()->hasPermission('update-merchant-social') }}`);
        localStorage.setItem('canDeleteSocial', `{{ Auth()->user()->hasPermission('delete-merchant-social') }}`);

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
                    name: 'url',
                    data: 'url'
                },
                {
                    name: 'display',
                    data: 'display'
                },
                {
                    name: 'status',
                    data: 'is_active',
                    render: function (data, type, full, meta) {
                        let toggleURL = `{{ route('dashboard.merchants.social.toggle-status', ['merchant_id'=>$merchant->id,'id']) }}`;
                        toggleURL     = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input
                                            ${localStorage.getItem('canUpdateSocial') ? '' : 'disabled'}
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

                        if (localStorage.getItem('canUpdateSocial')) {
                            let editUrl = `{{ route('dashboard.merchants.social.edit', ['merchant_id'=>$merchant->id,'id']) }}`;
                            editUrl     = editUrl.replace('id', full.id);
                            actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('merchants::dashboard.edit') }}"><i class="la la-edit"></i></a>`;
                        }

                        if (localStorage.getItem('canDeleteSocial')) {
                            let deleteUrl = `{{ route('dashboard.merchants.social.delete', ['merchant_id'=>$merchant->id,'id']) }}`;
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
            window.SocialTable.ajax.reload(function (json) {
            }, false);
        }, 300);
    }
</script>
