<div class="modal fade" id="orderAssignDeliveryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderEditStatusModalTitle">{{__('operations::dashboard.assign_delivery')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="orderEditStatusModalBody">
                <input type="hidden" id="deliveryOrderId" name="deliveryOrderId">
                  <div class="col-md-12">
                        <div class="row align-items-center">
                            <label  class="col-4 col-form-label font-weight-bold">{{ __('operations::dashboard.delivery_guys') }}</label>
                            <div class="col-6">
                                <select class="form-control" id="delivery_guy" name="delivery_guy"></select>
                            </div>
                        </div>
    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="submitAssignDelivery">{{__('operations::dashboard.save')}}</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('operations::dashboard.close')}}</button>
            </div>
        </div>
    </div>
</div>
