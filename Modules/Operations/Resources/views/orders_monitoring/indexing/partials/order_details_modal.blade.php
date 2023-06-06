<div class="modal fade bd-example-modal-lg" id="orderDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('operations::dashboard.order_details')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="orderDetailsModalBody">

                <h3>{{__('operations::dashboard.order_info')}}</h3>
                <table class="table">
                    <tr>
                        <td>{{__('operations::dashboard.id')}}</td>
                        <td id="id"></td>
                    </tr>
                    <tr>
                        <td>{{__('operations::dashboard.customer_name')}}</td>
                        <td id="customer_name"></td>
                    </tr>
                    <tr>
                        <td>{{__('operations::dashboard.delivery_name')}}</td>
                        <td id="delivery_name"></td>
                    </tr>
                    <tr>
                        <td>{{__('operations::dashboard.branch_name')}}</td>
                        <td id="branch_name"></td>
                    </tr>
                    <tr>
                        <td>{{__('operations::dashboard.merchant_name')}}</td>
                        <td id="merchant_name"></td>
                    </tr>
                    <tr>
                        <td>{{__('operations::dashboard.order_status')}}</td>
                        <td id="order_status"></td>
                    </tr>
                    <tr>
                        <td>{{__('operations::dashboard.payment_method')}}</td>
                        <td id="payment_method"></td>
                    </tr>
                    <tr>
                        <td>{{__('operations::dashboard.total')}}</td>
                        <td id="total"></td>
                    </tr>
                    <tr>
                        <td>{{__('operations::dashboard.created_at')}}</td>
                        <td id="created_at"></td>
                    </tr>

                </table>


                <h3>{{__('operations::dashboard.order_product')}}</h3>
                <table id="order_product" class="table">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>{{__('operations::dashboard.product_name')}}</td>
                                <td>{{__('operations::dashboard.price')}}</td>
                                <td>{{__('operations::dashboard.quantity')}}</td>
                            </tr>
                        </thead>
                        <tbody id="order_product_body">

                        </tbody>
                </table>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('operations::dashboard.close')}}</button>
            </div>
        </div>
    </div>
</div>
