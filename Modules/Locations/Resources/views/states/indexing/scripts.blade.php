<script>
    "use strict";
    $(function() {
        let getStatesURL = `{{ route('dashboard.locations.states.index', $country_id) }}`;
        window.StatesTable = initStatesTable(getStatesURL);
        localStorage.setItem('canUpdateState', `{{ Auth()->user()->hasPermission('update-state') }}`);
        localStorage.setItem('canDeleteState', `{{ Auth()->user()->hasPermission('delete-state') }}`);
    });

    function initStatesTable(url) {
        return $('#kt_datatable_states').DataTable({
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
                    name: 'country_name',
                    data: 'country_name'
                },
                {
                    name: 'cities',
                    data: 'cities',
                    render: function(data, type, full, meta) {
                        let citiesURL =
                            `{{ route('dashboard.locations.cities.index', ['state_id', 'country_id']) }}`
                        citiesURL = citiesURL.replace('state_id', full.id);
                        citiesURL = citiesURL.replace('country_id', full.country_id);
                        return `<a href="${citiesURL}"> Cities </a>`
                    }
                },
                {
                    name: 'status',
                    data: 'is_active',
                    render: function(data, type, full, meta) {
                        let toggleURL =
                            `{{ route('dashboard.locations.states.toggle-status', ['id']) }}`;

                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input
                                            ${localStorage.getItem('canUpdateState') ? '' : 'disabled'}
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

                        if (localStorage.getItem('canUpdateState')) {
                            let editUrl =
                                `{{ route('dashboard.locations.states.edit', ['country_id', 'state_id']) }}`;
                            editUrl = editUrl.replace('state_id', full.id);
                            editUrl = editUrl.replace('country_id', full.country_id);
                            actions +=
                                `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('locations::dashboard.edit') }}"><i class="la la-edit"></i></a>`;
                        }

                        if (localStorage.getItem('canDeleteState')) {
                            let deleteUrl = `{{ route('dashboard.locations.states.destroy', ['id']) }}`;
                            deleteUrl = deleteUrl.replace('id', full.id);
                            actions += `<a href="javascript:;" onClick="deleteRecord('${deleteUrl}', ${full.id}, deleteStateCallBack)"
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

    function deleteStateCallBack() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            window.StatesTable.ajax.reload(function(json) {}, false);
        }, 300);
    }
</script>
