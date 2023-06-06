@extends('dashboard.layouts.modal')
@section('content')
    <div class="modal-header">
        <h5 class="modal-title" id="deleteProfileLabel">{{ __('usersmanagement::dashboard.change_password') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form class="form parsley-form" action="{{ route('dashboard.users-management.users.update-password', ['id' => $id]) }}"
        method="POST">
        <div class="modal-body">
            @method('POST')
            @csrf
            <input type="hidden" name="id" value="{{ $id }}" />
            <div class="form-group row">
                <label for="item"
                    class="col-5 col-form-label">{{ __('usersmanagement::dashboard.new_password') }}:</label>
                <div class="col-7">
                    <div class="input-group">
                        <input type="password" name="password" class="form-control password-input" value=""
                            required id="password" />
                        <div class="input-group-append">
                            <button class="btn btn-secondary show-hide-password-btn" type="button">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="confirm-password"
                    class="col-5 col-form-label">{{ __('usersmanagement::dashboard.confirm_password') }}:</label>
                <div class="col-7">
                    <div class="input-group">
                        <input type="password" name="password_confirmation" id="confirm_password"
                            class="form-control password-input" value="" required data-parsley-equalto="#password"
                            data-parsley-equalto-message="Password and Confirm Password should match" />
                        <div class="input-group-append">
                            <button class="btn btn-secondary show-hide-password-btn" type="button">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit"
                class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">{{ __('usersmanagement::dashboard.save') }}</button>
            <button type="button" class="btn font-weight-bold btn-secondary close-modal"
                data-dismiss="modal">{{ __('usersmanagement::dashboard.cancel') }}</button>
        </div>
    </form>
@endsection
@push('javascript')
    <!-- Form Parsley Validation -->
    <script src="{{ global_asset('metronic/assets/plugins/parsley/parsley.min.js') }}"></script>
    <!--end::Form Parsley Validation-->
    <!-- Form JS -->
    <script src="{{ global_asset('js/form.js') }}"></script>
    <!--end::Form JS-->
    <script>
        $(document).ready(function() {
            $('.show-hide-password-btn').click(function() {
                if ($(this).parents('.input-group').find('input.password-input').attr('type') === 'password') {
                    $(this).parents('.input-group').find('input.password-input').attr('type', 'text');
                    $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    $(this).parents('.input-group').find('input.password-input').attr('type', 'password');
                    $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
        });
    </script>
@endpush
