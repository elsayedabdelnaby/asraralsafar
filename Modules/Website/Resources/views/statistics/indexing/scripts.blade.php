<script>
    "use strict";
    $(function() {
        let getStatisticsURL = `{{ route('dashboard.website.statistics.index') }}`;
        window.statisticsTable = initStatisticsTable(getStatisticsURL);
        localStorage.setItem('canUpdateStatistic',
            `{{ Auth()->user()->hasPermission('update-statistic') }}`);
        localStorage.setItem('canDeleteStatistic',
            `{{ Auth()->user()->hasPermission('delete-statistic') }}`);
    });

    function initStatisticsTable(url) {
        return $('#kt_datatable_statistics').DataTable({
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
                    name: 'title',
                    data: 'title'
                },
                {
                    name: 'number',
                    data: 'number',
                },
                {
                    name: 'display_order',
                    data: 'display_order'
                },
                {
                    name: 'status',
                    data: 'is_active',
                    render: function(data, type, full, meta) {
                        let toggleURL =
                            `{{ route('dashboard.website.statistics.toggle-status', ['id']) }}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input type="checkbox" class="toggle" ${localStorage.getItem('canUpdateStatistic') ? '' : 'disabled'}
                                            ${full.is_active ? 'checked' : ''} name="is_active"
                                            data-name="is_active" data-id="${full.id}" data-toggle-url="${toggleURL}" />
                                        <span></span>
                                    </label>
                                </span>`;
                    },
                },
                {
                    name: 'actions',
                    data: 'Actions',
                    render: function(data, type, full, meta) {
                        let actions = '';
                        if (localStorage.getItem('canUpdateStatistic')) {
                            let editUrl =
                                `{{ route('dashboard.website.statistics.edit', ['id']) }}`;
                            editUrl = editUrl.replace('id', full.id);
                            actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('website::dashboard.edit') }}">
                                    <i class="la la-edit"></i>
                                </a>`;
                        }
                        if (localStorage.getItem('canDeleteStatistic')) {
                            let destroyUrl =
                                `{{ route('dashboard.website.statistics.destroy', ['id']) }}`;
                            destroyUrl = destroyUrl.replace('id', full.id);
                            actions +=
                                `<a href="javascript:;" onClick="deleteRecord('${destroyUrl}', ${full.id}, deleteStatisticCallBack)"
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

    function deleteStatisticCallBack() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            window.statisticsTable.ajax.reload(function(json) {}, false);
        }, 300);
    }
</script>
