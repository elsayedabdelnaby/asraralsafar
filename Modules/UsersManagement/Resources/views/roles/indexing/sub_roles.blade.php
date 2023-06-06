<ul>
    @foreach ($sub_roles as $role)
        <li>
            <div class="treeview__level" data-level="{{ $role->id }}">
                <span class="level-title">{{ $role->name }}</span>
                <div class="treeview__level-btns">
                    <div class="btn btn-default btn-sm level-add">
                        <a href="{{ route('dashboard.users-management.roles.create') . '?report_to=' . $role->id }}">
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
                    'roles' => $role->subMainRoles(),
                ])
            @endif
        </li>
    @endforeach
</ul>
