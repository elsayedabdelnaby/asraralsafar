<script>
    "use strict";
    $(function () {
        let getLanguagesURL = `{{ route('dashboard.languages.index') }}`;
        window.languageTable = initLanguageTable(getLanguagesURL);
        localStorage.setItem('canUpdateLanguage', `{{ Auth()->user()->hasPermission('update-language') }}`);
        localStorage.setItem('canDeleteLanguage', `{{ Auth()->user()->hasPermission('delete-language') }}`);
    });

    function initLanguageTable(url) {
        return $('#kt_datatable_languages').DataTable({
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
                    data: 'name',
                },
                {
                    name: 'code',
                    data: 'code',
                },
                {
                    name: 'direction',
                    data: 'direction',
                },
                {
                    name: 'active',
                    data: 'is_active',
                    render: function (data, type, full, meta) {
                        let toggleURL =
                            `{{ route('dashboard.languages.toggle-status', ['id']) }}`;
                        toggleURL = toggleURL.replace('id', full.id);
                        console.log(full)
                        return `<span class="switch switch-outline switch-icon switch-success switch-sm">
                                    <label>
                                        <input type="checkbox" class="toggle" ${localStorage.getItem('canUpdateLanguage') ? '' : 'disabled'}
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
                    render: function (data, type, full, meta) {
                        let actions = '';
                        let id = full.id;
                        if (localStorage.getItem('canUpdateLanguage') && id !== 1 && id !== 2) {
                            let editUrl =
                                `{{ route('dashboard.languages.edit', ['id']) }}`;
                            editUrl = editUrl.replace('id', id);
                            actions += `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('website::dashboard.edit') }}">
                                    <i class="la la-edit"></i>
                                </a>`;
                        }
                        if (localStorage.getItem('canDeleteLanguage') && id !== 1 && id !== 2) {
                            let destroyUrl =
                                `{{ route('dashboard.languages.delete', ['id']) }}`;
                            destroyUrl = destroyUrl.replace('id', id);
                            actions +=
                                `<a href="javascript:;" onClick="deleteRecord('${destroyUrl}', ${id}, refreshLanguagesDatatabel)"
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

    function refreshLanguagesDatatabel() {
        // Reload datatable with delay to clear cache
        setTimeout(function () {
            window.languageTable.ajax.reload(function (json) {
            }, false);
        }, 300);
    }
</script>
