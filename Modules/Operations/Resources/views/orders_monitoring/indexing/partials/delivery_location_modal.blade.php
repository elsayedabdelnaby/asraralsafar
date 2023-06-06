<div class="modal fade" id="deliveryLocationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('operations::dashboard.delivery_location')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="deliveryLocationModalBody">
                <div id="map"></div>
                <table class="table">
                    <tr>
                        <td> {{__('operations::dashboard.address')}} </td>
                        <td id="address"></td>
                    </tr>
                    <tr>
                        <td> {{__('operations::dashboard.city_name')}} </td>
                        <td id="city_name"></td>
                    </tr>
                    <tr>
                        <td> {{__('operations::dashboard.apartment_no')}} </td>
                        <td id="apartment_no"></td>
                    </tr>
                    <tr>
                        <td> {{__('operations::dashboard.build_no')}} </td>
                        <td id="build_no"></td>
                    </tr>
                    <tr>
                        <td> {{__('operations::dashboard.floor_no')}} </td>
                        <td id="floor_no"></td>
                    </tr>
                    <tr>
                        <td> {{__('operations::dashboard.phone_number')}} </td>
                        <td id="phone_number"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('operations::dashboard.close')}}</button>
            </div>
        </div>
    </div>
</div>
