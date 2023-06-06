<script>
    "use strict";
    $(function() {
        let getMainSlidersURL = `{{ route('dashboard.website.main-sliders.index') }}`;
        window.mainSlidersTable = initMainSlidersTable(getMainSlidersURL);
        localStorage.setItem('canUpdateMainSlider',
            `{{ Auth()->user()->hasPermission('update-main-slider') }}`);
        localStorage.setItem('canDeleteMainSlider',
            `{{ Auth()->user()->hasPermission('delete-main-slider') }}`);
    });

    function initMainSlidersTable(url) {
        return $('#kt_datatable_main_sliders').DataTable({
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
                    name: 'image',
                    data: 'image',
                    render: function(data, type, full, meta) {
                        return `<img src="${full.image}" alt="image" width="100" heigh="100">`;
                    }
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
                            `{{ route('dashboard.website.main-sliders.toggle-status', ['slider_id']) }}`;
                        toggleURL = toggleURL.replace('slider_id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input type="checkbox" class="toggle" ${localStorage.getItem('canUpdateMainSlider') ? '' : 'disabled'}
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
                        if (localStorage.getItem('canUpdateMainSlider')) {
                            let editUrl =
                                `{{ route('dashboard.website.main-sliders.edit', ['slider_id']) }}`;
                            editUrl = editUrl.replace('slider_id', full.id);
                            actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('website::dashboard.edit') }}">
                                    <i class="la la-edit"></i>
                                </a>`;
                        }
                        if (localStorage.getItem('canDeleteMainSlider')) {
                            let destroyUrl =
                                `{{ route('dashboard.website.main-sliders.destroy', ['slider_id']) }}`;
                            destroyUrl = destroyUrl.replace('slider_id', full.id);
                            actions +=
                                `<a href="javascript:;" onClick="deleteRecord('${destroyUrl}', ${full.id}, deleteMainSliderCallBack)"
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

    function deleteMainSliderCallBack() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            window.mainSlidersTable.ajax.reload(function(json) {}, false);
        }, 300);
    }
</script>
