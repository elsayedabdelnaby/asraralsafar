@extends('dashboard.layouts.app')

@if (isset($faq))
    @section('title', __('website::dashboard.website') . ' - ' . __('website::dashboard.edit_faq'))

    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('website::dashboard.edit_faq'),
            'short_description' => __('website::dashboard.enter_faq_details_and_submit'),
            'breadcrumbs' => [],
        ]);
    @endsection
@else
    @section('title', __('website::dashboard.website') . ' - ' . __('website::dashboard.create_faq'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('website::dashboard.new_faq'),
            'short_description' => __('website::dashboard.enter_faq_details_and_submit'),
            'breadcrumbs' => [],
        ]);
    @endsection
@endif

@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ isset($faq) ? __('website::dashboard.edit_faq') : __('website::dashboard.new_faq') }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.website.faqs.index') }}" class="btn btn-light-primary font-weight-bolder mr-2">
                    <i class="ki ki-long-arrow-back icon-sm"></i>{{ __('dashboard.back') }}</a>
            </div>
        </div>
        <!--begin::Form-->
        <form class="form parsley-form" action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)
            <div class="card-body">
                <div class="form-group row">
                    <label
                        class="col-1 col-form-label font-weight-bold text-right">{{ __('website::dashboard.category') }}</label>
                    <div class="col-2">
                        <x-dashboard.form.inputs.select :id="'category_id'" :name="'category_id'" :options="$categories"
                            :isMultiple="false" :defaultOptionName="__('website::dashboard.select_category')" :selectedOption="old('category_id', $faq->category_id ?? '')" />
                    </div>
                </div>
                <div id="kt_faq_translation_repeater">
                    <div class="form-group row">
                        <div data-repeater-list="translations" class="col-lg-12">
                            @forelse (old('translations', $faq->translations ?? []) as $translation)
                                <div data-repeater-item class="row align-items-top">
                                    <div class="col-md-3">
                                        <div class="row">
                                            <label
                                                class="col-lg-4 col-form-label text-right">{{ __('website::dashboard.language') }}:</label>
                                            <div class="col-lg-8">
                                                @if (is_array($translation))
                                                    <x-dashboard.form.inputs.language-select :selectedOption="$translation['language_id']" />
                                                @else
                                                    <x-dashboard.form.inputs.language-select :selectedOption="$translation->language_id" />
                                                @endif
                                                <span
                                                    class="form-text text-muted">{{ __('website::dashboard.the_language_of_the_faq_question_and_answer') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <label
                                                class="col-lg-4 col-form-label text-right">{{ __('website::dashboard.question') }}:</label>
                                            <div class="col-lg-8">
                                                @if (is_array($translation))
                                                    <x-dashboard.form.inputs.text :id="''" :class="'form-control'"
                                                        :name="'question'" :placeholder="__('website::dashboard.question')" :value="$translation['question']"
                                                        :isRequired="true" :requiredMessage="__('website::dashboard.name_is_required')" :maxlength="255"
                                                        :maxlengthMessage="__(
                                                            'website::dashboard.number_of_characters_must_less_than_or_equal_255',
                                                        )" />
                                                @else
                                                    <x-dashboard.form.inputs.text :id="''" :class="'form-control'"
                                                        :name="'question'" :placeholder="__('website::dashboard.question')" :value="$translation->question"
                                                        :isRequired="true" :requiredMessage="__('website::dashboard.name_is_required')" :maxlength="255"
                                                        :maxlengthMessage="__(
                                                            'website::dashboard.number_of_characters_must_less_than_or_equal_255',
                                                        )" />
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <label
                                                class="col-lg-3 col-form-label text-right">{{ __('website::dashboard.answer') }}:</label>
                                            <div class="col-lg-9">
                                                @if (is_array($translation))
                                                    <x-dashboard.form.inputs.text-area :id="''" :class="'form-control rtf'"
                                                        :name="'answer'" :placeholder="__('website::dashboard.answer')" :value="$translation['answer']"
                                                        :isRequired="true" :requiredMessage="__('website::dashboard.answer_is_required')" />
                                                @else
                                                    <x-dashboard.form.inputs.text-area :id="''" :class="'form-control rtf'"
                                                        :name="'answer'" :placeholder="__('website::dashboard.answer')" :value="$translation->answer"
                                                        :isRequired="true" :requiredMessage="__('website::dashboard.answer_is_required')" />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="javascript:;" data-repeater-delete=""
                                            class="btn btn-sm font-weight-bolder btn-light-danger">
                                            <i class="la la-trash-o"></i>{{ __('website::dashboard.delete') }}
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div data-repeater-item class="form-group row align-items-top">
                                    <div class="col-md-3">
                                        <div class="row">
                                            <label
                                                class="col-lg-4 col-form-label text-right">{{ __('website::dashboard.language') }}:</label>
                                            <div class="col-lg-8">
                                                <x-dashboard.form.inputs.language-select :selectedOption="''" />
                                                <span
                                                    class="form-text text-muted">{{ __('website::dashboard.the_language_of_the_faq_question_and_answer') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <label
                                                class="col-lg-4 col-form-label text-right">{{ __('website::dashboard.question') }}:</label>
                                            <div class="col-lg-8">
                                                <x-dashboard.form.inputs.text :id="''" :class="'form-control'"
                                                    :name="'question'" :placeholder="__('website::dashboard.faq_question')" :value="''"
                                                    :isRequired="true" :requiredMessage="__('website::dashboard.question_is_required')" :maxlength="255"
                                                    :maxlengthMessage="__(
                                                        'website::dashboard.number_of_characters_must_less_than_or_equal_255',
                                                    )" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <label
                                                class="col-lg-3 col-form-label text-right">{{ __('website::dashboard.answer') }}:</label>
                                            <div class="col-lg-9">
                                                <x-dashboard.form.inputs.text-area :id="''" :class="'form-control rtf'"
                                                    :name="'answer'" :placeholder="__('website::dashboard.answer')" :value="''"
                                                    :isRequired="true" :requiredMessage="__('website::dashboard.answer_is_required')" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="javascript:;" data-repeater-delete=""
                                            class="btn btn-sm font-weight-bolder btn-light-danger">
                                            <i class="la la-trash-o"></i>{{ __('website::dashboard.delete') }}
                                        </a>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-10 col-form-label text-right"></label>
                        <div class="col-lg-2">
                            <a href="javascript:;" data-repeater-create=""
                                class="btn btn-sm font-weight-bolder btn-light-primary">
                                <i class="la la-plus"></i>{{ __('website::dashboard.add') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 col-form-label font-weight-bold">{{ __('website::dashboard.is_active') }}</label>
                    <div class="col-1">
                        <x-dashboard.form.inputs.success-switch class="mx-2" :id="'is_active'" :name="'is_active'"
                            :isChecked="old('is_active', $faq->is_active ?? '')" />
                    </div>
                    <div class="col-1"></div>
                    <label
                        class="col-1 col-form-label font-weight-bold">{{ __('website::dashboard.display_order') }}</label>
                    <div class="col-2">
                        <x-dashboard.form.inputs.number :id="'display_order'" :class="'form-control'" :name="'display_order'"
                            :integerValidationMessage="__('website::dashboard.display_order_must_be_integer')" :placeholder="__('website::dashboard.display_order')" :value="old('display_order', $faq->display_order ?? '')" />
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-10"></div>
                    <div class="col-2">
                        <button type="submit"
                            class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">{{ __('website::dashboard.save') }}</button>
                        <a href="{{ route('dashboard.website.terms-conditions.index') }}"
                            class="btn font-weight-bold btn-secondary">{{ __('website::dashboard.cancel') }}</a>
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
    @include('website::faqs.creating_editing.scripts')
    <!--end::Custom JS-->
@endpush
