<script>
    "use strict";
    $(function () {
        let getUsersURL    = `{{ route('dashboard.merchants.products.index',['merchant_id'=>$merchant->id]) }}`;
        window.SocialTable = initTable(getUsersURL);

        localStorage.setItem('canUpdateProduct', `{{ Auth()->user()->hasPermission('update-product') }}`);
        localStorage.setItem('canDeleteProduct', `{{ Auth()->user()->hasPermission('delete-product') }}`);

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
                    name: 'image',
                    data: 'image',
                    render: function (data, type, full, meta) {
                        return `<img src="${full.image_url}" width="50px" height="50px">`;
                    }
                },
                {
                    name: 'type',
                    data: 'type',
                    render:function (data,type,full,meta){

                        if (full.type == 'variant'){
                            let url = `{{route('dashboard.merchants.products-variant.index',['merchant_id'=>$merchant->id,'id'])}}`;
                                url=url.replace('id',full.id);
                            return `<a href="${url}">${full.type}</a>`;
                        }

                        return full.type;
                    }
                },
                {
                    name: 'accept_additions',
                    data: 'accept_additions',
                    render: function (data, type, full, meta) {
                        let url = `{{route('dashboard.merchants.products.toggle-accept-additions',['merchant_id'=>$merchant->id,'id'])}}`;
                        url     = url.replace('id', full.id);
                        return `
                            <span class="switch switch-outline switch-icon switch-success switch-sm">
                                <label>
                                    <input
                                        ${localStorage.getItem('canUpdateProduct') ? '' : 'disabled'}
                                        type="checkbox" class="toggle"  ${full.accept_additions ? 'checked' : ''}
                                        name="is_active"
                                        data-name="is_active"
                                        data-id="${full.id}" data-toggle-url="${url}" />
                                    <span></span>
                                </label>
                            </span>
                        `;
                    }
                },
                {
                    name: 'price',
                    data: 'price',
                },
                {
                    name: 'discount_price',
                    data: 'discount_price'
                },
                {
                    name: 'status',
                    data: 'is_active',
                    render: function (data, type, full, meta) {
                        let toggleURL = `{{ route('dashboard.merchants.products.toggle-status', ['merchant_id'=>$merchant->id,'id']) }}`;
                        toggleURL     = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input
                                            ${localStorage.getItem('canUpdateProduct') ? '' : 'disabled'}
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

                        if (localStorage.getItem('canUpdateProduct')) {
                            let editUrl = `{{ route('dashboard.merchants.products.edit', ['merchant_id'=>$merchant->id,'id']) }}`;
                            editUrl     = editUrl.replace('id', full.id);
                            actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('merchants::dashboard.edit') }}"><i class="la la-edit"></i></a>`;
                        }

                        if (localStorage.getItem('canDeleteProduct')) {
                            let deleteUrl = `{{ route('dashboard.merchants.products.delete', ['merchant_id'=>$merchant->id,'id']) }}`;
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
