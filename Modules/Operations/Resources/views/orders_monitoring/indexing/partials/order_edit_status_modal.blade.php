<div class="modal fade" id="orderEditStatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderEditStatusModalTitle"> {{__('operations::dashboard.edit_order_status')}} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="orderEditStatusModalBody">
                <input type="hidden" id="order_id_change_status" name="order_id_change_status">
                  <div class="col-md-12">
                        <div class="row align-items-center">
                            <label  class="col-4 col-form-label font-weight-bold">{{ __('sales::dashboard.order_status') }}</label>
                            <div class="col-6">
                                    <x-dashboard.form.inputs.select
                                        :id="'select_order_status_id'"
                                        :name="'select_order_status_id'"
                                        :options="$order_status"
                                        :isRequired="true"
                                        :isMultiple="false"
                                        :requiredMessage="__('merchants::dashboard.order_status_is_required')"
                                        :defaultOptionName="__('sales::dashboard.select_order_status')"
                                        :selectedOption="old('order_status_id',$order['order_status_id'] ?? '')"
                                    />
                            </div>
                        </div>
    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="submitUpdateOrderStatus">{{__('operations::dashboard.save')}}</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('operations::dashboard.close')}}</button>
            </div>
        </div>
    </div>
</div>
