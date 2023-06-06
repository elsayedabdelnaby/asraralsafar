<script>

    let socket   = io('http://localhost:3000', {transports: ['websocket']});
    let userId   = '{{auth()->user()->id}}';
    let userType = '{{auth()->user()->type}}';
    let userOwnerBranchMerchantId = getUserOwnerBranchMerchantId();

    socket.emit('init-user-socket',{'user_id':userId,'user_tpe':userType});

    socket.on('order-monitoring-publish', function (message) {
        if (userType === 'admin') {
            fireNotificationToOrderRubyMonitoring(message);
            return;
        }
        if (userType === "merchant_manager" && message.merchant_manager_id == userId && userOwnerBranchMerchantId == message.merchant_id) {
            fireNotificationToOrderRubyMonitoring(message);
            return;
        }
        if (userType == 'branch_manager' && message.merchant_branch_manager_id == userId && userOwnerBranchMerchantId == message.merchant_branch_id) {
            fireNotificationToOrderRubyMonitoring(message);
            return;
        }
    });

    function fireNotificationToOrderRubyMonitoring(message) {
        showToastNotificationMessage('{{__('operations::dashboard.order_has_been_changed')}}', message.id);
        $('#order_row_id_' + message.id).css('background-color', message.order_status_color);
    }

    function getUserOwnerBranchMerchantId() {

        @if(auth()->user()->type === 'merchant_manager')
            return '{{auth()->user()->merchant->id}}';
        @elseif(auth()->user()->type === 'branch_manager')
            return '{{auth()->user()->branch->id}}';
        @endif

        return '';

    }


</script>
