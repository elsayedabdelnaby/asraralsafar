<script>
    "use strict";
    $(function() {
        let getContactInformationsURL = `{{ route('dashboard.website.contact-informations.index') }}`;
        window.contactInformationsTable = initContactInformationsTable(getContactInformationsURL);
        localStorage.setItem('canUpdateContactInformation',
            `{{ Auth()->user()->hasPermission('update-contact-information') }}`);
        localStorage.setItem('canDeleteContactInformation',
            `{{ Auth()->user()->hasPermission('delete-contact-information') }}`);
    });

    function initContactInformationsTable(url) {
        return $('#kt_datatable_contact_informations').DataTable({
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
                    name: 'type',
                    data: 'type',
                },
                {
                    name: 'value',
                    data: 'value'
                },
                {
                    name: 'status',
                    data: 'is_active',
                    render: function(data, type, full, meta) {
                        let toggleURL =
                            `{{ route('dashboard.website.contact-informations.toggle-status', ['id']) }}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input type="checkbox" class="toggle" ${localStorage.getItem('canUpdateContactInformation') ? '' : 'disabled'}
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
                        if (localStorage.getItem('canUpdateContactInformation')) {
                            let editUrl =
                                `{{ route('dashboard.website.contact-informations.edit', ['id']) }}`;
                            editUrl = editUrl.replace('id', full.id);
                            actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('website::dashboard.edit') }}">
                                    <i class="la la-edit"></i>
                                </a>`;
                        }
                        if (localStorage.getItem('canDeleteContactInformation')) {
                            let destroyUrl =
                                `{{ route('dashboard.website.contact-informations.destroy', ['id']) }}`;
                            destroyUrl = destroyUrl.replace('id', full.id);
                            actions +=
                                `<a href="javascript:;" onClick="deleteRecord('${destroyUrl}', ${full.id}, deleteContactInformationCallBack)"
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

    function deleteContactInformationCallBack() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            window.contactInformationsTable.ajax.reload(function(json) {}, false);
        }, 300);
    }
</script>
