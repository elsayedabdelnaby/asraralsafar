<script>
    "use strict";
    $(function() {
        let getCountriesURL = `{{ route('dashboard.locations.countries.index') }}`;
        window.CountriesTable = initCountriesTable(getCountriesURL);

        localStorage.setItem('canUpdateCountryType', `{{ Auth()->user()->hasPermission('update-country') }}`);
        localStorage.setItem('canDeleteCountryType', `{{ Auth()->user()->hasPermission('delete-country') }}`);

    });

    function initCountriesTable(url) {
        return $('#kt_datatable_countries').DataTable({
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
                    data: 'name'
                },
                {
                    name: 'nationality',
                    data: 'nationality'
                },
                {
                    name: 'code',
                    data: 'phone_code'
                },
                {
                    name: 'currency',
                    data: 'currency_name'
                },
                {
                    name: 'states',
                    data: 'states',
                    render: function(data, type, full, meta) {
                        let toggleURL =
                            `{{ route('dashboard.locations.states.index', ['country_id']) }}`
                        toggleURL = toggleURL.replace('country_id', full.id);
                        return `<a href="${toggleURL}"> {{ __('locations::dashboard.states') }} </a>`
                    }
                },
                {
                    name: 'status',
                    data: 'is_active',
                    render: function(data, type, full, meta) {
                        let toggleURL =
                            `{{ route('dashboard.locations.countries.toggle-status', ['country_id']) }}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input
                                            ${localStorage.getItem('canUpdateCountryType') ? '' : 'disabled'}
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
                    render: function(data, type, full, meta) {

                        let actions = '';

                        if (localStorage.getItem('canUpdateCountryType')) {
                            let editUrl = `{{ route('dashboard.locations.countries.edit', ['id']) }}`;
                            editUrl = editUrl.replace('id', full.id);
                            actions +=
                                `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('locations::dashboard.edit') }}"><i class="la la-edit"></i></a>`;
                        }

                        if (localStorage.getItem('canDeleteCountryType')) {
                            let deleteUrl =
                                `{{ route('dashboard.locations.countries.destroy', ['id']) }}`;
                            deleteUrl = deleteUrl.replace('id', full.id);
                            actions += `<a href="javascript:;" onClick="deleteRecord('${deleteUrl}', ${full.id}, deleteCountryCallBack)"
                                    class="btn btn-sm btn-clean btn-icon" title="{{ __('locations::dashboard.delete') }}">
                                    <i class="la la-trash"></i>
                                </a>`;


                        }

                        return actions;
                    },
                },
            ],
        });
    };

    function deleteCountryCallBack() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            window.CountriesTable.ajax.reload(function(json) {}, false);
        }, 300);
    }
</script>
