@extends('dashboard.layouts.app')

@section('title', __('usersmanagement::dashboard.users_management') . '-' . __('usersmanagement::dashboard.roles'));

@section('head-css')
    <link href="{{ global_asset('metronic/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ global_asset('css/dashboard/treeview.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('subheader')
    @include('dashboard.layouts.partials.sub_header', [
        'module_name' => __('dashboard.users_management'),
        'breadcrumbs' => [
            [
                'url' => route('dashboard.users-management.roles.index'),
                'title' => __('usersmanagement::dashboard.roles'),
            ],
        ],
    ]);
@endsection

@section('content')
    <div class="treeview js-treeview">
        <ul>
            <li>
                <div class="treeview__level" data-level="{{ $role->id }}">
                    <span class="level-title">{{ $role->name }}</span>
                    <div class="treeview__level-btns">
                        <div class="btn btn-default btn-sm">
                            <a href="{{ route('dashboard.users-management.roles.create') . '?report_to=' . $role->id }}">
                                <span class="fa fa-plus"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <ul>
                    @forelse ($role->subMainRoles() as $sub_role)
                        <li>
                            <div class="treeview__level" data-level="{{ $sub_role->id }}">
                                <span class="level-title">{{ $sub_role->name }}</span>
                                <div class="treeview__level-btns">
                                    <div class="btn btn-default btn-sm level-add">
                                        <a
                                            href="{{ route('dashboard.users-management.roles.create') . '?report_to=' . $sub_role->id }}">
                                            <span class="fa fa-plus"></span>
                                        </a>
                                    </div>
                                    <div class="btn btn-default btn-sm level-remove">
                                        <a
                                            href="{{ route('dashboard.users-management.roles.edit', ['id' => $sub_role->id]) . '?report_to=' . $sub_role->report_to }}">
                                            <span class="fa fa-edit text-muted mr-3"></span>
                                        </a>
                                        <a href="#" class="delete-role" data-id="{{ $sub_role->id }}"
                                            data-users-count="{{ $sub_role->users()->count() }}"
                                            data-delete-url="{{ route('dashboard.users-management.roles.destroy', ['id' => $sub_role->id]) }}">
                                            <span class="fa fa-trash text-danger ml-3">
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @if (count($role->subMainRoles()))
                                @include('usersmanagement::roles.indexing.sub_roles', [
                                    'sub_roles' => $sub_role->subMainRoles(),
                                ])
                            @endif
                        </li>
                    @empty
                    @endforelse
                </ul>
            </li>
        </ul>
    </div>
@endsection

@push('javascript')
    <script src="{{ global_asset('metronic/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    @include('usersmanagement::roles.indexing.scripts');
@endpush
