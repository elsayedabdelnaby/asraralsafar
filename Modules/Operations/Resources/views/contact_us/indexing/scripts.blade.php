<script>
    "use strict";
    $(function() {
        let getContactUsMessagesURL = `{{ route('dashboard.operations.contact-us.index') }}`;
        window.ContactUsMessagesTable = initContactUsMessagesTable(getContactUsMessagesURL);
        localStorage.setItem('canUpdateContactUsMessage',
            `{{ Auth()->user()->hasPermission('reply-on-contact-us-message') }}`);
    });

    function initContactUsMessagesTable(url) {
        return $('#kt_datatable_contact_us_messages').DataTable({
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
                    name: 'email',
                    data: 'email'
                },
                {
                    name: 'phone',
                    data: 'phone'
                },
                {
                    name: 'title',
                    data: 'title'
                },
                {
                    name: 'status',
                    data: 'status'
                },
                {
                    name: 'message',
                    data: 'message'
                },
                {
                    name: 'answer',
                    data: 'answer'
                },
                {
                    name: 'created_at',
                    data: 'created_at'
                },
                {
                    name: 'updated_at',
                    data: 'updated_at'
                },
                {
                    name: 'actions',
                    data: 'actions',
                    render: function(data, type, full, meta) {

                        let actions = '';

                        if (localStorage.getItem('canUpdateContactUsMessage')) {
                            let editUrl =
                                `{{ route('dashboard.operations.contact-us.edit', ['id']) }}`;
                            editUrl = editUrl.replace('id', full.id);
                            actions +=
                                `<a href="${editUrl}" class="btn btn-sm btn-clean btn-icon" title="{{ __('operations::dashboard.edit') }}"><i class="la la-edit"></i></a>`;
                        }

                        return actions;
                    },
                },
            ],
        });
    };
</script>
