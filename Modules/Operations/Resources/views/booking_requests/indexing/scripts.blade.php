<script>
    "use strict";
    $(function() {
        let getBookingRequestMessagesURL = `{{ route('dashboard.operations.booking-requests.index') }}`;
        window.BookingRequestMessagesTable = initBookingRequestMessagesTable(getBookingRequestMessagesURL);
        localStorage.setItem('canUpdateBookingRequestMessage',
            `{{ Auth()->user()->hasPermission('edit-booking-requests') }}`);
    });

    function initBookingRequestMessagesTable(url) {
        return $('#kt_datatable_booking_requests').DataTable({
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
                    name: 'from',
                    data: 'from_city_name'
                },
                {
                    name: 'to',
                    data: 'to_city_name'
                },
                {
                    name: 'status',
                    data: 'status'
                },
                {
                    name: 'service',
                    data: 'service_name'
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

                        if (localStorage.getItem('canUpdateBookingRequestMessage')) {
                            let editUrl =
                                `{{ route('dashboard.operations.booking-requests.edit', ['id']) }}`;
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
