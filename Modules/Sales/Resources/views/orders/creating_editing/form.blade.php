@extends('dashboard.layouts.app')

@if (isset($sales))
    @section('title', __('sales::dashboard.sales_management') . ' - ' . __('sales::dashboard.edit_sales'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('order::dashboard.edit_sales'),
            'short_description' => __('order::dashboard.enter_order_details_and_submit'),
        ]);
    @endsection
@else
    @section('title', __('sales::dashboard.sales_management') . ' - ' . __('sales::dashboard.new_order'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('sales::dashboard.new_order'),
            'short_description' => __('sales::dashboard.enter_order_details_and_submit'),
        ]);
    @endsection
@endif
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ isset($sales) ?  __('sales::dashboard.edit_sales') :  __('sales::dashboard.new_order')  }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{route('dashboard.sales.orders.index')}}"
                   class="btn btn-light-primary font-weight-bolder mr-2">
                    <i class="ki ki-long-arrow-back icon-sm"></i>{{ __('dashboard.back') }}
                </a>
            </div>
        </div>
        <!--begin::Form-->
        <form class="form parsley-form" action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)
            <div class="card-body">

                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="row">
                            <label
                                class="col-2 col-form-label font-weight-bold">{{ __('sales::dashboard.merchant') }}</label>
                            <div class="col-6">
                                @if(isset($order))
                                    <x-dashboard.form.inputs.text :id="'merchant'" :class="'form-control'" :name="''"
                                                                  :value="$order['merchant']" :readonly="true"
                                                                  :placeholder="''"/>
                                @else
                                    <x-dashboard.form.inputs.selectArray :id="'merchant_id'"
                                                                         :name="'merchant_id'"
                                                                         :options="$merchants"
                                                                         :isMultiple="false"
                                                                         :defaultOptionName="__('sales::dashboard.select_merchant')"
                                                                         :selectedOption="old('merchant_id', '')"/>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <label
                                class="col-2 col-form-label">{{ __('sales::dashboard.branch') }}</label>
                            <div class="col-6">
                                @if(isset($order))
                                    <x-dashboard.form.inputs.text :id="'branch_id'" :class="'form-control'"
                                                                  :name="'branch_id'"
                                                                  :value="$order['branch']" :readonly="true"
                                                                  :placeholder="''"/>
                                @else
                                    <select class="form-control select2 "
                                            name="branch_id"
                                            id="branch_id"
                                            required
                                            data-parsley-required-message="{{ __('sales::dashboard.branch_is_needed') }}"
                                    >
                                        <option value="">
                                            {{ __('sales::dashboard.select_branch')    }}
                                        </option>
                                    </select>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="row">
                            <label
                                class="col-2 col-form-label font-weight-bold">{{ __('sales::dashboard.customer') }}</label>
                            <div class="col-6">
                                @if(isset($order))
                                    <x-dashboard.form.inputs.text :id="'customer_name'" :class="'form-control'"
                                                                  :name="'customer_name'"
                                                                  :value="$order['customer']['name']" :readonly="true"
                                                                  :placeholder="''"/>

                                    <input type="hidden" value="{{$order['customer']['id']}}" name="customer_id"
                                           id="customer_id">
                                @else
                                    <x-dashboard.form.inputs.selectArray :id="'customer_id'" :name="'customer_id'"
                                                                         :options="$customers"
                                                                         :isMultiple="false"
                                                                         :defaultOptionName="__('sales::dashboard.select_customer')"
                                                                         :selectedOption="old('customer_id', '')"/>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <label
                                class="col-2 col-form-label">{{ __('sales::dashboard.address') }}</label>
                            <div class="col-6">
                                @if(isset($order['address']))
                                    <select class="form-control select2 "
                                            name="address_id"
                                            id="address_id"
                                            required
                                            data-parsley-required-message="{{ __('sales::dashboard.address_is_needed') }}"
                                    >
                                        <option value="">
                                            {{ __('sales::dashboard.select_address')    }}
                                        </option>
                                        @foreach($addresses as $address)
                                            <option value="{{$address['id']}}"
                                                    @if($address['id'] === $order['address']['id']) selected @endif>
                                                {{$address['address']}}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <select class="form-control select2 "
                                            name="address_id"
                                            id="address_id"
                                            required
                                            data-parsley-required-message="{{ __('sales::dashboard.address_is_needed') }}"
                                    >
                                        <option value="">
                                            {{ __('sales::dashboard.select_address')    }}
                                        </option>
                                    </select>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="row">
                            <label
                                class="col-2 col-form-label">{{ __('sales::dashboard.delivery') }}</label>
                            <div class="col-6">
                                @if(isset($order['delivery']))
                                    <select class="form-control select2 "
                                            name="delivery_id"
                                            id="delivery_id"
                                            required
                                            data-parsley-required-message="{{ __('sales::dashboard.delivery_is_needed') }}"
                                    >
                                        <option value="">
                                            {{ __('sales::dashboard.select_delivery')    }}
                                        </option>
                                        @foreach($deliveries as $delivery)
                                            <option value="{{$delivery['id']}}"
                                                    @if($delivery['id'] === $order['delivery']['id']) selected @endif>
                                                {{$delivery['name']}}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <select class="form-control select2 "
                                            name="delivery_id"
                                            id="delivery_id"
                                            required
                                            data-parsley-required-message="{{ __('sales::dashboard.delivery_is_needed') }}"
                                    >
                                        <option value="">
                                            {{ __('sales::dashboard.select_delivery')    }}
                                        </option>
                                    </select>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row align-items-center">
                            <label
                                class="col-2 col-form-label">{{ __('merchants::dashboard.payment_method') }}</label>
                            <div class="col-6">
                                <x-dashboard.form.inputs.enum-select :id="'payment_method'" :name="'payment_method'"
                                                                     :options="$payment_methods"
                                                                     :defaultOptionName="__('merchants::dashboard.select_payment_method')"
                                                                     :selectedOption="old('payment_method', $order['payment_method'] ?? '')"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="row align-items-center">
                            <label class="col-2 col-form-label">{{ __('sales::dashboard.coupon') }}</label>
                            <div class="col-6">
                                <x-dashboard.form.inputs.text :id="'coupon_code'" :class="'form-control'"
                                                              :name="'coupon_code'"
                                                              :placeholder="__('merchants::dashboard.code')"
                                                              :value="old('coupon_code', $coupon['coupon_code'] ?? '')"
                                />
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="row align-items-center">
                            <label  class="col-2 col-form-label font-weight-bold">{{ __('sales::dashboard.order_status') }}</label>
                            <div class="col-6">
                                    <x-dashboard.form.inputs.select
                                        :id="'order_status_id'"
                                        :name="'order_status_id'"
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

                <div id="kt_product_repeater">
                    <div data-repeater-list="products">
                        @forelse (old('products', $order['products'] ?? []) as $product)
                            <div data-repeater-item class="row mb-7">
                                <div class="col-12">
                                    <div class="row mb-3">
                                        <label
                                            class="col-lg-1 col-form-label">{{ __('sales::dashboard.product') }}
                                        </label>
                                        <div class="col-lg-3">
                                            @if (is_array($product))
                                                <x-dashboard.form.inputs.selectArray :id="''"
                                                                                     :name="'product_id'"
                                                                                     :options="$products"
                                                                                     :isMultiple="false"
                                                                                     :defaultOptionName="__('sales::dashboard.select_product')"
                                                                                     :selectedOption="old('product_id', $product['id'] ?? '')"/>
                                            @else
                                                <x-dashboard.form.inputs.selectArray :id="''"
                                                                                     :name="'product_id'"
                                                                                     :options="$products"
                                                                                     :isMultiple="false"
                                                                                     :defaultOptionName="__('sales::dashboard.select_product')"
                                                                                     :selectedOption="old('product_id', '')"/>
                                            @endif
                                        </div>

                                        <label
                                            class="col-lg-2 col-form-label text-right">{{ __('sales::dashboard.quantity') }}
                                        </label>
                                        <div class="col-lg-3">
                                            @if (is_array($product))
                                                <x-dashboard.form.inputs.number :id="''"
                                                                                :class="'form-control quantity-input'"
                                                                                :name="'quantity'"
                                                                                :integerValidationMessage="__('sales::dashboard.quantity_must_be_integer')"
                                                                                :placeholder="__('sales::dashboard.quantity')"
                                                                                :value="old('quantity',  $product['quantity'] ?? '')"/>
                                            @else
                                                <x-dashboard.form.inputs.number :id="''"
                                                                                :class="'form-control quantity-input'"
                                                                                :name="'quantity'"
                                                                                :integerValidationMessage="__('sales::dashboard.quantity_must_be_integer')"
                                                                                :placeholder="__('sales::dashboard.quantity')"
                                                                                :value=" $product['quantity']"
                                                />
                                            @endif

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-10"></div>
                                        <div class="col-2">
                                            <a href="javascript:;" data-repeater-delete=""
                                               class="btn btn-sm font-weight-bolder btn-light-danger">
                                                <i class="la la-trash-o"></i>{{ __('settings::dashboard.delete') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-2"></div>
                                <!--end::Separator-->
                            </div>
                        @empty
                            <div data-repeater-item class="row mb-7">
                                <div class="col-12">
                                    <div class="row mb-3">
                                        <label
                                            class="col-lg-1 col-form-label text-center">{{ __('sales::dashboard.product') }}
                                        </label>
                                        <div class="col-lg-3">
                                            <x-dashboard.form.inputs.selectArray :id="''"
                                                                                 :name="'product_id'"
                                                                                 :options="$products"
                                                                                 :isMultiple="false"
                                                                                 :defaultOptionName="__('sales::dashboard.select_product')"
                                                                                 :selectedOption="old('product_id', $order['product_id'] ?? '')"/>
                                            <span
                                                class="form-text text-muted">{{ __('sales::dashboard.product_name') }}</span>
                                        </div>

                                        <label
                                            class="col-lg-2 col-form-label text-right">{{ __('sales::dashboard.quantity') }}
                                        </label>
                                        <div class="col-lg-3">
                                            <x-dashboard.form.inputs.number :id="''"
                                                                            :class="'form-control quantity-input'"
                                                                            :name="'quantity'"
                                                                            :integerValidationMessage="__('sales::dashboard.quantity_must_be_integer')"
                                                                            :placeholder="__('sales::dashboard.quantity')"
                                                                            :value="''"
                                                                            :isRequired="true"
                                                                            :requiredMessage="__('merchants::dashboard.quantity_is_required')"

                                            />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-10"></div>
                                        <div class="col-2">
                                            <a href="javascript:;" data-repeater-delete=""
                                               class="btn btn-sm font-weight-bolder btn-light-danger">
                                                <i class="la la-trash-o"></i>{{ __('settings::dashboard.delete') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-2"></div>
                                <!--end::Separator-->
                            </div>
                        @endforelse
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-10 col-form-label text-right"></label>
                        <div class="col-lg-2">
                            <a href="javascript:;" data-repeater-create=""
                               class="btn btn-sm font-weight-bolder btn-light-primary">
                                <i class="la la-plus"></i>{{ __('settings::dashboard.add') }}
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-10"></div>
                    <div class="col-2">
                        <button type="submit"
                                class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">{{ __('settings::dashboard.save') }}</button>
                        <a href="{{route('dashboard.sales.orders.index')}}"
                           class="btn font-weight-bold btn-secondary">{{ __('settings::dashboard.cancel') }}</a>
                    </div>
                </div>
            </div>
        </form>
        <!--end::Form-->
    </div>
@endsection

@push('javascript')
    <!-- Form Parsley Validation -->
    <script src="{{ global_asset('metronic/assets/plugins/parsley/parsley.min.js') }}"></script>
    <!--end::Form Parsley Validation-->
    <!-- Form JS -->
    <script src="{{ global_asset('js/form.js') }}"></script>
    <!--end::Form JS-->
    <!-- Custom JS -->
    @include('sales::orders.creating_editing.scripts')
    <!--end::Custom JS-->
@endpush
