<script>
    "use strict";
    $(function() {
        let getCurrenciesURL = `{{ route('dashboard.settings.currencies.index') }}`;
        window.currencyTable = initCurrencyTable(getCurrenciesURL);
        localStorage.setItem('canUpdateCurrency', `{{ Auth()->user()->hasPermission('update-currency') }}`);
        localStorage.setItem('canDeleteCurrency', `{{ Auth()->user()->hasPermission('delete-currency') }}`);
    });

    function initCurrencyTable(url) {
        return $('#kt_datatable_currencies').DataTable({
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
                    name: 'name',
                    data: 'name',
                },
                {
                    name: 'iso_code',
                    data: 'iso_code',
                },
                {
                    name: 'symbol',
                    data: 'symbol',
                },
                {
                    name: 'html_entity',
                    data: 'html_entity',
                },
                {
                    name: 'symbol_first',
                    data: 'is_symbol_first',
                    render: function(data, type, full, meta) {
                        let toggleURL =
                            `{{ route('dashboard.settings.currencies.toggle-status', ['id']) }}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input type="checkbox" class="toggle" ${localStorage.getItem('canUpdateCurrency') ? '' : 'disabled'}
                                            ${full.is_symbol_first ? 'checked' : ''} name="is_symbol_first"
                                            data-name="is_symbol_first" data-id="${full.id}" data-toggle-url="${toggleURL}" />
                                        <span></span>
                                    </label>
                                </span>`;
                    },
                },
                {
                    name: 'is_main',
                    data: 'is_main',
                    render: function(data, type, full, meta) {
                        return data ?
                            `<span class="label label-lg font-weight-bold label-inline label-light-success"> {{ __('settings::dashboard.yes') }} </span>` :
                            '';
                    }
                },
                {
                    name: 'status',
                    data: 'is_active',
                    render: function(data, type, full, meta) {
                        let toggleURL =
                            `{{ route('dashboard.settings.currencies.toggle-status', ['id']) }}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input type="checkbox" class="toggle" ${localStorage.getItem('canUpdateCurrency') ? '' : 'disabled'}
                                            ${full.is_active ? 'checked' : ''} name="is_active"
                                            data-name="is_active" data-id="${full.id}" data-toggle-url="${toggleURL}" />
                                        <span></span>
                                    </label>
                                </span>`;
                    },
                },
                {
                    name: 'actions',
                    data: 'actions',
                    render: function(data, type, full, meta) {
                        let actions = '';
                        if (localStorage.getItem('canUpdateCurrency')) {
                            let editUrl =
                                `{{ route('dashboard.settings.currencies.edit', ['id']) }}`;
                            editUrl = editUrl.replace('id', full.id);
                            actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('website::dashboard.edit') }}">
                                    <i class="la la-edit"></i>
                                </a>`;
                        }
                        if (localStorage.getItem('canDeleteCurrency') && full.is_main != 1) {
                            let destroyUrl =
                                `{{ route('dashboard.settings.currencies.destroy', ['id']) }}`;
                            destroyUrl = destroyUrl.replace('id', full.id);
                            actions +=
                                `<a href="javascript:;" onClick="deleteRecord('${destroyUrl}', ${full.id}, refreshCurrenciesDatatabel)"
                                    class="btn btn-sm btn-clean btn-icon" title="{{ __('website::dashboard.delete') }}">
                                    <i class="la la-trash"></i>
                                </a>`;
                        }
                        return actions;
                    },
                },
            ],
        });
    };

    function refreshCurrenciesDatatabel() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            window.currencyTable.ajax.reload(function(json) {}, false);
        }, 300);
    }
</script>
