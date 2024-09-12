@extends('admin.layouts.master')

@section('content')
<div class="card-header bg-white text-black d-flex justify-content-between align-items-center">
    <a class="text-black btn btn-success" href="{{URL::to('roles/create')}}" >Create new role</a>
    <label>
        <input type="search" class="form-control form-control-sm" placeholder="Search" aria-controls="selection-datatable" id="keyword"  name="keyword">
        <input type="hidden" value="{{route('roles.search')}}" id="url" >
    </label>
</div>
    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Permissions</th>
                <th>Created At</th>
                <th>Updated At</th>
                @hasPermission('edit-role')
                <th>Action</th>
                @endhasPermission
            </tr>
        </thead>

        <tbody id="role-table-body">
            @foreach($roles as $role)
            <tr>
                <td>{{ $role->name }}</td>
                <td>{{ $role->description }}</td>
                <td class="w-25">
                    @foreach ($role->permissions as $permission)
                        <span class="badge bg-info text-white">{{ $permission->name }}</span>
                    @endforeach
                </td>
                <td>{{ $role->created_at }}</td>
                <td>{{ $role->updated_at }}</td>
                <td class="d-flex">
                    @hasPermission('edit-role')
                    <a href="{{route('roles.edit', $role->id)}}" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                    @endhasPermission
                    @hasPermission('delete-role')
                    <form action="{{route('roles.destroy', $role->id)}}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="action-icon btn"><i class="mdi mdi-delete"></i></button>
                    </form>
                    @endhasPermission
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@push('js')
    <script type="module" src="{{asset('/assets/js/app.js')}}"></script>
@endpush
