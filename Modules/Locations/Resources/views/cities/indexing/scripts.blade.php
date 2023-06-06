<script>
    "use strict";
    $(function () {
        let getCitiesURL     = `{{ route('dashboard.locations.cities.index', [$country_id, $state_id]) }}`;
        window.CitiesTable = initCitiesTable(getCitiesURL);
        localStorage.setItem('canUpdateCity', `{{ Auth()->user()->hasPermission('update-city') }}`);
        localStorage.setItem('canDeleteCity', `{{ Auth()->user()->hasPermission('delete-city') }}`);
    });

    function initCitiesTable(url) {
        return $('#kt_datatable_cities').DataTable({
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
                    name:'state_name',
                    data:'state_name'
                },
                {
                    name: 'status',
                    data: 'is_active',
                    render: function (data, type, full, meta) {
                        let toggleURL = `{{ route('dashboard.locations.cities.toggle-status', ['id']) }}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input
                                            ${localStorage.getItem('canUpdateCity') ? '' : 'disabled'}
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
                        console.log(localStorage.getItem('canUpdateCity'));
                        if (localStorage.getItem('canUpdateCity')) {
                            let editUrl = `{{ route('dashboard.locations.cities.edit', ['id' => 'id', 'country_id' => $country_id, 'state_id' => $state_id]) }}`;
                            editUrl     = editUrl.replace('id', full.id);
                            actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('locations::dashboard.edit') }}"><i class="la la-edit"></i></a>`;
                        }

                        if (localStorage.getItem('canDeleteCity')) {
                            let deleteUrl = `{{ route('dashboard.locations.cities.destroy', ['id']) }}`;
                            deleteUrl     = deleteUrl.replace('id', full.id);
                            actions += `<a href="javascript:;" onClick="deleteRecord('${deleteUrl}', ${full.id}, deleteCityCallBack)"
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

    function deleteCityCallBack() {
        // Reload datatable with delay to clear cache
        setTimeout(function () {
            window.CitiesTable.ajax.reload(function (json) {
            }, false);
        }, 300);
    }
</script>
